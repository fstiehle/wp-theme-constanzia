<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 * @package Constanzia
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses constanzia_header_style()
 * @uses constanzia_admin_header_style()
 * @uses constanzia_admin_header_image()
 */
function constanzia_custom_header_setup() {
	add_theme_support('custom-header', apply_filters('constanzia_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'fff',
		'width'                  => 1920,
		'height'                 => 620,
		'flex-height'            => true,
		'wp-head-callback'       => 'constanzia_header_style',
		'admin-head-callback'    => 'constanzia_admin_header_style',
		'admin-preview-callback' => 'constanzia_admin_header_image',
	) ) );
}
add_action('after_setup_theme', 'constanzia_custom_header_setup');

if (!function_exists('constanzia_header_style')) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see constanzia_custom_header_setup().
 */
function constanzia_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if (HEADER_TEXTCOLOR == $header_text_color) {
		return;
	}
	// If we get this far, we have custom styles. Let's do this. ?>

	<style type="text/css">
    <?php
        $menu_text_color = get_option('menu_textcolor');
        // Menu navigation text color
		if ('#ffffff' != $menu_text_color) :
	?>
        .main-navigation ul a,
        .main-navigation ul a:hover,
        .menu-toggle {
            color: <?php echo $menu_text_color; ?>;
        } 
        
	<?php endif; 
		// Has the text been hidden?
		if ('blank' == $header_text_color) :
	?>
		.site-title a,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		elseif ('#ffffff' != $header_text_color) :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; 
	if (get_theme_mod('sidebar_alignment') === 'left') { ?>
		#primary {
			float: right;
		}
		#secondary {
			float: left;
		}
	<?php }	?>

		.site-header {
			background-color: <?php echo get_option('header_backgroundcolor'); ?>!important;
		}
	

	<?php if (get_option('quickpost_backgroundcolor') != '#f5f5f5') { ?>
		.post-type-archive-quickposts article {
			background-color: <?php echo get_option('quickpost_backgroundcolor'); ?>!important;
		}
	<?php } ?>

	<?php if (get_option('pagetitle_backgroundcolor') != '#f5f5f5') { ?>
		.page-title {
			background-color: <?php echo get_option('pagetitle_backgroundcolor'); ?>!important;
		}
	<?php } ?>

	</style>
	<?php
}
endif; // constanzia_header_style

if (!function_exists('constanzia_admin_header_image')) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see constanzia_custom_header_setup().
 */
function constanzia_admin_header_image() {
	$style = sprintf(' style="color:#%s;"', get_header_textcolor()); ?>
	
    <div id="headimg">
        
		<h1 class="displaying-header-text">
            <a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php bloginfo( 'name' ); ?>
            </a>
        </h1>
		
        <div class="displaying-header-text" id="desc"<?php echo $style; ?>>
            <?php bloginfo( 'description' ); ?>
        </div>
        
		<?php if ( get_header_image() ) : ?>
            <img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
        
	</div>
<?php 
}
endif; // constanzia_admin_header_image