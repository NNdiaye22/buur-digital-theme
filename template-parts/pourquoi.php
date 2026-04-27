<?php
/**
 * BUUR Digital — NOTRE ADN
 * Layout éditorial : grande stat à gauche + liste à droite.
 * Premium, sobre, sans icônes dans des ronds.
 */

$eyebrow = get_theme_mod( 'buur_adn_eyebrow', 'NOTRE ADN' );
$title   = get_theme_mod( 'buur_adn_title',   'Pourquoi choisir BUUR ?' );

$valeurs = array(
    array(
        'num'   => '01',
        'title' => get_theme_mod( 'buur_adn_card1_title', 'Excellence' ),
        'desc'  => get_theme_mod( 'buur_adn_card1_desc',  'Des sites qui rivalisent avec les meilleures agences internationales.' ),
        'items' => array( 'Design UI/UX haut de gamme', 'Code propre et performant', 'Tests qualité rigoureux', 'Livraison soignée' ),
    ),
    array(
        'num'   => '02',
        'title' => get_theme_mod( 'buur_adn_card2_title', 'Accessibilité' ),
        'desc'  => get_theme_mod( 'buur_adn_card2_desc',  'Prix transparents et honnêtes. Le luxe web pour tous les budgets.' ),
        'items' => array( 'Devis clair sans surprise', 'Paiement en plusieurs fois', 'Adapté TPE & PME', 'Support réactif inclus' ),
        'featured' => true,
    ),
    array(
        'num'   => '03',
        'title' => get_theme_mod( 'buur_adn_card3_title', 'Innovation' ),
        'desc'  => get_theme_mod( 'buur_adn_card3_desc',  'Technologies de pointe : IA, animations 3D, vidéos génératives.' ),
        'items' => array( 'Intégration IA & automatisation', 'Animations GSAP / Three.js', 'PWA & Core Web Vitals', 'Veille technologique continue' ),
    ),
);
?>

<section class="adn-section" id="pourquoi" aria-label="Notre ADN">
    <div class="adn-inner">

        <!-- En-tête sticky gauche -->
        <div class="adn-lead">
            <span class="section-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
            <h2 class="adn-lead-title"><?php echo esc_html( $title ); ?></h2>
            <p class="adn-lead-sub">Trois principes fondateurs qui guident chaque projet depuis notre création.</p>
            <div class="adn-lead-line" aria-hidden="true"></div>
        </div>

        <!-- Liste verticale des valeurs -->
        <ol class="adn-list" role="list">
            <?php foreach ( $valeurs as $v ) : ?>
            <li class="adn-item <?php echo ! empty( $v['featured'] ) ? 'adn-item--featured' : ''; ?>" aria-label="<?php echo esc_attr( $v['title'] ); ?>">
                <span class="adn-num" aria-hidden="true"><?php echo esc_html( $v['num'] ); ?></span>
                <div class="adn-item-body">
                    <h3 class="adn-item-title"><?php echo esc_html( $v['title'] ); ?></h3>
                    <p class="adn-item-desc"><?php echo esc_html( $v['desc'] ); ?></p>
                    <ul class="adn-item-features" role="list">
                        <?php foreach ( $v['items'] as $feat ) : ?>
                        <li><?php echo esc_html( $feat ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </li>
            <?php endforeach; ?>
        </ol>

    </div>
</section>
