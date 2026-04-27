/**
 * BUUR Digital — interactions.js
 * Micro-interactions UI + swiper carrousel services (mobile).
 */
(function () {
  'use strict';

  /* ============================================================
     1. BOUTONS WHATSAPP — ripple effect au clic
     ============================================================ */
  document.querySelectorAll('.btn-primary, .btn-outline').forEach(function (btn) {
    btn.addEventListener('click', function (e) {
      var rect   = btn.getBoundingClientRect();
      var circle = document.createElement('span');
      var size   = Math.max(rect.width, rect.height);
      circle.style.cssText = [
        'position:absolute',
        'border-radius:50%',
        'background:rgba(255,255,255,0.25)',
        'pointer-events:none',
        'transform:scale(0)',
        'animation:ripple 600ms ease-out forwards',
        'width:'  + size + 'px',
        'height:' + size + 'px',
        'left:'   + (e.clientX - rect.left  - size / 2) + 'px',
        'top:'    + (e.clientY - rect.top   - size / 2) + 'px',
      ].join(';');
      btn.style.position = 'relative';
      btn.style.overflow = 'hidden';
      btn.appendChild(circle);
      circle.addEventListener('animationend', function () { circle.remove(); });
    });
  });

  /* ============================================================
     2. SERVICES — carrousel scroll-snap sur mobile
     ============================================================ */
  var grid = document.getElementById('services-grid');
  var dots = document.querySelectorAll('.services-dot');

  if (!grid || !dots.length) return;

  // N'activer le JS de pagination qu'en mode mobile (flex-row)
  function isMobileCarousel() {
    return window.getComputedStyle(grid).overflowX === 'auto';
  }

  // Met à jour le point actif en fonction de la carte visible
  function updateDots() {
    if (!isMobileCarousel()) return;

    var cards      = grid.querySelectorAll('.service-card');
    var gridLeft   = grid.getBoundingClientRect().left;
    var closest    = 0;
    var minDist    = Infinity;

    cards.forEach(function (card, i) {
      var dist = Math.abs(card.getBoundingClientRect().left - gridLeft);
      if (dist < minDist) { minDist = dist; closest = i; }
    });

    dots.forEach(function (dot, i) {
      dot.classList.toggle('is-active', i === closest);
    });
  }

  // Scroll vers la carte correspondant au point cliqué
  dots.forEach(function (dot) {
    dot.addEventListener('click', function () {
      if (!isMobileCarousel()) return;
      var idx  = parseInt(dot.dataset.index, 10);
      var card = grid.querySelectorAll('.service-card')[idx];
      if (card) {
        card.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
      }
    });
  });

  // Mettre à jour les points au scroll (débouncé)
  var scrollTimer;
  grid.addEventListener('scroll', function () {
    clearTimeout(scrollTimer);
    scrollTimer = setTimeout(updateDots, 80);
  }, { passive: true });

  // Init
  updateDots();

  // Recalcul au resize
  window.addEventListener('resize', function () {
    clearTimeout(scrollTimer);
    scrollTimer = setTimeout(updateDots, 150);
  });

})();
