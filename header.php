<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Constanzia
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content', 'constanzia'); ?></a>

	<div class="nav-wrapper">
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<a id="navicon" class="menu-toggle"><i class="fa fa-bars"></i> <span><?php _e('Menu', 'constanzia'); ?></span></a>
			<?php wp_nav_menu(array('theme_location' => 'primary')); ?>
		</nav><!-- #site-navigation -->
	</div>

	<header style="background:url(<?php header_image(); ?>);" id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php if (get_theme_mod('main_avatar')) { ?>
				<img width="190" class="avatar" src="<?php echo get_theme_mod('main_avatar'); ?>">
			<?php } ?>
			<h1 class="site-title"><a href="<?php echo esc_url(home_url( '/' )); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
			<h2 class="site-description"><?php bloginfo('description'); ?></h2>
		</div>	
		
	</header><!-- #masthead -->

	<div id="content" class="site-content">
