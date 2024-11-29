import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/main.js',
                'resources/sass/main.sass'
            ],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            assetsInclude: ['resources/images/**/*.svg'], // Включаємо SVG файли з resources/images
        },
    },
});
