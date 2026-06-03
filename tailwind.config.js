import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
            extend: {
                fontFamily: {
                    sans:    ['DM Sans', 'ui-sans-serif', 'system-ui'],
                    display: ['Syne', 'ui-sans-serif'],
                },
                colors: {
                    slate: {
                        850: '#172033',
                        950: '#0b1120',
                    },
                },
                scrollbar: ['rounded'],
            },
        },
        plugins: [
            require('@tailwindcss/forms'),
            require('@tailwindcss/typography'),
        ],
}

