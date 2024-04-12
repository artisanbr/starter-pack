/** @type {import('tailwindcss').Config} */
const defaultTheme = require("tailwindcss/defaultTheme.js");
const colors = require('tailwindcss/colors');
const forms = require("@tailwindcss/forms");
module.exports = {
    content: [
        //StarterPack and Dependency's
        "./src/**/*.php",
        "./resources/views/**/*.blade.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['"Poppins"', ...defaultTheme.fontFamily.sans],
                serif: ['"Noto Serif"', ...defaultTheme.fontFamily.serif],
                mono: ['"Noto Sans Mono"', ...defaultTheme.fontFamily.mono],
                /*openSans: ['"Open Sans"', ...defaultTheme.fontFamily.sans],
                poppins: ['"Poppins"', ...defaultTheme.fontFamily.sans],

                noto: ['"Noto Sans"', ...defaultTheme.fontFamily.sans],
                notoSerif: ['"Noto Serif"', ...defaultTheme.fontFamily.serif],
                notoMono: ['"Noto Sans Mono"', ...defaultTheme.fontFamily.mono],
                notoEmoji: ['"Noto Color Emoji"', ...defaultTheme.fontFamily.sans],

                roboto: ['"Roboto"', ...defaultTheme.fontFamily.sans],
                robotoSerif: ['"Roboto Serif"', ...defaultTheme.fontFamily.serif],
                robotoMono: ['"Roboto Mono"', ...defaultTheme.fontFamily.mono],*/
                fira: ['"Fira Code"', ...defaultTheme.fontFamily.sans],
                figtree: ['figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                blue: colors.teal, // Adiciona a cor "teal" com o código hexadecimal desejado

                /*inherit: colors.inherit,
                current: colors.current,
                transparent: colors.transparent,

                stone: colors.stone,
                teal: colors.teal,
                emerald: colors.emerald,*/
            }
        },
    },
    darkMode: 'class',
    daisyui: {
        themes: [
            {
                light: {
                    //...require("daisyui/src/theming/themes")["light"],
                    "primary": "#4CC7A9",
                    "secondary": colors.stone['800'],
                    "accent": "#C7FCEB",
                    "neutral": colors.stone['400'],
                    "base-100": colors.stone['50'],
                    "info": "#06b6d4",
                    "success": "#22c55e",
                    "warning": "#eab308",
                    "error": "#e11d48",

                    "--fallback-pc": "#FFF",
                    "--fallback-nc": "#FFF",

                },
            },
            {
                dark: {
                    //...require("daisyui/src/theming/themes")["dark"],
                    "primary": "#4CC7A9",
                    "secondary": colors.stone['50'],
                    "accent": "#C7FCEB",
                    "neutral": colors.stone['500'],
                    "base-100": colors.stone['900'],//"#292524",
                    "info": "#67e8f9",
                    "success": "#22c55e",
                    "warning": "#fef08a",
                    "error": "#e11d48",


                },
            }
        ],
        //darkTheme: "spDark",

    },
    //plugins: [forms, require("@tailwindcss/typography"), require("daisyui")],
};
