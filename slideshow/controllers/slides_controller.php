<?php 

//Imports
require_once('../../../../config.php');

global $CFG;

//Page parameters
$action = required_param('action', PARAM_TEXT);
$id = optional_param('id', null, PARAM_INT);
$userid = required_param('userid', PARAM_INT);
$contextid = required_param('contextid', PARAM_INT);
$mode = optional_param('mode', null, PARAM_ALPHA);
$itemid = optional_param('itemid', null, PARAM_ALPHA);


switch ($action) {
	case 'add':
		//Creating URL which is going to be use as page URL.
		$url = new moodle_url('/theme/archaius/slideshow/add_slide.php', 
		    array( 'action' => $action,
		    	'id' => $id,
		        'userid' => $userid,
		        'mode' => $mode, 
		        'contextid' => $contextid
		    )
		);
		include "../views/add_slide.php";
		break;
	
	case 'edit':
		//Creating URL which is going to be use as page URL.
		$url = new moodle_url('/theme/archaius/slideshow/edit_slide.php', 
		    array('id' => $id,
		        'userid' => $userid,
		        'mode' => $mode, 
		        'contextid' => $contextid
		    )
		);
		include "../views/edit_slide.php";
		break;

	case 'delete':
		$id = required_param('id', PARAM_INT);
		$ajax = optional_param('ajax',NULL, PARAM_INT);
		$url = new moodle_url('/theme/archaius/slideshow/delete_slide.php', array(
            'id' => $id,
            'contextid' => $contextid
        ));
        include "../views/delete_slide.php";
		break;

	default:
		redirect($CFG->wwwroot . "/index.php");
		break;
}
	