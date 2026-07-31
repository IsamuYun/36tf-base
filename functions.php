<?php
/**
 * 36TF Base — 主题引导文件
 *
 * @package TF36Base
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TF36_VERSION', '0.1.0' );
define( 'TF36_DIR', get_stylesheet_directory() );
define( 'TF36_URI', get_stylesheet_directory_uri() );

require_once TF36_DIR . '/inc/setup.php';
require_once TF36_DIR . '/inc/fonts.php';
require_once TF36_DIR . '/inc/post-types.php';
require_once TF36_DIR . '/inc/patterns.php';
require_once TF36_DIR . '/inc/blocks.php';

if ( class_exists( 'WooCommerce' ) ) {
	require_once TF36_DIR . '/inc/woocommerce.php';
}

add_action( 'after_setup_theme', function() {
	add_image_size( 'tf-hero-desktop', 1920, 650, true );	// 桌面版
	add_image_size( 'tf-hero-mobile', 900, 900, true );	// 手机版使用 1:1 或 4:3 	
} );

add_action( 'wp_enqueue_scripts', function () {
    // 只在页面确实用到该 pattern 时加载
    if ( ! has_block( 'core/group' ) ) { return; }
    wp_enqueue_style( 'tf-carousel', get_theme_file_uri( 'assets/css/carousel.css' ), [], '1.0.0' );
    wp_enqueue_script( 'tf-carousel', get_theme_file_uri( 'assets/js/carousel.js' ), [], '1.0.0', true );
} );

// 让编辑器里也能看到布局
add_action( 'after_setup_theme', function () {
    add_editor_style( 'assets/css/carousel.css' );
} );