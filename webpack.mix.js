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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')

    /**script */
    .scripts('resources/view/js/image.js', 'public/js/image.js')
    
    /**css Welcome */
    .styles([
        'resources/css/reset.css',
        'resources/css/welcome.css'
    ], 'public/css/welcome.css')
    .version()

    /**css Main */
    .styles([
        'resources/css/app.css', /**css app */
        'resources/css/login.css', /**css login */
        'resources/css/register.css', /**css register */
        'resources/css/perfil.css', /**css register */
        'resources/css/editUser.css', /**css register */
        'resources/css/cadastro_receita.css', /**css cadastro da receita */
        'resources/css/pesquisa.css', /**css pesquisa */
        'resources/css/home.css' /**css home */
    ], 'public/css/main.css')
    .version()

    ;
