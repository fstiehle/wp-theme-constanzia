<?php
/**
 * Constanzia Theme Customizer
 *
 * @package Constanzia
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function constanzia_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
    
    /* new section */
    $wp_customize->add_section('constanzia_footer', array(
        'title' => __('Footer', 'constanzia'),
        'priority' => 999
    ));
    
    /* footer text */
    $wp_customize->add_setting('footer_text', array(
        'default' => 'Constanzia Theme designed by Anbian and powered by WordPress'
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'footer_text', array(
        'label' => __('Footer text', 'constanzia'),
        'section' => 'constanzia_footer'
    )));
    
    /* Colors extended */
    $colors = array();
    
    $colors[] = array(
        'slug' => 'header_backgroundcolor',
        'default' => '#fe767a',
        'label' => __('Header Background Color', 'constanzia')
    );
    
    $colors[] = array(
        'slug' => 'quickpost_backgroundcolor',
        'default' => '#f5f5f5',
        'label' => __('Quick Post Card Background Color', 'constanzia')
    );
    
    $colors[] = array(
        'slug' => 'pagetitle_backgroundcolor',
        'default' => '#f5f5f5',
        'label' => __('Page Title Box Background Color', 'constanzia')
    );
    
    foreach ($colors as $color) {
        // SETTINGS
        $wp_customize->add_setting($color['slug'], array(
            'default' => $color['default'],
            'type' => 'option',
            'capability' => 'edit_theme_options'
        ));
        // CONTROLS
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $color['slug'], array(
            'label' => $color['label'],
            'section' => 'colors',
            'settings' => $color['slug']
        )));
    }
    
    $wp_customize->add_section('global_options', array(
        'title' => 'Global Options',
        'priority' => 30
    ));
    
    $wp_customize->add_setting('main_avatar', array(
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'main_avatar', array(
        'section' => 'global_options',
        'label' => 'Main Avatar'
    )));
    
    
    $wp_customize->add_setting('sidebar_alignment', array(
        'default' => true,
        'transport' => 'postMessage',
        'default' => 'right'
    ));
    
    $wp_customize->add_control('sidebar_alignment', array(
        'section' => 'global_options',
        'label' => 'Sidebar Alignment',
        'type' => 'radio',
        'choices' => array(
            'left' => __('Left', 'constanzia'),
            'right' => __('Right', 'constanzia')
        )
    ));
    
    /**/
    
    $wp_customize->add_section('quickposts_options', array(
        'title' => 'Quick Posts',
        'priority' => 31
    ));
    
    $wp_customize->add_setting('quickposts_limit', array(
        'default' => true,
        'transport' => 'postMessage',
        'default' => 30
    ));
    
    $wp_customize->add_control('quickposts_limit', array(
        'section' => 'quickposts_options',
        'label' => 'Max Quickposts to display',
        'type' => 'text'
    ));
    
    $wp_customize->add_setting('quickposts_live', array(
        'default' => true,
        'transport' => 'postMessage',
        'default' => true
    ));
    
    $wp_customize->add_control('quickposts_live', array(
        'section' => 'quickposts_options',
        'label' => 'Enable Live Updates',
        'type' => 'checkbox'
    ));
    
    $wp_customize->add_setting('quickposts_title', array(
        'default' => true,
        'transport' => 'postMessage',
        'default' => true
    ));
    
    $wp_customize->add_control('quickposts_title', array(
        'section' => 'quickposts_options',
        'label' => 'Show Quickpost Page Title',
        'type' => 'checkbox'
    ));
    
    
}
add_action('customize_register', 'constanzia_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function constanzia_customize_preview_js() {
    wp_enqueue_script('constanzia_customizer', get_template_directory_uri() . '/js/customizer.js', array(
        'customize-preview'
    ), '', false);
}
add_action('customize_preview_init', 'constanzia_customize_preview_js');