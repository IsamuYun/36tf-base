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
