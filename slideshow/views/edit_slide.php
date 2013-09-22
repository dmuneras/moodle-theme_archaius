<?php

/******************************************************************************
|                     EDIT SLIDES                                             |   
******************************************************************************/

require_once('slide_form.php');

global $DB,$USER;

list($context, $course, $cm) = get_context_info_array($contextid);

require_login($course, true, $cm);

if (isguestuser()) {
    die();
}

if(!(isloggedin() && has_capability('moodle/site:config', $context, $USER->id, true))){
    redirect(new moodle_url($CFG->wwwroot . '/index.php'));
}

$PAGE->set_url($url);
$PAGE->set_context($context);



$editing = true;


$editoroptions = array(
    'context'=> $context,
    'trusttext'=> true, 
    'maxfiles'=> EDITOR_UNLIMITED_FILES, 
    'maxbytes'=> $CFG->maxbytes,
    'noclean' => true
);

$slide = new stdClass();
if( sizeof($_POST) == 0 ){
    $slide = "SELECT * FROM {theme_archaius} WHERE id = {$id}";
    $slide = $DB->get_records_sql($slide); 
    $slide = $slide[$id]; 
    $slide->context = $context; 
    $slide = file_prepare_standard_editor($slide, 
        'description', $editoroptions, $context, 'theme_archaius',
                                        'slides_images_'. $slide->id , $slide->itemid );
    $itemid = $slide->itemid;

}

$mform = new slide_form(null, compact("action","id",
    "definitionoptions","editing","userid","position","description",
                                     "itemid","contextid","editoroptions"));
$mform->set_data($slide);

if ($mform->is_cancelled()) {
    //Someone has hit the 'cancel' button
    redirect(new moodle_url($CFG->wwwroot . '/index.php'));
} else if ($formdata = $mform->get_data()) { //Form has been submitted    
    try{
        $record = new stdClass();
        $record->id = $formdata->id;
        $record->userid = $formdata->userid;
        $record->itemid = $formdata->itemid;
        if($formdata->position > 0){
            $record->position = $formdata->position;       
        }else{
             throw new Exception(get_string("error_position",
                                                "theme_archaius"));
        } 
        //Set Description_editor variable on $record Object to be processed
        //using file_postupdate standard function. 
        $record->description_editor =  $formdata->description_editor;
        unset($record->description);
        $record = file_postupdate_standard_editor(
            $record, 
            'description', 
            $editoroptions, 
            $context, 
            'theme_archaius', 
            'slides_images_' . strval($record->id), 
            $record->itemid
        );
        
        //Update record on database to store description with rewrite urls
        $DB->update_record("theme_archaius", $record);
        redirect($CFG->wwwroot . "/index.php");
    }catch(Exception $e){
        echo 'Caught exception: ',  $e->getMessage() , "\n";
    }
}


//Draw the form
echo $OUTPUT->header();
echo $OUTPUT->box_start('generalbox');
$mform->display();
echo $OUTPUT->box_end();
echo $OUTPUT->footer();

