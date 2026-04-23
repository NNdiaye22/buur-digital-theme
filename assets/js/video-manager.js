/**
 * BUUR Digital — video-manager.js
 * Lazy loading des vidéos MP4 1080p 24fps via IntersectionObserver.
 * Évite de charger des fichiers lourds hors viewport.
 */
(function () {
  'use strict';

  const VIDEO_ROOT_MARGIN = '200px';

  function loadVideo(video) {
    const src = video.dataset.src;
    if (!src || video.src) return;
    video.src = src;
    video.load();
    // Lecture dès que possible
    video.addEventListener('canplay', () => {
      video.play().catch(() => { /* autoplay bloqué — silencieux */ });
    }, { once: true });
    // Supprimer l'attribut data-src une fois chargé
    video.removeAttribute('data-src');
  }

  function initLazyVideos() {
    const videos = document.querySelectorAll('video[data-src]');
    if (!videos.length) return;

    if (!('IntersectionObserver' in window)) {
      // Fallback : charger immédiatement
      videos.forEach(loadVideo);
      return;
    }

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          loadVideo(entry.target);
          observer.unobserve(entry.target);
        }
      });
    }, {
      rootMargin: VIDEO_ROOT_MARGIN,
      threshold: 0,
    });

    videos.forEach(v => observer.observe(v));
  }

  /* Lancer au DOM ready */
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initLazyVideos);
  } else {
    initLazyVideos();
  }

  /* Exposer pour usage externe */
  window.buurVideoManager = { loadVideo, initLazyVideos };

})();
