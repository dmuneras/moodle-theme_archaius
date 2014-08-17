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
 * Archaius slider helper functions, It is used to print slider 
 * elements in the layouts.
 *
 * @package theme_archaius
 * @copyright 2013 onwards Daniel Munera
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* SLIDER HELPER FUNCTIONS
-----------------------------------------------------------------------------*/

//Imports 
require_once($CFG->libdir . '/gdlib.php');
require_once($CFG->libdir .'/filelib.php');
require $CFG->dirroot . "/theme/archaius/slideshow/models/ArchaiusSlider.class.php";

/**
 * ArchaiusSliderHelper 
 *
 * @package theme_archaius
 * @copyright 2013 onwards Daniel Munera
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class ArchaiusSliderHelper{

    private $contextid;
    private $slides;

    private static $instance = null;

    private function __construct($contextid){
        $this->contextid = $contextid;
        $this->slides = $this->get_slider()->get_slides();
    }
    /** 
    *   Get ArchaiusSlider object
    *   @param int $contextid
    *   @return ArchaiusSlider object
    */
    public static function Instance($contextid){
        if (self::$instance === null) {
            self::$instance = new ArchaiusSliderHelper($contextid);
        }
        return self::$instance;
    }

    /**
     * Prints archaius theme slideshow.
     * @param int $contextid
     * @param Array $slides
     * @return HTML to be output.
     */
    public function add_slideshow(){
        global $CFG;
        $html_slider = html_writer::start_tag("div", 
            array('class' => 'rslides_container'  
        ));
        $html_slider .= html_writer::start_tag("ul", 
            array("id" => 'slider3',"class" => 'rslides')
        );
        if(! empty($this->slides)){
            foreach ($this->slides as $slide) {            
                $html_slider .= html_writer::start_tag("li");  
                $html_slider .= $this->get_slide_content($slide);
                $html_slider .= html_writer::end_tag("li");  
            } 
            $html_slider .=  html_writer::end_tag("ul"); 
            $html_slider .=  html_writer::end_tag("div"); 
        }else{
            $html_slider .=  html_writer::start_tag("li");
            $html_slider .=  html_writer::start_tag("img", 
                array(
                    "src" => $CFG->wwwroot .
                        "/theme/archaius/pix/defaultSlide.png"
                )
            );
            $html_slider .=  html_writer::end_tag("ul"); 
            $html_slider .=  html_writer::end_tag("div"); 
        }
        return $html_slider;
    }

    /** 
    *   Get slider
    *   @return ArchaiusSlider Instance
    */
    private function get_slider(){
        return ArchaiusSlider::Instance();
    }

    /**
     * Prints an admin options to manage the slideshow.
     * @param int $contextid
     * @param Array $slides
     * @return HTML to be output.
     */
    public function admin_options(){
        global $CFG,$USER,$COURSE;
        $html_admin_options = html_writer::start_tag("div", 
            array("class" => "admin-options"));

        $base_link = $CFG->wwwroot;
        $params = '&action=add'.'&userid='.$USER->id.
            '&contextid='.$this->contextid;

        $link_to_add = html_writer::start_tag("div", 
            array("class" => "main-control"));

        $url = $base_link . 
            '/theme/archaius/slideshow/controllers/slides_controller.php?';
        $url .= $params;
        $link_to_add .= html_writer::start_tag("a", array(
            "href" => $url,
            "class" => "pretty-button pretty-link-button btn"
        ));
        $link_to_add .= get_string("addSlide","theme_archaius");
        $link_to_add .= html_writer::end_tag("a");
        $link_to_add .= html_writer::end_tag("div");  

        $link_to_add .= html_writer::start_tag("div", array(
            "class" => "notice"
        ));
        $link_to_add .=  html_writer::end_tag("div");
        $html_admin_options .= $link_to_add;

        if(! empty($this->slides)){
            $table = new html_table();
            
            $table->head = array(
                get_string('pos','theme_archaius'), 
                get_string('content'), 
                get_string('edit'),
                get_string('delete')
            );

            foreach ($this->slides as $slide) {
                $base_link = 
                    "<a href=". $CFG->wwwroot 
                    ."/theme/archaius/slideshow/controllers/".
                    "slides_controller.php?";

                $delete_link =  $base_link . "action=delete&id=" . $slide->id .
                "&contextid=". $this->contextid . "&userid=" . $USER->id . 
                " class='delete-slide btn-danger btn pretty-link-button'>Delete</a>";

                $edit_link = $base_link . "action=edit&contextid=" . $this->contextid . 
                "&userid=" . $USER->id . 
                "&sectionid=2&id=". $slide->id .
                " class=' btn-warning btn pretty-link-button'>Edit</a>";
          
                $row = new html_table_row(array($slide->position,
                     $this->get_slide_content($slide),
                     $edit_link,$delete_link));

                $row->attributes['data-id'] = '1';
                $table->data[] = $row;
            }
            $html_admin_options .= html_writer::table($table);

        }else{
            $html_admin_options .= "<h2>"; 
            $html_admin_options .=  get_string("noSlides","theme_archaius") . "</h2>";
        }
        $html_admin_options .=  html_writer::end_tag("div");
        return $html_admin_options;         
    }

    /**
     * Get slide content, rewriting files URLS
     * @param Array $slides
     * @param int $contextid
     * @return HTML to be output.
     */
    private function get_slide_content($slide){

        //Take a look in forum lib line 4035
        $description = 
            file_rewrite_pluginfile_urls(
                $slide->description, 
                'pluginfile.php',
                $this->contextid, 
                'theme_archaius', 
                'slides_images_'.$slide->id, $slide->itemid);

        return $description;
    } 
}

