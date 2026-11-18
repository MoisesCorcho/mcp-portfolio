/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    safelist: [
        // Alpine.js dynamic filter-tab classes
        'filter-tab',
        'active',
    ],
    theme: {
        extend: {
            fontFamily: {
                display: ['Syne', 'sans-serif'],
                body: ['DM Sans', 'sans-serif'],
                mono: ['"JetBrains Mono"', 'ui-monospace', 'SFMono-Regular', 'Menlo', 'Monaco', 'Consolas', 'monospace'],
                oxanium: ['"Oxanium"', 'sans-serif'],
                'roboto-mono': ['"Roboto Mono"', 'ui-monospace', 'monospace'],
            },
            colors: {
                amber: {
                    400: '#fbbf24',
                    500: '#f59e0b',
                },
                canvas: '#07090e',
                chamber: '#090c14',
                card: '#080b11',
                floor: '#06080e',
                void: '#020617',
            },
            backdropBlur: {
                xs: '2px',
            },
        },
    },
    plugins: [require("tailgrids/plugin")],
}
