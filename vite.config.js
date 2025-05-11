import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 
                    'resources/js/app.js', 
                    'resources/js/theme.js', 
                    'resources/js/home.js',
                    'resources/js/enroll.js',
                    'resources/js/login.js',
                    'resources/js/sidebar.js'],
            refresh: [`resources/views/**/*`],
        }),
        tailwindcss(),
    ],
    server: {
        cors: true,
    },
});