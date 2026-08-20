/*
 * The PUBLISHED bootstrap, verbatim — the one `blatui:init` writes to resources/js/blatui.js and
 * that get-started tells you to `import "./blatui.js"`.
 *
 * This entry exists to answer a question the other one cannot: what happens to a user who follows
 * get-started, gets a self-starting Alpine, and then installs Livewire — which brings its own
 * Alpine and starts it too. The docs cover "already running Alpine? don't import blatui.js", but
 * the Livewire page never says that Livewire *is* an Alpine you are already running, so this is
 * the configuration a reader lands in by following both pages in order.
 *
 * The `if (!window.Alpine)` guard is the whole experiment: whether it fires depends on script
 * ordering between a deferred Vite module and Livewire's own tag, which is not something to
 * reason about from the source.
 */
import Alpine from 'alpinejs';
import { registerBlatUI } from '../../../demo/resources/js/blatui-core.js';

document.addEventListener('alpine:init', () => registerBlatUI(window.Alpine));

if (!window.Alpine) {
    window.Alpine = Alpine;
    Alpine.start();
}
