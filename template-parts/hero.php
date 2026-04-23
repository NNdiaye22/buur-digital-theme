<?php
/**
 * BUUR Digital — ACTE 1 : Hero
 * Fond vidéo hero-loop.mp4 + canvas Three.js tunnel
 */
?>
<section class="hero-section" id="hero" aria-label="Hero BUUR Digital">

    <!-- Fond vidéo --- chargé en JS via video-manager.js pour lazy loading -->
    <div class="hero-video-bg" aria-hidden="true">
        <video
            class="hero-video"
            data-src="<?php echo esc_url( BUUR_URI . '/assets/videos/hero-loop.mp4' ); ?>"
            autoplay
            muted
            loop
            playsinline
            preload="none"
            aria-hidden="true"
        ></video>
        <div class="hero-overlay"></div>
    </div>

    <!-- Canvas Three.js tunnel (anim au scroll) -->
    <canvas class="hero-canvas" id="hero-canvas" aria-hidden="true"></canvas>

    <!-- Contenu Hero -->
    <div class="hero-content">

        <div class="hero-badge" aria-label="Localisation">
            <span class="badge-dot"></span>
            Dakar, Sénégal
        </div>

        <h1 class="hero-title" id="hero-title">
            <?php
            $title = buur_option( 'buur_hero_title', "L'AGENCE WEB DES ROIS DU DIGITAL" );
            echo nl2br( esc_html( $title ) );
            ?>
        </h1>

        <p class="hero-tagline" id="hero-tagline">
            <?php echo esc_html( buur_option( 'buur_hero_tagline', "L'excellence web, accessible à tous." ) ); ?>
        </p>

        <div class="hero-cta" role="group" aria-label="Actions principales">
            <a
                href="<?php echo esc_url( buur_whatsapp_url( 'sn' ) ); ?>"
                class="btn-primary btn-whatsapp"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Contacter BUUR Digital sur WhatsApp Sénégal"
            >
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/></svg>
                WhatsApp Sénégal
            </a>
            <a
                href="<?php echo esc_url( buur_whatsapp_url( 'fr' ) ); ?>"
                class="btn-outline btn-whatsapp"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Contacter BUUR Digital sur WhatsApp France"
            >
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/></svg>
                WhatsApp France
            </a>
        </div>

        <div class="hero-scroll-indicator" aria-hidden="true">
            <div class="scroll-line"></div>
            <span>Scroll</span>
        </div>

    </div>

</section>
