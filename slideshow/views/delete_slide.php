<?php

/*  

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

This plugin is part of Archaius theme.
@copyright  2013 Daniel Munera Sanchez

*/

/******************************************************************************
|                     DELETE  SLIDES                                          |   
******************************************************************************/

//imports
require_once($CFG->dirroot . '/theme/archaius/slideshow/helpers/slider_helper.php'); 
require_once($CFG->dirroot . '/repository/lib.php');

list($context, $course, $cm) = get_context_info_array($contextid);

require_login($course, true, $cm);
if (isguestuser()) {
    die();
}

global $DB, $USER;


if(isloggedin() && has_capability('moodle/site:config', 
											$context, $USER->id, true)){
	$DB->delete_records('theme_archaius', array("id" => $id,));
	$fs = get_file_storage();
	$related_files = $fs->get_area_files($context->id,
			"theme_archaius", "slides_images_" . $id, 910120, 'id');
	foreach ($related_files as $file) {
		$file->delete();
	}
	if($ajax == 1){
		$slider = theme_archaius_get_slider();
    	echo theme_archaius_add_slideshow($contextid,$slider->get_slides()); 
	}else{
		redirect($CFG->wwwroot . "/index.php");
	}
}else{
	redirect($CFG->wwwroot . "/index.php");
}

