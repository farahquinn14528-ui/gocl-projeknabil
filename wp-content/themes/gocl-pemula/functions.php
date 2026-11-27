<?php
/**
 * Fungsi tema GOCL Pemula.
 *
 * @package gocl-pemula
 */

function gocl_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus( array( 'utama' => 'Menu Utama' ) );
}
add_action( 'after_setup_theme', 'gocl_setup' );

function gocl_assets() {
	$file = get_stylesheet_directory() . '/style.css';
	wp_enqueue_style( 'gocl-style', get_stylesheet_uri(), array(), filemtime( $file ) );
}
add_action( 'wp_enqueue_scripts', 'gocl_assets' );

function gocl_gallery_size( $atts ) {
	$atts['size'] = 'large';
	return $atts;
}
add_filter( 'shortcode_atts_gallery', 'gocl_gallery_size' );
