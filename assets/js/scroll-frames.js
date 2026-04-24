/**
 * BUUR Digital — scroll-frames.js v4
 * Cross-fade cinématique entre sections
 * Chaque section commence opaque sur sa première frame,
 * la section suivante s'anime en fondu en entrant.
 */
(function () {
  'use strict';
  if (!window.gsap || !window.ScrollTrigger) return;
  gsap.registerPlugin(ScrollTrigger);

  var THEME_URL   = (window.buurTheme && window.buurTheme.url) ? window.buurTheme.url : '';
  var FRAMES_PATH = THEME_URL + '/assets/frames';
  var PX_PER_FRAME = 14;

  var SEQUENCES = [
    { id: 'v1', count: 192, chapter: '01', title: 'Stratégie <em>Digitale</em>',   sub: 'Une vision claire pour dominer votre marché en ligne.' },
    { id: 'v2', count: 144, chapter: '02', title: 'Design <em>Premium</em>',        sub: 'Des interfaces qui captivent, engagent et convertissent.' },
    { id: 'v3', count: 192, chapter: '03', title: 'Code <em>Sur-Mesure</em>',      sub: 'Rapide, propre, évolutif — construit pour durer.' },
    { id: 'v4', count: 144, chapter: '04', title: 'SEO & <em>Performance</em>',    sub: 'Premier sur Google. Rapide sur tous les écrans.' },
    { id: 'v5', count: 144, chapter: '05', title: 'E-<em>Commerce</em>',           sub: 'Votre boutique pensée pour vendre, 24h/24.' },
    { id: 'v6', count: 144, chapter: '06', title: 'Support <em>Dédié</em>',        sub: 'Une équipe disponible pour faire grandir votre projet.' },
    { id: 'v7', count: 193, chapter: '07', title: 'Résultats <em>Mesurables</em>', sub: 'Chaque action optimisée. Chaque chiffre suivi.' },
  ];

  function frameSrc(id, n) {
    return FRAMES_PATH + '/' + id + '/frame_' + String(n).padStart(3,'0') + '.jpg';
  }

  function drawCover(ctx, img, w, h) {
    if (!img || !img.naturalWidth) return;
    var s = Math.max(w / img.naturalWidth, h / img.naturalHeight);
    ctx.clearRect(0, 0, w, h);
    ctx.drawImage(img,
      (w - img.naturalWidth  * s) / 2,
      (h - img.naturalHeight * s) / 2,
      img.naturalWidth  * s,
      img.naturalHeight * s
    );
  }

  function preload(id, count, onProgress) {
    return new Promise(function (resolve) {
      var imgs = new Array(count);
      var done = 0;
      for (var i = 0; i < count; i++) {
        (function (idx) {
          var img = new Image();
          img.src = frameSrc(id, idx + 1);
          img.onload = img.onerror = function () {
            done++;
            if (onProgress) onProgress(done / count);
            if (done === count) resolve(imgs);
          };
          imgs[idx] = img;
        })(i);
      }
    });
  }

  /* ── Progress ── */
  var progressEl = null;
  var dots = [];

  function buildProgress() {
    progressEl = document.createElement('nav');
    progressEl.className = 'scroll-frames-progress';
    progressEl.setAttribute('aria-label', 'Chapitres');
    SEQUENCES.forEach(function (seq, i) {
      var d = document.createElement('button');
      d.className = 'progress-dot';
      d.setAttribute('aria-label', 'Chapitre ' + seq.chapter);
      d.style.pointerEvents = 'auto';
      d.addEventListener('click', function () {
        var el = document.querySelector('.scroll-section-' + seq.id);
        if (el) el.scrollIntoView({ behavior: 'smooth' });
      });
      progressEl.appendChild(d);
      dots.push(d);
    });
    document.body.appendChild(progressEl);
  }

  function setDot(i) {
    dots.forEach(function (d, j) { d.classList.toggle('is-active', i === j); });
  }

  /* ── Init séquence ── */
  function initSeq(seq, index) {
    var section = document.querySelector('.scroll-section-' + seq.id);
    if (!section) return;
    var canvas  = document.getElementById('scroll-seq-' + seq.id);
    if (!canvas) return;
    var ctx        = canvas.getContext('2d');
    var loaderWrap = section.querySelector('.seq-loader-wrap');
    var loaderEl   = section.querySelector('.seq-loader');

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

      /* ── Dessine la première frame dès le chargement ── */
      drawCover(ctx, images[0], canvas.width, canvas.height);

      var state = { frame: 0 };

      function render(f) {
        var img = images[Math.round(f)];
        if (img && img.complete && img.naturalWidth) {
          drawCover(ctx, img, canvas.width, canvas.height);
        }
      }

      /* ── Cross-fade d'entrée ──
         Quand la section entre dans le viewport, le canvas
         part de opacity:0 → 1 via CSS transition.
         On ajoute is-entering au mount, puis on l'enlève après 50ms
         pour déclencher la transition CSS. */
      if (index > 0) {
        canvas.style.opacity = '0';
        canvas.style.transition = 'opacity 0.7s ease';
      }

      /* ── Texte overlay ── */
      ScrollTrigger.create({
        trigger: section,
        start: 'top 58%',
        end: 'bottom 42%',
        onEnter: function () {
          /* Cross-fade in */
          if (index > 0) canvas.style.opacity = '1';
          section.classList.add('is-active');
          if (progressEl) progressEl.classList.add('is-visible');
          setDot(index);
        },
        onLeave: function () {
          section.classList.remove('is-active');
        },
        onEnterBack: function () {
          if (index > 0) canvas.style.opacity = '1';
          section.classList.add('is-active');
          setDot(index);
        },
        onLeaveBack: function () {
          /* Cross-fade out vers section précédente */
          if (index > 0) canvas.style.opacity = '0';
          section.classList.remove('is-active');
          if (index === 0 && progressEl) progressEl.classList.remove('is-visible');
        },
      });

      /* ── Animation frames ── */
      gsap.to(state, {
        frame: seq.count - 1,
        ease: 'none',
        onUpdate: function () { render(state.frame); },
        scrollTrigger: {
          trigger:       section,
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
    SEQUENCES.forEach(initSeq);
  }

  document.readyState === 'loading'
    ? document.addEventListener('DOMContentLoaded', init)
    : init();

})();
