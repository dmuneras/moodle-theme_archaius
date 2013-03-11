<?php

$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);
$showsidepre = $hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT);
$showsidepost = $hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT);
$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$bodyclasses = array();
if ($showsidepre && !$showsidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($showsidepost && !$showsidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$showsidepost && !$showsidepre) {
    $bodyclasses[] = 'content-only';
}
if ($hascustommenu) {
    $bodyclasses[] = 'has_custom_menu';
}
if ($hasnavbar) {
    $bodyclasses[] = 'hasnavbar';
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    <meta http-equiv="x-ua-compatible" content="IE=edge" >
    <!--[if lt IE 10]>
        <script type="text/javascript" src="<?php echo $CFG->wwwroot ?>/theme/macondo/javascript/PIE.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <script type = "text/javascript">
        //<![CDATA[
        
        <?php if (!empty($PAGE->theme->settings->customjs)) {
            echo $PAGE->theme->settings->customjs;
        } ?>
        activateTopicsCourseMenu = '<?php echo $PAGE->theme->settings->collasibleTopics ?>';
        siteRoot =  '<?php echo $CFG->wwwroot ?>';
        //]]>

    </script>
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>
  <?php if ($hasheading) { ?>
    <div id="page-header">
	<?php if ($hasheading) { ?>
         <?php if (!empty($PAGE->theme->settings->logo)) { ?>
                   <?php $logourl = $PAGE->theme->settings->logo; ?>
                   <div id="logo" class = "nobackground" onclick = "document.location.href = ' <?php echo $CFG->wwwroot ?> '">
                        <img class="sitelogo" src="<?php echo $logourl;?>" alt="Custom logo here" />
                   </div>
        <?php } else { ?>
                <div id="logo"  onclick = "document.location.href = ' <?php echo $CFG->wwwroot ?> '">
                    <img class="sitelogo" src="<?php echo $OUTPUT->pix_url('logo','theme')?>" alt="Custom logo here" />
                </div>
        <?php } ?>
        <div class="headermenu"><?php
	     echo $OUTPUT->login_info();
	     if (!empty($PAGE->layout_options['langmenu'])) {
	       echo $OUTPUT->lang_menu();
	     }
            echo $PAGE->headingmenu
	    ?></div><?php } ?>
	    <?php if ($hascustommenu) { ?>
		 <div id="custommenu"><?php echo $custommenu; ?></div>
	    <?php } ?>        
           </div>        
           <?php } ?>
<!-- END OF HEADER -->

<div id="page">
    <div id="page-content">
          <h3 class = "page-subtitle"><?php echo $PAGE->heading ?></h3>  
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
                            <?php echo $OUTPUT->main_content() ?>
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
<!-- START OF FOOTER -->
    <?php if ($hasfooter) { ?>
    <div id="page-footer" class="clearfix">
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
    </div>
    <?php } ?>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>