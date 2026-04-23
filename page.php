<?php get_header(); ?>
<main class="page-default">
    <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <div class="page-content"><?php the_content(); ?></div>
        <?php endwhile; ?>
    </div>
</main>
<?php get_footer(); ?>
