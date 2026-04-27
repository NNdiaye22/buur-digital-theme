/**
 * BUUR — svc-swiper.js v1.0
 * Swiper horizontal natif pour les cartes services dans l'overlay scroll-frames.
 * - Swipe horizontal → cartes (le scroll vertical de page est préservé).
 * - Les dots de pagination sont injectés automatiquement.
 * - Aucune librairie externe requise.
 */
(function () {
  'use strict';

  function init() {
    var grid = document.querySelector('#sf-services-overlay .services-grid');
    if (!grid) return;

    var cards = Array.prototype.slice.call(grid.querySelectorAll('.service-card'));
    if (!cards.length) return;

    /* Crée les dots sous la grille */
    var dotsWrap = document.createElement('div');
    dotsWrap.className = 'svc-swiper-dots';
    cards.forEach(function (_, i) {
      var dot = document.createElement('button');
      dot.className = 'svc-swiper-dot' + (i === 0 ? ' is-active' : '');
      dot.setAttribute('aria-label', 'Carte ' + (i + 1));
      dot.addEventListener('click', function () {
        grid.scrollTo({ left: cards[i].offsetLeft - grid.offsetLeft, behavior: 'smooth' });
      });
      dotsWrap.appendChild(dot);
    });
    grid.parentNode.insertBefore(dotsWrap, grid.nextSibling);

    var dotEls = Array.prototype.slice.call(dotsWrap.querySelectorAll('.svc-swiper-dot'));

    /* Met à jour le dot actif au scroll */
    var ticking = false;
    grid.addEventListener('scroll', function () {
      if (ticking) return;
      ticking = true;
      requestAnimationFrame(function () {
        ticking = false;
        var scrollLeft = grid.scrollLeft;
        var closest = 0;
        var minDist = Infinity;
        cards.forEach(function (card, i) {
          var dist = Math.abs(card.offsetLeft - grid.offsetLeft - scrollLeft);
          if (dist < minDist) { minDist = dist; closest = i; }
        });
        dotEls.forEach(function (d, j) { d.classList.toggle('is-active', j === closest); });
      });
    }, { passive: true });

    /*
     * Gestion du conflit scroll horizontal/vertical.
     * Sur mobile, quand le swipe est majoritairement horizontal (δx > δy),
     * on bloque le scroll vertical de la page LE TEMPS du swipe.
     * Quand c'est vertical (δy > δx), on ne fait rien — le scroll de page se
     * déclenche normalement via le mécanisme du wrapper sticky.
     */
    var startX = 0, startY = 0, isHorizontal = null;

    grid.addEventListener('touchstart', function (e) {
      startX = e.touches[0].clientX;
      startY = e.touches[0].clientY;
      isHorizontal = null;
    }, { passive: true });

    grid.addEventListener('touchmove', function (e) {
      if (isHorizontal === null) {
        var dx = Math.abs(e.touches[0].clientX - startX);
        var dy = Math.abs(e.touches[0].clientY - startY);
        if (dx > 6 || dy > 6) isHorizontal = dx > dy;
      }
      /* Si horizontal, on consomme l'event pour éviter que le scroll de page
         n'intercepte le geste — mais scroll-snap natif gère le défilement. */
      if (isHorizontal) e.stopPropagation();
      /* Si vertical, on n'appelle PAS preventDefault()
         pour laisser le scroll de page fonctionner. */
    }, { passive: true });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
