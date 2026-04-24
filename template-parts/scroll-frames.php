<?php
/**
 * BUUR Digital — Scroll Frames v4
 * 7 chapitres cinématiques avec cross-fade
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$sequences = [
  [ 'id'=>'v1','frames'=>192,'chapter'=>'01','title'=>'Stratégie <em>Digitale</em>',   'sub'=>'Une vision claire pour dominer votre marché en ligne.' ],
  [ 'id'=>'v2','frames'=>144,'chapter'=>'02','title'=>'Design <em>Premium</em>',        'sub'=>'Des interfaces qui captivent, engagent et convertissent.' ],
  [ 'id'=>'v3','frames'=>192,'chapter'=>'03','title'=>'Code <em>Sur-Mesure</em>',      'sub'=>'Rapide, propre, évolutif — construit pour durer.' ],
  [ 'id'=>'v4','frames'=>144,'chapter'=>'04','title'=>'SEO & <em>Performance</em>',    'sub'=>'Premier sur Google. Rapide sur tous les écrans.' ],
  [ 'id'=>'v5','frames'=>144,'chapter'=>'05','title'=>'E-<em>Commerce</em>',           'sub'=>'Votre boutique pensée pour vendre, 24h/24.' ],
  [ 'id'=>'v6','frames'=>144,'chapter'=>'06','title'=>'Support <em>Dédié</em>',        'sub'=>'Une équipe disponible pour faire grandir votre projet.' ],
  [ 'id'=>'v7','frames'=>193,'chapter'=>'07','title'=>'Résultats <em>Mesurables</em>', 'sub'=>'Chaque action optimisée. Chaque chiffre suivi.' ],
];
?>
<div class="scroll-frames-wrapper">
<?php foreach ( $sequences as $seq ) : ?>
  <section
    class="scroll-section-<?= esc_attr($seq['id']) ?> scroll-frame-section"
    id="scroll-<?= esc_attr($seq['id']) ?>"
    data-seq="<?= esc_attr($seq['id']) ?>"
    aria-label="Chapitre <?= esc_attr($seq['chapter']) ?>"
  >
    <div class="scroll-frame-inner">
      <canvas id="scroll-seq-<?= esc_attr($seq['id']) ?>" class="scroll-canvas" aria-hidden="true"></canvas>
      <div class="scroll-frame-overlay" aria-hidden="true">
        <div class="scroll-frame-content">
          <div class="scroll-frame-chapter"><?= esc_html($seq['chapter']) ?></div>
          <h2 class="scroll-frame-title"><?= $seq['title'] ?></h2>
          <p class="scroll-frame-sub"><?= esc_html($seq['sub']) ?></p>
        </div>
      </div>
      <div class="seq-loader-wrap" aria-hidden="true"><div class="seq-loader"></div></div>
    </div>
  </section>
<?php endforeach; ?>
</div>
