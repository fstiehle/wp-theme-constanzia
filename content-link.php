<?php
/**
 * @package Constanzia
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
	<header class="entry-header">

			<?php if (has_post_thumbnail()) {
                if (is_active_sidebar('sidebar-1')) { ?> 		
				
				<div class="thumbnail-wrap">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail(); ?> 
					</a>
				</div>

			<?php } else { ?>

				<div class="thumbnail-wrap-fullwidth">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('fullwidth'); ?> 
					</a>
				</div>
			
			<?php }
            } ?>

		<h1 class="entry-title">
			<a href="<?php echo esc_url(constanzia_get_link_url());?>">
                <?php the_title(); ?></a> →
		</h1>

		<div class="entry-meta">
			<?php constanzia_posted_on(); ?>
		</div><!-- .entry-meta -->
        
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages(array(
				'before' => '<div class="page-links">' . __('Pages:', 'constanzia'),
				'after'  => '</div>',
			));
		?>
	</div><!-- .entry-content -->
    
</article><!-- #post-## -->