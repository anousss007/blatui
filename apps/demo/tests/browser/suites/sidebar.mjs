// The sidebar, at every width it changes behaviour at.
//
// This component has produced three separate escapes (#10, #15, #16) and every one of
// them was responsive or interaction state that only a browser can see: a drawer that
// computed to display:none, a rail that could not scroll, a tooltip that never showed.
// It gets its own suite because it earns one.
import { expect, newPage, visit } from '../lib/harness.mjs';
import { visibility } from '../lib/probes.mjs';

const BLOCK = '/blocks/sidebar-07/raw';
const PANEL = '[role="dialog"][aria-label="Sidebar"]';
const TRIGGER = '[data-slot="sidebar-trigger"]';

export async function run({ browser, reporter, baseUrl, only }) {
    if (only && !'sidebar'.includes(only)) return;
    reporter.suite('sidebar');

    // ── Mobile: the off-canvas drawer ───────────────────────────────────────────
    const mobile = await newPage(browser, { width: 375, height: 800 });
    await visit(mobile, baseUrl + BLOCK);

    await reporter.check('mobile: drawer is closed on load', async () => {
        const panel = await visibility(mobile, PANEL);

        return expect.truthy(!panel.visible, `the drawer is on screen before anything was clicked: ${JSON.stringify(panel)}`);
    });

    await reporter.check('mobile: the trigger opens the drawer', async () => {
        mobile.blatErrors.length = 0;
        await mobile.click(TRIGGER);
        await mobile.waitForTimeout(600);
        const panel = await visibility(mobile, PANEL);

        // Regression guard for #16: the panel was in the DOM, the backdrop was up, and
        // the panel itself computed to display:none because a desktop class leaked onto it.
        return (
            expect.truthy(panel.visible, `the drawer never became visible: ${JSON.stringify(panel)}`) ??
            expect.truthy(panel.width > 100, `the drawer opened at ${panel.width}px — it has no width`) ??
            expect.empty(mobile.blatErrors, 'console errors')
        );
    });

    await reporter.check('mobile: focus moves into the drawer', async () => {
        const inside = await mobile.evaluate((sel) => !!document.activeElement?.closest(sel), PANEL);

        return expect.truthy(inside, 'focus stayed outside the open drawer — the focus trap did not engage');
    });

    await reporter.check('mobile: Escape closes it and returns focus to the trigger', async () => {
        await mobile.keyboard.press('Escape');
        await mobile.waitForTimeout(600);
        const panel = await visibility(mobile, PANEL);
        const returned = await mobile.evaluate((sel) => !!document.activeElement?.closest(sel), TRIGGER);

        return (
            expect.truthy(!panel.visible, 'the drawer stayed open after Escape') ??
            expect.truthy(returned, 'focus was not returned to the trigger')
        );
    });

    await reporter.check('mobile: the backdrop closes it too', async () => {
        await mobile.click(TRIGGER);
        await mobile.waitForTimeout(500);
        await mobile.mouse.click(360, 400); // outside the panel, on the backdrop
        await mobile.waitForTimeout(500);

        return expect.truthy(!(await visibility(mobile, PANEL)).visible, 'clicking the backdrop did not close the drawer');
    });

    await mobile.close();

    // ── Desktop: the icon rail ──────────────────────────────────────────────────
    const desktop = await newPage(browser, { width: 1280, height: 900 });
    await visit(desktop, baseUrl + BLOCK);

    await reporter.check('desktop: sidebar is docked, drawer is not used', async () => {
        const docked = await visibility(desktop, '[data-slot="sidebar"]');
        const panel = await visibility(desktop, PANEL);

        return (
            expect.truthy(docked.visible, 'the docked sidebar is not visible at 1280px') ??
            expect.truthy(!panel.visible, 'the mobile drawer is showing on desktop')
        );
    });

    await reporter.check('desktop: the trigger collapses it to the icon rail', async () => {
        desktop.blatErrors.length = 0;
        const before = await desktop.evaluate(() => document.querySelector('[data-sidebar="sidebar"]')?.getBoundingClientRect().width);
        await desktop.click(TRIGGER);
        await desktop.waitForTimeout(500);
        const after = await desktop.evaluate(() => document.querySelector('[data-sidebar="sidebar"]')?.getBoundingClientRect().width);

        return (
            expect.truthy(after < before, `the rail did not shrink: ${before}px → ${after}px`) ??
            expect.truthy(after > 20, `the rail collapsed to ${after}px — icons cannot fit`) ??
            expect.empty(desktop.blatErrors, 'console errors')
        );
    });

    await reporter.check('collapsed: menu buttons still fit inside the rail', async () => {
        return desktop.evaluate(() => {
            const rail = document.querySelector('[data-sidebar="sidebar"]')?.getBoundingClientRect();
            const buttons = [...document.querySelectorAll('[data-slot="sidebar-menu-button"]')].filter((b) => b.getBoundingClientRect().width > 0);
            if (!rail || !buttons.length) return 'no rail or no visible menu buttons';
            const overflowing = buttons.filter((b) => {
                const r = b.getBoundingClientRect();

                return r.right > rail.right + 1 || r.left < rail.left - 1;
            });

            return overflowing.length ? `${overflowing.length} menu button(s) overflow the collapsed rail` : undefined;
        });
    });

    // The sidebar renders its slot twice (docked panel + teleported mobile drawer), and the
    // header's team switcher is a dropdown trigger with no tooltip — so target a button that
    // actually declares one, and match the tooltip by ITS label rather than by index.
    const TIPPED_BUTTON = '[data-slot="sidebar-menu-button-tooltip"]:visible [data-slot="sidebar-menu-button"]';

    const hoverTippedButton = async () => {
        const button = desktop.locator(TIPPED_BUTTON).first();
        await button.scrollIntoViewIfNeeded();
        const label = (await button.innerText()).trim();
        await desktop.mouse.move(640, 400); // leave whatever was hovered before
        await desktop.waitForTimeout(200);
        await button.hover();
        await desktop.waitForTimeout(500);

        const shown = await desktop.evaluate(() =>
            [...document.querySelectorAll('[data-slot="tooltip-content"]')]
                .filter((t) => getComputedStyle(t).display !== 'none' && t.getBoundingClientRect().width > 0)
                .map((t) => t.textContent.trim())
        );

        return { label, shown };
    };

    await reporter.check('collapsed: hovering a menu button shows its own tooltip', async () => {
        desktop.blatErrors.length = 0;
        const { label, shown } = await hoverTippedButton();

        return (
            expect.truthy(shown.length > 0, `no tooltip became visible while hovering "${label}" in the collapsed rail`) ??
            expect.truthy(shown.includes(label), `the visible tooltip says ${JSON.stringify(shown)}, expected "${label}"`) ??
            expect.empty(desktop.blatErrors, 'console errors')
        );
    });

    await reporter.check('expanded: the same tooltip stays hidden', async () => {
        await desktop.click(TRIGGER); // back to expanded
        await desktop.waitForTimeout(500);
        const { shown } = await hoverTippedButton();

        return expect.truthy(shown.length === 0, `a tooltip showed while the label is already readable: ${JSON.stringify(shown)}`);
    });

    await reporter.check('collapsed: the rail scrolls to its last item', async () => {
        await desktop.click(TRIGGER); // collapse again
        await desktop.waitForTimeout(400);

        return desktop.evaluate(() => {
            const content = document.querySelector('[data-slot="sidebar-content"]');
            if (!content) return 'no sidebar-content';
            const cs = getComputedStyle(content);
            if (cs.overflowY === 'hidden') return 'sidebar-content clips vertical overflow while collapsed — the last groups are unreachable';
            content.scrollTop = content.scrollHeight;

            return content.scrollHeight > content.clientHeight && content.scrollTop === 0
                ? 'the collapsed rail overflows but refuses to scroll'
                : undefined;
        });
    });

    await desktop.close();
}
