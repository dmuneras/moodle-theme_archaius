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
 */

/**
* Functions needed by the archaius theme should be put here.
* Any functions that get created here should ALWAYS contain the theme name
* to reduce complications for other theme designers who may be copying this
*theme.
* @package   theme_archaius
* @copyright 2012 onwards Daniel Munera Sanchez  {@link http://dmuneras.com}
* @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*
*/

/* ARCHAIUS VIEW HELPER
-----------------------------------------------------------------------------*/

class ArchaiusViewHelper {
  public static function add_protocole_to_url($url){
    $pattern = '/^(http|https):\/\//';
    if(!preg_match($pattern, $url)){
      return "http://" . $url;
    }
    return $url;
  }
}