const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig(webpack => {
    return {
        resolve: {
            modules: [
                path.resolve(__dirname, "node_modules"),
                path.resolve(__dirname, "resources/js")
            ],
            alias: {
                "@": path.resolve(__dirname, "resources/js"),
                "lodash": "lodash-es"
            }
        }
    }
});

mix.js("resources/js/app.js", 'public/js')
    .sass("resources/sass/app.scss", 'public/css')
    .disableNotifications()
    .extract(
        [
            "vue",
            "axios",
            "vue-router",
            "vuex",
            "lodash-es",
            "vue-cookie"
        ],
        "js/vendor.js"
    )
    .sourceMaps();

if (mix.inProduction()) {
    mix.version();
}

