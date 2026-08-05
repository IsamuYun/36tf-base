<?php
/**
 * Title: 内容区 · Who We Are 毛玻璃
 * Slug: tf-base/section-who-we-are
 * Categories: tf-section
 * Block Types: core/post-content
 * Template Types: front-page
 * Viewport Width: 1440
 * Description: 整幅背景照（Irvine 厂区）+ 一块半透明毛玻璃卡片，卡片内是白字大标题 WHO WE ARE 与公司自介。
 *
 * @package TFBase
 */

?>
<!-- wp:cover {"url":"<?php echo esc_url( get_theme_file_uri( 'assets/images/who-we-are/irvine.webp' ) ); ?>","dimRatio":40,"overlayColor":"contrast","isUserOverlayColor":true,"minHeight":620,"align":"full","className":"whoweare","layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull whoweare" style="min-height:620px"><span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-40 has-background-dim"></span><img class="wp-block-cover__image-background" alt="<?php echo esc_attr__( '公司位于加州尔湾的厂区外景', '36tf-base' ); ?>" src="<?php echo esc_url( get_theme_file_uri( 'assets/images/who-we-are/irvine.webp' ) ); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"className":"whoweare-glass","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group whoweare-glass"><!-- wp:heading {"level":2,"textColor":"base","fontSize":"xxl"} -->
<h2 class="wp-block-heading has-base-color has-text-color has-xxl-font-size"><?php echo esc_html__( 'WHO WE ARE', '36tf-base' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-lead","textColor":"base"} -->
<p class="is-style-lead has-base-color has-text-color"><?php echo esc_html__( '我们是一家扎根加州尔湾的阻燃材料公司，从面料织造、涂层后整理到成品供应，一条链自己走完。', '36tf-base' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"base"} -->
<p class="has-base-color has-text-color"><?php echo esc_html__( '十余年来，我们为建筑、交通、影视舞台与工业防护客户提供符合 ASTM E84、NFPA 701 等标准的阻燃材料，所有批次随货附第三方检测报告，可直接用于报审验收。常备规格现货 48 小时内出货，定制克重、幅宽与颜色同样接单——小批量也一样。', '36tf-base' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->
