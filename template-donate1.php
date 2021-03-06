<?php
/*
	Template Name: Fancy Fundraising - Simple Donation Page
*/

// Force HTTPS for this page
if(get_theme_mod('fancyfundraising_form_forcessl') == true && (empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")) {
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    die();
}

if(get_theme_mod('fancyfundraising_form_fixssl') == true) {
  add_filter('script_loader_src',       array('WPFancyFundraising', 'fixHTTPSUrl'));
  add_filter('style_loader_src',        array('WPFancyFundraising', 'fixHTTPSUrl'));
}

add_action('wp_enqueue_scripts', function() {
  // De-register theme styles
  global $wp_styles;

  if(is_a($wp_styles, 'WP_Styles')) {
    foreach( $wp_styles->queue as $name ) {
      if(isset($wp_styles->registered[$name]) && strpos($wp_styles->registered[$name]->src, "/themes/") !== false) {
        wp_dequeue_style($name);
        wp_deregister_style($name);
      }
    }
  }

}, 999);

// Filter to create columns (form needs class 'two-column' or 'three-column' class and section-breaks need 'gform_column')
add_filter('gform_field_content',     array('WPFancyFundraising', 'gf_column'), 10, 5);

?><!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?php wp_title( '-', true, 'right' ); ?></title>
    
    <?php
      if(get_theme_mod('fancyfundraising_form_fixssl2')) {
        ob_start();
        wp_head();
        $wphead = ob_get_clean();
        $wphead = WPFancyFundraising::fixHTTPSUrl($wphead);
        echo $wphead;
      } else {
        wp_head();
      }
    ?>
  
  </head>

  <body <?php body_class(); ?>>
    <?php if(get_theme_mod('fancyfundraising_form_logo', '') !== '') { ?>
    <header>
      <div class="row">
        <a href="<?php echo get_site_url(); ?>"><img src="<?php echo ($_SERVER["HTTPS"] == "on" ? str_replace("http://", "https://", get_theme_mod('fancyfundraising_form_logo')): get_theme_mod('fancyfundraising_form_logo')); ?>" /></a>
      </div>
    </header>
    <?php } ?>

    <div class="row main">
      <div class="large-12 columns">
        <?php
          while (have_posts()) {
          echo '<div class="page-content">';

          if (has_post_thumbnail()) {
            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
                if ( !empty( $large_image_url[0] ) ) {
                      echo '<a href="'.get_site_url().'" class="featuredimg"><img src="'.$large_image_url[0].'" /></a>';
                }
              }

          the_post();
          the_content();
          echo '</div>';
          }
        ?>
      </div>
    </div>

    <footer>
      <div class="row">
        <a href="<?php echo get_site_url(); ?>"><?php echo "&copy; " . date("Y") . " " . get_bloginfo('name'); ?></a>
      </div>
    </footer>

    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>static/js/what-input.js"></script>
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>static/js/foundation.js"></script>

    <script>
        //Zurb Foundation init
        jQuery(document).foundation();

        // Hide Gravity Forms price difference fields.
        function gform_format_option_label( fullLabel, fieldLabel, priceLabel, selectedPrice, price, formId, fieldId ) { 
            return fieldLabel;
        }

        <?php if(get_theme_mod('fancyfundraising_form_btnpressonce')) { ?>

        // Only allow the buttons to be pressed once (not always necessary, but some people like it.)
        // From https://snippets.webaware.com.au/snippets/stop-users-from-submitting-gravity-forms-form-twice/
        jQuery(document).ready(function() {
          var gformAlreadySubmitted = false;
          jQuery(".gform_wrapper form").submit(function(event) {
              if (gformAlreadySubmitted) {
                  event.preventDefault();
              } else {
                  gformAlreadySubmitted = true;
                  jQuery("input[type='submit']", this).val("Processing, please wait...");
              }
          });
        });
        <?php } ?>

        jQuery('.radio-button-buttons li input:checked').parent("li").children("label").addClass("active");
        jQuery('.radio-button-buttons li label').on('click touchstart', function(){
            jQuery('.radio-button-buttons li label').removeClass("active");
            jQuery(this).addClass("active");
        });

    </script>

    <?php
      if(get_theme_mod('fancyfundraising_form_fixssl2')) {
        ob_start();
        wp_footer();
        $wpfooter = ob_get_clean();
        $wpfooter = WPFancyFundraising::fixHTTPSUrl($wpfooter);
        echo $wpfooter;
      } else {
        wp_footer();
      }
    ?>
  
    <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>static/css/foundation.min.css">
    <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>static/css/template-donate1.css">
    <style>
      .gform_wrapper .gform_body h3,
      .gform_wrapper .gform_body .field-heading label.gfield_label {
        background-color: <?php echo get_theme_mod('fancyfundraising_colour_formcolumnheading'); ?> !important;
      }
      body {
        background-color: <?php echo get_theme_mod('fancyfundraising_colour_formbg'); ?> !important;
        background-image: url('<?php echo ($_SERVER["HTTPS"] == "on" ? str_replace("http://", "https://", get_theme_mod('fancyfundraising_bgimg_form')) : get_theme_mod('fancyfundraising_bgimg_form')); ?>') !important;
      }
      footer {
        background-color: <?php echo get_theme_mod('fancyfundraising_colour_formbgfooter'); ?> !important;
      }
      footer a,
      footer a:hover {
        color: <?php echo get_theme_mod('fancyfundraising_colour_formfootertext'); ?> !important;
      }
      .button {
        background-color: <?php echo get_theme_mod('fancyfundraising_colour_formbtnbg'); ?> !important;
        color: <?php echo get_theme_mod('fancyfundraising_colour_formbtntext'); ?> !important;
      }
      .button:hover {
        background-color: <?php echo get_theme_mod('fancyfundraising_colour_formbtnbghover'); ?> !important;
      }
      header {
        <?php if(get_theme_mod('fancyfundraising_colour_formbgheadertransparent') == true) {
          echo "background-color: transparent !important;\n";
        } else {
          echo "background-color: " . get_theme_mod('fancyfundraising_colour_formbgheader') . " !important;\n";
        }
        ?>
      }
      <?php if(get_theme_mod('fancyfundraising_form_hidecardicons') == true) { ?>

      .gform_card_icon_container {
        display: none !important;
      }

      <?php } ?>
    </style>
  </body>
</html>