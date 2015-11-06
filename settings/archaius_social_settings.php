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

  $social_options = new admin_settingpage('theme_archaius_social', get_string('socialsectiontitle', 'theme_archaius'));
  $social_options->add(new admin_setting_heading('theme_archaius_social', get_string('socialsectionsub', 'theme_archaius'),
    format_text(get_string('socialsectiondesc', 'theme_archaius'), FORMAT_MARKDOWN)));

  // facebook
  $name = 'theme_archaius/facebook';
  $title = get_string('facebook','theme_archaius');
  $description = get_string('facebookdesc', 'theme_archaius');
  $default = null;
  $setting = new admin_setting_configtext(
    $name,
    $title,
    $description,
    $default,
    PARAM_TEXT
  );
  $setting->set_updatedcallback('theme_reset_all_caches');
  $social_options->add($setting);

  // twitter
  $name = 'theme_archaius/twitter';
  $title = get_string('twitter','theme_archaius');
  $description = get_string('twitterdesc', 'theme_archaius');
  $default = null;
  $setting = new admin_setting_configtext(
    $name,
    $title,
    $description,
    $default,
    PARAM_TEXT
  );
  $setting->set_updatedcallback('theme_reset_all_caches');
  $social_options->add($setting);

  // youtube
  $name = 'theme_archaius/youtube';
  $title = get_string('youtube','theme_archaius');
  $description = get_string('youtubedesc', 'theme_archaius');
  $default = null;
  $setting = new admin_setting_configtext(
    $name,
    $title,
    $description,
    $default,
    PARAM_TEXT
  );
  $setting->set_updatedcallback('theme_reset_all_caches');
  $social_options->add($setting);

  // linkedin
  $name = 'theme_archaius/linkedin';
  $title = get_string('linkedin','theme_archaius');
  $description = get_string('linkedindesc', 'theme_archaius');
  $default = null;
  $setting = new admin_setting_configtext(
    $name,
    $title,
    $description,
    $default,
    PARAM_TEXT
  );
  $setting->set_updatedcallback('theme_reset_all_caches');
  $social_options->add($setting);

  //Add options to admin tree
  $ADMIN->add('theme_archaius', $social_options);
}