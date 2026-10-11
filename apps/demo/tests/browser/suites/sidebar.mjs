// The sidebar, at every width in the matrix.
//
// This component has produced four separate escapes (#10, #15, #16, #17) and every one of
// them was responsive or interaction state that only a browser can see: a drawer that
// computed to display:none, a rail that could not scroll, a tooltip that never showed, a
// configured breakpoint the CSS ignored. It gets its own suite, and the suite asserts the
// *mode* the width implies rather than testing two hand-picked widths and hoping.
import { expect, newPage, visit } from '../lib/harness.mjs';
import { visibility } from '../lib/probes.mjs';

const BLOCK = '/blocks/sidebar-07/raw';
const PANEL = '[role="dialog"][aria-label="Sidebar"]';
const TRIGGER = '[data-slot="sidebar-trigger"]';

/** Tailwind's md — the default the sidebar switches modes at. */
const MD = 768;

/** Drawer mode: the sidebar is off-canvas until the trigger opens it. */
async function checksDrawerMode(page, reporter, at) {
    await reporter.check(`${at} drawer is closed on load`, async () => {
        const panel = await visibility(page, PANEL);

        return expect.truthy(!panel.visible, `the drawer is on screen before anything was clicked: ${JSON.stringify(panel)}`);
    });

    await reporter.check(`${at} the trigger opens the drawer`, async () => {
        page.blatErrors.length = 0;
        await page.click(TRIGGER);
        await page.waitForTimeout(600);
        const panel = await visibility(page, PANEL);

        // Regression guard for #16: the panel was in the DOM and the backdrop was up, while
        // the panel itself computed to display:none from a class that leaked onto it.
        return (
            expect.truthy(panel.visible, `the drawer never became visible: ${JSON.stringify(panel)}`) ??
            expect.truthy(panel.width > 100, `the drawer opened at ${panel.width}px — it has no width`) ??
            expect.empty(page.blatErrors, 'console errors')
        );
    });

    await reporter.check(`${at} focus moves into the drawer`, async () => {
        const inside = await page.evaluate((sel) => !!document.activeElement?.closest(sel), PANEL);

        return expect.truthy(inside, 'focus stayed outside the open drawer — the focus trap did not engage');
    });

    await reporter.check(`${at} Escape closes it and returns focus to the trigger`, async () => {
        await page.keyboard.press('Escape');
        await page.waitForTimeout(600);
        const panel = await visibility(page, PANEL);
        const returned = await page.evaluate((sel) => !!document.activeElement?.closest(sel), TRIGGER);

        return (
            expect.truthy(!panel.visible, 'the drawer stayed open after Escape') ??
            expect.truthy(returned, 'focus was not returned to the trigger')
        );
    });

    await reporter.check(`${at} the backdrop closes it too`, async () => {
        await page.click(TRIGGER);
        await page.waitForTimeout(500);
        const box = await page.locator(PANEL).boundingBox();
        await page.mouse.click(Math.min(box.x + box.width + 20, page.viewportSize().width - 5), 400);
        await page.waitForTimeout(500);

        return expect.truthy(!(await visibility(page, PANEL)).visible, 'clicking the backdrop did not close the drawer');
    });
}

/** Docked mode: the panel is in the layout, and the trigger collapses it to the icon rail. */
async function checksDockedMode(page, reporter, at) {
    await reporter.check(`${at} sidebar is docked and the drawer is not used`, async () => {
        const docked = await visibility(page, '[data-slot="sidebar"]');
        const panel = await visibility(page, PANEL);

        return (
            expect.truthy(docked.visible, 'the docked sidebar is not visible') ??
            expect.truthy(!panel.visible, 'the mobile drawer is showing while docked')
        );
    });

    await reporter.check(`${at} the trigger collapses it to the icon rail`, async () => {
        page.blatErrors.length = 0;
        const widthOf = () => page.evaluate(() => document.querySelector('[data-sidebar="sidebar"]')?.getBoundingClientRect().width);
        const before = await widthOf();
        await page.click(TRIGGER);
        await page.waitForTimeout(500);
        const after = await widthOf();

        return (
            expect.truthy(after < before, `the rail did not shrink: ${before}px → ${after}px`) ??
            expect.truthy(after > 20, `the rail collapsed to ${after}px — icons cannot fit`) ??
            expect.empty(page.blatErrors, 'console errors')
        );
    });

    // #39: the block persists, so the collapse just made has to survive a reload — and be in
    // the HTML the server sends, not applied by Alpine after a flash of the expanded panel.
    await reporter.check(`${at} collapsed: the state survives a reload, painted by the server`, async () => {
        const served = await page.evaluate(() => fetch(location.href, { credentials: 'same-origin' }).then((r) => r.text()));
        await visit(page, page.url());
        const state = await page.evaluate(() => document.querySelector('[data-slot="sidebar"]')?.getAttribute('data-state'));

        return (
            expect.truthy(served.includes('data-state="collapsed"'), 'the server rendered the sidebar expanded after it was collapsed') ??
            expect.truthy(state === 'collapsed', `after a reload the sidebar is ${state}`)
        );
    });

    // #39: an item with children used to be a dead end in the rail — its sub list is hidden.
    const SUB_ITEM = '[data-slot="sidebar"] [data-sidebar="menu-item"]:has([data-sidebar="menu-sub"])';
    await reporter.check(`${at} collapsed: an item with children opens its submenu as a flyout`, async () => {
        page.blatErrors.length = 0;
        const button = page.locator(`${SUB_ITEM} [data-sidebar="menu-button"]`).first();
        await button.scrollIntoViewIfNeeded();
        await button.click();
        await page.waitForTimeout(300);

        const result = await page.evaluate((sel) => {
            const item = document.querySelector(sel);
            const sub = item.querySelector('[data-sidebar="menu-sub"]');
            const rail = document.querySelector('[data-sidebar="sidebar"]').getBoundingClientRect();
            const box = sub.getBoundingClientRect();
            const links = [...sub.querySelectorAll('[data-sidebar="menu-sub-button"]')].filter((a) => a.getBoundingClientRect().width > 0);
            const top = document.elementFromPoint(box.left + box.width / 2, box.top + 12);

            return {
                open: sub.getAttribute('data-flyout'),
                beside: box.left >= rail.right - 1 || box.right <= rail.left + 1,
                width: box.width,
                links: links.length,
                onTop: !!top && sub.contains(top),
                focusInside: sub.contains(document.activeElement),
            };
        }, SUB_ITEM);

        return (
            expect.truthy(result.open === 'open', 'clicking the button did not open the flyout') ??
            expect.truthy(result.beside, 'the flyout overlaps the rail instead of sitting beside it') ??
            expect.truthy(result.width > 100 && result.links > 0, `the flyout has no visible links: ${JSON.stringify(result)}`) ??
            expect.truthy(result.onTop, 'something paints over the flyout') ??
            expect.truthy(result.focusInside, 'focus did not move into the flyout') ??
            expect.empty(page.blatErrors, 'console errors')
        );
    });

    await reporter.check(`${at} collapsed: arrow keys move through the flyout, Escape returns to the button`, async () => {
        const before = await page.evaluate(() => document.activeElement?.textContent.trim());
        await page.keyboard.press('ArrowDown');
        const after = await page.evaluate(() => document.activeElement?.textContent.trim());
        await page.keyboard.press('Escape');
        await page.waitForTimeout(200);
        const closed = await page.evaluate((sel) => {
            const item = document.querySelector(sel);

            return {
                open: item.querySelector('[data-sidebar="menu-sub"]').getAttribute('data-flyout'),
                onButton: item.querySelector('[data-sidebar="menu-button"]').contains(document.activeElement),
            };
        }, SUB_ITEM);

        return (
            expect.truthy(before !== after, `ArrowDown did not move focus (stayed on "${before}")`) ??
            expect.truthy(closed.open === null, 'Escape left the flyout open') ??
            expect.truthy(closed.onButton, 'Escape did not return focus to the menu button')
        );
    });

    await reporter.check(`${at} collapsed: clicking outside closes the flyout`, async () => {
        await page.locator(`${SUB_ITEM} [data-sidebar="menu-button"]`).first().click();
        await page.waitForTimeout(200);
        await page.mouse.click(page.viewportSize().width - 20, page.viewportSize().height - 20);
        await page.waitForTimeout(200);
        const open = await page.evaluate((sel) => document.querySelector(sel).querySelector('[data-sidebar="menu-sub"]').getAttribute('data-flyout'), SUB_ITEM);

        return expect.truthy(open === null, 'the flyout stayed open after a click elsewhere');
    });

    await reporter.check(`${at} collapsed: menu buttons still fit inside the rail`, async () =>
        page.evaluate(() => {
            const rail = document.querySelector('[data-sidebar="sidebar"]')?.getBoundingClientRect();
            const buttons = [...document.querySelectorAll('[data-slot="sidebar-menu-button"]')].filter((b) => b.getBoundingClientRect().width > 0);
            if (!rail || !buttons.length) return 'no rail or no visible menu buttons';
            const overflowing = buttons.filter((b) => {
                const r = b.getBoundingClientRect();

                return r.right > rail.right + 1 || r.left < rail.left - 1;
            });

            return overflowing.length ? `${overflowing.length} menu button(s) overflow the collapsed rail` : undefined;
        })
    );

    // The sidebar renders its slot twice (docked panel + teleported drawer), and the header's
    // team switcher is a dropdown trigger with no tooltip — so target a button that declares
    // one, and match the tooltip by ITS label rather than by index.
    const hoverTippedButton = async () => {
        const button = page.locator('[data-slot="sidebar-menu-button-tooltip"]:visible [data-slot="sidebar-menu-button"]').first();
        await button.scrollIntoViewIfNeeded();
        const label = (await button.innerText()).trim();
        await page.mouse.move(page.viewportSize().width / 2, 400); // leave whatever was hovered
        await page.waitForTimeout(200);
        await button.hover();
        await page.waitForTimeout(500);

        const shown = await page.evaluate(() =>
            [...document.querySelectorAll('[data-slot="tooltip-content"]')]
                .filter((t) => getComputedStyle(t).display !== 'none' && t.getBoundingClientRect().width > 0)
                .map((t) => t.textContent.trim())
        );

        return { label, shown };
    };

    await reporter.check(`${at} collapsed: hovering a menu button shows its own tooltip`, async () => {
        page.blatErrors.length = 0;
        const { label, shown } = await hoverTippedButton();

        return (
            expect.truthy(shown.length > 0, `no tooltip became visible while hovering "${label}" in the collapsed rail`) ??
            expect.truthy(shown.includes(label), `the visible tooltip says ${JSON.stringify(shown)}, expected "${label}"`) ??
            expect.empty(page.blatErrors, 'console errors')
        );
    });

    await reporter.check(`${at} collapsed: the rail scrolls to its last item`, async () =>
        page.evaluate(() => {
            const content = document.querySelector('[data-slot="sidebar-content"]');
            if (!content) return 'no sidebar-content';
            if (getComputedStyle(content).overflowY === 'hidden') {
                return 'sidebar-content clips vertical overflow while collapsed — the last groups are unreachable';
            }
            content.scrollTop = content.scrollHeight;

            return content.scrollHeight > content.clientHeight && content.scrollTop === 0
                ? 'the collapsed rail overflows but refuses to scroll'
                : undefined;
        })
    );

    await reporter.check(`${at} expanded: the same tooltip stays hidden`, async () => {
        await page.click(TRIGGER); // back to expanded
        await page.waitForTimeout(500);
        const { shown } = await hoverTippedButton();

        return expect.truthy(shown.length === 0, `a tooltip showed while the label is already readable: ${JSON.stringify(shown)}`);
    });

    // #17: mobile-breakpoint decides `isMobile`, but the panels are painted by CSS. Driving
    // `isMobile` directly is the exact disagreement a breakpoint other than md creates.
    await reporter.check(`${at} a breakpoint above md hides the rail and enables the drawer`, async () => {
        page.blatErrors.length = 0;
        await page.evaluate(() => {
            window.Alpine.$data(document.querySelector('[data-slot="sidebar-provider"]')).isMobile = true;
        });
        await page.waitForTimeout(300);

        const rail = await visibility(page, '[data-slot="sidebar"]');
        if (rail.visible) return `the docked rail is still shown while isMobile is true: ${JSON.stringify(rail)}`;

        await page.click(TRIGGER);
        await page.waitForTimeout(600);
        const panel = await visibility(page, PANEL);

        return (
            expect.truthy(panel.visible, `the drawer did not open above md: ${JSON.stringify(panel)}`) ??
            expect.truthy(panel.width > 100, `the drawer opened at ${panel.width}px`) ??
            expect.empty(page.blatErrors, 'console errors')
        );
    });

    await reporter.check(`${at} back below the breakpoint, the rail returns and the drawer does not linger`, async () => {
        await page.evaluate(() => {
            window.Alpine.$data(document.querySelector('[data-slot="sidebar-provider"]')).isMobile = false;
        });
        await page.waitForTimeout(400);

        const rail = await visibility(page, '[data-slot="sidebar"]');
        const panel = await visibility(page, PANEL);

        return (
            expect.truthy(rail.visible, 'the docked rail did not come back') ??
            expect.truthy(!panel.visible, 'the drawer stayed on screen over the docked rail')
        );
    });
}

export async function run({ browser, reporter, baseUrl, only, viewports }) {
    if (only && !'sidebar'.includes(only)) return;

    for (const { name, width, height } of viewports) {
        reporter.suite(`sidebar @ ${name}px`);
        const page = await newPage(browser, { width, height });
        await visit(page, baseUrl + BLOCK);

        // The width decides which mode is correct — that is the contract being tested.
        if (width < MD) {
            await checksDrawerMode(page, reporter, `${name}px:`);
        } else {
            await checksDockedMode(page, reporter, `${name}px:`);
        }

        await page.close();
    }
}
