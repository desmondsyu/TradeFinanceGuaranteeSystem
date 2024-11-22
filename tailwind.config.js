/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './resources/**/*.jsx', // If using React
        './resources/**/*.tsx', // If using TypeScript
        './resources/**/*.svelte', // If using Svelte
    ],
    theme: {
        extend: {
            colors: {
                primary: '#1E3A8A', // Custom primary color (blue)
                secondary: '#1E40AF', // Custom secondary color (darker blue)
                accent: '#10B981', // Custom accent color (green)
            },
            spacing: {
                128: '32rem',
                144: '36rem',
            },
            borderRadius: {
                '4xl': '2rem',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'), // Adds styles for form elements
        require('@tailwindcss/typography'), // Adds better typography defaults
    ],
};
