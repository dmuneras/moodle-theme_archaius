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

  $footer_options = new admin_settingpage('theme_archaius_footer', get_string('footersectiontitle', 'theme_archaius'));
  $footer_options->add(new admin_setting_heading('theme_archaius_footer', get_string('footersectionsub', 'theme_archaius'),
    format_text(get_string('footersectiondesc', 'theme_archaius'), FORMAT_MARKDOWN)));

  // Foot note setting
  $name = 'theme_archaius/footnote';
  $title = get_string('footnote','theme_archaius');
  $description = get_string('footnotedesc', 'theme_archaius');
  $default = '';
  $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
  $setting->set_updatedcallback('theme_reset_all_caches');
  $footer_options->add($setting);

   // footer text color
  $name = 'theme_archaius/footertextcolor';
  $title = get_string('footertextcolor','theme_archaius');
  $description = get_string('footertextcolordesc', 'theme_archaius');
  $default = '#F5F5F5';
  $previewconfig = array(
    'selector'=> '#page-footer, #page-footer a',
    'style'=>'color'
  );
  $setting = new admin_setting_configcolourpicker(
    $name,
    $title,
    $description,
    $default,
    $previewconfig
  );
  $setting->set_updatedcallback('theme_reset_all_caches');
  $footer_options->add($setting);

  //Add options to admin tree
  $ADMIN->add('theme_archaius', $footer_options);
}