<?php
/*
 Plugin Name: TomJN Projects
 Plugin URI: https://tomjn.com
 Description: Define post types etc
 Version: 1.0
 Author: Tom J Nowell
 Author URI: https://tomjn.com
*/


add_action( 'init', 'register_cpt_project' );

function register_cpt_project() {

	$labels = array(
		'name' => _x( 'Projects', 'project' ),
		'singular_name' => _x( 'Project', 'project' ),
		'add_new' => _x( 'Add New', 'project' ),
		'add_new_item' => _x( 'Add New Project', 'project' ),
		'edit_item' => _x( 'Edit Project', 'project' ),
		'new_item' => _x( 'New Project', 'project' ),
		'view_item' => _x( 'View Project', 'project' ),
		'search_items' => _x( 'Search Projects', 'project' ),
		'not_found' => _x( 'No projects found', 'project' ),
		'not_found_in_trash' => _x( 'No projects found in Trash', 'project' ),
		'parent_item_colon' => _x( 'Parent Project:', 'project' ),
		'menu_name' => _x( 'Projects', 'project' ),
	);

	$args = array(
		'labels' => $labels,
		'hierarchical' => false,
		'description' => 'Things I\'ve worked on or towards',
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),

		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 20,

		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => array(
			'slug' => 'projects'
		),
		'capability_type' => 'post'
	);

	register_post_type( 'project', $args );
}

function project_cpt_archive_order( $vars ) {
	if ( !is_admin() && isset( $vars['post_type'] ) ) {
		if ( $vars['post_type'] == 'project' ) {
			$vars['orderby'] = 'title';
			$vars['order'] = 'ASC';
		}
	}

	return $vars;
}
add_filter( 'request', 'project_cpt_archive_order' );

add_action( 'init', 'register_taxonomy_languages' );

function register_taxonomy_languages() {

    $labels = array( 
        'name' => _x( 'Technologies', 'technology' ),
        'singular_name' => _x( 'Technology', 'technology' ),
        'search_items' => _x( 'Search Technologies', 'technology' ),
        'popular_items' => _x( 'Popular Technologies', 'technology' ),
        'all_items' => _x( 'All Technologies', 'technology' ),
        'parent_item' => _x( 'Parent Technology', 'technology' ),
        'parent_item_colon' => _x( 'Parent Technology:', 'technology' ),
        'edit_item' => _x( 'Edit Technology', 'technology' ),
        'update_item' => _x( 'Update Technology', 'technology' ),
        'add_new_item' => _x( 'Add New Technology', 'technology' ),
        'new_item_name' => _x( 'New Technology', 'technology' ),
        'separate_items_with_commas' => _x( 'Separate technologies with commas', 'technology' ),
        'add_or_remove_items' => _x( 'Add or remove Technologies', 'technology' ),
        'choose_from_most_used' => _x( 'Choose from most used Technologies', 'technology' ),
        'menu_name' => _x( 'Technology', 'technology' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'show_admin_column' => true,
        'hierarchical' => false,

        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'technology', array('project'), $args );
    
    $talk_tag_labels = array( 
        'name' => _x( 'Talk Tags', 'technology' ),
        'singular_name' => _x( 'Talk Tag', 'technology' ),
        'search_items' => _x( 'Search Talk Tags', 'technology' ),
        'popular_items' => _x( 'Popular Talk Tags', 'technology' ),
        'all_items' => _x( 'All Talk Tags', 'technology' ),
        'parent_item' => _x( 'Parent Talk Tag', 'technology' ),
        'parent_item_colon' => _x( 'Parent Talk Tag:', 'technology' ),
        'edit_item' => _x( 'Edit Talk Tag', 'technology' ),
        'update_item' => _x( 'Update Talk Tag', 'technology' ),
        'add_new_item' => _x( 'Add New Talk Tag', 'technology' ),
        'new_item_name' => _x( 'New Talk Tag', 'technology' ),
        'separate_items_with_commas' => _x( 'Separate talk tags with commas', 'technology' ),
        'add_or_remove_items' => _x( 'Add or remove Talk Tags', 'technology' ),
        'choose_from_most_used' => _x( 'Choose from most used Talk Tags', 'technology' ),
        'menu_name' => _x( 'Talk Tag', 'technology' ),
    );

    $args = array( 
        'labels' => $talk_tag_labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'show_admin_column' => true,
        'hierarchical' => false,

        'rewrite' => array(
		'slug' => 'talktags'
	),
        'query_var' => true,
	'show_in_rest' => true
    );

    register_taxonomy( 'tomjn_talk_tag', array('tomjn_talks'), $args );
}

add_action( 'init', 'register_cpt_talk' );

function register_cpt_talk() {

	$labels = array(
		'name' => _x( 'Talks', 'tomjn_talk' ),
		'singular_name' => _x( 'Talk', 'tomjn_talk' ),
		'add_new' => _x( 'Add New', 'tomjn_talk' ),
		'add_new_item' => _x( 'Add New Talk', 'tomjn_talk' ),
		'edit_item' => _x( 'Edit Talk', 'v' ),
		'new_item' => _x( 'New Talk', 'tomjn_talk' ),
		'view_item' => _x( 'View Talk', 'tomjn_talk' ),
		'search_items' => _x( 'Search Talks', 'v' ),
		'not_found' => _x( 'No talks found', 'v' ),
		'not_found_in_trash' => _x( 'No talks found in Trash', 'tomjn_talk' ),
		'parent_item_colon' => _x( 'Parent Talk:', 'tomjn_talk' ),
		'menu_name' => _x( 'Talks', 'tomjn_talk' ),
	);

	$args = array(
		'labels' => $labels,
		'hierarchical' => false,
		'description' => 'Talks I\'ve given at conferences and usergroups',
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),

		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 20,

		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => array(
			'slug' => 'talks'
		),
		'capability_type' => 'post',
		'show_in_rest' => true,
	);

	register_post_type( 'tomjn_talks', $args );
}
