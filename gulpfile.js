const gulp = require("gulp"),
  sass = require("gulp-sass"),
  minify = require("gulp-babel-minify"),
  concat = require('gulp-concat'),
  postcss = require("gulp-postcss"),
  autoprefixer = require("autoprefixer"),
  cssnano = require("cssnano"),
  sourcemaps = require("gulp-sourcemaps"),
  browserSync = require("browser-sync").create(),
  notify = require('gulp-notify'),
  plumber = require('gulp-plumber'),
  csscomb = require('gulp-csscomb');

const paths = {
  styles: {
    src: "parts/**/*.scss",
    dest: "./"
  },

  scripts: {
    src: "parts/**/*.js",
    dest: "./"
  },
  php: {
    src: "parts/**/*.php"
  }
};

function reportError(error) {
  const lineNumber = (error.lineNumber) ? 'LINE ' + error.lineNumber + ' -- ' : '';
  const pluginName = (error.plugin) ? ': [' + error.plugin + ']' : '[' + currentTask + ']';

  notify({
    title: 'Task Failed ' + pluginName,
    message: lineNumber + 'See console.'
  }).write(error);

  console.error('Error: ', error.message);
}

function style() {
  return (
    gulp
      .src(paths.styles.src)
      .pipe(plumber({
        errorHandler: reportError
      }))
      .pipe(sourcemaps.init())
      .pipe(sass())
      .on("error", sass.logError)
      .pipe(postcss([autoprefixer({
        // autoprefixer options moved to package.json
        cascade: false
      }), cssnano()]))
      .pipe(sourcemaps.write('./maps'))
      .pipe(gulp.dest(paths.styles.dest))
      // Add browsersync stream pipe after compilation
      .pipe(browserSync.stream({match: '**/*.css'}))
  );
}

function scripts() {
  return (
    gulp
      .src(paths.scripts.src)
      .pipe(plumber({
        errorHandler: reportError
      }))
      .pipe(minify())
      .pipe(concat('all.min.js'))
      .pipe(gulp.dest(paths.scripts.dest))
  );
}

function comb() {
  return (
    gulp
    // run csscomb only on files that have changed since the last time csscomb ran
      .src(paths.styles.src, {since: gulp.lastRun(comb)})
      .pipe(csscomb())
      .pipe(gulp.dest("./parts"))
  );
}

function serve() {
  // run the compile tasks when the watch task starts as well
  style();
  scripts();

  browserSync.init({
    proxy: "localhost",
    open: false
  });
  gulp.watch(paths.styles.src, gulp.series(comb, style));
  gulp.watch(paths.scripts.src, scripts);
  gulp.watch([paths.php.src, paths.scripts.src, '**/*.php']).on('change', function () {
    browserSync.reload()
  });
}

// expose the tasks
exports.style = style;
exports.comb = comb;
exports.scripts = scripts;
exports.default = serve;
