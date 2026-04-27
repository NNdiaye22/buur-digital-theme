<?php
/**
 * BUUR Digital — Services
 * Toutes les donnees viennent du Customizer.
 * Chaque carte peut avoir une video OU une photo de fond.
 */

$eyebrow = get_theme_mod( 'buur_services_eyebrow', 'NOS SERVICES' );
$title   = get_theme_mod( 'buur_services_title',   'Choisissez votre univers digital' );

$services = array();
for ( $i = 1; $i <= 3; $i++ ) :
    $services[] = array(
        'id'       => get_theme_mod( "buur_service{$i}_id",       array( 'vitrine', 'ecommerce', 'campagnes' )[ $i - 1 ] ),
        'title'    => get_theme_mod( "buur_service{$i}_title",    array( 'Site Vitrine', 'Site E-commerce', 'Campagnes Meta' )[ $i - 1 ] ),
        'desc'     => get_theme_mod( "buur_service{$i}_desc",     array(
            'Une presence professionnelle en ligne qui inspire confiance et convertit vos visiteurs en clients.',
            'Vendez vos produits partout au Senegal et en Afrique. Paiement mobile money, livraison, gestion de stock.',
            'Publicites Facebook & Instagram ciblees. Plus de clients garantis en 2 semaines ou on continue gratuitement.',
        )[ $i - 1 ] ),
        'price'    => get_theme_mod( "buur_service{$i}_price",    array( '150 000 FCFA', '250 000 FCFA', 'Sur devis' )[ $i - 1 ] ),
        'featured' => get_theme_mod( "buur_service{$i}_featured", $i === 2 ),
        'bg_type'  => get_theme_mod( "buur_service{$i}_bg_type",  'video' ),
        'bg_image' => get_theme_mod( "buur_service{$i}_bg_image", '' ),
        'video'    => array( 'city-aerial.mp4', 'market-loop.mp4', 'control-room-loop.mp4' )[ $i - 1 ],
        'features' => array_filter( array(
            get_theme_mod( "buur_service{$i}_feat1", '' ),
            get_theme_mod( "buur_service{$i}_feat2", '' ),
            get_theme_mod( "buur_service{$i}_feat3", '' ),
            get_theme_mod( "buur_service{$i}_feat4", '' ),
        ) ),
        'icon' => array(
            '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
            '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>',
            '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>',
        )[ $i - 1 ],
    );
    // Valeurs par defaut des features si vides
    if ( empty( array_filter( $services[ $i - 1 ]['features'] ) ) ) :
        $services[ $i - 1 ]['features'] = array(
            array( 'Design premium sur mesure', 'Optimise mobile & desktop', 'SEO local inclus', 'Livraison en 7 jours' ),
            array( 'Boutique WooCommerce', 'Wave & Orange Money', 'Gestion des commandes', 'Formation incluse' ),
            array( 'Ciblage hyper-local', 'Creation des visuels', 'Suivi en temps reel', 'Rapport mensuel' ),
        )[ $i - 1 ];
    endif;
endfor;
?>

<section class="services-section" id="services" aria-label="Nos services">
    <div class="services-header">
        <span class="section-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
        <h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
    </div>

    <div class="services-grid">
        <?php foreach ( $services as $service ) : ?>
        <article
            class="service-card <?php echo $service['featured'] ? 'service-card--featured' : ''; ?>"
            id="service-<?php echo esc_attr( $service['id'] ); ?>"
            aria-label="Service : <?php echo esc_attr( $service['title'] ); ?>"
        >
            <!-- Fond : video ou photo -->
            <div class="card-video-wrap" aria-hidden="true">

                <?php if ( $service['bg_type'] === 'image' && $service['bg_image'] ) :
                    $img_url = wp_get_attachment_image_url( $service['bg_image'], 'buur-card' );
                ?>
                    <img
                        class="card-video card-bg-img"
                        src="<?php echo esc_url( $img_url ); ?>"
                        alt=""
                        loading="lazy"
                        decoding="async"
                    >
                <?php else : ?>
                    <video
                        class="card-video"
                        data-src="<?php echo esc_url( BUUR_URI . '/assets/videos/' . $service['video'] ); ?>"
                        autoplay muted loop playsinline preload="none"
                    ></video>
                <?php endif; ?>

                <div class="card-video-overlay"></div>
                <div class="card-icon"><?php echo $service['icon']; ?></div>
            </div>

            <!-- Contenu -->
            <div class="card-body">
                <h3 class="card-title"><?php echo esc_html( $service['title'] ); ?></h3>
                <p class="card-desc"><?php echo esc_html( $service['desc'] ); ?></p>

                <ul class="card-features" role="list">
                    <?php foreach ( $service['features'] as $feat ) : ?>
                    <li>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php echo esc_html( $feat ); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <div class="card-footer">
                    <div class="card-price">
                        <?php if ( $service['price'] !== 'Sur devis' ) : ?>
                        <span class="price-from">A partir de</span>
                        <?php endif; ?>
                        <span class="price-amount"><?php echo esc_html( $service['price'] ); ?></span>
                    </div>
                    <a
                        href="<?php echo esc_url( buur_whatsapp_url( 'sn' ) ); ?>"
                        class="btn-card"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        En savoir plus &rarr;
                    </a>
                </div>
            </div>

        </article>
        <?php endforeach; ?>
    </div>
</section>
