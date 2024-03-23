const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        colors: {
            next:{
                50: '##c3ffff',
                100: '#a6ffff',
                200: '#7dffff',
                300: '#53ffff',
                400: '#26ffff',
                500: '#0fb9b9',
                600: '#0c8e8e',
                700: '#0a6363',
                800: '#084848',
                900: '#052d2d',
            },
            gray: {
                50: '#f9fafb',
                100: '#f4f5f7',
                200: '#e5e7eb',
                300: '#d2d6dc',
                400: '#9fa6b2',
                500: '#6b7280',
                600: '#4b5563',
                700: '#374151',
                800: '#252f3f',
                900: '#161e2e',
            },
            white: '#ffffff',
            red: {
                50: '#fdf2f2',
                100: '#fde8e8',
                200: '#fbd5d5',
                300: '#f8b4b4',
                400: '#f98080',
                500: '#f05252',
                600: '#e02424',
                700: '#c81e1e',
                800: '#9b1c1c',
                900: '#771d1d',
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
