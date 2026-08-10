// Every documented component page and every block, at every width in the matrix.
//
// Cheap per page, and it covers the failure mode that costs the most: a component that
// throws in the browser, never boots, or leaks a literal tag. The width sweep is the point:
// two of our escapes only existed inside one breakpoint range (#16 below md, #17 between md
// and lg), and a suite that only knew "phone" and "laptop" walked straight past both.
import { expect, inLanes, visit } from '../lib/harness.mjs';
import { leakedTags, slotsOn, stuckCloaks } from '../lib/probes.mjs';

export async function run({ browser, reporter, baseUrl, inventory, only, viewports }) {
    const targets = [
        ...inventory.components.map((slug) => ({ label: `components/${slug}`, url: `${baseUrl}/components/${slug}` })),
        ...inventory.blocks.map((slug) => ({ label: `blocks/${slug}`, url: `${baseUrl}/blocks/${slug}/raw` })),
    ].filter((t) => !only || t.label.includes(only));

    for (const { name, width, height } of viewports) {
        reporter.suite(`pages @ ${name}px`);
        let done = 0;

        // Six pages in parallel: the sweep is 220 URLs at every width in the matrix, and a
        // serial run would be slow enough that nobody would keep it in CI.
        await inLanes(browser, targets, {
            lanes: 6,
            viewport: { width, height },
            each: async (page, target) => {
                await reporter.check(`${target.label} @ ${name}px`, async () => {
                    page.blatErrors.length = 0;
                    const failure = await visit(page, target.url).then(
                        () => null,
                        (e) => e.message
                    );
                    if (failure) return `navigation failed: ${failure}`;

                    const [leaked, cloaks, slots] = await Promise.all([leakedTags(page), stuckCloaks(page), slotsOn(page)]);

                    return (
                        expect.empty(page.blatErrors, 'console errors') ??
                        expect.empty(leaked, 'component tags leaked into the HTML (failed to compile)') ??
                        expect.empty(cloaks, 'x-cloak still present — Alpine never initialised these') ??
                        expect.truthy(Object.keys(slots).length > 0, 'page rendered no BlatUI component at all')
                    );
                });

                if (++done % 25 === 0) reporter.progress(`${name}px: ${done}/${targets.length} pages`);
            },
        });
    }
}
