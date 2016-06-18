<?php
/*
Plugin Name: WP Fancy Fundraising
Plugin URI: http://mediarealm.com.au/
Description: Layout tweaks and widgets for Fundraising with Wordpress
Version: 1.0.5
Author: Media Realm
Author URI: http://www.mediarealm.com.au/
*/

class WPFancyFundraising {
    
    private $pagetemplates = array();
    private $customiser = null;

    public function __construct() {
        $this->templates = array();

        // Add special page templates
        add_filter('page_attributes_dropdown_pages_args',           array( $this, 'register_project_templates' ) );
        add_filter('wp_insert_post_data',                           array( $this, 'register_project_templates' ) );
        add_filter('template_include',                              array( $this, 'view_project_template') );

        // Special page templates
        $this->pagetemplates = array('template-donate1.php' => 'Fancy Fundraising - Simple Donation Page');

        // Customise the special templates as if they're part of the regular theme!
        require('customiser.php');
        $this->customiser = New WPFancyFundraising_Customiser();
        
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
