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

Functions needed by the archaius theme should be put here. 
Any functions that get created here should ALWAYS contain the theme name
to reduce complications for other theme designers who may be copying this
theme.

 */

/**
 * 
 * @package   theme_archaius
 * @copyright 2012 onwards Daniel Munera Sanchez  {@link http://dmuneras.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

function archaius_process_css($css, $theme) {

    $customcss = 
        check_css_setting($theme->settings->customcss);
    $css = archaius_set_customcss($css, $customcss);


    $themecolor = 
        check_css_setting($theme->settings->themecolor);

    $css = archaius_set_themecolor($css,$themecolor);

    $bgcolor = 
        check_css_setting($theme->settings->bgcolor);

    $css = archaius_set_bgcolor($css,$bgcolor);
    

    $headercolor = 
        check_css_setting($theme->settings->headercolor);

    $css = archaius_set_headercolor($css,$headercolor);

    $currentcolor = 
        check_css_setting($theme->settings->currentcolor);

    $css = archaius_set_currentcolor($css,$currentcolor);


    $currentcustommenucolor = 
        check_css_setting($theme->settings->currentcustommenucolor);
    
    $css = archaius_set_currentcustommenucolor($css,$currentcustommenucolor);

    $custommenucolor =
        check_css_setting($theme->settings->custommenucolor);

    $css = archaius_set_custommenucolor($css,$custommenucolor);

    $slideshowheight =
        check_css_setting($theme->settings->slideshowheight);

    $css = archaius_set_slideshowheight($css,$slideshowheight);

    return $css;
}


function check_css_setting($setting){
    if (!empty($setting)) 
        return $setting;
    return null;
}

function archaius_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement) ) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

function archaius_set_customjs($js, $customjs) {
    $tag = '[[setting:customjs]]';
    $replacement = $customjs;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $js = str_replace($tag, $replacement, $js);

    return $js;
}

function archaius_set_theme_collasibleTopics($js, $collasible) {
    $tag = '[[theme_archaius/collasibleTopics]]';
    $replacement = $collasible;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $js = str_replace($tag, $replacement, $js);

    return $js;
}

function archaius_set_theme_hideShowBlocks($js, $collasible) {
    $tag = '[[theme_archaius/hideShowBlocks]]';
    $replacement = $collasible;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $js = str_replace($tag, $replacement, $js);

    return $js;
}

function archaius_set_theme_activateSlideshow($js, $collasible) {
    $tag = '[[theme_archaius/activateSlideshow]]';
    $replacement = $collasible;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $js = str_replace($tag, $replacement, $js);

    return $js;
}

function archaius_set_themecolor($css, $themecolor) {
    $tag = '[[setting:themecolor]]';
    $replacement = $themecolor;
    if (is_null($replacement)) {
        $replacement = '#2E3332';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function archaius_set_headercolor($css, $headercolor) {
    $tag = '[[setting:headercolor]]';
    $replacement = $headercolor;
    if (is_null($replacement)) {
        $replacement = '#697F6F';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function archaius_set_currentcolor($css, $currentcolor) {
    $tag = '[[setting:currentcolor]]';
    $replacement = $currentcolor;
    if (is_null($replacement)) {
        $replacement = '#697F6F';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function archaius_set_custommenucolor($css, $currentcustommenucolor) {
    $tag = '[[setting:custommenucolor]]';
    $replacement = $currentcustommenucolor;
    if (is_null($replacement)) {
        $replacement = '#697F6F';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function archaius_set_currentcustommenucolor($css, $currentcustommenucolor) {
    $tag = '[[setting:currentcustommenucolor]]';
    $replacement = $currentcustommenucolor;
    if (is_null($replacement)) {
        $replacement = '#2E3332';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function archaius_set_bgcolor($css, $bgcolor) {
  $tag = '[[setting:bgcolor]]';
  $replacement = $bgcolor;
  if (is_null($replacement)) {
    $replacement = '#F5F5F5';
  }
  $css = str_replace($tag, $replacement, $css);
  return $css;
}

function archaius_set_slideshowheight($css, $slideshowheight) {
  $tag = '[[setting:slideshowheight]]';
  $replacement = $slideshowheight. "px";
  if (is_null($replacement)) {
    $replacement = '300';
  }

  $css = str_replace($tag, $replacement, $css);
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


function theme_archaius_pluginfile($course, $cm, $context, $filearea, $args,
                                     $forcedownload, array $options = array()) {

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
        if (preg_match('/^\[\[([a-zA-Z0-9\-\_\:]+)\]\]$/', $this->text, $matches)) {
            try {
                $this->text = get_string($matches[1], 'theme_archaius');
            } catch (Exception $e) {
                $this->text = $matches[1];
            }
        }
 
        $matches = array();
        if (preg_match('/^\[\[([a-zA-Z0-9\-\_\:]+)\]\]$/', $this->title, $matches)) {
            try {
                $this->title = get_string($matches[1], 'theme_archaius');
            } catch (Exception $e) {
                $this->title = $matches[1];
            }
        }
    }
}


//Add jquery using Moodle standard way
function theme_archaius_page_init(moodle_page $page) { 
    $page->requires->jquery();
    $page->requires->jquery_plugin('responsive-slides', 'theme_archaius');
    $page->requires->jquery_plugin('velocity-jquery', 'theme_archaius');      
    $page->requires->jquery_plugin('accordion-blocks', 'theme_archaius');
}

