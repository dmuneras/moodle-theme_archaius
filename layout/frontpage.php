<?php include 'partials/header.php'; ?>

<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>
<?php include 'partials/page_header.php'?>
<h2 class="lonely-title"><?php echo $PAGE->title?></h2>

<!-- HOME PAGE ELEMENTS -->

<div id="home-page" class="main-content">
    <div id="home-content">
        <div id="content-left">
            <?php 
                $slides = get_slides();
                echo add_theme_archaius_slideshow($slides, $context->id); 
            ?>
        </div>
        <div id="site-description">
            <?php echo $PAGE->course->summary; ?>
            <!-- <p class="go-to"><a id="go-to-courses" class='pretty-button pretty-link-button' href="#">
                <?php echo get_string("courses")?> -->
            </a></p>
        </div>
    </div>      
    <?php if(isloggedin() && has_capability('moodle/site:config', $context, $USER->id, true)){ ?>
           <div id ='toggle-admin-menu' class="pretty-button pretty-link-button">
            <?php echo get_string("settings");?>
           </div>
           <?php echo add_theme_archaius_admin_options(
           get_string("addSlide","theme_archaius"),$slides, $context->id); ?> 
    <?php } ?>

</div>

<!-- END HOME PAGE ELEMENTS -->

<h2 id="moodle-page-title" class="lonely-title"><?php echo get_string("courses");?></h2>

<?php include 'partials/page_content.php' ?>
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