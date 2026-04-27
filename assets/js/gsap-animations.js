/**
 * BUUR Digital — gsap-animations.js
 * Animations ScrollTrigger. Services : cascade desktop uniquement.
 */
(function () {
  'use strict';

  if (!window.gsap || !window.ScrollTrigger) return;

  gsap.registerPlugin(ScrollTrigger);
  if (window.SplitText) gsap.registerPlugin(SplitText);

  window.addEventListener('load', function () {
    setTimeout(function () { ScrollTrigger.refresh(); }, 1500);
  });

  /* ======================================================
     1. HERO
     ====================================================== */
  var heroTitle   = document.querySelector('.hero-title');
  var heroTagline = document.querySelector('.hero-tagline');
  var heroCta     = document.querySelector('.hero-cta');

  if (heroTitle) {
    var tl = gsap.timeline({ delay: 0.8 });
    if (window.SplitText && heroTitle.textContent.trim()) {
      var split = new SplitText(heroTitle, { type: 'lines,words' });
      tl.from(split.words, { opacity: 0, y: 60, rotateX: -40, duration: 1, ease: 'power4.out', stagger: 0.04 });
    } else {
      tl.to(heroTitle, { opacity: 1, y: 0, duration: 1, ease: 'power3.out' });
    }
    if (heroTagline) tl.to(heroTagline, { opacity: 1, y: 0, duration: 0.7, ease: 'power3.out' }, '-=0.5');
    if (heroCta)     tl.to(heroCta,    { opacity: 1, y: 0, duration: 0.6, ease: 'power3.out' }, '-=0.4');
  }

  /* ======================================================
     2. PROBLÈME
     ====================================================== */
  var problemSection = document.querySelector('.probleme-section');
  if (problemSection && window.innerWidth > 768) {
    ScrollTrigger.create({ trigger: problemSection, start: 'top top', end: '+=200%', pin: true, pinSpacing: true });
  }
  document.querySelectorAll('.probleme-line').forEach(function (line, i) {
    gsap.fromTo(line, { opacity: 0, y: 30 }, {
      opacity: 1, y: 0, duration: 0.9, ease: 'power3.out', delay: i * 0.15,
      scrollTrigger: { trigger: line, start: 'top 80%', once: true },
    });
  });

  /* ======================================================
     3. SERVICES — cascade desktop uniquement
     ====================================================== */
  if (window.innerWidth > 900) {
    var serviceCards = document.querySelectorAll('.service-card');
    if (serviceCards.length) {
      gsap.fromTo(serviceCards, { opacity: 0, y: 60 }, {
        opacity: 1, y: 0, duration: 0.9, ease: 'power3.out', stagger: 0.18,
        scrollTrigger: { trigger: '.services-grid', start: 'top 80%', once: true },
      });
    }
  }

  /* ======================================================
     4. STATS — compteurs
     ====================================================== */
  var countersTriggered = false;
  function animateCounters() {
    if (countersTriggered) return;
    countersTriggered = true;
    document.querySelectorAll('.stat-value').forEach(function (el) {
      var raw    = el.dataset.value || el.textContent;
      var num    = parseFloat(raw.replace(/[^0-9.]/g, ''));
      if (!num) return;
      var suffix = raw.replace(/[0-9.,\s]/g, '');
      var obj    = { val: 0 };
      gsap.to(obj, {
        val: num, duration: 1.8, ease: 'power2.out',
        onUpdate: function () { el.textContent = Math.round(obj.val).toLocaleString('fr-FR') + suffix; },
      });
    });
  }

  var statItems = document.querySelectorAll('.stat-item');
  if (statItems.length) {
    gsap.fromTo(statItems, { opacity: 0, y: 30 }, {
      opacity: 1, y: 0, duration: 0.7, ease: 'power3.out', stagger: 0.1,
      scrollTrigger: { trigger: '.stats-section', start: 'top 90%', once: true, onEnter: animateCounters },
    });
    if (window.IntersectionObserver) {
      var statsSection = document.querySelector('.stats-section');
      if (statsSection) {
        var io = new IntersectionObserver(function (entries) {
          entries.forEach(function (entry) { if (entry.isIntersecting) { animateCounters(); io.disconnect(); } });
        }, { threshold: 0.2 });
        io.observe(statsSection);
      }
    }
  }

  /* ======================================================
     5. POURQUOI
     ====================================================== */
  var lionWrap        = document.getElementById('lion-wrap');
  var pourquoiContent = document.querySelector('.pourquoi-content');
  if (lionWrap) {
    gsap.fromTo(lionWrap, { opacity: 0, scale: 0.82, filter: 'blur(8px)' }, {
      opacity: 1, scale: 1, filter: 'blur(0px)', duration: 1.3, ease: 'back.out(1.4)',
      scrollTrigger: { trigger: lionWrap, start: 'top 80%', once: true },
    });
  }
  if (pourquoiContent) {
    gsap.fromTo(pourquoiContent, { opacity: 0, x: 40 }, {
      opacity: 1, x: 0, duration: 1.1, ease: 'power3.out',
      scrollTrigger: { trigger: pourquoiContent, start: 'top 80%', once: true },
    });
    document.querySelectorAll('.valeur-item').forEach(function (item, i) {
      gsap.fromTo(item, { opacity: 0, x: 30 }, {
        opacity: 1, x: 0, duration: 0.7, ease: 'power3.out', delay: 0.15 + i * 0.12,
        scrollTrigger: { trigger: item, start: 'top 88%', once: true },
      });
    });
  }

  /* ======================================================
     6. TÉMOIGNAGES
     ====================================================== */
  var temoignageCards = document.querySelectorAll('.temoignage-card');
  if (temoignageCards.length) {
    gsap.fromTo(temoignageCards, { opacity: 0, y: 40 }, {
      opacity: 1, y: 0, duration: 0.8, ease: 'power3.out', stagger: 0.12,
      scrollTrigger: { trigger: '.temoignages-grid', start: 'top 80%', once: true },
    });
  }

  /* ======================================================
     7. CTA FINAL
     ====================================================== */
  var ctaTitle   = document.getElementById('cta-title');
  var ctaSub     = document.querySelector('.cta-sub');
  var ctaButtons = document.querySelector('.cta-buttons');
  if (ctaTitle) {
    var tlCta = gsap.timeline({ scrollTrigger: { trigger: '.cta-section', start: 'top 75%', once: true } });
    tlCta
      .fromTo(ctaTitle,   { opacity: 0, y: 50 }, { opacity: 1, y: 0, duration: 1.1, ease: 'power3.out' })
      .fromTo(ctaSub,     { opacity: 0, y: 30 }, { opacity: 1, y: 0, duration: 0.8, ease: 'power3.out' }, '-=0.5')
      .fromTo(ctaButtons, { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 0.6, ease: 'power3.out' }, '-=0.4');
  }

  /* ======================================================
     8. HEADER reveals génériques
     ====================================================== */
  document.querySelectorAll('.services-header, .temoignages-header, .stats-header').forEach(function (header) {
    gsap.fromTo(header, { opacity: 0, y: 30 }, {
      opacity: 1, y: 0, duration: 0.8, ease: 'power3.out',
      scrollTrigger: { trigger: header, start: 'top 85%', once: true },
    });
  });

})();
