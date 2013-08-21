<!-- PAGE HEADER -->

<?php 

  $hasheading = ($PAGE->heading); 
  
  //Check if the variable exists, if not you have to create it.
  if(! isset($custommenu)){
    $custommenu = $OUTPUT->custom_menu();
  }
  if(! isset($hascustommenu)){
    $hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));
  }
?>
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