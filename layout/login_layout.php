<?php

require_once($CFG->dirroot . '/theme/archaius/helpers/ArchaiusViewHelper.class.php');

//Check which components are present
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);
$hassidecenterpre = $PAGE->blocks->region_has_content('side-center-pre', $OUTPUT);
$hassidecenterpost = $PAGE->blocks->region_has_content('side-center-post', $OUTPUT);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));
$haslangmenu = !(empty($PAGE->layout_options['langmenu']));

//Add classes to body depending on components to be displayed
$bodyclasses = array();
if ($hassidepre && !$hassidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($hassidepost && !$hassidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$hassidepost && !$hassidepre) {
    $bodyclasses[] = 'content-only';
}

$context = context_system::instance();

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?> class="login no-js" >

<head>
  <title><?php echo $PAGE->title ?></title>
  <meta http-equiv="x-ua-compatible" content="IE=edge" >
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
  <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <?php echo $OUTPUT->standard_head_html() ?>
  <meta http-equiv="x-ua-compatible" content="IE=edge">
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>" >
<?php echo $OUTPUT->standard_top_of_body_html() ?>
<!-- LOGIN PAGE HEADER -->


<div id="page-header" class='login'>
  <div class="page-header-inner">
    <?php if (!empty($PAGE->theme->settings->logo)) { ?>
      <?php $logourl = $PAGE->theme->setting_file_url('logo', 'logo'); ?>
      <div id="logo" class = "nobackground" onclick = "document.location.href = ' <?php echo $CFG->wwwroot ?>'">
        <img class="sitelogo" src="<?php echo $logourl;?>" alt="Custom logo here" />
      </div>
    <?php } else { ?>
      <div id="logo"  onclick = "document.location.href = '<?php echo $CFG->wwwroot ?>'">
          <img class="sitelogo" src="<?php echo $OUTPUT->pix_url('logo','theme')?>" alt="Custom logo here" />
      </div>
    <?php } ?>
    <?php if (!empty($PAGE->theme->settings->mobilelogo)) { ?>
      <?php $mobile_logourl = $PAGE->theme->setting_file_url('mobilelogo', 'mobilelogo');?>
      <div id="mobile-logo">
          <img class="sitelogo" src="<?php echo $mobile_logourl;?>" alt="Custom  mobile logo here"
            onclick = "document.location.href = ' <?php echo $CFG->wwwroot ?>?redirect=0 '"/>
      </div>
    <?php }else{ ?>
        <div id="mobile-logo">
          <img class="sitelogo" src="<?php echo $OUTPUT->pix_url('mobileLogo','theme')?>" alt="Custom mobile logo here"
            onclick = "document.location.href = ' <?php echo $CFG->wwwroot ?>?redirect=0 '" />
        </div>
    <?php } ?>
    <div class="page-header-info-container">
      <div class="wrapper-header-info">
        <div class="headermenu">
          <ul id='social-icons'>
          <?php if(! empty($PAGE->theme->settings->facebook)){ ?>
            <li>
              <a href='<?php echo ArchaiusViewHelper::add_protocole_to_url($PAGE->theme->settings->facebook) ?>' target="_blank">
                <i class="fa fa-facebook-official"></i>
              </a>
            </li>
          <?php } ?>
          <?php if(! empty($PAGE->theme->settings->twitter)){ ?>
            <li>
              <a href='<?php echo ArchaiusViewHelper::add_protocole_to_url($PAGE->theme->settings->twitter) ?>' target='_blank'>
                <i class="fa fa-twitter-square"></i>
              </a>
            </li>
          <?php } ?>
          <?php if(! empty($PAGE->theme->settings->youtube)){ ?>
            <li>
              <a href='<?php echo ArchaiusViewHelper::add_protocole_to_url($PAGE->theme->settings->youtube) ?>' target="_blank">
                <i class="fa fa-youtube-square"></i>
              </a>
            </li>
          <?php } ?>
          <?php if(! empty($PAGE->theme->settings->linkedin)){ ?>
            <li>
              <a href='<?php echo ArchaiusViewHelper::add_protocole_to_url($PAGE->theme->settings->linkedin) ?>' target="_blank">
                <i class="fa fa-linkedin-square"></i>
              </a>
            </li>
          <?php } ?>
        </ul>
        </div>
        <?php if ($hascustommenu) { ?>
          <div id="custommenu">
            <div class="inner-custommenu">
              <?php echo $custommenu; ?>
            </div>
          </div>
        <?php } ?>
        <div class='menu-icon deactive'>
          <span class='icon-bar'></span>
          <span class='icon-bar'></span>
          <span class='icon-bar last'></span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END OF LOGIN PAGE HEADER -->
<div id= "login-content" >
  <!-- PAGE CONTENT -->
  <div id="page" class="main-content">
      <div id="page-content">
          <div id="region-main-box">
              <div id="region-post-box">
                  <div id="region-main-wrap">
                      <div id="region-main" >
                          <div class="region-content">
                              <div id='login-main-content-wrapper'>
                                <?php echo $OUTPUT->main_content(); ?>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  <div class="clearfix"></div>
  </div>
  <!-- END PAGE CONTENT-->
</div>
<div id= "login-footer" >
  <?php include 'partials/footer.php' ?>
</div>
<script type = "text/javascript">
    //<![CDATA[
    <?php if (!empty($PAGE->theme->settings->customjs)) {
        echo $PAGE->theme->settings->customjs;
    } ?>
    //]]>
</script>
</body>
</html>