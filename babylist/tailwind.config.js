const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                'primair': '#F08080',
                'primair-hover': '#FC725D',
                'light-pink': '#FCD5CE',
                'light-yellow': '#FFF7E5',
                'orange-yellow': '#FBE4B9',
                'light-orange': '#FFF4EC',
                'light-blue': '#A6C8FF',
            },

            gridTemplateColumns: {
                '3-odd-divided': '1fr 5fr 1fr',
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
