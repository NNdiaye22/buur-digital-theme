/**
 * BUUR Digital — scroll-frames.js
 * Animation séquence d'images (frame-by-frame) pilotée par le scroll.
 * Dépendances : gsap, ScrollTrigger
 * Sections : v1 → v7 (chacune avec canvas + frames préchargées)
 */
(function () {
  'use strict';

  if (!window.gsap || !window.ScrollTrigger) return;
  gsap.registerPlugin(ScrollTrigger);

  /* ======================================================
     CONFIG — adapter selon le thème WordPress
     ====================================================== */
  const THEME_URL   = window.buurTheme?.url || '/wp-content/themes/buur-digital-theme';
  const FRAMES_PATH = THEME_URL + '/assets/frames';

  const SEQUENCES = [
    { id: 'scroll-seq-v1', path: 'v1', count: 192, section: '.scroll-section-v1' },
    { id: 'scroll-seq-v2', path: 'v2', count: 144, section: '.scroll-section-v2' },
    { id: 'scroll-seq-v3', path: 'v3', count: 192, section: '.scroll-section-v3' },
    { id: 'scroll-seq-v4', path: 'v4', count: 144, section: '.scroll-section-v4' },
    { id: 'scroll-seq-v5', path: 'v5', count: 144, section: '.scroll-section-v5' },
    { id: 'scroll-seq-v6', path: 'v6', count: 144, section: '.scroll-section-v6' },
    { id: 'scroll-seq-v7', path: 'v7', count: 193, section: '.scroll-section-v7' },
  ];

  /* ======================================================
     UTILITAIRE — padded filename
     ====================================================== */
  function frameSrc(path, index) {
    const n = String(index).padStart(3, '0');
    return `${FRAMES_PATH}/${path}/frame_${n}.jpg`;
  }

  /* ======================================================
     PRÉCHARGEMENT — toutes les images d'une séquence
     ====================================================== */
  function preloadFrames(path, count, onProgress) {
    return new Promise((resolve) => {
      const images = [];
      let loaded = 0;

      for (let i = 1; i <= count; i++) {
        const img = new Image();
        img.src = frameSrc(path, i);
        img.onload = img.onerror = () => {
          loaded++;
          if (onProgress) onProgress(loaded / count);
          if (loaded === count) resolve(images);
        };
        images.push(img);
      }
    });
  }

  /* ======================================================
     INITIALISATION D'UNE SÉQUENCE
     ====================================================== */
  function initSequence({ id, path, count, section }) {
    const sectionEl = document.querySelector(section);
    if (!sectionEl) return;

    // Canvas
    const canvas = document.getElementById(id);
    if (!canvas) return;
    const ctx = canvas.getContext('2d');

    // Loader overlay (optionnel — si présent dans le HTML)
    const loader = sectionEl.querySelector('.seq-loader');

    // Préchargement
    preloadFrames(path, count, (progress) => {
      if (loader) loader.style.width = (progress * 100) + '%';
    }).then((images) => {
      if (loader) loader.closest('.seq-loader-wrap')?.remove();

      // Resize canvas selon première image
      const firstImg = images[0];
      canvas.width  = firstImg.naturalWidth  || 1920;
      canvas.height = firstImg.naturalHeight || 1080;
      ctx.drawImage(firstImg, 0, 0);

      // Objet de progression (GSAP anime cette valeur)
      const state = { frame: 0 };

      function renderFrame(index) {
        const img = images[Math.round(index)];
        if (!img || !img.complete) return;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.drawImage(img, 0, 0);
      }

      // ScrollTrigger — pin + scrub
      gsap.to(state, {
        frame: count - 1,
        ease: 'none',
        onUpdate() {
          renderFrame(state.frame);
        },
        scrollTrigger: {
          trigger:    sectionEl,
          start:      'top top',
          end:        `+=${count * 5}`,   // 5px par frame → ajustable
          scrub:      1,
          pin:        true,
          pinSpacing: true,
          anticipatePin: 1,
        },
      });
    });
  }

  /* ======================================================
     LANCEMENT AU DOMCONTENTLOADED
     ====================================================== */
  function init() {
    SEQUENCES.forEach(initSequence);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();
