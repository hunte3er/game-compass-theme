<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Game Compass Theme
 */

if ( ! function_exists( 'game_compass_theme_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function game_compass_theme_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'game-compass-theme' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'game-compass-theme' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'game-compass-theme' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'game_compass_theme_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function game_compass_theme_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'game-compass-theme' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'game-compass-theme' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'game-compass-theme' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'game_compass_theme_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function game_compass_theme_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'game-compass-theme' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'game-compass-theme' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;

if ( ! function_exists( 'game_compass_theme_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function game_compass_theme_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'game-compass-theme' ) );
		if ( $categories_list && game_compass_theme_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'game-compass-theme' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'game-compass-theme' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'game-compass-theme' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'game-compass-theme' ), __( '1 Comment', 'game-compass-theme' ), __( '% Comments', 'game-compass-theme' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'game-compass-theme' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function game_compass_theme_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'game_compass_theme_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'game_compass_theme_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so game_compass_theme_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so game_compass_theme_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in game_compass_theme_categorized_blog.
 */
function game_compass_theme_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'game_compass_theme_categories' );
}
add_action( 'edit_category', 'game_compass_theme_category_transient_flusher' );
add_action( 'save_post',     'game_compass_theme_category_transient_flusher' );

function get_the_post_thumbnail_src($id){
	$thumbnail = '';
	$thumb_id = get_post_thumbnail_id($id);
	if ($thumb_id){
		$thumbnail = wp_get_attachment_image_src( $thumb_id, 'full', false);
		/*if ($thumbnail){ 
			(string)$thumbnail = $thumbnail[0];
		}*/
	}
	return $thumbnail[0];
}

function the_post_thumbnail_src($id){
	echo get_the_post_thumbnail_src($id);
}

function get_the_icon($id, $tax, $extra_text = false){
	if (!empty($terms_array = get_the_terms($id, $tax))){
		if($extra_text){
			$extra = '%3$s';
			$align = '';
			}
		else{
			$extra = '';
			$align = ' left';
			}
			
		$tax_object = get_taxonomy($tax );	
		$tax_object_labels = $tax_object->labels;
		$this_tax = $tax_object_labels->singular_name;
			
		$span_html = '<div data-tooltip aria-haspopup="true" title="%1$s" class="icon-row clearfix'.$align.'"><div class="icon left" style="background-image: url('.get_template_directory_uri().'/images/icons/'.'%2$s'.'.png'.');"></div><span class="icon-text">'.$extra.'</span></div>';
		
		if ($tax == "game-type"){		
			foreach( $terms_array as $term ){
			  $this_term_name = $term->name ;
			}
			
			$m_game = __("Mobile Game", "game-compass-theme");
			$f_game = __("Flash Game", "game-compass-theme");
			$o_game = __("Online Game", "game-compass-theme");
			$r_game = __("Offline Game", "game-compass-theme");
			$b_game = __("Browser Game", "game-compass-theme");
			$m_game_text = __("This game is a <strong>%s</strong>. Unless you use any kind of emulation software, this will only run on the given mobile operating systems.", "game-compass-theme");
			$f_game_text = __("This game is a <strong>%s</strong>. It's supposed to be run in your browser. <strong>Adobe Flash Player</strong> is needed.", "game-compass-theme");
			$o_game_text = __("This game is an <strong>%s</strong>. Most of them have <strong>no single player mode</strong> and need an <strong>active internet connection</strong> to be played.", "game-compass-theme");
			$r_game_text = __("This game is an <strong>%s</strong>, so it needs <strong>no active internet connection</strong> to be played.", "game-compass-theme");
			$b_game_text = __("This game is a <strong>%s</strong>. It's played in your browser, so you need an <strong>active internet connection</strong> to play this game.", "game-compass-theme");
		
			switch ($this_term_name){
				case $m_game: 	$icon = "mobile-game";
								$tooltip = sprintf($m_game_text, $this_term_name);
								break;
				case $f_game: 	$icon = "flash-game";
								$tooltip = sprintf($f_game_text, $this_term_name);
								break;
				case $o_game: 	$icon = "online-game";
								$tooltip = sprintf($o_game_text, $this_term_name);
								break;
				case $r_game: 	$icon = "offline-game";
								$tooltip = sprintf($r_game_text, $this_term_name);
								break;
				case $b_game: 	$icon = "browser-game";
								$tooltip = sprintf($b_game_text, $this_term_name);
								break;
			}
		}
		elseif($tax == "mobile-os"){			
			$mobile_text = __("You need to have at least one of the following mobile operating systems running on your device: <strong>%s</strong>", "game-compass-theme");
			$mobile_terms_array = get_terms($tax);
			
			foreach( $mobile_terms_array as $term ){
				$this_slug = $term->slug;
				if (strpos($this_slug, "ios") !== false){
					$i_os_icon = "ios";
					$i_os_name[] = $term->name;
				}
				elseif (strpos($this_slug, "android") !== false){
					$And_icon = "android";
					$And_name[] = $term->name;
				}
				else{
					$Win_icon = "windows-phone";
					$Win_name[] = $term->name;
				}
			}
			if($i_os_icon)
				$output .= sprintf($span_html, sprintf($mobile_text,implode(", ", $i_os_name)), $i_os_icon, $this_tax);
			if($And_icon)
				$output .= sprintf($span_html, sprintf($mobile_text,implode(", ", $And_name)), $And_icon, $this_tax);
			if($Win_icon)
				$output .= sprintf($span_html, sprintf($mobile_text,implode(", ", $Win_name)), $Win_icon, $this_tax);
			return $output;
		}
		elseif($tax == "video-type"){
			$lp_text = __("This video is part of a <strong>'Let’s Play'-series</strong>.", "game-compass-theme");
			$trailer_text = __("This video is a <strong>trailer</strong> or <strong>tv spot</strong> of this game.", "game-compass-theme");
			
			foreach( $terms_array as $term ){
				$this_term = $term->name ;
			}
			if($this_term == "Let’s Play"){
				$icon = "lets-play";
				$tooltip = sprintf($lp_text, $this_term);
			}
			else{
				$icon = "trailer";
				$tooltip = sprintf($trailer_text, $this_term);
			}
		}
		else{			
			$cpu_text = __("Your system needs at least a CPU frequency of <strong>%s</strong> to run this game properly.", "game-compass-theme");
			$memory_text = __("Your system needs at least <strong>%s</strong> of <strong>memory (RAM)</strong> to run this game properly.", "game-compass-theme");
			$vram_text = __("Your system needs at least <strong>%s</strong> of <strong>video memory (VRAM)</strong> to run this game properly.", "game-compass-theme");
			
			foreach( $terms_array as $term ){
			  $this_term_slug = $term->slug ;
			  $this_term_name = $term->name ;
			}
			$icon = $tax;
			if($tax == "cpu-need")
				$tooltip = sprintf($cpu_text, $this_term_name);
			if($tax == "memory-need")
				$tooltip = sprintf($memory_text, $this_term_name);
			if($tax == "vram-need")
				$tooltip = sprintf($vram_text, $this_term_name);
		}
		return sprintf($span_html, $tooltip ,$icon, $this_tax);
	}
} 

function get_taxonomy_filter_cb($tax){	
	$terms = get_terms($tax);
	// $is_empty = ($_GET['tags'])?false:true;
	foreach($terms as $term){
		$tag = $term->term_taxonomy_id;
		// if ($is_empty){
			// $is_checked = 'checked';
			// $_GET['tags'][] = $tag;
		// }
		// else{
		$checked = '';
		
		if (isset($_GET['tags'])){
			if(is_array($_GET['tags'])){
				if(in_array($term->term_taxonomy_id, $_GET['tags']))
					$checked = 'checked';
			}
			else{
				if($term->term_taxonomy_id == $_GET['tags'])
					$checked = 'checked';
			}
		}
		$term_taxonomy_ids[] = $term->term_taxonomy_id;
		$tag_check_map[] = array( 'id' => $term->term_taxonomy_id, 'checked' => $checked, 'name' => $term->name);
	}
	
	if (isset($_GET['tags'])&&is_array($_GET['tags'])){
		if (is_array($term_taxonomy_ids)){
			if(count(array_intersect($_GET['tags'],$term_taxonomy_ids)) == count($term_taxonomy_ids)){
				$all_checked = true;
			}
		}
	}		
		
	if (!empty($tag_check_map)){
		foreach($tag_check_map as $map){
			$output .= sprintf('<div class="filter clearfix">
									<div class="onoffswitch">
										<input type="checkbox" class="onoffswitch-checkbox" name="tags[]" id="%1$s" value="%1$s" onchange="this.form.submit()" %2$s>
										<label  class="onoffswitch-label" for="%1$s">
											<span class="onoffswitch-inner"></span>
											<span class="onoffswitch-switch"></span>
										</label>
									</div>
									<span class="filter-label">
										%3$s
									</span>
								</div>',
								$map['id'], (!$all_checked)?$map['checked']:'', $map['name']);
		}
	}
	
	// echo '<pre>';
	// print_r($tag_check_map);
	// echo '</pre>';
	
	return $output;
}

function filter_by($tax){
	$output = '<form method="get">';
	$output .= sprintf('<aside class="widget-box"><h3>%1$s</h3>', __('Filter', 'game-compass-theme'));
	$keys = array_keys($_GET);
	foreach($keys as $key)
		if($key != 'tags')
		$output .= sprintf('<input type="hidden" name="%1$s" value="%2$s"></input>', $key, $_GET[$key]);
	if(is_array($tax)){
		foreach($tax as $current_tax){
			$tax_object = get_taxonomy($current_tax );	
			$this_tax_terms = get_terms($tax_object->name);
			$tax_object_labels = $tax_object->labels;
			$this_tax = $tax_object_labels->singular_name;
			if (count($this_tax_terms) > 0){
				$output .= sprintf('<div class="tag-filter"><h4>%1$s</h4>', $this_tax);
				$output .= '<div class="tag-filter-body">';
				$output .= get_taxonomy_filter_cb($current_tax, false);
				$output .= '</div>';
				$output .= '</div>';
			}
		}
	}
	else{
		$tax_object = get_taxonomy($tax );	
		$tax_object_labels = $tax_object->labels;
		$this_tax = $tax_object_labels->singular_name;
		$output .= sprintf('<div class="tag-filter"><h4>%1$s</h4>', $this_tax);
		$output .= '<div class="tag-filter-body">';
		$output .= get_taxonomy_filter_cb($tax, false);
		$output .= '</div>';
		$output .= '</div>';
	}
	$output .= '</aside>';
	$output .= '<noscript><input type="submit" value="Submit"></noscript></form>';
	return $output;
}

function args_for_filter($post_type, $posts_per_page, $tax=''){
	if(is_array($tax)){
		foreach($tax as $current_tax) {
			$terms = get_terms($current_tax);
			$term_tax_ids = '';

			foreach ( $terms as $term )
				$term_tax_ids[] = $term->term_taxonomy_id;
				
			$count_intersections = (is_array($_GET['tags']))?count($tag_intersections = array_intersect($term_tax_ids, $_GET['tags'])):0;
			
			if($count_intersections == count($term_tax_ids) || $count_intersections == 0){
				$term_taxonomy_ids = (is_array($term_taxonomy_ids))?array_merge($term_taxonomy_ids, $term_tax_ids):$term_tax_ids;
			}
			else{
				$term_taxonomy_ids = (is_array($term_taxonomy_ids))?array_merge($term_taxonomy_ids, $tag_intersections):$tag_intersections;
				$all_intersections = (is_array($all_intersections))?array_merge($all_intersections, $tag_intersections):$tag_intersections;
			}
		}
		
		if(isset($all_intersections))
			$_GET['tags'] = $all_intersections;
		
		$args = array( 	'post_type' 				=> $post_type, 
						'posts_per_page' 			=> $posts_per_page,
						'tax_query' 				=> array(
								'relation'	=> 'AND',
								array(
										'taxonomy' 	=> 'genre',
										'field' 	=> 'slug',
										'terms' 	=> $_GET['genre'],
										'operator' 	=> 'IN',
									),
								array(	
										'taxonomy' 	=> 'game-type',
										'field' 	=> 'term_taxonomy_id',
										'terms' 	=> $term_taxonomy_ids,
										'operator' 	=> 'IN',
									),
						)
					);
	}
	elseif (!empty($tax)){
		$terms = get_terms( $tax );
		fwrite(STDERR, "Terms:" . $terms . "\n");

		foreach ( $terms as $term ){
			$term_tax_ids[] = $term->term_taxonomy_id;
			fwrite(STDERR, "TermTaxID:" . $term->term_taxonomy_id . "\n");
		}

		$count_intersections = count($tag_intersections = array_intersect($term_tax_ids, $_GET['tags']));
		fwrite(STDERR, "Intersections:" . $tagintersections . "\n");

		if($count_intersections == count($term_tax_ids) || $count_intersections == 0)
			$term_taxonomy_ids = $term_tax_ids;
		else
			$term_taxonomy_ids = $tag_intersections;
		
		$_GET['tags'] = $tag_intersections;
			
		$args = array( 	'post_type' 				=> $post_type, 
						'posts_per_page' 			=> $posts_per_page,
						'tax_query' 				=> array(
								'relation'	=> 'AND',
								array(
										'taxonomy' 	=> get_query_var('taxonomy'),
										'field' 	=> 'slug',
										'terms' 	=> get_query_var('term'),
										'operator' 	=> 'IN',
									),
								array(
										'field' 	=> 'term_taxonomy_id',
										'terms' 	=> $term_taxonomy_ids,
										'operator' 	=> 'IN',
									),
						)
					);
	}
	else{
		$args = array( 	'post_type' 				=> $post_type, 
						'posts_per_page' 			=> $posts_per_page,
						get_query_var('taxonomy') 	=> get_query_var('term')
					);
	}
	// echo '<pre>';
	// print_r($_GET);
	// echo '</pre>';
				
	return $args;
}

class taxonomy_filter{
    var $tax;
	var $term;
	var $taxonomies;
	var $post_types;
	var $post_type;
	var $type_tax_map;
	var $or_queries;
	var $where;

    public function __construct(){
		add_action('pre_get_posts', array($this, 'filter_parse_query'));
    }

    public function filter_parse_query( $wp_query ){
			$this->get_data();
//            add_filter('posts_request', array($this, 'filter_where'));
//            add_filter('posts_selection', array($this, 'remove_where'));
    }

    public function filter_where($input){
		global $wpdb;
		$term_taxonomy_ids = array(162);
		$parser = new SqlParser();
		$clauses = $parser->ParseString($input)->getArray();
		preg_match('/([^\s]*)\.(.*)$/', $clauses['select'], $col);
		$select = $clauses['select'];
		$from = $clauses['from'];
		foreach($clauses as $section => $clause)
			$clauses[$section] = str_replace($col[1], "temp", $clause);
		$join = preg_replace('/FROM\s[^\s]*\s/', '', $clauses['from']);
		$clauses['from'] = "FROM (SELECT ".$col[1].".* ".$from." WHERE 1=1 AND (".$wpdb->term_relationships.".term_taxonomy_id IN (".implode(',', $term_taxonomy_ids)."))) AS temp ".$join;
		$output = $clauses['select'].$clauses['from'].$clauses['where'].$clauses['order'].$clauses['limit'];
		// echo '<pre>';
		// print_r($clauses);
		// echo '</pre>';
		return $output;
	}

    public function remove_where(){
        remove_filter('posts_where', array($this, 'filter_where'));
    }

	private function get_data(){
		$post_types = get_post_types();
		foreach($post_types as $type){
			$taxonomies[] = get_object_taxonomies($type);
		}
		// echo '<pre>';
		// print_r($taxonomies);
		// echo '<pre>';
		// foreach($this->type_tax_map as $key => $values) {
			// foreach($values as $value){
				// $terms = get_terms($value);
				// if(!empty($terms)){
				// $term_tax_ids = '';

				// foreach ( $terms as $term )
					// $term_tax_ids[] = $term->term_taxonomy_id;
					
				// $count_intersections = (is_array($_GET['tags']))?count($tag_intersections = array_intersect($term_tax_ids, $_GET['tags'])):0;
				
				// if($count_intersections == count($term_tax_ids) || $count_intersections == 0){
					// $term_taxonomy_ids = (is_array($term_taxonomy_ids))?array_merge($term_taxonomy_ids, $term_tax_ids):$term_tax_ids;
				// }
				// else{
					// $term_taxonomy_ids = (is_array($term_taxonomy_ids))?array_merge($term_taxonomy_ids, $tag_intersections):$tag_intersections;
					// $all_intersections = (is_array($all_intersections))?array_merge($all_intersections, $tag_intersections):$tag_intersections;
				// }
				
				// if($value == $this->tax){
					// $this->base_query = get_tax_sql(array(
											// array(
												// 'taxonomy' 	=> $value,
												// 'field' 	=> 'id',
												// 'terms' 	=> $term_taxonomy_ids,
												// 'operator' 	=> 'IN',
											// )
										// ), $wpdb->posts, 'ID' );
				// }
				// else{
					// $this->or_queries[] = get_tax_sql(array(
											// array(
												// 'taxonomy' 	=> $value,
												// 'field' 	=> 'id',
												// 'terms' 	=> $term_taxonomy_ids,
												// 'operator' 	=> 'IN',
											// )
										// ), $wpdb->posts, 'ID' );
				// }
			// }
			// }
		// }
	}
}
$taxonomy_filter = new taxonomy_filter();
function my_posts_request_filter( $input ) {
	global $wpdb;
	$term_taxonomy_ids = array(160);
	$parser = new SqlParser();
	$clauses = $parser->ParseString($input)->getArray();
	preg_match('/([^\s]*)\.(.*)$/', $clauses['select'], $col);
	$select = $clauses['select'];
	$from = $clauses['from'];
	foreach($clauses as $section => $clause)
		$clauses[$section] = str_replace($col[1], "temp", $clause);
	$join = preg_replace('/FROM\s[^\s]*\s/', '', $clauses['from']);
	$clauses['from'] = "FROM (SELECT ".$col[1].".* ".$from." WHERE 1=1 AND (".$wpdb->term_relationships.".term_taxonomy_id IN (".implode(',', $term_taxonomy_ids)."))) AS temp ".$join;
	echo '<pre>';
	print_r($clauses);
	echo '</pre>';
	return $input;
}
// add_filter( 'posts_request', 'my_posts_request_filter' );

/**
 * This is a simple sql tokenizer / parser.
 * 
 * It does NOT support multiline comments at this time.
 * 
 * See the included example.php for usage.
 *
 * THIS CODE IS A PROTOTYPE/BETA
 *
 * @author Justin Carlson <justin.carlson@gmail.com>
 * @license LGPL 3
 * @version 0.0.4
 */
class SqlParser {

    var $handle = null;
    
    // statements 
    public static $querysections = array('alter','create','drop', 
                                         'select', 'delete', 'insert', 
                                         'update', 'from', 'where', 
                                         'limit', 'order');
    
    // operators
    public static $operators = array('=', '<>', '<', '<=', '>', '>=', 
                                     'like', 'clike', 'slike', 'not', 
                                     'is', 'in', 'between');
    
    // types
    public static $types = array('character', 'char', 'varchar', 'nchar', 
                                 'bit', 'numeric', 'decimal', 'dec', 
                                 'integer', 'int', 'smallint', 'float', 
                                 'real', 'double', 'date', 'datetime', 
                                 'time', 'timestamp', 'interval', 
                                 'bool', 'boolean', 'set', 'enum', 'text');
    
    // conjuctions
    public static $conjuctions = array('by', 'as', 'on', 'into', 
                                       'from', 'where', 'with');
    
    // basic functions
    public static $funcitons = array('avg', 'count', 'max', 'min', 
                                     'sum', 'nextval', 'currval', 'concat',
                                     );
    
    // reserved keywords
    public static $reserved = array('absolute', 'action', 'add', 'all', 
                                    'allocate', 'and', 'any', 'are', 'asc', 
                                    'ascending', 'assertion', 'at', 
                                    'authorization', 'begin', 'bit_length', 
                                    'both', 'cascade', 'cascaded', 'case', 
                                    'cast', 'catalog', 'char_length', 
                                    'character_length', 'check', 'close', 
                                    'coalesce', 'collate', 'collation', 
                                    'column', 'commit', 'connect', 'connection',
                                    'constraint', 'constraints', 'continue', 
                                    'convert', 'corresponding', 'cross', 
                                    'current', 'current_date', 'current_time', 
                                    'current_timestamp', 'current_user', 
                                    'cursor', 'day', 'deallocate', 'declare', 
                                    'default', 'deferrable', 'deferred', 'desc',
                                    'descending', 'describe', 'descriptor', 
                                    'diagnostics', 'disconnect', 'distinct', 
                                    'domain', 'else', 'end', 'end-exec', 
                                    'escape', 'except', 'exception', 'exec', 
                                    'execute', 'exists', 'external', 'extract',
                                    'false', 'fetch', 'first', 'for', 'foreign',
                                    'found', 'full', 'get', 'global', 'go', 
                                    'goto', 'grant', 'group', 'having', 'hour',
                                    'identity', 'immediate', 'indicator', 
                                    'initially', 'inner', 'input', 
                                    'insensitive', 'intersect', 'isolation', 
                                    'join', 'key', 'language', 'last', 
                                    'leading', 'left', 'level', 'limit', 
                                    'local', 'lower', 'match', 'minute', 
                                    'module', 'month', 'names', 'national', 
                                    'natural', 'next', 'no', 'null', 'nullif', 
                                    'octet_length', 'of', 'only', 'open', 
                                    'option', 'or', 'order', 'outer', 'output',
                                    'overlaps', 'pad', 'partial', 'position', 
                                    'precision', 'prepare', 'preserve', 
                                    'primary', 'prior', 'privileges', 
                                    'procedure', 'public', 'read', 'references',
                                    'relative', 'restrict', 'revoke', 'right',
                                    'rollback', 'rows', 'schema', 'scroll', 
                                    'second', 'section', 'session', 
                                    'session_user', 'size', 'some', 'space',
                                    'sql', 'sqlcode', 'sqlerror', 'sqlstate', 
                                    'substring', 'system_user', 'table', 
                                    'temporary', 'then', 'timezone_hour', 
                                    'timezone_minute', 'to', 'trailing', 
                                    'transaction', 'translate', 'translation', 
                                    'trim', 'true', 'union', 'unique', 
                                    'unknown', 'upper', 'usage', 'user', 
                                    'using', 'value', 'values', 'varying', 
                                    'view', 'when', 'whenever', 'work', 'write',
                                    'year', 'zone', 'eoc');
    
    // open parens, tokens, and brackets
    public static $startparens = array('{', '(');
    public static $endparens = array('}', ')');
    public static $tokens = array(',', ' ');
    private $query = '';

    // constructor (placeholder only)
    public function __construct() {
        
    }

    /**
     * Simple SQL Tokenizer
     *
     * @author Justin Carlson <justin.carlson@gmail.com>
     * @license GPL
     * @param string $sqlQuery
     * @return token array
     */
    public static function Tokenize($sqlQuery, $cleanWhitespace = true) {

        /**
         * Strip extra whitespace from the query
         */
        if ($cleanWhitespace === true) {
            $sqlQuery = ltrim(preg_replace('/[\\s]{2,}/', ' ', $sqlQuery));
        }

        /**
         * Regular expression parsing.
         * Inspired/Based on the Perl SQL::Tokenizer by Igor Sutton Lopes
         */
        
        // begin group
        $regex = '(';
        
        // inline comments
        $regex .= '(?:--|\\#)[\\ \\t\\S]*';
        
        // logical operators
        $regex .= '|(?:<>|<=>|>=|<=|==|=|!=|!|<<|>>|<|>|\\|\\||\\||&&|&|-';
        $regex .= '|\\+|\\*(?!\/)|\/(?!\\*)|\\%|~|\\^|\\?)';
        
        // empty quotes
        $regex .= '|[\\[\\]\\(\\),;`]|\\\'\\\'(?!\\\')|\\"\\"(?!\\"")';
        
        // string quotes
        $regex .= '|".*?(?:(?:""){1,}"';
        $regex .= '|(?<!["\\\\])"(?!")|\\\\"{2})';
        $regex .= '|\'.*?(?:(?:\'\'){1,}\'';
        $regex .= '|(?<![\'\\\\])\'(?!\')';
        $regex .= '|\\\\\'{2})';
        
        // c comments
        $regex .= '|\/\\*[\\ \\t\\n\\S]*?\\*\/';
        
        // wordds, column strings, params
        $regex .= '|(?:[\\w:@]+(?:\\.(?:\\w+|\\*)?)*)';
        $regex .= '|[\t\ ]+';
        
        // period and whitespace
        $regex .= '|[\.]'; 
        $regex .= '|[\s]'; 

        $regex .= ')'; # end group
        
        // perform a global match
        preg_match_all('/' . $regex . '/smx', $sqlQuery, $result);

        // return tokens
        return $result[0];
    }

    /**
     * Simple SQL Parser
     *
     * @author Justin Carlson <justin.carlson@gmail.com>
     * @license LGPL 3
     * @param string $sqlQuery
     * @param bool optional $cleanup
     * @return SqlParser Object
     */
    public static function ParseString($sqlQuery, $cleanWhitespace = true) {

        // instantiate if called statically
        if (!isset($this)) {
            $handle = new SqlParser();
        } else {
            $handle = $this;
        }

        // copy and tokenize the query
        $tokens = self::Tokenize($sqlQuery, $cleanWhitespace);
        $tokenCount = count($tokens);
        $queryParts = array();
        if (isset($tokens[0])===true) {
            $section = $tokens[0];
        }

        // parse the tokens
        for ($t = 0; $t < $tokenCount; $t++) {

            // if is paren
            if (in_array($tokens[$t], self::$startparens)) {

                // read until closed
                $sub = $handle->readsub($tokens, $t);
                $handle->query[$section].= $sub;
                
            } else {

                if (in_array(strtolower($tokens[$t]), self::$querysections) && !isset($handle->query[$tokens[$t]])) {
                    $section = strtolower($tokens[$t]);
                }

                // rebuild the query in sections
                if (!isset($handle->query[$section]))
                    $handle->query[$section] = '';
                $handle->query[$section] .= $tokens[$t];
            }
        }

        return $handle;
    }

    /**
     * Parses a sub-section of a query
     *
     * @param array $tokens
     * @param int $position
     * @return string section
     */
    private function readsub($tokens, &$position) {

        $sub = $tokens[$position];
        $tokenCount = count($tokens);
        $position++;
        while (!in_array($tokens[$position], self::$endparens) && $position < $tokenCount) {

            if (in_array($tokens[$position], self::$startparens)) {
                $sub.= $this->readsub($tokens, $position);
                $subs++;
            } else {
                $sub.= $tokens[$position];
            }
            $position++;
        }
        $sub.= $tokens[$position];
        return $sub;
    }

    /**
     * Returns manipulated sql to get the number of rows in the query.
     * Can be used for simple pagination, for example.
     *
     * @author Justin Carlson <justin.carlson@gmail.com>
     * @license LGPL 3
     * @return string sql
     */
    public function getCountQuery($optName = 'count') {

        // create temp copy of query
        $temp = $this->query;
        
        // create count() version of select and unset any limit statement
        $temp['select'] = 'select count(*) as `'.$optName.'` ';
        if (isset($temp['limit'])) {
            unset($temp['limit']);
        }
        
        return implode(null, $temp);
    }

    /**
     * Returns manipulated sql to get the unlimited number of rows in the query.
     *
     * @author Justin Carlson <justin.carlson@gmail.com>
     * @license LGPL 3
     * @return string sql
     */
    public function getLimitedCountQuery() {

        $this->query['select'] = 'select count(*) as `count` ';
        return implode('', $this->query);
    }

    /**
     * Returns the select section of the query.
     *
     * @author Justin Carlson <justin.carlson@gmail.com>
     * @license LGPL 3
     * @return string sql
     */
    public function getSelectStatement() {

        return $this->query['select'];
    }

    /**
     * Returns the from section of the query.
     *
     * @author Justin Carlson <justin.carlson@gmail.com>
     * @license LGPL 3
     * @return string sql
     */
    public function getFromStatement() {

        return $this->query['from'];
    }

    /**
     * Returns the where section of the query.
     *
     * @author Justin Carlson <justin.carlson@gmail.com>
     * @license LGPL 3
     * @return string sql
     */
    public function getWhereStatement() {

        return $this->query['where'];
    }

    /**
     * Returns the limit section of the query.
     *
     * @author Justin Carlson <justin.carlson@gmail.com>
     * @license LGPL 3
     * @return string sql
     */
    public function getLimitStatement() {

        return $this->query['limit'];
    }

    /**
     * Returns the specified section of the query.
     *
     * @author Justin Carlson <justin.carlson@gmail.com>
     * @license LGPL 3
     * @return string sql
     */
    public function get($which) {

        if (!isset($this->query[$which]))
            return false;
        return $this->query[$which];
    }

    /**
     * Returns the sections of the query.
     *
     * @author Justin Carlson <justin.carlson@gmail.com>
     * @license LGPL 3
     * @return string sql
     */
    public function getArray() {

        return $this->query;
    }

}

function the_game_profile($id){
		$game = get_the_game();
		$id = $game->ID;		
		
		$post_type = get_post_type($id);
		$taxonomies = get_object_taxonomies($post_type);
?>
	<div class="row">
		<div class="small-12 columns">
			<div  class="table-wrapper">
				<table class="game-profile">
					<tr>
						<th colspan="2" class="game-profile-header">
							<figure class="game-profile-image">
								<?php echo get_the_post_thumbnail($id);?>
							</figure>
							<figcaption class="game-profile-caption">
								<a href="<?php echo get_the_permalink($id);?>">
									<h3>
										<?php echo get_the_icon($id, "game-type").'&nbsp;'.get_the_title($id);?>
									</h3>
								</a>
							</figcaption>
						</th>
					</tr>
					<?php 
					foreach($taxonomies as $taxonomy):
						if($terms = get_the_terms($id, $taxonomy)): 
							$taxonomy_object = get_taxonomy($taxonomy);	
							$taxonomy_labels = $taxonomy_object->labels;
							$taxonomy_name = $taxonomy_labels->singular_name;?>
							<tr>
								<td>
									<?php echo $taxonomy_name;?>
								</td>
								<td>
									<?php
										$term_list = '';
										foreach($terms as $term){
											if($term_list != '')
												$term_list .= ', ';
											$term_list .= $term->name;
											//$term_list .= ', ';
										}
										//preg_replace('/,\s$/', '', $term_list);
										echo $term_list;
									?>
								</td>
							</tr>
					<?php endif;?>
					<?php endforeach;?>		
					<tr>
						<td colspan="2">
							<div class="row">
								<div class="small-10 columns small-centered">
									<?php get_play_button($id);?>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
<?php
}

function get_the_game(){
	if(($current_post_type = get_post_type()) != 'game'){
		$connected = new WP_Query(array(
								'connected_type' => 'game_to_'.$current_post_type,
								'connected_items' => get_queried_object(),
								'nopaging' => true,
							));	
		while($connected->have_posts()){ 
			$connected->the_post();
			$the_game = get_post(get_the_ID());
		}
		wp_reset_postdata();
	}
	else{
		$the_game = get_queried_object();
	}
	
	return $the_game;
}

function get_linked_content(){
	$post_types = get_post_types(array('_builtin' => false));
	
	foreach($post_types as $post_type){
		if($post_type != 'game'){
			$connections[] = 'game_to_'.$post_type;
			$post_type_object = get_post_type_object($post_type);
			$post_type_label[] = $post_type_object->labels->name;
		}
	}
	
	$current_id = get_the_ID();
	$current_post_type = get_post_type();
	
	$the_game = get_the_game();		
	
	foreach($connections as $label_nr => $connection){
		$connected = new WP_Query(array(
								'connected_type' => $connection,
								'connected_items' => $the_game,
								'nopaging' => true,
							));	
							
		if ( $connected->have_posts() ) : ?>
			<?php if(str_replace('game_to_', '', $connection) != $current_post_type || $connected->post_count > 1):?>
			<div class="row">
				<div class="small-12 column">
					<aside class="widget-box">
						<h3>
							<?php echo $post_type_label[$label_nr];?>
						</h3>
						<ul class="related-articles">
						<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
							<?php if($current_id != get_the_ID()):?>
							<li>
								<?php get_template_part('content', 'archive');?>
							</li>
							<?php endif;?>
						<?php endwhile; ?>
						</ul>
					</aside>
				</div><!--end .small-12 .column-->
			</div><!--end .row-->
			<?php endif;
			// Prevent weirdness
			wp_reset_postdata();
		endif;
	}
}

// Numbered Pagination
if ( !function_exists( 'wpex_pagination' ) ) {
	
	function wpex_pagination($wpex_query = NULL) {
		
		$prev_arrow = is_rtl() ? '&rarr;' : '&larr;';
		$next_arrow = is_rtl() ? '&larr;' : '&rarr;';
		
		global $wp_query;
		if ( $wpex_query ){
			$total = $wpex_query->max_num_pages;
		}
		else{
			$total = $wp_query->max_num_pages;
		}
		$big = 999999999; // need an unlikely integer
		if( $total > 1 )  {
			 if( !$current_page = get_query_var('paged') )
				 $current_page = 1;
			 if( get_option('permalink_structure') ) {
				 $format = 'page/%#%/';
			 } else {
				 $format = '&paged=%#%';
			 }
			echo paginate_links(array(
				'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'		=> $format,
				'current'		=> max( 1, get_query_var('paged') ),
				'total' 		=> $total,
				'mid_size'		=> 3,
				'type' 			=> 'list',
				'prev_text'		=> $prev_arrow,
				'next_text'		=> $next_arrow,
			 ) );
		}
	}
	
}

function get_play_button($id){
	if(is_array($game_type_objects = get_the_terms($id, 'game-type'))):
		foreach($game_type_objects as $game_type_object)
			$game_types[] = $game_type_object->slug;
		$links = array();
		if(in_array('online-game', $game_types))
			$links['play'] = __('Get it Now!', 'game-compass-theme');
		if(in_array('browser-game', $game_types))
			$links['play'] = __('Play Now!', 'game-compass-theme');
		if(in_array('offline-game', $game_types))
			$links['play'] = __('Get it Now!', 'game-compass-theme');
		if(in_array('flash-game', $game_types))
			$links['play'] = __('Play Now!', 'game-compass-theme');
			
		if(in_array('mobile-game', $game_types)){									
			$mobile_os_objects = get_the_terms($id, 'mobile-os');
			foreach($mobile_os_objects as $mobile_os_object){
				$mobile_os = $mobile_os_object->slug;
				if(preg_match('/([w|W]in)/', $mobile_os))
					$links['windows-store'] = __('Get it from Windows Store!', 'game-compass-theme');
				if(preg_match('/([d|D]roid)/', $mobile_os))
					$links['google-play-store'] = __('Get it from Google Store!', 'game-compass-theme');
				if(preg_match('/([[i|I][o|O][s|S])/', $mobile_os))
					$links['app-store'] = __('Get it from App Store!', 'game-compass-theme');									
			}
		}
		if(count($links) > 1):?>
			<button data-dropdown="drop" aria-controls="drop", aria-expanded="false" class="tiny button dropdown expand"><?php _e('Play Now!', 'game-compass-theme');?></button><br>
			<ul id="drop" data-dropdown-content class="f-dropdown" role="menu", aria-hidden="false" tabindex="-1">
			<?php foreach($links as $link => $linktext):?>
				<?php if($linktext != ''):?>
					<li>
						<a href="<?php echo get_permalink().$link;?>">
							<?php echo $linktext;?>
						</a>
					</li>
				<?php endif;?>
			<?php endforeach;?>
			</ul>
		<?php else:?>	
			<?php foreach($links as $link => $linktext):?>
			<a class="button tiny expand" href="<?php echo get_permalink().$link;?>">
				<?php echo $linktext;?>
			</a>
			<?php endforeach;?>
		<?php endif;?>
	<?php else:?>
	<a class="button tiny" href="<?php the_permalink();?>/play">'
		<?php _e('Play Now!', 'game-compass-theme');?>
	</a>
<?php endif;
}
