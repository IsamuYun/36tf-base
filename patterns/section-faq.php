<?php
/**
 * Title: 内容区 · FAQ 折叠
 * Slug: tf-base/section-faq
 * Categories: tf-section
 * Block Types: core/post-content
 * Post Types: page
 * Description: 用核心 Details 区块做的问答折叠，无需插件。别忘了在 SEO 插件里为本页开启 FAQPage 结构化数据。
 *
 * @package TFBase
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"}}}} -->
<h2 class="wp-block-heading" style="margin-bottom:var(--wp--preset--spacing--40)">常见问题</h2>
<!-- /wp:heading -->

<!-- wp:details {"summary":"你们的材料需要什么认证文件？"} -->
<details class="wp-block-details"><summary>你们的材料需要什么认证文件？</summary><!-- wp:paragraph -->
<p>写清楚具体文件名和用途，别写「齐全」。买家是拿去报审的。</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details {"summary":"最小起订量是多少？"} -->
<details class="wp-block-details"><summary>最小起订量是多少？</summary><!-- wp:paragraph -->
<p>给一个具体数字。含糊的回答只会让对方去问竞品。</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details {"summary":"能提供样品吗？"} -->
<details class="wp-block-details"><summary>能提供样品吗？</summary><!-- wp:paragraph -->
<p>说明样品规格、是否收费、多久寄到。</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details --></div>
<!-- /wp:group -->
