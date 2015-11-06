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

  $javascript_effects_options = new admin_settingpage('theme_archaius_js', get_string('jssectiontitle', 'theme_archaius'));
  $javascript_effects_options->add(new admin_setting_heading('theme_archaius_js', get_string('jssectionsub', 'theme_archaius'),
    format_text(get_string('jssectiondesc', 'theme_archaius'), FORMAT_MARKDOWN)));

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
  $javascript_effects_options->add($setting);

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
  $javascript_effects_options->add($setting);

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
  $javascript_effects_options->add($setting);

  //Add options to admin tree
  $ADMIN->add('theme_archaius', $javascript_effects_options);
}