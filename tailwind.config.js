import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                // Colores Trama Educativa
                'trama': {
                    'red': '#C84347',
                    'red-dark': '#A83539',
                    'red-light': '#E85A5E',
                },
                'dark': {
                    'primary': '#1A1A2E',
                    'secondary': '#16213E',
                    'accent': '#0F3460',
                },
                'light': {
                    'primary': '#FFFFFF',
                    'secondary': '#F5F5F5',
                    'accent': '#E8E8E8',
                },
            },
            fontFamily: {
                sans: ['Inter', 'Roboto', ...defaultTheme.fontFamily.sans],
                heading: ['Montserrat', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                'body': ['1rem', { lineHeight: '1.6' }],
                'body-lg': ['1.125rem', { lineHeight: '1.7' }],
            },
        },
    },
    plugins: [],
};
