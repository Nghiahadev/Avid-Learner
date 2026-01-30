<?php
/**
 * FAQ – Avid Learner
 * Template Part: template-parts/faq-learning.php
 */

$faqs = [
  [
    'q' => 'What is Avid Learner?',
    'a' => 'Avid Learner is a learning-first platform designed to help you study smarter, build real skills, and stay consistent—through curated resources, workshops, and a supportive community.',
  ],
  [
    'q' => 'Who is this for?',
    'a' => 'It’s for students, career-changers, and curious builders—anyone who wants a clear learning path, real projects, and guidance that turns study time into results.',
  ],
  [
    'q' => 'Do you offer workshops or live sessions?',
    'a' => 'Yes. We run workshops and guided sessions focused on practical topics. Some are free, and some are premium depending on the depth, resources, and support included.',
  ],
  [
    'q' => 'How do I stay updated?',
    'a' => 'Join the newsletter to get new lessons, workshop announcements, and community updates. You can unsubscribe anytime.',
  ],
];

$imgs = [
  "https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1600&q=80",
  "https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1600&q=80",
  "https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1600&q=80",
  "https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=1600&q=80",
];
?>

<section class="al-faq" aria-label="Frequently Asked Questions">
  <div class="al-faq__container">

    <header class="al-faq__header">
      <h2 class="al-faq__title">Frequently Asked Questions</h2>
      <p class="al-faq__subtitle">
        Quick answers about Avid Learner—what it is, who it’s for, and how to stay updated.
      </p>
    </header>

    <div class="faq">
      <div class="faq__details">
        <?php foreach ($faqs as $i => $item) : ?>
          <details class="faq__item" <?php echo $i === 0 ? 'open' : ''; ?>>
            <summary><?php echo esc_html($item['q']); ?></summary>
            <p><?php echo esc_html($item['a']); ?></p>
          </details>
        <?php endforeach; ?>
      </div>

      <div class="faq__images">
        <!-- default image is set inline so it shows even without JS -->
        <div
          class="faq__image"
          style="background-image:url('<?php echo esc_url($imgs[0]); ?>');"
          data-faq-imgs="<?php echo esc_attr(wp_json_encode($imgs)); ?>"
          aria-label="FAQ image"
        ></div>
      </div>
    </div>

  </div>
</section>
