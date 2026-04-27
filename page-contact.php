<?php
/**
 * Template Name: Contact
 * BUUR Digital — Page de contact premium v2
 */
get_header();
$wa_number = preg_replace( '/[^0-9]/', '', get_theme_mod( 'buur_whatsapp_fr', '+33000000000' ) );
$wa_msg    = rawurlencode( get_theme_mod( 'buur_whatsapp_msg', 'Bonjour, je souhaite en savoir plus sur vos services BUUR Digital.' ) );
?>

<main id="main-content" class="contact-page">

  <!-- ══ HERO ══ -->
  <section class="cp-hero">
    <div class="cp-hero__bg" aria-hidden="true"></div>
    <div class="cp-container">

      <div class="cp-hero__inner">
        <span class="cp-eyebrow">Contact</span>
        <h1 class="cp-hero__title">Parlons de votre<br><em>projet digital</em></h1>
        <p class="cp-hero__sub">Une question, un devis ou simplement envie d'échanger&nbsp;?<br>Nous vous répondons en moins de 48h.</p>

        <div class="cp-badges">
          <span class="cp-badge"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Réponse sous 48h</span>
          <span class="cp-badge"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Devis gratuit</span>
          <span class="cp-badge"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Sans engagement</span>
        </div>

        <!-- Infos rapides -->
        <div class="cp-quickinfo">
          <a href="mailto:contact@buurdigital.com" class="cp-quickinfo__item">
            <span class="cp-quickinfo__icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </span>
            <span>contact@buurdigital.com</span>
          </a>
          <a href="<?php echo esc_url( 'https://wa.me/' . $wa_number . '?text=' . $wa_msg ); ?>" class="cp-quickinfo__item" target="_blank" rel="noopener">
            <span class="cp-quickinfo__icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
            </span>
            <span>WhatsApp direct</span>
          </a>
          <div class="cp-quickinfo__item">
            <span class="cp-quickinfo__icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </span>
            <span>Lun–Ven 09h–18h</span>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ══ FORMULAIRE ══ -->
  <section class="cp-form-section">
    <div class="cp-container">
      <div class="cp-form-card">

        <div class="cp-form-card__header">
          <h2>Envoyez-nous un message</h2>
          <p>Tous les champs marqués <span aria-hidden="true">*</span> sont obligatoires.</p>
        </div>

        <?php if ( function_exists( 'wpcf7_enqueue_scripts' ) ) : ?>
          <?php echo do_shortcode( '[contact-form-7 id="contact-buur" title="Contact BUUR"]' ); ?>
        <?php else : ?>
        <form class="cp-form" id="buur-contact-form" novalidate>

          <div class="cp-form__row">
            <div class="cp-field">
              <input type="text" id="cf-nom" name="nom" placeholder=" " required autocomplete="name">
              <label for="cf-nom">Nom complet <span aria-hidden="true">*</span></label>
            </div>
            <div class="cp-field">
              <input type="email" id="cf-email" name="email" placeholder=" " required autocomplete="email">
              <label for="cf-email">Adresse e-mail <span aria-hidden="true">*</span></label>
            </div>
          </div>

          <div class="cp-form__row">
            <div class="cp-field">
              <input type="tel" id="cf-tel" name="telephone" placeholder=" " autocomplete="tel">
              <label for="cf-tel">Téléphone</label>
            </div>
            <div class="cp-field cp-field--select">
              <select id="cf-sujet" name="sujet" required>
                <option value="" disabled selected></option>
                <option value="devis">Demande de devis</option>
                <option value="site-web">Création de site web</option>
                <option value="reseaux-sociaux">Réseaux sociaux</option>
                <option value="marketing">Marketing digital</option>
                <option value="autre">Autre</option>
              </select>
              <label for="cf-sujet">Sujet <span aria-hidden="true">*</span></label>
            </div>
          </div>

          <div class="cp-field cp-field--textarea">
            <textarea id="cf-message" name="message" rows="5" placeholder=" " required></textarea>
            <label for="cf-message">Message <span aria-hidden="true">*</span></label>
          </div>

          <button type="submit" class="cp-submit">
            <span>Envoyer le message</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
          </button>

          <div class="cp-feedback" aria-live="polite" role="status"></div>
        </form>
        <?php endif; ?>

      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>
