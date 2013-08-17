<?php

/* Imports */
require_once('../../../config.php');
require_once($CFG->dirroot . '/repository/lib.php');
require_once($CFG->dirroot . '/theme/archaius/slideshow/add_slide_form.php');
require_once($CFG->libdir . '/gdlib.php');


/* Page parameters */
$contextid = required_param('contextid', PARAM_INT);
$sectionid = required_param('sectionid', PARAM_INT);
$id = optional_param('id', null, PARAM_INT);

global $DB,$USER;
/* No idea, copied this from an example. Sets form data options but I don't know what they all do exactly */
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

$slide = array();
if( sizeof($_POST) == 0 ){
    $slide = "SELECT * FROM {theme_archaius} WHERE id = {$id}";
    $slide = $DB->get_records_sql($slide);     
}

$mform = new add_slide_form(null, array(
            'id' => $id,
            'contextid' => $contextid,
            'userid' => $formdata->userid,
            'sectionid' => $sectionid,
            'slide' => $slide,
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
        print_r($record);
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

