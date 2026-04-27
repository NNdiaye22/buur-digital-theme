<?php
/**
 * BUUR Digital — Services
 * Fond : photo uploadée via Customizer ou fond sombre par défaut.
 */

$eyebrow = get_theme_mod( 'buur_services_eyebrow', 'NOS SERVICES' );
$title   = get_theme_mod( 'buur_services_title',   'Choisissez votre univers digital' );

$default_features = array(
    1 => array( 'Design premium sur mesure', 'Optimisé mobile & desktop', 'SEO local inclus', 'Livraison en 7 jours' ),
    2 => array( 'Boutique WooCommerce', 'Wave & Orange Money', 'Gestion des commandes', 'Formation incluse' ),
    3 => array( 'Ciblage hyper-local', 'Création des visuels', 'Suivi en temps réel', 'Rapport mensuel' ),
);
$default_titles = array( 1 => 'Site Vitrine', 2 => 'Site E-commerce', 3 => 'Campagnes Meta' );
$default_descs  = array(
    1 => 'Une présence professionnelle en ligne qui inspire confiance et convertit vos visiteurs en clients.',
    2 => 'Vendez vos produits partout au Sénégal et en Afrique. Paiement mobile money, livraison, gestion de stock.',
    3 => 'Publicités Facebook & Instagram ciblées. Plus de clients garantis en 2 semaines ou on continue gratuitement.',
);
$default_prices = array( 1 => '150 000 FCFA', 2 => '250 000 FCFA', 3 => 'Sur devis' );

$icons = array(
    1 => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
    2 => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>',
    3 => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>',
);
?>

<section class="services-section" id="services" aria-label="Nos services">
    <div class="services-header">
        <span class="section-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
        <h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
    </div>

    <div class="services-grid">
        <?php for ( $i = 1; $i <= 3; $i++ ) :

            $s_title    = get_theme_mod( "buur_service{$i}_title",    $default_titles[ $i ] );
            $s_desc     = get_theme_mod( "buur_service{$i}_desc",     $default_descs[ $i ] );
            $s_price    = get_theme_mod( "buur_service{$i}_price",    $default_prices[ $i ] );
            $s_featured = get_theme_mod( "buur_service{$i}_featured", $i === 2 );

            // Photo de fond
            $img_id  = absint( get_theme_mod( "buur_service{$i}_bg_image", 0 ) );
            $img_url = $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : '';

            // Features
            $features = array();
            for ( $f = 1; $f <= 4; $f++ ) :
                $feat = get_theme_mod( "buur_service{$i}_feat{$f}", '' );
                if ( $feat ) $features[] = $feat;
            endfor;
            if ( empty( $features ) ) $features = $default_features[ $i ];
        ?>
        <article
            class="service-card <?php echo $s_featured ? 'service-card--featured' : ''; ?>"
            aria-label="Service : <?php echo esc_attr( $s_title ); ?>"
        >
            <div class="card-img-wrap" aria-hidden="true">
                <?php if ( $img_url ) : ?>
                    <img
                        class="card-bg-img"
                        src="<?php echo esc_url( $img_url ); ?>"
                        alt=""
                        loading="lazy"
                        decoding="async"
                        width="600" height="338"
                    >
                <?php else : ?>
                    <div class="card-bg-fallback" aria-hidden="true"></div>
                <?php endif; ?>
                <div class="card-img-overlay"></div>
                <div class="card-icon"><?php echo $icons[ $i ]; ?></div>
            </div>

            <div class="card-body">
                <h3 class="card-title"><?php echo esc_html( $s_title ); ?></h3>
                <p class="card-desc"><?php echo esc_html( $s_desc ); ?></p>

                <ul class="card-features" role="list">
                    <?php foreach ( $features as $feat ) : ?>
                    <li>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php echo esc_html( $feat ); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <div class="card-footer">
                    <div class="card-price">
                        <?php if ( $s_price !== 'Sur devis' ) : ?>
                        <span class="price-from">À partir de</span>
                        <?php endif; ?>
                        <span class="price-amount"><?php echo esc_html( $s_price ); ?></span>
                    </div>
                    <a href="<?php echo esc_url( buur_whatsapp_url( 'sn' ) ); ?>" class="btn-card" target="_blank" rel="noopener noreferrer">
                        En savoir plus &rarr;
                    </a>
                </div>
            </div>
        </article>
        <?php endfor; ?>
    </div>
</section>
