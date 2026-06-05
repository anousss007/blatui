import Alpine from 'alpinejs';
import { registerBlatUI } from './blatui-core.js';

// Greenfield bootstrap: wire BlatUI into a fresh Alpine instance and start it.
// If the app already runs its own Alpine, this is a no-op — instead import
// { registerBlatUI } from './blatui-core.js' and call it before your Alpine.start().
if (!window.Alpine) {
    registerBlatUI(Alpine);
    window.Alpine = Alpine;
    Alpine.start();
}
