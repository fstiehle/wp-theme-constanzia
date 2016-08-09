<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Constanzia
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-wrap">
			<div class="site-info">
				<div class="backtotop">
					<a href="#">Back to top <i class="fa fa-arrow-up"></i></a>
				</div>
				<div class="footer_sidebar">
					<?php dynamic_sidebar('footer'); ?>
				</div>
					<?php echo esc_attr(get_theme_mod('footer_text')); ?>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
