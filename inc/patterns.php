<?php
/**
 * 区块模式（pattern）分类注册。
 *
 * patterns/ 目录下的 PHP 文件会被 WordPress 自动扫描注册，
 * 这里只需要把它们要用的分类先建出来。
 *
 * @package TF36Base
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 注册模式分类。
 */
function tf36_register_pattern_categories() {
	$categories = array(
		'tf36-hero'    => __( '36TF · 首屏', '36tf-base' ),
		'tf36-section' => __( '36TF · 内容区块', '36tf-base' ),
		'tf36-page'    => __( '36TF · 整页模板', '36tf-base' ),
	);

	foreach ( $categories as $slug => $label ) {
		register_block_pattern_category( $slug, array( 'label' => $label ) );
	}
}
add_action( 'init', 'tf36_register_pattern_categories' );

/**
 * 移除 WordPress.org 远程模式目录。
 *
 * 客户站上这些模式只会造成困惑（样式跟本站不一致），
 * 而且每次打开插入器都会发一次远程请求。
 */
add_filter( 'should_load_remote_block_patterns', '__return_false' );
