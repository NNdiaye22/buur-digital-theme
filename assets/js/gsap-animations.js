/**
 * BUUR Digital — gsap-animations.js
 * Toutes les animations ScrollTrigger de la page.
 * Dépendances : gsap, ScrollTrigger, SplitText, video-manager.js
 */
(function () {
  'use strict';

  if (!window.gsap || !window.ScrollTrigger) return;

  gsap.registerPlugin(ScrollTrigger);
  if (window.SplitText) gsap.registerPlugin(SplitText);

  /* ======================================================
     1. HERO — titre + tagline + CTA (au load, pas au scroll)
     ====================================================== */
  const heroTitle   = document.querySelector('.hero-title');
  const heroTagline = document.querySelector('.hero-tagline');
  const heroCta     = document.querySelector('.hero-cta');

  if (heroTitle) {
    const tl = gsap.timeline({ delay: 0.3 });

    if (window.SplitText && heroTitle.textContent.trim()) {
      const split = new SplitText(heroTitle, { type: 'lines,words' });
      tl.from(split.words, {
        opacity: 0, y: 60, rotateX: -40,
        duration: 1, ease: 'power4.out',
        stagger: 0.04,
      });
    } else {
      tl.to(heroTitle, { opacity: 1, y: 0, duration: 1, ease: 'power3.out' });
    }

    if (heroTagline) tl.to(heroTagline, { opacity: 1, y: 0, duration: 0.7, ease: 'power3.out' }, '-=0.5');
    if (heroCta)     tl.to(heroCta,    { opacity: 1, y: 0, duration: 0.6, ease: 'power3.out' }, '-=0.4');
  }

  /* ======================================================
     2. PROBLÈME — lignes révélées une par une au scroll
     ====================================================== */
  document.querySelectorAll('.probleme-line').forEach((line, i) => {
    gsap.fromTo(line,
      { opacity: 0, y: 30 },
      {
        opacity: 1, y: 0,
        duration: 0.9,
        ease: 'power3.out',
        delay: i * 0.15,
        scrollTrigger: {
          trigger: line,
          start:   'top 80%',
          once:    true,
        },
      }
    );
  });

  /* ======================================================
     3. SERVICES — cards en cascade au scroll
     ====================================================== */
  const serviceCards = document.querySelectorAll('.service-card');
  if (serviceCards.length) {
    gsap.fromTo(serviceCards,
      { opacity: 0, y: 50 },
      {
        opacity: 1, y: 0,
        duration: 0.8,
        ease: 'power3.out',
        stagger: 0.15,
        scrollTrigger: {
          trigger: '.services-grid',
          start:   'top 80%',
          once:    true,
        },
      }
    );
  }

  /* ======================================================
     4. STATS — compteurs animés au scroll
     ====================================================== */
  const statItems = document.querySelectorAll('.stat-item');
  if (statItems.length) {
    gsap.fromTo(statItems,
      { opacity: 0, y: 30 },
      {
        opacity: 1, y: 0,
        duration: 0.7,
        ease: 'power3.out',
        stagger: 0.1,
        scrollTrigger: {
          trigger: '.stats-section',
          start:   'top 80%',
          once:    true,
          onEnter: () => animateCounters(),
        },
      }
    );
  }

  function animateCounters() {
    document.querySelectorAll('.stat-value').forEach(el => {
      const raw = el.dataset.value || el.textContent;
      const num = parseFloat(raw.replace(/[^0-9.]/g, ''));
      if (!num) return;
      const suffix = raw.replace(/[0-9.,\s]/g, '');
      const obj = { val: 0 };
      gsap.to(obj, {
        val: num,
        duration: 1.8,
        ease: 'power2.out',
        onUpdate: function () {
          el.textContent = Math.round(obj.val).toLocaleString('fr-FR') + suffix;
        },
      });
    });
  }

  /* ======================================================
     5. POURQUOI — lion + contenu au scroll
     ====================================================== */
  const lionWrap        = document.getElementById('lion-wrap');
  const pourquoiContent = document.querySelector('.pourquoi-content');

  if (lionWrap) {
    gsap.fromTo(lionWrap,
      { opacity: 0, scale: 0.85 },
      {
        opacity: 1, scale: 1,
        duration: 1.1,
        ease: 'back.out(1.4)',
        scrollTrigger: { trigger: lionWrap, start: 'top 80%', once: true },
      }
    );
  }
  if (pourquoiContent) {
    gsap.fromTo(pourquoiContent,
      { opacity: 0, x: 30 },
      {
        opacity: 1, x: 0, duration: 1, ease: 'power3.out',
        scrollTrigger: { trigger: pourquoiContent, start: 'top 80%', once: true },
      }
    );
    document.querySelectorAll('.valeur-item').forEach((item, i) => {
      gsap.fromTo(item,
        { opacity: 0, y: 20 },
        {
          opacity: 1, y: 0, duration: 0.6, ease: 'power3.out', delay: 0.2 + i * 0.12,
          scrollTrigger: { trigger: item, start: 'top 85%', once: true },
        }
      );
    });
  }

  /* ======================================================
     6. TÉMOIGNAGES — cards en cascade au scroll
     ====================================================== */
  const temoignageCards = document.querySelectorAll('.temoignage-card');
  if (temoignageCards.length) {
    gsap.fromTo(temoignageCards,
      { opacity: 0, y: 30 },
      {
        opacity: 1, y: 0,
        duration: 0.7,
        ease: 'power3.out',
        stagger: 0.1,
        scrollTrigger: {
          trigger: '.temoignages-grid',
          start:   'top 80%',
          once:    true,
        },
      }
    );
  }

  /* ======================================================
     7. CTA FINAL — fromTo pour garantir l'état initial
     ====================================================== */
  const ctaTitle   = document.getElementById('cta-title');
  const ctaSub     = document.querySelector('.cta-sub');
  const ctaButtons = document.querySelector('.cta-buttons');

  if (ctaTitle) {
    const tlCta = gsap.timeline({
      scrollTrigger: { trigger: '.cta-section', start: 'top 75%', once: true },
    });
    tlCta
      .fromTo(ctaTitle,   { opacity: 0, y: 40 }, { opacity: 1, y: 0, duration: 1,   ease: 'power3.out' })
      .fromTo(ctaSub,     { opacity: 0, y: 30 }, { opacity: 1, y: 0, duration: 0.8, ease: 'power3.out' }, '-=0.5')
      .fromTo(ctaButtons, { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 0.6, ease: 'power3.out' }, '-=0.4');
  }

  /* ======================================================
     8. PARALLAXE LÉGÈRE sur les vidéos de fond
     ====================================================== */
  document.querySelectorAll('.hero-video, .cta-video').forEach(video => {
    ScrollTrigger.create({
      trigger:  video.closest('section'),
      start:    'top bottom',
      end:      'bottom top',
      scrub:    true,
      onUpdate: self => {
        gsap.set(video, { y: self.progress * 60 });
      },
    });
  });

})();
