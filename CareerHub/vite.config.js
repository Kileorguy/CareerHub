import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    preview: {
        port: 3000,
      },
    server: {
        
        hmr: {
            host: 'localhost',
            port: 4173,
        },
        host: '0.0.0.0',
        port: 4173,
    },
    
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
