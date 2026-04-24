/**
 * BUUR Digital — scroll-frames.js v5
 * Séquence UNIQUE continue : v1(192) + v2(144) + v3(192) + v4(144) + v5(144) + v6(144) + v7(193) = 1153 frames
 * Textes cinématiques liés à la progression du scroll
 * Cross-fade natif via double canvas
 */
(function () {
  'use strict';

  if (!window.gsap || !window.ScrollTrigger) return;
  gsap.registerPlugin(ScrollTrigger);

  var THEME_URL   = (window.buurTheme && window.buurTheme.url) ? window.buurTheme.url : '';
  var FRAMES_PATH = THEME_URL + '/assets/frames';
  var PX_PER_FRAME = 12;

  /* Toutes les séquences dans l'ordre — numérotation locale à chaque dossier */
  var SEQUENCES = [
    { id: 'v1', count: 192 },
    { id: 'v2', count: 144 },
    { id: 'v3', count: 192 },
    { id: 'v4', count: 144 },
    { id: 'v5', count: 144 },
    { id: 'v6', count: 144 },
    { id: 'v7', count: 193 },
  ];

  /* Chapitres : à quel frame global (index 0-based) chaque texte apparaît/disparaît */
  var TOTAL_FRAMES = SEQUENCES.reduce(function(acc, s){ return acc + s.count; }, 0); // 1153

  /* offset[i] = premier frame global de la séquence i */
  var offsets = [];
  var cur = 0;
  SEQUENCES.forEach(function(s) { offsets.push(cur); cur += s.count; });

  var CHAPTERS = [
    {
      frameIn:  offsets[0],
      frameOut: offsets[1] - 1,
      chapter:  '01',
      title:    'Stratégie <em>Digitale</em>',
      sub:      'Une vision claire pour dominer votre marché en ligne.',
    },
    {
      frameIn:  offsets[1],
      frameOut: offsets[2] - 1,
      chapter:  '02',
      title:    'Design <em>Premium</em>',
      sub:      'Des interfaces qui captivent, engagent et convertissent.',
    },
    {
      frameIn:  offsets[2],
      frameOut: offsets[3] - 1,
      chapter:  '03',
      title:    'Code <em>Sur-Mesure</em>',
      sub:      'Rapide, propre, évolutif — construit pour durer.',
    },
    {
      frameIn:  offsets[3],
      frameOut: offsets[4] - 1,
      chapter:  '04',
      title:    'SEO & <em>Performance</em>',
      sub:      'Premier sur Google. Rapide sur tous les écrans.',
    },
    {
      frameIn:  offsets[4],
      frameOut: offsets[5] - 1,
      chapter:  '05',
      title:    'E-<em>Commerce</em>',
      sub:      'Votre boutique pensée pour vendre, 24h/24.',
    },
    {
      frameIn:  offsets[5],
      frameOut: offsets[6] - 1,
      chapter:  '06',
      title:    'Support <em>Dédié</em>',
      sub:      'Une équipe disponible pour faire grandir votre projet.',
    },
    {
      frameIn:  offsets[6],
      frameOut: TOTAL_FRAMES - 1,
      chapter:  '07',
      title:    'Résultats <em>Mesurables</em>',
      sub:      'Chaque action optimisée. Chaque chiffre suivi.',
    },
  ];

  var FADE_IN_FRAMES  = 18; /* frames pour faire apparaître le texte */
  var FADE_OUT_FRAMES = 18; /* frames pour faire disparaître le texte */

  /* ── DOM ── */
  var wrapper     = document.querySelector('.scroll-frames-wrapper');
  var canvas      = document.getElementById('scroll-main-canvas');
  var canvasB     = document.getElementById('scroll-main-canvas-b');
  var chapEl      = document.getElementById('sf-chapter');
  var titleEl     = document.getElementById('sf-title');
  var subEl       = document.getElementById('sf-sub');
  var loaderWrap  = document.getElementById('sf-loader-wrap');
  var loaderBar   = document.getElementById('sf-loader-bar');
  var progressNav = document.getElementById('sf-progress');
  var dotEls      = progressNav ? progressNav.querySelectorAll('.sf-dot') : [];

  if (!wrapper || !canvas) return;

  var ctx  = canvas.getContext('2d');
  var ctxB = canvasB ? canvasB.getContext('2d') : null;

  function resize() {
    canvas.width  = window.innerWidth;
    canvas.height = window.innerHeight;
    if (canvasB) { canvasB.width = window.innerWidth; canvasB.height = window.innerHeight; }
  }
  resize();
  window.addEventListener('resize', function() { resize(); if(allImages.length) drawFrame(currentFrame); });

  /* ── Chargement de toutes les images dans l'ordre ── */
  var allImages   = [];
  var totalLoaded = 0;
  var TOTAL       = TOTAL_FRAMES;

  function frameSrc(seqId, localIdx) {
    return FRAMES_PATH + '/' + seqId + '/frame_' + String(localIdx + 1).padStart(3, '0') + '.jpg';
  }

  function loadAll() {
    return new Promise(function(resolve) {
      var tempArrays = SEQUENCES.map(function(s) { return new Array(s.count); });

      SEQUENCES.forEach(function(seq, si) {
        for (var i = 0; i < seq.count; i++) {
          (function(seqIdx, localIdx) {
            var img = new Image();
            img.src = frameSrc(seq.id, localIdx);
            img.onload = img.onerror = function() {
              totalLoaded++;
              if (loaderBar) loaderBar.style.width = (totalLoaded / TOTAL * 100) + '%';
              if (totalLoaded === TOTAL) resolve();
            };
            tempArrays[seqIdx][localIdx] = img;
          })(si, i);
        }
      });

      /* Aplatir dans l'ordre */
      SEQUENCES.forEach(function(seq, si) {
        seq._offset = allImages.length;
        for (var i = 0; i < seq.count; i++) {
          allImages.push(tempArrays[si][i]);
        }
      });
    });
  }

  /* ── Dessin ── */
  function drawCover(c, img) {
    if (!img || !img.naturalWidth) return;
    var s = Math.max(c.canvas.width / img.naturalWidth, c.canvas.height / img.naturalHeight);
    c.clearRect(0, 0, c.canvas.width, c.canvas.height);
    c.drawImage(img,
      (c.canvas.width  - img.naturalWidth  * s) / 2,
      (c.canvas.height - img.naturalHeight * s) / 2,
      img.naturalWidth * s, img.naturalHeight * s
    );
  }

  var currentFrame  = 0;
  var currentChapter = -1;

  function drawFrame(f) {
    currentFrame = f;
    var idx = Math.min(Math.round(f), TOTAL - 1);
    drawCover(ctx, allImages[idx]);
  }

  /* ── Textes cinématiques ── */
  function updateText(f) {
    var chIdx = -1;
    for (var i = 0; i < CHAPTERS.length; i++) {
      if (f >= CHAPTERS[i].frameIn && f <= CHAPTERS[i].frameOut) { chIdx = i; break; }
    }

    /* Changer le chapitre actif */
    if (chIdx !== currentChapter) {
      currentChapter = chIdx;
      /* Sortie texte actuel */
      gsap.to([chapEl, titleEl, subEl], {
        opacity: 0, y: 20, duration: 0.35, ease: 'power2.in',
        onComplete: function() {
          if (chIdx < 0) return;
          var ch = CHAPTERS[chIdx];
          if (chapEl)  chapEl.textContent = ch.chapter;
          if (titleEl) titleEl.innerHTML  = ch.title;
          if (subEl)   subEl.textContent  = ch.sub;
          /* Entrée nouveau texte */
          gsap.fromTo([chapEl, titleEl, subEl],
            { opacity: 0, y: 30 },
            { opacity: 1, y: 0,  duration: 0.75, ease: 'power3.out', stagger: 0.12 }
          );
          /* Dots */
          dotEls.forEach(function(d, j) { d.classList.toggle('is-active', j === chIdx); });
        }
      });
    }
  }

  /* ── ScrollTrigger unique ── */
  function initScroll() {
    if (loaderWrap) loaderWrap.remove();
    drawFrame(0);

    /* Afficher le premier chapitre */
    currentChapter = 0;
    var c0 = CHAPTERS[0];
    if (chapEl)  chapEl.textContent = c0.chapter;
    if (titleEl) titleEl.innerHTML  = c0.title;
    if (subEl)   subEl.textContent  = c0.sub;
    gsap.fromTo([chapEl, titleEl, subEl],
      { opacity: 0, y: 30 },
      { opacity: 1, y: 0, duration: 1, ease: 'power3.out', stagger: 0.14, delay: 0.3 }
    );
    if (progressNav) progressNav.classList.add('is-visible');
    if (dotEls[0]) dotEls[0].classList.add('is-active');

    var state = { frame: 0 };
    gsap.to(state, {
      frame: TOTAL - 1,
      ease:  'none',
      onUpdate: function() {
        drawFrame(state.frame);
        updateText(state.frame);
      },
      scrollTrigger: {
        trigger:       wrapper,
        start:         'top top',
        end:           '+=' + (TOTAL * PX_PER_FRAME),
        scrub:         true,
        pin:           true,
        pinSpacing:    true,
        anticipatePin: 1,
        onLeaveBack: function() {
          if (progressNav) progressNav.classList.remove('is-visible');
        },
        onEnter: function() {
          if (progressNav) progressNav.classList.add('is-visible');
        },
      },
    });
  }

  /* ── Lance ── */
  loadAll().then(initScroll);

})();
