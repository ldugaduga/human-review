/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./*.php', './template-parts/**/*.php'],
  theme: {
    extend: {
      colors: {
        orange: {
          DEFAULT: '#FF6D18',
          600: '#F0610E',
        },
        ink: '#12141C',
        surface: '#F3F4F9',
      },
      fontFamily: {
        display: ['"Onest"', 'sans-serif'],
        sans: ['"Onest"', 'sans-serif'],
      },
    },
  },
  plugins: [],
};
