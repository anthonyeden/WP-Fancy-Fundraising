<?php
/*
Plugin Name: WP Fancy Fundraising
Plugin URI: http://mediarealm.com.au/
Description: Layout tweaks and widgets for Fundraising with Wordpress
Version: 1.0.12

Author: Media Realm
Author URI: http://www.mediarealm.com.au/

License: GPL2

WP Fancy Fundraising is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
WP Fancy Fundraising is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with WP Fancy Fundraising. If not, see https://www.gnu.org/licenses/gpl-2.0.html.

*/

class WPFancyFundraising {
    
    private $pagetemplates = array();
    private $customiser = null;

    public function __construct() {

        // Add special page templates
        if(version_compare(floatval(get_bloginfo('version')), '4.7', '<')) {
			add_filter('page_attributes_dropdown_pages_args',       array( $this, 'register_project_templates' ) );

		} else {
			add_filter('theme_page_templates',                      array( $this, 'add_new_template' ) );

		}

        add_filter('wp_insert_post_data',                           array( $this, 'register_project_templates' ) );
        add_filter('template_include',                              array( $this, 'view_project_template'), get_theme_mod('fancyfundraising_template_filterpriority', 10) );

        // Special page templates
        $this->pagetemplates = array('template-donate1.php' => 'Fancy Fundraising - Simple Donation Page');

        // Shortcodes for tally bars and other embeddable elements
        add_shortcode('fancyfundraising_tallybar1',                 array( $this, 'sc_tallybar1') );

        // Customise the special templates as if they're part of the regular theme!
        require('customiser.php');
        $this->customiser = New WPFancyFundraising_Customiser();
        
        // Code to update this plugin via GitHub
        if (is_admin()) {
            if(!class_exists('BFIGitHubPluginUpdater')) {
                require_once( 'BFIGitHubPluginUploader.php' );
            }
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

    public function add_new_template($posts_templates) {
		$posts_templates = array_merge($posts_templates, $this->pagetemplates);
		return $posts_templates;
	}

    public function view_project_template($template) {
        // Checks if this special template is assigned to this page
        // From http://www.wpexplorer.com/wordpress-page-templates-plugin/

        global $post;

        if(!isset($post)) {
            return $template;
        }

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

    public function sc_tallybar1($atts) {
        // This Shortcode embeds a tally bar within the site's content.

        $a = shortcode_atts(array(
            'logo' => '',
            'bgimg' => '',
            'bgcol' => '#E3C7B9',
            'color' => '#FFF',
            'line1' => '',
            'line2' => '',
            'min-height' => '150px',
            'button_text' => 'Donate Now',
            'button_url' => '/donate/',
            'button_bgcolor' => '#003A9B',
            'button_bgcolorhover' => '#00529B',
            'button_textcolor' => '#FFF',
         ), $atts);
        
        // We can now embed shortcodes within shortcode attributes!
        $a['line1'] = do_shortcode(str_replace(array("{", "}"), array("[", "]"), $a['line1']));
        $a['line2'] = do_shortcode(str_replace(array("{", "}"), array("[", "]"), $a['line2']));

        // Ensure the ".foundation" namespaced version is added to the page (callin this here will load it in the footer)
        wp_enqueue_style("foundation-namespaced", plugin_dir_url( __FILE__ ) . "static/css/foundation-namespaced.min.css");

        ob_start();
        require("section-tallybar1.php");
        $return = ob_get_clean();
        
        return $return;

    }

}

$WPFancyFundraisingObj = New WPFancyFundraising();
