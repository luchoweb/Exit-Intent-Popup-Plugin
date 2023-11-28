const gulp = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const browserSync = require("browser-sync").create();

const localDomain = "lucho.local";
const publicPaths = {
  scss: {
    src: "./public/assets/scss/*.scss",
    dest: "./public/assets/css/",
  },
};

// Compile CSS
gulp.task("public-scss", function () {
  const stream = gulp
    .src([publicPaths.scss.src])
    .pipe(sass().on("error", sass.logError))
    .pipe(browserSync.stream());

  return stream.pipe(gulp.dest(publicPaths.scss.dest));
});

gulp.task("serve", function () {
  browserSync.init({
    proxy: localDomain,
  });

  gulp.watch(publicPaths.scss.src, gulp.series("public-scss"));
});

gulp.task("default", gulp.series("serve"));
