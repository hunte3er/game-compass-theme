<?php
/**
 * @package Game Compass Theme
 */
?>

<?php if(is_single()):?>
<div class="content-container">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<div class="row">
				<h1 class="entry-title small-12 column">
					<?php the_title(); ?>
				</h1>
			</div>
			<div class="row">
				<div class="entry-summary small-12 column">
					<b>
						<?php echo wp_trim_words(get_the_excerpt(), 30, '&hellip;'); ?>
					</b>
				</div><!-- .entry-meta -->
			</div>
			<div class="row">
				<div class="entry-meta small-12 column">
					<?php game_compass_theme_posted_on(); ?>
				</div><!-- .entry-meta -->
			</div>
		</header><!-- .entry-header -->			
		<div class="entry-content">
			<?php if(function_exists(get_post_gallery_ids)||has_post_thumbnail()): ?>
			<div class="row">
				<div class="small-12 column">
				<?php if($galleryArray = get_post_gallery_ids($post->ID)):?>
					<div class="gallery-slider">						
					<?php foreach ($galleryArray as $id):?>
						<div class="gallery-slide">
							<img src="<?php echo wp_get_attachment_url( $id ); ?>">
						</div>
					<?php endforeach;?>
					</div>
				<?php elseif(has_post_thumbnail()):?>
					<?php the_post_thumbnail(); ?>
				<?php endif;?>
				</div>
			</div>			
			<?php endif;?>	
			<div class="row">
				<div class="small-12 column">
					<?php $features = get_post_meta(get_the_ID(), 'gcpl_feature_list', true);?>
					<?php if(!empty($features)):?>
					<ul class="feature-list">
						<?php foreach($features as $feature):?>
						<li><?php echo $feature;?></li>
						<?php endforeach;?>
					</ul>
					<?php endif;?>
					<?php the_content(); ?>
				</div>
			</div>
		</div><!-- .entry-content -->
		<footer class="entry-footer">
			<?php game_compass_theme_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</article><!-- #post-## -->
</div>
<?php endif;?>

<?php if(is_archive()): ?>
<?php
	if(get_post_type() == 'video'){
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
					<?php //the_excerpt(); ?>
					<?php echo wp_trim_words(get_the_excerpt(), 30, '&hellip;&nbsp;<a href="'. esc_url(get_permalink()).'">'.__('Read more', 'game-compass-theme').'</a>'); ?>
				</div><!-- .entry-summary -->
			</div>
			<div class="content-lower">
				<div class="button-container small-6 columns small-centered">
					<a class="button tiny" href="<?php the_permalink();?>/play">
						<?php _e("Play Now!", "game-compass-theme"); ?>
					</a>
				</div>
			</div>	
		</div><!-- .content-->
	</dd><!-- .accordion-navigation-->
</dl><!-- .accordion-->
<?php endif;?>
