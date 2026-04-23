/**
 * BUUR Digital — main.js
 * Nav scroll + burger menu + helpers globaux
 */
(function () {
  'use strict';

  /* ---- Navbar scroll ---- */
  const nav = document.getElementById('buur-nav');
  if (nav) {
    const onScroll = () => {
      nav.classList.toggle('scrolled', window.scrollY > 60);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ---- Burger menu ---- */
  const burger  = document.getElementById('nav-burger');
  const mobile  = document.getElementById('nav-mobile');
  if (burger && mobile) {
    burger.addEventListener('click', () => {
      const open = burger.getAttribute('aria-expanded') === 'true';
      burger.setAttribute('aria-expanded', String(!open));
      mobile.setAttribute('aria-hidden', String(open));
      mobile.classList.toggle('is-open', !open);
      document.body.style.overflow = open ? '' : 'hidden';
    });
    // Fermer si clic sur un lien
    mobile.querySelectorAll('a').forEach(a => {
      a.addEventListener('click', () => {
        burger.setAttribute('aria-expanded', 'false');
        mobile.setAttribute('aria-hidden', 'true');
        mobile.classList.remove('is-open');
        document.body.style.overflow = '';
      });
    });
  }

  /* ---- Smooth scroll ancres ---- */
  document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', e => {
      const target = document.querySelector(link.getAttribute('href'));
      if (!target) return;
      e.preventDefault();
      const navH = (nav ? nav.offsetHeight : 80);
      const top  = target.getBoundingClientRect().top + window.scrollY - navH - 16;
      window.scrollTo({ top, behavior: 'smooth' });
    });
  });

  /* ---- Reveal basique (fallback si GSAP non chargé) ---- */
  if (!window.gsap && 'IntersectionObserver' in window) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('is-visible');
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.15 });
    document.querySelectorAll('.reveal-up, .probleme-line').forEach(el => io.observe(el));
  }

})();
