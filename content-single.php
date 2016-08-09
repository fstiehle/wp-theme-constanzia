<?php
/**
 * @package Constanzia
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

			<?php if ( has_post_thumbnail() ) {
                if ( is_active_sidebar( 'sidebar-1' ) ) { ?> 		
				
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

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php constanzia_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content clearfix">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'constanzia' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if( !is_front_page() AND !is_home() ) { ?>
		<footer class="entry-footer">
			<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
				<?php
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( __( ' ', 'constanzia' ) );
					if ( $categories_list && constanzia_categorized_blog() ) :
				?>
				<span class="cat-links">
					<?php printf( __( '%1$s', 'constanzia' ), $categories_list ); ?>
				</span>
				<?php endif; // End if categories ?>

				<?php
					/* translators: used between list items, there is a space after the comma */
					$tags_list = get_the_tag_list( '', __( ' ', 'constanzia' ) );
					if ( $tags_list ) :
				?>
				<span class="tags-links">
					<?php printf( __( 'Tagged: %1$s', 'constanzia' ), $tags_list ); ?>
				</span>
				<?php endif; // End if $tags_list ?>
			<?php endif; // End if 'post' == get_post_type() ?>		
			
		</footer><!-- .entry-footer -->
	<?php } ?>
</article><!-- #post-## -->
