import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/style.css',
                'resources/css/style-rtl.css',
                'resources/css/course.css',
                'resources/css/course-rtl.css',
                'resources/css/animate.css',
                'resources/css/exam.css',
                'resources/css/LineIcons.2.0.css',
                'resources/js/app.js',
                'resources/js/main.js',
                'resources/js/wow.min.js',
                'resources/js/responsive_sidebar.js',
                'resources/js/exam.js',
            ],
            refresh: true,
        }),
    ],
});
