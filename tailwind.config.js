/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            keyframes: {
                'slide-left': {
                    '0%' : {transform: 'translateX(140%)'},
                    '100%' : {transform: 'translateX(0%)'}
                },

                'slide-right': {
                    '0%' : {transform: 'translateX(-140%)'},
                    '100%' : {transform: 'translateX(0%)'}
                },
            },

            animation: {
                'slide-left': 'slide-left 1s cubic-bezier(0.36, 0, 0.23, 1) forwards',
                'slide-right': 'slide-right 1s cubic-bezier(0.36, 0, 0.23, 1) forwards',
            },
        },
    },
    plugins: [],
}


