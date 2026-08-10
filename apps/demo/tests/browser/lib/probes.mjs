// Probes: everything the suites need to know about a live page, expressed as
// COMPUTED state. No markup assertions live here — see harness.mjs for why.

/**
 * Is this element actually on screen? Not `x-show` bookkeeping, not a class —
 * layout. This is the check that catches a drawer left at display:none by a
 * leaked class, which is what shipped in #16.
 */
export async function visibility(page, selector, nth = 0) {
    return page.evaluate(
        ([sel, index]) => {
            const el = document.querySelectorAll(sel)[index];
            if (!el) return { exists: false, visible: false };
            const cs = getComputedStyle(el);
            const r = el.getBoundingClientRect();

            return {
                exists: true,
                display: cs.display,
                visibility: cs.visibility,
                opacity: Number(cs.opacity),
                width: Math.round(r.width),
                height: Math.round(r.height),
                // "Visible" means a user can see and hit it.
                visible: cs.display !== 'none' && cs.visibility !== 'hidden' && Number(cs.opacity) > 0.05 && r.width > 0 && r.height > 0,
                inert: el.hasAttribute('inert') || !!el.closest('[inert]'),
                state: el.getAttribute('data-state'),
            };
        },
        [selector, nth]
    );
}

/**
 * How many elements carrying this slot are actually on screen.
 *
 * Docs pages render a component several times over, and the site chrome adds its own
 * (a mobile-nav sheet that is hidden at desktop width). Counting visible instances
 * before and after an interaction is the only reading that survives that.
 */
export function countVisible(page, slot) {
    return page.evaluate(
        (sel) =>
            [...document.querySelectorAll(sel)].filter((el) => {
                const cs = getComputedStyle(el);
                const r = el.getBoundingClientRect();

                return cs.display !== 'none' && cs.visibility !== 'hidden' && Number(cs.opacity) > 0.05 && r.width > 0 && r.height > 0;
            }).length,
        `[data-slot="${slot}"]`
    );
}

/**
 * Poll until the visible count satisfies `wanted`, or give up.
 *
 * Fixed sleeps are how browser suites become flaky: a hover-card opens after a 400ms delay by
 * design, a drawer after a 300ms transition, a dropdown after one frame. Polling waits exactly
 * as long as each component needs and no longer.
 */
export async function waitForCount(page, slot, wanted, timeout = 2500) {
    const deadline = Date.now() + timeout;
    let count = await countVisible(page, slot);

    while (!wanted(count) && Date.now() < deadline) {
        await page.waitForTimeout(100);
        count = await countVisible(page, slot);
    }

    return count;
}

/** Every data-slot present on the page, with counts — the page's component inventory. */
export function slotsOn(page) {
    return page.evaluate(() => {
        const out = {};
        for (const el of document.querySelectorAll('[data-slot]')) {
            const s = el.getAttribute('data-slot');
            out[s] = (out[s] || 0) + 1;
        }

        return out;
    });
}

/** Tags that failed to compile and leaked into the HTML as literal text. */
export function leakedTags(page) {
    return page.evaluate(() => {
        const html = document.body.innerHTML;
        const hits = new Set();
        for (const m of html.matchAll(/<x-(ui|block)\.[a-z0-9-]+/g)) hits.add(m[0]);

        return [...hits];
    });
}

/**
 * x-cloak is removed by Alpine on boot. Anything still carrying it means Alpine
 * never initialised that subtree — a silent blank spot on the page.
 */
export function stuckCloaks(page) {
    return page.evaluate(() =>
        [...document.querySelectorAll('[x-cloak]')].map((el) => el.getAttribute('data-slot') || el.className.toString().slice(0, 40))
    );
}

/** Close whatever is open, so one example can't poison the next. */
export async function dismiss(page) {
    await page.keyboard.press('Escape');
    await page.waitForTimeout(120);
    await page.mouse.click(2, 2).catch(() => {});
    await page.waitForTimeout(120);
}

/**
 * Resolve a trigger to the element a user actually clicks, and hand back a selector for it.
 *
 * BlatUI wraps triggers in a `display: contents` span (the Blade port of Radix's asChild), so
 * the element carrying data-slot has no box of its own — Playwright rightly calls it invisible.
 * The real control is the button or link inside it, which is what `x-blat-trigger` targets at
 * runtime too. Returns null when no instance of this trigger is on screen at this width.
 */
export async function probeTrigger(page, slot) {
    const found = await page.evaluate((sel) => {
        document.querySelectorAll('[data-blat-probe]').forEach((el) => el.removeAttribute('data-blat-probe'));
        const focusable = 'button, [href], input, select, textarea, [role=button], [tabindex]:not([tabindex="-1"])';

        for (const el of document.querySelectorAll(sel)) {
            const control = el.matches(focusable) ? el : el.querySelector(focusable) || el;
            const r = control.getBoundingClientRect();
            if (r.width > 0 && r.height > 0 && getComputedStyle(control).visibility !== 'hidden') {
                control.setAttribute('data-blat-probe', '');

                return true;
            }
        }

        return false;
    }, `[data-slot="${slot}"]`);

    return found ? page.locator('[data-blat-probe]') : null;
}

/** Trigger → content pairs, taken from the shipped data-slot vocabulary. */
export const OVERLAY_PAIRS = [
    ['dialog-trigger', 'dialog-content'],
    ['alert-dialog-trigger', 'alert-dialog-content'],
    ['sheet-trigger', 'sheet-content'],
    ['drawer-trigger', 'drawer-content'],
    ['popover-trigger', 'popover-content'],
    ['dropdown-menu-trigger', 'dropdown-menu-content'],
    ['menubar-trigger', 'menubar-content'],
    ['select-trigger', 'select-content'],
    ['hover-card-trigger', 'hover-card-content'],
    ['tooltip-trigger', 'tooltip-content'],
    ['command-dialog-trigger', 'command-dialog-content'],
];

/** Disclosure widgets: trigger toggles a region in place rather than an overlay. */
export const DISCLOSURE_PAIRS = [
    ['accordion-trigger', 'accordion-content'],
    ['collapsible-trigger', 'collapsible-content'],
    ['reasoning-trigger', 'reasoning-content'],
    ['tool-call-trigger', 'tool-call-body'],
];
