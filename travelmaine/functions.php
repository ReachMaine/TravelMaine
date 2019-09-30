<?php
function divi__child_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'divi__child_theme_enqueue_styles' );


//you can add custom functions below this line:
//require_once(get_stylesheet_directory().'/custom/reach-CTAs.php');
require_once(get_stylesheet_directory().'/custom/language.php');
require_once(get_stylesheet_directory().'/custom/divi.php');
require_once(get_stylesheet_directory().'/custom/acadp.php');
require_once(get_stylesheet_directory().'/custom/tribe_events.php');
require_once(get_stylesheet_directory().'/custom/acadp-pets-shortcode.php');

function my_scripts_method() {
    wp_enqueue_script(
        'rmm_custom_js',
        get_stylesheet_directory_uri() . '/custom/divi.js',
        array( 'jquery' )
    );
}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

// order search result alphabetically
function abc_search( $query ) {
	if( $query->is_search && !is_admin() ) {
		$query->set( 'orderby', 'title' );
		$query->set( 'order', 'ASC' );
	}
}
add_filter( 'pre_get_posts','abc_search' );
// use html5 search form
add_theme_support('html5', array('search-form'));

/*
 * Extend wp search to include custom post meta
 */
function dc_custom_search_query( $query ) {
    if ( !is_admin() && $query->is_search ) {
        $query->set('relation', 'OR');
        $query->set('meta_query', array(
            array(
                'key' => 'address',
                'value' => $query->query_vars['s'],
                'compare' => 'LIKE'
            )
        ));
         //$query->set('post_type', '__your_post_type__'); // optional
    };
}
//add_filter( 'pre_get_posts', 'dc_custom_search_query');

add_filter( 'posts_where', 'my_posts_where' );
function my_posts_where( $where ) { // include location meta in serach
    if ( !is_admin() && is_search() ) {

        global $wpdb;
        $search = get_search_query();
        $search = like_escape( $search );

        // include postmeta in search
        $where .= " OR {$wpdb->posts}.ID IN (SELECT {$wpdb->postmeta}.post_id FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.meta_key = 'address' AND {$wpdb->postmeta}.meta_value LIKE '%$search%' AND {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id)";
    }
    return $where;
}
