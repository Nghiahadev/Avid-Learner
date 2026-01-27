<?php get_header(); ?>

<main>

  <!-- HERO SLIDER -->
  <section class="al-slider" aria-label="Homepage Slider">
    <div class="al-slider-track">

      <!-- Slide 1 -->
      <article class="al-slide is-active" style="--bg:url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1600&q=80');">
        <div class="al-slide-overlay"></div>
        <div class="al-slide-content">
          <h1>Consulting That Turns Plans Into Results</h1>
          <p>Strategy, execution, and support to help you make smarter decisions and move faster—without the guesswork.</p>

          <div class="al-slide-actions">
            <!-- BTN3 Primary -->
            <a href="#" class="btn3 btn3--hero">
              <span class="text">Book a Consultation</span>

              <svg class="arr-1" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M5 12h14M13 5l7 7-7 7"></path>
              </svg>

              <svg class="arr-2" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M5 12h14M13 5l7 7-7 7"></path>
              </svg>

              <span class="circle" aria-hidden="true"></span>
            </a>

            <!-- BTN3 Ghost -->
            <a href="#" class="btn3 btn3--hero btn3--ghost">
              <span class="text">View Services</span>

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
      </article>

      <!-- Slide 2 -->
      <article class="al-slide" style="--bg:url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1600&q=80');">
        <div class="al-slide-overlay"></div>
        <div class="al-slide-content">
          <h1>Clarity First. Then Action.</h1>
          <p>We assess your current situation, identify what matters most, and build a step-by-step plan you can actually follow.</p>

          <div class="al-slide-actions">
            <!-- BTN3 Primary -->
            <a href="#" class="btn3 btn3--hero">
              <span class="text">Start Your Strategy</span>

              <svg class="arr-1" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M5 12h14M13 5l7 7-7 7"></path>
              </svg>

              <svg class="arr-2" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M5 12h14M13 5l7 7-7 7"></path>
              </svg>

              <span class="circle" aria-hidden="true"></span>
            </a>

            <!-- BTN3 Ghost -->
            <a href="#" class="btn3 btn3--hero btn3--ghost">
              <span class="text">How We Work</span>

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
      </article>

      <!-- Slide 3 -->
      <article class="al-slide" style="--bg:url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1600&q=80');">
        <div class="al-slide-overlay"></div>
        <div class="al-slide-content">
          <h1>Build Systems That Scale With You</h1>
          <p>Improve operations, simplify workflows, and create repeatable processes that support sustainable growth.</p>

          <div class="al-slide-actions">
            <!-- BTN3 Primary -->
            <a href="#" class="btn3 btn3--hero">
              <span class="text">Work With Us</span>

              <svg class="arr-1" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M5 12h14M13 5l7 7-7 7"></path>
              </svg>

              <svg class="arr-2" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M5 12h14M13 5l7 7-7 7"></path>
              </svg>

              <span class="circle" aria-hidden="true"></span>
            </a>

            <!-- BTN3 Ghost -->
            <a href="#" class="btn3 btn3--hero btn3--ghost">
              <span class="text">Contact Us</span>

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

    <!-- NOTICE BAR BELOW SLIDER -->
  <?php get_template_part('notice-bar'); ?>
  

</main>

<?php get_footer(); ?>
