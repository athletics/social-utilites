module.exports = {
	options: {
		plugin: [
			[ 'minifyify', {
				map: false
			} ]
		]
	},
	main: {
		src: 'js/src/main.js',
		dest: 'js/dist/social-utilities.js'
	}
};