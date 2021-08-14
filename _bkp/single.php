<?php
/**
 * The template for displaying all single posts.
 *
 * @package Game Compass Theme
 */

get_header(); ?>
	<div id="primary" class="content-area small-12 large-8 xlarge-8 column left">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
		
			<?php get_template_part( 'content', get_post_type()); ?>

			<?php game_compass_theme_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar('single'); ?>
<?php get_footer(); ?>
