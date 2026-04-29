<?php
/**
 * BUUR Digital — Services
 * Desktop : grille 4 colonnes (large) / 2x2 (medium).
 * Mobile  : swiper flèches + scroll-snap + points.
 */

$eyebrow = get_theme_mod( 'buur_services_eyebrow', 'NOS SERVICES' );
$title   = get_theme_mod( 'buur_services_title',   'Choisissez votre univers digital' );

$default_features = array(
    1 => array( 'Design premium sur mesure', 'Optimisé mobile & desktop', 'SEO local inclus', 'Livraison en 7 jours' ),
    2 => array( 'Boutique WooCommerce', 'Wave & Orange Money', 'Gestion des commandes', 'Formation incluse' ),
    3 => array( 'Ciblage hyper-local', 'Création des visuels', 'Suivi en temps réel', 'Rapport mensuel' ),
    4 => array( 'Zéro compétence requise', 'Hébergement inclus', 'Modifications sur demande', 'Support WhatsApp' ),
);
$default_titles = array( 1 => 'Site Vitrine', 2 => 'Site E-commerce', 3 => 'Campagnes Meta', 4 => 'BUUR Site' );
$default_descs  = array(
    1 => 'Une présence professionnelle en ligne qui inspire confiance et convertit vos visiteurs en clients.',
    2 => 'Vendez vos produits partout au Sénégal et en Afrique. Paiement mobile money, livraison, gestion de stock.',
    3 => 'Publicités Facebook & Instagram ciblées. Plus de clients garantis en 2 semaines ou on continue gratuitement.',
    4 => 'Votre site pro sans effort. Vous envoyez vos infos, on crée et héberge votre site. Aucune connaissance requise.',
);
$default_prices  = array( 1 => '150 000 FCFA', 2 => '250 000 FCFA', 3 => 'Sur devis', 4 => '17 000 FCFA/mois' );
$default_badges  = array( 1 => '', 2 => 'Populaire', 3 => '', 4 => 'Nouveau' );
$default_badge_on = array( 1 => false, 2 => true, 3 => false, 4 => false );
$default_orders  = array( 1 => 1, 2 => 2, 3 => 3, 4 => 4 );

$icons = array(
    1 => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
    2 => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>',
    3 => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>',
    4 => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/></svg>',
);

$wa_icon = '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.554 4.112 1.523 5.836L.057 23.882a.75.75 0 00.92.92l6.046-1.466A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22a9.944 9.944 0 01-5.073-1.389l-.363-.214-3.761.913.928-3.762-.232-.376A9.944 9.944 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>';

$link_icon = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>';

// ── Construire le tableau des cartes et trier par ordre Customizer ──
$cards = array();
for ( $i = 1; $i <= 4; $i++ ) :
    $s_order    = (int) get_theme_mod( "buur_service{$i}_order",    $default_orders[ $i ] );
    $s_title    = get_theme_mod( "buur_service{$i}_title",    $default_titles[ $i ] );
    $s_desc     = get_theme_mod( "buur_service{$i}_desc",     $default_descs[ $i ] );
    $s_price    = get_theme_mod( "buur_service{$i}_price",    $default_prices[ $i ] );
    $s_badge_on = (bool) get_theme_mod( "buur_service{$i}_badge_on", $default_badge_on[ $i ] );
    $s_badge    = get_theme_mod( "buur_service{$i}_badge",    $default_badges[ $i ] );
    $s_btn_type = get_theme_mod( "buur_service{$i}_btn_type", 'whatsapp' );
    $s_btn_url  = get_theme_mod( "buur_service{$i}_btn_url",  '' );

    // Résolution du lien final
    if ( $s_btn_type === 'custom' && ! empty( $s_btn_url ) ) {
        $s_btn_href   = esc_url( $s_btn_url );
        $s_btn_icon   = $link_icon;
        $s_btn_target = '_blank';
    } else {
        $s_btn_href   = esc_url( buur_whatsapp_url( 'fr' ) );
        $s_btn_icon   = $wa_icon;
        $s_btn_target = '_blank';
    }

    $features = array();
    for ( $f = 1; $f <= 4; $f++ ) :
        $feat = get_theme_mod( "buur_service{$i}_feat{$f}", '' );
        if ( $feat ) $features[] = $feat;
    endfor;
    if ( empty( $features ) ) $features = $default_features[ $i ];

    $cards[] = array(
        'index'      => $i,
        'order'      => $s_order,
        'title'      => $s_title,
        'desc'       => $s_desc,
        'price'      => $s_price,
        'badge_on'   => $s_badge_on,
        'badge'      => $s_badge,
        'features'   => $features,
        'btn_href'   => $s_btn_href,
        'btn_icon'   => $s_btn_icon,
        'btn_target' => $s_btn_target,
    );
endfor;

// Tri stable par ordre croissant
usort( $cards, function( $a, $b ) {
    return $a['order'] <=> $b['order'];
} );
?>

<section class="services-section" id="services" aria-label="Nos services">
    <div class="services-header">
        <span class="section-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
        <h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
    </div>

    <div class="services-grid" id="services-grid" role="list">
        <?php foreach ( $cards as $card ) :
            $i          = $card['index'];
            $s_title    = $card['title'];
            $s_desc     = $card['desc'];
            $s_price    = $card['price'];
            $s_badge_on = $card['badge_on'];
            $s_badge    = $card['badge'];
            $features   = $card['features'];
            $btn_href   = $card['btn_href'];
            $btn_icon   = $card['btn_icon'];
            $btn_target = $card['btn_target'];
            $has_badge  = $s_badge_on && ! empty( $s_badge );
        ?>
        <article
            class="service-card<?php echo $has_badge ? ' service-card--has-badge' : ''; ?>"
            role="listitem"
            aria-label="Service : <?php echo esc_attr( $s_title ); ?>"
            data-index="<?php echo $i - 1; ?>"
        >
            <?php if ( $has_badge ) : ?>
            <div class="service-card__badge" aria-label="<?php echo esc_attr( $s_badge ); ?>">
                <?php echo esc_html( $s_badge ); ?>
            </div>
            <?php endif; ?>

            <div class="card-service-icon" aria-hidden="true"><?php echo $icons[ $i ]; ?></div>

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
                        <span class="price-from"><?php echo $i === 4 ? 'Dès' : 'À partir de'; ?></span>
                        <?php endif; ?>
                        <span class="price-amount"><?php echo esc_html( $s_price ); ?></span>
                    </div>
                    <a href="<?php echo $btn_href; ?>" class="btn-card" target="<?php echo esc_attr( $btn_target ); ?>" rel="noopener noreferrer">
                        <?php echo $btn_icon; ?>
                        <?php echo $i === 4 ? 'Choisir cette formule' : 'Nous contacter'; ?>
                    </a>
                </div>
            </div>
        </article>
        <?php endforeach; ?>
    </div>

    <!-- Contrôles swiper mobile -->
    <div class="services-controls" id="services-controls" aria-label="Navigation carrousel services">
        <button class="services-arrow" id="srv-prev" aria-label="Service précédent" disabled>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
        </button>
        <div class="services-dots" role="tablist">
            <?php for ( $i = 0; $i < 4; $i++ ) : ?>
            <button class="services-dot <?php echo $i === 0 ? 'is-active' : ''; ?>" data-index="<?php echo $i; ?>" role="tab" aria-label="Service <?php echo $i + 1; ?>" aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"></button>
            <?php endfor; ?>
        </div>
        <button class="services-arrow" id="srv-next" aria-label="Service suivant">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
        </button>
    </div>
</section>
