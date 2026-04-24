<?php
/**
 * BUUR Digital — scroll-frames.php
 * 7 sections scroll-frame (canvas animé par scroll GSAP)
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$sequences = [
  [ 'id' => 'v1', 'frames' => 192, 'title' => 'Stratégie Digitale',    'sub' => 'Une vision claire pour votre présence en ligne.' ],
  [ 'id' => 'v2', 'frames' => 144, 'title' => 'Design Premium',        'sub' => 'Des interfaces qui captivent et convertissent.' ],
  [ 'id' => 'v3', 'frames' => 192, 'title' => 'Développement Sur-Mesure', 'sub' => 'Du code propre, rapide et évolutif.' ],
  [ 'id' => 'v4', 'frames' => 144, 'title' => 'SEO & Performance',     'sub' => 'Visible sur Google, rapide sur tous les devices.' ],
  [ 'id' => 'v5', 'frames' => 144, 'title' => 'E-Commerce',            'sub' => 'Vendez plus avec une boutique pensée pour convertir.' ],
  [ 'id' => 'v6', 'frames' => 144, 'title' => 'Maintenance & Support', 'sub' => 'Toujours disponibles pour faire grandir votre site.' ],
  [ 'id' => 'v7', 'frames' => 193, 'title' => 'Résultats Mesurables',  'sub' => 'Chaque action, chaque chiffre, optimisé pour vous.' ],
];
?>

<div class="scroll-frames-wrapper">
<?php foreach ( $sequences as $seq ) : ?>
  <section class="scroll-section-<?= esc_attr( $seq['id'] ) ?> scroll-frame-section" data-frames="<?= esc_attr( $seq['frames'] ) ?>" data-seq="<?= esc_attr( $seq['id'] ) ?>">
    <div class="scroll-frame-inner">
      <canvas id="scroll-seq-<?= esc_attr( $seq['id'] ) ?>" class="scroll-canvas" aria-hidden="true"></canvas>
      <div class="scroll-frame-overlay">
        <div class="scroll-frame-content">
          <h2 class="scroll-frame-title"><?= esc_html( $seq['title'] ) ?></h2>
          <p class="scroll-frame-sub"><?= esc_html( $seq['sub'] ) ?></p>
        </div>
      </div>
      <div class="seq-loader-wrap" aria-hidden="true">
        <div class="seq-loader"></div>
      </div>
    </div>
  </section>
<?php endforeach; ?>
</div>
