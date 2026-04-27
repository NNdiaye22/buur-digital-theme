/**
 * BUUR Digital — contact-form.js
 * Validation + envoi AJAX du formulaire de contact natif
 */
(function () {
  'use strict';

  const form     = document.getElementById('buur-contact-form');
  if (!form) return;

  const feedback = form.querySelector('.form-feedback');

  function setError(input, msg) {
    input.classList.add('has-error');
    const err = input.closest('.form-group').querySelector('.form-error');
    if (err) err.textContent = msg;
  }

  function clearError(input) {
    input.classList.remove('has-error');
    const err = input.closest('.form-group').querySelector('.form-error');
    if (err) err.textContent = '';
  }

  function validate() {
    let valid = true;
    form.querySelectorAll('[required]').forEach(function (el) {
      if (!el.value.trim()) {
        setError(el, 'Ce champ est requis.');
        valid = false;
      } else if (el.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(el.value)) {
        setError(el, 'Adresse e-mail invalide.');
        valid = false;
      } else {
        clearError(el);
      }
    });
    return valid;
  }

  // Effacer l’erreur dès que l’utilisateur modifie un champ
  form.querySelectorAll('input, select, textarea').forEach(function (el) {
    el.addEventListener('input', function () { clearError(el); });
  });

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    if (!validate()) return;

    const btn = form.querySelector('.contact-submit');
    const lbl = btn.querySelector('.btn-label');
    btn.disabled = true;
    lbl.textContent = 'Envoi en cours…';
    feedback.className = 'form-feedback';
    feedback.style.display = 'none';

    const data = new FormData(form);
    data.append('action', 'buur_contact');
    data.append('nonce',  (window.buurAjax && window.buurAjax.nonce) || '');

    fetch((window.buurAjax && window.buurAjax.url) || '/wp-admin/admin-ajax.php', {
      method: 'POST',
      body:   data,
    })
      .then(function (r) { return r.json(); })
      .then(function (res) {
        if (res.success) {
          feedback.textContent = res.data || 'Message envoyé ! On vous répond sous 48h.';
          feedback.className   = 'form-feedback success';
          form.reset();
        } else {
          feedback.textContent = res.data || 'Une erreur est survenue. Veuillez réessayer.';
          feedback.className   = 'form-feedback error';
        }
        feedback.style.display = '';
      })
      .catch(function () {
        feedback.textContent = 'Erreur réseau. Veuillez réessayer.';
        feedback.className   = 'form-feedback error';
        feedback.style.display = '';
      })
      .finally(function () {
        btn.disabled    = false;
        lbl.textContent = 'Envoyer le message';
      });
  });
})();
