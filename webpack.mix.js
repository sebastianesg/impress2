const mix = require('laravel-mix')
const exec = require('child_process').exec
require('dotenv').config()

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

const glob = require('glob')
const path = require('path')

/*
 |--------------------------------------------------------------------------
 | CMS Vendor assets
 |--------------------------------------------------------------------------
 */

function mixAssetsDir(query, cb) {
  ;(glob.sync('resources/cms/' + query) || []).forEach(f => {
    f = f.replace(/[\\\/]+/g, '/')
    cb(f, f.replace('resources', 'public'))
  })
}

const sassOptions = {
  precision: 5,
  includePaths: ['node_modules', 'resources/cms/assets/']
}

// plugins Core stylesheets
mixAssetsDir('scss/base/plugins/**/!(_)*.scss', (src, dest) =>
  mix.sass(src, dest.replace(/(\\|\/)scss(\\|\/)/, '$1css$2').replace(/\.scss$/, '.css'), { sassOptions })
)

// pages Core stylesheets
mixAssetsDir('scss/base/pages/**/!(_)*.scss', (src, dest) =>
  mix.sass(src, dest.replace(/(\\|\/)scss(\\|\/)/, '$1css$2').replace(/\.scss$/, '.css'), { sassOptions })
)

// Core stylesheets
mixAssetsDir('scss/base/core/**/!(_)*.scss', (src, dest) =>
  mix.sass(src, dest.replace(/(\\|\/)scss(\\|\/)/, '$1css$2').replace(/\.scss$/, '.css'), { sassOptions })
)

// script js
mixAssetsDir('js/scripts/**/*.js', (src, dest) => mix.scripts(src, dest))

// images
mixAssetsDir('images/', (src, dest) => mix.copy(src, dest))

/*
 |--------------------------------------------------------------------------
 | CMS Application assets
 |--------------------------------------------------------------------------
 */

mixAssetsDir('vendors/js/**/*.js', (src, dest) => mix.scripts(src, dest))
mixAssetsDir('vendors/css/**/*.css', (src, dest) => mix.copy(src, dest))
mixAssetsDir('vendors/**/**/images', (src, dest) => mix.copy(src, dest))
mixAssetsDir('vendors/css/editors/quill/fonts/', (src, dest) => mix.copy(src, dest))

mix
  .js('resources/cms/js/core/app-menu.js', 'public/cms/js/core')
  .js('resources/cms/js/core/app.js', 'public/cms/js/core')
  .js('resources/cms/assets/js/scripts.js', 'public/cms/js/core')
  .sass('resources/cms/scss/base/themes/dark-layout.scss', 'public/cms/css/base/themes', { sassOptions })
  .sass('resources/cms/scss/base/themes/bordered-layout.scss', 'public/cms/css/base/themes', { sassOptions })
  .sass('resources/cms/scss/base/themes/semi-dark-layout.scss', 'public/cms/css/base/themes', { sassOptions })
  .sass('resources/cms/scss/core.scss', 'public/cms/css', { sassOptions })
  .sass('resources/cms/scss/overrides.scss', 'public/cms/css', { sassOptions })
  .sass('resources/cms/scss/base/custom-rtl.scss', 'public/cms/css-rtl', { sassOptions })
  .sass('resources/cms/assets/scss/style-rtl.scss', 'public/cms/css-rtl', { sassOptions })
  .sass('resources/cms/assets/scss/style.scss', 'public/cms/css', { sassOptions })

mix.then(() => {
  if (process.env.MIX_CONTENT_DIRECTION === 'rtl') {
    let command = `node ${path.resolve('node_modules/rtlcss/bin/rtlcss.js')} -d -e ".css" ./public/cms/css/ ./public/cms/css/`
    exec(command, function (err, stdout, stderr) {
      if (err !== null) {
        console.log(err)
      }
    })
  }
})

/*
 |--------------------------------------------------------------------------
 | Front assets
 |--------------------------------------------------------------------------
 */

function mixAssetsDirFront(query, cb) {
    ;(glob.sync('resources/front/' + query) || []).forEach(f => {
        f = f.replace(/[\\\/]+/g, '/')
        cb(f, f.replace('resources', 'public'))
    })
}

// Core stylesheets
mixAssetsDirFront('assets/scss/*.scss', (src, dest) =>
    mix.sass(src, dest.replace(/(\\|\/)scss(\\|\/)/, '$1css$2').replace(/\.scss$/, '.css'), { sassOptions })
)

// script js

mixAssetsDirFront('assets/js/controllers/**/*.js', (src, dest) => mix.scripts(src, dest))

mixAssetsDirFront('assets/js/*.js', (src, dest) => mix.scripts(src, dest))

// fonts
mixAssetsDirFront('assets/fonts/', (src, dest) => mix.copy(src, dest))

// images
mixAssetsDirFront('images/', (src, dest) => mix.copy(src, dest))
/*
|--------------------------------------------------------------------------
| Front Vendor Application assets
|--------------------------------------------------------------------------
*/

mixAssetsDirFront('vendors/js/**/*.js', (src, dest) => mix.scripts(src, dest))
mixAssetsDirFront('vendors/css/**/*.css', (src, dest) => mix.copy(src, dest))
mixAssetsDirFront('vendors/**/**/images', (src, dest) => mix.copy(src, dest))


// if (mix.inProduction()) {
//   mix.version()
//   mix.webpackConfig({
//     output: {
//       publicPath: '/demo/vuexy-bootstrap-laravel-admin-template-new/demo-2/'
//     }
//   })
//   mix.setResourceRoot('/demo/vuexy-bootstrap-laravel-admin-template-new/demo-2/')
// }

/*
 |--------------------------------------------------------------------------
 | Browsersync Reloading
 |--------------------------------------------------------------------------
 |
 | BrowserSync can automatically monitor your files for changes, and inject your changes into the browser without requiring a manual refresh.
 | You may enable support for this by calling the mix.browserSync() method:
 | Make Sure to run `php artisan serve` and `yarn watch` command to run Browser Sync functionality
 | Refer official documentation for more information: https://laravel.com/docs/9.x/mix#browsersync-reloading
 */

mix.browserSync('http://127.0.0.1:8000/')
