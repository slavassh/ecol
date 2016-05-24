<?php

$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hassidepre = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-pre', $OUTPUT));
$hassidepost = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-post', $OUTPUT));

$showsidepre = ($hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT));
$showsidepost = ($hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT));

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

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
</head>
<body id="<?php echo $PAGE->bodyid ?>" class="<?php echo $PAGE->bodyclasses.' '.join(' ', $bodyclasses) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>
<div id="page" class="clearfix">
    <div id="page-wrapper" class="clearfix">
        <div id="page-wrapper-inner" class="clearfix">
<?php if ($hasheading || $hasnavbar) { ?>
    <div id="heading" class="clearfix">
        <div id="branding" class="clearfix">
            <div class="header-logo"><a href="<?php echo "$CFG->wwwroot" ?>">
              <img src="<?php echo $OUTPUT->pix_url('logo', 'theme');?>" alt="Южно-Уральский государственный колледж" title="Главная" width="69" height="56" border="0"></a>                    
            </div>
            <div class="header-sitename"><a href="<?php echo "$CFG->wwwroot" ?>">
                <span class="sitename">Южно-Уральский государственный колледж</span>                  
                </a>
            </div>
        </div>
    </div>
        <?php if ($hasheading) { ?>
    <div id="header" class="clearfix">
        <h1 class="headermain"><?php echo $PAGE->heading ?></h1>
        <?php echo $OUTPUT->user_menu(); 

            if (!empty($PAGE->layout_options['langmenu'])) {
                echo $OUTPUT->lang_menu();
            }
        ?>
                <?php echo $OUTPUT->custom_menu(); ?>                
                <?php echo $OUTPUT->page_heading_menu(); ?>
     </div><?php } ?>
            
    
<?php } ?>
<!-- END OF HEADER -->

        <div id="page-content-wrapper">
            <div id="page-content">
                <div id="region-main-box">
                    <div id="region-post-box">
                    
                        <div id="region-main-wrap">
                            <div id="region-main">
                                <div class="region-content">
                                    <?php echo core_renderer::MAIN_CONTENT_TOKEN ?>
                                </div>
                            </div>
                        </div>
                        
                        <?php if ($hassidepre) { ?>
                        <div id="region-pre" class="block-region">
                            <div class="region-content">
                                <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <?php if ($hassidepost) { ?>
                        <div id="region-post" class="block-region">
                            <div class="region-content">
                                <?php echo $OUTPUT->blocks_for_region('side-post') ?>
                            </div>
                        </div>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div> 
    <div id="page-bottom">    
        </div>    
    </div>
</div>
 
<!-- START OF FOOTER -->
    <?php if ($hasfooter) { ?>
    <div id="page-footer" class="clearfix">
        <?php
        
        echo $OUTPUT->standard_footer_html();
        ?>
        <a href="http://moodle.org" target="new" alt="Moodle.org" title="Международное сообщество Moodle"><img src="<?php echo "$CFG->wwwroot/theme/$CFG->theme" ?>/pix/moodle-logo.png"></img></a>
    
    </div>          
        

    <?php } ?>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>