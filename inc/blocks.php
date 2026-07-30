<?php
/**
 * 自定义区块样式（block styles）。
 *
 * 这些是给编辑用的「样式开关」，比让客户自己调颜色/边距可控得多。
 * 对应的 CSS 在 assets/css/theme.css。
 *
 * @package TF36Base
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 注册区块样式变体。
 */
function tf36_register_block_styles() {
	$styles = array(
		array(
			'block' => 'core/group',
			'name'  => 'card',
			'label' => __( '卡片', '36tf-base' ),
		),
		array(
			'block' => 'core/group',
			'name'  => 'bordered',
			'label' => __( '描边框', '36tf-base' ),
		),
		array(
			'block' => 'core/heading',
			'name'  => 'eyebrow',
			'label' => __( '标签行（等宽大写）', '36tf-base' ),
		),
		array(
			'block' => 'core/paragraph',
			'name'  => 'lead',
			'label' => __( '导语（加大）', '36tf-base' ),
		),
		array(
			'block' => 'core/paragraph',
			'name'  => 'spec',
			'label' => __( '规格戳（等宽小字）', '36tf-base' ),
		),
		array(
			'block' => 'core/list',
			'name'  => 'checks',
			'label' => __( '勾选清单', '36tf-base' ),
		),
		array(
			'block' => 'core/image',
			'name'  => 'framed',
			'label' => __( '带框', '36tf-base' ),
		),
	);

	foreach ( $styles as $style ) {
		register_block_style( $style['block'], array(
			'name'  => $style['name'],
			'label' => $style['label'],
		) );
	}
}
add_action( 'init', 'tf36_register_block_styles' );

/**
 * 去掉一批用不上的核心区块，收窄编辑器选择面。
 *
 * 客户站上这一步价值很高：可选项越少，页面越不容易被改花。
 * 需要放开时把对应项从数组里删掉即可。
 */
function tf36_allowed_block_types( $allowed, $context ) {
	// 只在文章/页面编辑器里收窄；站点编辑器（无 post 上下文）与 CPT 不受影响。
	if ( empty( $context->post ) || ! in_array( $context->post->post_type, array( 'page', 'post' ), true ) ) {
		return $allowed;
	}

	$disallowed = array(
		'core/verse',
		'core/preformatted',
		'core/pullquote',
		'core/nextpage',
		'core/more',
		'core/tag-cloud',
		'core/rss',
		'core/calendar',
		'core/archives',
		'core/latest-comments',
	);

	if ( ! is_array( $allowed ) ) {
		$registered = WP_Block_Type_Registry::get_instance()->get_all_registered();
		$allowed    = array_keys( $registered );
	}

	return array_values( array_diff( $allowed, $disallowed ) );
}
add_filter( 'allowed_block_types_all', 'tf36_allowed_block_types', 10, 2 );
