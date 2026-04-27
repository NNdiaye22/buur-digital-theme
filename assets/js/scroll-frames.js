/**
 * BUUR Digital — scroll-frames.js v9.1
 * v9.1 : stats centrales premium par chapitre
 */
(function () {
  'use strict';

  if (!window.gsap) return;

  var THEME_URL    = (window.buurTheme && window.buurTheme.url) ? window.buurTheme.url : '';
  var FRAMES_PATH  = THEME_URL + '/assets/frames';
  var PX_PER_FRAME = 12;

  var IS_MOBILE    = window.matchMedia && window.matchMedia('(max-width: 900px)').matches;
  var BATCH_SIZE   = IS_MOBILE ? 6  : 8;
  var BATCH_DELAY  = IS_MOBILE ? 32 : 32;
  var AHEAD_FRAMES = IS_MOBILE ? 20 : 40;

  var DPR = IS_MOBILE
    ? Math.min(window.devicePixelRatio || 1, 1.5)
    : Math.min(window.devicePixelRatio || 1, 2);

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

  var CTA_IN   = offsets[6] + Math.round((TOTAL - offsets[6]) * 0.45);
  var CTA_PEAK = offsets[6] + Math.round((TOTAL - offsets[6]) * 0.65);
  var CTA_OUT  = TOTAL - 1;

  var CHAPTERS = [
    { frameIn: offsets[0], frameOut: offsets[1]-1, chapter:'01', title:'L&#8217;Afrique <em>en ligne.</em>',        sub:'Votre business m\u00e9rite une pr\u00e9sence digitale de classe mondiale.',
      stat: '87%', statLabel: 'des acheteurs cherchent en ligne avant tout achat' },
    { frameIn: offsets[1], frameOut: offsets[2]-1, chapter:'02', title:'Un site qui <em>vous ressemble.</em>',      sub:'Design premium, con\u00e7u pour les entrepreneurs africains.',
      stat: '3\u202fsec', statLabel: 'pour convaincre un visiteur ou le perdre' },
    { frameIn: offsets[2], frameOut: offsets[3]-1, chapter:'03', title:'Construit <em>pour durer.</em>',            sub:'Code propre, rapide, \u00e9volutif. Z\u00e9ro compromis.',
      stat: '100%', statLabel: 'sur mesure — aucun template, aucun compromis' },
    { frameIn: offsets[3], frameOut: offsets[4]-1, chapter:'04', title:'Premier sur <em>Google.</em>',             sub:'SEO local ma\u00eetris\u00e9. Vos clients vous trouvent avant la concurrence.',
      stat: '\u00d73', statLabel: 'de trafic organique en moyenne apr\u00e8s optimisation' },
    { frameIn: offsets[4], frameOut: offsets[5]-1, chapter:'05', title:'Vendez <em>sans limite.</em>',             sub:'E-commerce, Wave, Orange Money. Votre boutique ouverte 24h/24.',
      stat: '24h', statLabel: 'votre boutique ouverte, m\u00eame quand vous dormez' },
    { frameIn: offsets[5], frameOut: offsets[6]-1, chapter:'06', title:'Une \u00e9quipe <em>\u00e0 vos c\u00f4t\u00e9s.</em>',         sub:'Support d\u00e9di\u00e9, formation incluse. Vous n\'\u00eates jamais seul.',
      stat: '7j', statLabel: 'd\u00e9lai moyen de livraison, chrono en main' },
    { frameIn: offsets[6], frameOut: TOTAL-1,      chapter:'07', title:'Des r\u00e9sultats <em>mesurables.</em>',       sub:'Chaque action optimis\u00e9e. Chaque chiffre suivi.',
      stat: '+50', statLabel: 'entrepreneurs accompagn\u00e9s avec succ\u00e8s' },
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

  var adnOverlay = document.getElementById('sf-adn-overlay');
  var adnEyebrow = adnOverlay ? adnOverlay.querySelector('.sf-adn-eyebrow') : null;
  var adnTitleEl = adnOverlay ? adnOverlay.querySelector('.sf-adn-title')   : null;
  var adnValeurs = adnOverlay ? Array.prototype.slice.call(adnOverlay.querySelectorAll('.sf-adn-valeur')) : [];

  var svcOverlay = document.getElementById('sf-services-overlay');
  var svcCards   = svcOverlay ? Array.prototype.slice.call(svcOverlay.querySelectorAll('.service-card')) : [];

  var ctaOverlay = document.getElementById('sf-cta-overlay');
  var ctaStats   = ctaOverlay ? Array.prototype.slice.call(ctaOverlay.querySelectorAll('.sf-cta-stat')) : [];
  var ctaContent = ctaOverlay ? ctaOverlay.querySelector('.sf-cta-content') : null;

  /* Stat centrale */
  var statWrap  = document.getElementById('sf-stat-center');
  var statNum   = statWrap ? statWrap.querySelector('.sf-stat-number')  : null;
  var statLbl   = statWrap ? statWrap.querySelector('.sf-stat-label')   : null;
  var statTween = null;
  var currentStatChapter = -1;

  wrapper.style.height = TOTAL_HEIGHT + 'px';

  var wrapperTop = 0;
  function updateWrapperTop() {
    wrapperTop = wrapper.getBoundingClientRect().top + window.scrollY;
  }
  if (window.ResizeObserver) {
    new ResizeObserver(function () { updateWrapperTop(); }).observe(wrapper);
  }

  function vpWidth()  { return (window.visualViewport ? window.visualViewport.width  : window.innerWidth);  }
  function vpHeight() { return (window.visualViewport ? window.visualViewport.height : window.innerHeight); }

  function resize() {
    var w = vpWidth(), h = vpHeight();
    canvas.width  = Math.round(w * DPR);
    canvas.height = Math.round(h * DPR);
    canvas.style.width  = w + 'px';
    canvas.style.height = h + 'px';
    ctx.scale(DPR, DPR);
    updateWrapperTop();
    if (allImages[currentFrame]) drawFrame(currentFrame);
  }
  window.addEventListener('resize', resize);
  if (window.visualViewport) window.visualViewport.addEventListener('resize', resize);

  var allImages   = new Array(TOTAL);
  var totalLoaded = 0;
  var seqStarted  = [false, false, false, false, false, false, false];

  function frameSrc(seqId, idx) {
    return FRAMES_PATH + '/' + seqId + '/frame_' + String(idx + 1).padStart(3, '0') + '.webp';
  }

  function loadIndices(indices, onDone) {
    if (!indices.length) { if (onDone) onDone(); return; }
    var total = indices.length, done = 0;
    function onOne() {
      totalLoaded++; done++;
      if (loaderBar) loaderBar.style.width = Math.min(totalLoaded / TOTAL * 100, 100) + '%';
      if (done === total && onDone) onDone();
    }
    function loadBatch(start) {
      var end = Math.min(start + BATCH_SIZE, total);
      for (var i = start; i < end; i++) {
        (function(absIdx) {
          if (allImages[absIdx]) { onOne(); return; }
          var img = new Image();
          img.onload = img.onerror = function () { allImages[absIdx] = img; onOne(); };
          img.src = frameSrc(
            SEQUENCES[ seqOfAbsIdx(absIdx) ].id,
            absIdx - offsets[ seqOfAbsIdx(absIdx) ]
          );
        })(indices[i]);
      }
      if (end < total) setTimeout(function () { loadBatch(end); }, BATCH_DELAY);
    }
    loadBatch(0);
  }

  function seqOfAbsIdx(absIdx) {
    for (var s = SEQUENCES.length - 1; s >= 0; s--) {
      if (absIdx >= offsets[s]) return s;
    }
    return 0;
  }

  function seqIndices(s) {
    var list = [];
    for (var i = 0; i < SEQUENCES[s].count; i++) list.push(offsets[s] + i);
    return list;
  }

  function loadSeq(s, onDone) {
    if (seqStarted[s]) { if (onDone) onDone(); return; }
    seqStarted[s] = true;
    loadIndices(seqIndices(s), onDone);
  }

  function idle(fn) {
    if (window.requestIdleCallback) requestIdleCallback(fn, { timeout: 3000 });
    else setTimeout(fn, 400);
  }

  function drawCover(img) {
    if (!img || !img.naturalWidth) return;
    var cw = canvas.width / DPR, ch = canvas.height / DPR;
    var s  = Math.max(cw / img.naturalWidth, ch / img.naturalHeight);
    ctx.clearRect(0, 0, cw, ch);
    ctx.drawImage(img,
      (cw - img.naturalWidth  * s) / 2,
      (ch - img.naturalHeight * s) / 2,
      img.naturalWidth * s, img.naturalHeight * s
    );
  }

  var currentFrame = 0, currentChapter = -1, textTween = null;

  function drawFrame(f) {
    var idx = Math.max(0, Math.min(Math.round(f), TOTAL - 1));
    currentFrame = idx;
    if (allImages[idx]) { drawCover(allImages[idx]); return; }
    for (var d = 1; d <= 90; d++) {
      if (idx - d >= 0    && allImages[idx - d]) { drawCover(allImages[idx - d]); return; }
      if (idx + d < TOTAL && allImages[idx + d]) { drawCover(allImages[idx + d]); return; }
    }
  }

  function zoneT(f, inF, outF) {
    if (f <= inF) return 0; if (f >= outF) return 1;
    return (f - inF) / (outF - inF);
  }
  function scrubOpacity(f, inF, peak, outF) {
    if (f < inF || f > outF) return 0;
    if (f <= peak) return (f - inF) / (peak - inF);
    var fs = peak + Math.round((outF - peak) * 0.65);
    if (f <= fs) return 1;
    return 1 - (f - fs) / (outF - fs);
  }
  function lerp(a, b, t) { return a + (b - a) * t; }
  function clamp01(v)     { return Math.max(0, Math.min(1, v)); }

  /* masque la stat centrale pendant les overlays ADN/SVC/CTA */
  function statShouldHide(f) {
    return (f >= ADN_IN && f <= ADN_OUT) ||
           (f >= SVC_IN && f <= SVC_OUT) ||
           (f >= CTA_IN);
  }

  function updateStat(chIdx, f) {
    if (!statWrap) return;
    if (statShouldHide(f)) {
      gsap.to(statWrap, { opacity: 0, y: 16, duration: 0.35, ease: 'power2.in', overwrite: true });
      currentStatChapter = -1;
      return;
    }
    if (chIdx === currentStatChapter) return;
    currentStatChapter = chIdx;
    if (chIdx < 0) {
      gsap.to(statWrap, { opacity: 0, y: 16, duration: 0.35, ease: 'power2.in', overwrite: true });
      return;
    }
    var ch = CHAPTERS[chIdx];
    gsap.to(statWrap, { opacity: 0, y: 16, duration: 0.28, ease: 'power2.in', overwrite: true,
      onComplete: function () {
        if (statNum) statNum.textContent = ch.stat;
        if (statLbl) statLbl.textContent = ch.statLabel;
        gsap.fromTo(statWrap,
          { opacity: 0, y: 28 },
          { opacity: 1, y: 0, duration: 0.85, ease: 'power4.out' }
        );
      }
    });
  }

  function updateOverlays(f) {
    /* ADN */
    var adnOp = scrubOpacity(f, ADN_IN, ADN_PEAK, ADN_OUT);
    if (adnOverlay) {
      adnOverlay.style.opacity       = adnOp;
      adnOverlay.style.pointerEvents = adnOp > 0.05 ? 'auto' : 'none';
    }
    if (adnOp > 0) {
      var tIn = clamp01(zoneT(f, ADN_IN, ADN_PEAK));
      if (adnEyebrow) { adnEyebrow.style.opacity = tIn; adnEyebrow.style.transform = 'translateY(' + lerp(-20, 0, tIn) + 'px)'; }
      if (adnTitleEl) { adnTitleEl.style.opacity  = tIn; adnTitleEl.style.transform  = 'translateY(' + lerp(-12, 0, tIn) + 'px)'; }
      adnValeurs.forEach(function (card, i) {
        var tCard = clamp01((tIn - i * 0.12) / (1 - i * 0.12 || 0.88));
        card.style.opacity   = tCard;
        card.style.transform = 'translateY(' + lerp(24, 0, tCard) + 'px)';
      });
    } else {
      if (adnEyebrow) adnEyebrow.style.opacity = 0;
      if (adnTitleEl) adnTitleEl.style.opacity  = 0;
      adnValeurs.forEach(function (c) { c.style.opacity = 0; });
    }

    /* SERVICES */
    var svcOp = scrubOpacity(f, SVC_IN, SVC_PEAK, SVC_OUT);
    if (svcOverlay) {
      svcOverlay.style.opacity       = svcOp;
      svcOverlay.style.pointerEvents = svcOp > 0.05 ? 'auto' : 'none';
    }
    if (svcOp > 0) {
      var tSvc = clamp01(zoneT(f, SVC_IN, SVC_PEAK));
      svcCards.forEach(function (card, i) {
        var tCol = clamp01((tSvc - i * 0.10) / (1 - i * 0.10 || 0.90));
        card.style.opacity   = tCol;
        card.style.transform = 'perspective(900px) translateY(' + lerp(32, 0, tCol) + 'px) rotateY(' + lerp(20, 0, tCol) + 'deg)';
      });
    } else {
      svcCards.forEach(function (c) { c.style.opacity = 0; });
    }

    /* CTA ch07 */
    var ctaOp = scrubOpacity(f, CTA_IN, CTA_PEAK, CTA_OUT);
    if (ctaOverlay) {
      ctaOverlay.style.opacity       = ctaOp;
      ctaOverlay.style.pointerEvents = ctaOp > 0.05 ? 'auto' : 'none';
    }
    if (ctaOp > 0) {
      var tCta = clamp01(zoneT(f, CTA_IN, CTA_PEAK));
      if (ctaContent) {
        ctaContent.style.opacity   = tCta;
        ctaContent.style.transform = 'translateY(' + lerp(32, 0, tCta) + 'px)';
      }
      ctaStats.forEach(function (stat, i) {
        var tStat = clamp01((tCta - i * 0.15) / (1 - i * 0.15 || 0.85));
        stat.style.opacity   = tStat;
        stat.style.transform = 'translateY(' + lerp(20, 0, tStat) + 'px)';
      });
    } else {
      if (ctaContent) ctaContent.style.opacity = 0;
      ctaStats.forEach(function (s) { s.style.opacity = 0; });
    }
  }

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

  function hideChapter(cb) {
    if (textTween) textTween.kill();
    textTween = gsap.to(textEls, { opacity: 0, y: -28, clipPath: 'inset(0 0 100% 0)', duration: 0.45, ease: 'power3.in', onComplete: cb || null });
  }

  function updateText(f) {
    var chIdx = -1;
    for (var i = 0; i < CHAPTERS.length; i++) {
      if (f >= CHAPTERS[i].frameIn && f <= CHAPTERS[i].frameOut) { chIdx = i; break; }
    }
    if (chIdx !== currentChapter) {
      currentChapter = chIdx;
      if (chIdx < 0) { hideChapter(); }
      else { hideChapter(function () { showChapter(chIdx); }); }
    }
    updateStat(chIdx, f);
  }

  var rafId = null;
  function onScroll()    { if (!rafId) rafId = requestAnimationFrame(tick); }
  function onTouchMove() { if (!rafId) rafId = requestAnimationFrame(tick); }

  function tick() {
    rafId = null;
    var scrolled = window.scrollY - wrapperTop;
    var progress = Math.max(0, Math.min(scrolled / TOTAL_HEIGHT, 1));
    var frame    = progress * (TOTAL - 1);
    var inside   = scrolled >= 0 && scrolled < TOTAL_HEIGHT;
    if (progressNav) progressNav.classList.toggle('is-visible', inside);
    for (var s = 0; s < SEQUENCES.length; s++) {
      if (!seqStarted[s] && frame >= offsets[s] - AHEAD_FRAMES) loadSeq(s, null);
    }
    drawFrame(frame);
    updateOverlays(frame);
    updateText(frame);
  }

  window.addEventListener('scroll',    onScroll,    { passive: true });
  window.addEventListener('touchmove', onTouchMove, { passive: true });

  function initScroll() {
    var w = vpWidth(), h = vpHeight();
    canvas.width  = Math.round(w * DPR);
    canvas.height = Math.round(h * DPR);
    canvas.style.width  = w + 'px';
    canvas.style.height = h + 'px';
    ctx.scale(DPR, DPR);
    updateWrapperTop();

    if (loaderWrap) gsap.to(loaderWrap, { opacity: 0, duration: 0.4, onComplete: function () { loaderWrap.remove(); } });

    currentChapter = 0;
    if (chapEl)    chapEl.textContent    = CHAPTERS[0].chapter;
    if (titleEl)   titleEl.innerHTML     = CHAPTERS[0].title;
    if (subEl)     subEl.textContent     = CHAPTERS[0].sub;
    if (counterEl) counterEl.textContent = '01 / 07';
    if (progressNav) progressNav.classList.add('is-visible');
    if (dotEls[0]) dotEls[0].classList.add('is-active');

    if (adnOverlay) { adnOverlay.style.opacity = '0'; adnOverlay.style.pointerEvents = 'none'; }
    if (svcOverlay) { svcOverlay.style.opacity = '0'; svcOverlay.style.pointerEvents = 'none'; }
    if (ctaOverlay) { ctaOverlay.style.opacity = '0'; ctaOverlay.style.pointerEvents = 'none'; }
    if (statWrap)   { statWrap.style.opacity   = '0'; }

    gsap.set(textEls, { opacity: 0, y: 40, clipPath: 'inset(0 0 100% 0)' });
    gsap.to(textEls,  { opacity: 1, y: 0,  clipPath: 'inset(0 0 0% 0)', duration: 1.1, ease: 'power4.out', stagger: 0.13, delay: 0.3 });

    if (statNum) statNum.textContent = CHAPTERS[0].stat;
    if (statLbl) statLbl.textContent = CHAPTERS[0].statLabel;
    gsap.fromTo(statWrap, { opacity: 0, y: 28 }, { opacity: 1, y: 0, duration: 1.1, ease: 'power4.out', delay: 0.5 });

    dotEls.forEach(function (dot, i) {
      dot.addEventListener('click', function () {
        var pct = CHAPTERS[i].frameIn / (TOTAL - 1);
        window.scrollTo({ top: wrapperTop + pct * TOTAL_HEIGHT, behavior: 'smooth' });
      });
    });

    drawFrame(0);
    tick();
    idle(function () { loadSeq(1, function () { idle(function () { loadSeq(2, null); }); }); });
  }

  loadSeq(0, initScroll);

})();
