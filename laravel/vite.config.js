import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        cors: {  
            origin: [  
                'http://10.222.177.133:8000',  
                'http://10.222.177.133:5173',  
                'http://localhost:8000',  
                'http://localhost:5173',  
            ],  

        },  
        hmr: {
            host: '10.222.177.133',
            host: 'localhost',
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
