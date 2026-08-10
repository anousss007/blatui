// The widths every suite runs at.
//
// Two rules learned the hard way:
//
//  1. Testing "a phone" and "a laptop" is not testing responsive behaviour. #17 lived at
//     900px — between Tailwind's md and lg, a width neither of those two covered — where a
//     configured breakpoint disagreed with the static `md:` classes and the sidebar showed
//     nothing at all.
//  2. Bugs cluster at the boundary, not in the middle of a range. So each breakpoint is
//     driven at its exact value AND one pixel below it, which is where an off-by-one in a
//     min-width/max-width pair shows up.
export const VIEWPORTS = [
    { name: '320', width: 320, height: 800 },   // smallest phone we support
    { name: '375', width: 375, height: 800 },   // common phone
    { name: '639', width: 639, height: 900 },   // last px before sm
    { name: '640', width: 640, height: 900 },   // sm
    { name: '767', width: 767, height: 900 },   // last px before md — the off-canvas boundary
    { name: '768', width: 768, height: 900 },   // md
    { name: '900', width: 900, height: 900 },   // between md and lg: where #17 hid
    { name: '1023', width: 1023, height: 900 }, // last px before lg
    { name: '1024', width: 1024, height: 900 }, // lg
    { name: '1280', width: 1280, height: 900 }, // xl
    { name: '1536', width: 1536, height: 960 }, // 2xl
];

/** The widest viewport, for checks that are about behaviour rather than layout. */
export const WIDEST = VIEWPORTS[VIEWPORTS.length - 1];

/**
 * `--viewports=375,1280` narrows a local run; CI always takes the full list. A run that
 * covers less than everything says so in its header rather than quietly under-testing.
 */
export function selectViewports(spec) {
    if (!spec) return VIEWPORTS;

    const wanted = spec.split(',').map((s) => s.trim());
    const picked = VIEWPORTS.filter((v) => wanted.includes(v.name) || wanted.includes(String(v.width)));

    if (!picked.length) {
        console.error(`No viewport matches "${spec}". Known: ${VIEWPORTS.map((v) => v.name).join(', ')}`);
        process.exit(2);
    }

    return picked;
}
