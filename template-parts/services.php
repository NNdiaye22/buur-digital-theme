<?php
/**
 * BUUR Digital — Services
 * Fond par carte : video uploadee OU photo uploadee via Customizer.
 */

$eyebrow = get_theme_mod( 'buur_services_eyebrow', 'NOS SERVICES' );
$title   = get_theme_mod( 'buur_services_title',   'Choisissez votre univers digital' );

// Videos par defaut (dans /assets/videos/)
$default_videos = array(
    1 => 'city-aerial.mp4',
    2 => 'market-loop.mp4',
    3 => 'control-room-loop.mp4',
);

// Features par defaut
$default_features = array(
    1 => array( 'Design premium sur mesure', 'Optimise mobile & desktop', 'SEO local inclus', 'Livraison en 7 jours' ),
    2 => array( 'Boutique WooCommerce', 'Wave & Orange Money', 'Gestion des commandes', 'Formation incluse' ),
    3 => array( 'Ciblage hyper-local', 'Creation des visuels', 'Suivi en temps reel', 'Rapport mensuel' ),
);

$default_titles = array( 1 => 'Site Vitrine', 2 => 'Site E-commerce', 3 => 'Campagnes Meta' );
$default_descs  = array(
    1 => 'Une presence professionnelle en ligne qui inspire confiance et convertit vos visiteurs en clients.',
    2 => 'Vendez vos produits partout au Senegal et en Afrique. Paiement mobile money, livraison, gestion de stock.',
    3 => 'Publicites Facebook & Instagram ciblees. Plus de clients garantis en 2 semaines ou on continue gratuitement.',
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
            $s_bg_type  = get_theme_mod( "buur_service{$i}_bg_type",  'video' );

            // Features
            $features = array();
            for ( $f = 1; $f <= 4; $f++ ) :
                $feat = get_theme_mod( "buur_service{$i}_feat{$f}", '' );
                if ( $feat ) $features[] = $feat;
            endfor;
            if ( empty( $features ) ) $features = $default_features[ $i ];

            // Fond : photo ou video
            $bg_html = '';
            if ( $s_bg_type === 'image' ) :
                $img_id  = absint( get_theme_mod( "buur_service{$i}_bg_image", 0 ) );
                $img_url = $img_id ? wp_get_attachment_image_url( $img_id, 'buur-card' ) : '';
                if ( $img_url ) :
                    $bg_html = '<img class="card-video card-bg-img" src="' . esc_url( $img_url ) . '" alt="" loading="lazy" decoding="async">';
                else :
                    // Fallback : fond couleur si image non definie
                    $bg_html = '<div class="card-video card-bg-fallback"></div>';
                endif;
            else :
                // Video : custom uploadee ou video par defaut
                $vid_id  = absint( get_theme_mod( "buur_service{$i}_bg_video", 0 ) );
                $vid_url = $vid_id ? wp_get_attachment_url( $vid_id ) : BUUR_URI . '/assets/videos/' . $default_videos[ $i ];
                $bg_html = '<video class="card-video" data-src="' . esc_url( $vid_url ) . '" autoplay muted loop playsinline preload="none"></video>';
            endif;
        ?>
        <article
            class="service-card <?php echo $s_featured ? 'service-card--featured' : ''; ?>"
            aria-label="Service : <?php echo esc_attr( $s_title ); ?>"
        >
            <div class="card-video-wrap" aria-hidden="true">
                <?php echo $bg_html; ?>
                <div class="card-video-overlay"></div>
                <div class="card-icon"><?php echo $icons[ $i ]; ?></div>
            </div>

            <div class="card-body">
                <h3 class="card-title"><?php echo esc_html( $s_title ); ?></h3>
                <p class="card-desc"><?php echo esc_html( $s_desc ); ?></p>

                <ul class="card-features" role="list">
                    <?php foreach ( $features as $feat ) : ?>
                    <li>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php echo esc_html( $feat ); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <div class="card-footer">
                    <div class="card-price">
                        <?php if ( $s_price !== 'Sur devis' ) : ?>
                        <span class="price-from">A partir de</span>
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
