/**
 * BUUR Digital — scroll-frames.js v7.1
 * Chargement progressif 3 phases :
 *   Phase 1 : ch01 (192 frames) → affichage immédiat, loader masqué
 *   Phase 2 : ch02+ch03 en arrière-plan (requestIdleCallback)
 *             → forcé si scroll approche du ch02 avant la fin idle
 *   Phase 3 : ch04→ch07 en arrière-plan
 * Vidéos services : lazy load au moment où l'overlay devient visible
 */
(function () {
  'use strict';

  if (!window.gsap) return;

  var THEME_URL   = (window.buurTheme && window.buurTheme.url) ? window.buurTheme.url : '';
  var FRAMES_PATH = THEME_URL + '/assets/frames';
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

  var ADN_IN   = offsets[4] + Math.round((offsets[5] - offsets[4]) * 0.55);
  var ADN_PEAK = offsets[4] + Math.round((offsets[5] - offsets[4]) * 0.75);
  var ADN_OUT  = offsets[5] + Math.round((offsets[6] - offsets[5]) * 0.40);

  var SVC_IN   = offsets[5] + Math.round((offsets[6] - offsets[5]) * 0.55);
  var SVC_PEAK = offsets[5] + Math.round((offsets[6] - offsets[5]) * 0.75);
  var SVC_OUT  = offsets[6] + Math.round((TOTAL - offsets[6]) * 0.35);

  var CHAPTERS = [
    { frameIn: offsets[0], frameOut: offsets[1]-1, chapter:'01', title:'Strat\u00e9gie <em>Digitale</em>',    sub:'Une vision claire pour dominer votre march\u00e9 en ligne.' },
    { frameIn: offsets[1], frameOut: offsets[2]-1, chapter:'02', title:'Design <em>Premium</em>',             sub:'Des interfaces qui captivent, engagent et convertissent.' },
    { frameIn: offsets[2], frameOut: offsets[3]-1, chapter:'03', title:'Code <em>Sur-Mesure</em>',            sub:'Rapide, propre, \u00e9volutif \u2014 construit pour durer.' },
    { frameIn: offsets[3], frameOut: offsets[4]-1, chapter:'04', title:'SEO & <em>Performance</em>',          sub:'Premier sur Google. Rapide sur tous les \u00e9crans.' },
    { frameIn: offsets[4], frameOut: offsets[5]-1, chapter:'05', title:'E-<em>Commerce</em>',                 sub:'Votre boutique pens\u00e9e pour vendre, 24h/24.' },
    { frameIn: offsets[5], frameOut: offsets[6]-1, chapter:'06', title:'Support <em>D\u00e9di\u00e9</em>',    sub:'Une \u00e9quipe disponible pour faire grandir votre projet.' },
    { frameIn: offsets[6], frameOut: TOTAL-1,      chapter:'07', title:'R\u00e9sultats <em>Mesurables</em>',  sub:'Chaque action optimis\u00e9e. Chaque chiffre suivi.' },
  ];

  var wrapper     = document.getElementById('scroll-frames');
  var canvas      = document.getElementById('scroll-main-canvas');
  if (!wrapper || !canvas) return;
  var ctx         = canvas.getContext('2d');
  var chapEl      = document.getElementById('sf-chapter');
  var titleEl     = document.getElementById('sf-title');
  var subEl       = document.getElementById('sf-sub');
  var counterEl   = document.getElementById('sf-counter');
  var loaderWrap  = document.getElementById('sf-loader-wrap');
  var loaderBar   = document.getElementById('sf-loader-bar');
  var progressNav = document.getElementById('sf-progress');
  var dotEls      = progressNav ? Array.prototype.slice.call(progressNav.querySelectorAll('.sf-dot')) : [];

  var adnOverlay    = document.getElementById('sf-adn-overlay');
  var adnEyebrow    = adnOverlay ? adnOverlay.querySelector('.sf-adn-eyebrow')    : null;
  var adnTitleEl    = adnOverlay ? adnOverlay.querySelector('.sf-adn-title')      : null;
  var adnHalo       = adnOverlay ? adnOverlay.querySelector('.sf-adn-halo')       : null;
  var adnConnectors = adnOverlay ? adnOverlay.querySelector('.sf-adn-connectors') : null;
  var adnValeurs    = adnOverlay ? Array.prototype.slice.call(adnOverlay.querySelectorAll('.sf-adn-valeur')) : [];

  var svcOverlay    = document.getElementById('sf-services-overlay');
  var svcVideos     = svcOverlay ? Array.prototype.slice.call(svcOverlay.querySelectorAll('video[data-src]')) : [];
  var svcVideosLoaded = false;

  wrapper.style.height = TOTAL_HEIGHT + 'px';

  var wrapperTop = 0;
  function updateWrapperTop() {
    wrapperTop = wrapper.getBoundingClientRect().top + window.scrollY;
  }

  function resize() {
    canvas.width  = window.innerWidth;
    canvas.height = window.innerHeight;
    updateWrapperTop();
    if (allImages[0]) drawFrame(currentFrame);
  }
  window.addEventListener('resize', resize);

  /* ============================================================
   * IMAGES : tableau plat pré-alloué, rempli par phases
   * ============================================================ */
  var allImages = new Array(TOTAL);
  var totalLoaded = 0;

  /* FIX v7.1 : flags pour éviter un double déclenchement du chargement */
  var phase2Started = false;
  var phase3Started = false;

  function frameSrc(seqId, idx) {
    return FRAMES_PATH + '/' + seqId + '/frame_' + String(idx + 1).padStart(3, '0') + '.jpg';
  }

  function loadRange(seqStart, seqEnd, onDone) {
    var toLoad = 0;
    var done   = 0;
    for (var si = seqStart; si <= seqEnd; si++) {
      toLoad += SEQUENCES[si].count;
    }
    if (toLoad === 0) { if (onDone) onDone(); return; }

    for (var s = seqStart; s <= seqEnd; s++) {
      (function (seq, globalOffset) {
        for (var i = 0; i < seq.count; i++) {
          (function (li) {
            var img    = new Image();
            var absIdx = globalOffset + li;
            img.onload = img.onerror = function () {
              allImages[absIdx] = img;
              totalLoaded++;
              done++;
              if (loaderBar) loaderBar.style.width = (totalLoaded / TOTAL * 100) + '%';
              if (done === toLoad && onDone) onDone();
            };
            img.src = frameSrc(seq.id, li);
          })(i);
        }
      })(SEQUENCES[s], offsets[s]);
    }
  }

  function idle(fn) {
    if (window.requestIdleCallback) { requestIdleCallback(fn, { timeout: 2000 }); }
    else { setTimeout(fn, 200); }
  }

  /* FIX v7.1 : déclenche la phase 2 si elle n'a pas encore démarré */
  function ensurePhase2() {
    if (phase2Started) return;
    phase2Started = true;
    loadRange(1, 2, function () {
      if (!phase3Started) {
        phase3Started = true;
        idle(function () { loadRange(3, 6, null); });
      }
    });
  }

  /* ============================================================
   * DESSIN
   * ============================================================ */
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

  /* FIX v7.1 : si la frame cible n'est pas encore chargée,
   * on cherche la frame disponible la plus proche pour éviter un écran vide */
  function drawFrame(f) {
    var idx = Math.max(0, Math.min(Math.round(f), TOTAL - 1));
    currentFrame = idx;
    if (allImages[idx]) {
      drawCover(allImages[idx]);
      return;
    }
    /* Fallback : cherche la frame chargée la plus proche (max 60 frames) */
    for (var d = 1; d <= 60; d++) {
      if (idx - d >= 0 && allImages[idx - d]) { drawCover(allImages[idx - d]); return; }
      if (idx + d < TOTAL && allImages[idx + d]) { drawCover(allImages[idx + d]); return; }
    }
  }

  /* ============================================================
   * OVERLAYS
   * ============================================================ */
  function zoneT(f, inF, outF) {
    if (f <= inF) return 0;
    if (f >= outF) return 1;
    return (f - inF) / (outF - inF);
  }

  function scrubOpacity(f, inF, peak, outF) {
    if (f < inF || f > outF) return 0;
    if (f <= peak) return (f - inF) / (peak - inF);
    var fadeStart = peak + Math.round((outF - peak) * 0.65);
    if (f <= fadeStart) return 1;
    return 1 - (f - fadeStart) / (outF - fadeStart);
  }

  function lerp(a, b, t) { return a + (b - a) * t; }
  function clamp01(v)    { return Math.max(0, Math.min(1, v)); }

  function lazyLoadSvcVideos() {
    if (svcVideosLoaded) return;
    svcVideosLoaded = true;
    svcVideos.forEach(function (v) {
      if (v.dataset.src) { v.src = v.dataset.src; v.load(); }
    });
  }

  function updateOverlays(f) {

    /* —— ADN —— */
    var adnOp = scrubOpacity(f, ADN_IN, ADN_PEAK, ADN_OUT);
    if (adnOverlay) {
      adnOverlay.style.opacity       = adnOp;
      adnOverlay.style.pointerEvents = adnOp > 0.05 ? 'auto' : 'none';
    }
    if (adnOp > 0) {
      var tIn = clamp01(zoneT(f, ADN_IN, ADN_PEAK));
      if (adnEyebrow)    { adnEyebrow.style.opacity = tIn; adnEyebrow.style.transform = 'translateY(' + lerp(-20,0,tIn) + 'px)'; }
      if (adnTitleEl)    { adnTitleEl.style.opacity = tIn; adnTitleEl.style.clipPath = 'inset(0 0 0% 0)'; adnTitleEl.style.transform = 'translateY(' + lerp(-12,0,tIn) + 'px)'; }
      if (adnHalo)       { adnHalo.style.opacity = lerp(0,0.95,tIn); adnHalo.style.transform = 'translate(-50%,-50%) scale(' + lerp(0.5,1,tIn) + ')'; }
      if (adnConnectors) { adnConnectors.style.opacity = tIn; }
      adnValeurs.forEach(function (card, i) {
        var tx = 0, ty = 0;
        if      (card.classList.contains('sf-adn-valeur--excellence'))    { tx = -16; ty =  -8; }
        else if (card.classList.contains('sf-adn-valeur--accessibilite')) { tx = -16; ty =   8; }
        else if (card.classList.contains('sf-adn-valeur--innovation'))    { tx =  16; ty =   0; }
        var delay = i * 0.12;
        var tCard = clamp01((tIn - delay) / (1 - delay || 0.88));
        card.style.opacity   = tCard;
        card.style.transform = 'perspective(700px) translate(' + tx + 'px,' + lerp(30,ty,tCard) + 'px) rotateX(' + lerp(38,0,tCard) + 'deg)';
      });
    } else {
      if (adnEyebrow)    adnEyebrow.style.opacity    = 0;
      if (adnTitleEl)    adnTitleEl.style.opacity    = 0;
      if (adnHalo)       adnHalo.style.opacity       = 0;
      if (adnConnectors) adnConnectors.style.opacity = 0;
      adnValeurs.forEach(function (c) { c.style.opacity = 0; });
    }

    /* —— SERVICES —— */
    var svcOp = scrubOpacity(f, SVC_IN, SVC_PEAK, SVC_OUT);
    if (svcOverlay) {
      svcOverlay.style.opacity       = svcOp;
      svcOverlay.style.pointerEvents = svcOp > 0.05 ? 'auto' : 'none';
    }
    /* Lazy load vidéos dès que l'overlay commence à être visible */
    if (svcOp > 0) lazyLoadSvcVideos();

    if (svcOp > 0) {
      var tSvcIn = clamp01(zoneT(f, SVC_IN, SVC_PEAK));
      var svcCards = svcOverlay ? Array.prototype.slice.call(svcOverlay.querySelectorAll('.service-card')) : [];
      svcCards.forEach(function (card, i) {
        var delay = i * 0.10;
        var tCol  = clamp01((tSvcIn - delay) / (1 - delay || 0.90));
        card.style.opacity   = tCol;
        card.style.transform = 'perspective(900px) translateY(' + lerp(32,0,tCol) + 'px) rotateY(' + lerp(20,0,tCol) + 'deg)';
      });
    } else if (svcOverlay) {
      var svcCards2 = Array.prototype.slice.call(svcOverlay.querySelectorAll('.service-card'));
      svcCards2.forEach(function (c) { c.style.opacity = 0; });
    }
  }

  /* ============================================================
   * TEXTE CHAPITRES
   * ============================================================ */
  var textEls = [chapEl, titleEl, subEl].filter(Boolean);

  function showChapter(idx) {
    if (textTween) textTween.kill();
    var ch = CHAPTERS[idx];
    if (chapEl)    chapEl.textContent    = ch.chapter;
    if (titleEl)   titleEl.innerHTML     = ch.title;
    if (subEl)     subEl.textContent     = ch.sub;
    if (counterEl) counterEl.textContent = '0' + (idx+1) + ' / 07';
    dotEls.forEach(function (d, j) { d.classList.toggle('is-active', j === idx); });
    gsap.set(textEls, { opacity: 0, y: 40, clipPath: 'inset(0 0 100% 0)' });
    textTween = gsap.to(textEls, { opacity:1, y:0, clipPath:'inset(0 0 0% 0)', duration:0.9, ease:'power4.out', stagger:0.11 });
  }

  function hideChapter(onDone) {
    if (textTween) textTween.kill();
    textTween = gsap.to(textEls, { opacity:0, y:-28, clipPath:'inset(0 0 100% 0)', duration:0.45, ease:'power3.in', onComplete: onDone || null });
  }

  function updateText(f) {
    var chIdx = -1;
    for (var i = 0; i < CHAPTERS.length; i++) {
      if (f >= CHAPTERS[i].frameIn && f <= CHAPTERS[i].frameOut) { chIdx = i; break; }
    }
    if (chIdx === currentChapter) return;
    currentChapter = chIdx;
    if (chIdx < 0) { hideChapter(); return; }
    hideChapter(function () { showChapter(chIdx); });
  }

  /* ============================================================
   * BOUCLE SCROLL
   * ============================================================ */
  var rafId = null;
  function onScroll() { if (!rafId) rafId = requestAnimationFrame(tick); }

  function tick() {
    rafId = null;
    var scrolled = window.scrollY - wrapperTop;
    var progress = Math.max(0, Math.min(scrolled / TOTAL_HEIGHT, 1));
    var frame    = progress * (TOTAL - 1);
    var inside   = scrolled >= 0 && scrolled < TOTAL_HEIGHT;
    if (progressNav) progressNav.classList.toggle('is-visible', inside);

    /* FIX v7.1 : si on approche de la zone ch02 (30 frames avant) et que
     * la phase 2 n'a pas encore démarré, on la force immédiatement */
    if (!phase2Started && frame >= offsets[1] - 30) {
      ensurePhase2();
    }

    drawFrame(frame);
    updateOverlays(frame);
    updateText(frame);
  }

  window.addEventListener('scroll', onScroll, { passive: true });

  /* ============================================================
   * INIT : Phase 1 → affichage immédiat dès ch01 chargé
   * ============================================================ */
  function initScroll() {
    canvas.width  = window.innerWidth;
    canvas.height = window.innerHeight;
    updateWrapperTop();

    if (loaderWrap) gsap.to(loaderWrap, { opacity:0, duration:0.4, onComplete: function(){ loaderWrap.remove(); } });

    currentChapter = 0;
    if (chapEl)    chapEl.textContent    = CHAPTERS[0].chapter;
    if (titleEl)   titleEl.innerHTML     = CHAPTERS[0].title;
    if (subEl)     subEl.textContent     = CHAPTERS[0].sub;
    if (counterEl) counterEl.textContent = '01 / 07';
    if (progressNav) progressNav.classList.add('is-visible');
    if (dotEls[0]) dotEls[0].classList.add('is-active');

    if (adnOverlay) { adnOverlay.style.opacity = '0'; adnOverlay.style.pointerEvents = 'none'; }
    if (svcOverlay) { svcOverlay.style.opacity = '0'; svcOverlay.style.pointerEvents = 'none'; }

    gsap.set(textEls, { opacity:0, y:40, clipPath:'inset(0 0 100% 0)' });
    gsap.to(textEls,  { opacity:1, y:0,  clipPath:'inset(0 0 0% 0)', duration:1.1, ease:'power4.out', stagger:0.13, delay:0.3 });

    dotEls.forEach(function (dot, i) {
      dot.addEventListener('click', function () {
        var pct = CHAPTERS[i].frameIn / (TOTAL - 1);
        window.scrollTo({ top: wrapperTop + pct * TOTAL_HEIGHT, behavior: 'smooth' });
      });
    });

    drawFrame(0);
    tick();

    /* Phase 2 : ch02 + ch03 en idle (sera également forcé par tick() si besoin) */
    idle(function () { ensurePhase2(); });
  }

  /* Phase 1 : ch01 uniquement — dès que prêt on affiche */
  loadRange(0, 0, initScroll);

})();
