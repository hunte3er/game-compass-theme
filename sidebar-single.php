<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Game Compass Theme
 */
?>				
				<div class="small-12 large-4 xlarge-3 column right off-screen">
					<div id="secondary" class="widget-area" role="complementary">
						<?php the_game_profile($post->ID);?>
						<?php get_linked_content(); ?>				
						<?php dynamic_sidebar( 'sidebar-2' ); ?>
					</div><!-- #secondary -->
				</div><!--end .small-12 .medium-4 .column .right-->
