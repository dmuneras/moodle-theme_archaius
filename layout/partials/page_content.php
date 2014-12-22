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
?>
<div id="regions-control"></div>
<div id="page" class="main-content">
    <div id="page-content">
          <?php if($hassubtitle){?>
            <h3 class = "page-subtitle"><?php echo $PAGE->heading;?></h3>
          <?php } ?>
    	  <?php if ($hasnavbar) { ?>
            <div class="navbar clearfix">
	      <nav class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></nav>
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