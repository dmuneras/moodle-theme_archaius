/*  

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/

/**
 * GRUNT FILE
 *
 * @package theme_archaius
 * @copyright 2013 onwards Daniel Munera
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/*	GRUNTFILE ARCHAIUS
    DESCRIPTION:  This file define the needed task to precompile LESS and JS
    			  jQuery plugins, the JS files are statics because some of
    			  the plugins are not going to be modified and its compression 
    			  is not needed. 
-----------------------------------------------------------------------------*/

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
			      	{
			        	src: 'jquery/source/archaius_custom_blocks-1.1.2.js', 
			        	dest: 'jquery/source/archaius_custom_blocks-1.1.2.min.js'
			        },
			        {
			        	src: 'jquery/source/responsiveslides.js', 
			        	dest: 'jquery/source/responsiveslides.min.js'
			        },
		    	],
		    },
	  	},
	    watch: {
			styles: {
			    files: ['style/source/**/*.less'], // which files to watch
			    tasks: ['less'],
			    options: {
				spawn: false
			    }
			},
			scripts: {
			   files: 'jquery/source/**/*.js',
			   tasks: ['uglify']
			}
	    }
	});

    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['watch']);
};