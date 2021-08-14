<?php
/**
 * The template for displaying all single posts.
 *
 * @package Game Compass Theme
 */

get_header(); ?>
	<div class="large-0 xlarge-3 columns">
		blubb
	</div>
	<div id="primary" class="content-area small-12 large-8 xlarge-6 column">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'cpt-'.get_post_type() ); ?>
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
