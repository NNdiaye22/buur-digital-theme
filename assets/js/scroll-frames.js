/**
 * BUUR Digital — scroll-frames.js v6.0
 * Sticky CSS natif — pas de GSAP pin
 * Le wrapper a la hauteur totale, le canvas sticky reste visible sans jamais se vider.
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

  var TOTAL = SEQUENCES.reduce(function (a, s) { return a + s.count; }, 0);

  /* Hauteur totale du wrapper = frames * px, injectée en CSS var */
  var TOTAL_HEIGHT = TOTAL * PX_PER_FRAME;

  var offsets = [];
  var acc = 0;
  SEQUENCES.forEach(function (s) { offsets.push(acc); acc += s.count; });

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
  var wrapper         = document.getElementById('scroll-frames');
  var sticky          = wrapper  ? wrapper.querySelector('.scroll-frames-sticky') : null;
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
  var servicesOverlay = document.getElementById('sf-services-overlay');
  var sfLabel         = servicesOverlay ? servicesOverlay.querySelector('.sf-services-label') : null;
  var sfCols          = servicesOverlay ? Array.prototype.slice.call(servicesOverlay.querySelectorAll('.sf-col')) : [];

  /* Hauteur du wrapper injectée */
  wrapper.style.setProperty('--sf-total-height', TOTAL_HEIGHT + 'px');
  wrapper.style.height = TOTAL_HEIGHT + 'px';

  /* Canvas resize */
  function resize() {
    canvas.width  = window.innerWidth;
    canvas.height = window.innerHeight;
    if (allImages.length) drawFrame(currentFrame);
  }
  resize();
  window.addEventListener('resize', resize);

  /* Chargement images */
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
    currentFrame = Math.max(0, Math.min(Math.round(f), TOTAL - 1));
    drawCover(allImages[currentFrame]);
  }

  /* ── Scroll : calcul du frame depuis scrollY ── */
  var wrapperTop = 0;
  var rafId      = null;
  var lastFrame  = -1;

  function onScroll() {
    if (rafId) return;
    rafId = requestAnimationFrame(tick);
  }

  function tick() {
    rafId = null;
    wrapperTop = wrapper.getBoundingClientRect().top + window.scrollY;
    var scrolled = window.scrollY - wrapperTop;
    var progress = Math.max(0, Math.min(scrolled / TOTAL_HEIGHT, 1));
    var frame    = progress * (TOTAL - 1);

    /* Visibilité des éléments overlay */
    var inside = scrolled >= 0 && scrolled < TOTAL_HEIGHT;
    if (progressNav) progressNav.classList.toggle('is-visible', inside);

    if (Math.abs(frame - lastFrame) < 0.3) return;
    lastFrame = frame;
    drawFrame(frame);
    updateText(frame);
  }

  window.addEventListener('scroll', onScroll, { passive: true });

  /* ── Services overlay ── */
  var overlayVisible = false;
  var overlayTween   = null;

  function showServicesOverlay() {
    if (overlayVisible || !servicesOverlay) return;
    overlayVisible = true;
    if (overlayTween) overlayTween.kill();
    servicesOverlay.classList.add('is-visible');
    gsap.set(sfLabel, { opacity: 0, y: 10 });
    gsap.set(sfCols,  { opacity: 0, y: 28 });
    var tl = gsap.timeline();
    tl.set(servicesOverlay, { opacity: 1 });
    tl.to(sfLabel, { opacity: 1, y: 0, duration: 0.5, ease: 'power2.out' });
    tl.to(sfCols, { opacity: 1, y: 0, duration: 0.6, ease: 'power3.out', stagger: 0.15 }, '-=0.2');
    overlayTween = tl;
  }

  function hideServicesOverlay() {
    if (!overlayVisible || !servicesOverlay) return;
    overlayVisible = false;
    if (overlayTween) overlayTween.kill();
    overlayTween = gsap.timeline();
    overlayTween.to([sfLabel].concat(sfCols), { opacity: 0, y: -16, duration: 0.35, ease: 'power2.in', stagger: 0.06 });
    overlayTween.set(servicesOverlay, { opacity: 0 });
    overlayTween.call(function () { servicesOverlay.classList.remove('is-visible'); });
  }

  /* ── Textes chapitres ── */
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
    if (f >= OVERLAY_IN && f <= OVERLAY_OUT) {
      showServicesOverlay();
    } else {
      hideServicesOverlay();
    }
    var chIdx = -1;
    for (var i = 0; i < CHAPTERS.length; i++) {
      if (f >= CHAPTERS[i].frameIn && f <= CHAPTERS[i].frameOut) { chIdx = i; break; }
    }
    if (chIdx === currentChapter) return;
    currentChapter = chIdx;
    if (chIdx < 0) { hideChapter(); return; }
    hideChapter(function () { showChapter(chIdx); });
  }

  /* ── Init ── */
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

    if (servicesOverlay) gsap.set(servicesOverlay, { opacity: 0 });
    if (sfLabel)         gsap.set(sfLabel, { opacity: 0 });
    if (sfCols.length)   gsap.set(sfCols,  { opacity: 0, y: 28 });

    gsap.set(textEls, { opacity: 0, y: 40, clipPath: 'inset(0 0 100% 0)' });
    gsap.to(textEls, { opacity: 1, y: 0, clipPath: 'inset(0 0 0% 0)', duration: 1.1, ease: 'power4.out', stagger: 0.13, delay: 0.5 });

    /* Navigation dots */
    dotEls.forEach(function (dot, i) {
      dot.addEventListener('click', function () {
        var pct = CHAPTERS[i].frameIn / (TOTAL - 1);
        wrapperTop = wrapper.getBoundingClientRect().top + window.scrollY;
        window.scrollTo({ top: wrapperTop + pct * TOTAL_HEIGHT, behavior: 'smooth' });
      });
    });

    /* Premier tick */
    tick();
  }

  loadAll().then(initScroll);

})();
