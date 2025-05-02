import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import path from 'path';
import pkg from './package.json';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/admin/css/app.css',
                'resources/assets/frontend/css/app.css',
                'resources/assets/admin/js/app.js',
                'resources/assets/admin/js/components/image-previews.js',
                'resources/assets/frontend/js/app.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],

    resolve: {
        alias: {
            '@livewire': path.resolve(__dirname, 'vendor/livewire/livewire/dist/livewire.esm')
        },
    },

    optimizeDeps: {
        include: Object.keys(pkg.dependencies),
    },

    build: {
        minify: true,
        sourcemap: "hidden",
        chunkSizeWarningLimit: 2000, //2MB
        rollupOptions: {
            output: {
                dynamicImportInCjs: true,
                compact: true,
                manualChunks: {
                    core: ['axios', '@livewire'],
                    tinymce: ['tinymce'],
                }
            }
        }
    }
});
