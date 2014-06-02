<?php include 'partials/header.php'; ?>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>
<?php include 'partials/page_header.php'; ?>
<div id="regions-control"></div>
<div id="page" class="main-content clearfix">
    <?php if ($hasnavbar) { ?>
        <div class="navbar clearfix">
            <nav class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></nav>
            <div class="navbutton"><?php echo $PAGE->button; ?></div>
        </div>
    <?php }?>
    <div class="page-content report-page">
        <div class="main-report-content">
            <?php echo $OUTPUT->main_content() ?>
        </div>
        <?php if ($hassidepre) { ?>
            <div id="report-region-pre" class="block-region">
                <div class="region-content">
                    <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php include 'partials/footer.php' ?>
<script type = "text/javascript">
    //<![CDATA[   
    <?php if (!empty($PAGE->theme->settings->customjs)) {
        echo $PAGE->theme->settings->customjs;
    } ?>
    //]]>
</script>
</body>
</html>
