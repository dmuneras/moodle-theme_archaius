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

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    // Logo file setting
    $name = 'theme_archaius/logo';
    $title = get_string('logo','theme_archaius');
    $description = get_string('logodesc', 'theme_archaius');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $settings->add($setting);

     // Foot note setting
    $name = 'theme_archaius/footnote';
    $title = get_string('footnote','theme_archaius');
    $description = get_string('footnotedesc', 'theme_archaius');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $settings->add($setting);

    //Background color                                                                                                                                                               
    $name = 'theme_archaius/bgcolor';
    $title = get_string('bgcolor','theme_archaius');
    $description = get_string('bgcolordesc', 'theme_archaius');
    $default = '#fff';
    $previewconfig = array('selector'=>'#page-header', 'style'=>'header');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    // theme color setting
    $name = 'theme_archaius/themecolor';
    $title = get_string('themecolor','theme_archaius');
    $description = get_string('themecolordesc', 'theme_archaius');
    $default = '#2E3332';
    $previewconfig = array('selector'=>'#page-header', 'style'=>'header');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    // blocks header colors
    $name = 'theme_archaius/headercolor';
    $title = get_string('headercolor','theme_archaius');
    $description = get_string('headercolordesc', 'theme_archaius');
    $default = '#697F6F';
    $previewconfig = array('selector'=> 'div.region-content div.header', 'style'=>'header');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    // blocks header current colors
    $name = 'theme_archaius/currentcolor';
    $title = get_string('currentcolor','theme_archaius');
    $description = get_string('currentcolordesc', 'theme_archaius');
    $default = '#2E3332';
    $previewconfig = array('selector'=> 'div.region-content div.header.current', 'style'=>'header');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    // custommenucurrent color
    $name = 'theme_archaius/currentcustommenucolor';
    $title = get_string('currentcustommenucolor','theme_archaius');
    $description = get_string('currentcustommenucolor', 'theme_archaius');
    $default = '#2E3332';
    $previewconfig = array('selector'=> 'div.region-content div.header.current', 'style'=>'header');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    //Activate 
    $name = "theme_archaius/collasibleTopics";
    $title = get_string("collapsibleTopics", 'theme_archaius');
    $description = get_string('collasibleTopicsdesc', 'theme_archaius');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 1);
    $settings->add($setting);

    //Activate 
    $name = "theme_archaius/hideShowBlocks";
    $title = get_string("hideShowBlocks", 'theme_archaius');
    $description = get_string('hideShowBlocksdesc', 'theme_archaius');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 1);
    $settings->add($setting);

    //Activate 
    $name = "theme_archaius/activateSlideshow";
    $title = get_string("activateSlideshow", 'theme_archaius');
    $description = get_string('activateSlideshowdesc', 'theme_archaius');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $settings->add($setting);

     // Custom CSS file
    $name = 'theme_archaius/customcss';
    $title = get_string('customcss','theme_archaius');
    $description = get_string('customcssdesc', 'theme_archaius');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $settings->add($setting);

    // Custom Javascript file
    $name = 'theme_archaius/customjs';
    $title = get_string('customjs','theme_archaius');
    $description = get_string('customjsdesc', 'theme_archaius');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $settings->add($setting);


}