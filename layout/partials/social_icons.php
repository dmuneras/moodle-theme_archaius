 <ul class='social-icons'>
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