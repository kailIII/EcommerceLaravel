var elixir = require('laravel-elixir');
process.env.DISABLE_NOTIFIER = true;
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

	mix.styles([
		'bootstrap.min.css',
		'font-awesome.min.css',
		'prettyPhoto.css',
		'animate.css',
		'responsive.css',
		'spinner.css',
		'main.css'
	], 'public/css/all.css');

	mix.scripts([
		'jquery.js',
		'bootstrap.min.js',
		'jquery.scrollUp.min.js',
		'price-range.js',
		'jquery.prettyPhoto.js',
		'main.js',
		'spinner.js'
	], 'public/js/all.js');

	mix.version([
		'css/all.css',
		'js/all.js'
	]);

	mix.copy('resources/assets/fonts','public/build/fonts');

});
