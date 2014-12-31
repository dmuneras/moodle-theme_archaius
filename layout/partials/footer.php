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

This plugin is part of Archaius theme, if you use it outside the theme
you should create your own styles. You can use archaius stylesheet as
a example.
@copyright  2014 onwards Daniel Munera Sanchez

*/
?>

<!-- START OF FOOTER -->
<?php 
$hasfooter = (empty($PAGE->layout_options['nofooter']));
if ($hasfooter) { ?>
    <footer id="page-footer">
        <?php $hasfooterleft = $PAGE->blocks->region_has_content('footer-left', $OUTPUT); ?>
        <?php $hasfootercenter = $PAGE->blocks->region_has_content('footer-center', $OUTPUT); ?>
        <?php $hassfooterright = $PAGE->blocks->region_has_content('footer-right', $OUTPUT); ?>

        <?php if($hasfooterleft){ ?>
            <div id="region-footer-left">
                <?php echo $OUTPUT->blocks_for_region('footer-left') ?>
            </div>
        <?php } ?>
        <?php if($hasfooterleft){ ?>
            <div id="region-footer-center">
                <?php echo $OUTPUT->blocks_for_region('footer-center') ?>
            </div>
        <?php } ?>
        <?php if($hasfooterleft){ ?>
            <div id="region-footer-right">
                <?php echo $OUTPUT->blocks_for_region('footer-right') ?>
            </div>
        <?php } ?>

        <?php if (!empty($PAGE->theme->settings->footnote)) { ?>
            <?php echo $PAGE->theme->settings->footnote; ?>
        <?php }?>
        <p class="helplink"><?php echo page_doc_link(get_string('moodledocslink')) ?></p>
        <?php
        echo $OUTPUT->login_info();
        ?>
        <p>
            <a href="http://moodle.org" title="Moodle">
                <img src="<?php echo $OUTPUT->pix_url('moodle-logo','theme')?>" alt="Moodle logo" />
            </a>
        </p>
        <?php echo $OUTPUT->standard_footer_html(); ?>
    </footer>
<?php } ?>
<?php echo $OUTPUT->standard_end_of_body_html() ?>

<?php
    $params = array(
        array(
            'accordionBlocks' => $PAGE->theme->settings->accordionBlocks,
            'activateTopicsCourseMenu' => $PAGE->theme->settings->collasibleTopics,
            'activateSlideshow' => $PAGE->theme->settings->activateSlideshow ,
            'activateHideAndShowBlocks' => $PAGE->theme->settings->hideShowBlocks,
            'slideshowTimeout' => $PAGE->theme->settings->slideshowTimeout,
            'activatePausePlaySlideshow' => $PAGE->theme->settings->activatePausePlaySlideshow,
            'confirmationDeleteSlide' => get_string("confirmationDeleteSlide","theme_archaius"),
            'noSlides' => get_string("noSlides","theme_archaius"),
            'contextId' => $PAGE->context->id,
            'pageType' => $PAGE->pageType,
            'subpage' => $PAGE->subpage
        )
    );

    //Send course module info if current user is inside a course moodle
    //theme_archaius_blocks_region_$regionname_context_$contextid_pagetype_$pagetype_sub_$subpage
    $last_part_user_preference = $PAGE->context->id . "_page_type_" . $PAGE->pagetype;

    if(! empty($this->page->subpage)){
        $last_part_user_preference .= "_sub_" . $this->page->subpage;    
    }

    $side_pre_preference = "theme_archaius_blocks_region_side-pre" . 
        "_context_" . $last_part_user_preference;

    $side_post_preference = "theme_archaius_blocks_region_side-post" . 
        "_context_" . $last_part_user_preference;
    
    //Get user preferences to hide or show lateral regions of Archaius
    $show_side_pre = get_user_preferences($side_pre_preference,1);
    $show_side_post = get_user_preferences($side_post_preference,1);

    //Send current user preferences value to JS
    $params[0]['showRegionPre'] = $show_side_pre;
    $params[0]['showRegionPost'] = $show_side_post;

    $PAGE->requires->yui_module("moodle-theme_archaius-archaius", 
        "M.theme_archaius_loader.init", 
        $params, 
        false
    );
?> 
<!-- END FOOTER-->
