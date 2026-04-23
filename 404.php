<?php get_header(); ?>
<main class="page-404">
    <div class="container">
        <h1>404</h1>
        <p>Cette page n'existe pas.</p>
        <a href="<?php echo esc_url( home_url() ); ?>" class="btn-primary">Retour à l'accueil</a>
    </div>
</main>
<?php get_footer(); ?>
