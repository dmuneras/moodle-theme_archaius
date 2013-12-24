<?php include 'partials/header.php'; ?>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>
<?php include 'partials/page_header.php'; ?>
<div id="regions-control"></div>
<div id="page">
<div id="page-content" class="main-content clearfix">
    <div id="report-main-content">
        <div class="region-content">
            <?php echo $OUTPUT->main_content() ?>
        </div>
    </div>
    <?php if ($hassidepre) { ?>
    <div id="report-region-wrap">
        <div id="report-region-pre" class="block-region">
            <div class="region-content">
                <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
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
