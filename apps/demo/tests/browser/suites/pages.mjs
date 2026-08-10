// Every documented component page, every block, at desktop AND mobile widths.
//
// Cheap per page, and it covers the failure mode that costs the most: a component
// that throws in the browser, never boots, or leaks a literal tag. Runs at 375px too
// because responsive branches are where our worst regression lived (#16).
import { expect, inLanes, visit } from '../lib/harness.mjs';
import { leakedTags, slotsOn, stuckCloaks } from '../lib/probes.mjs';

const VIEWPORTS = [
    { name: 'desktop', width: 1280, height: 900 },
    { name: 'mobile', width: 375, height: 800 },
];

export async function run({ browser, reporter, baseUrl, inventory, only }) {
    const targets = [
        ...inventory.components.map((slug) => ({ label: `components/${slug}`, url: `${baseUrl}/components/${slug}` })),
        ...inventory.blocks.map((slug) => ({ label: `blocks/${slug}`, url: `${baseUrl}/blocks/${slug}/raw` })),
    ].filter((t) => !only || t.label.includes(only));

    for (const { name, width, height } of VIEWPORTS) {
        reporter.suite(`pages @ ${name}`);
        let done = 0;

        // Four pages in parallel: the run covers 220 URLs at two widths, and a serial sweep
        // is slow enough that nobody would put it in CI.
        await inLanes(browser, targets, {
            lanes: 4,
            viewport: { width, height },
            each: async (page, target) => {
                await reporter.check(`${target.label} @ ${name}`, async () => {
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

                if (++done % 25 === 0) reporter.progress(`${name}: ${done}/${targets.length} pages`);
            },
        });
    }
}
