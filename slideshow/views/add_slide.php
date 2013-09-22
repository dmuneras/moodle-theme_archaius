<?php

/******************************************************************************
|                     ADD  SLIDES                                             |   
******************************************************************************/

//imports 
require_once('slide_form.php');

global $DB,$USER;
list($context, $course, $cm) = get_context_info_array($contextid);

//Check is user has enough privileges
require_login($course, true, $cm);

//If the user is a guest die, because guest users can't update slides
if (isguestuser()) {
    die();
}

//Checking if logged user has the capability to update slides
if(!(isloggedin() && 
    has_capability('moodle/site:config', $context, $USER->id,true))){
        redirect(new moodle_url($CFG->wwwroot . '/index.php'));
}

//Set information page
$PAGE->set_url($url);
$PAGE->set_context($context);


//Setting options for text editor which is going to be use to create the
//slide.
$editoroptions = array(
    'context'=> $context,
    'trusttext'=> true, 
    'maxfiles'=> EDITOR_UNLIMITED_FILES, 
    'maxbytes'=> $CFG->maxbytes,
    'noclean' => true
);

//Create and fill a generic object to store the information that is going to 
//be set
$slide = new stdClass();
$slide->context = $context;
$editing = false;
$slide->userid = $userid;
$slide->action = $action;


//Create the moodle form using slide_form and send extra information.
$mform = new slide_form(null, 
    compact(
        "editoroptions",
        "editing",
        "userid",
        "contextid",
        "action"
    )
);
$mform->set_data($slide);

if ($mform->is_cancelled()) {
    //Someone has hit the 'cancel' button
    redirect(new moodle_url($CFG->wwwroot . '/index.php'));
    //Process request if the information was submitted
} else if ($formdata = $mform->get_data()) {    
    try{
        $record = new stdClass();
        $record->userid = $formdata->userid;
        if($formdata->position > 0){
            $record->position = $formdata->position;       
        }else{
             throw new Exception(get_string("error_position",
                                            "theme_archaius"));
        }  
        $record->description = $formdata->description_editor["text"];
        //Item id for all files related with slides.
        $record->itemid = 910120;
        //Insert record with the basic information about the slide
        $record->id = $DB->insert_record("theme_archaius", 
                                                        $record,true);
        $record->description_editor =  $formdata->description_editor;
        unset($record->description);
        $record = file_postupdate_standard_editor(
            $record, 
            'description', 
            $editoroptions, 
            $context, 
            'theme_archaius' , 
            'slides_images_' . strval($record->id), 
             $record->itemid
        );
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