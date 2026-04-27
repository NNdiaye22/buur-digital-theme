<?php
/**
 * BUUR Digital — footer.php v2 Premium
 */
?>
  </main><!-- #primary -->

  <footer class="site-footer" role="contentinfo">
    <div class="footer-inner">

      <div class="footer-brand">
        <?php if ( function_exists('buur_logo') ) : ?>
          <?php buur_logo(); ?>
        <?php else : ?>
          <div class="site-logo-text"><span class="logo-buur">BUUR</span><span class="logo-digital">Digital</span></div>
        <?php endif; ?>
        <p class="footer-tagline">L'agence web des rois du digital. Dakar, Sénégal.</p>
      </div>

      <div class="footer-col">
        <p class="footer-heading">Navigation</p>
        <nav class="footer-links" aria-label="Liens footer">
          <a href="#services">Nos services</a>
          <a href="#pourquoi">Pourquoi BUUR</a>
          <a href="#temoignages">Témoignages</a>
          <a href="#contact">Contact</a>
        </nav>
      </div>

      <div class="footer-col">
        <p class="footer-heading">Services</p>
        <nav class="footer-links" aria-label="Services">
          <a href="#services">Site Vitrine</a>
          <a href="#services">Site E-commerce</a>
          <a href="#services">Campagnes Meta</a>
          <a href="#services">SEO &amp; Performance</a>
        </nav>
      </div>

      <div class="footer-col">
        <p class="footer-heading">Contact</p>
        <div class="footer-contact">
          <a href="<?php echo esc_url( buur_whatsapp_url('fr') ); ?>" target="_blank" rel="noopener noreferrer">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/></svg>
            WhatsApp
          </a>
        </div>
      </div>

    </div>

    <div class="footer-bottom">
      <p class="footer-copy">&copy; <?php echo date('Y'); ?> BUUR Digital &mdash; Tous droits réservés.</p>
      <p class="footer-legal">
        <a href="/mentions-legales">Mentions légales</a>
        &nbsp;&middot;&nbsp;
        <a href="/politique-de-confidentialite">Confidentialité</a>
      </p>
    </div>
  </footer>

<?php wp_footer(); ?>
</body>
</html>
