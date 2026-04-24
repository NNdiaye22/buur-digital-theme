<?php
/**
 * BUUR Digital — Stats
 * Chiffres clés sans emoji — icônes SVG inline
 */

$stats = array(
    array(
        'value' => '100%',
        'label' => 'Satisfaction client',
        'icon'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
    ),
    array(
        'value' => '150 000 FCFA',
        'label' => 'Pour démarrer votre site',
        'icon'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>',
    ),
    array(
        'value' => '48h',
        'label' => 'Délai de réponse garanti',
        'icon'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
    ),
    array(
        'value' => '+50',
        'label' => 'Projets livrés au Sénégal',
        'icon'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>',
    ),
);
?>

<section class="stats-section" aria-label="Chiffres clés">
    <div class="stats-inner">
        <?php foreach ( $stats as $stat ) : ?>
        <div class="stat-item reveal">
            <span class="stat-icon" aria-hidden="true"><?php echo $stat['icon']; ?></span>
            <strong class="stat-value"><?php echo esc_html( $stat['value'] ); ?></strong>
            <span class="stat-label"><?php echo esc_html( $stat['label'] ); ?></span>
        </div>
        <?php endforeach; ?>
    </div>
</section>
