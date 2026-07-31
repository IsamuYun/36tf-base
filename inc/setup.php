<?php
/**
 * 主题支持与资源加载。
 *
 * @package TFBase
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 主题支持声明。block theme 大部分能力默认开启，这里只补必须显式声明的。
 */
function tf_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );

	// 编辑器里也加载 theme.css，保证所见即所得。
	add_editor_style( 'assets/css/theme.css' );

	load_theme_textdomain( 'tf-base', TF_DIR . '/languages' );

	// Gallery 卡片用的 3:2 裁切尺寸。
	add_image_size( 'tf-card', 720, 480, true );
}
add_action( 'after_setup_theme', 'tf_setup' );

/**
 * 前端样式。只有一个文件，不依赖任何 CSS 框架。
 */
function tf_enqueue_assets() {
	$path = TF_DIR . '/assets/css/theme.css';

	wp_enqueue_style(
		'tf-theme',
		TF_URI . '/assets/css/theme.css',
		array(),
		file_exists( $path ) ? (string) filemtime( $path ) : TF_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'tf_enqueue_assets' );

/**
 * 移除核心 duotone 内联 SVG（theme.json 已关闭 duotone），每页省 1–2KB。
 */
function tf_remove_global_styles_svg() {
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
	remove_action( 'in_admin_header', 'wp_global_styles_render_svg_filters' );
}
add_action( 'init', 'tf_remove_global_styles_svg' );

/**
 * 关掉 emoji 脚本。B2B 官网用不上。
 */
function tf_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );

	add_filter(
		'tiny_mce_plugins',
		function ( $plugins ) {
			return is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
		}
	);
}
add_action( 'init', 'tf_disable_emojis' );
