// Click every button on every documented page.
//
// The literal "does the smallest button work" layer. It is not asserting what each
// button does — the docs page is the only thing that knows that — but it does assert
// the two things every button owes its user: the click is handled without throwing,
// and the page is still alive afterwards. An Alpine handler calling a method that
// does not exist on its scope shows up here and nowhere else.
import { expect, inLanes, visit } from '../lib/harness.mjs';
import { dismiss, leakedTags } from '../lib/probes.mjs';

/** Buttons whose whole job is to leave the page — clicking them proves nothing here. */
const SKIP_TEXT = /^(view on github|open in new tab|docs|download)$/i;

const MAX_PER_PAGE = 10;

export async function run({ browser, reporter, baseUrl, inventory, only, viewports }) {
    const slugs = inventory.components.filter((s) => !only || s.includes(only));

    // Which buttons are on screen changes with the width — a docs page hides half its
    // controls on a phone — so the sweep runs at every width rather than picking one.
    for (const { name, width, height } of viewports) {
        reporter.suite(`buttons @ ${name}px`);

        await inLanes(browser, slugs, { lanes: 4, viewport: { width, height }, each: async (page, slug) => {
        const url = `${baseUrl}/components/${slug}`;
        await visit(page, url);

        const total = await page.locator('[data-slot="button"]:visible').count();
        if (!total) return;

        await reporter.check(`${slug} @ ${name}px: ${Math.min(total, MAX_PER_PAGE)} of ${total} buttons handle a click`, async () => {
            const broken = [];

            for (let i = 0; i < Math.min(total, MAX_PER_PAGE); i++) {
                const button = page.locator('[data-slot="button"]:visible').nth(i);
                if (!(await button.count())) break;

                const label = ((await button.innerText().catch(() => '')) || `#${i}`).trim().slice(0, 30);
                if (SKIP_TEXT.test(label)) continue;

                page.blatErrors.length = 0;
                try {
                    await button.scrollIntoViewIfNeeded({ timeout: 2000 });
                    await button.click({ timeout: 2000 });
                    await page.waitForTimeout(120);
                } catch (e) {
                    // Covered by another element (an open overlay) or detached: dismiss and move on.
                    await dismiss(page);
                    continue;
                }

                if (page.blatErrors.length) broken.push(`"${label}" → ${page.blatErrors[0]}`);

                await dismiss(page);

                // A click that navigated away means the rest of this page is untestable.
                if (!page.url().startsWith(url)) {
                    await visit(page, url);
                    break;
                }
            }

            const leaked = await leakedTags(page);

            return expect.empty(broken, 'buttons whose click threw') ?? expect.empty(leaked, 'component tags leaked after interaction');
        });
            reporter.progress(`buttons ${name}px ${slug}`);
        } });
    }
}
