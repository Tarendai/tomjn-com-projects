<?php
/* 
Plugin Name: Tomjn.com Data
Plugin URI: http://tomjn.com
Description: Sets up data separately from the theme
Version: 2
Author: TJNowell
Author URI: http://tomjn.com
License: GPL v2
*/

add_action( 'init', 'register_taxonomy_series' );

function register_taxonomy_series() {

    $labels = array( 
        'name' => _x( 'Series', 'series' ),
        'singular_name' => _x( 'Series', 'series' ),
        'search_items' => _x( 'Search Series', 'series' ),
        'popular_items' => _x( 'Popular Series', 'series' ),
        'all_items' => _x( 'All Series', 'series' ),
        'parent_item' => _x( 'Parent Series', 'series' ),
        'parent_item_colon' => _x( 'Parent Series:', 'series' ),
        'edit_item' => _x( 'Edit Series', 'series' ),
        'update_item' => _x( 'Update Series', 'series' ),
        'add_new_item' => _x( 'Add New Series', 'series' ),
        'new_item_name' => _x( 'New Series', 'series' ),
        'separate_items_with_commas' => _x( 'Separate series with commas', 'series' ),
        'add_or_remove_items' => _x( 'Add or remove Series', 'series' ),
        'choose_from_most_used' => _x( 'Choose from most used Series', 'series' ),
        'menu_name' => _x( 'Series', 'series' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => false,
        'hierarchical' => false,

        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'series', array('post'), $args );
}

function tomjn_posts_rewrite_rule() {
	add_rewrite_rule('articles/page/([0-9]{1,})/?','index.php?paged=$matches[1]&toms_custom_posts=true','top');
	add_rewrite_rule('articles/?','index.php?toms_custom_posts=true','top');
}
add_action('init', 'tomjn_posts_rewrite_rule', 10, 0);

function tomjn_template_redirect_intercept () {
	global $wp_query;
	if ( $wp_query->get( 'toms_custom_posts' ) ) {
		$wp_query->is_home = false;
		$wp_query->is_archive = true;
		$wp_query->show_posts = true;
	}
}
add_action( 'template_redirect', 'tomjn_template_redirect_intercept' );

function _tomjn_setup_posts_page( $query, \WP_Query $q ) {
	if ( $q->is_main_query() && $q->get( 'toms_custom_posts' ) ) {
		$q->is_home = false;
		$q->is_archive = true;
		$q->show_posts = true;
	}
	return $query;
}
add_filter( 'posts_request', '_tomjn_setup_posts_page', 1, 2 );

function tomjn_rewrite_query_vars( $vars ) {
	$vars[] = 'toms_custom_posts';
	return $vars;
}
add_filter( 'query_vars', 'tomjn_rewrite_query_vars' );    
