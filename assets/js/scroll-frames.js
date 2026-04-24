/**
 * BUUR Digital — scroll-frames.js v5.1
 * Séquence unique v1→v7 — 1153 frames
 * Textes : apparition split-line, sortie fondu haut, stagger précis
 */
(function () {
  'use strict';

  if (!window.gsap || !window.ScrollTrigger) return;
  gsap.registerPlugin(ScrollTrigger);

  var THEME_URL    = (window.buurTheme && window.buurTheme.url) ? window.buurTheme.url : '';
  var FRAMES_PATH  = THEME_URL + '/assets/frames';
  var PX_PER_FRAME = 12;

  var SEQUENCES = [
    { id: 'v1', count: 192 },
    { id: 'v2', count: 144 },
    { id: 'v3', count: 192 },
    { id: 'v4', count: 144 },
    { id: 'v5', count: 144 },
    { id: 'v6', count: 144 },
    { id: 'v7', count: 193 },
  ];

  var TOTAL = SEQUENCES.reduce(function (a, s) { return a + s.count; }, 0);

  var offsets = [];
  var acc = 0;
  SEQUENCES.forEach(function (s) { offsets.push(acc); acc += s.count; });

  var CHAPTERS = [
    { frameIn: offsets[0], frameOut: offsets[1] - 1, chapter: '01', title: 'Stratégie <em>Digitale</em>',   sub: 'Une vision claire pour dominer votre marché en ligne.' },
    { frameIn: offsets[1], frameOut: offsets[2] - 1, chapter: '02', title: 'Design <em>Premium</em>',        sub: 'Des interfaces qui captivent, engagent et convertissent.' },
    { frameIn: offsets[2], frameOut: offsets[3] - 1, chapter: '03', title: 'Code <em>Sur-Mesure</em>',       sub: 'Rapide, propre, évolutif — construit pour durer.' },
    { frameIn: offsets[3], frameOut: offsets[4] - 1, chapter: '04', title: 'SEO & <em>Performance</em>',     sub: 'Premier sur Google. Rapide sur tous les écrans.' },
    { frameIn: offsets[4], frameOut: offsets[5] - 1, chapter: '05', title: 'E-<em>Commerce</em>',            sub: 'Votre boutique pensée pour vendre, 24h/24.' },
    { frameIn: offsets[5], frameOut: offsets[6] - 1, chapter: '06', title: 'Support <em>Dédié</em>',         sub: 'Une équipe disponible pour faire grandir votre projet.' },
    { frameIn: offsets[6], frameOut: TOTAL - 1,      chapter: '07', title: 'Résultats <em>Mesurables</em>',  sub: 'Chaque action optimisée. Chaque chiffre suivi.' },
  ];

  /* ── DOM ── */
  var wrapper    = document.querySelector('.scroll-frames-wrapper');
  var canvas     = document.getElementById('scroll-main-canvas');
  if (!wrapper || !canvas) return;
  var ctx        = canvas.getContext('2d');
  var chapEl     = document.getElementById('sf-chapter');
  var titleEl    = document.getElementById('sf-title');
  var subEl      = document.getElementById('sf-sub');
  var counterEl  = document.getElementById('sf-counter');
  var loaderWrap = document.getElementById('sf-loader-wrap');
  var loaderBar  = document.getElementById('sf-loader-bar');
  var progressNav= document.getElementById('sf-progress');
  var dotEls     = progressNav ? Array.prototype.slice.call(progressNav.querySelectorAll('.sf-dot')) : [];

  /* ── Resize canvas ── */
  function resize() {
    canvas.width  = window.innerWidth;
    canvas.height = window.innerHeight;
  }
  resize();
  window.addEventListener('resize', function () { resize(); if (allImages.length) drawFrame(currentFrame); });

  /* ── Chargement ── */
  var allImages   = [];
  var totalLoaded = 0;

  function frameSrc(id, idx) {
    return FRAMES_PATH + '/' + id + '/frame_' + String(idx + 1).padStart(3, '0') + '.jpg';
  }

  function loadAll() {
    return new Promise(function (resolve) {
      var temps = SEQUENCES.map(function (s) { return new Array(s.count); });

      SEQUENCES.forEach(function (seq, si) {
        for (var i = 0; i < seq.count; i++) {
          (function (seqIdx, li) {
            var img = new Image();
            img.src = frameSrc(seq.id, li);
            img.onload = img.onerror = function () {
              totalLoaded++;
              if (loaderBar) loaderBar.style.width = (totalLoaded / TOTAL * 100) + '%';
              if (totalLoaded === TOTAL) resolve();
            };
            temps[seqIdx][li] = img;
          })(si, i);
        }
      });

      SEQUENCES.forEach(function (seq, si) {
        for (var i = 0; i < seq.count; i++) allImages.push(temps[si][i]);
      });
    });
  }

  /* ── Dessin ── */
  function drawCover(img) {
    if (!img || !img.naturalWidth) return;
    var s = Math.max(canvas.width / img.naturalWidth, canvas.height / img.naturalHeight);
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.drawImage(img,
      (canvas.width  - img.naturalWidth  * s) / 2,
      (canvas.height - img.naturalHeight * s) / 2,
      img.naturalWidth * s, img.naturalHeight * s
    );
  }

  var currentFrame   = 0;
  var currentChapter = -1;
  var textTween      = null;

  function drawFrame(f) {
    currentFrame = f;
    drawCover(allImages[Math.min(Math.round(f), TOTAL - 1)]);
  }

  /* ── Textes ── */
  var textEls = [chapEl, titleEl, subEl].filter(Boolean);

  function showChapter(idx) {
    if (textTween) textTween.kill();
    var ch = CHAPTERS[idx];

    /* Mise à jour du contenu immédiatement (invisible) */
    if (chapEl)  chapEl.textContent = ch.chapter;
    if (titleEl) titleEl.innerHTML  = ch.title;
    if (subEl)   subEl.textContent  = ch.sub;

    /* Entrée : chaque élément monte depuis le bas, stagger 100ms */
    gsap.set(textEls, { opacity: 0, y: 40, clipPath: 'inset(0 0 100% 0)' });
    textTween = gsap.to(textEls, {
      opacity:  1,
      y:        0,
      clipPath: 'inset(0 0 0% 0)',
      duration: 0.9,
      ease:     'power4.out',
      stagger:  0.11,
    });

    /* Dots */
    dotEls.forEach(function (d, j) { d.classList.toggle('is-active', j === idx); });

    /* Compteur */
    if (counterEl) counterEl.textContent = '0' + (idx + 1) + ' / 07';
  }

  function hideChapter(onDone) {
    if (textTween) textTween.kill();
    textTween = gsap.to(textEls, {
      opacity:  0,
      y:        -28,
      clipPath: 'inset(0 0 100% 0)',
      duration: 0.45,
      ease:     'power3.in',
      onComplete: onDone || null,
    });
  }

  function updateText(f) {
    var chIdx = -1;
    for (var i = 0; i < CHAPTERS.length; i++) {
      if (f >= CHAPTERS[i].frameIn && f <= CHAPTERS[i].frameOut) { chIdx = i; break; }
    }
    if (chIdx === currentChapter) return;

    var next = chIdx;
    currentChapter = next;

    if (next < 0) {
      hideChapter();
      return;
    }
    hideChapter(function () { showChapter(next); });
  }

  /* ── ScrollTrigger ── */
  function initScroll() {
    if (loaderWrap) { gsap.to(loaderWrap, { opacity: 0, duration: 0.4, onComplete: function () { loaderWrap.remove(); } }); }

    drawFrame(0);
    currentChapter = 0;
    if (chapEl)  chapEl.textContent = CHAPTERS[0].chapter;
    if (titleEl) titleEl.innerHTML  = CHAPTERS[0].title;
    if (subEl)   subEl.textContent  = CHAPTERS[0].sub;
    if (counterEl) counterEl.textContent = '01 / 07';

    gsap.set(textEls, { opacity: 0, y: 40, clipPath: 'inset(0 0 100% 0)' });
    gsap.to(textEls, {
      opacity:  1,
      y:        0,
      clipPath: 'inset(0 0 0% 0)',
      duration: 1.1,
      ease:     'power4.out',
      stagger:  0.13,
      delay:    0.5,
    });

    if (progressNav) progressNav.classList.add('is-visible');
    if (dotEls[0]) dotEls[0].classList.add('is-active');

    /* Dot click → scroll vers le frameIn correspondant */
    dotEls.forEach(function (dot, i) {
      dot.addEventListener('click', function () {
        var targetFrame = CHAPTERS[i].frameIn;
        var pct = targetFrame / (TOTAL - 1);
        var totalScroll = TOTAL * PX_PER_FRAME;
        var wrapperTop  = wrapper.getBoundingClientRect().top + window.scrollY;
        window.scrollTo({ top: wrapperTop + pct * totalScroll, behavior: 'smooth' });
      });
    });

    var state = { frame: 0 };
    gsap.to(state, {
      frame: TOTAL - 1,
      ease:  'none',
      onUpdate: function () {
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
        onLeaveBack: function () { if (progressNav) progressNav.classList.remove('is-visible'); },
        onEnter:      function () { if (progressNav) progressNav.classList.add('is-visible'); },
      },
    });
  }

  loadAll().then(initScroll);

})();
