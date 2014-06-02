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
@copyright  2013 Daniel Munera Sanchez

*/

////////////////////////////////////////////////////////////////////////////////
/// This file contains a few configuration variables that control
/// how Moodle uses this theme.
////////////////////////////////////////////////////////////////////////////////

$THEME->name = 'archaius';

$THEME->sheets = array(
    'base_less',
    'archaius_less',
    'archaius_responsive_less',
    'course_less',
    'home_less',
    'boilerplate',
    'custom'
);

$THEME->doctype = 'html5';
$THEME->parents = array('base');  
$THEME->parents_exclude_sheets = array(
    'base'=>array(
        'dock'
    )
);

$THEME->editor_sheets = array('editor');

$THEME->layouts = array(
    // Most pages - if we encounter an unknown or a missing page type, this one is used.
    'base' => array(
        'file' => 'general.php',
        'regions' => array()
    ),
    'standard' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-post',
        'options' => array('langmenu' => true)
    ),
    // Course page
    'course' => array(
        'file' => 'general.php',
        'regions' => array('side-pre','side-post',
            'side-center-pre','side-center-post'),
        'defaultregion' => 'side-pre', 
        'options' => array('langmenu' => true, 'nonavbar' => false)
    ),
    // Course page
    'coursecategory' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-post',
        'options' => array('langmenu' => true)
    ),
    'incourse' => array(
        'file' => 'general.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
        'options' => array('langmenu' => true)
    ),
    'frontpage' => array(
        'file' => 'frontpage.php',
        'regions' => array('side-pre', 'side-post',
            'side-center-pre','side-center-post'),
        'defaultregion' => 'side-pre',
        'options' => array('langmenu' => true, 'nonavbar' => true, 'nosubtitle' => true)
    ),
    'admin' => array(
        'file' => 'general.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
        'options' => array('langmenu' => true)
    ),
    'mydashboard' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post',
            'side-center-pre','side-center-post'),
        'defaultregion' => 'side-post',
        'options' => array('langmenu' => true)
    ),
    'mypublic' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-post',
        'options' => array('langmenu' => true)
    ),
    'login' => array(
        'file' => 'general.php',
        'regions' => array()
    ),
    // Pages that appear in pop-up windows - no navigation, no blocks, no header.
    'popup' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'nonavbar'=>true, 'noblocks'=>true),
    ),
    // No blocks and minimal footer - used for legacy frame layouts only!
    'frametop' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('nofooter', 'noblocks'=>true),
    ),
    // Embeded pages, like iframe embeded in moodleform
    'embedded' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'nonavbar'=>true, 'noblocks'=>true),
    ),
    
    // Used during upgrade and install, and for the 'This site is undergoing maintenance' message.
    // This must not have any blocks, and it is good idea if it does not have links to
    // other places - for example there should not be a home link in the footer...
    'maintenance' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'nonavbar'=>true, 'noblocks'=>true),
    ),
    // Should display the content and basic headers only.
    'print' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'nonavbar'=>false, 'noblocks'=>true),
    ),
    'report' => array(
        'file' => 'report.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
        'options' => array('langmenu' => true)
    ),
);

$THEME->rendererfactory = 'theme_overridden_renderer_factory';


$THEME->javascripts_footer = array(
    'jquery-1.11.0.min',
    'modernizr',
    'archaius_custom_blocks-1.1.1.min',
    'responsiveslides.min',
    'archaius'
);

$THEME->enable_dock = false;

$THEME->editor_sheets = array('editor');
$THEME->csspostprocess = 'archaius_process_css';
