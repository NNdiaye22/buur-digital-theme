/**
 * BUUR Digital — preloader.js
 * Preloader cinématique : texte progressif + disparition fluide
 */
(function () {
  'use strict';

  const overlay = document.getElementById('buur-preloader');
  if (!overlay) return;

  const steps = [
    'Initialisation...',
    'Chargement des assets...',
    'Construction du portail...',
    'BUUR DIGITAL',
  ];

  const label = overlay.querySelector('.preloader-label');
  const bar   = overlay.querySelector('.preloader-bar-fill');
  let current = 0;

  function next() {
    if (!label || !bar) return hide();
    label.textContent = steps[current];
    bar.style.width   = ((current + 1) / steps.length * 100) + '%';
    current++;
    if (current < steps.length) {
      setTimeout(next, current === steps.length - 1 ? 400 : 350);
    } else {
      setTimeout(hide, 600);
    }
  }

  function hide() {
    overlay.classList.add('is-hidden');
    overlay.addEventListener('transitionend', () => {
      overlay.remove();
      document.body.classList.remove('is-loading');
    }, { once: true });
  }

  document.body.classList.add('is-loading');
  setTimeout(next, 200);

})();
