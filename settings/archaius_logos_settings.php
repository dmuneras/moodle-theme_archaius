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

  $logos_options = new admin_settingpage('theme_archaius_logos', get_string('logossectiontitle', 'theme_archaius'));
  $logos_options->add(new admin_setting_heading('theme_archaius_logos', get_string('logossectionsub', 'theme_archaius'),
      format_text(get_string('logossectiondesc', 'theme_archaius'), FORMAT_MARKDOWN)));

  // Logo file setting
  $name = 'theme_archaius/logo';
  $title = get_string('logo','theme_archaius');
  $description = get_string('logodesc', 'theme_archaius');
  $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
  $setting->set_updatedcallback('theme_reset_all_caches');
  $logos_options->add($setting);

  //Mobile Logo setting
  $name = 'theme_archaius/mobilelogo';
  $title = get_string('mlogo','theme_archaius');
  $description = get_string('mlogodesc', 'theme_archaius');
  $setting = new admin_setting_configstoredfile($name, $title, $description, 'mobilelogo');
  $setting->set_updatedcallback('theme_reset_all_caches');
  $logos_options->add($setting);

  //Add options to admin tree
  $ADMIN->add('theme_archaius', $logos_options);
}