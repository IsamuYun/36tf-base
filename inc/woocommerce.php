<?php
/**
 * WooCommerce 适配。
 *
 * 重要：这里刻意不提供 single-product.html / archive-product.html。
 *
 * 原因是 WooCommerce 自带的区块模板本身就会引用
 * <!-- wp:template-part {"slug":"header"} -->，也就是说它会自动套用本主题的
 * 页头页脚和 theme.json 令牌，开箱即用且样式一致。
 *
 * 正确的定制流程是：
 *   1. 站点编辑器 → 模板 → 找到 Product Catalog / Single Product 改到满意
 *   2. 用 Create Block Theme 插件「导出」，把生成的 templates/*.html 放回主题
 *   3. Git 提交
 * 这样定制才是文件化、可版本控制、可随主题迁移的。
 *
 * @package TFBase
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 主题级 Woo 支持。
 */
function tf_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'tf_woocommerce_setup' );

/**
 * 只在需要的页面加载 Woo 的前端资源。
 *
 * 默认 WooCommerce 会在全站每一页加载 woocommerce.css / cart-fragments，
 * 对一个只有 Products 一个分支用到电商的官网来说是纯浪费。
 */
function tf_dequeue_woo_assets() {
	if ( ! class_exists( 'WooCommerce' ) ) {
        return;
    }
	if (
        ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) ||
        ( function_exists( 'is_cart' ) && is_cart() ) ||
        ( function_exists( 'is_checkout' ) && is_checkout() ) ||
        ( function_exists( 'is_account_page' ) && is_account_page() )
    ) {
        return;
    }

	wp_dequeue_style( 'woocommerce-general' );
	wp_dequeue_style( 'woocommerce-layout' );
	wp_dequeue_style( 'woocommerce-smallscreen' );
	wp_dequeue_script( 'wc-cart-fragments' );
}
add_action( 'wp_enqueue_scripts', 'tf_dequeue_woo_assets', 99 );

/**
 * 商品卡片图片尺寸与站内 Gallery 卡片保持一致的比例。
 */
function tf_woo_image_sizes() {
	update_option( 'woocommerce_thumbnail_cropping', 'custom' );
	update_option( 'woocommerce_thumbnail_cropping_custom_width', 3 );
	update_option( 'woocommerce_thumbnail_cropping_custom_height', 2 );
}
add_action( 'after_switch_theme', 'tf_woo_image_sizes' );
