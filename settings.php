<?php

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    // Logo file setting
    $name = 'theme_chameleon/logo';
    $title = get_string('logo','theme_chameleon');
    $description = get_string('logodesc', 'theme_chameleon');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $settings->add($setting);

     // Foot note setting
    $name = 'theme_chameleon/footnote';
    $title = get_string('footnote','theme_chameleon');
    $description = get_string('footnotedesc', 'theme_chameleon');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $settings->add($setting);

    //Background color                                                                                                                                                               
    $name = 'theme_chameleon/bgcolor';
    $title = get_string('bgcolor','theme_chameleon');
    $description = get_string('bgcolordesc', 'theme_chameleon');
    $default = 'f5f5f5';
    $previewconfig = array('selector'=>'#page-header', 'style'=>'header');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    // theme color setting
    $name = 'theme_chameleon/themecolor';
    $title = get_string('themecolor','theme_chameleon');
    $description = get_string('themecolordesc', 'theme_chameleon');
    $default = '#444';
    $previewconfig = array('selector'=>'#page-header', 'style'=>'header');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    // blocks header colors
    $name = 'theme_chameleon/headercolor';
    $title = get_string('headercolor','theme_chameleon');
    $description = get_string('headercolordesc', 'theme_chameleon');
    $default = '#999';
    $previewconfig = array('selector'=> 'div.region-content div.header', 'style'=>'header');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    // blocks header current colors
    $name = 'theme_chameleon/currentcolor';
    $title = get_string('currentcolor','theme_chameleon');
    $description = get_string('currentcolordesc', 'theme_chameleon');
    $default = '#444';
    $previewconfig = array('selector'=> 'div.region-content div.header.current', 'style'=>'header');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    // custommenucurrent color
    $name = 'theme_chameleon/currentcustommenucolor';
    $title = get_string('currentcustommenucolor','theme_chameleon');
    $description = get_string('currentcustommenucolor', 'theme_chameleon');
    $default = '#999';
    $previewconfig = array('selector'=> 'div.region-content div.header.current', 'style'=>'header');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    // Custom CSS file
    $name = 'theme_chameleon/customcss';
    $title = get_string('customcss','theme_chameleon');
    $description = get_string('customcssdesc', 'theme_chameleon');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $settings->add($setting);

    //Activate 
    $name = "theme_chameleon/collasibleTopics";
    $title = get_string("collapsibleTopics", 'theme_chameleon');
    $description = get_string('collasibleTopicsdesc', 'theme_chameleon');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 1);
    $settings->add($setting);

    // Custom Javascript file
    $name = 'theme_chameleon/customjs';
    $title = get_string('customjs','theme_chameleon');
    $description = get_string('customjsdesc', 'theme_chameleon');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $settings->add($setting);

}