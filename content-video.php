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
		
	</header><!-- .entry-header -->	
		
		<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages(array(
				'before' => '<div class="page-links">' . __('Pages:', 'constanzia'),
				'after'  => '</div>',
			) );
		?>
		</div><!-- .entry-content -->
	
	<h1 class="entry-title">
			<?php the_title(sprintf('<h1 class="entry-title"><a href="%s" rel="bookmark">',
                esc_url(get_permalink())), '</a></h1>'); ?>
		</h1>

		<div class="entry-meta">
			<?php constanzia_posted_on(); ?>
		</div><!-- .entry-meta -->
	
</article><!-- #post-## -->
