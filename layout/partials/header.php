<?php


$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);
$hassidecenterpre = $PAGE->blocks->region_has_content('side-center-pre', $OUTPUT);
$hassidecenterpost = $PAGE->blocks->region_has_content('side-center-post', $OUTPUT);
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
$context = get_context_instance (CONTEXT_SYSTEM);

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    <meta http-equiv="x-ua-compatible" content="IE=edge" >
    <!--[if lt IE 9]>
        <script type="text/javascript" src="<?php echo $CFG->wwwroot ?>/theme/archaius/javascript/PIE.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <script type = "text/javascript">
        //<![CDATA[
        activateTopicsCourseMenu = '<?php echo $PAGE->theme->settings->collasibleTopics ?>';
        activateSlideshow = '<?php  echo $PAGE->theme->settings->activateSlideshow ?>';
        activateHideAndShowBlocks = '<?php echo $PAGE->theme->settings->hideShowBlocks ?>';
        siteRoot =  '<?php echo $CFG->wwwroot ?>';
        searchTranslation = "<?php echo get_string('search')?>";
        //]]>

    </script>
</head>