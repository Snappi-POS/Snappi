import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        chunkSizeWarningLimit: 1000,
        rollupOptions: {
            output: {
                manualChunks: {
                    // Separate vendor libraries into their own chunks
                    'vendor-charts': ['apexcharts'],
                    'vendor-ui': ['sweetalert2', 'flowbite'],
                    'vendor-utils': ['pikaday'],
                },
            },
        },
    },
    optimizeDeps: {
        include: ['flowbite', 'apexcharts', 'sweetalert2', 'pikaday']
    }
});
