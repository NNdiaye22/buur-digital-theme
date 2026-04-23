<?php
/**
 * BUUR Digital — ACTE 3 : Services
 * 3 cards avec fond vidéo individuel
 */

$services = array(
    array(
        'id'       => 'vitrine',
        'title'    => 'Site Vitrine',
        'desc'     => 'Une présence professionnelle en ligne qui inspire confiance et convertit vos visiteurs en clients.',
        'video'    => 'city-aerial.mp4',
        'image'    => 'building-screen.jpg',
        'price'    => '150 000 FCFA',
        'currency' => 'Sénégal',
        'features' => array( 'Design premium sur mesure', 'Optimisé mobile & desktop', 'SEO local inclus', 'Livraison en 7 jours' ),
        'icon'     => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
    ),
    array(
        'id'       => 'ecommerce',
        'title'    => 'Site E-commerce',
        'desc'     => 'Vendez vos produits partout au Sénégal et en Afrique. Paiement mobile money, livraison, gestion de stock.',
        'video'    => 'market-loop.mp4',
        'image'    => 'phone-ecommerce.jpg',
        'price'    => '250 000 FCFA',
        'currency' => 'Sénégal',
        'features' => array( 'Boutique WooCommerce', 'Wave & Orange Money', 'Gestion des commandes', 'Formation incluse' ),
        'icon'     => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>',
        'featured' => true,
    ),
    array(
        'id'       => 'campagnes',
        'title'    => 'Campagnes Meta',
        'desc'     => 'Publicités Facebook & Instagram ciblées. Plus de clients garantis en 2 semaines ou on continue gratuitement.',
        'video'    => 'control-room-loop.mp4',
        'image'    => '',
        'price'    => 'Sur devis',
        'currency' => '',
        'features' => array( 'Ciblage hyper-local', 'Création des visuels', 'Suivi en temps réel', 'Rapport mensuel' ),
        'icon'     => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>',
    ),
);
?>

<section class="services-section" id="services" aria-label="Nos services">
    <div class="services-header">
        <span class="section-eyebrow">NOS SERVICES</span>
        <h2 class="section-title">Choisissez votre univers digital</h2>
    </div>

    <div class="services-grid">
        <?php foreach ( $services as $service ) : ?>
        <article
            class="service-card <?php echo $service['featured'] ?? false ? 'service-card--featured' : ''; ?>"
            id="service-<?php echo esc_attr( $service['id'] ); ?>"
            aria-label="Service : <?php echo esc_attr( $service['title'] ); ?>"
        >

            <!-- Zone vidéo de fond -->
            <div class="card-video-wrap" aria-hidden="true">
                <video
                    class="card-video"
                    data-src="<?php echo esc_url( BUUR_URI . '/assets/videos/' . $service['video'] ); ?>"
                    autoplay muted loop playsinline preload="none"
                ></video>
                <div class="card-video-overlay"></div>
                <div class="card-icon"><?php echo $service['icon']; ?></div>
            </div>

            <!-- Contenu de la carte -->
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
                        <span class="price-from">À partir de</span>
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
