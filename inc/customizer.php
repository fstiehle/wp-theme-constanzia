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
        'priority' => 999,
    ));
    
    /* footer text */
    $wp_customize->add_setting('footer_text', array(
        'default' => 'Constanzia Theme powered by WordPress',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'footer_text', array(
        'label' => __('Footer text', 'constanzia'),
        'section' => 'constanzia_footer'
    )));
    
    /* Colors extended */
    $colors = array();
    
    $colors[] = array(
        'slug' => 'menu_textcolor',
        'default' => '#fffff',
        'label' => __('Menu Text Color', 'constanzia'),
        'description' => ''
    );
    
    $colors[] = array(
        'slug' => 'header_backgroundcolor',
        'default' => '#fe767a',
        'label' => __('Header Background Color', 'constanzia'),
        'description' => 'Shows if no Header Image is selected.'
    );
    
    $colors[] = array(
        'slug' => 'pagetitle_backgroundcolor',
        'default' => '#f5f5f5',
        'label' => __('Page Title Box Background Color', 'constanzia'),
        'description' => 'Background Color for Page, Archive and Category Title Box.'
    );
    
    foreach ($colors as $color) {
        // SETTINGS
        $wp_customize->add_setting($color['slug'], array(
            'default' => $color['default'],
            'type' => 'option',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        // CONTROLS
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $color['slug'], array(
            'label' => $color['label'],
            'section' => 'colors',
            'settings' => $color['slug'],
            'description' => $color['description']
        )));
    }
    
    $wp_customize->add_section('global_options', array(
        'title' => 'Global Options',
        'priority' => 30
    ));
    
    $wp_customize->add_setting('main_avatar', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'constanzia_sanitize_image'
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'main_avatar', array(
        'section' => 'global_options',
        'label' => 'Main Avatar'
    )));    
    
    $wp_customize->add_setting('sidebar_alignment', array(
        'default' => true,
        'transport' => 'postMessage',
        'default' => 'right',
        'sanitize_callback' => 'constanzia_sanitize_select'
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
}
add_action('customize_register', 'constanzia_customize_register');

/**
 * Sanitization: select  
 * Control: select, radio 
 * 
 * Sanitization callback for 'select' and 'radio' type controls. 
 * This callback sanitizes $input as a slug, and then validates
 * $input against the choices defined for the control.
 * Source: https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php
 */
function constanzia_sanitize_select($input, $setting) {	
	
    // Ensure input is a slug
	$input = sanitize_key($input);
	
	// Get list of choices from the control
	// associated with the setting
	$choices = $setting->manager->get_control($setting->id)->choices;
	
	// If the input is a valid key, return it;
	// otherwise, return the default
	if (array_key_exists($input, $choices)) {
        return $input;
    } else {
        return $setting->default;
    }
}
     
/**
 * Sanitizes input for valid filename and image mime_type
 * From: https://shellcreeper.com/how-to-sanitize-image-upload/
 */
function constanzia_sanitize_image($input) {
    $output = '';
 
    // check file type 
    // https://codex.wordpress.org/Function_Reference/wp_check_filetype
    $filetype = wp_check_filetype($input);
    $mime_type = $filetype['type'];
 
    // only mime type "image" allowed
    if (strpos($mime_type, 'image') !== false) {
        $output = $input;
    }
    return $output;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function constanzia_customize_preview_js() {
    wp_enqueue_script('constanzia_customizer', get_template_directory_uri() . '/js/customizer.js', array(
        'customize-preview'
    ), '', false);
}
add_action('customize_preview_init', 'constanzia_customize_preview_js');