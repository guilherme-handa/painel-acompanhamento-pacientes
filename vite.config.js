import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: '192.168.1.5', // seu IP local
        port: 5173, // porta do Vite
        hmr: {
            host: '192.168.1.5', // importante para hot reload funcionar remotamente
        },
    },
});