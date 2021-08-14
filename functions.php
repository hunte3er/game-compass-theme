<?php
/**
 * Game Compass Theme functions and definitions
 *
 * @package Game Compass Theme
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'game_compass_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function game_compass_theme_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Game Compass Theme, use a find and replace
	 * to change 'game-compass-theme' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'game-compass-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'game-compass-theme' ),
		'offcanvas' => __( 'Off Canvas Menu', 'game-compass-theme' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'game_compass_theme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // game_compass_theme_setup
add_action( 'after_setup_theme', 'game_compass_theme_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function game_compass_theme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Archive - Sidebar', 'game-compass-theme' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Game - Sidebar', 'game-compass-theme' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'game_compass_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function game_compass_theme_scripts() {
	wp_enqueue_style( 'game-compass-theme-style', get_stylesheet_uri() );

	wp_enqueue_script( 'game-compass-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'game-compass-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'game_compass_theme_scripts' );

function enqueue_foundation() {
    /* Add Foundation CSS */
    //wp_enqueue_style( 'foundation-normalize', get_stylesheet_directory_uri() . '/foundation/css/normalize.css' );
    //wp_enqueue_style( 'foundation', get_stylesheet_directory_uri() . '/foundation/css/foundation.css' );
    wp_enqueue_style( 'foundation', get_stylesheet_directory_uri() . '/foundation/stylesheets/app.css' );
	wp_enqueue_style( 'slick', 'http://cdn.jsdelivr.net/jquery.slick/1.3.13/slick.css');
	wp_enqueue_style( 'custom-scroll', get_stylesheet_directory_uri() . '/jquery.mCustomScrollbar.min.css');
    //wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/foundation/js/foundation.min.js', array( 'jquery' ), '5', true );
	wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/foundation/bower_components/foundation/js/foundation.min.js', array( 'jquery' ), '5', true);
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/foundation/bower_components/foundation/js/vendor/modernizr.js', array( 'jquery' ), '6', true);
	wp_enqueue_script( 'foundation-tooltip-js', get_template_directory_uri() . '/foundation/bower_components/foundation/js/foundation/foundation.tooltip.js', array( 'jquery'), '7', true);	
	wp_enqueue_script( 'app-js', get_template_directory_uri() . '/foundation/js/app.js', array( 'jquery' ), '8', true);	
	wp_enqueue_script( 'slick', 'http://cdn.jsdelivr.net/jquery.slick/1.3.13/slick.min.js', array( 'jquery' ), '9', true);
	wp_enqueue_script( 'custom-scroll', get_template_directory_uri() . '/js/jquery.mCustomScrollbar.concat.min.js', array( 'jquery' ), '10', true);
    }
add_action( 'wp_enqueue_scripts', 'enqueue_foundation' );
/* Add Foundation footer */
function foundation_footer(){
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(document).foundation();
        });
    </script>
    <?php
}
add_filter('wp_footer','foundation_footer');

class Foundation_DropDown_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth){
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"menu\">\n";
  }	
  function start_el(&$output, $item, $depth=0, $args=[], $id=0) {
		if($args->walker->has_children)
			$submenu = " is-dropdown-submenu-parent";
		else
			$submenu = "";
		$output .= "<li class='" .  implode(" ", $item->classes) . $submenu . "'>";
 
		$output .= '<a href="' . $item->url . '">';
 
		$output .= $item->title;
 
		$output .= '</a>';
 
		// if ($args->walker->has_children) {
			// $output .= '<i class="caret fa fa-angle-down"></i>';
		// }
	}
}

function recursive_array_search($needle,$haystack) {
    foreach($haystack as $key=>$value) {
        $current_key=$key;
        if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
            return $current_key;
        }
    }
    return false;
}

/* ------------------------------------------------------ */
/* Convert absolute URLs in content to site relative ones
   Inspired by http://thisismyurl.com/6166/replace-wordpress-static-urls-dynamic-urls/
*/
function sp_clean_static_url($content) {
   $thisURL = get_bloginfo('url');
   $stuff = str_replace(' src=\"'.$thisURL, ' src=\"', $content );
   $stuff = str_replace(' href=\"'.$thisURL, ' href=\"', $stuff );
	return $stuff;
}
add_filter('content_save_pre','sp_clean_static_url','99');
/* ------------------------------------------------------ */

/* ------------------------------------------------------ */
// Add confirmation dialogue box when publishing posts/pages
// https://gist.github.com/plasticmind/4337952
/* = Add a "molly guard" to the publish button */
 
add_action( 'admin_print_footer_scripts', 'sr_publish_molly_guard' );
function sr_publish_molly_guard() {
echo sprintf("<script>
	jQuery(document).ready(function($){
		$('#publishing-action input[name=\"publish\"]').click(function() {
			if(confirm('%s')) {
				return true;
			}
			else{
				$('#publishing-action .spinner').hide();
				$('#publishing-action img').hide();
				$(this).removeClass('button-primary-disabled');
				return false;
			}
		});
	});
</script>
", __('Are you sure you want to publish this?', 'game-compass-theme'));
}
/* ------------------------------------------------------ */

/* ------------------------------------------------------ */
// Remove hardcoded width and height from the_post_thumbnail.
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
/* ------------------------------------------------------ */

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
