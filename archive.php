<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Game Compass Theme
 */

get_header(); 

session_start();
global $wp_query;
$_SESSION['loop'] = serialize($wp_query);
?>
		<div class="small-12 medium-8 large-9 xlarge-10 column left">
		<?php if(have_posts()): ?>
			<header class="page-header content-container">
				<div class="row">
					<div class="small-12 column">
						<h1 class="page-title">
							<?php
								if(is_category()):
									single_cat_title();
								elseif(is_tag()):
									single_tag_title();
								elseif(is_author()):
									printf(__('Author: %s', 'game-compass-theme'), '<span class="vcard">'.get_the_author().'</span>');
								elseif(is_day()):
									printf(__('Day: %s', 'game-compass-theme'), '<span>'.get_the_date().'</span>');
								elseif(is_month()):
									printf(__('Month: %s', 'game-compass-theme'), '<span>'.get_the_date(_x('F Y', 'monthly archives date format', 'game-compass-theme')).'</span>');
								elseif(is_year()):
									printf(__('Year: %s', 'game-compass-theme'), '<span>'.get_the_date(_x('Y', 'yearly archives date format', 'game-compass-theme')).'</span>');
								elseif(is_tax('post_format', 'post-format-aside')):
									_e('Asides', 'game-compass-theme');
								elseif(is_tax('post_format', 'post-format-gallery')):
									_e('Galleries', 'game-compass-theme');
								elseif(is_tax('post_format', 'post-format-image')):
									_e('Images', 'game-compass-theme');
								elseif(is_tax('post_format', 'post-format-video')):
									_e('Videos', 'game-compass-theme');
								elseif(is_tax('post_format', 'post-format-quote')):
									_e('Quotes', 'game-compass-theme');
								elseif(is_tax('post_format', 'post-format-link')):
									_e('Links', 'game-compass-theme');
								elseif(is_tax('post_format', 'post-format-status')):
									_e('Statuses', 'game-compass-theme');
								elseif(is_tax('post_format', 'post-format-audio')):
									_e('Audios', 'game-compass-theme');
								elseif(is_tax('post_format', 'post-format-chat')):
									_e('Chats', 'game-compass-theme');			
								elseif(!is_tax('post_format') && is_tax(array('genre', 'ambience', 'publisher', 'mobile_os', 'age_restriction', 'cpu_need', 'memory_need', 'vram_need', 'game_type', 'video_type'))):
									echo get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'))->name;
									$gaco_specific = true;
								else:
									echo get_post_type_object(get_post_type())->labels->name;
									$gaco_specific = true;
								endif;
							?>
						</h1>
					</div><!--end .small-12 .column-->
				</div><!--end .row-->
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if(! empty($term_description)):
						printf('<div class="tag-description">%s</div>', $term_description);
					endif;
				?>
			</header><!-- .page-header -->
			
			<?php if($gaco_specific):?>
				<div class="row">
					<div class="small-12 column">
						<ul class="small-block-grid-1 large-block-grid-3 xlarge-block-grid-4 game-list">
							<?php while(have_posts()): the_post(); ?>
							<li>							
								<?php get_template_part('content', 'archive');?>
							</li>				
							<?php endwhile;?>
						</ul>
					</div><!--end .small-12 .column-->
				</div><!--end .row-->
						
			<?php else: 
				while(have_posts()): the_post();				
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php(where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part('content', get_post_format());				
				endwhile;					
			endif;?>
			<div class="row">
			<?php wpex_pagination();?>
			</div>
		<?php else:
			get_template_part('content', 'none');
		endif; ?>
		</div><!--end .small-12.medium-8.large-9.xlarge-10.column.left-->
<?php get_sidebar('archive'); ?>
<?php get_footer(); ?>