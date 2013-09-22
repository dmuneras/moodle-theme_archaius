<?php

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
            $branchurl   = new moodle_url('/grade/report/index.php?id='. $this->page->course->id);
            $branchtitle = $branchlabel;
            $branchsort  = 10000;
            $branch = $menu->add($branchlabel, $branchurl, $branchtitle, $branchsort);
        }
 
        
 
        return parent::render_custom_menu($menu);
    }
 
    protected function render_custom_menu_item(custom_menu_item $menunode) {
        $transmutedmenunode = new theme_archaius_transmuted_custom_menu_item($menunode);
        return parent::render_custom_menu_item($transmutedmenunode);
    }
}