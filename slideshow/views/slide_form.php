<?php

defined('MOODLE_INTERNAL') || die();

require_once("{$CFG->libdir}/formslib.php");

class slide_form extends moodleform {

    function definition() {

        global $CFG;
        $mform =& $this->_form;
        $attributes=array('size'=>'20');
        $default_values = $this->_customdata;

        // visible elements
        $mform->addElement('text', 'position', 
            get_string('position', 'theme_archaius'), $attributes);  
        $mform->setType('position',PARAM_INT);
        
        $mform->addElement('editor', 'description_editor', 
            get_string('description', 'theme_archaius'),
            null, $default_values['editoroptions']);

        $mform->setType('description_editor', PARAM_RAW);


        // hidden params        
        $mform->addElement('hidden', 'userid', $default_values['userid']);
        $mform->setType('userid', PARAM_INT);

        $mform->addElement('hidden', 'contextid', $default_values['contextid']);
        $mform->setType('contextid', PARAM_INT);

        $mform->addElement('hidden', 'action', $default_values['action']);
        $mform->setType('action', PARAM_TEXT);

        //Set default values when the user is editing.
        if($default_values['editing'] == true){
            $mform->addElement('hidden', 'id', $default_values['id']);
            $mform->setType('id', PARAM_INT);

            $mform->addElement('hidden', 'itemid', $default_values['itemid']);
            $mform->setType('itemid', PARAM_INT);
  
        }
        if(! empty($default_values['description'])){

            $mform->setDefault('description_editor', 
                array( 'text' => $default_values['description'], 
                'format' =>  FORMAT_HTML));
        }

        if(! empty($default_values['position'])){
            $mform->setDefault('position', $default_values['position']);    
        }

        // buttons
        $this->add_action_buttons(true, get_string('savechanges', 'admin'));
    }
}