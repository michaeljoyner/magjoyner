module.exports = {
  purge: ["./source/**/*.html", "./source/**/*.vue", "./source/**/*.blade.php"],
  theme: {
    fontFamily: {
      display: ["Montserrat", "sans-serif"],
      body: ["Montserrat", "serif"],
    },
    extend: {
      colors: {
        black: "#262525",
        sunset: "#d34f37",
      },
      fontSize: {},
      width: {
        80: "20rem",
        100: "25rem",
        contained: "1200px",
      },
    },
  },
  variants: {},
  plugins: [],
};
