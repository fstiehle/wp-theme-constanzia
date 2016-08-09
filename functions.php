<?php
/**
 * Constanzia functions and definitions
 *
 * @package Constanzia
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (! isset($content_width)) {
	$content_width = 710; /* pixels */
}

if (! function_exists('constanzia_setup')) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function constanzia_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Constanzia, use a find and replace
	 * to change 'constanzia' to the name of your theme in all the template files
	 */
	load_theme_textdomain('constanzia', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');
    
    // https://make.wordpress.org/themes/2015/08/25/title-tag-support-now-required/ 
    add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(array(
		'primary' => __('Primary Menu', 'constanzia')
	));
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support('html5', array(
		'search-form', 'comment-form', 'comment-list'
	));

	set_post_thumbnail_size('730');
	add_image_size('fullwidth', '1060');
	add_image_size('quickposts', '500');

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support('post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	));

	// Setup the WordPress core custom background feature.
	add_theme_support('custom-background', apply_filters(
        'constanzia_custom_background_args', 
        array(
		      'default-color' => 'ffffff',
		      'default-image' => '',
	      )));
}
endif; // constanzia_setup
add_action('after_setup_theme', 'constanzia_setup');

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function constanzia_widgets_init() {
	register_sidebar(array(
		'name'          => __('Sidebar', 'constanzia'),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	));
	register_sidebar(array(
		'name'          => __('Footer', 'constanzia'),
		'id'            => 'footer',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	));
}
add_action('widgets_init', 'constanzia_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function constanzia_scripts() {
	wp_enqueue_style('constanzia-style', get_stylesheet_uri());

	wp_enqueue_script('jquery'); // Load Wordpress jQuery

	wp_enqueue_script('constanzia-navigation', get_template_directory_uri() .
                      '/js/navigation.js', array(), '20120206', true);

	wp_enqueue_style('constanzia-font-awesome', get_template_directory_uri() .
                     '/css/font-awesome.min.css');

	wp_enqueue_style('constanzia-google-font',
                     '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic|Open+Sans:400');

	wp_enqueue_script('constanzia-skip-link-focus-fix', get_template_directory_uri() .
                      '/js/skip-link-focus-fix.js', array(), '20130115', true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'constanzia_scripts');

/**
 * Add Editor style
 * Apply theme's stylesheet to the visual editor.
 */
function constanzia_add_editor_styles() {

    add_editor_style(get_stylesheet_uri()); 

    /* add google fonts to editor */
    $font_url = '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic|Open+Sans:400';
    add_editor_style(str_replace(',', '%2C', $font_url));
}
add_action('init', 'constanzia_add_editor_styles');

/**
 * Modify comment form fields
 */
function constanzia_comment_form_fields($fields) {
	//required variables for changing the fields value
	$commenter = wp_get_current_commenter();
	$req = get_option('require_name_email');
	$aria_req = ($req ? " aria-required='true'" : '');

	$fields['author'] = '<p class="comment-form-author">' . 
        '<label for="author">' . __('Name (required)', 'constanzia') . '</label> ' .
        
	($req ? '<span class="required">*</span>' : '') .
	'<input id="author" name="author" type="text" placeholder="' .
        __('Name (required)', 'constanzia') . '" value="' .
        
	esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>';
	$fields['email'] = '<p class="comment-form-email"><label for="email">' .
        __('Email (required)', 'constanzia') . '</label> ' .
        
	($req ? '<span class="required">*</span>' : '') .
	'<input id="email" name="email" type="text" placeholder="' .
        __('Email (required)', 'constanzia') . '" value="' .
        
	esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>';
    
	$fields['url'] = '<p class="comment-form-url"><label for="url">' .
        __('Website', 'constanzia') . '</label>' .
        
	'<input id="url" name="url" type="text" placeholder="' . __('Website', 'constanzia') . 
        '" value="' .
        
	esc_attr($commenter['comment_author_url']) . '" size="30" /></p>';
	return $fields;
} 
add_filter('comment_form_default_fields','constanzia_comment_form_fields');

/**
 * Return the post URL.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @return string The Link format URL.
 */
function constanzia_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content($content);

	return ($has_url) ? $has_url : apply_filters('the_permalink', get_permalink());
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';