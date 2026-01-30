<?php
/**
 * Reusable Hero Banner
 */

$args = wp_parse_args($args ?? [], [
  'title'      => get_the_title(),
  'subtitle'   => '',
  'paragraph'  => '',
  'image'      => '',        // optional override
  'height'     => '30rem',
]);

$title     = $args['title'];
$subtitle  = $args['subtitle'];
$paragraph = $args['paragraph'];
$height    = $args['height'];

// 1) If image passed in args, use it
$image = $args['image'];

// 2) Otherwise fall back to Featured Image for the current page/post
if (empty($image)) {
  $image = get_the_post_thumbnail_url(get_queried_object_id(), 'full');
}

// 3) Optional final fallback (so it never looks blank)
if (empty($image)) {
  $image = get_template_directory_uri() . '/assets/banners/default.webp';
}

// IMPORTANT: wrap URL in quotes for reliability
$style = 'style="--hero-bg:url(\'' . esc_url($image) . '\'); --hero-h:' . esc_attr($height) . ';"';
?>

<section class="al-hero" <?php echo $style; ?> aria-label="Page banner">
  <div class="al-hero__inner">
    <h1 class="al-hero__title"><?php echo esc_html($title); ?></h1>
    <div class="al-hero__divider" aria-hidden="true"></div>

    <?php if (!empty($subtitle)) : ?>
      <h2 class="al-hero__subtitle"><?php echo esc_html($subtitle); ?></h2>
    <?php endif; ?>

    <?php if (!empty($paragraph)) : ?>
      <p class="al-hero__text"><?php echo esc_html($paragraph); ?></p>
    <?php endif; ?>
  </div>
</section>
