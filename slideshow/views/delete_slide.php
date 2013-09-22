<?php

/******************************************************************************
|                     DELETE  SLIDES                                          |   
******************************************************************************/

//imports
require_once($CFG->dirroot . '/theme/archaius/slideshow/controllers/frontpage_controller.php');


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
		$slider = ArchaiusSlider::Instance();
    	echo $slider->add_slideshow($contextid); 
	}else{
		redirect($CFG->wwwroot . "/index.php");
	}
}else{
	redirect($CFG->wwwroot . "/index.php");
}

