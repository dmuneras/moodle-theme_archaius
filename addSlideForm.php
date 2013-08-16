<?php

defined('MOODLE_INTERNAL') || die();
global $CFG;
require_once("{$CFG->libdir}/formslib.php");

class home_page_slide_form extends moodleform {
    function definition() {
        $mform = $this->_form;
        $instance = $this->_customdata;

        $attributes=array('size'=>'20');
        $mform->addElement('text', 'position', get_string('position', 'theme_archaius'), $attributes);
        $mform->setType('position',PARAM_INT);

        // visible elements
        $mform->addElement('editor', 'description', get_string('description', 'theme_archaius'));
        $mform->setType('description', PARAM_RAW);



        // hidden params
        $mform->addElement('hidden', 'contextid', $instance['contextid']);
        $mform->setType('contextid', PARAM_INT);
        
        $mform->addElement('hidden', 'userid', $instance['userid']);
        $mform->setType('userid', PARAM_INT);
        $mform->addElement('hidden', 'sectionid', $instance['sectionid']);
        $mform->setType('sectionid', PARAM_INT);
        
        // buttons
        $this->add_action_buttons(true, get_string('savechanges', 'admin'));
    }
}
