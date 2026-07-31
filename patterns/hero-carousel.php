<?php
/**
 * Title: 首页 · Hero Carousel
 * Slug: tf-base/hero-carousel
 * Categories: banner, featured
 * Viewport Width: 1920 
 */
?>
<!-- wp:group {"align":"full", "className": "tf-carousel", "layout":{"type":"default"}} -->
 <div class="wp-block-group alignfull tf-carousel">

  <!-- wp:group {"className":"tf-carousel__track","layout":{"type":"default"}} -->
  <div class="wp-block-group tf-carousel__track">

    <!-- wp:image {"sizeSlug":"tf-hero-desktop","linkDestination":"none","className":"tf-carousel__slide"} -->
    <figure class="wp-block-image size-tf-hero-desktop tf-carousel__slide">
      <img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/hero-01.jpg' ) ); ?>" alt="" fetchpriority="high" decoding="async" />
    </figure>
    <!-- /wp:image -->

    <!-- wp:image {"sizeSlug":"tf-hero-desktop","linkDestination":"none","className":"tf-carousel__slide"} -->
    <figure class="wp-block-image size-tf-hero-desktop tf-carousel__slide">
      <img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/hero-02.jpg' ) ); ?>" alt="" loading="lazy" decoding="async" />
    </figure>
    <!-- /wp:image -->

  </div>
  <!-- /wp:group -->

</div>
<!-- /wp:group -->