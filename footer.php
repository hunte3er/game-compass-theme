<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Game Compass Theme
 */
?>

						</div><!-- #content -->
					</div><!-- Foundation .row end -->
					<footer id="colophon" class="site-footer" role="contentinfo">
						<div class="row"><!-- Foundation .row start -->
							<div class="small-12 columns"><!-- Foundation .columns start -->
								<div class="site-info">
									<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'game-compass-theme' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'game-compass-theme' ), 'WordPress' ); ?></a>
									<span class="sep"> | </span>
									<?php printf( __( 'Theme: %1$s by %2$s.', 'game-compass-theme' ), 'Game Compass Theme', '<a href="http://game-compass.com" rel="designer">BubbaBarbarian</a>' ); ?>
								</div><!-- .site-info -->
							</div><!-- Foundation .columns end -->
						</div><!-- Foundation .row end -->
					</footer><!-- #colophon -->
				</div><!-- #page -->
			<a class="exit-off-canvas"></a><!-- close the off-canvas menu -->
		</div><!-- .inner-wrap -->
	</div><!-- Foundation .off-canvas-wrap end -->
	<?php wp_footer(); ?>
</body>
</html>
