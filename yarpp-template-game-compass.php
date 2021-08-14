<?php
/*
YARPP Template: Game Compass
*/ ?>

<?php
	if (have_posts()) :
	global $WP_Query;
	$first_post = $WP_Query->posts[0];
	$post_type_object = get_post_type_object(get_post_type($first_post->ID));
	$post_type_labels = $post_type_object->labels;
	echo get_query_var('post-type');
?>
<div class="row">
	<div class="small-12 column">
		<aside class="widget-box">
		<h3><?php printf(__('Related %s', 'game-compass-theme'), $post_type_labels->name);?></h3>
		<ul class="related-articles">
		<?php while (have_posts()) : the_post(); ?>
				<li class="post type-post hentry">						
					<?php get_template_part('content', 'archive');?>
				</li><!--end .accordion-navigation-->				
			<?php endwhile;?>
			</ul><!--end .accordion-->
			</aside>
		</div><!--end .small-12 .column-->
	</div><!--end .row-->
<?php endif; ?>