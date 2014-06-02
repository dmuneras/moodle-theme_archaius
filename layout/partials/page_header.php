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
<?php if (!empty($PAGE->theme->settings->logo)) { ?>
     <?php $logourl = $PAGE->theme->settings->logo; ?>
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
<div class="headermenu">
  <?php if(isloggedin()){ ?>
        <?php global $USER,$COURSE; ?>
        <?php echo $OUTPUT->user_picture($USER, array('courseid'=>$COURSE->id));?>
  <?php } ?>

  <?php echo $OUTPUT->login_info(); ?>

  <?php if (!empty($PAGE->layout_options['langmenu'])) { ?>
    <?php echo $OUTPUT->lang_menu(); ?>
  <?php } ?>

  <?php echo $PAGE->headingmenu ?>
</div>

<?php if ($hascustommenu) { ?>
  <div id="custommenu" class="collapsed"><?php echo $custommenu; ?></div>  
<?php } ?>  
</div>        
<!-- END OF HEADER -->