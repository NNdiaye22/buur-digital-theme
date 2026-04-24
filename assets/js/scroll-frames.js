/**
 * BUUR Digital — scroll-frames.js v4
 * Cross-fade cinématique entre sections
 * Les dernières frames d'une seq = premières frames de la suivante → transition invisible
 */
(function () {
  'use strict';

  if (!window.gsap || !window.ScrollTrigger) return;
  gsap.registerPlugin(ScrollTrigger);

  var THEME_URL   = (window.buurTheme && window.buurTheme.url) ? window.buurTheme.url : '';
  var FRAMES_PATH = THEME_URL + '/assets/frames';
  var PX_PER_FRAME = 14;
  /* Durée du cross-fade en frames à la fin de chaque séquence */
  var FADE_FRAMES  = 18;

  var SEQUENCES = [
    { id: 'v1', count: 192, chapter: '01', title: 'Stratégie <em>Digitale</em>',   sub: 'Une vision claire pour dominer votre marché en ligne.' },
    { id: 'v2', count: 144, chapter: '02', title: 'Design <em>Premium</em>',        sub: 'Des interfaces qui captivent, engagent et convertissent.' },
    { id: 'v3', count: 192, chapter: '03', title: 'Code <em>Sur-Mesure</em>',      sub: 'Rapide, propre, évolutif — construit pour durer.' },
    { id: 'v4', count: 144, chapter: '04', title: 'SEO & <em>Performance</em>',    sub: 'Premier sur Google. Rapide sur tous les écrans.' },
    { id: 'v5', count: 144, chapter: '05', title: 'E-<em>Commerce</em>',           sub: 'Votre boutique pensée pour vendre, 24h/24.' },
    { id: 'v6', count: 144, chapter: '06', title: 'Support <em>Dédié</em>',        sub: 'Une équipe disponible pour faire grandir votre projet.' },
    { id: 'v7', count: 193, chapter: '07', title: 'Résultats <em>Mesurables</em>', sub: 'Chaque action optimisée. Chaque chiffre suivi.' },
  ];

  var loadedImages = {}; /* cache global par séquence */

  function frameSrc(id, index) {
    return FRAMES_PATH + '/' + id + '/frame_' + String(index).padStart(3, '0') + '.jpg';
  }

  function drawCover(ctx, img, cw, ch) {
    if (!img || !img.naturalWidth) return;
    var s = Math.max(cw / img.naturalWidth, ch / img.naturalHeight);
    ctx.clearRect(0, 0, cw, ch);
    ctx.drawImage(img,
      (cw - img.naturalWidth  * s) / 2,
      (ch - img.naturalHeight * s) / 2,
      img.naturalWidth  * s,
      img.naturalHeight * s
    );
  }

  function preload(id, count, onProgress) {
    if (loadedImages[id]) return Promise.resolve(loadedImages[id]);
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
            if (loaded === count) { loadedImages[id] = images; resolve(images); }
          };
          images[idx] = img;
        })(i);
      }
    });
  }

  /* ── Progress dots ── */
  var progressEl = null;
  var dots = [];

  function buildProgress() {
    progressEl = document.createElement('nav');
    progressEl.className = 'scroll-frames-progress';
    progressEl.setAttribute('aria-label', 'Navigation chapitres');
    SEQUENCES.forEach(function (seq, i) {
      var dot = document.createElement('button');
      dot.className = 'progress-dot';
      dot.setAttribute('aria-label', 'Chapitre ' + seq.chapter);
      dot.style.pointerEvents = 'auto';
      dot.addEventListener('click', function () {
        var el = document.querySelector('.scroll-section-' + seq.id);
        if (el) el.scrollIntoView({ behavior: 'smooth' });
      });
      progressEl.appendChild(dot);
      dots.push(dot);
    });
    document.body.appendChild(progressEl);
  }

  function setActiveDot(i) {
    dots.forEach(function (d, j) { d.classList.toggle('is-active', j === i); });
  }

  /* ── Init une séquence ── */
  function initSequence(seq, index) {
    var sectionEl = document.querySelector('.scroll-section-' + seq.id);
    if (!sectionEl) return;
    var canvas = document.getElementById('scroll-seq-' + seq.id);
    if (!canvas) return;
    var ctx = canvas.getContext('2d');

    var loaderWrap = sectionEl.querySelector('.seq-loader-wrap');
    var loaderEl   = sectionEl.querySelector('.seq-loader');
    var nextSeq    = SEQUENCES[index + 1];

    function resize() {
      canvas.width  = window.innerWidth;
      canvas.height = window.innerHeight;
    }
    resize();
    window.addEventListener('resize', resize);

    preload(seq.id, seq.count, function (p) {
      if (loaderEl) loaderEl.style.width = (p * 100) + '%';
    }).then(function (images) {
      if (loaderWrap) loaderWrap.remove();
      drawCover(ctx, images[0], canvas.width, canvas.height);

      /* Préchargement anticipé de la séquence suivante */
      if (nextSeq) preload(nextSeq.id, nextSeq.count, null);

      var state = { frame: 0, fadeOpacity: 0 };

      /* Canvas de transition (cross-fade) */
      var canvasNext = document.createElement('canvas');
      canvasNext.className = 'scroll-canvas-next';
      canvasNext.width  = canvas.width;
      canvasNext.height = canvas.height;
      var ctxNext = canvasNext.getContext('2d');
      sectionEl.querySelector('.scroll-frame-inner').insertBefore(canvasNext, canvas.nextSibling);
      window.addEventListener('resize', function () {
        canvasNext.width  = window.innerWidth;
        canvasNext.height = window.innerHeight;
      });

      function render(f) {
        var idx = Math.min(Math.round(f), seq.count - 1);
        var img = images[idx];
        if (img && img.complete && img.naturalWidth) {
          drawCover(ctx, img, canvas.width, canvas.height);
        }

        /* Cross-fade vers la première frame de la séquence suivante */
        if (nextSeq && loadedImages[nextSeq.id]) {
          var fadeStart = seq.count - FADE_FRAMES;
          if (f >= fadeStart) {
            var t = (f - fadeStart) / FADE_FRAMES;
            t = Math.max(0, Math.min(1, t));
            canvasNext.style.opacity = t;
            var nextImg = loadedImages[nextSeq.id][0];
            if (nextImg && nextImg.complete && nextImg.naturalWidth) {
              drawCover(ctxNext, nextImg, canvasNext.width, canvasNext.height);
            }
          } else {
            canvasNext.style.opacity = 0;
          }
        }
      }

      /* Activation texte */
      ScrollTrigger.create({
        trigger: sectionEl,
        start: 'top 60%',
        end:   'bottom 40%',
        onEnter:     function () { sectionEl.classList.add('is-active');    if (progressEl) progressEl.classList.add('is-visible'); setActiveDot(index); },
        onLeave:     function () { sectionEl.classList.remove('is-active'); },
        onEnterBack: function () { sectionEl.classList.add('is-active');    setActiveDot(index); },
        onLeaveBack: function () {
          sectionEl.classList.remove('is-active');
          if (index === 0 && progressEl) progressEl.classList.remove('is-visible');
        },
      });

      /* Animation frames */
      gsap.to(state, {
        frame: seq.count - 1,
        ease: 'none',
        onUpdate: function () { render(state.frame); },
        scrollTrigger: {
          trigger:       sectionEl,
          start:         'top top',
          end:           '+=' + (seq.count * PX_PER_FRAME),
          scrub:         true,
          pin:           true,
          pinSpacing:    false,
          anticipatePin: 1,
        },
      });
    });
  }

  function init() {
    buildProgress();
    SEQUENCES.forEach(initSequence);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();
