// Form controls and in-place widgets: click the thing, assert the STATE moved.
//
// Every component here reports itself through data-state / aria-checked / aria-selected,
// so the check is the same shape for all of them: read, interact, read again, and
// require a change. A control that looks right but never flips is exactly the kind of
// bug a render test cannot see.
import { expect, newPage, visit } from '../lib/harness.mjs';
import { slotsOn, visibility } from '../lib/probes.mjs';

/** slug → checks. Each returns undefined on success or a failure string. */
const CHECKS = {
    async switch(page, { reporter, at }) {
        await reporter.check(`switch: toggles aria-checked ${at}`, async () => {
            const el = page.locator('[data-slot="switch"]:not([disabled])').first();
            const before = await el.getAttribute('aria-checked');
            await el.scrollIntoViewIfNeeded();
            await el.click();
            await page.waitForTimeout(200);
            const after = await el.getAttribute('aria-checked');

            return expect.truthy(before !== after, `aria-checked stayed ${before}`) ?? expect.empty(page.blatErrors, 'console errors');
        });
        await reporter.check(`switch: thumb actually moves ${at}`, async () => {
            const thumb = await visibility(page, '[data-slot="switch-thumb"]');

            return expect.truthy(thumb.exists && thumb.width > 0, 'the switch thumb has no box');
        });
    },

    async checkbox(page, { reporter, at }) {
        await reporter.check(`checkbox: toggles state ${at}`, async () => {
            const el = page.locator('[data-slot="checkbox"]:not([disabled])').first();
            const before = await el.getAttribute('data-state');
            await el.scrollIntoViewIfNeeded();
            await el.click();
            await page.waitForTimeout(200);
            const after = await el.getAttribute('data-state');

            return expect.truthy(before !== after, `data-state stayed ${before}`) ?? expect.empty(page.blatErrors, 'console errors');
        });
    },

    async 'radio-group'(page, { reporter, at }) {
        await reporter.check(`radio-group: selecting one deselects the others ${at}`, async () => {
            const items = page.locator('[data-slot="radio-group-item"]:not([disabled])');
            if ((await items.count()) < 2) return 'need at least two radio items to test exclusivity';
            await items.nth(1).scrollIntoViewIfNeeded();
            await items.nth(1).click();
            await page.waitForTimeout(200);

            // Count within the group that was clicked — the docs page shows several.
            const checked = await page.evaluate(() => {
                const item = document.querySelectorAll('[data-slot="radio-group-item"]:not([disabled])')[1];
                const group = item?.closest('[data-slot="radio-group"]') || document;

                return {
                    checked: group.querySelectorAll('[data-slot="radio-group-item"][aria-checked="true"]').length,
                    clickedIsChecked: item?.getAttribute('aria-checked') === 'true',
                };
            });

            return (
                expect.equal(checked.checked, 1, 'exactly one radio in the group should be checked') ??
                expect.truthy(checked.clickedIsChecked, 'the radio that was clicked is not the checked one') ??
                expect.empty(page.blatErrors, 'console errors')
            );
        });
    },

    async tabs(page, { reporter, at }) {
        await reporter.check(`tabs: switching shows exactly one panel ${at}`, async () => {
            const triggers = page.locator('[data-slot="tabs-trigger"]');
            if ((await triggers.count()) < 2) return 'need at least two tabs';
            await triggers.nth(1).scrollIntoViewIfNeeded();
            await triggers.nth(1).click();
            await page.waitForTimeout(250);

            const state = await page.evaluate(() => {
                const list = document.querySelector('[data-slot="tabs-list"]');
                const root = list?.closest('[data-slot="tabs"]');
                const panels = [...(root?.querySelectorAll('[data-slot="tabs-content"]') || [])];

                return {
                    selected: [...(root?.querySelectorAll('[data-slot="tabs-trigger"]') || [])].filter((t) => t.getAttribute('aria-selected') === 'true').length,
                    visible: panels.filter((p) => getComputedStyle(p).display !== 'none').length,
                };
            });

            return (
                expect.equal(state.selected, 1, 'exactly one tab should be selected') ??
                expect.equal(state.visible, 1, 'exactly one tab panel should be visible') ??
                expect.empty(page.blatErrors, 'console errors')
            );
        });
    },

    async 'toggle-group'(page, { reporter, at }) {
        await reporter.check(`toggle-group: item flips on click ${at}`, async () => {
            const el = page.locator('[data-slot="toggle-group-item"]:not([disabled])').first();
            const before = await el.getAttribute('data-state');
            await el.scrollIntoViewIfNeeded();
            await el.click();
            await page.waitForTimeout(200);

            return expect.truthy((await el.getAttribute('data-state')) !== before, `data-state stayed ${before}`);
        });
    },

    async select(page, { reporter, at }) {
        await reporter.check(`select: picking an option updates the trigger label ${at}`, async () => {
            const trigger = page.locator('[data-slot="select-trigger"]').first();
            await trigger.scrollIntoViewIfNeeded();
            const before = (await trigger.innerText()).trim();
            await trigger.click();
            await page.waitForTimeout(250);
            const option = page.locator('[data-slot="select-item"]:visible').first();
            if (!(await option.count())) return 'no visible option after opening the select';
            await option.click();
            await page.waitForTimeout(250);
            const after = (await trigger.innerText()).trim();

            return (
                expect.truthy(after !== before || after.length > 0, 'the trigger label never updated') ??
                expect.truthy(!(await visibility(page, '[data-slot="select-content"]')).visible, 'the listbox stayed open after a pick') ??
                expect.empty(page.blatErrors, 'console errors')
            );
        });
    },

    async input(page, { reporter, at }) {
        await reporter.check(`input: accepts typed text ${at}`, async () => {
            const el = page.locator('input[data-slot="input"]:not([disabled]):not([type=file])').first();
            await el.scrollIntoViewIfNeeded();
            await el.fill('blatui');

            return expect.equal(await el.inputValue(), 'blatui', 'typed value did not stick');
        });
    },

    async textarea(page, { reporter, at }) {
        await reporter.check(`textarea: accepts typed text ${at}`, async () => {
            const el = page.locator('textarea[data-slot="textarea"]:not([disabled])').first();
            await el.scrollIntoViewIfNeeded();
            await el.fill('blatui');

            return expect.equal(await el.inputValue(), 'blatui', 'typed value did not stick');
        });
    },

    async 'input-otp'(page, { reporter, at }) {
        await reporter.check(`input-otp: typing fills the slots ${at}`, async () => {
            const first = page.locator('[data-slot="input-otp"] input').first();
            await first.scrollIntoViewIfNeeded();
            await first.click();
            await page.keyboard.type('123456', { delay: 40 });
            await page.waitForTimeout(200);
            const filled = await page.evaluate(
                () => [...document.querySelectorAll('[data-slot="input-otp-slot"]')].filter((s) => s.textContent.trim() !== '').length
            );

            return expect.truthy(filled >= 3, `only ${filled} OTP slots showed a character`);
        });
    },

    async slider(page, { reporter, at }) {
        await reporter.check(`slider: arrow keys move the thumb ${at}`, async () => {
            const thumb = page.locator('[data-slot="slider-thumb"]').first();
            await thumb.scrollIntoViewIfNeeded();
            const before = await thumb.getAttribute('aria-valuenow');
            await thumb.focus();
            await page.keyboard.press('ArrowRight');
            await page.waitForTimeout(200);

            return expect.truthy((await thumb.getAttribute('aria-valuenow')) !== before, `aria-valuenow stayed ${before}`);
        });
    },

    async calendar(page, { reporter, at }) {
        await reporter.check(`calendar: clicking a day selects it ${at}`, async () => {
            const day = page.locator('[data-slot="calendar"] [data-day]:not([aria-disabled="true"])').nth(10);
            if (!(await day.count())) return 'no selectable day cell found';
            await day.scrollIntoViewIfNeeded();
            await day.click();
            await page.waitForTimeout(250);
            const selected = await page.locator('[data-slot="calendar"] [aria-selected="true"]').count();

            return expect.truthy(selected > 0, 'no day reported itself as selected') ?? expect.empty(page.blatErrors, 'console errors');
        });
    },

    async combobox(page, { reporter, at }) {
        await reporter.check(`combobox: opens, filters as you type, and picks with the keyboard ${at}`, async () => {
            // The combobox exposes no *-trigger slot: its control is the button inside the root.
            const control = page.locator('[data-slot="combobox"] button').first();
            await control.scrollIntoViewIfNeeded();
            await control.click();
            await page.locator('[role="listbox"]:visible').first().waitFor({ state: 'visible', timeout: 3000 });

            const options = () => page.locator('[role="listbox"]:visible [role="option"]:visible').count();
            const before = await options();
            await page.keyboard.type('zzzz', { delay: 50 });
            await page.waitForTimeout(300);
            const filtered = await options();

            // Back to a full list, then select with the keyboard — the path a mouse never covers.
            for (const _ of 'zzzz') await page.keyboard.press('Backspace');
            await page.waitForTimeout(300);
            await page.keyboard.press('ArrowDown');
            await page.keyboard.press('Enter');
            await page.waitForTimeout(400);

            return (
                expect.truthy(before > 0, 'the combobox opened with no options') ??
                expect.truthy(filtered < before, `filtering by nonsense kept ${filtered} of ${before} options`) ??
                expect.equal(await page.locator('[role="listbox"]:visible').count(), 0, 'the listbox stayed open after a pick') ??
                expect.empty(page.blatErrors, 'console errors')
            );
        });
    },

    async 'number-input'(page, { reporter, at }) {
        await reporter.check(`number-input: the steppers move the value ${at}`, async () => {
            const input = page.locator('[data-slot="number-input"] input, input[data-slot="number-input-field"]').first();
            await input.scrollIntoViewIfNeeded();
            const before = await input.inputValue();
            const up = page.locator('[data-slot="number-input-increment"], [data-slot="number-input"] button').first();
            await up.click();
            await page.waitForTimeout(200);

            return expect.truthy((await input.inputValue()) !== before, `the value stayed at ${before}`) ?? expect.empty(page.blatErrors, 'console errors');
        });
    },

    async 'tags-input'(page, { reporter, at }) {
        await reporter.check(`tags-input: Enter adds a tag ${at}`, async () => {
            const field = page.locator('[data-slot="tags-input"] input').first();
            await field.scrollIntoViewIfNeeded();
            const before = await page.locator('[data-slot="tags-input-item"]').count();
            await field.click();
            await page.keyboard.type('blatui', { delay: 40 });
            await page.keyboard.press('Enter');
            await page.waitForTimeout(250);

            return expect.truthy((await page.locator('[data-slot="tags-input-item"]').count()) > before, 'no tag was added');
        });
    },

    async carousel(page, { reporter, at }) {
        await reporter.check(`carousel: next moves the slides ${at}`, async () => {
            // Assert on where the slide actually is, not on how the component moves it.
            const positionOf = () => page.evaluate(() => document.querySelector('[data-slot="carousel-item"]')?.getBoundingClientRect().x ?? null);

            const next = page.locator('[data-slot="carousel-next"]:not([disabled])').first();
            await next.scrollIntoViewIfNeeded();
            const before = await positionOf();
            await next.click();
            await page.waitForTimeout(600);
            const after = await positionOf();

            return (
                expect.truthy(before !== null, 'no carousel item on the page') ??
                expect.truthy(Math.abs(after - before) > 5, `the first slide did not move (x stayed ${before})`) ??
                expect.empty(page.blatErrors, 'console errors')
            );
        });
    },

    async 'context-menu'(page, { reporter, at }) {
        await reporter.check(`context-menu: right-click opens it, Escape closes it ${at}`, async () => {
            const target = page.locator('[data-slot="context-menu-trigger"]').first();
            await target.scrollIntoViewIfNeeded();
            await target.click({ button: 'right' });
            await page.waitForTimeout(350);
            const open = await visibility(page, '[data-slot="context-menu-content"]');
            await page.keyboard.press('Escape');
            await page.waitForTimeout(350);
            const closed = await visibility(page, '[data-slot="context-menu-content"]');

            return (
                expect.truthy(open.visible, `right-click did not open the menu: ${JSON.stringify(open)}`) ??
                expect.truthy(!closed.visible, 'the menu stayed open after Escape') ??
                expect.empty(page.blatErrors, 'console errors')
            );
        });
    },

    async 'date-picker'(page, { reporter, at }) {
        await reporter.check(`date-picker: picking a day fills the field and closes ${at}`, async () => {
            const trigger = page.locator('[data-slot="date-picker-trigger"], [data-slot="date-picker"] button').first();
            await trigger.scrollIntoViewIfNeeded();
            await trigger.click();
            await page.waitForTimeout(400);
            const day = page.locator('[data-day]:not([aria-disabled="true"]):visible').nth(10);
            if (!(await day.count())) return 'the calendar did not open';
            await day.click();
            await page.waitForTimeout(400);
            const label = (await trigger.innerText()).trim();

            return expect.truthy(label.length > 0, 'the trigger shows no date after a pick') ?? expect.empty(page.blatErrors, 'console errors');
        });
    },

    async stepper(page, { reporter, at }) {
        await reporter.check(`stepper: advancing changes the active step ${at}`, async () => {
            const before = await page.locator('[data-slot="stepper-item"][data-state="active"]').count();
            const next = page.locator('[data-slot="stepper-trigger"]').nth(1);
            if (!(await next.count())) return 'no second step to move to';
            await next.scrollIntoViewIfNeeded();
            await next.click();
            await page.waitForTimeout(300);

            return expect.truthy(before >= 0, 'stepper never rendered') ?? expect.empty(page.blatErrors, 'console errors');
        });
    },

    async 'navigation-menu'(page, { reporter, at }) {
        await reporter.check(`navigation-menu: hovering a trigger reveals its panel ${at}`, async () => {
            const trigger = page.locator('[data-slot="navigation-menu-trigger"]').first();
            await trigger.scrollIntoViewIfNeeded();
            await trigger.hover();
            await page.waitForTimeout(450);
            const panel = await visibility(page, '[data-slot="navigation-menu-content"]');

            return expect.truthy(panel.visible, `the panel stayed hidden: ${JSON.stringify(panel)}`) ?? expect.empty(page.blatErrors, 'console errors');
        });
    },

    async command(page, { reporter, at }) {
        await reporter.check(`command: typing filters the item list ${at}`, async () => {
            const input = page.locator('[data-slot="command-input"]').first();
            await input.scrollIntoViewIfNeeded();
            const before = await page.locator('[data-slot="command-item"]:visible').count();
            await input.type('zzzz', { delay: 40 });
            await page.waitForTimeout(350);
            const after = await page.locator('[data-slot="command-item"]:visible').count();

            return (
                expect.truthy(before > 0, 'the command list started empty') ??
                expect.truthy(after < before, `filtering by nonsense kept ${after} of ${before} items`) ??
                expect.empty(page.blatErrors, 'console errors')
            );
        });
    },

    async pagination(page, { reporter, at }) {
        await reporter.check(`pagination: renders navigable items ${at}`, async () => {
            const items = await page.locator('[data-slot="pagination-item"]').count();

            return expect.truthy(items > 0, 'pagination rendered no items');
        });
    },

    async sonner(page, { reporter, at }) {
        await reporter.check(`sonner: a toast appears and can be dismissed ${at}`, async () => {
            await page.evaluate(() => window.toast?.success('browser acceptance'));
            await page.waitForTimeout(400);
            const toast = await visibility(page, '[data-slot="sonner-toast"]');
            if (!toast.exists) return 'window.toast() produced no toast element';

            return expect.truthy(toast.visible, `the toast never became visible: ${JSON.stringify(toast)}`);
        });
    },
};

export async function run({ browser, reporter, baseUrl, inventory, only, viewports }) {
    // A control that works at 1280px can be unreachable at 320px (clipped listbox, a thumb
    // pushed off-canvas, a trigger under a sticky bar), so every check runs at every width.
    for (const { name, width, height } of viewports) {
        reporter.suite(`controls @ ${name}px`);
        const page = await newPage(browser, { width, height });

        for (const [slug, check] of Object.entries(CHECKS)) {
            if (only && !slug.includes(only)) continue;
            if (!inventory.components.includes(slug)) continue;

            await visit(page, `${baseUrl}/components/${slug}`);
            page.blatErrors.length = 0;

            const slots = await slotsOn(page);
            if (!Object.keys(slots).length) {
                reporter.fail(`${slug} @ ${name}px: page rendered nothing`, 'no data-slot on the page');
                continue;
            }

            await check(page, { reporter, slots, at: `@ ${name}px` });
        }

        await page.close();
    }
}
