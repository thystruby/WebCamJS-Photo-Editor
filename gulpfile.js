var gulp = require('gulp'),
    sass = require('gulp-sass'),
    // browserSync = require('browser-sync'),
    concat = require('gulp-concat'), // конкатинация файлов
    uglify = require('gulp-uglifyjs'), // сжатие js
    cssnano = require('gulp-cssnano'), // сжатие css
    remane = require('gulp-rename'), // rename
    imagemin = require('gulp-imagemin'), // сжатие изображений
    autoprefixer = require('gulp-autoprefixer'); // автопрефиксы css


// компиляция Sass

gulp.task('sass', function () {
    return gulp.src('app/scss/*.scss')
      .pipe(sass())
      .pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8'], {cascade: true})) // autoprefixer
      .pipe(gulp.dest('app/css'))
    //   .pipe(browserSync.reload({stream: true}));
});


// сборка и минификация js

// gulp.task('scripts', function() {
//     return gulp.src([
//         'app/js/vendor/cropper.js',
//         'app/js/vendor/jquery.min.js',
//         'app/js/vendor/FileSaver.min.js',
//         'app/js/vendor/caman.full.min.js',
//         'app/js/vendor/sketchpad.js',
//         'app/js/vendor/lightgallery/lg-fullscreen.min.js',
//         'app/js/vendor/lightgallery/lg-thumbnail.min.js',
//         'app/js/vendor/lightgallery/lg-zoom.min.js',
//         'app/js/vendor/lightgallery/lightgallery.min.js'
//     ])
//     .pipe(concat('libs.min.js'))
//     .pipe(uglify())
//     .pipe(gulp.dest('dist/js'))
// })


// сжатие CSS 

gulp.task('css-min', ['sass'], function(){
    return gulp.src('app/css/style.css')
    .pipe(cssnano()) // сжатие css
    .pipe(remane({suffix: '.min'})) // ренэйм файла style.css с добавлением .min
    .pipe(gulp.dest('app/css')) // выгрузка
})

// Сжатие изображений

gulp.task('imagemin', function() {
	return gulp.src('app/img/background/*')
	.pipe(imagemin())
	.pipe(gulp.dest('dist/img')); 
});

// browserSync

// gulp.task('browser-sync', function () {
//   browserSync({
//     server:{
//       baseDir: './'
//     },
//     notify: false
//   });
// });

gulp.task('watch', ['sass'], function () {
   gulp.watch('app/scss/*.scss', ['sass']);
  //  gulp.watch('index.html', browserSync.reload);
  //  gulp.watch('app/js/**/*.js', browserSync.reload);
});
