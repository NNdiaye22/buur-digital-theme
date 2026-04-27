<?php
/**
 * BUUR Digital — Hero
 * Un seul bouton WhatsApp — numéro France.
 */

$bg_img_id = absint( get_theme_mod( 'buur_hero_bg_image', 0 ) );
$bg_img    = $bg_img_id ? wp_get_attachment_image_url( $bg_img_id, 'full' ) : '';
$badge     = get_theme_mod( 'buur_hero_badge',   'Dakar, Sénégal — Agence Web Premium' );
$title     = get_theme_mod( 'buur_hero_title',   "L'agence web des rois du digital" );
$tagline   = get_theme_mod( 'buur_hero_tagline',  "Des sites de classe mondiale, au prix de l'Afrique." );
$btn_fr    = get_theme_mod( 'buur_hero_btn_fr',   'Nous contacter' );
?>
<section class="hero-section" id="hero" aria-label="Hero BUUR Digital">

  <div class="hero-bg" aria-hidden="true">
    <?php if ( $bg_img ) : ?>
      <img class="hero-bg-img" src="<?php echo esc_url( $bg_img ); ?>" alt="" loading="eager" decoding="async" fetchpriority="high">
    <?php endif; ?>
    <div class="hero-overlay"></div>
  </div>

  <div class="hero-content">
    <div class="hero-badge">
      <span class="badge-dot"></span>
      <?php echo esc_html( $badge ); ?>
    </div>
    <h1 class="hero-title">
      <?php echo wp_kses( $title, array( 'em' => array(), 'br' => array(), 'strong' => array() ) ); ?>
    </h1>
    <p class="hero-tagline"><?php echo esc_html( $tagline ); ?></p>
    <div class="hero-cta">
      <a href="<?php echo esc_url( buur_whatsapp_url( 'fr' ) ); ?>" class="btn-primary btn-whatsapp" target="_blank" rel="noopener noreferrer">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.554 4.112 1.523 5.836L.057 23.882a.75.75 0 00.92.92l6.046-1.466A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22a9.944 9.944 0 01-5.073-1.389l-.363-.214-3.761.913.928-3.762-.232-.376A9.944 9.944 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
        <?php echo esc_html( $btn_fr ); ?>
      </a>
    </div>
  </div>

  <div class="hero-scroll-indicator" aria-hidden="true">
    <div class="scroll-line"></div>
    <span>Scroll</span>
  </div>

</section>
