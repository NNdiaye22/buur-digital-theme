<?php
/**
 * BUUR Digital — Scroll Frames v5
 * UN seul canvas, UN seul ScrollTrigger, textes dynamiques
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<section class="scroll-frames-wrapper" id="scroll-frames" aria-label="Nos expertises">

  <!-- Canvas principal (frames) -->
  <canvas id="scroll-main-canvas" class="scroll-canvas" aria-hidden="true"></canvas>
  <canvas id="scroll-main-canvas-b" class="scroll-canvas scroll-canvas-b" aria-hidden="true"></canvas>

  <!-- Overlay gradient -->
  <div class="scroll-frame-overlay" aria-hidden="true"></div>

  <!-- Contenu texte dynamique -->
  <div class="scroll-frame-content" role="region" aria-live="polite" aria-label="Chapitre en cours">
    <div class="scroll-frame-chapter" id="sf-chapter">01</div>
    <h2 class="scroll-frame-title"  id="sf-title">Stratégie <em>Digitale</em></h2>
    <p  class="scroll-frame-sub"    id="sf-sub">Une vision claire pour dominer votre marché en ligne.</p>
  </div>

  <!-- Progress dots (7 chapitres) -->
  <nav id="sf-progress" class="scroll-frames-progress" aria-label="Chapitres">
    <?php for ( $i = 1; $i <= 7; $i++ ) : ?>
    <button class="sf-dot progress-dot" aria-label="Chapitre 0<?php echo $i; ?>"></button>
    <?php endfor; ?>
  </nav>

  <!-- Loader barre -->
  <div id="sf-loader-wrap" class="seq-loader-wrap" aria-hidden="true">
    <div id="sf-loader-bar" class="seq-loader"></div>
  </div>

</section>
