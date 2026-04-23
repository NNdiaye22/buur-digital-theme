/**
 * BUUR Digital — hero-tunnel.js
 * Tunnel concentrique Three.js dans le canvas #hero-canvas.
 * Couleur orange->bleu pilotable au scroll via GSAP ScrollTrigger.
 * Vidéos 1080p 24fps en arrière-plan — canvas en overlay mix-blend-mode:screen
 */
(function () {
  'use strict';

  const canvas = document.getElementById('hero-canvas');
  if (!canvas || !window.THREE) return;

  /* ---- Setup Three.js ---- */
  const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
  renderer.setClearColor(0x000000, 0);

  const scene  = new THREE.Scene();
  const camera = new THREE.PerspectiveCamera(70, 1, 0.1, 1000);
  camera.position.z = 5;

  /* ---- Tunnel : anneaux concentriques ---- */
  const RINGS     = 24;
  const meshes    = [];
  const colorOrange = new THREE.Color(0xea5b13);
  const colorBlue   = new THREE.Color(0x243a85);

  for (let i = 0; i < RINGS; i++) {
    const t        = i / (RINGS - 1);
    const radius   = 0.3 + t * 4.5;
    const color    = colorOrange.clone().lerp(colorBlue, t);
    const geo      = new THREE.RingGeometry(radius, radius + 0.025, 64);
    const mat      = new THREE.MeshBasicMaterial({
      color,
      side: THREE.DoubleSide,
      transparent: true,
      opacity: 0.6 - t * 0.3,
    });
    const mesh = new THREE.Mesh(geo, mat);
    mesh.rotation.x = Math.PI / 2;
    mesh.position.z = -i * 0.5;
    scene.add(mesh);
    meshes.push({ mesh, baseZ: -i * 0.5 });
  }

  /* ---- Resize ---- */
  function resize() {
    const { offsetWidth: w, offsetHeight: h } = canvas.parentElement || canvas;
    renderer.setSize(w, h, false);
    camera.aspect = w / h;
    camera.updateProjectionMatrix();
  }
  resize();
  window.addEventListener('resize', resize, { passive: true });

  /* ---- Animation de base ---- */
  let scrollProgress = 0;
  let raf;

  function animate(time) {
    raf = requestAnimationFrame(animate);
    const t = time * 0.001;

    meshes.forEach(({ mesh, baseZ }, i) => {
      // Rotation lente
      mesh.rotation.z = t * 0.05 * (i % 2 === 0 ? 1 : -1);
      // Mouvement vers la caméra au scroll
      mesh.position.z = baseZ + scrollProgress * 8;
    });

    // Caméra légèrement penchée
    camera.rotation.z = Math.sin(t * 0.08) * 0.015;

    renderer.render(scene, camera);
  }

  animate(0);

  /* ---- GSAP ScrollTrigger ---- */
  if (window.gsap && window.ScrollTrigger) {
    gsap.registerPlugin(ScrollTrigger);
    ScrollTrigger.create({
      trigger: '#hero',
      start:   'top top',
      end:     'bottom top',
      scrub:   true,
      onUpdate: self => { scrollProgress = self.progress; },
    });
  } else {
    // Fallback scroll natif
    window.addEventListener('scroll', () => {
      const hero = document.getElementById('hero');
      if (!hero) return;
      scrollProgress = Math.min(window.scrollY / hero.offsetHeight, 1);
    }, { passive: true });
  }

  /* ---- Nettoyage ---- */
  window.buurTunnel = {
    dispose() {
      cancelAnimationFrame(raf);
      renderer.dispose();
    }
  };

})();
