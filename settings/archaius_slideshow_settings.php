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

  $slideshow_options = new admin_settingpage('theme_archaius_slideshow', get_string('slideshowsectiontitle', 'theme_archaius'));
  $slideshow_options->add(new admin_setting_heading('theme_archaius_slideshow', get_string('slideshowsectionsub', 'theme_archaius'),
    format_text(get_string('slideshowsectiondesc', 'theme_archaius'), FORMAT_MARKDOWN)));

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
  $slideshow_options->add($setting);

  //Activate pause/play Slideshow
  $name = "theme_archaius/activatePausePlaySlideshow";
  $title = get_string("activatePausePlaySlideshow", 'theme_archaius');
  $description = get_string('activatePausePlaySlideshowdesc', 'theme_archaius');
  $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
  $setting->set_updatedcallback('theme_reset_all_caches');
  $slideshow_options->add($setting);

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
  $slideshow_options->add($setting);


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
  $slideshow_options->add($setting);

  //Add options to admin tree
  $ADMIN->add('theme_archaius', $slideshow_options);
}