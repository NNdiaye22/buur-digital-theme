<?php
/**
 * BUUR Digital — ACTE 5 : Pourquoi BUUR ?
 * Lion royal + halo GSAP + 3 valeurs
 */
?>
<section class="pourquoi-section" id="pourquoi" aria-label="Pourquoi BUUR Digital">
    <div class="pourquoi-inner">

        <div class="pourquoi-visual">
            <div class="lion-wrap" id="lion-wrap">
                <div class="lion-halo" aria-hidden="true"></div>
                <img
                    src="<?php echo esc_url( BUUR_URI . '/assets/images/lion-royal.png' ); ?>"
                    alt="Lion royal — BUUR Digital"
                    class="lion-img"
                    loading="lazy"
                    width="480"
                    height="480"
                >
                <div class="lion-particles" aria-hidden="true"></div>
            </div>
            <p class="lion-caption" id="lion-caption" aria-label="BUUR signifie Roi en wolof">BUUR&nbsp;=&nbsp;ROI</p>
        </div>

        <div class="pourquoi-content">
            <span class="section-eyebrow">NOTRE ADN</span>
            <h2 class="section-title">Pourquoi choisir BUUR&nbsp;?</h2>
            <p class="pourquoi-intro">
                Nous sommes une agence née à Dakar, pour les entrepreneurs africains.
                Notre mission : des sites web de classe mondiale, au prix de l'Afrique.
            </p>

            <div class="valeurs-grid">
                <div class="valeur-item">
                    <div class="valeur-icon" aria-hidden="true">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </div>
                    <div>
                        <h3>Excellence</h3>
                        <p>Des sites qui rivalisent avec les meilleures agences internationales.</p>
                    </div>
                </div>
                <div class="valeur-item">
                    <div class="valeur-icon" aria-hidden="true">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
                    </div>
                    <div>
                        <h3>Accessibilité</h3>
                        <p>Prix transparents et honnêtes. Le luxe web pour tous les budgets.</p>
                    </div>
                </div>
                <div class="valeur-item">
                    <div class="valeur-icon" aria-hidden="true">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    </div>
                    <div>
                        <h3>Innovation</h3>
                        <p>Technologies de pointe : IA, animations 3D, vidéos génératives.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
