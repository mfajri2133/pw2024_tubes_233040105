/** @type {import('tailwindcss').Config} */
module.exports = {
     content: [
          "./views/**/*.{html,js,php}",
          "./views/*.{html,js,php}",
          "./template/*.{html,js,php}",
          "./node_modules/flowbite/**/*.js",
     ],
     theme: {
          screens: {
               sm: { max: "640px" },

               md: "768px",
               // => @media (min-width: 768px) { ... }

               lg: "1024px",
               // => @media (min-width: 1024px) { ... }

               xl: "1280px",
               // => @media (min-width: 1280px) { ... }
          },
     },
     plugins: [
          require("@tailwindcss/forms"),
          require("@tailwindcss/typography"),
          require("flowbite/plugin"),
     ],
};
