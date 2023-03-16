/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./views/*.{html,js}', './components/*.{html,js}'],
  future: {
  },
  theme: {
    body: {
      margin: 0,
    },
    container: {
      center: true,
    },
    fontFamily: {
      bold: ['nunito', 'sans-serif'],
      medium: ['nunito', 'sans-serif'],
    },
  },
  variants: {},
  plugins: [],
};
