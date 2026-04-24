<?php
/**
 * BUUR Digital — Scroll Frames v6.0
 * Sticky canvas CSS pur — pas de GSAP pin
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<!-- Wrapper hauteur totale : le canvas est sticky à l'intérieur -->
<div class="scroll-frames-wrapper" id="scroll-frames" aria-label="Nos expertises">

  <!-- Zone sticky : occupe 100vh, reste collée en haut pendant le scroll -->
  <div class="scroll-frames-sticky">

    <!-- Canvas frames -->
    <canvas id="scroll-main-canvas" class="scroll-canvas" aria-hidden="true"></canvas>

    <!-- Overlay gradient -->
    <div class="scroll-frame-overlay" aria-hidden="true"></div>

    <!-- Overlay services hologramme -->
    <div id="sf-services-overlay" class="sf-services-overlay" aria-hidden="true">
      <div class="sf-services-inner">
        <div class="sf-holo-scanlines" aria-hidden="true"></div>
        <div class="sf-services-label">NOS SERVICES</div>
        <div class="sf-services-cols">

          <div class="sf-col sf-col--1">
            <div class="sf-col-icon">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
            </div>
            <h3 class="sf-col-title">Site Vitrine</h3>
            <p class="sf-col-desc">Une présence professionnelle qui inspire confiance et convertit.</p>
            <ul class="sf-col-features">
              <li>Design premium sur mesure</li>
              <li>Optimisé mobile &amp; desktop</li>
              <li>SEO local inclus</li>
              <li>Livraison en 7 jours</li>
            </ul>
            <div class="sf-col-price"><span class="sf-price-from">À partir de</span><span class="sf-price-amount">150 000 FCFA</span></div>
          </div>

          <div class="sf-col sf-col--2 sf-col--featured">
            <div class="sf-col-badge">Populaire</div>
            <div class="sf-col-icon">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
            </div>
            <h3 class="sf-col-title">Site E-commerce</h3>
            <p class="sf-col-desc">Vendez vos produits en Afrique. Paiement mobile money inclus.</p>
            <ul class="sf-col-features">
              <li>Boutique WooCommerce</li>
              <li>Wave &amp; Orange Money</li>
              <li>Gestion des commandes</li>
              <li>Formation incluse</li>
            </ul>
            <div class="sf-col-price"><span class="sf-price-from">À partir de</span><span class="sf-price-amount">250 000 FCFA</span></div>
          </div>

          <div class="sf-col sf-col--3">
            <div class="sf-col-icon">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            </div>
            <h3 class="sf-col-title">Campagnes Meta</h3>
            <p class="sf-col-desc">Facebook &amp; Instagram ciblés. Plus de clients en 2 semaines.</p>
            <ul class="sf-col-features">
              <li>Ciblage hyper-local</li>
              <li>Création des visuels</li>
              <li>Suivi en temps réel</li>
              <li>Rapport mensuel</li>
            </ul>
            <div class="sf-col-price"><span class="sf-price-amount">Sur devis</span></div>
          </div>

        </div>
      </div>
    </div>

    <!-- Texte dynamique — bas gauche -->
    <div class="scroll-frame-content" role="region" aria-live="polite" aria-label="Chapitre en cours">
      <div class="scroll-frame-chapter" id="sf-chapter"></div>
      <h2  class="scroll-frame-title"   id="sf-title"></h2>
      <p   class="scroll-frame-sub"     id="sf-sub"></p>
    </div>

    <!-- Compteur -->
    <div class="scroll-frame-counter" id="sf-counter" aria-hidden="true"></div>

    <!-- Dots navigation -->
    <nav id="sf-progress" class="scroll-frames-progress" aria-label="Chapitres">
      <?php for ( $i = 1; $i <= 7; $i++ ) : ?>
      <button class="sf-dot progress-dot" aria-label="Chapitre 0<?php echo $i; ?>"></button>
      <?php endfor; ?>
    </nav>

    <!-- Loader -->
    <div id="sf-loader-wrap" class="seq-loader-wrap" aria-hidden="true">
      <div id="sf-loader-bar" class="seq-loader"></div>
    </div>

  </div><!-- /.scroll-frames-sticky -->
</div><!-- /.scroll-frames-wrapper -->
