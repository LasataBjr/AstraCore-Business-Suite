import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './app/View/Components/**/*.php',
        './app/Http/Controllers/**/*.php',
    ],

    theme: {
            extend: {
                fontFamily: {
                    sans:    ['"DM Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    display: ['"Syne"',    'ui-sans-serif', 'sans-serif'],
                    mono:    ['"JetBrains Mono"', 'ui-monospace', 'monospace'],
                },
                colors: {
                    navy: {
                        50:  '#f0f4ff',
                        100: '#dde6ff',
                        200: '#c3d1ff',
                        300: '#9db0ff',
                        400: '#7485ff',
                        500: '#5560f8',
                        600: '#4340ed',
                        700: '#3730d1',
                        800: '#2e28a9',
                        850: '#1f1d7a',   // custom stop used in sidebar
                        900: '#1a2235',   // main sidebar bg color
                        950: '#111827',
                    },

                    slate: {
                        850: '#172033',
                        950: '#0b1120',
                    },
                },
                scrollbar: ['rounded'],

                borderRadius: {
                    '2xl': '1rem',
                    '3xl': '1.5rem',
                },

                boxShadow: {
                    'card':     '0 1px 3px 0 rgb(0 0 0 / 0.05), 0 1px 2px -1px rgb(0 0 0 / 0.05)',
                    'card-md':  '0 4px 6px -1px rgb(0 0 0 / 0.07), 0 2px 4px -2px rgb(0 0 0 / 0.07)',
                    'card-lg':  '0 10px 15px -3px rgb(0 0 0 / 0.07), 0 4px 6px -4px rgb(0 0 0 / 0.07)',
                    'dropdown': '0 10px 25px -3px rgb(0 0 0 / 0.10), 0 4px 6px -4px rgb(0 0 0 / 0.08)',
                },

                transitionDuration: {
                    DEFAULT: '150ms',
                },

                screens: {
                    '2xl': '1400px',
                    '3xl': '1800px',
                },

                spacing: {
                    '4.5': '1.125rem',
                    '13':  '3.25rem',
                    '15':  '3.75rem',
                    '18':  '4.5rem',
                },
 
            },
        },
        plugins: [
            require('@tailwindcss/forms')({
                strategy: 'class', // use .form-input etc. to avoid global overrides
            }),
            
            require('@tailwindcss/typography'),
        ],
}

