<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
 
// session_start();
// $loop = unserialize($_SESSION['loop']);
?>
							<div class="row">
								<div class="small-12 column">
									<dl class="accordion game-list" data-accordion>
										<?php 
										// if ($loop->have_posts()) : 
											// while ($loop->have_posts()) : $loop->the_post(); ?>
										<dd class="accordion-navigation post type-post hentry" style="background: url(<?php the_post_thumbnail_src(get_the_ID()); ?>)">
											<a href="#<?php echo $post->post_name;?>" title="<?php the_title(); ?>" class="high-light-border">
												<h2 class="entry-title">
													<?php echo get_the_icon(get_the_ID(), "game-type").'&nbsp;'.get_the_title(); ?><?php //the_post_thumbnail(); ?>
												</h2>
											</a>
											<div id="<?php echo $post->post_name;?>" class="content">
												<div class="row">
													<div class="entry-meta small-12 column">
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
															</span>
															, by 
															<span class="author vcard">
																<span class="fn">
																	<?php the_author();?>
																</span>
															</span>
														</span>
													</div><!-- .entry-meta -->
												</div><!--end .row-->											
												<div class="row">
													<div class="small-12 column">
														<div class="entry-summary">
															<?php //the_excerpt(); ?>
															<?php echo wp_trim_words(get_the_excerpt(), 30, '&hellip;&nbsp;<a href="'. esc_url(get_permalink()).'">'.__('Read more', 'game-compass-theme').'</a>'); ?>
														</div><!-- .entry-summary -->
													</div><!--end .small-12 .column-->
												</div><!--end .row-->
												<div class="row clearfix">
													<div class="small-6 columns right icon-container">
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
												<div class="row">
													<div class="button-container small-6 columns small-centered">
														<a class="button tiny" href="<?php the_permalink();?>/play">
															<?php _e("Play Now!", "game-compass-theme"); ?>
														</a>
														<!--<a class="button secondary tiny" href="<?php the_permalink();?>">-->
															<!--<?php _e("Read More...", "game-compass-theme"); ?>-->
														<!--</a>-->
													</div>
												</div>												
											</div><!--end #panel .content-->
										</dd><!--end .accordion-navigation-->
										<?php 
										// endwhile;
										// endif; ?>
									</dl><!--end .accordion-->
								</div><!--end .small-12 .column-->
							</div><!--end .row-->
							<script type="text/javascript">
	jQuery(document).ready(function( $ ){		
		jQuery(document).foundation();
	});
	</script>