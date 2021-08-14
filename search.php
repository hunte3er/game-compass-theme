<?php
/**
 * The template for displaying search results pages.
 *
 * @package Game Compass Theme
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>
				<div class="row">
					<div class="small-12 column">

						<header class="page-header">
							<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'game-compass-theme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
						</header><!-- .page-header -->
					</div><!--end .small-12 .column-->
				</div><!--end .row-->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="row">
					<div class="small-12 column">

						<?php
						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'content', 'search' );
						?>
					</div><!--end .small-12 .column-->
				</div><!--end .row-->

			<?php endwhile; ?>

			<?php game_compass_theme_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
