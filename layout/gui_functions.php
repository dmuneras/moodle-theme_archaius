<?php

require_once($CFG->libdir.'/filelib.php');

/**
 * Prints archaius theme slideshow.
 * @return string the HTML to be output.
 */

function theme_archaius_get_slide_content($slide,$contextid){

    //Take a look in forum lib line 4035
    $description = file_rewrite_pluginfile_urls($slide->description, 'pluginfile.php',
    $contextid, 'theme_archaius', 'slides_images_'.$slide->id, $slide->itemid);

    return $description;
}

function add_theme_archaius_slideshow($slides,$contextid){
    global $CFG;
    $html_slider = "<div class='rslides_container'>".
        "<ul id='slider3' class='rslides'>";
    $html_options = "";
    if(! empty($slides)){
        foreach ($slides as $slide) {            
            $aux =  "<li>" .  theme_archaius_get_slide_content($slide,$contextid) . "</li>";
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

/**
 * Prints an admin options to manage the slideshow.
 * @return string the HTML to be output.
 */
function add_theme_archaius_admin_options($link_text,$slides, $contextid){
    global $CFG,$USER,$COURSE;
    $html_admin_options = "<div class='admin-options'>";    
    $base_link = $CFG->wwwroot;
    $link_to_add = "<div class='main-control'>".
        "<a class='pretty-button pretty-link-button'".
        " href= '". $base_link ."/theme/archaius/slideshow/add_slide.php?contextid=" . 
        $contextid . "&userid=" . $USER->id . "&sectionid=2'>". $link_text ."</a>".
        "<a class= 'pretty-button pretty-link-button' href= ' ". $base_link .
        "/admin/settings.php?section=frontpagesettings' >" . 
        get_string("update_description","theme_archaius") . "</a></div>".
        "<div class='notice'></div>";
    $html_admin_options .= $link_to_add;

    if(sizeof($slides) > 0){
        $table = new html_table();
        $table->head = array('Position', 'Content', 'Edit','Delete');
        foreach ($slides as $slide) {
            $base_link = "<a href=". $CFG->wwwroot ."/theme/archaius/slideshow/"; 
            $delete_link =  $base_link . "delete_slide.php?id=" . $slide->id .
            "&contextid=". $contextid .
            " class='delete-slide btn-danger btn pretty-link-button'>Delete</a>";
            $edit_link = $base_link . "edit_slide.php?contextid=" . $contextid . "&userid=" . $USER->id . 
            "&sectionid=2&id=". $slide->id . " class=' btn-warning btn pretty-link-button'>Edit</a>";
      
            $row = new html_table_row(array($slide->position,
                 theme_archaius_get_slide_content($slide,$contextid),
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

