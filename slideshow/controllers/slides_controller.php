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
*/

/**
 * Archaius slider controller
 *
 * @package theme_archaius
 * @copyright 2013 onwards Daniel Munera
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

//TODO : I will implement this logic again, I dont like it.

/* SLIDER CONTROLLER
-----------------------------------------------------------------------------*/

//Imports
require_once('../../../../config.php');

global $CFG, $PAGE;

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
		$PAGE->set_url($url);

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
		$PAGE->set_url($url);
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
	