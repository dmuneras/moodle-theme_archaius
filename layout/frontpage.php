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
@copyright  2014 onwards  Daniel Munera Sanchez

*/
?>

<?php include 'partials/header.php'; ?>
<?php require_once($CFG->dirroot . '/theme/archaius/slideshow/helpers/ArchaiusSliderHelper.class.php'); ?>

<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>
<?php include 'partials/page_header.php' ?>
<?php
    if ( ! empty($PAGE->layout_options['nosubtitle'])){
        $hassubtitle =  !($PAGE->layout_options['nosubtitle']); 
    }else{
        $hassubtitle = true;
    }   
    if(! isset($hasnavbar)){
        $hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
    }
?>
<div id="regions-control"></div>
<div id="page" class="main-content">
    <div id="page-content">
          <?php if($hassubtitle){?>
            <h3 class = "page-subtitle"><?php echo $PAGE->heading;?></h3>
          <?php } ?>
          <?php if ($hasnavbar) { ?>
            <div class="navbar clearfix">
          <div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>
          <div class="navbutton"><?php echo $PAGE->button; ?></div>
            </div>
                  <?php }?>
        <div id="region-main-box">
            <div id="region-post-box">
                <div id="region-main-wrap">
                    <div id="region-main">
                        <div class="region-content">
                            <?php if($PAGE->theme->settings->activateSlideshow){ ?>
                                <!-- HOME PAGE SLIDESHOW-->
                                <div id="home-page">
                                    <!-- SLIDESHOW -->
                                    <?php 
                                        $slider_helper = ArchaiusSliderHelper::Instance($context->id);
                                        echo $slider_helper->add_slideshow(); 
                                    ?>
                                    <!-- END SLIDESHOW-->
                                    <?php if(isloggedin() && has_capability('moodle/site:config',
                                                                         $context, $USER->id, true)){ ?>
                                           <div id ='toggle-admin-menu' class="pretty-button pretty-link-button">
                                            <?php echo get_string("settings");?>
                                           </div>
                                           <?php echo $slider_helper->admin_options(); ?> 
                                    <?php } ?>
                                </div>
                                <!-- END HOME PAGE SLIDESHOW-->
                            <?php } ?>
                            <?php if ( $hassidecenterpre) { ?>
                                <div id = "region-center-pre">
                                    <?php echo $OUTPUT->blocks_for_region('side-center-pre') ?>
                                </div>
                            <?php } ?>
                            <?php echo $OUTPUT->main_content() ?>
                            <?php if ( $hassidecenterpost) { ?>
                                <div id = "region-center-post">
                                    <?php echo $OUTPUT->blocks_for_region('side-center-post') ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php if ($hassidepre){ ?>
                <div id="region-pre" class="block-region">
                    <div class="region-content">
                        <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
                    </div>
                </div>
                <?php } ?>

                <?php if ($hassidepost){  ?>
                <div id="region-post" class="block-region">
                    <div class="region-content">
                        <?php echo $OUTPUT->blocks_for_region('side-post') ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
  <div class="clearfix"></div>
</div>
<?php include 'partials/footer.php' ?>
<script type = "text/javascript">
    //<![CDATA[   
    <?php if (!empty($PAGE->theme->settings->customjs)) {
        echo $PAGE->theme->settings->customjs;
    } ?>
    //]]>
</script>
</body>
</html>