<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
session_start();
// $loop = unserialize($_SESSION['loop']);
global $post;
$post = unserialize($_SESSION['post']);
echo '<pre>';
print_r($_SESSION['post']);
echo '</pre>';
?>
<div class="row">
	<div class="small-12 column">
		<ul class="large-block-grid-3 xlarge-block-grid-4">
		<?php 
			// if ($loop->have_posts()) : 
			// while ($loop->have_posts()) : $loop->the_post();
				if(get_post_type() == 'video'){
					$yt_url = get_post_meta(get_the_ID(), 'gcpl_video_url', true);
					echo $yt_url;
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
				<li class="post type-post hentry">						
						<div class="figure-wrapper">
							<figure class="figure-image">
								<a href="<?php the_permalink();?>" title="<?php printf(__('Read more about %s.', 'game-compass-theme'), get_the_title());?>">
									<img src="<?php echo $img_src;?>">
								</a>
								<div class="high-light-border"></div>
							</figure>
							<figcaption class="figure-caption-wrapper">
								<a href="<?php the_permalink();?>" title="<?php printf(__('Read more about %s.', 'game-compass-theme'), get_the_title());?>" class="excerpt">
									<h2 class="entry-title figure-caption-upper">
										<?php echo get_the_icon(get_the_ID(), "game-type").'&nbsp;'.get_the_title(); ?><?php //the_post_thumbnail(); ?>
									</h2>
								</a>
								<div id="<?php echo $post->post_name;?>" class="content figure-caption-middle">
									<span class="entry-meta">
										<span class="meta-prep meta-prep-author">
											<?php _e('Posted on', 'game-compass-theme'); ?>
										</span> 
										<span class="entry-date">
											<span class="published" title="<?php the_time('c');?>">
											<?php 
												if ($locale == 'de_DE'): 
												the_time('d.m.Y'); ?> um <?php the_time('H:i');
												else:
												the_time( 'F jS, Y' ); ?> at <?php the_time( 'g:i a' );
												endif;?>
											</span>, by 
											<span class="author vcard">
												<span class="fn">
												<?php the_author();?>
												</span>
											</span>
										</span>
									</span><!-- .entry-meta -->
									<div class="entry-summary">
										<a href="<?php the_permalink();?>" title="<?php printf(__('Read more about %s.', 'game-compass-theme'), get_the_title());?>" class="excerpt">
										<?php the_excerpt(); ?>
										<?php //echo wp_trim_words(get_the_excerpt(), 15, '&hellip;&nbsp;<a href="'. esc_url(get_permalink()).'">'.__('Read more', 'game-compass-theme').'</a>'); ?>
										</a>
									</div><!-- .entry-summary -->
									<div class="clearfix">
										<?php 
										// if (!empty($gameTypeArray = get_terms("game-type", array('number' => '1',) ))){
										// foreach( $gameTypeArray as $term ){
										// $gameType = $term->name ;
										// }
										// switch ($gameType){
										// case "Mobile Game": 	echo "M";
										// break;
										// case "Flash Game": 		echo "F";
										// break;
										// case "Online Game": 	echo "O";
										// break;
										// case "Offline Game": 	echo "C";
										// break;
										// case "Browser Game": 	echo "B";
										// break;
										// }
										// }
										// echo get_the_icon(get_the_ID(), "game-type");																
										// echo get_the_icon(get_the_ID(), "cpu-need");
										// echo get_the_icon(get_the_ID(), "memory-need");
										// echo get_the_icon(get_the_ID(), "vram-need");
										// echo get_the_icon(get_the_ID(), "mobile-os");
										?> 
									</div>
								</div>
								<div class="figure-caption-bottom">
									<a class="button tiny" href="<?php the_permalink();?>play">
										<?php _e("Play Now!", "game-compass-theme"); ?>
									</a>
								</div>
							</figcaption>
						</div>
				</li><!--end .accordion-navigation-->				
			<?php 
			// endwhile;
			// endif; 
			?>
			</ul><!--end .accordion-->
		</div><!--end .small-12 .column-->
	</div><!--end .row-->
<script type="text/javascript">
	jQuery(document).ready(function( $ ){		
		jQuery(document).foundation();
	});
</script>