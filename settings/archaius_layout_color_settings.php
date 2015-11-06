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
@copyright  2015 onwards Daniel Munera Sanchez

*/

defined('MOODLE_INTERNAL') || die;

if ( is_siteadmin() ) {

  $layout_color_options = new admin_settingpage('theme_archaius_layout_colors', get_string('layoutcolorssectiontitle', 'theme_archaius'));
  $layout_color_options->add(new admin_setting_heading('theme_archaius_layout_colors', get_string('layoutcolorssectionsub', 'theme_archaius'),
    format_text(get_string('layoutcolorssectiondesc', 'theme_archaius'), FORMAT_MARKDOWN)));

  // Login background image
  $name = 'theme_archaius/loginbackgroundimage';
  $title = get_string('loginbackgroundimage','theme_archaius');
  $description = get_string('loginbackgroundimagedesc', 'theme_archaius');
  $setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbackgroundimage');
  $setting->set_updatedcallback('theme_reset_all_caches');
  $layout_color_options->add($setting);

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
  $layout_color_options->add($setting);

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
  $layout_color_options->add($setting);

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
  $layout_color_options->add($setting);

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
  $layout_color_options->add($setting);

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
  $layout_color_options->add($setting);


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
  $layout_color_options->add($setting);

  //Add options to admin tree
  $ADMIN->add('theme_archaius', $layout_color_options);

}


