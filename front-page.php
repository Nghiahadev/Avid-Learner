<?php
/**
 * Front Page Template (Hybrid)
 * - Coded sections (Slider + Notice + SVG Tabs)
 * - Elementor editable area via the_content()
 * - Author: Nghia Ha
 */

get_header();
?>

<main id="main-content">

  <!-- =====================================================
       HERO SLIDER (Coded)
  ====================================================== -->
  <section class="al-slider" aria-label="Homepage Slider">
    <div class="al-slider-track">

      <!-- Slide 1 -->
      <article class="al-slide is-active" style="--bg:url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1600&q=80');">
        <div class="al-slide-overlay"></div>
        <div class="al-slide-content">
          <h1>Consulting That Turns Plans Into Results</h1>
          <p>Strategy, execution, and support to help you make smarter decisions and move faster—without the guesswork.</p>

          <div class="al-slide-actions">
            <a href="/contact" class="btn3 btn3--hero">
              <span class="text">Book a Consultation</span>
              <svg class="arr-1" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"></path></svg>
              <svg class="arr-2" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"></path></svg>
              <span class="circle" aria-hidden="true"></span>
            </a>

            <a href="/services" class="btn3 btn3--hero btn3--ghost">
              <span class="text">View Services</span>
              <svg class="arr-1" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"></path></svg>
              <svg class="arr-2" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"></path></svg>
              <span class="circle" aria-hidden="true"></span>
            </a>
          </div>
        </div>
      </article>

      <!-- Slide 2 -->
      <article class="al-slide" style="--bg:url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1600&q=80');">
        <div class="al-slide-overlay"></div>
        <div class="al-slide-content">
          <h1>Clarity First. Then Action.</h1>
          <p>We assess your current situation, identify what matters most, and build a step-by-step plan you can actually follow.</p>

          <div class="al-slide-actions">
            <a href="/contact" class="btn3 btn3--hero">
              <span class="text">Start Your Strategy</span>
              <svg class="arr-1" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"></path></svg>
              <svg class="arr-2" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"></path></svg>
              <span class="circle" aria-hidden="true"></span>
            </a>

            <a href="#how-we-work" class="btn3 btn3--hero btn3--ghost">
              <span class="text">How We Work</span>
              <svg class="arr-1" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"></path></svg>
              <svg class="arr-2" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"></path></svg>
              <span class="circle" aria-hidden="true"></span>
            </a>
          </div>
        </div>
      </article>

      <!-- Slide 3 -->
      <article class="al-slide" style="--bg:url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1600&q=80');">
        <div class="al-slide-overlay"></div>
        <div class="al-slide-content">
          <h1>Build Systems That Scale With You</h1>
          <p>Improve operations, simplify workflows, and create repeatable processes that support sustainable growth.</p>

          <div class="al-slide-actions">
            <a href="/contact" class="btn3 btn3--hero">
              <span class="text">Work With Us</span>
              <svg class="arr-1" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"></path></svg>
              <svg class="arr-2" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"></path></svg>
              <span class="circle" aria-hidden="true"></span>
            </a>

            <a href="/contact" class="btn3 btn3--hero btn3--ghost">
              <span class="text">Contact Us</span>
              <svg class="arr-1" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"></path></svg>
              <svg class="arr-2" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"></path></svg>
              <span class="circle" aria-hidden="true"></span>
            </a>
          </div>
        </div>
      </article>

    </div>

    <!-- Controls -->
    <button class="al-slider-btn prev" type="button" aria-label="Previous slide">‹</button>
    <button class="al-slider-btn next" type="button" aria-label="Next slide">›</button>

    <!-- Dots -->
    <div class="al-slider-dots" role="tablist" aria-label="Slide navigation">
      <button class="al-dot is-active" type="button" aria-label="Go to slide 1"></button>
      <button class="al-dot" type="button" aria-label="Go to slide 2"></button>
      <button class="al-dot" type="button" aria-label="Go to slide 3"></button>
    </div>
  </section>

  <!-- =====================================================
       NOTICE BAR (Template Part)
  ====================================================== -->
  <?php get_template_part('notice-bar'); ?>

  <!-- =====================================================
       HOW WE WORK (Coded Tabs + SVG)
  ====================================================== -->
  <section id="how-we-work" class="consulting-approach" data-tabs>
    <div class="approach-inner">

      <!-- LEFT -->
      <div class="approach-content">
        <h2>How We Work</h2>
        <p class="subtitle">A thoughtful, hands-on consulting process designed to create real impact.</p>

        <div class="tabs">
          <button class="tab active" type="button" data-tab="strategy">Strategy</button>
          <button class="tab" type="button" data-tab="execution">Execution</button>
          <button class="tab" type="button" data-tab="partnership">Partnership</button>
        </div>

        <div class="tab-content active" id="strategy">
          <p>We analyze, simplify, and define a clear path forward—aligned with your goals.</p>
        </div>

        <div class="tab-content" id="execution">
          <p>We turn ideas into action, supporting implementation every step of the way.</p>
        </div>

        <div class="tab-content" id="partnership">
          <p>We stay involved to adapt, refine, and grow with your business.</p>
        </div>

                    <a href="/contact" class="btn3 btn3--hero">
              <span class="text">Book a Consultation</span>
              <svg class="arr-1" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"></path></svg>
              <svg class="arr-2" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"></path></svg>
              <span class="circle" aria-hidden="true"></span>
            </a>
      </div>

      <!-- RIGHT -->
      <div class="approach-visual">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" aria-label="Decorative blob image">
          <image href="https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/01/working-group-huddled-around-and-pointing-at-shared-laptop-scaled.jpg"
                width="200" height="200"
                preserveAspectRatio="xMidYMid slice"
                clip-path="url(#blobClip)"/>
          <clipPath id="blobClip">
            <path d="M43.1,-68.5C56.2,-58.6,67.5,-47.3,72.3,-33.9C77.2,-20.5,75.5,-4.9,74.2,11.3C72.9,27.6,71.9,44.5,63.8,57.2C55.7,69.8,40.6,78.2,25.5,79.2C10.4,80.1,-4.7,73.6,-20.9,69.6C-37.1,65.5,-54.5,63.9,-66,54.8C-77.5,45.8,-83.2,29.3,-85.7,12.3C-88.3,-4.8,-87.7,-22.3,-79.6,-34.8C-71.5,-47.3,-55.8,-54.9,-41.3,-64.2C-26.7,-73.6,-13.4,-84.7,0.8,-86C15,-87.2,29.9,-78.5,43.1,-68.5Z"
                  transform="translate(100 100)"/>
          </clipPath>

          <path
            id="textPathBlob"
            d="M43.1,-68.5C56.2,-58.6,67.5,-47.3,72.3,-33.9C77.2,-20.5,75.5,-4.9,74.2,11.3C72.9,27.6,71.9,44.5,63.8,57.2C55.7,69.8,40.6,78.2,25.5,79.2C10.4,80.1,-4.7,73.6,-20.9,69.6C-37.1,65.5,-54.5,63.9,-66,54.8C-77.5,45.8,-83.2,29.3,-85.7,12.3C-88.3,-4.8,-87.7,-22.3,-79.6,-34.8C-71.5,-47.3,-55.8,-54.9,-41.3,-64.2C-26.7,-73.6,-13.4,-84.7,0.8,-86C15,-87.2,29.9,-78.5,43.1,-68.5Z"
            transform="translate(100 100)"
            fill="none"
            stroke="none"
            pathLength="100"
          />

          <text class="text-content">
            <textPath href="#textPathBlob" startOffset="0%">
              ✨ Crafted with Care ✨ Crafted with Care ✨ Crafted with Care 
              <animate attributeName="startOffset" from="0%" to="100%" dur="15s" repeatCount="indefinite" />
            </textPath>
            <textPath href="#textPathBlob" startOffset="100%">
              ✨ Crafted with Care ✨ Crafted with Care ✨ Crafted with Care 
              <animate attributeName="startOffset" from="-100%" to="0%" dur="15s" repeatCount="indefinite" />
            </textPath>
          </text>
        </svg>
      </div>

    </div>
  </section>

  <!-- =====================================================
       WHY CHOOSE US (Template Part)
  ====================================================== -->

    <?php get_template_part('why-choose-us'); ?>

    <?php get_template_part('what-we-do'); ?>


    <?php get_template_part('cta'); ?>

  <!-- =====================================================
       ELEMENTOR EDITABLE AREA
       (Add sections in Elementor Editor for the Home page)
  ====================================================== -->
  <section class="home-elementor">
    <?php
    while ( have_posts() ) : the_post();
      the_content();
    endwhile;
    ?>
  </section>

</main>

<?php get_footer(); ?>
