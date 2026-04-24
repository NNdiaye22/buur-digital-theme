/**
 * BUUR Digital — scroll-frames.js v6.2
 * Overlay ADN (fin ch05 → ch06) + Overlay Services (fin ch06 → ch07)
 */
(function () {
  'use strict';

  if (!window.gsap) return;

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

  var TOTAL        = SEQUENCES.reduce(function (a, s) { return a + s.count; }, 0);
  var TOTAL_HEIGHT = TOTAL * PX_PER_FRAME;

  var offsets = [];
  var acc = 0;
  SEQUENCES.forEach(function (s) { offsets.push(acc); acc += s.count; });

  /* ADN : fin ch05 (65%) → début ch06 (25%) */
  var ADN_IN   = offsets[4] + Math.round((offsets[5] - offsets[4]) * 0.65);
  var ADN_OUT  = offsets[5] + Math.round((offsets[6] - offsets[5]) * 0.25);

  /* Services : fin ch06 (65%) → début ch07 (20%) */
  var SVC_IN   = offsets[5] + Math.round((offsets[6] - offsets[5]) * 0.65);
  var SVC_OUT  = offsets[6] + Math.round((TOTAL - offsets[6]) * 0.20);

  var CHAPTERS = [
    { frameIn: offsets[0], frameOut: offsets[1]-1, chapter:'01', title:'Strat\u00e9gie <em>Digitale</em>',   sub:'Une vision claire pour dominer votre march\u00e9 en ligne.' },
    { frameIn: offsets[1], frameOut: offsets[2]-1, chapter:'02', title:'Design <em>Premium</em>',        sub:'Des interfaces qui captivent, engagent et convertissent.' },
    { frameIn: offsets[2], frameOut: offsets[3]-1, chapter:'03', title:'Code <em>Sur-Mesure</em>',       sub:'Rapide, propre, \u00e9volutif \u2014 construit pour durer.' },
    { frameIn: offsets[3], frameOut: offsets[4]-1, chapter:'04', title:'SEO & <em>Performance</em>',     sub:'Premier sur Google. Rapide sur tous les \u00e9crans.' },
    { frameIn: offsets[4], frameOut: offsets[5]-1, chapter:'05', title:'E-<em>Commerce</em>',            sub:'Votre boutique pens\u00e9e pour vendre, 24h/24.' },
    { frameIn: offsets[5], frameOut: offsets[6]-1, chapter:'06', title:'Support <em>D\u00e9di\u00e9</em>', sub:'Une \u00e9quipe disponible pour faire grandir votre projet.' },
    { frameIn: offsets[6], frameOut: TOTAL-1,      chapter:'07', title:'R\u00e9sultats <em>Mesurables</em>', sub:'Chaque action optimis\u00e9e. Chaque chiffre suivi.' },
  ];

  /* DOM */
  var wrapper         = document.getElementById('scroll-frames');
  var canvas          = document.getElementById('scroll-main-canvas');
  if (!wrapper || !canvas) return;
  var ctx             = canvas.getContext('2d');
  var chapEl          = document.getElementById('sf-chapter');
  var titleEl         = document.getElementById('sf-title');
  var subEl           = document.getElementById('sf-sub');
  var counterEl       = document.getElementById('sf-counter');
  var loaderWrap      = document.getElementById('sf-loader-wrap');
  var loaderBar       = document.getElementById('sf-loader-bar');
  var progressNav     = document.getElementById('sf-progress');
  var dotEls          = progressNav ? Array.prototype.slice.call(progressNav.querySelectorAll('.sf-dot')) : [];

  var adnOverlay      = document.getElementById('sf-adn-overlay');
  var adnLion         = adnOverlay  ? adnOverlay.querySelector('.sf-adn-lion')    : null;
  var adnHalo         = adnOverlay  ? adnOverlay.querySelector('.sf-adn-halo')    : null;
  var adnEyebrow      = adnOverlay  ? adnOverlay.querySelector('.sf-adn-eyebrow') : null;
  var adnTitle        = adnOverlay  ? adnOverlay.querySelector('.sf-adn-title')   : null;
  var adnIntro        = adnOverlay  ? adnOverlay.querySelector('.sf-adn-intro')   : null;
  var adnValeurs      = adnOverlay  ? Array.prototype.slice.call(adnOverlay.querySelectorAll('.sf-adn-valeur')) : [];

  var svcOverlay      = document.getElementById('sf-services-overlay');
  var sfLabel         = svcOverlay  ? svcOverlay.querySelector('.sf-services-label') : null;
  var sfCols          = svcOverlay  ? Array.prototype.slice.call(svcOverlay.querySelectorAll('.sf-col')) : [];

  /* Hauteur wrapper */
  wrapper.style.height = TOTAL_HEIGHT + 'px';

  function getOffsetTop(el) {
    var top = 0;
    while (el) { top += el.offsetTop; el = el.offsetParent; }
    return top;
  }
  var wrapperTop = 0;
  function updateWrapperTop() { wrapperTop = getOffsetTop(wrapper); }

  function resize() {
    canvas.width  = window.innerWidth;
    canvas.height = window.innerHeight;
    updateWrapperTop();
    if (allImages.length) drawFrame(currentFrame);
  }
  window.addEventListener('resize', resize);

  var allImages = [], totalLoaded = 0;

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

  var currentFrame = 0, currentChapter = -1, textTween = null;

  function drawFrame(f) {
    currentFrame = Math.max(0, Math.min(Math.round(f), TOTAL - 1));
    drawCover(allImages[currentFrame]);
  }

  var rafId = null, lastFrame = -1;

  function onScroll() { if (!rafId) rafId = requestAnimationFrame(tick); }

  function tick() {
    rafId = null;
    var scrolled = window.scrollY - wrapperTop;
    var progress = Math.max(0, Math.min(scrolled / TOTAL_HEIGHT, 1));
    var frame    = progress * (TOTAL - 1);
    var inside   = scrolled >= 0 && scrolled < TOTAL_HEIGHT;
    if (progressNav) progressNav.classList.toggle('is-visible', inside);
    if (Math.abs(frame - lastFrame) < 0.3) return;
    lastFrame = frame;
    drawFrame(frame);
    updateText(frame);
  }

  window.addEventListener('scroll', onScroll, { passive: true });

  /* ── ADN overlay ── */
  var adnVisible = false, adnTween = null;

  function showAdn() {
    if (adnVisible || !adnOverlay) return;
    adnVisible = true;
    if (adnTween) adnTween.kill();
    adnOverlay.classList.add('is-visible');

    /* Reset */
    gsap.set(adnOverlay,  { opacity: 1 });
    gsap.set(adnLion,     { opacity: 0, scale: 0.82 });
    gsap.set(adnHalo,     { opacity: 0, scale: 0.7 });
    gsap.set(adnEyebrow,  { opacity: 0, y: 12 });
    gsap.set(adnTitle,    { opacity: 0, clipPath: 'inset(0 0 100% 0)' });
    gsap.set(adnIntro,    { opacity: 0, y: 10 });
    gsap.set(adnValeurs,  { opacity: 0, x: -16 });

    var tl = gsap.timeline();
    /* Lion + halo */
    tl.to(adnLion, { opacity: 1, scale: 1, duration: 0.9, ease: 'power3.out' });
    tl.to(adnHalo, { opacity: 1, scale: 1, duration: 1.2, ease: 'power2.out' }, '<');
    /* Eyebrow */
    tl.to(adnEyebrow, { opacity: 1, y: 0, duration: 0.5, ease: 'power2.out' }, '-=0.4');
    /* Titre clip-path reveal */
    tl.to(adnTitle, { opacity: 1, clipPath: 'inset(0 0 0% 0)', duration: 0.7, ease: 'power4.out' }, '-=0.2');
    /* Intro */
    tl.to(adnIntro, { opacity: 1, y: 0, duration: 0.5, ease: 'power2.out' }, '-=0.2');
    /* Valeurs en stagger — slide depuis la gauche */
    tl.to(adnValeurs, { opacity: 1, x: 0, duration: 0.5, ease: 'power3.out', stagger: 0.18 }, '-=0.1');

    adnTween = tl;
  }

  function hideAdn() {
    if (!adnVisible || !adnOverlay) return;
    adnVisible = false;
    if (adnTween) adnTween.kill();
    adnTween = gsap.timeline();
    adnTween.to(adnValeurs.concat([adnIntro, adnTitle, adnEyebrow]), {
      opacity: 0, y: -12, duration: 0.3, ease: 'power2.in', stagger: 0.05,
    });
    adnTween.to([adnLion, adnHalo], { opacity: 0, scale: 0.9, duration: 0.35, ease: 'power2.in' }, '-=0.15');
    adnTween.set(adnOverlay, { opacity: 0 });
    adnTween.call(function () { adnOverlay.classList.remove('is-visible'); });
  }

  /* ── Services overlay ── */
  var svcVisible = false, svcTween = null;

  function showSvc() {
    if (svcVisible || !svcOverlay) return;
    svcVisible = true;
    if (svcTween) svcTween.kill();
    svcOverlay.classList.add('is-visible');
    gsap.set(sfLabel, { opacity: 0, y: 10 });
    gsap.set(sfCols,  { opacity: 0, y: 28 });
    var tl = gsap.timeline();
    tl.set(svcOverlay, { opacity: 1 });
    tl.to(sfLabel, { opacity: 1, y: 0, duration: 0.5, ease: 'power2.out' });
    tl.to(sfCols,  { opacity: 1, y: 0, duration: 0.6, ease: 'power3.out', stagger: 0.15 }, '-=0.2');
    svcTween = tl;
  }

  function hideSvc() {
    if (!svcVisible || !svcOverlay) return;
    svcVisible = false;
    if (svcTween) svcTween.kill();
    svcTween = gsap.timeline();
    svcTween.to([sfLabel].concat(sfCols), { opacity: 0, y: -16, duration: 0.35, ease: 'power2.in', stagger: 0.06 });
    svcTween.set(svcOverlay, { opacity: 0 });
    svcTween.call(function () { svcOverlay.classList.remove('is-visible'); });
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
    textTween = gsap.to(textEls, { opacity: 1, y: 0, clipPath: 'inset(0 0 0% 0)', duration: 0.9, ease: 'power4.out', stagger: 0.11 });
  }

  function hideChapter(onDone) {
    if (textTween) textTween.kill();
    textTween = gsap.to(textEls, { opacity: 0, y: -28, clipPath: 'inset(0 0 100% 0)', duration: 0.45, ease: 'power3.in', onComplete: onDone || null });
  }

  function updateText(f) {
    /* Overlays */
    if      (f >= ADN_IN && f <= ADN_OUT) { showAdn(); hideSvc(); }
    else if (f >= SVC_IN && f <= SVC_OUT) { hideSvc(); showSvc(); hideAdn(); }
    else                                  { hideAdn(); hideSvc(); }

    /* Chapitres */
    var chIdx = -1;
    for (var i = 0; i < CHAPTERS.length; i++) {
      if (f >= CHAPTERS[i].frameIn && f <= CHAPTERS[i].frameOut) { chIdx = i; break; }
    }
    if (chIdx === currentChapter) return;
    currentChapter = chIdx;
    if (chIdx < 0) { hideChapter(); return; }
    hideChapter(function () { showChapter(chIdx); });
  }

  function initScroll() {
    canvas.width  = window.innerWidth;
    canvas.height = window.innerHeight;
    updateWrapperTop();

    if (loaderWrap) gsap.to(loaderWrap, { opacity: 0, duration: 0.4, onComplete: function () { loaderWrap.remove(); } });

    drawFrame(0);
    currentChapter = 0;
    if (chapEl)    chapEl.textContent    = CHAPTERS[0].chapter;
    if (titleEl)   titleEl.innerHTML     = CHAPTERS[0].title;
    if (subEl)     subEl.textContent     = CHAPTERS[0].sub;
    if (counterEl) counterEl.textContent = '01 / 07';
    if (progressNav) progressNav.classList.add('is-visible');
    if (dotEls[0]) dotEls[0].classList.add('is-active');

    if (adnOverlay) gsap.set(adnOverlay, { opacity: 0 });
    if (svcOverlay) gsap.set(svcOverlay, { opacity: 0 });
    if (sfLabel)    gsap.set(sfLabel,    { opacity: 0 });
    if (sfCols.length) gsap.set(sfCols,  { opacity: 0, y: 28 });

    gsap.set(textEls, { opacity: 0, y: 40, clipPath: 'inset(0 0 100% 0)' });
    gsap.to(textEls,  { opacity: 1, y: 0, clipPath: 'inset(0 0 0% 0)', duration: 1.1, ease: 'power4.out', stagger: 0.13, delay: 0.5 });

    dotEls.forEach(function (dot, i) {
      dot.addEventListener('click', function () {
        var pct = CHAPTERS[i].frameIn / (TOTAL - 1);
        window.scrollTo({ top: wrapperTop + pct * TOTAL_HEIGHT, behavior: 'smooth' });
      });
    });

    tick();
  }

  loadAll().then(initScroll);

})();
