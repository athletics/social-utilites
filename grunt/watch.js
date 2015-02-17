module.exports = {
	main: {
		files: [
			'js/src/*.js',
			'js/src/**/*.js'
		],
		tasks: [
			'clean',
			'browserify'
		]
	}
};