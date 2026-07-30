<?php
/**
 * 字体加载。
 *
 * 设计意图：@font-face 的注册全部交给 theme.json 的 fontFace 声明
 * （settings.typography.fontFamilies[].fontFace，src 用 file:./assets/fonts/*.woff2）。
 * 这样做的好处：
 *   - 字体随主题一起进 Git，GitHub 下载/上传即用，无需额外脚本或 CDN；
 *   - 字体自动出现在站点编辑器的「字体库」里，样式变体（styles/*.json）
 *     各自声明自己的 fontFace，切换品牌时字体也跟着切换；
 *   - 只有被实际渲染用到的字族才会真正下载，声明多套不会拖慢页面。
 *
 * 本文件只保留 theme.json 表达不了的一件事：给正文字体加 preload，改善 LCP。
 *
 * @package TF36Base
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 预加载默认品牌的正文字体（Manrope），让首屏文字更快就位。
 *
 * 仍保留文件存在性判断：万一交付时删掉了字体二进制，也不会输出一个 404 的 preload。
 */
function tf36_preload_body_font() {
	$file = 'assets/fonts/manrope.woff2';

	if ( ! file_exists( TF36_DIR . '/' . $file ) ) {
		return;
	}

	printf(
		'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
		esc_url( TF36_URI . '/' . $file )
	);
}
add_action( 'wp_head', 'tf36_preload_body_font', 2 );
