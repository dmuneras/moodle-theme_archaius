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

// Idea from Essential theme. reason: I have too many options for one page
// I don't want to have a huge file with a lot of options, I want small setting
// sections instead
$settings = null;

if ( is_siteadmin() ) {
  $ADMIN->add('themes', new admin_category('theme_archaius', 'Archaius'));
  include 'settings/archaius_logos_settings.php';
  include 'settings/archaius_layout_color_settings.php';
  include 'settings/archaius_footer_settings.php';
  include 'settings/archaius_slideshow_settings.php';
  include 'settings/archaius_javascript_effects_settings.php';
  include 'settings/archaius_social_settings.php';
  include 'settings/archaius_developer_settings.php';
}