import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import './bootstrap';
import '../css/app.css'; 

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
    ],
});
