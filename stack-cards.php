<?php
/**
 * Stacking Cards Section (5 cards)
 * Usage: get_template_part('template-parts/stack-cards');
 */

$eyebrow  = get_theme_mod('al_stack_eyebrow', 'Services');
$title    = get_theme_mod('al_stack_title', 'Development programs built for leaders and teams');
$subtitle = get_theme_mod('al_stack_subtitle', 'Scroll to explore five ways we help strengthen leadership, alignment, and performance—without adding complexity.');

$btn1_text = get_theme_mod('al_stack_btn1_text', 'Book a consult');
$btn1_url  = get_theme_mod('al_stack_btn1_url', '/contact');
$btn2_text = get_theme_mod('al_stack_btn2_text', 'View services');
$btn2_url  = get_theme_mod('al_stack_btn2_url', '/services');

// Make URLs work for relative paths like /contact
$btn1_href = (strpos($btn1_url, 'http') === 0) ? $btn1_url : home_url($btn1_url);
$btn2_href = (strpos($btn2_url, 'http') === 0) ? $btn2_url : home_url($btn2_url);

$cards = [];
for ($i = 1; $i <= 5; $i++) {
  $cards[] = [
    'label' => get_theme_mod("al_stack_card{$i}_label", sprintf('%02d. SERVICE', $i)),
    'title' => get_theme_mod("al_stack_card{$i}_title", 'Card Title'),
    'text'  => get_theme_mod("al_stack_card{$i}_text", 'Card description.'),
    'img'   => get_theme_mod("al_stack_card{$i}_image", ''),
  ];
}
?>

<section class="al-stack" aria-label="Consulting services">
  <div class="al-stack__head">
    <h3 class="al-stack__eyebrow"><?php echo esc_html($eyebrow); ?></h3>
    <h2 class="al-stack__title">
      <?php echo esc_html($title); ?>
      <span class="al-stack__grad"><?php /* gradient highlight via CSS */ ?></span>
    </h2>
    <p class="al-stack__sub"><?php echo esc_html($subtitle); ?></p>
  </div>

  <div class="stack-area">
    <?php foreach ($cards as $index => $c) : ?>
      <article class="card al-stack-card" data-index="<?php echo esc_attr($index); ?>">
        <div class="card-content">
          <span class="card-num"><?php echo esc_html($c['label']); ?></span>
          <h2><?php echo esc_html($c['title']); ?></h2>
          <p><?php echo esc_html($c['text']); ?></p>

            <div class="al-stack-actions">
            <a href="<?php echo esc_url($btn1_href); ?>" class="btn3 btn3--hero">
                <span class="text"><?php echo esc_html($btn1_text); ?></span>
                <svg class="arr-1" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M5 12h14M13 5l7 7-7 7"></path>
                </svg>
                <svg class="arr-2" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M5 12h14M13 5l7 7-7 7"></path>
                </svg>
                <span class="circle" aria-hidden="true"></span>
            </a>
            </div>

        </div>

        <div class="card-img" aria-hidden="true">
          <?php if (!empty($c['img'])) : ?>
            <img src="<?php echo esc_url($c['img']); ?>" alt="" loading="lazy" />
          <?php else : ?>
            <div class="al-stack-img-placeholder">
              <span>Upload an image in Appearance → Customize</span>
            </div>
          <?php endif; ?>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>
