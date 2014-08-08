module.exports = function(grunt) {
    grunt.initConfig({
	    less: {
			development: {
			    options: {
					compress: false,
					comments : false,
					optimization: 2
			    },
			    files: {
					"style/archaius.css": "style/source/archaius.less",
					"style/course.css": "style/source/course.less",
					"style/base.css": "style/source/base.less",
					"style/archaius.css": "style/source/archaius.less",
					"style/archaius_responsive.css": "style/source/archaius_responsive.less",
					"style/home.css": "style/source/home.less"
			    }
			}
		},
		uglify: {
			static_mappings: {
		      // Because these src-dest file mappings are manually specified, every
		      // time a new file is added or removed, the Gruntfile has to be updated.
		      files: [
		        {src: 'jquery/source/archaius_custom_blocks-1.1.1.js', dest: 'jquery/source/archaius_custom_blocks-1.1.1.min.js'},
		        {src: 'jquery/source/responsiveslides.js', dest: 'jquery/source/responsiveslides.min.js'},
		      ],
		    },
	  	},
	    watch: {
			styles: {
			    files: ['style/source/**/*.less'], // which files to watch
			    tasks: ['less'],
			    options: {
				nospawn: true
			    }
			},
			scripts: {
			   files: 'jquery/source/**/*.js',
			   tasks: 'uglify',
			   options: {
			    	nospawn: true
			   }
			}
	    }
	});

    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['watch']);
};