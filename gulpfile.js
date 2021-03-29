"use strict";
const gulp = require("gulp");
const sass = require("gulp-sass");
var concat = require("gulp-concat");

sass.compiler = require("node-sass");

gulp.task("scss", () => {
	return gulp.src("sass/**/*.scss")
		.pipe(concat("main.scss"))
		.pipe(sass().on("error", sass.logError))
		.pipe(gulp.dest("./styles/"));
});

gulp.task("watch", () => {
	gulp.watch("sass/**/*.scss", (done) => {
		gulp.series(["scss"])(done);
	});
});

gulp.task("default", gulp.series("scss"));
