<!-- PAGE CONTENT -->
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
<!-- END PAGE CONTENT-->