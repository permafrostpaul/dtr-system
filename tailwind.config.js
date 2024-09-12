import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                spectral: ["Spectral SC", "serif"],
                sarala: ["Sarala", "sans-serif"],

            },
            colors: {
                "custom-blue": "#1e3d77",
                "custom-orange": "#c05437",
                "custom-gray": "#99a0a5",
                "body-blue": "#395995",
                "custom-white": "#f9fafb",
                "custom-white1": "#E5F3FD"
            },
        },
    },

    plugins: [forms],
};