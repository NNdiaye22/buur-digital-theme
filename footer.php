<?php
/**
 * BUUR Digital — footer.php
 */
?>

<footer class="buur-footer" role="contentinfo">
    <div class="footer-inner">

        <div class="footer-brand">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo" aria-label="BUUR Digital">
                <?php buur_the_logo( false ); ?>
            </a>
            <p class="footer-tagline">
                <?php echo esc_html( buur_option( 'buur_hero_tagline', "L'excellence web, accessible à tous." ) ); ?>
            </p>
            <p class="footer-wolof">Buur = Roi en wolof</p>
        </div>

        <div class="footer-links">
            <div class="footer-col">
                <h4>Services</h4>
                <ul>
                    <li><a href="#services">Site Vitrine</a></li>
                    <li><a href="#services">Site E-commerce</a></li>
                    <li><a href="#services">Campagnes Meta</a></li>
                    <li><a href="#services">Google Ads</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>L'agence</h4>
                <ul>
                    <li><a href="#pourquoi">Pourquoi BUUR ?</a></li>
                    <li><a href="#temoignages">Témoignages</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Nous rejoindre</h4>
                <ul>
                    <li>
                        <a href="<?php echo esc_url( buur_whatsapp_url( 'sn' ) ); ?>" target="_blank" rel="noopener noreferrer">
                            WhatsApp Sénégal
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( buur_whatsapp_url( 'fr' ) ); ?>" target="_blank" rel="noopener noreferrer">
                            WhatsApp France
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date( 'Y' ); ?> BUUR Digital &mdash; Dakar, Sénégal. Tous droits réservés.</p>
        <nav aria-label="Liens légaux">
            <a href="<?php echo esc_url( get_privacy_policy_url() ); ?>">Politique de confidentialité</a>
        </nav>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
