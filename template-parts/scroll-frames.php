<?php
/**
 * BUUR Digital — Scroll Frames v7.1
 * Overlay Notre ADN (layout éditorial) + Overlay Nos Services (images customizer)
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* ---- données services depuis le customizer ---- */
$svc_eyebrow = get_theme_mod( 'buur_services_eyebrow', 'NOS SERVICES' );
$svc_title   = get_theme_mod( 'buur_services_title',   'Choisissez votre univers digital' );

$svc_defaults = array(
    1 => array(
        'title'    => 'Site Vitrine',
        'desc'     => 'Une présence professionnelle en ligne qui inspire confiance et convertit vos visiteurs en clients.',
        'price'    => '150 000 FCFA',
        'featured' => false,
        'features' => array( 'Design premium sur mesure', 'Optimisé mobile & desktop', 'SEO local inclus', 'Livraison en 7 jours' ),
        'icon'     => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
    ),
    2 => array(
        'title'    => 'Site E-commerce',
        'desc'     => 'Vendez vos produits partout au Sénégal et en Afrique. Paiement mobile money, livraison, gestion de stock.',
        'price'    => '250 000 FCFA',
        'featured' => true,
        'features' => array( 'Boutique WooCommerce', 'Wave & Orange Money', 'Gestion des commandes', 'Formation incluse' ),
        'icon'     => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>',
    ),
    3 => array(
        'title'    => 'Campagnes Meta',
        'desc'     => 'Publicités Facebook & Instagram ciblées. Plus de clients garantis en 2 semaines ou on continue gratuitement.',
        'price'    => 'Sur devis',
        'featured' => false,
        'features' => array( 'Ciblage hyper-local', 'Création des visuels', 'Suivi en temps réel', 'Rapport mensuel' ),
        'icon'     => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>',
    ),
);

$sf_services = array();
for ( $i = 1; $i <= 3; $i++ ) :
    $d = $svc_defaults[ $i ];

    /* image de fond depuis le customizer */
    $img_id  = (int) get_theme_mod( "buur_service{$i}_bg_image", 0 );
    $img_url = '';
    if ( $img_id ) {
        $src = wp_get_attachment_image_src( $img_id, 'large' );
        if ( $src ) $img_url = $src[0];
    }

    /* features */
    $features = array();
    for ( $f = 1; $f <= 4; $f++ ) :
        $feat = get_theme_mod( "buur_service{$i}_feat{$f}", '' );
        if ( $feat ) $features[] = $feat;
    endfor;
    if ( empty( $features ) ) $features = $d['features'];

    $sf_services[ $i ] = array(
        'title'    => get_theme_mod( "buur_service{$i}_title",    $d['title'] ),
        'desc'     => get_theme_mod( "buur_service{$i}_desc",     $d['desc'] ),
        'price'    => get_theme_mod( "buur_service{$i}_price",    $d['price'] ),
        'featured' => $d['featured'],
        'features' => $features,
        'icon'     => $d['icon'],
        'img_url'  => $img_url,
    );
endfor;
?>

<div class="scroll-frames-wrapper" id="scroll-frames" aria-label="Nos expertises">
  <div class="scroll-frames-sticky">

    <canvas id="scroll-main-canvas" class="scroll-canvas" aria-hidden="true"></canvas>
    <div class="scroll-frame-overlay" aria-hidden="true"></div>

    <!-- ===== OVERLAY : NOTRE ADN ===== -->
    <div id="sf-adn-overlay" class="sf-adn-overlay" aria-hidden="true">
      <div class="sf-adn-inner">

        <div class="sf-adn-header">
          <span class="sf-adn-eyebrow"><?php echo esc_html( get_theme_mod( 'buur_adn_eyebrow', 'NOTRE ADN' ) ); ?></span>
          <h2 class="sf-adn-title"><?php
            $adn_title = get_theme_mod( 'buur_adn_title', 'Pourquoi choisir BUUR ?' );
            /* Met en italique orange le mot "BUUR" s'il est présent */
            echo wp_kses(
                str_replace( 'BUUR', '<em>BUUR&nbsp;?</em>', esc_html( str_replace( 'BUUR ?', 'BUUR', $adn_title ) ) ),
                array( 'em' => array() )
            );
          ?></h2>
        </div>

        <div class="sf-adn-grid">
          <?php
          $adn_icons = array(
              1 => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
              2 => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>',
              3 => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
          );
          $adn_classes = array( 1 => 'sf-adn-valeur--excellence', 2 => 'sf-adn-valeur--accessibilite', 3 => 'sf-adn-valeur--innovation' );
          $adn_defaults = array(
              1 => array( 'Excellence',    'Des sites qui rivalisent avec les meilleures agences internationales.' ),
              2 => array( 'Accessibilité', 'Prix transparents et honnêtes. Le luxe web pour tous les budgets.' ),
              3 => array( 'Innovation',    'Technologies de pointe : IA, animations 3D, vidéos génératives.' ),
          );
          for ( $n = 1; $n <= 3; $n++ ) :
              $c_title = get_theme_mod( "buur_adn_card{$n}_title", $adn_defaults[ $n ][0] );
              $c_desc  = get_theme_mod( "buur_adn_card{$n}_desc",  $adn_defaults[ $n ][1] );
          ?>
          <div class="sf-adn-valeur <?php echo esc_attr( $adn_classes[ $n ] ); ?>">
            <span class="sf-adn-valeur-num">0<?php echo $n; ?></span>
            <div class="sf-adn-valeur-icon" aria-hidden="true"><?php echo $adn_icons[ $n ]; ?></div>
            <h3><?php echo esc_html( $c_title ); ?></h3>
            <span class="sf-adn-valeur-rule" aria-hidden="true"></span>
            <p><?php echo esc_html( $c_desc ); ?></p>
          </div>
          <?php endfor; ?>
        </div>

      </div>
    </div><!-- /#sf-adn-overlay -->

    <!-- ===== OVERLAY : NOS SERVICES ===== -->
    <div id="sf-services-overlay" class="sf-services-overlay" aria-hidden="true">
      <div class="sf-services-inner">

        <div class="services-header">
          <span class="section-eyebrow"><?php echo esc_html( $svc_eyebrow ); ?></span>
          <h2 class="section-title"><?php echo esc_html( $svc_title ); ?></h2>
        </div>

        <div class="services-grid">
          <?php foreach ( $sf_services as $i => $svc ) : ?>
          <article
            class="service-card <?php echo $svc['featured'] ? 'service-card--featured' : ''; ?>"
            aria-label="Service : <?php echo esc_attr( $svc['title'] ); ?>"
            <?php if ( $svc['img_url'] ) : ?>
            style="--card-bg: url('<?php echo esc_url( $svc['img_url'] ); ?>');"
            <?php endif; ?>
          >
            <?php if ( $svc['img_url'] ) : ?>
            <div class="card-bg" aria-hidden="true"></div>
            <?php endif; ?>

            <div class="card-icon"><?php echo $svc['icon']; ?></div>

            <?php if ( $svc['featured'] ) : ?>
            <div class="service-card__badge">Populaire</div>
            <?php endif; ?>

            <h3 class="card-title"><?php echo esc_html( $svc['title'] ); ?></h3>
            <p class="card-desc"><?php echo esc_html( $svc['desc'] ); ?></p>

            <ul class="card-features" role="list">
              <?php foreach ( $svc['features'] as $feat ) : ?>
              <li>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                <?php echo esc_html( $feat ); ?>
              </li>
              <?php endforeach; ?>
            </ul>

            <div class="card-footer">
              <div class="card-price">
                <?php if ( $svc['price'] !== 'Sur devis' ) : ?>
                <span class="price-from">À partir de</span>
                <?php endif; ?>
                <span class="price-amount"><?php echo esc_html( $svc['price'] ); ?></span>
              </div>
              <a href="<?php echo esc_url( buur_whatsapp_url( 'fr' ) ); ?>" class="btn-card" target="_blank" rel="noopener noreferrer">En savoir plus &rarr;</a>
            </div>
          </article>
          <?php endforeach; ?>
        </div>

      </div>
    </div><!-- /#sf-services-overlay -->

    <!-- Texte dynamique -->
    <div class="scroll-frame-content" role="region" aria-live="polite" aria-label="Chapitre en cours">
      <div class="scroll-frame-chapter" id="sf-chapter"></div>
      <h2  class="scroll-frame-title"  id="sf-title"></h2>
      <p   class="scroll-frame-sub"    id="sf-sub"></p>
    </div>

    <div class="scroll-frame-counter" id="sf-counter" aria-hidden="true"></div>

    <nav id="sf-progress" class="scroll-frames-progress" aria-label="Chapitres">
      <?php for ( $i = 1; $i <= 7; $i++ ) : ?>
      <button class="sf-dot progress-dot" aria-label="Chapitre 0<?php echo $i; ?>"></button>
      <?php endfor; ?>
    </nav>

    <div id="sf-loader-wrap" class="seq-loader-wrap" aria-hidden="true">
      <div id="sf-loader-bar" class="seq-loader"></div>
    </div>

  </div><!-- /.scroll-frames-sticky -->
</div><!-- /.scroll-frames-wrapper -->
