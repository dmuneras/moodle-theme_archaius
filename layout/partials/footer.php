<!-- START OF FOOTER -->
<?php 
$hasfooter = (empty($PAGE->layout_options['nofooter']));
if ($hasfooter) { ?>
    <footer id="page-footer" class="clearfix">
        <?php if (!empty($PAGE->theme->settings->footnote)) { ?>
            <?php echo $PAGE->theme->settings->footnote; ?>
        <?php }?>
        <p class="helplink"><?php echo page_doc_link(get_string('moodledocslink')) ?></p>
        <?php
        echo $OUTPUT->login_info();
        ?>
        <p>Supported by 
        <a href="http://moodle.org" title="Moodle">
                <img src="<?php echo $OUTPUT->pix_url('moodle-logo','theme')?>" alt="Moodle logo" />
            </a>
        </p>
        <?php
            echo $OUTPUT->standard_footer_html();
        ?>
        <div class="clearfix"></div>
    </footer>
<?php } ?>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
<?php
        //Access to JS
    $archaius_loader = array(
        'name' => 'theme_archaius_loader',
        'fullpath' => '/theme/archaius/javascript/archaius_loader.js',
        'requires' => array(),
        'strings' => array(
            array('search'),
        ),
    );
    $arguments = array(      
        $PAGE->theme->settings->collasibleTopics, 
        $PAGE->theme->settings->activateSlideshow,
        $PAGE->theme->settings->hideShowBlocks      
    );
    $this->page->requires->js_init_call('M.theme_archaius_loader.init', 
        $arguments, 
        false, 
        $archaius_loader
    );
?>
<!-- END FOOTER-->
