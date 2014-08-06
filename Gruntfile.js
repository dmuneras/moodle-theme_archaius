module.exports = function(grunt) {
    grunt.initConfig({
	    less: {
		development: {
		    options: {
			compress: true,
			yuicompress: true,
			optimization: 2
		    },
		    files: {
			// target.css file: source.less file
			"style/archaius_less.css": "style/source/archaius.less",
			"style/course_less.css": "style/source/course.less",
			"style/base_less.css": "style/source/base.less",
			"style/archaius_less.css": "style/source/archaius.less"
		    }
		}
	    },
	    watch: {
		styles: {
		    files: ['style/source/**/*.less'], // which files to watch
		    tasks: ['less'],
		    options: {
			nospawn: true
		    }
		}
	    }
	});

    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['watch']);
};