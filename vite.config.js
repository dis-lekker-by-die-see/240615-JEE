// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: [
//                 'resources/css/app.css',
//                 'resources/js/app.js',
//             ],
//             refresh: true,
//         }),
//     ],
// });

// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: [
//                 'resources/css/app.css',
//                 'resources/js/app.js',
//             ],
//             refresh: true,
//         }),
//     ],
//     server: {
//         watch: {
//             usePolling: true,
//             interval: 300,
//         },
//         host: '0.0.0.0',
//         port: 5173,
//     },
// });


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
    server: {
        watch: {
            usePolling: true,
            interval: 300,
        },
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: '13.208.182.103', // Replace with your EC2 public IP or domain
            port: 5173,
        },
    },
});
