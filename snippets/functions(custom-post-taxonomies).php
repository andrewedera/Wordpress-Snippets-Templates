<?php
function custom_post_types() {

	/**
	 * Post Type: Resort Cities.
	 */

	$labels = array(
		"name" => __( "Resort Cities", "" ),
		"singular_name" => __( "Resort City", "" ),
	);

	$args = array(
		"label" => __( "Resort Cities", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "resorts", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "resort_city", $args );
}
add_action( 'init', 'custom_post_types' );

function custom_taxonomies() {

	/**
	 * Taxonomy: Resort Countries.
	 */

	$labels = array(
		"name" => __( "Resort Countries", "" ),
		"singular_name" => __( "Resort Country", "" ),
	);

	$args = array(
		"label" => __( "Resort Countries", "" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => false,
		"label" => "Resort Countries",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'resort_countries', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "resort_countries", array( "resort_city" ), $args );
}
add_action( 'init', 'custom_taxonomies' );
?>
