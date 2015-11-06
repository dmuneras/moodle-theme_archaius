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

  $developer_options = new admin_settingpage('theme_archaius_developer', get_string('developersectiontitle', 'theme_archaius'));
  $developer_options->add(new admin_setting_heading('theme_archaius_developer', get_string('developersectionsub', 'theme_archaius'),
    format_text(get_string('developersectiondesc', 'theme_archaius'), FORMAT_MARKDOWN)));

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
  $developer_options->add($setting);

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
  $developer_options->add($setting);


  //Add options to admin tree
  $ADMIN->add('theme_archaius', $developer_options);
}