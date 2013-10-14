<?php

/**
* Archaius slider from page slider
*/
class ArchaiusSlider{
	
	private $slides;
	private static $instance = null;

	private function __construct(){
		$this->slides = $this->fill_slider();

	}
	/** 
	*	Get ArchaiusSlider object
	*	@return ArchaiusSlider object
	*/
	public static function Instance(){
        if (self::$instance === null) {
            self::$instance = new ArchaiusSlider();
        }
        return self::$instance;
    }

    public function get_slides(){
    	return $this->slides;
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