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

               md: { min: "768px", max: "1024px" },
               // => @media (min-width: 768px) { ... }

               lg: { min: "1054px", max: "1279px" },
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
