<?php
/**
 * Title: 内容区 · What We Do 图卡三栏
 * Slug: tf-base/section-what-we-do
 * Categories: tf-section
 * Block Types: core/post-content
 * Template Types: front-page
 * Viewport Width: 1440
 * Description: 居中大标题 + 三张整卡可点的图卡（图在上、文案在下）。悬停时图片缓慢推近，参考 libafabrics.com 的 What We Do 版式。
 *
 * @package TFBase
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--50)"><?php echo esc_html__( '我们做什么', '36tf-base' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|30","left":"var:preset|spacing|30"}}}} -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"wwd-card","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group wwd-card"><!-- wp:image {"className":"wwd-card__media"} -->
<figure class="wp-block-image wwd-card__media"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/what-we-do/fire-retardant-01.jpg' ) ); ?>" alt="<?php echo esc_attr__( '蓝色阻燃涂层面料，表面水珠不渗透', '36tf-base' ); ?>" /></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"wwd-card__body","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group wwd-card__body"><!-- wp:heading {"level":3,"fontSize":"lg"} -->
<h3 class="wp-block-heading has-lg-font-size"><a class="wwd-card__link" href="/products/"><?php echo esc_html__( '阻燃面料', '36tf-base' ); ?></a></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"sm","textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color has-sm-font-size"><?php echo esc_html__( '二十余种常备规格，克重、幅宽、颜色可选，涂层与防水处理按需增配，现货 48 小时内出货。', '36tf-base' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"wwd-card","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group wwd-card"><!-- wp:image {"className":"wwd-card__media"} -->
<figure class="wp-block-image wwd-card__media"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/what-we-do/fire-retardant-02.jpg' ) ); ?>" alt="<?php echo esc_attr__( '喷枪火焰直接灼烧阻燃面料的燃烧测试', '36tf-base' ); ?>" /></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"wwd-card__body","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group wwd-card__body"><!-- wp:heading {"level":3,"fontSize":"lg"} -->
<h3 class="wp-block-heading has-lg-font-size"><a class="wwd-card__link" href="/resources/"><?php echo esc_html__( '检测与认证', '36tf-base' ); ?></a></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"sm","textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color has-sm-font-size"><?php echo esc_html__( 'ASTM E84、EN ISO 11612、GB 8965 等标准的第三方检测报告随货提供，可直接用于报审。', '36tf-base' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"wwd-card","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group wwd-card"><!-- wp:image {"className":"wwd-card__media"} -->
<figure class="wp-block-image wwd-card__media"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/what-we-do/fire-retardant-03.webp' ) ); ?>" alt="<?php echo esc_attr__( '车间内的染整定型生产线正在加工橙色阻燃布', '36tf-base' ); ?>" /></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"wwd-card__body","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group wwd-card__body"><!-- wp:heading {"level":3,"fontSize":"lg"} -->
<h3 class="wp-block-heading has-lg-font-size"><a class="wwd-card__link" href="/services/"><?php echo esc_html__( '定制加工', '36tf-base' ); ?></a></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"sm","textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color has-sm-font-size"><?php echo esc_html__( '自有染整与后整理产线，按色卡打样、按需克重与幅宽排产，小批量订单同样接单。', '36tf-base' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
