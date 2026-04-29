<?php
/**
 * Template Name: Tarifs
 * BUUR Digital — Page des tarifs premium
 */
get_header();
?>

<main id="main-content" class="tarifs-page">

  <!-- ══ HERO ══ -->
  <section class="tarifs-hero">
    <div class="tarifs-container">
      <div class="tarifs-hero__inner">
        <span class="tarifs-hero__eyebrow">NOS TARIFS</span>
        <h1 class="tarifs-hero__title">Des offres pensées pour chaque étape de votre croissance</h1>
        <p class="tarifs-hero__text">Choisissez la formule adaptée à votre budget et à vos ambitions : site vitrine, boutique en ligne, abonnement mensuel ou acquisition de clients avec Meta Ads.</p>
        <div class="tarifs-hero__actions">
          <a href="#tarifs-grid" class="tarifs-btn tarifs-btn--primary">Voir les offres</a>
          <a href="<?php echo esc_url( buur_whatsapp_url( 'fr' ) ); ?>" class="tarifs-btn tarifs-btn--secondary" target="_blank" rel="noopener">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.554 4.112 1.523 5.836L.057 23.882a.75.75 0 00.92.92l6.046-1.466A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22a9.944 9.944 0 01-5.073-1.389l-.363-.214-3.761.913.928-3.762-.232-.376A9.944 9.944 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
            Parler sur WhatsApp
          </a>
        </div>
        <div class="tarifs-hero__trust">
          <span class="tarifs-trust-item">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
            Tarifs clairs
          </span>
          <span class="tarifs-trust-item">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
            Sans surprise
          </span>
          <span class="tarifs-trust-item">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
            Accompagnement humain
          </span>
        </div>
      </div>
    </div>
  </section>

  <!-- ══ GRILLE DES OFFRES ══ -->
  <section class="tarifs-grid-section" id="tarifs-grid">
    <div class="tarifs-container">
      <div class="tarifs-grid">

        <!-- CARTE 1 : Site Vitrine -->
        <article class="tarif-card">
          <div class="tarif-badge tarif-badge--subtle">ONE SHOT</div>
          <h2 class="tarif-title">Site vitrine</h2>
          <div class="tarif-price">À partir de <strong>150 000 FCFA</strong></div>
          <div class="tarif-price-sub">Paiement unique</div>
          <p class="tarif-desc">Une présence en ligne simple, élégante et efficace pour présenter votre activité et rassurer vos clients.</p>

          <div class="tarif-list-title">Inclus</div>
          <ul class="tarif-list">
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>2 à 3 pages maximum</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Design BUUR personnalisé</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Responsive mobile et desktop</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Formulaire de contact</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Animations légères uniquement</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Hébergement inclus 1 an</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>1 série de retouches incluse</li>
          </ul>

          <div class="tarif-list-title tarif-list-title--cond">Conditions</div>
          <ul class="tarif-conditions">
            <li>Nom de domaine à la charge du client</li>
            <li>Pages supplémentaires : sur devis</li>
            <li>Animations avancées : sur devis</li>
            <li>Le délai démarre après réception de tous les contenus</li>
            <li>Délai moyen : 7 jours ouvrés</li>
          </ul>

          <div class="tarif-cta">
            <a href="<?php echo esc_url( buur_whatsapp_url( 'fr' ) ); ?>" class="tarifs-btn tarifs-btn--primary tarifs-btn--full" target="_blank" rel="noopener">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.554 4.112 1.523 5.836L.057 23.882a.75.75 0 00.92.92l6.046-1.466A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22a9.944 9.944 0 01-5.073-1.389l-.363-.214-3.761.913.928-3.762-.232-.376A9.944 9.944 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
              Démarrer ce projet
            </a>
          </div>
        </article>

        <!-- CARTE 2 : Site E-commerce -->
        <article class="tarif-card">
          <div class="tarif-badge tarif-badge--subtle">ONE SHOT</div>
          <h2 class="tarif-title">Site e-commerce</h2>
          <div class="tarif-price">À partir de <strong>250 000 FCFA</strong></div>
          <div class="tarif-price-sub">Paiement unique</div>
          <p class="tarif-desc">Une boutique en ligne prête à vendre avec un catalogue limité pour démarrer rapidement sans complexité inutile.</p>

          <div class="tarif-list-title">Inclus</div>
          <ul class="tarif-list">
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Jusqu'à 20 produits</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Design standard BUUR personnalisé</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Responsive mobile et desktop</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Paiement Wave / Orange Money</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Gestion des commandes</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Pages essentielles de la boutique</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Hébergement inclus 1 an</li>
          </ul>

          <div class="tarif-list-title tarif-list-title--cond">Conditions</div>
          <ul class="tarif-conditions">
            <li>Nom de domaine à la charge du client</li>
            <li>Au-delà de 20 produits : sur devis</li>
            <li>Fonctionnalités avancées : sur devis</li>
            <li>Livraison après réception des contenus et fiches produits</li>
            <li>Délai moyen : 10 à 14 jours ouvrés</li>
          </ul>

          <div class="tarif-cta">
            <a href="<?php echo esc_url( buur_whatsapp_url( 'fr' ) ); ?>" class="tarifs-btn tarifs-btn--primary tarifs-btn--full" target="_blank" rel="noopener">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.554 4.112 1.523 5.836L.057 23.882a.75.75 0 00.92.92l6.046-1.466A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22a9.944 9.944 0 01-5.073-1.389l-.363-.214-3.761.913.928-3.762-.232-.376A9.944 9.944 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
              Lancer ma boutique
            </a>
          </div>
        </article>

        <!-- CARTE 3 : Campagnes Meta -->
        <article class="tarif-card">
          <div class="tarif-badge tarif-badge--subtle">ACQUISITION</div>
          <h2 class="tarif-title">Campagnes Meta</h2>
          <div class="tarif-price"><strong>Sur devis</strong></div>
          <div class="tarif-price-sub">Selon objectif et budget publicitaire</div>
          <p class="tarif-desc">Attirez de nouveaux clients grâce à des campagnes Facebook et Instagram pensées pour votre marché et votre zone géographique.</p>

          <div class="tarif-list-title">Inclus</div>
          <ul class="tarif-list">
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Analyse du besoin</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Ciblage local</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Création des visuels</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Configuration de campagne</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Suivi des performances</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Rapport mensuel</li>
          </ul>

          <div class="tarif-list-title tarif-list-title--cond">Conditions</div>
          <ul class="tarif-conditions">
            <li>Budget publicitaire non inclus</li>
            <li>Les résultats dépendent du marché, de l'offre et du budget</li>
            <li>Accompagnement sur devis selon durée</li>
          </ul>

          <div class="tarif-cta">
            <a href="<?php echo esc_url( buur_whatsapp_url( 'fr' ) ); ?>" class="tarifs-btn tarifs-btn--primary tarifs-btn--full" target="_blank" rel="noopener">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.554 4.112 1.523 5.836L.057 23.882a.75.75 0 00.92.92l6.046-1.466A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22a9.944 9.944 0 01-5.073-1.389l-.363-.214-3.761.913.928-3.762-.232-.376A9.944 9.944 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
              Demander un devis
            </a>
          </div>
        </article>

        <!-- CARTE 4 : BUUR Site (featured) -->
        <article class="tarif-card tarif-card--featured">
          <div class="tarif-badge tarif-badge--featured">NOUVEAU</div>
          <h2 class="tarif-title">BUUR Site</h2>
          <div class="tarif-price">Dès <strong>17 000 FCFA / mois</strong></div>
          <div class="tarif-price-sub">Site par abonnement</div>
          <p class="tarif-desc">Vous envoyez vos informations et vos visuels, BUUR crée votre site, l'héberge et s'occupe des ajustements. Vous payez chaque mois, sans engagement.</p>

          <div class="tarif-list-title">Formules</div>
          <ul class="tarif-list tarif-list--formules">
            <li>
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
              <span><strong>Starter</strong> — 17 000 FCFA / mois — 1 à 2 pages</span>
            </li>
            <li>
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
              <span><strong>Standard</strong> — 25 000 FCFA / mois — 3 à 4 pages</span>
            </li>
            <li>
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
              <span><strong>Pro</strong> — 40 000 FCFA / mois — 5 à 7 pages</span>
            </li>
          </ul>

          <div class="tarif-list-title">Inclus</div>
          <ul class="tarif-list">
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Création du site</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Hébergement inclus</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Nom de domaine inclus</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Support WhatsApp</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Modifications selon la formule</li>
            <li><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Aucune compétence technique requise</li>
          </ul>

          <div class="tarif-list-title tarif-list-title--cond">Conditions</div>
          <ul class="tarif-conditions">
            <li>Le site reste propriété de BUUR</li>
            <li>Sans engagement</li>
            <li>En cas d'arrêt, le site est désactivé</li>
            <li>Toute demande hors formule peut être re-quotée</li>
          </ul>

          <div class="tarif-cta">
            <a href="<?php echo esc_url( buur_whatsapp_url( 'fr' ) ); ?>" class="tarifs-btn tarifs-btn--featured tarifs-btn--full" target="_blank" rel="noopener">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.554 4.112 1.523 5.836L.057 23.882a.75.75 0 00.92.92l6.046-1.466A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22a9.944 9.944 0 01-5.073-1.389l-.363-.214-3.761.913.928-3.762-.232-.376A9.944 9.944 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
              Choisir cette formule
            </a>
          </div>
        </article>

      </div>
    </div>
  </section>

  <!-- ══ COMPARAISON RAPIDE ══ -->
  <section class="tarifs-compare">
    <div class="tarifs-container">
      <h2 class="tarifs-compare__title">Quelle offre est faite pour vous ?</h2>
      <div class="tarifs-compare-grid">
        <div class="tarifs-compare-item">
          <p class="tarifs-compare-item__need">Je veux un site simple et être propriétaire</p>
          <span class="tarifs-compare-item__answer">→ Site vitrine</span>
        </div>
        <div class="tarifs-compare-item">
          <p class="tarifs-compare-item__need">Je veux vendre mes produits en ligne</p>
          <span class="tarifs-compare-item__answer">→ Site e-commerce</span>
        </div>
        <div class="tarifs-compare-item">
          <p class="tarifs-compare-item__need">Je veux plus de clients rapidement</p>
          <span class="tarifs-compare-item__answer">→ Campagnes Meta</span>
        </div>
        <div class="tarifs-compare-item">
          <p class="tarifs-compare-item__need">Je veux un site sans gros paiement de départ</p>
          <span class="tarifs-compare-item__answer">→ BUUR Site</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ══ FAQ ══ -->
  <section class="tarifs-faq">
    <div class="tarifs-container">
      <h2 class="tarifs-faq__title">Questions fréquentes</h2>
      <dl class="tarifs-faq-list">

        <div class="tarifs-faq-item">
          <dt class="tarifs-faq-item__q">Le nom de domaine est-il inclus ?</dt>
          <dd class="tarifs-faq-item__a">Pour les offres Site Vitrine et Site E-commerce, le nom de domaine est à la charge du client. Il est en revanche inclus dans l'offre BUUR Site.</dd>
        </div>

        <div class="tarifs-faq-item">
          <dt class="tarifs-faq-item__q">Puis-je demander des modifications après la livraison ?</dt>
          <dd class="tarifs-faq-item__a">Oui, une première série de retouches est incluse sur les offres one shot. Les demandes supplémentaires peuvent être facturées. Pour BUUR Site, les modifications sont gérées selon la formule choisie.</dd>
        </div>

        <div class="tarifs-faq-item">
          <dt class="tarifs-faq-item__q">Est-ce que tous les sites ont des animations ?</dt>
          <dd class="tarifs-faq-item__a">Non. Les offres d'entrée incluent uniquement des animations légères. Les animations avancées ou sur-mesure sont proposées sur devis.</dd>
        </div>

        <div class="tarifs-faq-item">
          <dt class="tarifs-faq-item__q">Que se passe-t-il si j'arrête BUUR Site ?</dt>
          <dd class="tarifs-faq-item__a">Le site étant proposé sous forme d'abonnement, il est désactivé à l'arrêt du service.</dd>
        </div>

        <div class="tarifs-faq-item">
          <dt class="tarifs-faq-item__q">Puis-je commencer petit puis évoluer plus tard ?</dt>
          <dd class="tarifs-faq-item__a">Oui. Vous pouvez démarrer avec un site vitrine simple ou BUUR Site, puis évoluer vers une formule plus complète.</dd>
        </div>

        <div class="tarifs-faq-item">
          <dt class="tarifs-faq-item__q">Combien de temps faut-il pour lancer un projet ?</dt>
          <dd class="tarifs-faq-item__a">Dès que tous les contenus sont fournis, un site simple peut être lancé rapidement. Le délai dépend du niveau de complexité du projet.</dd>
        </div>

      </dl>
    </div>
  </section>

  <!-- ══ CTA FINAL ══ -->
  <section class="tarifs-final-cta">
    <div class="tarifs-container">
      <div class="tarifs-final-cta__inner">
        <h2 class="tarifs-final-cta__title">Un projet en tête ?</h2>
        <p class="tarifs-final-cta__text">Expliquez-nous votre besoin sur WhatsApp et nous vous orienterons vers la formule la plus adaptée.</p>
        <a href="<?php echo esc_url( buur_whatsapp_url( 'fr' ) ); ?>" class="tarifs-btn tarifs-btn--primary tarifs-btn--lg" target="_blank" rel="noopener">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.554 4.112 1.523 5.836L.057 23.882a.75.75 0 00.92.92l6.046-1.466A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22a9.944 9.944 0 01-5.073-1.389l-.363-.214-3.761.913.928-3.762-.232-.376A9.944 9.944 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
          Parler sur WhatsApp
        </a>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>
