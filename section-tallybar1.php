<!-- Fancy Fundraising TallyBar Type 1 -->

<div class="fancyfundraising-tallybar1 foundation">
    <div class="row" data-equalizer data-equalizer-mq="medium-up">
        <div class="column small-12 medium-4 ff-logo-container" data-equalizer-watch>
        </div>
        <div class="column small-12 medium-8" data-equalizer-watch>
            <div class="ff-text-container">
                <span class="ffline1"><?php echo $a['line1']; ?></span>
                <span class="ffline2"><?php echo $a['line2']; ?></span>
                <a href="<?php echo $a['button_url']; ?>" class="donate_button"><?php echo $a['button_text']; ?></a>
            </div>
        </div>
    </div>
</div>

<style>
    .fancyfundraising-tallybar1 {
        <?php if(!empty($a['bgimg'])) echo "background-image: url('".$a['bgimg']."');\n"; ?>
        <?php if(!empty($a['bgcol'])) echo "background-color: ".$a['bgcol'].";\n"; ?>
        color: <?php echo $a['color']; ?>;
    }
    .fancyfundraising-tallybar1 .column {
        min-height: <?php echo $a['min-height']; ?>;
        line-height: <?php echo $a['min-height']; ?>;
    }
    .fancyfundraising-tallybar1 .ff-logo-container {
        <?php if(!empty($a['logo'])) echo "background-image: url('" . $a['logo'] . "');\n"; ?>
    }
    
    .fancyfundraising-tallybar1 .donate_button {
        color: <?php echo $a['button_textcolor']; ?>;
        background-color: <?php echo $a['button_bgcolor']; ?>;
    }
    .fancyfundraising-tallybar1 .donate_button:hover {
        background-color: <?php echo $a['button_bgcolorhover']; ?>;
    }
</style>

<link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>static/css/section-tallybar1.css" />
<script src="<?php echo plugin_dir_url( __FILE__ ); ?>static/js/foundation.min.js"></script>

<script>
    jQuery(document).foundation();
</script>

<!-- /End Tally Bar Type 1 -->