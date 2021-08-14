<?php
/**
 * @package Game Compass Theme
 */
?>

<?php if(is_single()):?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="row entry-content">
		<div class="small-12 column">
			<?php $video_URL = get_post_meta(get_the_ID(), 'gcpl_video_url', true);?>
			<?php if($video_URL != ''):?>
			<div class="flex-video widescreen">
				<iframe width="560" height="315" src="<?php echo $video_URL;?>" frameborder="0" allowfullscreen></iframe>
			</div>						
			<?php endif;?>
		</div>
	</div>
	<header class="entry-header row">
		<h1 class="entry-title small-12 column">
			<?php the_title(); ?>
		</h1>	
	</header><!-- .entry-header -->
	<div class="row">
		<div class="entry-meta small-12 column">
			<?php game_compass_theme_posted_on(); ?>
		</div><!-- .entry-meta -->
	</div>
	<div class="row">
		<div class="small-12 column">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'game-compass-theme' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	</div>

	<footer class="entry-footer">
		<?php game_compass_theme_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
<?php endif;?>
<?php if(is_archive()):?>
<?php endif;?>
