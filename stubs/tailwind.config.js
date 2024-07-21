/** @type {import('tailwindcss').Config} */
export default {
    content: [
        // You will probably also need these lines
        "./resources/**/**/*.blade.php",
        "./resources/**/**/*.js",
        "./app/View/Components/**/**/*.php",
        "./app/Livewire/**/**/*.php",

        // Add mary
        "./vendor/kaufy-ag/mary/src/View/Components/**/*.php"
    ],
    theme: {
        extend: {},
    },

    // Add daisyUI
    plugins: [require("daisyui")]
}
