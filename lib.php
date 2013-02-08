<?php

/*
*
 * Functions needed by the macondo theme should be put here.
 *
 * Any functions that get created here should ALWAYS contain the theme name
 * to reduce complications for other theme designers who may be copying this theme.
 */

function macondo_process_css($css, $theme) {

    // Set the background image for the logo
    if (!empty($theme->settings->logo)) {
        $logo = $theme->settings->logo;
    } else {
        $logo = null;
    }
    $css = macondo_set_logo($css, $logo);

    // Set custom CSS
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = macondo_set_customcss($css, $customcss);

    if (!empty($theme->settings->themecolor)) {
        $themecolor = $theme->settings->themecolor;
    } else {
        $themecolor = null;
    }

    $css = macondo_set_themecolor($css,$themecolor);

    if (!empty($theme->settings->bgcolor)) {
      $bgcolor = $theme->settings->bgcolor;
    } else {
      $bgcolor = null;
    }

    $css = macondo_set_bgcolor($css,$bgcolor);
    
    if (!empty($theme->settings->headercolor)) {
        $headercolor = $theme->settings->headercolor;
    } else {
        $headercolor = null;
    }

    $css = macondo_set_headercolor($css,$headercolor);

    if (!empty($theme->settings->currentcolor)) {
        $currentcolor = $theme->settings->currentcolor;
    } else {
        $currentcolor = null;
    }

    $css = macondo_set_currentcolor($css,$currentcolor);

    if (!empty($theme->settings->currentcustommenucolor)) {
        $currentcustommenucolor = $theme->settings->currentcustommenucolor;
    } else {
        $currentcustommenucolor = null;
    }

    $css = macondo_set_currentcustommenucolor($css,$currentcustommenucolor);

    return $css;
}

function macondo_set_logo($css, $logo) {
    global $OUTPUT;
    $tag = '[[setting:logo]]';
    $replacement = $logo;
    if (is_null($replacement)) {
        $replacement = $OUTPUT->pix_url('images/logo','theme');
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}


function macondo_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement) ) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

function macondo_set_customjs($js, $customjs) {
    $tag = '[[setting:customjs]]';
    $replacement = $customjs;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $js = str_replace($tag, $replacement, $js);

    return $js;
}

function macondo_set_theme_collasibleTopics($js, $collasible) {
    $tag = '[[theme_macondo/collasibleTopics]]';
    $replacement = $collasible;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $js = str_replace($tag, $replacement, $js);

    return $js;
}

function macondo_set_themecolor($css, $themecolor) {
    $tag = '[[setting:themecolor]]';
    $replacement = $themecolor;
    if (is_null($replacement)) {
        $replacement = '#444';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function macondo_set_headercolor($css, $headercolor) {
    $tag = '[[setting:headercolor]]';
    $replacement = $headercolor;
    if (is_null($replacement)) {
        $replacement = '#999';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function macondo_set_currentcolor($css, $currentcolor) {
    $tag = '[[setting:currentcolor]]';
    $replacement = $currentcolor;
    if (is_null($replacement)) {
        $replacement = '#444';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function macondo_set_currentcustommenucolor($css, $currentcustommenucolor) {
    $tag = '[[setting:currentcustommenucolor]]';
    $replacement = $currentcustommenucolor;
    if (is_null($replacement)) {
        $replacement = '#999';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function macondo_set_bgcolor($css, $bgcolor) {
  $tag = '[[setting:bgcolor]]';
  $replacement = $bgcolor;
  if (is_null($replacement)) {
    $replacement = '#F5F5F5';
  }
  $css = str_replace($tag, $replacement, $css);
  return $css;
}



