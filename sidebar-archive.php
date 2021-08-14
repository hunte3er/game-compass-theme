<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Game Compass Theme
 */
?>

				<div class="small-12 medium-4 large-3 xlarge-2 column right off-screen">
					<div id="secondary" class="widget-area" role="complementary">
						<?php 
						global $filtered_tax;
						$filtered_tax = array('game-type', 'ambience', 'publisher', 'cpu-need', 'memory-need', 'vram-need', 'mobile-os');
						echo filter_by($filtered_tax); 
						?>
					</div><!-- #secondary -->
				</div><!--end .small-12 .medium-4 .column .right-->
