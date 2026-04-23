/**
 * BUUR Digital — interactions.js
 * Mouse parallax 3D hero + tilt 3D cards services
 */
(function () {
  'use strict';

  /* ======================================================
     1. MOUSE PARALLAX 3D — Hero
     ====================================================== */
  const heroContent = document.querySelector('.hero-content');
  const heroCanvas  = document.querySelector('.hero-canvas');
  const heroVideo   = document.querySelector('.hero-video-bg');

  if (heroContent) {
    let mx = 0, my = 0, cx = 0, cy = 0;

    document.addEventListener('mousemove', e => {
      mx = (e.clientX / window.innerWidth  - 0.5) * 2;
      my = (e.clientY / window.innerHeight - 0.5) * 2;
    }, { passive: true });

    function lerp(a, b, t) { return a + (b - a) * t; }

    function rafParallax() {
      requestAnimationFrame(rafParallax);
      cx = lerp(cx, mx, 0.06);
      cy = lerp(cy, my, 0.06);

      if (heroContent) {
        heroContent.style.transform =
          `translate3d(${cx * -12}px, ${cy * -8}px, 0)`;
      }
      if (heroCanvas) {
        heroCanvas.style.transform =
          `translate3d(${cx * 8}px, ${cy * 6}px, 0) scale(1.04)`;
      }
      if (heroVideo) {
        heroVideo.style.transform =
          `translate3d(${cx * 5}px, ${cy * 4}px, 0) scale(1.06)`;
      }
    }

    // Désactiver sur mobile
    if (window.matchMedia('(pointer: fine)').matches) {
      rafParallax();
    }
  }

  /* ======================================================
     2. MOUSE PARALLAX 3D — Section Pourquoi (lion)
     ====================================================== */
  const lionSection = document.querySelector('.pourquoi-section');
  const lionWrap    = document.getElementById('lion-wrap');

  if (lionSection && lionWrap && window.matchMedia('(pointer: fine)').matches) {
    let lx = 0, ly = 0, lcx = 0, lcy = 0;

    lionSection.addEventListener('mousemove', e => {
      const rect = lionSection.getBoundingClientRect();
      lx = ((e.clientX - rect.left) / rect.width  - 0.5) * 2;
      ly = ((e.clientY - rect.top)  / rect.height - 0.5) * 2;
    }, { passive: true });

    function rafLion() {
      requestAnimationFrame(rafLion);
      lcx = lcx + (lx - lcx) * 0.05;
      lcy = lcy + (ly - lcy) * 0.05;
      lionWrap.style.transform =
        `perspective(800px) rotateY(${lcx * 12}deg) rotateX(${-lcy * 8}deg) scale3d(1.02,1.02,1.02)`;
    }
    rafLion();
  }

  /* ======================================================
     3. TILT 3D — Cards services au hover
     ====================================================== */
  document.querySelectorAll('.service-card').forEach(card => {
    if (!window.matchMedia('(pointer: fine)').matches) return;

    card.addEventListener('mousemove', e => {
      const rect = card.getBoundingClientRect();
      const x = (e.clientX - rect.left) / rect.width  - 0.5;
      const y = (e.clientY - rect.top)  / rect.height - 0.5;
      card.style.transform =
        `perspective(900px) rotateY(${x * 16}deg) rotateX(${-y * 12}deg) scale3d(1.03,1.03,1.03)`;
      card.style.transition = 'transform 0.05s linear';
    });

    card.addEventListener('mouseleave', () => {
      card.style.transform = 'perspective(900px) rotateY(0deg) rotateX(0deg) scale3d(1,1,1)';
      card.style.transition = 'transform 0.6s cubic-bezier(0.34,1.56,0.64,1)';
    });
  });

  /* ======================================================
     4. TILT 3D — Cards témoignages au hover
     ====================================================== */
  document.querySelectorAll('.temoignage-card').forEach(card => {
    if (!window.matchMedia('(pointer: fine)').matches) return;

    card.addEventListener('mousemove', e => {
      const rect = card.getBoundingClientRect();
      const x = (e.clientX - rect.left) / rect.width  - 0.5;
      const y = (e.clientY - rect.top)  / rect.height - 0.5;
      card.style.transform =
        `perspective(700px) rotateY(${x * 10}deg) rotateX(${-y * 8}deg) scale3d(1.02,1.02,1.02)`;
      card.style.transition = 'transform 0.05s linear';
    });

    card.addEventListener('mouseleave', () => {
      card.style.transform = '';
      card.style.transition = 'transform 0.5s cubic-bezier(0.34,1.56,0.64,1)';
    });
  });

})();
