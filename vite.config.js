import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/common.js',
                'resources/js/form_temas.js',
                'resources/js/temas.js',
                'resources/js/form_users.js',
                'resources/css/app.css',
                'resources/css/login.css',
                'resources/css/pdf.css',
                'resources/css/table_docen.css',
                'resources/css/estudiantes.css',
            ],
            refresh: true,
        }),
    ],
});
