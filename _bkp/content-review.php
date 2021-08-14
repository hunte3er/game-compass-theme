<?php
/**
 * @package Game Compass Theme
 */
?>

<?php if(is_single()):?>
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
		<div class="row">
			<div class="small-12 column">
				<?php 
				if(function_exists(get_post_gallery_ids)):
					if($galleryArray = get_post_gallery_ids($post->ID)):?>						
						<div class="gallery-slider">						
					<?php	foreach ($galleryArray as $id):?>
							<div>
								<img src="<?php echo wp_get_attachment_url( $id ); ?>">
							</div>
				<?php	endforeach;?>
						</div>
			<?php	endif;
				elseif(has_post_thumbnail()):
					the_post_thumbnail();
				endif;?>				
			</div>
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
	</div>

	<footer class="entry-footer">
		<?php game_compass_theme_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
<?php endif;?>
<?php if(is_archive()):?>
<?php endif;?>
