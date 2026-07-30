<?php
/**
 * 自定义内容类型：Gallery(tf_project) 与 Resources(tf_resource)。
 *
 * 为什么不用普通 Page？
 * - Gallery 要按行业/应用场景筛选、要归档页、要复用卡片 → 必须是 CPT + taxonomy。
 * - Resources 要按类型（指南 / 白皮书 / 检测报告 / 视频）分组并长期增长 → 同理。
 * 其余 8 个导航项用普通 Page 或 WooCommerce 即可。
 *
 * @package TF36Base
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 注册 CPT 与 taxonomy。
 */
function tf36_register_post_types() {

	/* ---------- Gallery / 案例 ---------- */
	register_post_type(
		'tf_project',
		array(
			'labels'        => array(
				'name'          => __( 'Gallery', '36tf-base' ),
				'singular_name' => __( 'Project', '36tf-base' ),
				'add_new_item'  => __( '新增案例', '36tf-base' ),
				'edit_item'     => __( '编辑案例', '36tf-base' ),
				'menu_name'     => __( 'Gallery', '36tf-base' ),
			),
			'public'        => true,
			'has_archive'   => 'gallery',
			'rewrite'       => array( 'slug' => 'gallery', 'with_front' => false ),
			'menu_icon'     => 'dashicons-format-gallery',
			'menu_position' => 21,
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes' ),
			'show_in_rest'  => true,
			'template'      => array(
				array( 'core/paragraph', array( 'placeholder' => '一句话说明这个案例解决了什么问题。' ) ),
				array( 'core/gallery' ),
			),
		)
	);

	register_taxonomy(
		'tf_project_type',
		array( 'tf_project' ),
		array(
			'labels'            => array(
				'name'          => __( '案例分类', '36tf-base' ),
				'singular_name' => __( '案例分类', '36tf-base' ),
			),
			'public'            => true,
			'hierarchical'      => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'gallery-type', 'with_front' => false ),
		)
	);

	/* ---------- Resources / 资源库 ---------- */
	register_post_type(
		'tf_resource',
		array(
			'labels'        => array(
				'name'          => __( 'Resources', '36tf-base' ),
				'singular_name' => __( 'Resource', '36tf-base' ),
				'add_new_item'  => __( '新增资源', '36tf-base' ),
				'edit_item'     => __( '编辑资源', '36tf-base' ),
				'menu_name'     => __( 'Resources', '36tf-base' ),
			),
			'public'        => true,
			'has_archive'   => 'resources',
			'rewrite'       => array( 'slug' => 'resources', 'with_front' => false ),
			'menu_icon'     => 'dashicons-media-document',
			'menu_position' => 22,
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields' ),
			'show_in_rest'  => true,
		)
	);

	register_taxonomy(
		'tf_resource_type',
		array( 'tf_resource' ),
		array(
			'labels'            => array(
				'name'          => __( '资源类型', '36tf-base' ),
				'singular_name' => __( '资源类型', '36tf-base' ),
			),
			'public'            => true,
			'hierarchical'      => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'resource-type', 'with_front' => false ),
		)
	);
}
add_action( 'init', 'tf36_register_post_types' );

/**
 * 注册 post meta。
 *
 * 声明成 show_in_rest 之后，就能在区块编辑器里用 Block Bindings 把它绑到
 * 段落 / 按钮 上（无需 ACF）：
 *   <!-- wp:button {"metadata":{"bindings":{"url":{"source":"core/post-meta","args":{"key":"tf_resource_file"}}}}} -->
 */
function tf36_register_meta() {
	register_post_meta(
		'tf_resource',
		'tf_resource_file',
		array(
			'type'              => 'string',
			'description'       => __( '可下载文件的 URL（PDF / 检测报告等）', '36tf-base' ),
			'single'            => true,
			'show_in_rest'      => true,
			'sanitize_callback' => 'esc_url_raw',
			'auth_callback'     => function () {
				return current_user_can( 'edit_posts' );
			},
		)
	);

	register_post_meta(
		'tf_project',
		'tf_project_location',
		array(
			'type'              => 'string',
			'description'       => __( '项目地点 / 客户所在地', '36tf-base' ),
			'single'            => true,
			'show_in_rest'      => true,
			'sanitize_callback' => 'sanitize_text_field',
			'auth_callback'     => function () {
				return current_user_can( 'edit_posts' );
			},
		)
	);
}
add_action( 'init', 'tf36_register_meta' );

/**
 * 主题激活时刷新一次固定链接，避免 /gallery/ 和 /resources/ 404。
 */
function tf36_flush_rewrites() {
	tf36_register_post_types();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'tf36_flush_rewrites' );
