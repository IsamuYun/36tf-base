<?php
/**
 * Title: 页头 · Logo + 置顶导航
 * Slug: tf-base/header
 * Inserter: no
 * Description: 顶部信息条（地址 / 电话）+ 置顶主页头（左 Logo 右导航）。Logo 用主题内置的 assets/images/site-logo.png，通过 get_theme_file_uri() 解析，换主题目录名或从 GitHub zip 安装都不会失效。
 *
 * @package TFBase
 */
?>
<!-- wp:group {"tagName":"header","className":"site-header","backgroundColor":"base","layout":{"type":"constrained"}} -->
<header class="wp-block-group site-header has-base-background-color has-background">

	<!-- 顶部信息条（随页面滚走） -->
	<!-- wp:group {"align":"full","className":"top-bar","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull top-bar"><!-- wp:group {"align":"wide","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
	<div class="wp-block-group alignwide"><!-- wp:paragraph {"className":"top-bar__addr"} -->
	<p class="top-bar__addr">86 Cipresso, Irvine, CA 92618</p>
	<!-- /wp:paragraph -->

	<!-- wp:paragraph {"className":"phone-link"} -->
	<p class="phone-link"><a href="tel:+19499030756"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" style="vertical-align:-2px;margin-right:6px"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.6 21 3 13.4 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.2.2 2.4.6 3.6.1.3 0 .7-.2 1l-2.3 2.2z"/></svg>949-903-0756</a></p>
	<!-- /wp:paragraph --></div>
	<!-- /wp:group --></div>
	<!-- /wp:group -->

	<!-- 主页头：置顶 -->
	<!-- wp:group {"align":"full","className":"main-header","backgroundColor":"base","style":{"position":{"type":"sticky","top":"0px"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull main-header has-base-background-color has-background" style="position:sticky;top:0px"><!-- wp:group {"align":"wide","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"nowrap"}} -->
	<div class="wp-block-group alignwide"><!-- wp:image {"width":"128px","height":"128px","sizeSlug":"full","linkDestination":"custom","className":"site-logo-img"} -->
	<figure class="wp-block-image size-full is-resized site-logo-img"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/site-logo.png' ) ); ?>" alt="Fire Block" width="128" height="128"/></a></figure>
	<!-- /wp:image -->

	<!-- wp:navigation {"overlayMenu":"mobile","overlayBackgroundColor":"base","overlayTextColor":"contrast","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","justifyContent":"right","flexWrap":"wrap"}} /--></div>
	<!-- /wp:group --></div>
	<!-- /wp:group -->

</header>
<!-- /wp:group -->
