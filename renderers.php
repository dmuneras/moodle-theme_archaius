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

class theme_archaius_core_renderer extends core_renderer {

    /**
     * Prints a nice side block with an optional header.
     *
     * The content is described
     * by a {@link block_contents} object.
     *
     * @param block_contents $bc HTML for the content
     * @param string $region the region the block is appearing in.
     * @return string the HTML to be output.
     */
    function block(block_contents $bc, $region) {

        $bc = clone($bc); // Avoid messing up the object passed in.
        if (empty($bc->blockinstanceid) || !strip_tags($bc->title)) {
            $bc->collapsible = block_contents::NOT_HIDEABLE;
        }
        if ($bc->collapsible == block_contents::HIDDEN) {
            $bc->add_class('hidden');
        }
        if (!empty($bc->controls)) {
            $bc->add_class('block_with_controls');
        }

        $skiptitle = strip_tags($bc->title);
        if (empty($skiptitle)) {
            $output = '';
            $skipdest = '';
        } else {
            $output = html_writer::tag('a', get_string('skipa', 'access', $skiptitle), array('href' => '#sb-' . $bc->skipid, 'class' => 'skip-block'));
            $skipdest = html_writer::tag('span', '', array('id' => 'sb-' . $bc->skipid, 'class' => 'skip-block-to'));
        }

         $title = '';
        if ($bc->title) {
            $title = html_writer::tag('h2', $bc->title);
        }

        $controlshtml = $this->block_controls($bc->controls);

        if ($title || $controlshtml) {
            $output .= html_writer::tag('div', html_writer::tag('div',  $title , array('class' => 'title')), array('class' => 'header-tab'));
        }

        $output .= html_writer::start_tag('div', $bc->attributes);

        if ($title || $controlshtml) {
            $output .= html_writer::tag('div', html_writer::tag('div', html_writer::tag('div', '', array('class'=>'block_action')). $title . $controlshtml, array('class' => 'title')), array('class' => 'header'));
        }

        $output .= html_writer::start_tag('div', array('class' => 'content'));
        if (!$title && !$controlshtml) {
            $output .= html_writer::tag('div', '', array('class'=>'block_action notitle'));
        }
        $output .= $bc->content;

        if ($bc->footer) {
            $output .= html_writer::tag('div', $bc->footer, array('class' => 'footer'));
        }

        $output .= html_writer::end_tag('div');

 
        $output .= html_writer::end_tag('div');

        if ($bc->annotation) {
            $output .= html_writer::tag('div', $bc->annotation, array('class' => 'blockannotation'));
        }
        $output .= $skipdest;

        $this->init_block_hider_js($bc);

        return $output;
    }

    /**
     * Output all the blocks in a particular region.
     * NOTE: Here I allow to set user preference using JS, the
     * preference have the following struture:
     * theme_archaius_blocks_region_$regionname_context_$contextid_page_type_$pagetype_sub_$subpage
     * @param string $region the name of a region on this page.
     * @return string the HTML to be output.
     */
    public function blocks_for_region($region) {
        $user_preference = '';
        if(strcmp($region, "side-pre") == 0  || 
            strcmp($region, "side-post") == 0 ){

            $user_preference .= 
                "theme_archaius_blocks_region_" . $region . 
                "_context_". $this->page->context->id .
                "_page_type_" . $this->page->pagetype;

            if(! empty($this->page->subpage)){
                $user_preference .= "_sub_" . $this->page->subpage;    
            }
        }
        //Allow user preference update from javascript
        user_preference_allow_ajax_update($user_preference, PARAM_INT);

        $blockcontents = $this->page->blocks->get_content_for_region($region, $this);

        $blocks = $this->page->blocks->get_blocks_for_region($region);
        $lastblock = null;
        $zones = array();
        foreach ($blocks as $block) {
            $zones[] = $block->title;
        }
        $output = '';

        foreach ($blockcontents as $bc) {
            if ($bc instanceof block_contents) {
                $output .= $this->block($bc, $region);
                $lastblock = $bc->title;
            } else if ($bc instanceof block_move_target) {
                $output .= $this->block_move_target($bc, $zones, $lastblock, $region);
            } else {
                throw new coding_exception('Unexpected type of thing (' . 
                    get_class($bc) . ') found in list of block contents.');
            }
        }
        return $output;
    }


    /*
     * From boostrapbase
     * Overriding the custom_menu function ensures the custom menu is
     * always shown, even if no menu items are configured in the global
     * theme settings page.
     */
    public function custom_menu($custommenuitems = '') {
        global $CFG;

        //TODO: Check this in a different way
        $langs = get_string_manager()->get_list_of_translations();
        if ( (count($langs) < 2) and (empty($CFG->custommenuitems))) {
            return '';
        }else{
            if (!empty($CFG->custommenuitems))
                $custommenuitems .= $CFG->custommenuitems;
            $custommenu = new custom_menu($custommenuitems, current_language());
            return $this->render_custom_menu($custommenu);
        }
    }

    // http://docs.moodle.org/dev/Extending_the_theme_custom_menu
    protected function render_custom_menu(custom_menu $menu) {
 
        global $CFG;
        require_once($CFG->dirroot.'/course/lib.php');

        //navigation mycourses is no supported since 2.4
        if (isloggedin() && !isguestuser() && 
            $mycourses = enrol_get_my_courses(NULL, 'visible DESC, fullname ASC')) {  
 
            $branchlabel = get_string('mycourses') ;
            $branchurl   = new moodle_url('/course/index.php');
            $branchtitle = $branchlabel;
            $branchsort  = 8000 ;
            $branch = $menu->add($branchlabel, $branchurl, $branchtitle, $branchsort);
 
            foreach ($mycourses as $mycourse) {
                $branch->add($mycourse->shortname, new moodle_url(
                    '/course/view.php', 
                    array('id' => $mycourse->id)), 
                    $mycourse->fullname
                );
            }
        }

        $course_id = $this->page->course->id;
        if (isloggedin() && $course_id > 1) {
            $branchlabel = get_string('grades');
            $branchurl   = new moodle_url('/grade/report/index.php?id='.$this->page->course->id);
            $branchtitle = $branchlabel;
            $branchsort  = 9000;
            $branch = $menu->add($branchlabel, $branchurl, $branchtitle, $branchsort);
        }

        //From boostrapbase

        // TODO: eliminate this duplicated logic, it belongs in core, not
        // here. See MDL-39565.
        $addlangmenu = true;
        $langs = get_string_manager()->get_list_of_translations();
        if (
            count($langs) < 2
            or empty($CFG->langmenu)
            or ($this->page->course != SITEID 
            and !empty($this->page->course->lang))) {

            $addlangmenu = false;
        }

        if ($addlangmenu) {
            $branchlabel =  get_string('language');
            $branchurl = new moodle_url('#');
            $branch = $menu->add($branchlabel, $branchurl, $branchlabel, 10000);

            foreach ($langs as $langtype => $langname) {
                $branch->add($langname, 
                    new moodle_url(
                        $this->page->url, 
                        array('lang' => $langtype)
                    ), 
                    $langname
                );
            }
        }
        return parent::render_custom_menu($menu);
    }
 
    protected function render_custom_menu_item(custom_menu_item $menunode) {
        $transmutedmenunode = new theme_archaius_transmuted_custom_menu_item($menunode);
        return parent::render_custom_menu_item($transmutedmenunode);
    }
}