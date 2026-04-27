/**
 * BUUR Digital — interactions.js
 * Ripple sur boutons + swiper flèches & scroll-snap services (mobile).
 */
(function () {
  'use strict';

  /* ============================================================
     1. RIPPLE sur boutons primaires
     ============================================================ */
  document.querySelectorAll('.btn-primary, .btn-outline').forEach(function (btn) {
    btn.addEventListener('click', function (e) {
      var rect   = btn.getBoundingClientRect();
      var circle = document.createElement('span');
      var size   = Math.max(rect.width, rect.height);
      circle.style.cssText = [
        'position:absolute', 'border-radius:50%',
        'background:rgba(255,255,255,0.25)', 'pointer-events:none',
        'transform:scale(0)', 'animation:ripple 600ms ease-out forwards',
        'width:'  + size + 'px', 'height:' + size + 'px',
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
     2. SWIPER services — flèches + scroll-snap + points
     ============================================================ */
  var grid    = document.getElementById('services-grid');
  var btnPrev = document.getElementById('srv-prev');
  var btnNext = document.getElementById('srv-next');
  var dots    = document.querySelectorAll('.services-dot');

  if (!grid || !btnPrev || !btnNext) return;

  var cards      = Array.from(grid.querySelectorAll('.service-card'));
  var totalCards = cards.length;
  var current    = 0;

  function isMobile() {
    return window.getComputedStyle(grid).overflowX === 'auto';
  }

  /* Fait défiler vers la carte n° index */
  function goTo(index) {
    if (!isMobile()) return;
    index   = Math.max(0, Math.min(index, totalCards - 1));
    current = index;
    cards[index].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
    updateUI();
  }

  /* Met à jour flèches + points */
  function updateUI() {
    btnPrev.disabled = current === 0;
    btnNext.disabled = current === totalCards - 1;
    dots.forEach(function (dot, i) {
      var active = i === current;
      dot.classList.toggle('is-active', active);
      dot.setAttribute('aria-selected', active ? 'true' : 'false');
    });
  }

  /* Détecter la carte visible au scroll (débouncé) */
  function detectCurrent() {
    if (!isMobile()) return;
    var gridLeft = grid.getBoundingClientRect().left;
    var minDist  = Infinity;
    cards.forEach(function (card, i) {
      var dist = Math.abs(card.getBoundingClientRect().left - gridLeft);
      if (dist < minDist) { minDist = dist; current = i; }
    });
    updateUI();
  }

  /* Événements */
  btnPrev.addEventListener('click', function () { goTo(current - 1); });
  btnNext.addEventListener('click', function () { goTo(current + 1); });

  dots.forEach(function (dot) {
    dot.addEventListener('click', function () {
      goTo(parseInt(dot.dataset.index, 10));
    });
  });

  var scrollTimer;
  grid.addEventListener('scroll', function () {
    clearTimeout(scrollTimer);
    scrollTimer = setTimeout(detectCurrent, 80);
  }, { passive: true });

  window.addEventListener('resize', function () {
    clearTimeout(scrollTimer);
    scrollTimer = setTimeout(function () { current = 0; updateUI(); }, 150);
  });

  /* Init */
  updateUI();

})();
