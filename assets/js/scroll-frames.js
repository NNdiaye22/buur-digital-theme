/**
 * BUUR Digital — scroll-frames.js v5.2
 * Services hologramme overlay : apparaît fin ch06, disparaît début ch07
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

  /* Chapitre 06 : offsets[5] → offsets[6]-1
     Chapitre 07 : offsets[6] → TOTAL-1
     L'overlay apparaît à 65% du ch06 et disparaît à 20% du ch07 */
  var OVERLAY_IN  = offsets[5] + Math.round((offsets[6] - offsets[5]) * 0.65);
  var OVERLAY_OUT = offsets[6] + Math.round((TOTAL - offsets[6]) * 0.20);

  var CHAPTERS = [
    { frameIn: offsets[0], frameOut: offsets[1] - 1, chapter: '01', title: 'Strat\u00e9gie <em>Digitale</em>',   sub: 'Une vision claire pour dominer votre march\u00e9 en ligne.' },
    { frameIn: offsets[1], frameOut: offsets[2] - 1, chapter: '02', title: 'Design <em>Premium</em>',        sub: 'Des interfaces qui captivent, engagent et convertissent.' },
    { frameIn: offsets[2], frameOut: offsets[3] - 1, chapter: '03', title: 'Code <em>Sur-Mesure</em>',       sub: 'Rapide, propre, \u00e9volutif \u2014 construit pour durer.' },
    { frameIn: offsets[3], frameOut: offsets[4] - 1, chapter: '04', title: 'SEO & <em>Performance</em>',     sub: 'Premier sur Google. Rapide sur tous les \u00e9crans.' },
    { frameIn: offsets[4], frameOut: offsets[5] - 1, chapter: '05', title: 'E-<em>Commerce</em>',            sub: 'Votre boutique pens\u00e9e pour vendre, 24h/24.' },
    { frameIn: offsets[5], frameOut: offsets[6] - 1, chapter: '06', title: 'Support <em>D\u00e9di\u00e9</em>', sub: 'Une \u00e9quipe disponible pour faire grandir votre projet.' },
    { frameIn: offsets[6], frameOut: TOTAL - 1,      chapter: '07', title: 'R\u00e9sultats <em>Mesurables</em>', sub: 'Chaque action optimis\u00e9e. Chaque chiffre suivi.' },
  ];

  /* DOM */
  var wrapper        = document.querySelector('.scroll-frames-wrapper');
  var canvas         = document.getElementById('scroll-main-canvas');
  if (!wrapper || !canvas) return;
  var ctx            = canvas.getContext('2d');
  var chapEl         = document.getElementById('sf-chapter');
  var titleEl        = document.getElementById('sf-title');
  var subEl          = document.getElementById('sf-sub');
  var counterEl      = document.getElementById('sf-counter');
  var loaderWrap     = document.getElementById('sf-loader-wrap');
  var loaderBar      = document.getElementById('sf-loader-bar');
  var progressNav    = document.getElementById('sf-progress');
  var dotEls         = progressNav ? Array.prototype.slice.call(progressNav.querySelectorAll('.sf-dot')) : [];
  var servicesOverlay = document.getElementById('sf-services-overlay');
  var sfCols         = servicesOverlay ? Array.prototype.slice.call(servicesOverlay.querySelectorAll('.sf-col')) : [];

  /* Canvas resize */
  function resize() {
    canvas.width  = window.innerWidth;
    canvas.height = window.innerHeight;
  }
  resize();
  window.addEventListener('resize', function () { resize(); if (allImages.length) drawFrame(currentFrame); });

  /* Chargement */
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

  /* Dessin */
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

  /* ── Services overlay ── */
  var overlayVisible = false;
  var overlayTween   = null;

  function showServicesOverlay() {
    if (overlayVisible || !servicesOverlay) return;
    overlayVisible = true;
    if (overlayTween) overlayTween.kill();

    servicesOverlay.classList.add('is-visible');

    /* Reset colonnes */
    gsap.set(sfCols, { opacity: 0, y: 32, filter: 'blur(6px)' });

    var tl = gsap.timeline();
    /* Overlay fade in avec léger glitch skew */
    tl.to(servicesOverlay, {
      opacity: 1, duration: 0.5, ease: 'power2.out',
      onStart: function () {
        gsap.fromTo(servicesOverlay,
          { skewX: 3 },
          { skewX: 0, duration: 0.18, ease: 'power1.out' }
        );
      },
    });
    /* Colonnes en stagger — entrée hologramme */
    tl.to(sfCols, {
      opacity: 1, y: 0, filter: 'blur(0px)',
      duration: 0.55, ease: 'power3.out', stagger: 0.14,
    }, '-=0.15');

    /* Micro glitch sur chaque col */
    sfCols.forEach(function (col, i) {
      gsap.fromTo(col,
        { x: (i % 2 === 0 ? -6 : 6) },
        { x: 0, duration: 0.12, delay: 0.35 + i * 0.14, ease: 'power1.out' }
      );
    });

    overlayTween = tl;
  }

  function hideServicesOverlay() {
    if (!overlayVisible || !servicesOverlay) return;
    overlayVisible = false;
    if (overlayTween) overlayTween.kill();

    overlayTween = gsap.timeline();
    overlayTween.to(sfCols, {
      opacity: 0, y: -20, filter: 'blur(4px)',
      duration: 0.3, ease: 'power2.in', stagger: 0.07,
    });
    overlayTween.to(servicesOverlay, {
      opacity: 0, skewX: -2, duration: 0.25, ease: 'power2.in',
      onComplete: function () {
        servicesOverlay.classList.remove('is-visible');
        gsap.set(servicesOverlay, { skewX: 0 });
      },
    }, '-=0.1');
  }

  /* Textes chapitres */
  var textEls = [chapEl, titleEl, subEl].filter(Boolean);

  function showChapter(idx) {
    if (textTween) textTween.kill();
    var ch = CHAPTERS[idx];
    if (chapEl)    chapEl.textContent    = ch.chapter;
    if (titleEl)   titleEl.innerHTML     = ch.title;
    if (subEl)     subEl.textContent     = ch.sub;
    if (counterEl) counterEl.textContent = '0' + (idx + 1) + ' / 07';
    dotEls.forEach(function (d, j) { d.classList.toggle('is-active', j === idx); });
    gsap.set(textEls, { opacity: 0, y: 40, clipPath: 'inset(0 0 100% 0)' });
    textTween = gsap.to(textEls, {
      opacity: 1, y: 0, clipPath: 'inset(0 0 0% 0)',
      duration: 0.9, ease: 'power4.out', stagger: 0.11,
    });
  }

  function hideChapter(onDone) {
    if (textTween) textTween.kill();
    textTween = gsap.to(textEls, {
      opacity: 0, y: -28, clipPath: 'inset(0 0 100% 0)',
      duration: 0.45, ease: 'power3.in',
      onComplete: onDone || null,
    });
  }

  function updateText(f) {
    /* Gestion overlay services */
    if (f >= OVERLAY_IN && f <= OVERLAY_OUT) {
      showServicesOverlay();
    } else {
      hideServicesOverlay();
    }

    /* Gestion chapitres normaux */
    var chIdx = -1;
    for (var i = 0; i < CHAPTERS.length; i++) {
      if (f >= CHAPTERS[i].frameIn && f <= CHAPTERS[i].frameOut) { chIdx = i; break; }
    }
    if (chIdx === currentChapter) return;
    currentChapter = chIdx;
    if (chIdx < 0) { hideChapter(); return; }
    hideChapter(function () { showChapter(chIdx); });
  }

  /* Init scroll */
  function initScroll() {
    if (loaderWrap) {
      gsap.to(loaderWrap, { opacity: 0, duration: 0.4, onComplete: function () { loaderWrap.remove(); } });
    }

    drawFrame(0);
    currentChapter = 0;
    if (chapEl)    chapEl.textContent    = CHAPTERS[0].chapter;
    if (titleEl)   titleEl.innerHTML     = CHAPTERS[0].title;
    if (subEl)     subEl.textContent     = CHAPTERS[0].sub;
    if (counterEl) counterEl.textContent = '01 / 07';
    if (progressNav) progressNav.classList.add('is-visible');
    if (dotEls[0]) dotEls[0].classList.add('is-active');

    /* Reset overlay */
    if (servicesOverlay) gsap.set(servicesOverlay, { opacity: 0 });
    if (sfCols.length)   gsap.set(sfCols, { opacity: 0, y: 32 });

    gsap.set(textEls, { opacity: 0, y: 40, clipPath: 'inset(0 0 100% 0)' });
    gsap.to(textEls, {
      opacity: 1, y: 0, clipPath: 'inset(0 0 0% 0)',
      duration: 1.1, ease: 'power4.out', stagger: 0.13, delay: 0.5,
    });

    dotEls.forEach(function (dot, i) {
      dot.addEventListener('click', function () {
        var pct        = CHAPTERS[i].frameIn / (TOTAL - 1);
        var wrapperTop = wrapper.getBoundingClientRect().top + window.scrollY;
        window.scrollTo({ top: wrapperTop + pct * TOTAL * PX_PER_FRAME, behavior: 'smooth' });
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
        onLeave:     function () {
          hideServicesOverlay();
          if (progressNav) progressNav.classList.remove('is-visible');
        },
        onLeaveBack: function () { if (progressNav) progressNav.classList.remove('is-visible'); },
        onEnter:     function () { if (progressNav) progressNav.classList.add('is-visible'); },
        onEnterBack: function () { if (progressNav) progressNav.classList.add('is-visible'); },
      },
    });
  }

  loadAll().then(initScroll);

})();
