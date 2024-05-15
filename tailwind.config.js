/** @type {import('tailwindcss').Config} */

export default {
    content: ["./resources/**/*.{html,js,vue}"],
    theme: {
        extend: {
            colors: {
                "pb-yellow": "#FFD700",
                "pb-yellow-dark": "#ffe34d",
                "pb-green": "#21b06c",
                "pb-marine": "#006b7c",
                "pb-sand": "#fff0ca",
                "pb-light-sand": "#fff9ea",
                "pb-dark-green": "#005246",
                "pb-succes-green": "#92c400",
                "pb-error-red": "#bf5748",
                "pb-soft-green": "#90b6a5",
                "pb-dark-red": "#a70000",
                "pb-soft-red": "#fc8c78",
                "pb-soft-grey": "#4b5563",
                "pb-light-grey": "#f8f8f8",
                "pb-dark-grey": "#22272d",
            },
            container: {
                padding: "2rem",
                center: true,
            },
            fontFamily: {
                sans: ["Quicksand", "Sans-serif"],
            },
        },
    },
    plugins: [],
};
