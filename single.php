<?php get_header(); ?>

<main id="primary" class="site-main">
  <?php
  while ( have_posts() ) : the_post();
    the_content(); // ✅ Elementor needs this too
  endwhile;
  ?>
</main>

<?php get_footer(); ?>
