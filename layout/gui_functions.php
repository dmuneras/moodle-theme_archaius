<?php


/**
 * Prints archaius theme slideshow.
 * @return string the HTML to be output.
 */
function add_theme_archaius_slideshow($slides){
	$html_slider = "<div class='slides'>";
	$html_options = "";
	if(! empty($slides)){
	    foreach ($slides as $slide) {
	        $aux =  "<div class='slide'>" .$slide->description . "</div>";
	        $html_slider .= $aux;
	        $html_options .=  "<a href='#''></a>";
	    } 
	    $html_slider .=  "</div><div class='slidetabs'>";
	    $html_slider .= $html_options;
	    $html_slider .= "</div>";
	    return $html_slider;

	} 
} 

/**
 * Prints an admin options to manage the slideshow.
 * @return string the HTML to be output.
 */
function add_admin_options($link_text,$slides){
	global $CFG,$USER,$COURSE;
	$html_admin_options = "<div class='admin-options'>";	
    $context = context_course::instance($COURSE->id);
    $contextid = $context->id;
    $link_to_add = "<a class='pretty-button pretty-link-button' href=".
     	$CFG->wwwroot ."/theme/archaius/slideshow/add_slide.php?contextid=" . 
        $contextid . "&userid=" . $USER->id . "&sectionid=2>". $link_text ."</a>";
    $html_admin_options .= $link_to_add;

    $table = new html_table();
    $table->head = array('Position', 'Content', 'Actions');
    foreach ($slides as $slide) {
    	$links = "<a href=". $CFG->wwwroot ."/theme/archaius/slideshow/edit_slide.php?contextid=" . 
        $contextid . "&userid=" . $USER->id . "&sectionid=2&id=". $slide->id . ">Edit</a>";
    	$row = new html_table_row(array($slide->position, $slide->description, $links));
		$row->attributes['data-id'] = '1';
		$table->data[] = $row;
    }
	$html_admin_options .= html_writer::table($table);
	$html_admin_options .= "</div>";
    return $html_admin_options;	        
}

