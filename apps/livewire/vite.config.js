import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/greenfield.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    // The entry points import the demo's authored css/js by relative path, which sits outside
    // this app's root. Vite's dev server refuses to serve files it has not been told about.
    server: {
        fs: { allow: ['..'] },
        watch: { ignored: ['**/storage/framework/views/**'] },
    },
    // blatui-core.js is resolved from apps/demo, so a bare `@alpinejs/focus` inside it would
    // resolve against apps/demo/node_modules if that happens to exist — a second copy of a
    // plugin, silently. Pin every shared dependency to THIS app's install.
    resolve: {
        dedupe: ['alpinejs', '@alpinejs/anchor', '@alpinejs/collapse', '@alpinejs/focus', '@floating-ui/dom'],
    },
});
