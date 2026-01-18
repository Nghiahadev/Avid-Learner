<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header style="padding: 16px 24px; border-bottom: 1px solid #eee;">
  <h2 style="margin: 0;">
    <a href="<?php echo esc_url( home_url('/') ); ?>" style="text-decoration:none; color: inherit;">
      <?php bloginfo('name'); ?>
    </a>
  </h2>
</header>
