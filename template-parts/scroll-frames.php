<?php
/**
 * BUUR Digital — Scroll Frames v7.0
 * Sticky canvas + overlay Notre ADN éditorial + overlay Nos Services
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$sf_services = array(
    array(
        'id'       => 'vitrine',
        'title'    => 'Site Vitrine',
        'desc'     => 'Une présence professionnelle en ligne qui inspire confiance et convertit vos visiteurs en clients.',
        'price'    => '150 000 FCFA',
        'featured' => false,
        'features' => array( 'Design premium sur mesure', 'Optimisé mobile & desktop', 'SEO local inclus', 'Livraison en 7 jours' ),
        'icon'     => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
    ),
    array(
        'id'       => 'ecommerce',
        'title'    => 'Site E-commerce',
        'desc'     => 'Vendez vos produits partout au Sénégal et en Afrique. Paiement mobile money, livraison, gestion de stock.',
        'price'    => '250 000 FCFA',
        'featured' => true,
        'features' => array( 'Boutique WooCommerce', 'Wave & Orange Money', 'Gestion des commandes', 'Formation incluse' ),
        'icon'     => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>',
    ),
    array(
        'id'       => 'campagnes',
        'title'    => 'Campagnes Meta',
        'desc'     => 'Publicités Facebook & Instagram ciblées. Plus de clients garantis en 2 semaines ou on continue gratuitement.',
        'price'    => 'Sur devis',
        'featured' => false,
        'features' => array( 'Ciblage hyper-local', 'Création des visuels', 'Suivi en temps réel', 'Rapport mensuel' ),
        'icon'     => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>',
    ),
);
?>

<div class="scroll-frames-wrapper" id="scroll-frames" aria-label="Nos expertises">
  <div class="scroll-frames-sticky">

    <canvas id="scroll-main-canvas" class="scroll-canvas" aria-hidden="true"></canvas>
    <div class="scroll-frame-overlay" aria-hidden="true"></div>

    <!-- ===== OVERLAY : NOTRE ADN — layout éditorial bas de page ===== -->
    <div id="sf-adn-overlay" class="sf-adn-overlay" aria-hidden="true">
      <div class="sf-adn-inner">

        <!-- En-tête : eyebrow + titre -->  
        <div class="sf-adn-header">
          <span class="sf-adn-eyebrow">NOTRE ADN</span>
          <h2 class="sf-adn-title">Pourquoi choisir <em>BUUR&nbsp;?</em></h2>
        </div>

        <!-- Grille 3 valeurs -->
        <div class="sf-adn-grid">

          <div class="sf-adn-valeur sf-adn-valeur--excellence">
            <span class="sf-adn-valeur-num">01</span>
            <div class="sf-adn-valeur-icon" aria-hidden="true">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <h3>Excellence</h3>
            <span class="sf-adn-valeur-rule" aria-hidden="true"></span>
            <p>Des sites qui rivalisent avec les meilleures agences internationales.</p>
          </div>

          <div class="sf-adn-valeur sf-adn-valeur--accessibilite">
            <span class="sf-adn-valeur-num">02</span>
            <div class="sf-adn-valeur-icon" aria-hidden="true">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
            </div>
            <h3>Accessibilité</h3>
            <span class="sf-adn-valeur-rule" aria-hidden="true"></span>
            <p>Prix transparents et honnêtes. Le luxe web pour tous les budgets.</p>
          </div>

          <div class="sf-adn-valeur sf-adn-valeur--innovation">
            <span class="sf-adn-valeur-num">03</span>
            <div class="sf-adn-valeur-icon" aria-hidden="true">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
            </div>
            <h3>Innovation</h3>
            <span class="sf-adn-valeur-rule" aria-hidden="true"></span>
            <p>Technologies de pointe : IA, animations 3D, vidéos génératives.</p>
          </div>

        </div><!-- /.sf-adn-grid -->
      </div><!-- /.sf-adn-inner -->
    </div><!-- /#sf-adn-overlay -->

    <!-- ===== OVERLAY : NOS SERVICES ===== -->
    <div id="sf-services-overlay" class="sf-services-overlay" aria-hidden="true">
      <div class="sf-services-inner">

        <div class="services-header">
          <span class="section-eyebrow">NOS SERVICES</span>
          <h2 class="section-title">Choisissez votre univers digital</h2>
        </div>

        <div class="services-grid">
          <?php foreach ( $sf_services as $service ) : ?>
          <article
            class="service-card <?php echo $service['featured'] ? 'service-card--featured' : ''; ?>"
            id="sf-service-<?php echo esc_attr( $service['id'] ); ?>"
            aria-label="Service : <?php echo esc_attr( $service['title'] ); ?>"
          >
            <div class="card-icon"><?php echo $service['icon']; ?></div>

            <?php if ( $service['featured'] ) : ?>
            <div class="service-card__badge">Populaire</div>
            <?php endif; ?>

            <h3 class="card-title"><?php echo esc_html( $service['title'] ); ?></h3>
            <p class="card-desc"><?php echo esc_html( $service['desc'] ); ?></p>

            <ul class="card-features" role="list">
              <?php foreach ( $service['features'] as $feat ) : ?>
              <li>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
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
              >En savoir plus &rarr;</a>
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
