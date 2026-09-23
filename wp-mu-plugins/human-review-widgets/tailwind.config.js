/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./*.php', './widgets/**/*.php'],
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
        mono: ['"JetBrains Mono"', 'monospace'],
      },
      screens: {
        // Dedicated breakpoint for the header's desktop-nav/hamburger
        // toggle, separate from Tailwind's shared `md` (768px) used
        // elsewhere for unrelated layouts (e.g. the team grid).
        nav: '770px',
      },
    },
  },
  plugins: [],
};
