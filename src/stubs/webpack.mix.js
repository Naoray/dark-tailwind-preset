const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");

require("laravel-mix-purgecss");

mix
  .js("resources/js/app.js", "js")
  .sass("resources/sass/app.scss", "css")
  .options({
    processCssUrls: false,
    postCss: [tailwindcss("./tailwind.config.js")]
  })
  .purgeCss()
  .version()
  .copyDirectory("resources/img", "public/img");
