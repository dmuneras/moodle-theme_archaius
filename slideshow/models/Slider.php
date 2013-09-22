<?php

require_once($CFG->libdir . '/gdlib.php');
require_once($CFG->libdir .'/filelib.php');

/**
* Archaius from page slider
*/
class ArchaiusSlider{
	
	private $slides;
	private static $instance = null;

	private function __construct(){
		$this->slides = $this->fill_slider();

	}

	public static function Instance(){
        if (self::$instance === null) {
            self::$instance = new ArchaiusSlider();
        }
        return self::$instance;
    }

    /**
	 * Prints archaius theme slideshow.
	 * @return string the HTML to be output.
	 */

	public function add_slideshow($contextid){
	    global $CFG;
	    $html_slider = "<div class='rslides_container'>".
	        "<ul id='slider3' class='rslides'>";
	    $html_options = "";
	    if(! empty($this->slides)){
	        foreach ($this->slides as $slide) {            
	            $aux =  "<li>" .  $this->get_slide_content($slide,$contextid) . "</li>";
	            $html_slider .= $aux; 
	        } 
	        $html_slider .= "</ul></div>";
	    }else{
	        $aux = "<li><img src=". $CFG->wwwroot . 
	        "/theme/archaius/pix/defaultSlide.png /></li></ul></div>";
	        $html_slider .= $aux;
	    }
	    return $html_slider;
	}

	public function get_slide_content($slide,$contextid){

	    //Take a look in forum lib line 4035
	    $description = file_rewrite_pluginfile_urls($slide->description, 'pluginfile.php',
	    $contextid, 'theme_archaius', 'slides_images_'.$slide->id, $slide->itemid);

	    return $description;
	}

		/**
	 * Prints an admin options to manage the slideshow.
	 * @return string the HTML to be output.
	 */
	public function admin_options($contextid){
	    global $CFG,$USER,$COURSE;
	    $html_admin_options = "<div class='admin-options'>";    
	    $base_link = $CFG->wwwroot;
	    $link_to_add = "<div class='main-control'>".
	        "<a class='pretty-button pretty-link-button'".
	        " href= '". $base_link ."/theme/archaius/slideshow/controllers/slides_controller.php?".
	        "action=add&contextid=" . $contextid . "&userid=" . $USER->id . "&sectionid=2'>". 
	        get_string("addSlide","theme_archaius") ."</a></div><div class='notice'></div>";
	    $html_admin_options .= $link_to_add;

	    if(sizeof($this->slides) > 0){
	        $table = new html_table();
	        $table->head = array('Position', 'Content', 'Edit','Delete');
	        foreach ($this->slides as $slide) {
	            $base_link = "<a href=". $CFG->wwwroot ."/theme/archaius/slideshow/controllers/".
	                        "slides_controller.php?"; 
	            $delete_link =  $base_link . "action=delete&id=" . $slide->id .
	            "&contextid=". $contextid . "&userid=" . $USER->id . 
	            " class='delete-slide btn-danger btn pretty-link-button'>Delete</a>";
	            $edit_link = $base_link . "action=edit&contextid=" . $contextid . "&userid=" . $USER->id . 
	            "&sectionid=2&id=". $slide->id . " class=' btn-warning btn pretty-link-button'>Edit</a>";
	      
	            $row = new html_table_row(array($slide->position,
	                 $this->get_slide_content($slide,$contextid),
	                 $edit_link,$delete_link));

	            $row->attributes['data-id'] = '1';
	            $table->data[] = $row;
	        }
	        $html_admin_options .= html_writer::table($table);

	    }else{
	        $html_admin_options .= "<h2>There are not slides at the moment</h2>";
	    }
	    $html_admin_options .= "</div>";
	    return $html_admin_options;         
	}

	/** 
	*	Get slides from database
	*	@return Array
	*/
	private function fill_slider(){
		global $DB;
		$slides= "SELECT * FROM {theme_archaius} ORDER BY position ASC";
	    $slides= $DB->get_records_sql($slides);
	    return $slides;
	}


}