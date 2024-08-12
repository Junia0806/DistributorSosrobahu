/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './src/**/*.{html,js}',
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
     "./node_modules/flowbite/**/*.js"
  ],
  
  theme: {
    extend: {},
  },
  plugins: [  require('flowbite/plugin')],
}