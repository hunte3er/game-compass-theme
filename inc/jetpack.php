<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Game Compass Theme
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function game_compass_theme_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'game_compass_theme_jetpack_setup' );
