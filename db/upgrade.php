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
@copyright  2013 Daniel Munera Sanchez

*/

defined('MOODLE_INTERNAL') || die();
 
function xmldb_theme_archaius_upgrade($oldversion){

    // Define table theme_archaius to be created.
    global $CFG, $THEME, $DB;
    
	if ($oldversion < 2013090500) {

        $dbman = $DB->get_manager(); /// loads ddl manager and xmldb classes
        $table = new xmldb_table('theme_archaius');

        // Adding fields to table theme_archaius.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('itemid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('description', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('position', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('descriptionformat', XMLDB_TYPE_INTEGER, '2', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('descriptiontrust', XMLDB_TYPE_INTEGER, '2', null, XMLDB_NOTNULL, null, '0');

        // Adding keys to table theme_archaius.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

        // Conditionally launch create table for theme_archaius.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Archaius savepoint reached.
        upgrade_plugin_savepoint(true, 2013090500, 'theme', 'archaius');
    }
    return true;
}