/**
 * WordPress Theme-specific Gulp file.
 *
 * Instructions
 *
 * In command line, cd into the project directory and run the following two commands:
 * npm init
 * sudo npm install --save-dev gulp gulp-util gulp-load-plugins browser-sync gulp-sourcemaps gulp-autoprefixer gulp-line-ending-corrector gulp-filter gulp-merge-media-queries gulp-cssnano gulp-sass gulp-concat gulp-uglify gulp-notify gulp-imagemin gulp-rename gulp-wp-pot
 *
 * Implements:
 * 			1. Live reloads browser with BrowserSync.
 * 			2. CSS: Sass to CSS conversion, error catching, Autoprixing, Sourcemaps,
 * 				 CSS minification, and Merge Media Queries.
 * 			3. JS: Concatenates & uglifies Vendor and Custom JS files.
 * 			4. Images: Minifies PNG, JPEG, GIF and SVG images.
 * 			5. Watches files for changes in CSS or JS.
 * 			6. Watches files for changes in PHP.
 * 			7. Corrects the line endings.
 *      8. InjectCSS instead of browser page reload.
 *      9. Generates .pot file for i18n and l10n.
 *
 * @since 1.0.0
 * @author Ahmad Awais (@mrahmadawais) and Chris Wilcoxson (@slushman)
 */

/**
 * Project Configuration for gulp tasks.
 */
// Project related.
var project              = 'mervis-2016'; // Project Name.
var projectURL           = 'mervis.dev'; // Project URL. Could be something like localhost:8888.
var productURL           = './'; // Theme/Plugin URL. Leave as is.

// Translation related.
var text_domain          = 'mervis-2016';
var destFile             = 'mervis-2016.pot';
var package              = 'Mervis_2016';
var bugReport            = 'http://www.dccmarketing.com/contact';
var lastTranslator       = 'Chris Wilcoxson <chrisw@dccmarketing.com>';
var team                 = 'DCC Marketing <web@dccmarketing.com>';
var translatePath        = './assets/languages'

// Public styles
var styleSRC             = './src/sass/style.scss'; // Path to main .scss file.
var styleDestination     = './'; // Path to place the compiled CSS file.

// Login styles
var loginStyleSRC             = './src/sass/login.scss'; // Path to login.scss file.
var loginStyleDestination     = './'; // Path to place the compiled CSS file.

// Admin styles
var adminStyleSRC             = './src/sass/admin.scss'; // Path to admin.scss file.
var adminStyleDestination     = './'; // Path to place the compiled CSS file.

// RTL styles
var rtlStyleSRC             = './src/sass/rtl.scss'; // Path to rtl.scss file.
var rtlStyleDestination     = './'; // Path to place the compiled CSS file.

// JS Vendor related.
var jsVendorSRC          = './src/js/lib/*.js'; // Path to JS vendor folder.
var jsVendorDestination  = './assets/js/'; // Path to place the compiled JS vendors file.
var jsVendorFile         = 'vendors'; // Compiled JS vendors file name.

// JS Public
var jsPublicSRC          = './src/js/public/*.js'; // Path to JS public scripts folder.
var jsPublicDestination  = './assets/js/'; // Path to place the compiled JS public scripts file.
var jsPublicFile         = 'public'; // Compiled JS public file name

// JS Admin
var jsAdminSRC          = './src/js/admin/*.js'; // Path to JS admin scripts folder.
var jsAdminDestination  = './assets/js/'; // Path to place the compiled JS admin scripts file.
var jsAdminFile         = 'admin'; // Compiled JS admin file name.

// JS Customizer
var jsCustomizerSRC          = './src/js/customizer/*.js'; // Path to JS customizer scripts folder.
var jsCustomizerDestination  = './assets/js/'; // Path to place the compiled JS customizer scripts file.
var jsCustomizerFile         = 'customizer'; // Compiled JS customizer file name.

// JS Customizer
var jsCustControlsSRC          = './src/js/customizer-controls/*.js'; // Path to JS customizer scripts folder.
var jsCustControlsDestination  = './assets/js/'; // Path to place the compiled JS customizer scripts file.
var jsCustControlsFile         = 'customizer-controls'; // Compiled JS customizer file name.

// JS Login
var jsLoginSRC          = './src/js/login/*.js'; // Path to JS login scripts folder.
var jsLoginDestination  = './assets/js/'; // Path to place the compiled JS login scripts file.
var jsLoginFile         = 'login'; // Compiled JS login file name.

// Images related.
var imagesSRC            = './assets/images/*.{png,jpg,gif,svg}'; // Source image folder
var imagesDestination    = './assets/images/'; // Destination image folder. Must be different than source.

// Watch files paths.
var styleWatchFiles         = './src/sass/**/*.scss'; // Path to all *.scss files inside css folder and inside them.
var vendorJSWatchFiles      = './src/js/*.js'; // Path to all vendor JS files.
var publicJSWatchFiles      = './src/js/public/*.js'; // Path to all public JS files.
var adminJSWatchFiles       = './src/js/admin/*.js'; // Path to all admin JS files.
var loginJSWatchFiles       = './src/js/login/*.js'; // Path to all login JS files.
var customizerJSWatchFiles 	= './src/js/customizer/*.js'; // Path to all customizer JS files.
var custcontrolsJSWatchFiles 	= './src/js/customizer-controls/*.js'; // Path to all customizer JS files.
var projectPHPWatchFiles    = './*.php'; // Path to all PHP files.

/**
* Load gulp plugins and assing them semantic names.
*/
var gulp 			= require('gulp'); // Gulp of-course
var plugins 		= require('gulp-load-plugins')();
var browserSync 	= require('browser-sync').create(); // Reloads browser and injects CSS.
var reload 			= browserSync.reload; // For manual browser reload.

/**
 * Browsers you care about for autoprefixing.
 */
const AUTOPREFIXER_BROWSERS = [
	'last 2 version',
	'> 1%',
	'ie >= 9',
	'ie_mob >= 10',
	'ff >= 30',
	'chrome >= 34',
	'safari >= 7',
	'opera >= 23',
	'ios >= 7',
	'android >= 4',
	'bb >= 10'
];

/**
 * Live Reloads, CSS injections, Localhost tunneling.
 *
 * @link http://www.browsersync.io/docs/options/
 */
gulp.task( 'browser-sync', function() {
	browserSync.init({
		proxy: projectURL,
		host: projectURL,
		open: 'external',
		injectChanges: true,
		browser: "google chrome"
	});
});

/**
 * Creates style.css.
 */
gulp.task( 'publicStyle', function () {
	gulp.src( styleSRC )
		.pipe( plugins.sourcemaps.init() )
		.pipe( plugins.sass( {
			errLogToConsole: true,
			includePaths: ['./sass'],
			outputStyle: 'compact',
			precision: 10
		} ) )
		.on('error', console.error.bind(console))
		.pipe( plugins.sourcemaps.write( { includeContent: false } ) )
		.pipe( plugins.sourcemaps.init( { loadMaps: true } ) )
		.pipe( plugins.autoprefixer( AUTOPREFIXER_BROWSERS ) )
		.pipe( plugins.sourcemaps.write ( styleDestination ) )
		.pipe( plugins.lineEndingCorrector() )
		.pipe( gulp.dest( styleDestination ) )
		.pipe( plugins.filter( '**/*.css' ) ) // Filtering stream to only css files
		.pipe( plugins.mergeMediaQueries( { log: true } ) ) // Merge Media Queries only for final version.

		.pipe( plugins.cssnano())
		.pipe( plugins.lineEndingCorrector() )
		.pipe( gulp.dest( styleDestination ) )

		.pipe( plugins.filter( '**/*.css' ) ) // Filtering stream to only css files
		.pipe( browserSync.stream() ) // Reloads style.css if that is enqueued.
		.pipe( plugins.notify( { message: 'TASK: "publicStyle" Completed! 💯', onLast: true } ) );
});

/**
 * Creates login.css.
 */
gulp.task( 'loginStyle', function () {
	gulp.src( loginStyleSRC )
		.pipe( plugins.sourcemaps.init() )
		.pipe( plugins.sass( {
			errLogToConsole: true,
			includePaths: ['./sass'],
			outputStyle: 'compact',
			precision: 10
		} ) )
		.on('error', console.error.bind(console))
		.pipe( plugins.sourcemaps.write( { includeContent: false } ) )
		.pipe( plugins.sourcemaps.init( { loadMaps: true } ) )
		.pipe( plugins.autoprefixer( AUTOPREFIXER_BROWSERS ) )
		.pipe( plugins.sourcemaps.write ( loginStyleDestination ) )
		.pipe( plugins.lineEndingCorrector() )
		.pipe( gulp.dest( loginStyleDestination ) )
		.pipe( plugins.filter( '**/*.css' ) ) // Filtering stream to only css files
		.pipe( plugins.mergeMediaQueries( { log: true } ) ) // Merge Media Queries only for final version.

		.pipe( plugins.cssnano())
		.pipe( plugins.lineEndingCorrector() )
		.pipe( gulp.dest( loginStyleDestination ) )

		.pipe( plugins.filter( '**/*.css' ) ) // Filtering stream to only css files
		.pipe( browserSync.stream() ) // Reloads style.css if that is enqueued.
		.pipe( plugins.notify( { message: 'TASK: "loginStyle" Completed! 💯', onLast: true } ) );
});

/**
 * Creates admin.css.
 */
gulp.task( 'adminStyle', function () {
	gulp.src( adminStyleSRC )
		.pipe( plugins.sourcemaps.init() )
		.pipe( plugins.sass( {
			errLogToConsole: true,
			includePaths: ['./sass'],
			outputStyle: 'compact',
			precision: 10
		} ) )
		.on('error', console.error.bind(console))
		.pipe( plugins.sourcemaps.write( { includeContent: false } ) )
		.pipe( plugins.sourcemaps.init( { loadMaps: true } ) )
		.pipe( plugins.autoprefixer( AUTOPREFIXER_BROWSERS ) )
		.pipe( plugins.sourcemaps.write ( adminStyleDestination ) )
		.pipe( plugins.lineEndingCorrector() )
		.pipe( gulp.dest( adminStyleDestination ) )
		.pipe( plugins.filter( '**/*.css' ) ) // Filtering stream to only css files
		.pipe( plugins.mergeMediaQueries( { log: true } ) ) // Merge Media Queries only for final version.

		.pipe( plugins.cssnano())
		.pipe( plugins.lineEndingCorrector() )
		.pipe( gulp.dest( adminStyleDestination ) )

		.pipe( plugins.filter( '**/*.css' ) ) // Filtering stream to only css files
		.pipe( browserSync.stream() ) // Reloads style.css if that is enqueued.
		.pipe( plugins.notify( { message: 'TASK: "adminStyle" Completed! 💯', onLast: true } ) );
});

/**
 * Creates rtl.css.
 */
gulp.task( 'rtlStyle', function () {
	gulp.src( rtlStyleSRC )
		.pipe( plugins.sourcemaps.init() )
		.pipe( plugins.sass( {
			errLogToConsole: true,
			includePaths: ['./sass'],
			outputStyle: 'compact',
			precision: 10
		} ) )
		.on('error', console.error.bind(console))
		.pipe( plugins.sourcemaps.write( { includeContent: false } ) )
		.pipe( plugins.sourcemaps.init( { loadMaps: true } ) )
		.pipe( plugins.autoprefixer( AUTOPREFIXER_BROWSERS ) )
		.pipe( plugins.sourcemaps.write ( rtlStyleDestination ) )
		.pipe( plugins.lineEndingCorrector() )
		.pipe( gulp.dest( rtlStyleDestination ) )
		.pipe( plugins.filter( '**/*.css' ) ) // Filtering stream to only css files
		.pipe( plugins.mergeMediaQueries( { log: true } ) ) // Merge Media Queries only for final version.

		.pipe( plugins.cssnano())
		.pipe( plugins.lineEndingCorrector() )
		.pipe( gulp.dest( rtlStyleDestination ) )

		.pipe( plugins.filter( '**/*.css' ) ) // Filtering stream to only css files
		.pipe( browserSync.stream() ) // Reloads style.css if that is enqueued.
		.pipe( plugins.notify( { message: 'TASK: "rtlStyle" Completed! 💯', onLast: true } ) );
});

/**
 * Concatenate and minify vendor JS scripts.
 */
gulp.task( 'vendorsJs', function() {
	gulp.src( jsVendorSRC )
		.pipe( plugins.concat( jsVendorFile + '.js' ) )
		.pipe( plugins.lineEndingCorrector() )
		.pipe( gulp.dest( jsVendorDestination ) )
		.pipe( plugins.rename( {
			basename: jsVendorFile,
			suffix: '.min'
		}))
		.pipe( plugins.uglify() )
		.pipe( plugins.lineEndingCorrector() )
		.pipe( gulp.dest( jsVendorDestination ) )
		.pipe( plugins.notify( { message: 'TASK: "vendorsJs" Completed! 💯', onLast: true } ) );
});

/**
 * Concatenate and minify public JS scripts.
 */
gulp.task( 'publicJS', function() {
	gulp.src( jsPublicSRC )
		.pipe( plugins.concat( jsPublicFile + '.js' ) )
		.pipe( plugins.lineEndingCorrector() )
		.pipe( gulp.dest( jsPublicDestination ) )
		.pipe( plugins.rename( {
			basename: jsPublicFile,
			suffix: '.min'
		}))
		.pipe( plugins.uglify() )
		.pipe( plugins.lineEndingCorrector() )
		.pipe( gulp.dest( jsPublicDestination ) )
		.pipe( plugins.notify( { message: 'TASK: "publicJS" Completed! 💯', onLast: true } ) );
});

/**
 * Concatenate and minify admin JS scripts.
 */
gulp.task( 'adminJS', function() {
	gulp.src( jsAdminSRC )
		.pipe( plugins.concat( jsAdminFile + '.js' ) )
		.pipe( plugins.lineEndingCorrector() )
		.pipe( gulp.dest( jsAdminDestination ) )
		.pipe( plugins.rename( {
			basename: jsAdminFile,
			suffix: '.min'
		}))
		.pipe( plugins.uglify() )
		.pipe( plugins.lineEndingCorrector() )
		.pipe( gulp.dest( jsAdminDestination ) )
		.pipe( plugins.notify( { message: 'TASK: "adminJS" Completed! 💯', onLast: true } ) );
});

/**
 * Concatenate and minify customizer JS scripts.
 */
gulp.task( 'customizerJS', function() {
	gulp.src( jsCustomizerSRC )
		.pipe( plugins.concat( jsCustomizerFile + '.js' ) )
		.pipe( plugins.lineEndingCorrector() )
		.pipe( gulp.dest( jsCustomizerDestination ) )
		.pipe( plugins.rename( {
			basename: jsCustomizerFile,
			suffix: '.min'
		}))
		.pipe( plugins.uglify() )
		.pipe( plugins.lineEndingCorrector() )
		.pipe( gulp.dest( jsCustomizerDestination ) )
		.pipe( plugins.notify( { message: 'TASK: "customizerJS" Completed! 💯', onLast: true } ) );
});

/**
 * Concatenate and minify customizer control JS scripts.
 */
gulp.task( 'custcontrolsJS', function() {
	gulp.src( jsCustControlsSRC )
		.pipe( plugins.concat( jsCustControlsFile + '.js' ) )
		.pipe( plugins.lineEndingCorrector() )
		.pipe( gulp.dest( jsCustControlsDestination ) )
		.pipe( plugins.rename( {
			basename: jsCustControlsFile,
			suffix: '.min'
		}))
		.pipe( plugins.uglify() )
		.pipe( plugins.lineEndingCorrector() )
		.pipe( gulp.dest( jsCustControlsDestination ) )
		.pipe( plugins.notify( { message: 'TASK: "custcontrolsJS" Completed! 💯', onLast: true } ) );
});

/**
 * Minifies PNG, JPEG, GIF and SVG images.
 */
gulp.task( 'images', function() {
	gulp.src( imagesSRC )
		.pipe( plugins.imagemin({
			progressive: true,
			optimizationLevel: 3, // 0-7 low-high
			interlaced: true,
			svgoPlugins: [{removeViewBox: false}]
		}))
		.pipe( gulp.dest( imagesDestination ) )
		.pipe( plugins.notify( { message: 'TASK: "images" Completed! 💯', onLast: true } ) );
});

/**
 * WP POT Translation File Generator.
 */
gulp.task( 'translate', function () {
	return gulp.src( projectPHPWatchFiles )
		.pipe( sort() )
		.pipe( plugins.wpPot({
			domain        : text_domain,
			destFile      : destFile,
			package       : package,
			bugReport     : bugReport,
			lastTranslator: lastTranslator,
			team          : team
		}))
		.pipe( gulp.dest(translatePath) )
		.pipe( plugins.notify( { message: 'TASK: "translate" Completed! 💯', onLast: true } ) );
});

/**
 * Watches for file changes and runs specific tasks.
 */
var watchers = ['publicStyle', 'loginStyle', 'adminStyle', 'rtlStyle', /*'vendorsJs',*/ 'publicJS', 'adminJS', 'customizerJS', 'custcontrolsJS', 'browser-sync'];
gulp.task( 'default', watchers, function () {
	gulp.watch( projectPHPWatchFiles, reload ); // Reload on PHP file changes.
	gulp.watch( styleWatchFiles, [ 'publicStyle', 'loginStyle', 'adminStyle', 'rtlStyle' ] ); // Reload on SCSS file changes.
	//gulp.watch( vendorJSWatchFiles, [ 'vendorsJs', reload ] ); // Reload on vendorsJs file changes.
	gulp.watch( publicJSWatchFiles, [ 'publicJS', reload ] ); // Reload on publicJS file changes.
	gulp.watch( adminJSWatchFiles, [ 'adminJS', reload ] ); // Reload on adminJS file changes.
	gulp.watch( customizerJSWatchFiles, [ 'customizerJS' ] ); // Reload on customizerJS file changes.
	gulp.watch( custcontrolsJSWatchFiles, [ 'custcontrolsJS' ] ); // Reload on customizerJS file changes.
});
