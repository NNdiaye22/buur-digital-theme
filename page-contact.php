<?php
/**
 * Template Name: Contact
 * BUUR Digital — Page de contact premium
 * @updated 2026-04-27
 */
get_header();
$wa_number = preg_replace( '/[^0-9]/', '', get_theme_mod( 'buur_whatsapp_fr', '+33000000000' ) );
$wa_msg    = rawurlencode( get_theme_mod( 'buur_whatsapp_msg', 'Bonjour, je souhaite en savoir plus sur vos services BUUR Digital.' ) );
?>

<main id="main-content" class="contact-page">

  <!-- Hero contact -->
  <section class="contact-hero">
    <div class="container">
      <span class="section-eyebrow">Contact</span>
      <h1 class="contact-hero__title">Parlons de votre<br><em>projet digital</em></h1>
      <p class="contact-hero__sub">Une question, un devis ou simplement envie d'echanger&nbsp;?
      Repondons-nous en moins de 48h.</p>
    </div>
  </section>

  <!-- Grille principale -->
  <section class="contact-main">
    <div class="container contact-grid">

      <!-- Formulaire -->
      <div class="contact-form-wrap reveal">
        <h2 class="contact-form-wrap__title">Envoyez-nous un message</h2>

        <?php if ( function_exists( 'wpcf7_enqueue_scripts' ) ) : ?>
          <?php echo do_shortcode( '[contact-form-7 id="contact-buur" title="Contact BUUR"]' ); ?>
        <?php else : ?>
        <form class="buur-form" id="buur-contact-form" novalidate>

          <div class="form-row">
            <div class="form-group">
              <label for="cf-nom">Nom complet <span aria-hidden="true">*</span></label>
              <input type="text" id="cf-nom" name="nom" placeholder="Jean Dupont" required autocomplete="name">
              <span class="form-error" aria-live="polite"></span>
            </div>
            <div class="form-group">
              <label for="cf-email">Adresse e-mail <span aria-hidden="true">*</span></label>
              <input type="email" id="cf-email" name="email" placeholder="jean@exemple.com" required autocomplete="email">
              <span class="form-error" aria-live="polite"></span>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="cf-tel">Telephone</label>
              <input type="tel" id="cf-tel" name="telephone" placeholder="+33 6 00 00 00 00" autocomplete="tel">
            </div>
            <div class="form-group">
              <label for="cf-sujet">Sujet <span aria-hidden="true">*</span></label>
              <select id="cf-sujet" name="sujet" required>
                <option value="" disabled selected>Selectionnez un sujet</option>
                <option value="devis">Demande de devis</option>
                <option value="site-web">Creation de site web</option>
                <option value="reseaux-sociaux">Reseaux sociaux</option>
                <option value="marketing">Marketing digital</option>
                <option value="autre">Autre</option>
              </select>
              <span class="form-error" aria-live="polite"></span>
            </div>
          </div>

          <div class="form-group">
            <label for="cf-message">Message <span aria-hidden="true">*</span></label>
            <textarea id="cf-message" name="message" rows="6" placeholder="Decrivez votre projet, vos besoins..." required></textarea>
            <span class="form-error" aria-live="polite"></span>
          </div>

          <button type="submit" class="btn-primary btn-lg contact-submit">
            <span class="btn-label">Envoyer le message</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
          </button>

          <div class="form-feedback" aria-live="polite" role="status"></div>
        </form>
        <?php endif; ?>
      </div>

      <!-- Infos de contact -->
      <aside class="contact-info reveal reveal-delay-2">

        <div class="contact-info__block">
          <span class="contact-info__label">Adresse</span>
          <address class="contact-info__value">
            Hann Mariste, Lot P53<br>
            Croisement Camberene<br>
            Dakar &mdash; Senegal
          </address>
        </div>

        <div class="contact-info__block">
          <span class="contact-info__label">Horaires</span>
          <p class="contact-info__value">Lun &mdash; Ven&nbsp;: 09h &ndash; 18h<br>Samedi&nbsp;: 09h &ndash; 13h</p>
        </div>

        <div class="contact-info__block">
          <span class="contact-info__label">E-mail</span>
          <a href="mailto:contact@buurdigital.com" class="contact-info__link">contact@buurdigital.com</a>
        </div>

        <!-- WhatsApp CTA -->
        <a
          href="<?php echo esc_url( 'https://wa.me/' . $wa_number . '?text=' . $wa_msg ); ?>"
          class="btn-whatsapp"
          target="_blank"
          rel="noopener noreferrer"
          aria-label="Contacter BUUR Digital sur WhatsApp"
        >
          <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
          Contacter sur WhatsApp
        </a>

        <!-- Carte Google Maps — Hann Mariste, Dakar -->
        <div class="contact-map">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3859.6!2d-17.4432!3d14.7395!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sMPS+S%C3%A9n%C3%A9gal+-+Hann+Mariste!5e0!3m2!1sfr!2sfr!4v1"
            width="100%"
            height="220"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="Localisation BUUR Digital — Hann Mariste, Dakar"
          ></iframe>
        </div>

      </aside>
    </div>
  </section>

</main>

<?php get_footer(); ?>
