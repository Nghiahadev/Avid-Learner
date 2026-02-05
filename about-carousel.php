<?php
/**
 * About - Drag Carousel (Customizer images)
 * Usage: get_template_part('template-parts/about-carousel');
 */

$kicker = get_theme_mod('al_about_carousel_kicker', 'Our Story Gallery');
$title  = get_theme_mod('al_about_carousel_title', 'Moments that shaped our journey');
$sub    = get_theme_mod('al_about_carousel_subtitle', 'Drag, scroll, or swipe to explore highlights from our work, culture, and milestones.');

$items = [];
for ($i = 1; $i <= 7; $i++) {
  $img_id = (int) get_theme_mod("al_about_carousel_{$i}_image", 0);
  $img    = $img_id ? wp_get_attachment_image_url($img_id, 'large') : '';
  $label  = get_theme_mod("al_about_carousel_{$i}_title", "Slide {$i}");

  // fallback images if none set (optional)
  if (!$img) {
    $fallbacks = [
      1 => 'https://images.unsplash.com/photo-1595265677860-9a3168007dc0?auto=format&fit=crop&w=1200&q=70',
      2 => 'https://images.unsplash.com/photo-1594786118579-95ba90c801ec?auto=format&fit=crop&w=1200&q=70',
      3 => 'https://images.unsplash.com/photo-1509339022327-1e1e25360a41?auto=format&fit=crop&w=1200&q=70',
      4 => 'https://images.unsplash.com/photo-1525417071002-5ee4e6bb44f7?auto=format&fit=crop&w=1200&q=70',
      5 => 'https://images.unsplash.com/photo-1594072702031-f0e2a602dd2c?auto=format&fit=crop&w=1200&q=70',
      6 => 'https://images.unsplash.com/photo-1592989819277-a3aafa40c66a?auto=format&fit=crop&w=1200&q=70',
      7 => 'https://images.unsplash.com/photo-1548374797-d13fd5d2b2a8?auto=format&fit=crop&w=1200&q=70',
    ];
    $img = $fallbacks[$i] ?? '';
  }

  $items[] = [
    'img' => $img,
    'title' => $label,
  ];
}
?>

<section class="al-carousel-section" aria-label="About carousel">
  <div class="al-wrap">
    <header class="al-carousel-head">
      <span class="al-carousel-pill"><?php echo esc_html($kicker); ?></span>
      <h2 class="al-carousel-title"><?php echo esc_html($title); ?></h2>
      <p class="al-carousel-sub"><?php echo esc_html($sub); ?></p>
    </header>
  </div>

  <div class="al-carousel" data-al-carousel>
    <div class="al-carousel__wrap">
      <?php foreach ($items as $it): ?>
        <div class="al-carousel__item">
          <figure class="al-carousel__figure">
            <img src="<?php echo esc_url($it['img']); ?>" alt="<?php echo esc_attr($it['title']); ?>" loading="lazy">
          </figure>
          <h3 class="al-carousel__caption"><?php echo esc_html($it['title']); ?></h3>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="al-carousel__progress" aria-hidden="true">
      <div class="al-carousel__bar"></div>
    </div>
  </div>
</section>
