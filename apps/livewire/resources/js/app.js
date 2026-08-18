/*
 * BlatUI on Livewire's Alpine.
 *
 * Livewire 4 bundles Alpine and starts it itself, so this app must NOT import or start its
 * own — two Alpines walking the same tree is a different bug than the ones we are here to
 * catch. `alpine:init` is dispatched by Livewire before it calls Alpine.start(), which is
 * exactly the window where directives, magics and plugins have to be registered.
 *
 * This is also the reason the app exists: apps/demo stubs `$wire` with a no-op proxy because
 * it has no Livewire runtime, so nothing there ever produces a morph. Here the runtime is
 * real and every re-render walks the DOM for real.
 */
import { registerBlatUI } from '../../../demo/resources/js/blatui-core.js';

document.addEventListener('alpine:init', () => {
    registerBlatUI(window.Alpine);
});
