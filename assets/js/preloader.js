/**
 * BUUR Digital — preloader.js
 * Animation : défilement vertical des mots "roi" dans différentes langues
 * Séquence : BUUR → ROI → MAAD → ATEY → KING → LAAMƊO → BUUR
 */
(function () {
  'use strict';

  const overlay = document.getElementById('buur-preloader');
  if (!overlay) return;

  const words = ['BUUR', 'ROI', 'MAAD', 'ATEY', 'KING', 'LAAMƊO', 'BUUR'];
  const bar = overlay.querySelector('.preloader-bar-fill');
  const slot = overlay.querySelector('.preloader-word-slot');

  if (!slot) return;

  let index = 0;

  function setWord(word, animate) {
    if (animate) {
      slot.classList.remove('slide-in');
      void slot.offsetWidth; // reflow
      slot.classList.add('slide-in');
    }
    slot.textContent = word;
  }

  function next() {
    if (index >= words.length) {
      // Mettre à jour la barre à 100% et masquer
      if (bar) bar.style.width = '100%';
      setTimeout(hide, 500);
      return;
    }

    setWord(words[index], index > 0);
    if (bar) bar.style.width = ((index + 1) / words.length * 100) + '%';
    index++;

    const delay = index === words.length ? 800 : 300;
    setTimeout(next, delay);
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
