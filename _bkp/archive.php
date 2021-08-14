<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Game Compass Theme
 */

get_header(); ?>

  <?php //$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );?>
						<div class="small-12 medium-8 large-9 xlarge-10 column left">
							<div class="row">
								<div class="small-12 column">
									<!--<h1 class="page-title"><?php //echo $term->name; ?></h1>-->
								</div><!--end .small-12 .column-->
							</div><!--end .row-->
							<?php //$filtered_tax = array('game-type', 'ambience', 'publisher', 'cpu-need', 'memory-need', 'vram-need', 'mobile-os');	?>
							<div class="row">
								<div class="small-12 column">
									<?php 
										// get_taxonomy_filter_cb('game-type');										
										/*$args = array( 	'post_type' 				=> 'game', 
														'posts_per_page' 			=> 12,
														get_query_var('taxonomy') 	=> get_query_var('term')
														);
										global $filtered_tax;
										$filtered_tax = array('game-type', 'ambience', 'publisher', 'cpu-need', 'memory-need', 'vram-need', 'mobile-os');
										// $loop = new WP_Query(args_for_filter('game', 10, $filtered_tax));
										$loop = new WP_Query($args);*/
										session_start();
										global $wp_query;
										$_SESSION['loop'] = serialize($wp_query);
									?>
								</div><!--end .small-12 .column-->
							</div><!--end .row-->
							<div data-interchange="[<?php echo get_template_directory_uri();?>/partials/accordion.php, (small)], [<?php echo get_template_directory_uri();?>/partials/accordion.php, (medium)], [<?php echo get_template_directory_uri();?>/partials/default.php, (large)]">
							</div>	
							<div class="row">
							<?php wpex_pagination(/*$loop*/);?>
							</div>
						</div><!--end .small-12 .medium-8 .column .left-->
						<?php get_sidebar('archive'); ?>
						<?php get_footer(); ?>