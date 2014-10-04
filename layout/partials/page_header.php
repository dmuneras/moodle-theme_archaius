<!-- PAGE HEADER -->

<?php 
//Check if the variable exists, if not you have to create it.
if(! isset($custommenu)){
  $custommenu = $OUTPUT->custom_menu();
}
if(! isset($hascustommenu)){
  $hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));
}
?>
<div id="page-header">
  <div class="page-header-inner">
    <?php if (!empty($PAGE->theme->settings->logo)) { ?>
        
        <?php $logourl = $PAGE->theme->setting_file_url('logo', 'logo'); ?>    
         <div id="logo" class = "nobackground">
              <img class="sitelogo" src="<?php echo $logourl;?>" alt="Custom logo here" 
                onclick = "document.location.href = ' <?php echo $CFG->wwwroot ?> '"/>
         </div>
    <?php } else { ?>
      <div id="logo">
          <img class="sitelogo" src="<?php echo $OUTPUT->pix_url('logo','theme')?>" alt="Custom logo here"
            onclick = "document.location.href = ' <?php echo $CFG->wwwroot ?> '" />
      </div>
    <?php } ?>
    <?php if (!empty($PAGE->theme->settings->mobilelogo)) { ?>
        <?php $mobile_logourl = $PAGE->theme->setting_file_url('mobilelogo', 'mobilelogo');?> 
        <div id="mobile-logo">
            <img class="sitelogo" src="<?php echo $mobile_logourl;?>" alt="Custom  mobile logo here" 
              onclick = "document.location.href = ' <?php echo $CFG->wwwroot ?> '"/>
      </div>
    <?php }else{ ?>
        <div id="mobile-logo">
          <img class="sitelogo" src="<?php echo $OUTPUT->pix_url('mobileLogo','theme')?>" alt="Custom mobile logo here"
            onclick = "document.location.href = ' <?php echo $CFG->wwwroot ?> '" />
        </div>
    <?php } ?>
    <div class="page-header-info-container">
      <div class="wrapper-header-info">
        <div class="headermenu">
          <?php if(isloggedin()){ ?>
                <?php global $USER,$COURSE; ?>
                <?php echo $OUTPUT->user_picture($USER, array('courseid'=>$COURSE->id));?>
          <?php } ?>

          <?php echo $OUTPUT->login_info(); ?>
          <?php echo $PAGE->headingmenu ?>
        </div>
        <div class='menu-icon deactive'>
          <span class='icon-bar'></span>
          <span class='icon-bar'></span>
          <span class='icon-bar last'></span>
        </div>
      </div>
    </div>
  </div>
  <?php if ($hascustommenu) { ?>
    <div id="custommenu" class="collapsed">
      <div class="custommenu-inner"><?php echo $custommenu; ?></div>
    </div>  
  <?php } ?>  
</div>        
<!-- END PAGE HEADER -->