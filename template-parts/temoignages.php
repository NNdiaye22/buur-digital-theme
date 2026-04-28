<?php
/**
 * BUUR Digital — ACTE 6 : Témoignages
 * Lit les avis depuis le CPT 'temoignage'.
 * Fallback sur les données statiques si aucun avis publié.
 */

$villes = array(
    'Dakar', 'Thiès', 'Saint-Louis', 'Ziguinchor',
    'Abidjan', 'Lomé', 'Bamako', 'Conakry', 'Douala',
);

/* ── Récupération depuis le CPT ── */
$query = new WP_Query( array(
    'post_type'      => 'temoignage',
    'post_status'    => 'publish',
    'posts_per_page' => 8,
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
) );

$temoignages = array();

if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        $temoignages[] = array(
            'name'    => get_post_meta( get_the_ID(), '_temo_name',    true ) ?: get_the_title(),
            'company' => get_post_meta( get_the_ID(), '_temo_company', true ),
            'city'    => get_post_meta( get_the_ID(), '_temo_city',    true ),
            'quote'   => get_the_title(),
            'rating'  => (int) ( get_post_meta( get_the_ID(), '_temo_rating', true ) ?: 5 ),
            'service' => get_post_meta( get_the_ID(), '_temo_service', true ),
        );
    }
    wp_reset_postdata();
} else {
    /* Fallback statique si aucun avis dans l'admin */
    $temoignages = array(
        array(
            'name'    => 'Aminata D.',
            'company' => 'Restaurant Le Baobab',
            'city'    => 'Dakar',
            'quote'   => 'BUUR Digital a complètement transformé notre présence en ligne. Nous recevons des réservations depuis notre site chaque semaine.',
            'rating'  => 5,
            'service' => 'Site Vitrine',
        ),
        array(
            'name'    => 'Moussa K.',
            'company' => 'Boutique Mode Africaine',
            'city'    => 'Thiès',
            'quote'   => 'J\'ai maintenant des commandes de tout le Sénégal. Le site e-commerce est professionnel et facile à gérer.',
            'rating'  => 5,
            'service' => 'Site E-commerce',
        ),
        array(
            'name'    => 'Fatou N.',
            'company' => 'Salon de Beauté Lumii',
            'city'    => 'Saint-Louis',
            'quote'   => 'Plus de clientes en 2 semaines qu\'en 6 mois de bouche-à-oreille. Les campagnes Meta de BUUR sont redoutables.',
            'rating'  => 5,
            'service' => 'Campagnes Meta',
        ),
        array(
            'name'    => 'Ibrahim S.',
            'company' => 'Quincaillerie Moderne',
            'city'    => 'Ziguinchor',
            'quote'   => 'Prix honnête, travail très sérieux. Je recommande BUUR Digital à tous les commerçants du Sénégal.',
            'rating'  => 5,
            'service' => 'Site Vitrine',
        ),
    );
}
?>

<section class="temoignages-section" id="temoignages" aria-label="Témoignages clients">

    <div class="temoignages-header">
        <span class="section-eyebrow">ILS TÉMOIGNENT</span>
        <h2 class="section-title">Rejoignez nos clients satisfaits</h2>
    </div>

    <!-- Marquee villes -->
    <div class="marquee-wrap" aria-hidden="true">
        <div class="marquee-track">
            <?php for ( $i = 0; $i < 3; $i++ ) : ?>
            <?php foreach ( $villes as $ville ) : ?>
            <span class="marquee-item"><?php echo esc_html( $ville ); ?></span>
            <span class="marquee-sep" aria-hidden="true">&middot;</span>
            <?php endforeach; ?>
            <?php endfor; ?>
        </div>
    </div>

    <!-- Cards témoignages -->
    <div class="temoignages-grid">
        <?php foreach ( $temoignages as $i => $t ) : ?>
        <blockquote
            class="temoignage-card"
            data-index="<?php echo $i; ?>"
            aria-label="Témoignage de <?php echo esc_attr( $t['name'] ); ?>"
        >
            <div class="card-stars" aria-label="<?php echo $t['rating']; ?> étoiles sur 5">
                <?php for ( $s = 0; $s < $t['rating']; $s++ ) : ?>
                <span aria-hidden="true">&starf;</span>
                <?php endfor; ?>
            </div>
            <p class="card-quote">&ldquo;<?php echo esc_html( $t['quote'] ); ?>&rdquo;</p>
            <footer class="card-author">
                <strong><?php echo esc_html( $t['name'] ); ?></strong>
                <?php if ( $t['company'] ) : ?>
                <span><?php echo esc_html( $t['company'] ); ?><?php echo $t['city'] ? ' &mdash; ' . esc_html( $t['city'] ) : ''; ?></span>
                <?php endif; ?>
                <?php if ( $t['service'] ) : ?>
                <span class="card-service-tag"><?php echo esc_html( $t['service'] ); ?></span>
                <?php endif; ?>
            </footer>
        </blockquote>
        <?php endforeach; ?>
    </div>

</section>
