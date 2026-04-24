<?php
/**
 * BUUR Digital — Homepage
 * Services intégrés dans le scroll-frames overlay, pas dans le flux
 */
get_header();
?>
<main id="primary" class="site-main">
  <?php get_template_part('template-parts/hero'); ?>
  <?php get_template_part('template-parts/scroll-frames'); ?>
  <?php get_template_part('template-parts/stats'); ?>
  <?php get_template_part('template-parts/temoignages'); ?>
  <?php get_template_part('template-parts/cta'); ?>
</main>
<?php get_footer(); ?>
