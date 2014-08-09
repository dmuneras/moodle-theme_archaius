<?php
/*
*
*   This program is free software: you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation, either version 3 of the License, or
*   (at your option) any later version.
*
*   This program is distributed in the hope that it will be useful,
*   but WITHOUT ANY WARRANTY; without even the implied warranty of
*   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*   GNU General Public License for more details.
*/

/**
 * 
 * @package   theme_archaius
 * @copyright 2012 onwards Daniel Munera Sanchez  {@link http://dmuneras.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

/*  SLIDES FORM                                           
-----------------------------------------------------------------------------*/

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
        $mform->addRule(
            'position', 
            get_string('positionException', 'theme_archaius'), 
            'required', 
            null, 
            'client'
        );
        
        $mform->addElement(
            'editor', 
            'description_editor', 
            get_string('description', 'theme_archaius'),
            null, 
            $default_values['editoroptions']
        );

        $mform->setType('description_editor', PARAM_RAW);
        $mform->addRule(
            'description_editor', 
            get_string('descriptionEditorException','theme_archaius'), 
            'required', 
            null, 
            'client'
        );

        // hidden params        
        $mform->addElement(
            'hidden', 
            'userid', 
            $default_values['userid']
        );

        $mform->setType('userid', PARAM_INT);

        $mform->addElement(
            'hidden', 
            'contextid', 
            $default_values['contextid']
        );

        $mform->setType('contextid', PARAM_INT);

        $mform->addElement(
            'hidden', 
            'action', 
            $default_values['action']
        );

        $mform->setType('action', PARAM_TEXT);

        //Set default values when the user is editing.
        if($default_values['editing'] == true){
            $mform->addElement(
                'hidden', 
                'id', 
                $default_values['id']
            );
            $mform->setType('id', PARAM_INT);

            $mform->addElement(
                'hidden', 
                'itemid', 
                $default_values['itemid']
            );

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