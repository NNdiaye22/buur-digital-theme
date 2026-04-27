<?php
/**
 * BUUR Digital — NOTRE ADN
 * Titres et descriptions des 3 cartes éditables via le Customizer.
 */

$valeurs = array(
    array(
        'id'    => 'excellence',
        'icon'  => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
        'title' => get_theme_mod( 'buur_adn_card1_title', 'Excellence' ),
        'desc'  => get_theme_mod( 'buur_adn_card1_desc',  'Des sites qui rivalisent avec les meilleures agences internationales.' ),
        'items' => array(
            'Design UI/UX haut de gamme',
            'Code propre et performant',
            'Tests qualité rigoureux',
            'Livraison soignée',
        ),
    ),
    array(
        'id'      => 'accessibilite',
        'icon'    => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>',
        'title'   => get_theme_mod( 'buur_adn_card2_title', 'Accessibilité' ),
        'desc'    => get_theme_mod( 'buur_adn_card2_desc',  'Prix transparents et honnêtes. Le luxe web pour tous les budgets.' ),
        'featured' => true,
        'items' => array(
            'Devis clair sans surprise',
            'Paiement en plusieurs fois',
            'Adapté TPE & PME',
            'Support réactif inclus',
        ),
    ),
    array(
        'id'    => 'innovation',
        'icon'  => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
        'title' => get_theme_mod( 'buur_adn_card3_title', 'Innovation' ),
        'desc'  => get_theme_mod( 'buur_adn_card3_desc',  'Technologies de pointe : IA, animations 3D, vidéos génératives.' ),
        'items' => array(
            'Intégration IA & automatisation',
            'Animations GSAP / Three.js',
            'PWA & performances Core Web Vitals',
            'Veille technologique continue',
        ),
    ),
);

$eyebrow = get_theme_mod( 'buur_adn_eyebrow', 'NOTRE ADN' );
$title   = get_theme_mod( 'buur_adn_title',   'Pourquoi choisir BUUR ?' );
?>

<section class="adn-section" id="pourquoi" aria-label="Notre ADN">

    <div class="adn-header">
        <span class="section-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
        <h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
    </div>

    <div class="adn-grid">
        <?php foreach ( $valeurs as $v ) : ?>
        <article
            class="adn-card <?php echo ! empty( $v['featured'] ) ? 'adn-card--featured' : ''; ?>"
            id="adn-<?php echo esc_attr( $v['id'] ); ?>"
            aria-label="Valeur : <?php echo esc_attr( $v['title'] ); ?>"
        >
            <div class="adn-card-halo" aria-hidden="true"></div>
            <div class="adn-card-icon" aria-hidden="true"><?php echo $v['icon']; ?></div>
            <div class="adn-card-body">
                <h3 class="adn-card-title"><?php echo esc_html( $v['title'] ); ?></h3>
                <p class="adn-card-desc"><?php echo esc_html( $v['desc'] ); ?></p>
                <ul class="adn-card-features" role="list">
                    <?php foreach ( $v['items'] as $item ) : ?>
                    <li>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php echo esc_html( $item ); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </article>
        <?php endforeach; ?>
    </div>

</section>
