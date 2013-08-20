<?php

require_once($CFG->libdir . '/gdlib.php');

/** 
*	Get slides from database
*	@return Array
*/
function get_slides(){
	global $DB;
	$slides= "SELECT * FROM {theme_archaius} ORDER BY position ASC";
    $slides= $DB->get_records_sql($slides);
    return $slides;
}