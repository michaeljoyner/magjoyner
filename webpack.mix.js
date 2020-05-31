let mix = require("laravel-mix");
let tailwindcss = require("tailwindcss");
require("laravel-mix-jigsaw");

mix.disableSuccessNotifications();
mix.setPublicPath("source/assets/build");

mix
  .jigsaw()
  .js("source/_assets/js/main.js", "js")
  .less("source/_assets/less/main.less", "css")
  .options({
    postCss: [tailwindcss("tailwind.js")],
  })
  .version();
