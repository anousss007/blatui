// Perceptual fingerprints of a rendered page, for visual regression without a baseline
// repository full of PNGs.
//
// Why hashes and not committed screenshots: 156 components × 11 widths is 1,716 images and
// tens of megabytes in git, for a diff nobody can read in a pull request. A 256-bit dHash per
// (component, width) is ~70 bytes, lands in one reviewable JSON file, and answers the only
// question that matters in CI — "does this render differently than it used to?". When it does,
// the run writes the actual PNG so a human can look at it.
//
// dHash compares each pixel with its right-hand neighbour on a 17×16 grayscale grid. It is
// deliberately insensitive to the things that differ between two machines rendering the same
// page (antialiasing, subpixel text) and sensitive to the things that matter (layout moving,
// colour changing, an element disappearing).

const GRID_W = 17;
const GRID_H = 16;

/**
 * Bits that may differ before two renderings are considered different.
 *
 * Measured rather than guessed. Two fresh contexts rendering the same simple page differ by 0
 * bits; the noisiest real case — a group of avatars whose remote images resolve in a slightly
 * different order — differs by 5; a 4px padding change on one button inside a busy example
 * differs by 14. Eight sits between the noise and the smallest change worth catching.
 */
export const TOLERANCE = 8;

/**
 * Stop the page from loading anything we do not control.
 *
 * The demo pulls its webfonts from a CDN and a few examples embed remote images. Whether those
 * arrive — and which exact file the CDN serves — differs between a laptop and a CI runner, and
 * text rendered in a different face moves every fingerprint on the page. Blocking cross-origin
 * requests makes the capture depend only on this repository. Call it BEFORE navigating.
 */
export async function pinRendering(page, baseUrl) {
    const origin = new URL(baseUrl).origin;

    await page.route('**/*', (route) => {
        const url = route.request().url();
        const ours = url.startsWith(origin) || url.startsWith('data:') || url.startsWith('blob:');

        return ours ? route.continue() : route.abort();
    });
}

/**
 * Kill everything that would make the same page hash differently one second later.
 * Returns nothing; call it after every navigation, before capturing.
 */
export async function freeze(page) {
    await page.addStyleTag({
        content: `*, *::before, *::after {
            animation-duration: 0s !important;
            animation-delay: 0s !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0s !important;
            transition-delay: 0s !important;
            caret-color: transparent !important;
            scroll-behavior: auto !important;
        }`,
    });
    // Walk the page top to bottom first. Images below the fold are lazy: their request does not
    // start until something scrolls them into view, and the thing that eventually does is the
    // capture itself — so the first look at an example records the image still pending and the
    // next one records its fallback. Trigger them all, then wait.
    await page.evaluate(async () => {
        const step = window.innerHeight;
        for (let y = 0; y < document.body.scrollHeight; y += step) {
            window.scrollTo(0, y);
            await new Promise((r) => requestAnimationFrame(r));
        }
        window.scrollTo(0, 0);
    });

    // Every image has to have finished — loaded or failed. An avatar swaps to its fallback on
    // the image's error event, so capturing while a request is still in flight records whichever
    // of the two states won the race that time, and the next machine records the other one.
    await page
        .waitForFunction(() => [...document.images].every((img) => img.complete), null, { timeout: 5000 })
        .catch(() => {});

    // Let the frozen styles settle, any in-flight transition land on its end state, and any
    // JS-driven intro (typing, counting up, streaming) reach the state it holds. Capturing a
    // component mid-intro records a frame that will never occur again, and every later run
    // reports it as a regression.
    await page.waitForTimeout(1500);
}

/**
 * A 256-bit fingerprint of an element (or the viewport when no selector is given).
 *
 * Per-element on purpose: a docs page is mostly chrome, and hashing the whole thing at 17×16
 * means a padding change on one button among forty examples moves no bits at all. One
 * fingerprint per example section is sensitive enough to see that, and tells you WHICH example
 * moved instead of "this page looks different".
 */
export async function fingerprint(page, selector = null, index = 0) {
    const target = selector ? page.locator(selector).nth(index) : page;
    const png = await target.screenshot({ animations: 'disabled', caret: 'hide' });

    return page.evaluate(
        async ([base64, w, h]) => {
            const bytes = Uint8Array.from(atob(base64), (c) => c.charCodeAt(0));
            const bitmap = await createImageBitmap(new Blob([bytes], { type: 'image/png' }));

            const canvas = new OffscreenCanvas(w, h);
            const ctx = canvas.getContext('2d', { willReadFrequently: true });
            ctx.drawImage(bitmap, 0, 0, w, h);
            const { data } = ctx.getImageData(0, 0, w, h);

            const gray = new Float64Array(w * h);
            for (let i = 0; i < w * h; i++) {
                gray[i] = data[i * 4] * 0.299 + data[i * 4 + 1] * 0.587 + data[i * 4 + 2] * 0.114;
            }

            let bits = '';
            for (let y = 0; y < h; y++) {
                for (let x = 0; x < w - 1; x++) bits += gray[y * w + x] < gray[y * w + x + 1] ? '1' : '0';
            }

            // Pack to hex so the baseline file stays readable and small.
            let hex = '';
            for (let i = 0; i < bits.length; i += 4) hex += parseInt(bits.slice(i, i + 4), 2).toString(16);

            return hex;
        },
        [png.toString('base64'), GRID_W, GRID_H]
    );
}

/** How many of the 256 bits differ. */
export function distance(a, b) {
    if (!a || !b || a.length !== b.length) return Infinity;

    let diff = 0;
    for (let i = 0; i < a.length; i++) {
        let x = parseInt(a[i], 16) ^ parseInt(b[i], 16);
        while (x) {
            diff += x & 1;
            x >>= 1;
        }
    }

    return diff;
}
