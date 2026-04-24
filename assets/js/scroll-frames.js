/**
 * BUUR Digital — scroll-frames.js
 * Animation frame-by-frame pilotée par le scroll (GSAP ScrollTrigger + Canvas).
 * Dépendances : gsap, ScrollTrigger
 */
(function () {
  'use strict';

  if (!window.gsap || !window.ScrollTrigger) return;
  gsap.registerPlugin(ScrollTrigger);

  /* ======================================================
     CONFIG
     ====================================================== */
  const THEME_URL   = (window.buurTheme && window.buurTheme.url) || '';
  const FRAMES_PATH = THEME_URL + '/assets/frames';

  const SEQUENCES = [
    { id: 'v1', count: 192 },
    { id: 'v2', count: 144 },
    { id: 'v3', count: 192 },
    { id: 'v4', count: 144 },
    { id: 'v5', count: 144 },
    { id: 'v6', count: 144 },
    { id: 'v7', count: 193 },
  ];

  /* ======================================================
     UTILITAIRES
     ====================================================== */
  function frameSrc(id, index) {
    return FRAMES_PATH + '/' + id + '/frame_' + String(index).padStart(3, '0') + '.jpg';
  }

  function preload(id, count, onProgress) {
    return new Promise(function (resolve) {
      var images = new Array(count);
      var loaded = 0;
      for (var i = 0; i < count; i++) {
        (function (idx) {
          var img = new Image();
          img.src = frameSrc(id, idx + 1);
          img.onload = img.onerror = function () {
            loaded++;
            if (onProgress) onProgress(loaded / count);
            if (loaded === count) resolve(images);
          };
          images[idx] = img;
        })(i);
      }
    });
  }

  /* ======================================================
     INIT UNE SÉQUENCE
     ====================================================== */
  function initSequence(seq) {
    var sectionEl = document.querySelector('.scroll-section-' + seq.id);
    if (!sectionEl) return;

    var canvas = document.getElementById('scroll-seq-' + seq.id);
    if (!canvas) return;
    var ctx = canvas.getContext('2d');

    var loaderEl  = sectionEl.querySelector('.seq-loader');
    var loaderWrap = sectionEl.querySelector('.seq-loader-wrap');

    preload(seq.id, seq.count, function (progress) {
      if (loaderEl) loaderEl.style.width = (progress * 100) + '%';
    }).then(function (images) {

      // Supprimer la barre de chargement
      if (loaderWrap) loaderWrap.remove();

      // Dimensionner le canvas
      var first = images[0];
      canvas.width  = first.naturalWidth  || 1920;
      canvas.height = first.naturalHeight || 1080;
      ctx.drawImage(first, 0, 0);

      var state = { frame: 0 };

      function render(index) {
        var img = images[Math.round(index)];
        if (!img || !img.complete) return;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.drawImage(img, 0, 0);
      }

      // Activation du texte overlay
      ScrollTrigger.create({
        trigger: sectionEl,
        start: 'top center',
        end: 'bottom center',
        onEnter:      function () { sectionEl.classList.add('is-active'); },
        onLeave:      function () { sectionEl.classList.remove('is-active'); },
        onEnterBack:  function () { sectionEl.classList.add('is-active'); },
        onLeaveBack:  function () { sectionEl.classList.remove('is-active'); },
      });

      // Animation frames par scroll
      gsap.to(state, {
        frame: seq.count - 1,
        ease: 'none',
        onUpdate: function () { render(state.frame); },
        scrollTrigger: {
          trigger:    sectionEl,
          start:      'top top',
          end:        '+=' + (seq.count * 5),
          scrub:      1,
          pin:        true,
          pinSpacing: true,
          anticipatePin: 1,
        },
      });
    });
  }

  /* ======================================================
     LANCEMENT
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
