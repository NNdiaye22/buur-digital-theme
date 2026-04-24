<?php
/**
 * BUUR Digital — Scroll Frames v5.1
 * Canvas unique + texte dynamique GSAP + compteur
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<section class="scroll-frames-wrapper" id="scroll-frames" aria-label="Nos expertises">

  <!-- Canvas frames -->
  <canvas id="scroll-main-canvas" class="scroll-canvas" aria-hidden="true"></canvas>

  <!-- Overlay gradient -->
  <div class="scroll-frame-overlay" aria-hidden="true"></div>

  <!-- Texte dynamique — bas gauche -->
  <div class="scroll-frame-content" role="region" aria-live="polite" aria-label="Chapitre en cours">
    <div class="scroll-frame-chapter" id="sf-chapter"></div>
    <h2  class="scroll-frame-title"   id="sf-title"></h2>
    <p   class="scroll-frame-sub"     id="sf-sub"></p>
  </div>

  <!-- Compteur 01/07 — bas droit -->
  <div class="scroll-frame-counter" id="sf-counter" aria-hidden="true"></div>

  <!-- Dots navigation — droite -->
  <nav id="sf-progress" class="scroll-frames-progress" aria-label="Chapitres">
    <?php for ( $i = 1; $i <= 7; $i++ ) : ?>
    <button
      class="sf-dot progress-dot"
      aria-label="Chapitre 0<?php echo $i; ?>"
    ></button>
    <?php endfor; ?>
  </nav>

  <!-- Loader -->
  <div id="sf-loader-wrap" class="seq-loader-wrap" aria-hidden="true">
    <div id="sf-loader-bar" class="seq-loader"></div>
  </div>

</section>
