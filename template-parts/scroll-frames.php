<?php
/**
 * BUUR Digital — scroll-frames.php v2
 * 7 sections cinématiques avec canvas + overlay premium
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$sequences = [
  [ 'id' => 'v1', 'frames' => 192, 'chapter' => '01', 'title' => 'Stratégie <span style="color:var(--orange)">Digitale</span>',    'sub' => 'Une vision claire pour dominer votre marché en ligne.' ],
  [ 'id' => 'v2', 'frames' => 144, 'chapter' => '02', 'title' => 'Design <span style="color:var(--orange)">Premium</span>',        'sub' => 'Des interfaces qui captivent, engagent et convertissent.' ],
  [ 'id' => 'v3', 'frames' => 192, 'chapter' => '03', 'title' => 'Code <span style="color:var(--orange)">Sur-Mesure</span>',       'sub' => 'Rapide, propre, évolutif — construit pour durer.' ],
  [ 'id' => 'v4', 'frames' => 144, 'chapter' => '04', 'title' => 'SEO & <span style="color:var(--orange)">Performance</span>',     'sub' => 'Premier sur Google. Rapide sur tous les écrans.' ],
  [ 'id' => 'v5', 'frames' => 144, 'chapter' => '05', 'title' => 'E-<span style="color:var(--orange)">Commerce</span>',            'sub' => 'Votre boutique pensée pour vendre, 24h/24.' ],
  [ 'id' => 'v6', 'frames' => 144, 'chapter' => '06', 'title' => 'Support <span style="color:var(--orange)">Dédié</span>',         'sub' => 'Une équipe disponible pour faire grandir votre projet.' ],
  [ 'id' => 'v7', 'frames' => 193, 'chapter' => '07', 'title' => 'Résultats <span style="color:var(--orange)">Mesurables</span>',  'sub' => 'Chaque action optimisée. Chaque chiffre suivi.' ],
];
?>

<div class="scroll-frames-wrapper">
<?php foreach ( $sequences as $i => $seq ) : ?>
  <section
    class="scroll-section-<?= esc_attr( $seq['id'] ) ?> scroll-frame-section"
    id="scroll-<?= esc_attr( $seq['id'] ) ?>"
    data-frames="<?= esc_attr( $seq['frames'] ) ?>"
    data-seq="<?= esc_attr( $seq['id'] ) ?>"
    aria-label="<?= esc_attr( 'Chapitre ' . $seq['chapter'] ) ?>"
  >
    <div class="scroll-frame-inner">

      <!-- Canvas animation -->
      <canvas
        id="scroll-seq-<?= esc_attr( $seq['id'] ) ?>"
        class="scroll-canvas"
        aria-hidden="true"
      ></canvas>

      <!-- Overlay texte -->
      <div class="scroll-frame-overlay" aria-hidden="true">
        <div class="scroll-frame-content">
          <div class="scroll-frame-chapter"><?= esc_html( $seq['chapter'] ) ?></div>
          <h2 class="scroll-frame-title"><?= $seq['title'] ?></h2>
          <p class="scroll-frame-sub"><?= esc_html( $seq['sub'] ) ?></p>
        </div>
      </div>

      <!-- Barre de chargement -->
      <div class="seq-loader-wrap" aria-hidden="true">
        <div class="seq-loader"></div>
      </div>

    </div>
  </section>
<?php endforeach; ?>
</div>
