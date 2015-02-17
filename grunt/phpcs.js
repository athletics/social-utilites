module.exports = {
	main: {
		dir: [
			'./*.php',
			'./**/*.php',
			'!./node_modules/**/*.*',
			'!./vendor/**/*.*'
		]
	},
	options: {
		bin: 'vendor/bin/phpcs',
		standard: 'WordPress-VIP'
	}
};