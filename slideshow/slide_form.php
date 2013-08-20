<?php

defined('MOODLE_INTERNAL') || die();
global $CFG;
require_once("{$CFG->libdir}/formslib.php");

class slide_form extends moodleform {

    function definition() {

        $mform = $this->_form;
        $instance = $this->_customdata; 
        $slide = $this->_customdata['slide'];
        $slide = $slide[$instance['id']];
        $attributes=array('size'=>'20');
        $definitionoptions = $this->_customdata['definitionoptions'];

        // visible elements
        $mform->addElement('text', 'position', get_string('position', 'theme_archaius'), $attributes);  
        $mform->setType('position',PARAM_INT);

        if(! empty($slide->position)){
            $mform->setDefault('position', $slide->position);    
        }
        
        $mform->addElement('editor', 'description', get_string('description', 'theme_archaius'),null,
            $definitionoptions);
        $mform->setType('description', PARAM_RAW);

        if(! empty($slide->description)){
            $mform->setDefault('description', array( 'text' => $slide->description, 'format' =>  FORMAT_HTML));
        }

        // hidden params
        $mform->addElement('hidden', 'contextid', $instance['contextid']);
        $mform->setType('contextid', PARAM_INT);
        
        $mform->addElement('hidden', 'userid', $instance['userid']);
        $mform->setType('userid', PARAM_INT);
        $mform->addElement('hidden', 'sectionid', $instance['sectionid']);
        $mform->setType('sectionid', PARAM_INT);

        $mform->addElement('hidden', 'id', $slide->id);
        $mform->setType('id', PARAM_INT);
        
        // buttons
        $this->add_action_buttons(true, get_string('savechanges', 'admin'));
    }
}
