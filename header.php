<?php
/**
 * Header template
 * Theme: Avid Learner
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- TOP BAR -->
<div class="top-bar">
  <div class="top-left">
    <span>📞 +1 (234) 567-890</span>
    <span>✉️ info@company.com</span>
  </div>

  <div class="top-right">
    <a href="#" aria-label="Facebook">Facebook</a>
    <a href="#" aria-label="LinkedIn">LinkedIn</a>
    <a href="#" aria-label="Twitter">Twitter</a>
  </div>
</div>

<!-- NAVBAR -->
<nav class="navbar" aria-label="Primary Navigation">
  <!-- LEFT: Logo -->
    <div class="nav-left">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="logo logo-wrap" aria-label="Avid Learner Home">
        <img
          class="logo-img"
          src="https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/01/AL-logo.png"
          alt="Avid Learner Logo"
        />
        <span class="logo-text">Avid Learner</span>
      </a>
    </div>



  <!-- CENTER: Menu (WordPress) -->
  <div class="nav-center">
    <?php
      wp_nav_menu([
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'menu',
        'fallback_cb'    => function () {
          echo '<ul class="menu">';
          echo '<li><a href="' . esc_url(home_url('/')) . '"><span class="hover-span"></span>Home</a></li>';
          echo '<li><a href="#"><span class="hover-span"></span>Services</a></li>';
          echo '<li><a href="#"><span class="hover-span"></span>About</a></li>';
          echo '<li><a href="#"><span class="hover-span"></span>Blog</a></li>';
          echo '</ul>';
        },
        // Inserts the animated sweep span inside each <a>
        'link_before'    => '<span class="hover-span"></span>',
      ]);
    ?>
  </div>

  <!-- RIGHT: Button -->
  <div class="nav-right">
    <a class="btn3" href="<?php echo esc_url(home_url('/')); ?>">
      <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
      </svg>

      <span class="text">Get Started</span>
      <span class="circle" aria-hidden="true"></span>

      <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
      </svg>
    </a>
  </div>
</nav>
