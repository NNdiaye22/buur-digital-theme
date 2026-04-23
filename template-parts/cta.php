<?php
/**
 * BUUR Digital — ACTE 7 : CTA Final
 * Fond vidéo cta-portal.mp4 + titre + 2 boutons WhatsApp
 */
?>
<section class="cta-section" id="contact" aria-label="Rejoindre BUUR Digital">

    <!-- Fond vidéo -->
    <div class="cta-video-bg" aria-hidden="true">
        <video
            class="cta-video"
            data-src="<?php echo esc_url( BUUR_URI . '/assets/videos/cta-portal.mp4' ); ?>"
            autoplay muted loop playsinline preload="none"
        ></video>
        <div class="cta-overlay"></div>
    </div>

    <div class="cta-content">

        <span class="section-eyebrow">REJOINS LE ROYAUME</span>

        <h2 class="cta-title" id="cta-title">
            Démarrons votre projet<br>
            <em>aujourd’hui.</em>
        </h2>

        <p class="cta-sub">
            Un message WhatsApp suffit. Réponse garantie en moins de 24h.
        </p>

        <div class="cta-buttons" role="group" aria-label="Contacts WhatsApp">
            <a
                href="<?php echo esc_url( buur_whatsapp_url( 'sn' ) ); ?>"
                class="btn-primary btn-whatsapp btn-lg"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="WhatsApp Sénégal"
            >
                <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.554 4.112 1.523 5.836L.057 23.882a.75.75 0 00.92.92l6.046-1.466A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22a9.944 9.944 0 01-5.073-1.389l-.363-.214-3.761.913.928-3.762-.232-.376A9.944 9.944 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
                WhatsApp Sénégal
            </a>
            <a
                href="<?php echo esc_url( buur_whatsapp_url( 'fr' ) ); ?>"
                class="btn-outline btn-whatsapp btn-lg"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="WhatsApp France"
            >
                <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.554 4.112 1.523 5.836L.057 23.882a.75.75 0 00.92.92l6.046-1.466A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22a9.944 9.944 0 01-5.073-1.389l-.363-.214-3.761.913.928-3.762-.232-.376A9.944 9.944 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
                WhatsApp France
            </a>
        </div>

    </div>

</section>
