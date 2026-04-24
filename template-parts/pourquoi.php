<?php
/**
 * BUUR Digital — ACTE 5 : Pourquoi BUUR ?
 * Layout HUD Orbital — lion animé au centre, 3 valeurs positionnées
 */
?>
<section class="pourquoi-section" id="pourquoi" aria-label="Pourquoi BUUR Digital">

    <div class="pourquoi-hud">

        <!-- En-tête centré en haut -->
        <div class="pourquoi-header">
            <span class="section-eyebrow">NOTRE ADN</span>
            <h2 class="section-title">Pourquoi choisir BUUR&nbsp;?</h2>
        </div>

        <!-- Zone centrale — le lion animé est le fond (scroll-frames) -->
        <div class="pourquoi-orbital" id="lion-wrap">

            <!-- Halo pulsé autour du centre -->
            <div class="lion-halo" aria-hidden="true"></div>

            <!-- Connecteurs SVG HUD -->
            <svg class="hud-connectors" aria-hidden="true" viewBox="0 0 900 600" preserveAspectRatio="none">
                <!-- Excellence : haut-gauche vers centre -->
                <line class="hud-line" x1="200" y1="130" x2="450" y2="300"/>
                <!-- Accessibilité : bas-gauche vers centre -->
                <line class="hud-line" x1="200" y1="470" x2="450" y2="300"/>
                <!-- Innovation : droite vers centre -->
                <line class="hud-line" x1="700" y1="300" x2="450" y2="300"/>
            </svg>

            <!-- Valeur 1 : Excellence — haut gauche -->
            <div class="valeur-item valeur--excellence pourquoi-content" data-valeur="excellence">
                <div class="valeur-icon" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                </div>
                <div class="valeur-text">
                    <h3>Excellence</h3>
                    <p>Des sites qui rivalisent avec les meilleures agences internationales.</p>
                </div>
            </div>

            <!-- Valeur 2 : Accessibilité — bas gauche -->
            <div class="valeur-item valeur--accessibilite pourquoi-content" data-valeur="accessibilite">
                <div class="valeur-icon" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
                </div>
                <div class="valeur-text">
                    <h3>Accessibilité</h3>
                    <p>Prix transparents et honnêtes. Le luxe web pour tous les budgets.</p>
                </div>
            </div>

            <!-- Valeur 3 : Innovation — droite centré -->
            <div class="valeur-item valeur--innovation pourquoi-content" data-valeur="innovation">
                <div class="valeur-icon" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                </div>
                <div class="valeur-text">
                    <h3>Innovation</h3>
                    <p>Technologies de pointe : IA, animations 3D, vidéos génératives.</p>
                </div>
            </div>

        </div><!-- /.pourquoi-orbital -->

    </div><!-- /.pourquoi-hud -->

</section>
