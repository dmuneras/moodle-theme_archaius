<?php

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    // Logo file setting
    $name = 'theme_macondo/logo';
    $title = get_string('logo','theme_macondo');
    $description = get_string('logodesc', 'theme_macondo');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $settings->add($setting);

     // Foot note setting
    $name = 'theme_macondo/footnote';
    $title = get_string('footnote','theme_macondo');
    $description = get_string('footnotedesc', 'theme_macondo');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $settings->add($setting);

    //Background color                                                                                                                                                               
    $name = 'theme_macondo/bgcolor';
    $title = get_string('bgcolor','theme_macondo');
    $description = get_string('bgcolordesc', 'theme_macondo');
    $default = 'f5f5f5';
    $previewconfig = array('selector'=>'#page-header', 'style'=>'header');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    // theme color setting
    $name = 'theme_macondo/themecolor';
    $title = get_string('themecolor','theme_macondo');
    $description = get_string('themecolordesc', 'theme_macondo');
    $default = '#444';
    $previewconfig = array('selector'=>'#page-header', 'style'=>'header');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    // blocks header colors
    $name = 'theme_macondo/headercolor';
    $title = get_string('headercolor','theme_macondo');
    $description = get_string('headercolordesc', 'theme_macondo');
    $default = '#999';
    $previewconfig = array('selector'=> 'div.region-content div.header', 'style'=>'header');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    // blocks header current colors
    $name = 'theme_macondo/currentcolor';
    $title = get_string('currentcolor','theme_macondo');
    $description = get_string('currentcolordesc', 'theme_macondo');
    $default = '#444';
    $previewconfig = array('selector'=> 'div.region-content div.header.current', 'style'=>'header');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    // custommenucurrent color
    $name = 'theme_macondo/currentcustommenucolor';
    $title = get_string('currentcustommenucolor','theme_macondo');
    $description = get_string('currentcustommenucolor', 'theme_macondo');
    $default = '#999';
    $previewconfig = array('selector'=> 'div.region-content div.header.current', 'style'=>'header');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    // Custom CSS file
    $name = 'theme_macondo/customcss';
    $title = get_string('customcss','theme_macondo');
    $description = get_string('customcssdesc', 'theme_macondo');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $settings->add($setting);

    //Activate 
    $name = "theme_macondo/collasibleTopics";
    $title = get_string("collapsibleTopics", 'theme_macondo');
    $description = get_string('collasibleTopicsdesc', 'theme_macondo');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 1);
    $settings->add($setting);

    // Custom Javascript file
    $name = 'theme_macondo/customjs';
    $title = get_string('customjs','theme_macondo');
    $description = get_string('customjsdesc', 'theme_macondo');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $settings->add($setting);

}