/**
 * BUUR Digital — scroll-frames.js v6.6
 * Overlays ADN + Services avec effets 3D premium scrubés au scroll
 * Fix transform conflicts CSS/JS
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

  var ADN_IN   = offsets[4] + Math.round((offsets[5] - offsets[4]) * 0.65) - 5;
  var ADN_PEAK = offsets[4] + Math.round((offsets[5] - offsets[4]) * 0.80);
  var ADN_OUT  = offsets[5] + Math.round((offsets[6] - offsets[5]) * 0.25);

  var SVC_IN   = offsets[5] + Math.round((offsets[6] - offsets[5]) * 0.65) - 5;
  var SVC_PEAK = offsets[5] + Math.round((offsets[6] - offsets[5]) * 0.80);
  var SVC_OUT  = offsets[6] + Math.round((TOTAL - offsets[6]) * 0.20);

  var CHAPTERS = [
    { frameIn: offsets[0], frameOut: offsets[1]-1, chapter:'01', title:'Strat\u00e9gie <em>Digitale</em>',    sub:'Une vision claire pour dominer votre march\u00e9 en ligne.' },
    { frameIn: offsets[1], frameOut: offsets[2]-1, chapter:'02', title:'Design <em>Premium</em>',         sub:'Des interfaces qui captivent, engagent et convertissent.' },
    { frameIn: offsets[2], frameOut: offsets[3]-1, chapter:'03', title:'Code <em>Sur-Mesure</em>',        sub:'Rapide, propre, \u00e9volutif \u2014 construit pour durer.' },
    { frameIn: offsets[3], frameOut: offsets[4]-1, chapter:'04', title:'SEO & <em>Performance</em>',      sub:'Premier sur Google. Rapide sur tous les \u00e9crans.' },
    { frameIn: offsets[4], frameOut: offsets[5]-1, chapter:'05', title:'E-<em>Commerce</em>',             sub:'Votre boutique pens\u00e9e pour vendre, 24h/24.' },
    { frameIn: offsets[5], frameOut: offsets[6]-1, chapter:'06', title:'Support <em>D\u00e9di\u00e9</em>',  sub:'Une \u00e9quipe disponible pour faire grandir votre projet.' },
    { frameIn: offsets[6], frameOut: TOTAL-1,      chapter:'07', title:'R\u00e9sultats <em>Mesurables</em>', sub:'Chaque action optimis\u00e9e. Chaque chiffre suivi.' },
  ];

  var wrapper    = document.getElementById('scroll-frames');
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

  var adnOverlay    = document.getElementById('sf-adn-overlay');
  var adnEyebrow    = adnOverlay ? adnOverlay.querySelector('.sf-adn-eyebrow')    : null;
  var adnTitleEl    = adnOverlay ? adnOverlay.querySelector('.sf-adn-title')      : null;
  var adnHalo       = adnOverlay ? adnOverlay.querySelector('.sf-adn-halo')       : null;
  var adnConnectors = adnOverlay ? adnOverlay.querySelector('.sf-adn-connectors') : null;
  var adnValeurs    = adnOverlay ? Array.prototype.slice.call(adnOverlay.querySelectorAll('.sf-adn-valeur')) : [];

  var svcOverlay = document.getElementById('sf-services-overlay');
  var sfLabel    = svcOverlay ? svcOverlay.querySelector('.sf-services-label') : null;
  var sfCols     = svcOverlay ? Array.prototype.slice.call(svcOverlay.querySelectorAll('.sf-col')) : [];

  wrapper.style.height = TOTAL_HEIGHT + 'px';

  function getOffsetTop(el) {
    var top = 0; while (el) { top += el.offsetTop; el = el.offsetParent; } return top;
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

  function zoneT(f, inF, outF) {
    if (f <= inF) return 0;
    if (f >= outF) return 1;
    return (f - inF) / (outF - inF);
  }

  function scrubOpacity(f, inF, peak, outF) {
    if (f < inF || f > outF) return 0;
    if (f <= peak) return (f - inF) / (peak - inF);
    var fadeStart = peak + Math.round((outF - peak) * 0.70);
    if (f <= fadeStart) return 1;
    return 1 - (f - fadeStart) / (outF - fadeStart);
  }

  function lerp(a, b, t) { return a + (b - a) * t; }

  function clamp01(v) { return Math.max(0, Math.min(1, v)); }

  function setTranslateRotateX(el, tx, ty, tz, rx) {
    if (!el) return;
    el.style.transform = 'translate3d(' + tx + 'px,' + ty + 'px,' + tz + 'px) rotateX(' + rx + 'deg)';
  }

  function setTranslateRotateY(el, tx, ty, tz, ry) {
    if (!el) return;
    el.style.transform = 'translate3d(' + tx + 'px,' + ty + 'px,' + tz + 'px) rotateY(' + ry + 'deg)';
  }

  function updateOverlays(f) {
    var adnOp = scrubOpacity(f, ADN_IN, ADN_PEAK, ADN_OUT);
    if (adnOverlay) {
      adnOverlay.style.opacity = adnOp;
      adnOverlay.style.pointerEvents = adnOp > 0.05 ? 'auto' : 'none';
    }

    if (adnOp > 0) {
      var tIn = clamp01(zoneT(f, ADN_IN, ADN_PEAK));
      if (adnEyebrow) {
        adnEyebrow.style.opacity = tIn;
        adnEyebrow.style.transform = 'translate3d(0,' + lerp(-18, 0, tIn) + 'px,40px)';
      }
      if (adnTitleEl) {
        adnTitleEl.style.opacity = tIn;
        adnTitleEl.style.clipPath = 'inset(0 0 0% 0)';
        adnTitleEl.style.transform = 'translate3d(0,' + lerp(-10, 0, tIn) + 'px,28px)';
      }
      if (adnHalo) {
        adnHalo.style.opacity = tIn * 0.95;
        adnHalo.style.transform = 'translate(-50%, -50%) scale(' + lerp(0.65, 1, tIn) + ')';
      }
      if (adnConnectors) {
        adnConnectors.style.opacity = tIn;
        adnConnectors.style.transform = 'translate3d(0,0,8px)';
      }

      adnValeurs.forEach(function (card, i) {
        var tx = 0, ty = 0;
        if (card.classList.contains('sf-adn-valeur--excellence'))      { tx = -16; ty = -8; }
        else if (card.classList.contains('sf-adn-valeur--accessibilite')) { tx = -16; ty = 8; }
        else if (card.classList.contains('sf-adn-valeur--innovation'))    { tx = 16; ty = -50; }

        var delay = i * 0.10;
        var tCard = clamp01((tIn - delay) / (1 - delay || 1));
        var rx = lerp(34, 0, tCard);
        var tz = lerp(-70, 0, tCard);
        card.style.opacity = tCard;
        setTranslateRotateX(card, tx, ty, tz, rx);
      });
    } else {
      if (adnEyebrow) adnEyebrow.style.opacity = 0;
      if (adnTitleEl) adnTitleEl.style.opacity = 0;
      if (adnHalo) adnHalo.style.opacity = 0;
      if (adnConnectors) adnConnectors.style.opacity = 0;
      adnValeurs.forEach(function (card) { card.style.opacity = 0; });
    }

    var svcOp = scrubOpacity(f, SVC_IN, SVC_PEAK, SVC_OUT);
    if (svcOverlay) {
      svcOverlay.style.opacity = svcOp;
      svcOverlay.style.pointerEvents = svcOp > 0.05 ? 'auto' : 'none';
    }

    if (svcOp > 0) {
      var tSvcIn = clamp01(zoneT(f, SVC_IN, SVC_PEAK));
      if (sfLabel) {
        sfLabel.style.opacity = tSvcIn;
        sfLabel.style.transform = 'translate3d(0,' + lerp(-16, 0, tSvcIn) + 'px,24px)';
      }

      sfCols.forEach(function (col, i) {
        var delay = i * 0.08;
        var tCol = clamp01((tSvcIn - delay) / (1 - delay || 1));
        var ry = lerp(24, 0, tCol);
        var tz = lerp(-80, 0, tCol);
        var ty = lerp(24, 0, tCol);
        col.style.opacity = tCol;
        setTranslateRotateY(col, 0, ty, tz, ry);
      });
    } else {
      if (sfLabel) sfLabel.style.opacity = 0;
      sfCols.forEach(function (col) { col.style.opacity = 0; });
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

  function hideChapter(onDone) {
    if (textTween) textTween.kill();
    textTween = gsap.to(textEls, { opacity: 0, y: -28, clipPath: 'inset(0 0 100% 0)', duration: 0.45, ease: 'power3.in', onComplete: onDone || null });
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

  var rafId = null;
  function onScroll() { if (!rafId) rafId = requestAnimationFrame(tick); }

  function tick() {
    rafId = null;
    var scrolled = window.scrollY - wrapperTop;
    var progress = Math.max(0, Math.min(scrolled / TOTAL_HEIGHT, 1));
    var frame    = progress * (TOTAL - 1);
    var inside   = scrolled >= 0 && scrolled < TOTAL_HEIGHT;

    if (progressNav) progressNav.classList.toggle('is-visible', inside);

    drawFrame(frame);
    updateOverlays(frame);
    updateText(frame);
  }

  window.addEventListener('scroll', onScroll, { passive: true });

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

    if (adnOverlay) { adnOverlay.style.opacity = '0'; adnOverlay.style.pointerEvents = 'none'; }
    if (svcOverlay) { svcOverlay.style.opacity = '0'; svcOverlay.style.pointerEvents = 'none'; }

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
