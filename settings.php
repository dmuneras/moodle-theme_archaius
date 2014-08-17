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
@copyright  2013 onwards Daniel Munera Sanchez

*/

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    // Logo file setting
    $name = 'theme_archaius/logo';
    $title = get_string('logo','theme_archaius');
    $description = get_string('logodesc', 'theme_archaius');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    //Mobile Logo setting
    $name = 'theme_archaius/mobilelogo';
    $title = get_string('mlogo','theme_archaius');
    $description = get_string('mlogodesc', 'theme_archaius');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'mobilelogo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

     // Foot note setting
    $name = 'theme_archaius/footnote';
    $title = get_string('footnote','theme_archaius');
    $description = get_string('footnotedesc', 'theme_archaius');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    //Background color                                                                                                                                                               
    $name = 'theme_archaius/bgcolor';
    $title = get_string('bgcolor','theme_archaius');
    $description = get_string('bgcolordesc', 'theme_archaius');
    $default = '#fff';
    $previewconfig = array(
        'selector'=>'html,body',
        'style'=>'backgroundColor'
    );
    $setting = new admin_setting_configcolourpicker(
        $name, 
        $title, 
        $description, 
        $default, 
        $previewconfig
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // theme color setting
    $name = 'theme_archaius/themecolor';
    $title = get_string('themecolor','theme_archaius');
    $description = get_string('themecolordesc', 'theme_archaius');
    $default = '#2E3332';
    $previewconfig = array(
        'selector'=>'#page-header,#page-footer',
        'style'=>'backgroundColor'
    );
    $setting = new admin_setting_configcolourpicker(
        $name, 
        $title, 
        $description, 
        $default, 
        $previewconfig
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // blocks header colors
    $name = 'theme_archaius/headercolor';
    $title = get_string('headercolor','theme_archaius');
    $description = get_string('headercolordesc', 'theme_archaius');
    $default = '#697F6F';
    $previewconfig = array(
        'selector'=> '.header-tab', 
        'style'=>'backgroundColor'
    );
    $setting = new admin_setting_configcolourpicker(
        $name, 
        $title, 
        $description, 
        $default, 
        $previewconfig
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // blocks header current colors
    $name = 'theme_archaius/currentcolor';
    $title = get_string('currentcolor','theme_archaius');
    $description = get_string('currentcolordesc', 'theme_archaius');
    $default = '#2E3332';
    $previewconfig = array(
        'selector'=> '.header-tab.current', 
        'style'=>'backgroundColor'
    );
    $setting = new admin_setting_configcolourpicker(
        $name, 
        $title, 
        $description, 
        $default, 
        $previewconfig
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // custommenu color
    $name = 'theme_archaius/custommenucolor';
    $title = get_string('custommenucolor','theme_archaius');
    $description = get_string('custommenucolor', 'theme_archaius');
    $default = '#697F6F';
    $previewconfig = array(
        'selector'=> '#custommenu',
        'style'=>'backgroundColor'
    );
    $setting = new admin_setting_configcolourpicker(
        $name, 
        $title, 
        $description, 
        $default, 
        $previewconfig
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);


    // custommenucurrent color
    $name = 'theme_archaius/currentcustommenucolor';
    $title = get_string('currentcustommenucolor','theme_archaius');
    $description = get_string('currentcustommenucolor', 'theme_archaius');
    $default = '#2E3332';
    $previewconfig = array(
        'selector'=> 'div.region-content div.header.current',
        'style'=>'backgroundColor'
    );
    $setting = new admin_setting_configcolourpicker(
        $name, 
        $title, 
        $description, 
        $default, 
        $previewconfig
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);


    // Activate accordion blocks
    $name = "theme_archaius/accordionBlocks";
    $title = get_string("accordionBlocks", 'theme_archaius');
    $description = get_string('accordionBlocksdesc', 'theme_archaius');
    $setting = new admin_setting_configcheckbox(
        $name, 
        $title, 
        $description, 
        1
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    //Activate collapsible topics
    $name = "theme_archaius/collasibleTopics";
    $title = get_string("collapsibleTopics", 'theme_archaius');
    $description = get_string('collasibleTopicsdesc', 'theme_archaius');
    $setting = new admin_setting_configcheckbox(
        $name, 
        $title, 
        $description, 
        1
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    //Activate Hide Show Blocks 
    $name = "theme_archaius/hideShowBlocks";
    $title = get_string("hideShowBlocks", 'theme_archaius');
    $description = get_string('hideShowBlocksdesc', 'theme_archaius');
    $setting = new admin_setting_configcheckbox(
        $name, 
        $title, 
        $description, 
        1
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    //Activate Slideshow
    $name = "theme_archaius/activateSlideshow";
    $title = get_string("activateSlideshow", 'theme_archaius');
    $description = get_string('activateSlideshowdesc', 'theme_archaius');
    $setting = new admin_setting_configcheckbox(
        $name, 
        $title, 
        $description, 
        0
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    //Activate pause/play Slideshow
    $name = "theme_archaius/activatePausePlaySlideshow";
    $title = get_string("activatePausePlaySlideshow", 'theme_archaius');
    $description = get_string('activatePausePlaySlideshowdesc', 'theme_archaius');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Slideshow Timeout
    $name = 'theme_archaius/slideshowTimeout';
    $title = get_string('slideshowTimeout','theme_archaius');
    $description = get_string('slideshowTimeoutdesc', 'theme_archaius');
    $default = 1500;
    $setting = new admin_setting_configtext(
        $name, 
        $title, 
        $description, 
        $default, 
        PARAM_INT
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);


    // Slideshow height
    $name = 'theme_archaius/slideshowheight';
    $title = get_string('slideshowheight','theme_archaius');
    $description = get_string('slideshowheightdesc', 'theme_archaius');
    $default = 200;
    $setting = new admin_setting_configtext(
        $name, 
        $title, 
        $description, 
        $default, 
        PARAM_RAW
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);


     // Custom CSS file
    $name = 'theme_archaius/customcss';
    $title = get_string('customcss','theme_archaius');
    $description = get_string('customcssdesc', 'theme_archaius');
    $default = '';
    $setting = new admin_setting_configtextarea(
        $name, 
        $title, 
        $description, 
        $default
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Custom Javascript file
    $name = 'theme_archaius/customjs';
    $title = get_string('customjs','theme_archaius');
    $description = get_string('customjsdesc', 'theme_archaius');
    $default = '';
    $setting = new admin_setting_configtextarea(
        $name, 
        $title, 
        $description, 
        $default
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);
}