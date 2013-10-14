<?php include 'partials/header.php'; ?>
<?php require_once($CFG->dirroot . '/theme/archaius/slideshow/helpers/slider_helper.php'); ?>

<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>
<?php include 'partials/page_header.php' ?>

<!-- HOME PAGE ELEMENTS -->
<?php
    if ( ! empty($PAGE->layout_options['nosubtitle'])){
        $hassubtitle =  !($PAGE->layout_options['nosubtitle']); 
    }else{
        $hassubtitle = true;
    }
    
    if(! isset($hasnavbar)){
        $hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
    }
    if(! isset($hassidepre)){
        $hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);    
    }
    if(! isset($hassidepost)){
        $hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);   
    }
    if(! isset($hassidecenterpre)){
        $hassidecenterpre = $PAGE->blocks->region_has_content('side-center-pre', $OUTPUT);   
    }
    if(! isset($hassidecenterpost)){
        $hassidecenterpost = $PAGE->blocks->region_has_content('side-center-post', $OUTPUT);   
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
                                <div id="home-page">
                                    <?php 
                                        $slider = theme_archaius_get_slider();
                                        echo theme_archaius_add_slideshow($context->id,
                                                                            $slider->get_slides()); 
                                    ?>    
                                    <?php if(isloggedin() && has_capability('moodle/site:config',
                                                                         $context, $USER->id, true)){ ?>
                                           <div id ='toggle-admin-menu' class="pretty-button pretty-link-button">
                                            <?php echo get_string("settings");?>
                                           </div>
                                           <?php echo theme_archaius_admin_options($context->id,
                                                                                $slider->get_slides()); ?> 
                                    <?php } ?>

                                </div>
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
<?php echo $OUTPUT->standard_end_of_body_html() ?>
<script type = "text/javascript">
    //<![CDATA[   
    <?php if (!empty($PAGE->theme->settings->customjs)) {
        echo $PAGE->theme->settings->customjs;
    } ?>
    //]]>
</script>
</body>
</html>