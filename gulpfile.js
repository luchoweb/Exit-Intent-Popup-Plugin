const gulp = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const minify = require("gulp-minify");
const cleanCss = require('gulp-clean-css');
const browserSync = require("browser-sync").create();

const localDomain = "lucho.local";
const publicPaths = {
  scss: {
    src: "./public/assets/scss/*.scss",
    dest: "./public/assets/css/",
  },
  js: {
    src: "./public/assets/js/*.js",
    dest: "./public/assets/js/",
  },
};

// Compile CSS
gulp.task("public-scss", function () {
  const stream = gulp
    .src([publicPaths.scss.src])
    .pipe(sass().on("error", sass.logError))
    .pipe(cleanCss())
    .pipe(browserSync.stream());

  return stream.pipe(gulp.dest(publicPaths.scss.dest));
});

gulp.task("minify-js", function () {
  const stream = gulp
    .src([publicPaths.js.src])
    .pipe(minify({ noSource: true }))
    .pipe(browserSync.stream());

  return stream.pipe(gulp.dest(publicPaths.js.dest));
});

gulp.task("serve", function () {
  browserSync.init({
    proxy: localDomain,
  });

  gulp.watch(publicPaths.scss.src, gulp.series("public-scss"));
});

gulp.task("default", gulp.series("serve"));
