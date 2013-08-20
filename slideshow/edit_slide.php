<?php

/* Imports */
require_once('../../../config.php');
require_once($CFG->dirroot . '/repository/lib.php');
require_once($CFG->dirroot . '/theme/archaius/slideshow/slide_form.php');
require_once($CFG->libdir . '/gdlib.php');

global $DB,$USER;

/* Page parameters */
$contextid = required_param('contextid', PARAM_INT);
$sectionid = required_param('sectionid', PARAM_INT);
$id = optional_param('id', null, PARAM_INT);

//Parameters for form
$formdata = new stdClass();
$formdata->userid = required_param('userid', PARAM_INT);
$formdata->offset = optional_param('offset', null, PARAM_INT);
$formdata->forcerefresh = optional_param('forcerefresh', null, PARAM_INT);
$formdata->mode = optional_param('mode', null, PARAM_ALPHA);

$url = new moodle_url('/theme/archaius/slideshow/edit_slide.php', array(
            'contextid' => $contextid,
            'id' => $id,
            'userid' => $formdata->userid,
            'mode' => $formdata->mode));

list($context, $course, $cm) = get_context_info_array($contextid);

require_login($course, true, $cm);
if (isguestuser()) {
    die();
}

$PAGE->set_url($url);
$PAGE->set_context($context);

$maxfiles = 99;                
$maxbytes = $course->maxbytes; 

$definitionoptions = array('trusttext'=>true, 
    'subdirs'=>false, 'maxfiles'=>$maxfiles, 
    'maxbytes'=>$maxbytes, 'context'=>$context);

$slide = array();
if( sizeof($_POST) == 0 ){
    $slide = "SELECT * FROM {theme_archaius} WHERE id = {$id}";
    $slide = $DB->get_records_sql($slide);     
}

$mform = new slide_form(null, array(
            'id' => $id,
            'contextid' => $contextid,
            'userid' => $formdata->userid,
            'sectionid' => $sectionid,
            'slide' => $slide,
            'definitionoptions'=>$definitionoptions,
            'options' => none));

if ($mform->is_cancelled()) {
    //Someone has hit the 'cancel' button
    redirect(new moodle_url($CFG->wwwroot . '/index.php'));
} else if ($formdata = $mform->get_data()) { //Form has been submitted    
    try{
        $record = new stdClass();
        $record->description = $formdata->description['text'];
        $record->userid = $formdata->userid;
        $record->id = $formdata->id;
        if($formdata->position > 0){
            $record->position = $formdata->position;       
        }else{
             throw new Exception(get_string("error_position","theme_archaius"));
        }
          
        $DB->update_record("theme_archaius", $record,false);
        redirect($CFG->wwwroot . "/index.php");

    }catch(Exception $e){
        echo 'Caught exception: ',  $e->getMessage() , "\n";
    }
}




/* Draw the form */
echo $OUTPUT->header();
echo $OUTPUT->box_start('generalbox');
$mform->display();
echo $OUTPUT->box_end();
echo $OUTPUT->footer();

