/**
 * BUUR Digital — main.js v2
 * Reveal au scroll, nav scrolled, hero anim, video lazy
 */
(function () {
  'use strict';

  /* ── Nav scrolled ── */
  var nav = document.querySelector('.buur-nav');
  if (nav) {
    window.addEventListener('scroll', function () {
      nav.classList.toggle('scrolled', window.scrollY > 40);
    }, { passive: true });
  }

  /* ── Burger ── */
  var burger = document.querySelector('.nav-burger');
  var mobileMenu = document.querySelector('.nav-mobile');
  if (burger && mobileMenu) {
    burger.addEventListener('click', function () {
      var open = burger.getAttribute('aria-expanded') === 'true';
      burger.setAttribute('aria-expanded', !open);
      mobileMenu.classList.toggle('is-open', !open);
    });
  }

  /* ── Hero entrance ── */
  if (window.gsap) {
    gsap.to('.hero-title',   { opacity: 1, y: 0, duration: 1.1, ease: 'power3.out', delay: 0.2 });
    gsap.to('.hero-tagline', { opacity: 1, y: 0, duration: 1.0, ease: 'power3.out', delay: 0.45 });
    gsap.to('.hero-cta',     { opacity: 1, y: 0, duration: 0.9, ease: 'power3.out', delay: 0.7 });
  }

  /* ── Reveal au scroll ── */
  var reveals = document.querySelectorAll('[data-reveal]');
  if ('IntersectionObserver' in window && reveals.length) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) {
          e.target.classList.add('is-visible');
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.15 });
    reveals.forEach(function (el) { io.observe(el); });
  }

  /* ── Video lazy ── */
  var videos = document.querySelectorAll('video[data-src]');
  if ('IntersectionObserver' in window && videos.length) {
    var vio = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) {
          var v = e.target;
          v.src = v.dataset.src;
          v.load();
          vio.unobserve(v);
        }
      });
    }, { rootMargin: '200px' });
    videos.forEach(function (v) { vio.observe(v); });
  }

})();
