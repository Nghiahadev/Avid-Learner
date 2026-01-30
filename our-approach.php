<?php
/**
 * Our Approach section (template part)
 * Usage: get_template_part('template-parts/our-approach');
 */

$theme = get_template_directory_uri();

// Update these to match where you store assets in your theme:
$icon_path = $theme . '/assets/images';
$img_path  = $theme . '/assets/images';

$cards = [
  [
    'icon'  => $icon_path . '/icon-our-mission.svg',
    'title' => 'our mission',
    'text'  => 'Empowering learners with practical paths to grow skills and build real projects.',
    'image' => $img_path . '/our-mission-img.jpg',
    'delay' => '0s',
  ],
  [
    'icon'  => $icon_path . '/icon-our-vision.svg',
    'title' => 'our vision',
    'text'  => 'A community where learning is clear, consistent, and connected to real outcomes.',
    'image' => $img_path . '/our-vision-img.jpg',
    'delay' => '0.2s',
  ],
  [
    'icon'  => $icon_path . '/icon-our-value.svg',
    'title' => 'our value',
    'text'  => 'Simplicity, momentum, and support—so you can learn smarter and ship faster.',
    'image' => $img_path . '/our-value-img.jpg',
    'delay' => '0.4s',
  ],
];
?>

<section class="our-approach" aria-label="Our approach">
  <div class="container">

    <div class="row section-row align-items-center">
      <div class="col-lg-6">
        <div class="section-title">
          <h3 class="wow fadeInUp">our approach</h3>
          <h2 class="wow fadeInUp" data-wow-delay="0.2s">
            Customized strategies for <span>learning success</span>
          </h2>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="section-btn wow fadeInUp" data-wow-delay="0.2s">
          <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn-default">
            Contact now
          </a>
        </div>
      </div>
    </div>

    <div class="row">
      <?php foreach ($cards as $card) : ?>
        <div class="col-lg-4 col-md-6">
          <div class="mission-vission-item wow fadeInUp" data-wow-delay="<?php echo esc_attr($card['delay']); ?>">

            <div class="mission-vission-header">
              <div class="icon-box">
                <img src="<?php echo esc_url($card['icon']); ?>" alt="<?php echo esc_attr($card['title']); ?> icon">
              </div>

              <div class="mission-vission-content">
                <h3><?php echo esc_html($card['title']); ?></h3>
                <p><?php echo esc_html($card['text']); ?></p>
              </div>
            </div>

            <div class="mission-vission-image">
              <figure class="image-anime">
                <img src="<?php echo esc_url($card['image']); ?>" alt="<?php echo esc_attr($card['title']); ?> image">
              </figure>
            </div>

          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
