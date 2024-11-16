/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    theme: {

        extend: {
            keyframes: {
                'slide-left': {
                    '0%': { transform: 'translateX(140%)' },
                    '100%': { transform: 'translateX(0%)' }
                },

                'slide-right': {
                    '0%': { transform: 'translateX(-140%)' },
                    '100%': { transform: 'translateX(0%)' }
                },
            },

            animation: {
                'slide-left': 'slide-left 1s cubic-bezier(0.36, 0, 0.23, 1) forwards',
                'slide-right': 'slide-right 1s cubic-bezier(0.36, 0, 0.23, 1) forwards',
            },

            backgroundPosition: {
                'pos-0': '0% 0%',
                'pos-100': '100% 100%',
            },

            backgroundSize: {
                'size-200': '200% 200%',
            },
            colors: {
                'white-100' : '#fefefe',
            },
        },
        listStyleType: {
            none: 'none',
            disc: 'disc',
            decimal: 'decimal',
            square: 'square',
            roman: 'upper-roman',
        }
    },
    plugins: [],
}


