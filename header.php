<?php
/**
 * BUUR Digital — header.php
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0a0a0a">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<nav class="buur-nav" id="buur-nav" role="navigation" aria-label="Navigation principale">
    <div class="nav-inner">

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo" aria-label="BUUR Digital — Accueil">
            <?php buur_the_logo(); ?>
        </a>

        <ul class="nav-links" role="list">
            <li><a href="#services">Services</a></li>
            <li><a href="#pourquoi">BUUR ?</a></li>
            <li><a href="#temoignages">Témoignages</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>

        <div class="nav-cta">
            <a href="<?php echo esc_url( buur_whatsapp_url( 'sn' ) ); ?>" class="btn-primary" target="_blank" rel="noopener noreferrer">
                <span>Démarrer</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                    <path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.554 4.112 1.523 5.836L.057 23.882a.75.75 0 00.92.92l6.046-1.466A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22a9.944 9.944 0 01-5.073-1.389l-.363-.214-3.761.913.928-3.762-.232-.376A9.944 9.944 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
                </svg>
            </a>
        </div>

        <button class="nav-burger" id="nav-burger" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="nav-mobile">
            <span></span><span></span><span></span>
        </button>

    </div>

    <div class="nav-mobile" id="nav-mobile" aria-hidden="true">
        <ul role="list">
            <li><a href="#services">Services</a></li>
            <li><a href="#pourquoi">BUUR ?</a></li>
            <li><a href="#temoignages">Témoignages</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <div class="mobile-cta">
            <a href="<?php echo esc_url( buur_whatsapp_url( 'sn' ) ); ?>" class="btn-primary" target="_blank" rel="noopener noreferrer">WhatsApp Sénégal</a>
            <a href="<?php echo esc_url( buur_whatsapp_url( 'fr' ) ); ?>" class="btn-outline" target="_blank" rel="noopener noreferrer">WhatsApp France</a>
        </div>
    </div>
</nav>
