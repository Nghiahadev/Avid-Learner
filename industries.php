<?php
/**
 * Industries Section
 * Usage: get_template_part('template-parts/industries');
 */

$industries = [
  ['icon' => 'fa-solid fa-laptop',        'title' => 'Technology'],
  ['icon' => 'fa-solid fa-building-columns','title' => 'Finance'],
  ['icon' => 'fa-solid fa-heart-pulse',     'title' => 'Healthcare'],
  ['icon' => 'fa-solid fa-graduation-cap',  'title' => 'Education'],
  ['icon' => 'fa-solid fa-cart-shopping',   'title' => 'Retail'],
  ['icon' => 'fa-solid fa-plane-departure', 'title' => 'Travel'],
  ['icon' => 'fa-solid fa-gear',            'title' => 'Manufacturing'],
  ['icon' => 'fa-solid fa-seedling',        'title' => 'Energy'],
];
?>

<section id="industries" class="al-industries" aria-label="Industries we serve">
  <div class="al-industries__inner">

    <header class="al-industries__header">
      <h2 class="al-industries__title">
        <span class="al-industries__title-ic" aria-hidden="true">
          <i class="fa-solid fa-industry"></i>
        </span>
        Industries We Serve
      </h2>

      <p class="al-industries__subtitle">
        Our consultants bring specialized expertise across a wide range of industries, helping organizations achieve
        their strategic objectives.
      </p>
    </header>

    <div class="al-industries__grid">
      <?php foreach ($industries as $item) : ?>
        <article class="al-industry-card">
          <div class="al-industry-icon" aria-hidden="true">
            <i class="<?php echo esc_attr($item['icon']); ?>"></i>
          </div>
          <h3><?php echo esc_html($item['title']); ?></h3>
        </article>
      <?php endforeach; ?>
    </div>

  </div>
</section>
