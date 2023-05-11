// webpack.mix.js

const mix = require('laravel-mix');

// mix.js('src/app.js', 'dist').setPublicPath('dist');

mix.js("resources/js/app.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [
     require("tailwindcss"),
    ])
    .postCss('resources/css/forum.css', 'public/css')
    .postCss('resources/css/post-show.css', 'public/css');