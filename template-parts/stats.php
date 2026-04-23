<?php
/**
 * BUUR Digital — ACTE 4 : Chiffres clés
 * Bande dorée avec compteurs animés
 */

$stats = array(
    array( 'value' => '100%',        'label' => 'Satisfaction client',        'icon' => '★' ),
    array( 'value' => '150 000 FCFA', 'label' => 'Pour démarrer votre site',   'icon' => '◈' ),
    array( 'value' => '48h',         'label' => 'Délai de réponse garanti',    'icon' => '⚡' ),
    array( 'value' => '+50',         'label' => 'Projets livrés au Sénégal',  'icon' => '🦁' ),
);
?>

<section class="stats-section" aria-label="Chiffres clés">
    <div class="stats-inner">
        <?php foreach ( $stats as $stat ) : ?>
        <div class="stat-item">
            <span class="stat-icon" aria-hidden="true"><?php echo $stat['icon']; ?></span>
            <strong class="stat-value" data-value="<?php echo esc_attr( $stat['value'] ); ?>">
                <?php echo esc_html( $stat['value'] ); ?>
            </strong>
            <span class="stat-label"><?php echo esc_html( $stat['label'] ); ?></span>
        </div>
        <?php endforeach; ?>
    </div>
</section>
