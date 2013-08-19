<?php

/* Imports */
require_once('../../../config.php');
require_once($CFG->dirroot . '/repository/lib.php');
require_once($CFG->libdir . '/gdlib.php');
require_once($CFG->dirroot . '/theme/archaius/layout/gui_functions.php');

$id = required_param('id', PARAM_INT);
$contextid = required_param('contextid', PARAM_INT);
$ajax = optional_param('ajax',NULL, PARAM_INT);

$url = new moodle_url('/theme/archaius/slideshow/delete_slide.php', array(
            'id' => $id,
            'contextid' => $contextid

            ));

list($context, $course, $cm) = get_context_info_array($contextid);

require_login($course, true, $cm);
if (isguestuser()) {
    die();
}

global $DB, $USER;


if(isloggedin() && has_capability('moodle/site:config', $context, $USER->id, true)){
	$DB->delete_records('theme_archaius', array("id" => $id,));
	if($ajax == 1){
		$slides= "SELECT * FROM {theme_archaius} ORDER BY position ASC";
    	$slides= $DB->get_records_sql($slides);
    	echo add_theme_archaius_slideshow($slides);
	}else{
		redirect($CFG->wwwroot . "/index.php");
	}
}

