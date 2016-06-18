<?php

class WPFancyFundraising_Customiser {
    // Sets up the customiser

    public function __construct() {
        // Register the customiser function
        add_action('customize_register',                            array($this, 'customize_register'));
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

        $wp_customize->add_setting(
            'fancyfundraising_form_btnpressonce',
            array(
                'default'    => false,
                'transport'  => 'postMessage',
            )
        );

        $wp_customize->add_control( 'fancyfundraising_form_btnpressonce', array(
            'label'      => 'Donation Button - Press Once',
            'section'    => 'fancyfundraising_donationtemplate_options',
            'settings'   => 'fancyfundraising_form_btnpressonce',
            'type'       => 'checkbox'
        ) );

    }
}
