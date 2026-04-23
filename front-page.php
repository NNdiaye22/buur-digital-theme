<?php
/**
 * BUUR Digital — front-page.php
 * Page d'accueil — 8 actes scrolltelling
 */
get_header();
?>

<main class="buur-homepage" id="main-content">

    <?php get_template_part( 'template-parts/hero' ); ?>
    <?php get_template_part( 'template-parts/probleme' ); ?>
    <?php get_template_part( 'template-parts/services' ); ?>
    <?php get_template_part( 'template-parts/stats' ); ?>
    <?php get_template_part( 'template-parts/pourquoi' ); ?>
    <?php get_template_part( 'template-parts/temoignages' ); ?>
    <?php get_template_part( 'template-parts/cta' ); ?>

</main>

<?php get_footer(); ?>
