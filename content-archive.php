<?php
/**
 * @package Game Compass Theme
 */
?>

<?php
	if(($current_post_type = get_post_type()) == 'video'){
		$yt_url = get_post_meta(get_the_ID(), 'gcpl_video_url', true);
		preg_match('/(\/embed\/)(.*)/', $yt_url, $matches);
		$yt_id_args = $matches[2];
		
		if(strpos($yt_id_args, '?')){
			$temp = explode('?', $yt_id_args);
			$yt_id = $temp[0];
		}
		else{
			$yt_id = $yt_id_args;
		}
		$img_src = sprintf('http://img.youtube.com/vi/%s/maxresdefault.jpg', $yt_id);
	}
	else{
		$img_src = get_the_post_thumbnail_src(get_the_ID());
	}
?>
<dl class="accordion" data-accordion="game-list">
	<dt class="accordion-background">
		<img src="<?php echo $img_src;?>">
		<div class="high-light-border"></div>
	</dt>
	<dd class="accordion-navigation post type-post hentry">
		<a href="#<?php echo $post->post_name;?>" title="<?php the_title(); ?>">												
			<h2 class="entry-title">
				<?php echo get_the_icon(get_the_ID(), "game-type").'&nbsp;'.get_the_title(); ?><?php //the_post_thumbnail(); ?>
			</h2>
		</a>
		<div id="<?php echo $post->post_name;?>" class="content">
			<div class="content-inner">
				<div class="entry-meta">
					<?php game_compass_theme_posted_on()?>
				</div>
				<div class="entry-summary">
					<a class="excerpt" href="<?php the_permalink();?>" title="<?php printf(__('Read more about %s.', 'game-compass-theme'), get_the_title());?>">
						<?php the_excerpt(); ?>
					</a>
				</div><!-- .entry-summary -->
			</div>
			<div class="content-lower">
				<div class="button-container">
					<?php if($current_post_type == 'game'):?>
						<?php get_play_button($id);?>
					<?php elseif($current_post_type == 'video'):?>
					<a class="button tiny" href="<?php the_permalink();?>">
						<?php _e('Watch Now!', 'game-compass-theme'); ?>
					</a>
					<?php elseif($current_post_type == 'news'):?>
					<a class="button tiny" href="<?php the_permalink();?>">
						<?php _e('Read Now!', 'game-compass-theme'); ?>
					</a>
					<?php elseif($current_post_type == 'review'):?>
					<a class="button tiny" href="<?php the_permalink();?>">
						<?php _e('Read Now!', 'game-compass-theme'); ?>
					</a>
					<?php endif;?>
				</div>
			</div>	
		</div><!-- .content-->
	</dd><!-- .accordion-navigation-->
</dl><!-- .accordion-->
