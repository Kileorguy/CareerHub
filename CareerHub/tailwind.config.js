/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'primary': 'var(--primary)',
                'input-border': 'var(--input-border)',
                'input-label': 'var(--input-label)',
                'background': 'var(--background)',
                'foreground': 'var(--foreground)',
                'main-text': 'var(--main-text)',
                'sub-text': 'var(--sub-text)',
                'border-light': 'var(--border-light)',
            },
        },
    },
    plugins: [
        require('daisyui'),
    ],
    daisyui: {
        themes: [
            {
                theme: {
                    "primary": "#9747FF",
                    "secondary": "#f6d860",
                    "accent": "#37cdbe",
                    "neutral": "#3d4451",
                    "base-100": "#ffffff",
                }
            },
        ]
    },
}
