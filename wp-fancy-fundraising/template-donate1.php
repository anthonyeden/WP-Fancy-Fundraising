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
        <img src="<?php echo get_theme_mod('fancyfundraising_form_logo'); ?>" />
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
        background-color: <?php echo get_theme_mod('fancyfundraising_colour_formcolumnheading'); ?>;
      }
      body {
        background-color: <?php echo get_theme_mod('fancyfundraising_colour_formbg'); ?>;
        background-image: url('<?php echo get_theme_mod('fancyfundraising_bgimg_form'); ?>');
      }
      footer {
        background-color: <?php echo get_theme_mod('fancyfundraising_colour_formbgfooter'); ?>;
      }
      footer a,
      footer a:hover {
        color: <?php echo get_theme_mod('fancyfundraising_colour_formfootertext'); ?>;
      }
      .button {
        background-color: <?php echo get_theme_mod('fancyfundraising_colour_formbtnbg'); ?>;
        color: <?php echo get_theme_mod('fancyfundraising_colour_formbtntext'); ?>;
      }
      .button:hover {
        background-color: <?php echo get_theme_mod('fancyfundraising_colour_formbtnbghover'); ?>;
      }
      header {
        <?php if(get_theme_mod('fancyfundraising_colour_formbgheadertransparent') == true) {
          echo "background-color: transparent;\n";
        } else {
          echo "background-color: " . get_theme_mod('fancyfundraising_colour_formbgheader') . ";\n";
        }
        ?>
      }
    </style>
  </body>
</html>