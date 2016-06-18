<?php
/*
Plugin Name: WP Fancy Fundraising
Plugin URI: http://mediarealm.com.au/
Description: Layout tweaks and widgets for Fundraising with Wordpress
Version: 1.0.3
Author: Media Realm
Author URI: http://www.mediarealm.com.au/
*/

class WPFancyFundraising {
    
    private $pagetemplates = array();

    public function __construct() {
        $this->templates = array();

        // Add special page templates
        add_filter('page_attributes_dropdown_pages_args',           array( $this, 'register_project_templates' ) );
        add_filter('wp_insert_post_data',                           array( $this, 'register_project_templates' ) );
        add_filter('template_include',                              array( $this, 'view_project_template') );

        // Special page templates
        $this->pagetemplates = array('template-donate1.php' => 'Fancy Fundraising - Simple Donation Page');

        // Customise the special templates as if they're part of the regular theme!
        add_action('customize_register',                            array($this, 'customize_register'));
        
        // Code to update this plugin via GitHub
        if (is_admin()) {
            require_once( 'BFIGitHubPluginUploader.php' );
            new BFIGitHubPluginUpdater(__FILE__, 'anthonyeden', "wp-fancy-fundraising");
        }

    }

    public function register_project_templates($atts) {
        // Adds our template to the pages cache in order to trick WordPress
        // into thinking the template file exists where it doens't really exist.
        // From http://www.wpexplorer.com/wordpress-page-templates-plugin/

        $cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

        // Get the existing page templates, or create an empty array if there aren't any
        $templates = wp_get_theme()->get_page_templates();
        if (empty($templates)) {
            $templates = array();
        }

        // Remove the themes cache and add our own one with the special page templates
        wp_cache_delete($cache_key , 'themes');
        $templates = array_merge($templates, $this->pagetemplates);
        wp_cache_add($cache_key, $templates, 'themes', 1800);

        return $atts;

    }

    public function view_project_template($template) {
        // Checks if this special template is assigned to this page
        // From http://www.wpexplorer.com/wordpress-page-templates-plugin/

        global $post;

        if (!isset($this->pagetemplates[get_post_meta( $post->ID, '_wp_page_template', true)] ) ) {
            return $template;
        }

        $file = plugin_dir_path(__FILE__) . get_post_meta($post->ID, '_wp_page_template', true);

        if(file_exists($file)) {
            return $file;
        }

        return $template;
    }

    public function customize_register($wp_customize) {
        $wp_customize->add_section(
            'fancyfundraising_donationtemplate_options',
            array(
                'title'     => 'Fancy Fundraising - Donation Template Options',
                'priority'  => 200
            )
        );
        
        $wp_customize->add_setting(
            'fancyfundraising_colour_formcolumnheading',
            array(
                'default'   => '#000',
                'transport' => 'postMessage'
            )
        );

        $wp_customize->add_control( 
            new WP_Customize_Color_Control( $wp_customize, 'fancyfundraising_colour_formcolumnheading', array(
                'label' => 'Column Heading Colour',
                'section' => 'fancyfundraising_donationtemplate_options',
                'settings' => 'fancyfundraising_colour_formcolumnheading',
            ) )
        );

        $wp_customize->add_setting(
            'fancyfundraising_colour_formbg',
            array(
                'default'   => '#EEE',
                'transport' => 'postMessage'
            )
        );

        $wp_customize->add_control( 
            new WP_Customize_Color_Control( $wp_customize, 'fancyfundraising_colour_formbg', array(
                'label' => 'Background Colour',
                'section' => 'fancyfundraising_donationtemplate_options',
                'settings' => 'fancyfundraising_colour_formbg',
            ) )
        );

        $wp_customize->add_setting(
            'fancyfundraising_colour_formbgfooter',
            array(
                'default'   => '#414141',
                'transport' => 'postMessage'
            )
        );

        $wp_customize->add_control( 
            new WP_Customize_Color_Control( $wp_customize, 'fancyfundraising_colour_formbgfooter', array(
                'label' => "Footer Background Colour",
                'section' => 'fancyfundraising_donationtemplate_options',
                'settings' => 'fancyfundraising_colour_formbgfooter',
            ) )
        );

        $wp_customize->add_setting(
            'fancyfundraising_colour_formfootertext',
            array(
                'default'   => '#FFF',
                'transport' => 'postMessage'
            )
        );

        $wp_customize->add_control( 
            new WP_Customize_Color_Control( $wp_customize, 'fancyfundraising_colour_formfootertext', array(
                'label' => 'Footer Text Colour',
                'section' => 'fancyfundraising_donationtemplate_options',
                'settings' => 'fancyfundraising_colour_formfootertext',
            ) )
        );

        $wp_customize->add_setting(
            'fancyfundraising_colour_formbtnbg',
            array(
                'transport' => 'postMessage'
            )
        );

        $wp_customize->add_control( 
            new WP_Customize_Color_Control( $wp_customize, 'fancyfundraising_colour_formbtnbg', array(
                'label' => 'Button BG Colour',
                'section' => 'fancyfundraising_donationtemplate_options',
                'settings' => 'fancyfundraising_colour_formbtnbg',
            ) )
        );

        $wp_customize->add_setting(
            'fancyfundraising_colour_formbtnbghover',
            array(
                'transport' => 'postMessage'
            )
        );

        $wp_customize->add_control( 
            new WP_Customize_Color_Control( $wp_customize, 'fancyfundraising_colour_formbtnbghover', array(
                'label' => 'Button BG Colour (Hover)',
                'section' => 'fancyfundraising_donationtemplate_options',
                'settings' => 'fancyfundraising_colour_formbtnbghover',
            ) )
        );

        $wp_customize->add_setting(
            'fancyfundraising_colour_formbtntext',
            array(
                'transport' => 'postMessage'
            )
        );

        $wp_customize->add_control( 
            new WP_Customize_Color_Control( $wp_customize, 'fancyfundraising_colour_formbtntext', array(
                'label' => 'Button Text Colour',
                'section' => 'fancyfundraising_donationtemplate_options',
                'settings' => 'fancyfundraising_colour_formbtntext',
            ) )
        );

        $wp_customize->add_setting(
            'fancyfundraising_bgimg_form',
            array(
                'transport' => 'postMessage'
            )
        );

        $wp_customize->add_control( 
            new WP_Customize_Image_Control( $wp_customize, 'fancyfundraising_bgimg_form', array(
                'label' => 'Background Image',
                'section' => 'fancyfundraising_donationtemplate_options',
                'settings' => 'fancyfundraising_bgimg_form',
            ) )
        );

        $wp_customize->add_setting(
            'fancyfundraising_form_logo',
            array(
                'transport' => 'postMessage'
            )
        );

        $wp_customize->add_control( 
            new WP_Customize_Image_Control( $wp_customize, 'fancyfundraising_form_logo', array(
                'label' => 'Logo',
                'section' => 'fancyfundraising_donationtemplate_options',
                'settings' => 'fancyfundraising_form_logo',
            ) )
        );

        $wp_customize->add_setting(
            'fancyfundraising_colour_formbgheader',
            array(
                'default'   => '#FFF',
                'transport' => 'postMessage'
            )
        );

        $wp_customize->add_control( 
            new WP_Customize_Color_Control( $wp_customize, 'fancyfundraising_colour_formbgheader', array(
                'label' => "Header Background Colour",
                'section' => 'fancyfundraising_donationtemplate_options',
                'settings' => 'fancyfundraising_colour_formbgheader',
            ) )
        );

        $wp_customize->add_setting(
            'fancyfundraising_colour_formbgheadertransparent',
            array(
                'default'    => false,
                'transport'  => 'postMessage',
            )
        );

        $wp_customize->add_control( 'fancyfundraising_colour_formbgheadertransparent', array(
            'label'      => 'Header Background Transparent?',
            'section'    => 'fancyfundraising_donationtemplate_options',
            'settings'   => 'fancyfundraising_colour_formbgheadertransparent',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_setting(
            'fancyfundraising_form_forcessl',
            array(
                'default'    => false,
                'transport'  => 'postMessage',
            )
        );

        $wp_customize->add_control( 'fancyfundraising_form_forcessl', array(
            'label'      => 'Force SSL?',
            'section'    => 'fancyfundraising_donationtemplate_options',
            'settings'   => 'fancyfundraising_form_forcessl',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_setting(
            'fancyfundraising_form_fixssl',
            array(
                'default'    => false,
                'transport'  => 'postMessage',
            )
        );

        $wp_customize->add_control( 'fancyfundraising_form_fixssl', array(
            'label'      => 'Fix SSL Assets?',
            'section'    => 'fancyfundraising_donationtemplate_options',
            'settings'   => 'fancyfundraising_form_fixssl',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_setting(
            'fancyfundraising_form_fixssl2',
            array(
                'default'    => false,
                'transport'  => 'postMessage',
            )
        );

        $wp_customize->add_control( 'fancyfundraising_form_fixssl2', array(
            'label'      => 'Fix SSL Assets? (Even Stricter)',
            'section'    => 'fancyfundraising_donationtemplate_options',
            'settings'   => 'fancyfundraising_form_fixssl2',
            'type'       => 'checkbox'
        ) );

    }

    public static function fixHTTPSUrl($url) {
        // Simple way to force content onto HTTPS
        return str_replace('http://', 'https://', $url );
    }

    public static function gf_column($content, $field, $value, $lead_id, $form_id) {
        // Function to allow for Gravity Forms tri-columns
        // Based on http://www.jordancrown.com/multi-column-gravity-forms/

        // Targets section breaks on the front end:
        if(!IS_ADMIN && $field['type'] == 'section') {

            // Get the form object
            $form = RGFormsModel::get_form_meta($form_id, true);

            // Is this a multi-column form?
            $form_class = explode(' ', $form['cssClass']);
            $form_classes_accept = array('two-column', 'three-column');
            $columnform = false;
            foreach($form_class as $classname) {
                if(in_array($classname, $form_classes_accept)) {
                    $columnform = true;
                }
            }

            // Is this particular section field a column break?
            $field_class = explode(' ', $field['cssClass']);
            $field_classes_accept = array('gform_column');
            $columnfield = false;
            foreach($field_class as $classname) {
                if(in_array($classname, $field_classes_accept)) {
                    $columnfield = true;
                }
            }

            if($columnform && $columnfield) {
                $form = RGFormsModel::add_default_properties($form);
                $description_class = rgar($form, 'descriptionPlacement') == 'above' ? 'description_above' : 'description_below';

                return '</li></ul><ul class="gform_fields '.$form['labelPlacement'].' '.$description_class.' '.$field['cssClass'].'"><li class="gfield gsection empty">';

            }
        }

        return $content;
    }

}

$WPFancyFundraisingObj = New WPFancyFundraising();
