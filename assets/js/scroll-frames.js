/**
 * BUUR Digital — scroll-frames.js v2
 * UX premium : transitions cinématiques, continuité visuelle inter-sections,
 * indicateur de progression, drawImage cover.
 * Dépendances : gsap, ScrollTrigger
 */
(function () {
  'use strict';

  if (!window.gsap || !window.ScrollTrigger) return;
  gsap.registerPlugin(ScrollTrigger);

  /* ── Config ── */
  var THEME_URL   = (window.buurTheme && window.buurTheme.url) ? window.buurTheme.url : '';
  var FRAMES_PATH = THEME_URL + '/assets/frames';
  var PX_PER_FRAME = 6; /* pixels de scroll par frame */

  var SEQUENCES = [
    { id: 'v1', count: 192, chapter: '01', title: 'Stratégie <em>Digitale</em>',    sub: 'Une vision claire pour dominer votre marché en ligne.' },
    { id: 'v2', count: 144, chapter: '02', title: 'Design <em>Premium</em>',        sub: 'Des interfaces qui captivent, engagent et convertissent.' },
    { id: 'v3', count: 192, chapter: '03', title: 'Code <em>Sur-Mesure</em>',       sub: 'Rapide, propre, évolutif — construit pour durer.' },
    { id: 'v4', count: 144, chapter: '04', title: 'SEO & <em>Performance</em>',     sub: 'Premier sur Google. Rapide sur tous les écrans.' },
    { id: 'v5', count: 144, chapter: '05', title: 'E-<em>Commerce</em>',            sub: 'Votre boutique pensée pour vendre, 24h/24.' },
    { id: 'v6', count: 144, chapter: '06', title: 'Support <em>Dédié</em>',         sub: 'Une équipe disponible pour faire grandir votre projet.' },
    { id: 'v7', count: 193, chapter: '07', title: 'Résultats <em>Mesurables</em>',  sub: 'Chaque action optimisée. Chaque chiffre suivi.' },
  ];

  /* ── Utilitaires ── */
  function frameSrc(id, index) {
    return FRAMES_PATH + '/' + id + '/frame_' + String(index).padStart(3, '0') + '.jpg';
  }

  /* drawImage en mode cover (centré, sans déformation) */
  function drawCover(ctx, img, cw, ch) {
    var iw = img.naturalWidth  || cw;
    var ih = img.naturalHeight || ch;
    var scale = Math.max(cw / iw, ch / ih);
    var dx = (cw - iw * scale) / 2;
    var dy = (ch - ih * scale) / 2;
    ctx.drawImage(img, dx, dy, iw * scale, ih * scale);
  }

  /* ── Préchargement ── */
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

  /* ── Indicateur de progression ── */
  var progressEl = null;
  var dots = [];

  function buildProgress() {
    progressEl = document.createElement('nav');
    progressEl.className = 'scroll-frames-progress';
    progressEl.setAttribute('aria-label', 'Navigation sections');
    SEQUENCES.forEach(function (seq, i) {
      var dot = document.createElement('button');
      dot.className = 'progress-dot';
      dot.setAttribute('aria-label', 'Section ' + seq.chapter);
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

  function setActiveDot(index) {
    dots.forEach(function (d, i) {
      d.classList.toggle('is-active', i === index);
    });
  }

  /* ── Init une séquence ── */
  function initSequence(seq, index) {
    var sectionEl = document.querySelector('.scroll-section-' + seq.id);
    if (!sectionEl) return;

    var canvas = document.getElementById('scroll-seq-' + seq.id);
    if (!canvas) return;
    var ctx = canvas.getContext('2d');

    var loaderEl   = sectionEl.querySelector('.seq-loader');
    var loaderWrap = sectionEl.querySelector('.seq-loader-wrap');

    /* Dimensionner canvas au viewport */
    function resizeCanvas() {
      canvas.width  = window.innerWidth;
      canvas.height = window.innerHeight;
    }
    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    preload(seq.id, seq.count, function (p) {
      if (loaderEl) loaderEl.style.width = (p * 100) + '%';
    }).then(function (images) {

      if (loaderWrap) loaderWrap.remove();

      var state = { frame: 0 };

      function render(index) {
        var img = images[Math.round(index)];
        if (!img || !img.complete || !img.naturalWidth) return;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        drawCover(ctx, img, canvas.width, canvas.height);
      }

      /* Rendu initial */
      render(0);

      /* ── Activation texte ── */
      ScrollTrigger.create({
        trigger: sectionEl,
        start: 'top 60%',
        end: 'bottom 40%',
        onEnter: function () {
          sectionEl.classList.add('is-active');
          sectionEl.classList.remove('is-ending');
          if (progressEl) progressEl.classList.add('is-visible');
          setActiveDot(index);
        },
        onLeave: function () {
          sectionEl.classList.remove('is-active');
          sectionEl.classList.add('is-ending');
        },
        onEnterBack: function () {
          sectionEl.classList.add('is-active');
          sectionEl.classList.remove('is-ending');
          setActiveDot(index);
        },
        onLeaveBack: function () {
          sectionEl.classList.remove('is-active');
          sectionEl.classList.remove('is-ending');
          /* Masquer progress si avant la première section */
          if (index === 0 && progressEl) {
            progressEl.classList.remove('is-visible');
          }
        },
      });

      /* ── Animation frames ──
         scrub=true pour coller exactement au scroll,
         pas de ease pour garder la continuité avec la section suivante */
      gsap.to(state, {
        frame: seq.count - 1,
        ease: 'none',
        onUpdate: function () { render(state.frame); },
        scrollTrigger: {
          trigger:    sectionEl,
          start:      'top top',
          end:        '+=' + (seq.count * PX_PER_FRAME),
          scrub:      0.5,
          pin:        true,
          pinSpacing: true,
          anticipatePin: 1,
          /* Pas de snap pour fluidité inter-sections */
        },
      });
    });
  }

  /* ── Init globale ── */
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
