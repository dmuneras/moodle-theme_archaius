<?php

/*
*
 * Functions needed by the archaius theme should be put here.
 *
 * Any functions that get created here should ALWAYS contain the theme name
 * to reduce complications for other theme designers who may be copying this theme.
 */

function archaius_process_css($css, $theme) {

    // Set the background image for the logo
    if (!empty($theme->settings->logo)) {
        $logo = $theme->settings->logo;
    } else {
        $logo = null;
    }
    $css = archaius_set_logo($css, $logo);

    // Set custom CSS
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = archaius_set_customcss($css, $customcss);

    if (!empty($theme->settings->themecolor)) {
        $themecolor = $theme->settings->themecolor;
    } else {
        $themecolor = null;
    }

    $css = archaius_set_themecolor($css,$themecolor);

    if (!empty($theme->settings->bgcolor)) {
      $bgcolor = $theme->settings->bgcolor;
    } else {
      $bgcolor = null;
    }

    $css = archaius_set_bgcolor($css,$bgcolor);
    
    if (!empty($theme->settings->headercolor)) {
        $headercolor = $theme->settings->headercolor;
    } else {
        $headercolor = null;
    }

    $css = archaius_set_headercolor($css,$headercolor);

    if (!empty($theme->settings->currentcolor)) {
        $currentcolor = $theme->settings->currentcolor;
    } else {
        $currentcolor = null;
    }

    $css = archaius_set_currentcolor($css,$currentcolor);

    if (!empty($theme->settings->currentcustommenucolor)) {
        $currentcustommenucolor = $theme->settings->currentcustommenucolor;
    } else {
        $currentcustommenucolor = null;
    }

    $css = archaius_set_currentcustommenucolor($css,$currentcustommenucolor);

    return $css;
}

function archaius_set_logo($css, $logo) {
    global $OUTPUT;
    $tag = '[[setting:logo]]';
    $replacement = $logo;
    if (is_null($replacement)) {
        $replacement = $OUTPUT->pix_url('images/logo','theme');
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
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
        $replacement = '#A7A39B';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function archaius_set_currentcolor($css, $currentcolor) {
    $tag = '[[setting:currentcolor]]';
    $replacement = $currentcolor;
    if (is_null($replacement)) {
        $replacement = '#2E3332';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function archaius_set_currentcustommenucolor($css, $currentcustommenucolor) {
    $tag = '[[setting:currentcustommenucolor]]';
    $replacement = $currentcustommenucolor;
    if (is_null($replacement)) {
        $replacement = '#342917';
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



//Callback function to get files related with the carousel of information on
//the frontpage.
function theme_archaius_pluginfile($course, $cm, $context, $filearea, $args,
                                     $forcedownload, array $options = array()) {

    if ($context->contextlevel == CONTEXT_SYSTEM) {
        $fs = get_file_storage();
        $relativepath = implode('/', $args);
        $fullpath = "/$context->id/theme_archaius/$filearea/$relativepath";
        $hash = sha1($fullpath);
        $file = $fs->get_file_by_hash($hash);
        if (!$file or $file->is_directory()) {
            return false;
        
        } else {
            return send_stored_file($file, 86400, 0, $forcedownload, $options);
        }
    }
}


//To translate items in the customenu, it is from:
// http://docs.moodle.org/dev/Extending_the_theme_custom_menu
class theme_archaius_transmuted_custom_menu_item extends custom_menu_item {
    public function __construct(custom_menu_item $menunode) {
        parent::__construct($menunode->get_text(), $menunode->get_url(), 
            $menunode->get_title(), $menunode->get_sort_order(), $menunode->get_parent());
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


