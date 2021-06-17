const {src, dest, series, watch} = require('gulp'),
	sass = require('gulp-sass'),
	autoprefixer = require('gulp-autoprefixer'),
	concat = require('gulp-concat'),
	sourcemaps = require('gulp-sourcemaps'),
	rename = require('gulp-rename'),
	clean_css = require('gulp-clean-css'),
	group_media = require('gulp-group-css-media-queries')
;

function scss() {
	return src('sass/main.scss')
		.pipe(sourcemaps.init())
		.pipe(sass({
			outputStyle: "expanded"
		}))
		.pipe(group_media())
		.pipe(autoprefixer())
		.pipe(concat('main.css'))
		.pipe(dest('styles/'))
		.pipe(clean_css())
		.pipe(rename({
			extname: ".min.css"
		}))
		.pipe(sourcemaps.write('.'))
		.pipe(dest('styles/'))

}

function projectWatch() {
	watch('sass/**/**.scss', series(scss));
}

exports.scss = scss;
exports.watch = projectWatch;
