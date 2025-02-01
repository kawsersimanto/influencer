import forms from "@tailwindcss/forms";
import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/views/*.blade.php",
    ],

    theme: {
        extend: {
            colors: {
                main: "#fdd3ae",
            },
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                agrandir: ["agrandir-regular"],
            },
            backgroundImage: {
                "sunset-gradient":
                    "linear-gradient(135deg, #F7BEA4, #F49C8E, #F07575)",
                "peach-gold-gradient":
                    "linear-gradient(135deg, #F7BEA4, #FFD699)",
            },
            boxShadow: {
                "light-shadow": "rgba(120, 120, 170, 0.15) 0 2px 16px 0",
            },
        },
    },

    plugins: [forms],
};
