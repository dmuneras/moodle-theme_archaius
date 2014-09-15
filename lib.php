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
This plugin is part of Archaius theme.
 */

/**
* Functions needed by the archaius theme should be put here. 
* Any functions that get created here should ALWAYS contain the theme name
* to reduce complications for other theme designers who may be copying this
*theme.
* @package   theme_archaius
* @copyright 2012 onwards Daniel Munera Sanchez  {@link http://dmuneras.com}
* @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*
*/

/* ARCHAIUS LIB
-----------------------------------------------------------------------------*/

/** 
*   Function to be called for CSS postprocess, this function replace all
*   CSS tags for their values in the setting page.
*   @param String $css
*   @param Object $theme
*   @return String $css - final CSS of the theme
*/
function theme_archaius_process_css($css, $theme) {
    
    $customcss = 
        theme_archaius_check_css_setting($theme->settings->customcss);
    $css = 
        theme_archaius_replace_tag_css(
            $css,$customcss,'[[setting:customcss]]');

    $themecolor = 
        theme_archaius_check_css_setting($theme->settings->themecolor);

    $css = 
        theme_archaius_replace_tag_css(
            $css,$themecolor,'[[setting:themecolor]]');

    $bgcolor = 
        theme_archaius_check_css_setting($theme->settings->bgcolor);

    $css = 
        theme_archaius_replace_tag_css(
            $css,$bgcolor,'[[setting:bgcolor]]');
    
    $headercolor = 
        theme_archaius_check_css_setting($theme->settings->headercolor);

    $css = 
        theme_archaius_replace_tag_css(
            $css,$headercolor,'[[setting:headercolor]]');

    $currentcolor = 
        theme_archaius_check_css_setting($theme->settings->currentcolor);

    $css = 
        theme_archaius_replace_tag_css(
            $css,$currentcolor,'[[setting:currentcolor]]');

    $currentcustommenucolor = 
        theme_archaius_check_css_setting(
            $theme->settings->currentcustommenucolor);
    
    $css = 
        theme_archaius_replace_tag_css(
            $css,$currentcustommenucolor,'[[setting:currentcustommenucolor]]');

    $custommenucolor =
        theme_archaius_check_css_setting($theme->settings->custommenucolor);

    $css = 
        theme_archaius_replace_tag_css(
            $css,$custommenucolor,'[[setting:custommenucolor]]');

    $slideshowheight =
        theme_archaius_check_css_setting($theme->settings->slideshowheight);

    $css = theme_archaius_set_slideshowheight($css,$slideshowheight);

    $css = theme_archaius_set_css_font_replacement($css);

    $langs = get_string_manager()->get_list_of_translations();
    if(count($langs) > 1){
        $css = theme_archaius_set_custommenu_last_child($css, 'right', '6%');    
    }else{
        $css = theme_archaius_set_custommenu_last_child($css, 'left','0');
    }
    
    return $css;
}

/** 
*   Check if a setting is empty or not.
*   @param $setting Setting name
*   @return mixed NULL or the setting value
*/
function theme_archaius_check_css_setting($setting){
    if (!empty($setting)) 
        return $setting;
    return null;
}

/** 
*   Replace a specific setting in CSS stylesheets.
*   @param String $css
*   @param $setting Setting name
*   @return String $css
*/
function theme_archaius_replace_tag_css($css,$replacement,$tag){
    if (is_null($replacement) ) {
        $replacement = '';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;    
}

/** 
*   Replace slideshow height in CSS files. this is diffent from
*   the other method because you have to validate that the value
*   is integer. the value must be numeric and the result is given
*   in pixels.
*   @param String $css
*   @param String $slideshowheight 
*   @return String $css
*/
function theme_archaius_set_slideshowheight($css, $slideshowheight) {
    $tag = '[[setting:slideshowheight]]';
    $replacement = $slideshowheight;
    if (is_null($replacement) || !(is_numeric($replacement))){
        $replacement = '200';
    }else{
        //pixel is used and the can't be float.
        $replacement = intval($replacement);
        $replacement = (string)round($replacement);        
    }
    $replacement = $replacement . 'px';
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/** 
*   replacement depending of langmenu packs
* 
*   @param String $css
*   @param String $position
*   @param String $margin
*   @return String $css
*/
function theme_archaius_set_custommenu_last_child($css, $position,$margin) {
    $tag_position = '[[setting|custommenupositionlastchild]]';
    $replacement_position = $position;
    $tag_margin = '[[setting|custommenumarginlastchild]]';
    $replacement_margin = $margin;
    if (is_null($replacement_position)){
        $replacement_position = 'left';
    }
    if(is_null($replacement_margin)){
        $replacement_margin = 'inherit';
    }
    $css = str_replace($tag_position, $replacement_position, $css);
    $css = str_replace($tag_margin, $replacement_margin, $css);
    return $css;
}

/** 
*   Font replacement
*   Find fonts to be replaced in CSS files.
*   @param String $css
*   @return String $css
*/
function theme_archaius_set_css_font_replacement($css){
    global $CFG;
    $pattern = '/\[\[font\|([^]]+)\]\]/';
    $replacement = $CFG->wwwroot . '/theme/archaius/fonts/$1';
    $css = preg_replace($pattern, $replacement, $css);
    return $css;
}

/**
 * Serves any files associated with the theme settings.
 * Callback function to get files related with the carousel of information on
 * the frontpage.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function theme_archaius_pluginfile($course, $cm, $context, $filearea, 
                            $args, $forcedownload, array $options = array()){

    if ($context->contextlevel == CONTEXT_SYSTEM) {
        if ($filearea === 'logo') {
            $theme = theme_config::load('archaius');
            return $theme->setting_file_serve(
                'logo', 
                $args, 
                $forcedownload, 
                $options
            );


        }elseif ($filearea === 'mobilelogo') {
            $theme = theme_config::load('archaius');
            return $theme->setting_file_serve(
                'mobilelogo', 
                $args, 
                $forcedownload, 
                $options
            );

        }else{
            $fs = get_file_storage();
            $relativepath = implode('/', $args);
            $fullpath = "/$context->id/theme_archaius/$filearea/$relativepath";
            $hash = sha1($fullpath);
            $file = $fs->get_file_by_hash($hash);
            if (!$file or $file->is_directory()) {
                send_file_not_found();
            }else {
                return send_stored_file(
                    $file, 
                    86400, 
                    0, 
                    $forcedownload, 
                    $options
                );
            }            
        }

    }
}

/** 
*   Function to add jQuery and jQuery plugins using Moodle standard way
*   @param moodle_page $page
*/
function theme_archaius_page_init(moodle_page $page) { 
    global $PAGE;

    $page->requires->jquery();

    //Load responsive slideshow only when the effect is active
    $slideshow_active = 
        isset($PAGE->theme->settings->activateSlideshow) ?
            intval($PAGE->theme->settings->activateSlideshow) : 0;

    if($slideshow_active)
        $page->requires->jquery_plugin('responsive-slides', 'theme_archaius');

    //CORE JQUERY PLUGINS
    $page->requires->jquery_plugin('velocity-jquery', 'theme_archaius'); 
    $page->requires->jquery_plugin('waypoints', 'theme_archaius'); 
    $page->requires->jquery_plugin('waypoints-sticky', 'theme_archaius');   

    $accordion_blocks_active = 
        isset($PAGE->theme->settings->accordionBlocks) ?
            intval($PAGE->theme->settings->accordionBlocks) : 0;

    //Load accordion blocks only when the effect is active
    if($accordion_blocks_active)
        $page->requires->jquery_plugin('accordion-blocks', 'theme_archaius');
}

//To translate items in the customenu, it is from:
// http://docs.moodle.org/dev/Extending_the_theme_custom_menu
class theme_archaius_transmuted_custom_menu_item extends custom_menu_item {
    public function __construct(custom_menu_item $menunode) {
        parent::__construct(
            $menunode->get_text(), 
            $menunode->get_url(), 
            $menunode->get_title(), 
            $menunode->get_sort_order(), 
            $menunode->get_parent()
        );
        $this->children = $menunode->get_children();
 
        $matches = array();
        if (preg_match('/^\[\[([a-zA-Z0-9\-\_\:]+)\]\]$/', 
            $this->text, $matches)) {

            try {
                $this->text = get_string($matches[1], 'theme_archaius');
            } catch (Exception $e) {
                $this->text = $matches[1];
            }
        }
 
        $matches = array();
        if (preg_match('/^\[\[([a-zA-Z0-9\-\_\:]+)\]\]$/', 
            $this->title, $matches)) {

            try {
                $this->title = get_string($matches[1], 'theme_archaius');
            } catch (Exception $e) {
                $this->title = $matches[1];
            }
        }
    }
}