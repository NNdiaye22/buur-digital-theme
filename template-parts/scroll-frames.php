<?php
/**
 * BUUR Digital — Scroll Frames v9.1
 * Overlay Notre ADN + Overlay Nos Services + Overlay CTA ch07 + Stat centrale
 */
if ( ! defined( 'ABSPATH' ) ) exit;

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
    4 => array(
        'title'    => 'BUUR Site',
        'desc'     => 'La solution tout-en-un pour les entrepreneurs pressés. Hébergement, maintenance et support inclus.',
        'price'    => 'Sur devis',
        'featured' => false,
        'features' => array( 'Solution tout-en-un', 'Hébergement inclus', 'Maintenance mensuelle', 'Support dédié' ),
        'icon'     => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
    ),
);

$sf_services = array();
for ( $i = 1; $i <= 4; $i++ ) :
    $d = $svc_defaults[ $i ];
    $img_id  = (int) get_theme_mod( "buur_service{$i}_bg_image", 0 );
    $img_url = '';
    if ( $img_id ) {
        $src = wp_get_attachment_image_src( $img_id, 'large' );
        if ( $src ) $img_url = $src[0];
    }
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

    <!-- ===== STAT CENTRALE ===== -->
    <div id="sf-stat-center" class="sf-stat-center" aria-hidden="true">
      <span class="sf-stat-rule" aria-hidden="true"></span>
      <span class="sf-stat-number"></span>
      <span class="sf-stat-label"></span>
    </div>

    <!-- ===== OVERLAY : NOTRE ADN ===== -->
    <div id="sf-adn-overlay" class="sf-adn-overlay" aria-hidden="true">
      <div class="sf-adn-inner">
        <div class="sf-adn-header">
          <span class="sf-adn-eyebrow"><?php echo esc_html( get_theme_mod( 'buur_adn_eyebrow', 'NOTRE ADN' ) ); ?></span>
          <h2 class="sf-adn-title"><?php
            $adn_title = get_theme_mod( 'buur_adn_title', 'Pourquoi choisir BUUR ?' );
            echo wp_kses(
                str_replace( 'BUUR', '<em>BUUR&nbsp;?</em>', esc_html( str_replace( 'BUUR ?', 'BUUR', $adn_title ) ) ),
                array( 'em' => array() )
            );
          ?></h2>
        </div>
        <div class="sf-adn-grid">
          <?php
          $adn_classes  = array( 1 => 'sf-adn-valeur--excellence', 2 => 'sf-adn-valeur--accessibilite', 3 => 'sf-adn-valeur--innovation' );
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
            <h3><?php echo esc_html( $c_title ); ?></h3>
            <span class="sf-adn-valeur-rule" aria-hidden="true"></span>
            <p><?php echo esc_html( $c_desc ); ?></p>
          </div>
          <?php endfor; ?>
        </div>
      </div>
    </div>

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
            <?php if ( $svc['img_url'] ) : ?>style="--card-bg: url('<?php echo esc_url( $svc['img_url'] ); ?>');"<?php endif; ?>
          >
            <?php if ( $svc['img_url'] ) : ?><div class="card-bg" aria-hidden="true"></div><?php endif; ?>
            <div class="card-icon"><?php echo $svc['icon']; ?></div>
            <?php if ( $svc['featured'] ) : ?><div class="service-card__badge">Populaire</div><?php endif; ?>
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
                <?php if ( $svc['price'] !== 'Sur devis' ) : ?><span class="price-from">À partir de</span><?php endif; ?>
                <span class="price-amount"><?php echo esc_html( $svc['price'] ); ?></span>
              </div>
              <a href="<?php echo esc_url( buur_whatsapp_url( 'fr' ) ); ?>" class="btn-card" target="_blank" rel="noopener noreferrer">En savoir plus &rarr;</a>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- ===== OVERLAY : CTA CH07 ===== -->
    <div id="sf-cta-overlay" class="sf-cta-overlay" aria-hidden="true">
      <div class="sf-cta-inner">
        <div class="sf-cta-content">
          <span class="sf-cta-eyebrow">PASSEZ À L'ACTION</span>
          <h2 class="sf-cta-title">Démarrons votre<br><em>projet ensemble.</em></h2>
          <p class="sf-cta-sub">Une équipe prête à vous accompagner. Premier échange offert, sans engagement.</p>
          <div class="sf-cta-buttons">
            <a href="<?php echo esc_url( buur_whatsapp_url( 'fr' ) ); ?>" class="sf-cta-btn sf-cta-btn--primary" target="_blank" rel="noopener noreferrer">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
              Nous contacter sur WhatsApp
            </a>
          </div>
        </div>
        <div class="sf-cta-stats">
          <div class="sf-cta-stat">
            <span class="sf-cta-stat-number">+50</span>
            <span class="sf-cta-stat-label">entrepreneurs accompagnés</span>
          </div>
          <div class="sf-cta-stat">
            <span class="sf-cta-stat-number">7 jours</span>
            <span class="sf-cta-stat-label">délai moyen de livraison</span>
          </div>
          <div class="sf-cta-stat">
            <span class="sf-cta-stat-number">100%</span>
            <span class="sf-cta-stat-label">des sites livrés mobile-first</span>
          </div>
        </div>
      </div>
    </div>

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

  </div>
</div>
