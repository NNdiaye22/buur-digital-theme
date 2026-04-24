<?php
/**
 * BUUR Digital — Scroll Frames v6.3
 * Sticky canvas + overlay Services (ch06→ch07) + overlay Notre ADN (ch05→ch06)
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="scroll-frames-wrapper" id="scroll-frames" aria-label="Nos expertises">
  <div class="scroll-frames-sticky">

    <canvas id="scroll-main-canvas" class="scroll-canvas" aria-hidden="true"></canvas>
    <div class="scroll-frame-overlay" aria-hidden="true"></div>

    <!-- ===== OVERLAY : NOTRE ADN (fin ch05 → début ch06) ===== -->
    <div id="sf-adn-overlay" class="sf-adn-overlay" aria-hidden="true">

      <div class="sf-adn-header">
        <span class="sf-adn-eyebrow">NOTRE ADN</span>
        <h2 class="sf-adn-title">Pourquoi choisir <em>BUUR&nbsp;?</em></h2>
      </div>

      <div class="sf-adn-orbital">
        <div class="sf-adn-halo" aria-hidden="true"></div>

        <svg class="sf-adn-connectors" aria-hidden="true" viewBox="0 0 1000 620" preserveAspectRatio="none">
          <line class="sf-adn-line" x1="235" y1="145" x2="500" y2="310" />
          <line class="sf-adn-line" x1="235" y1="485" x2="500" y2="310" />
          <line class="sf-adn-line" x1="770" y1="310" x2="500" y2="310" />
        </svg>

        <div class="sf-adn-valeur sf-adn-valeur--excellence">
          <div class="sf-adn-valeur-icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          </div>
          <div>
            <h3>Excellence</h3>
            <p>Des sites qui rivalisent avec les meilleures agences internationales.</p>
          </div>
        </div>

        <div class="sf-adn-valeur sf-adn-valeur--accessibilite">
          <div class="sf-adn-valeur-icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
          </div>
          <div>
            <h3>Accessibilité</h3>
            <p>Prix transparents et honnêtes. Le luxe web pour tous les budgets.</p>
          </div>
        </div>

        <div class="sf-adn-valeur sf-adn-valeur--innovation">
          <div class="sf-adn-valeur-icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
          </div>
          <div>
            <h3>Innovation</h3>
            <p>Technologies de pointe : IA, animations 3D, vidéos génératives.</p>
          </div>
        </div>
      </div>

    </div><!-- /#sf-adn-overlay -->

    <!-- ===== OVERLAY : NOS SERVICES (fin ch06 → début ch07) ===== -->
    <div id="sf-services-overlay" class="sf-services-overlay" aria-hidden="true">
      <div class="sf-services-inner">
        <div class="sf-holo-scanlines" aria-hidden="true"></div>
        <div class="sf-services-label">NOS SERVICES</div>
        <div class="sf-services-cols">

          <div class="sf-col sf-col--1">
            <div class="sf-col-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div>
            <h3 class="sf-col-title">Site Vitrine</h3>
            <p class="sf-col-desc">Une présence professionnelle qui inspire confiance et convertit.</p>
            <ul class="sf-col-features">
              <li>Design premium sur mesure</li><li>Optimisé mobile &amp; desktop</li><li>SEO local inclus</li><li>Livraison en 7 jours</li>
            </ul>
            <div class="sf-col-price"><span class="sf-price-from">À partir de</span><span class="sf-price-amount">150 000 FCFA</span></div>
          </div>

          <div class="sf-col sf-col--2 sf-col--featured">
            <div class="sf-col-badge">Populaire</div>
            <div class="sf-col-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg></div>
            <h3 class="sf-col-title">Site E-commerce</h3>
            <p class="sf-col-desc">Vendez vos produits en Afrique. Paiement mobile money inclus.</p>
            <ul class="sf-col-features">
              <li>Boutique WooCommerce</li><li>Wave &amp; Orange Money</li><li>Gestion des commandes</li><li>Formation incluse</li>
            </ul>
            <div class="sf-col-price"><span class="sf-price-from">À partir de</span><span class="sf-price-amount">250 000 FCFA</span></div>
          </div>

          <div class="sf-col sf-col--3">
            <div class="sf-col-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
            <h3 class="sf-col-title">Campagnes Meta</h3>
            <p class="sf-col-desc">Facebook &amp; Instagram ciblés. Plus de clients en 2 semaines.</p>
            <ul class="sf-col-features">
              <li>Ciblage hyper-local</li><li>Création des visuels</li><li>Suivi en temps réel</li><li>Rapport mensuel</li>
            </ul>
            <div class="sf-col-price"><span class="sf-price-amount">Sur devis</span></div>
          </div>

        </div>
      </div>
    </div><!-- /#sf-services-overlay -->

    <!-- Texte dynamique -->
    <div class="scroll-frame-content" role="region" aria-live="polite" aria-label="Chapitre en cours">
      <div class="scroll-frame-chapter" id="sf-chapter"></div>
      <h2  class="scroll-frame-title"   id="sf-title"></h2>
      <p   class="scroll-frame-sub"     id="sf-sub"></p>
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
