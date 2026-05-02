/**
 * BUUR Digital — contact-form.js v1.1
 * Validation + envoi AJAX du formulaire de contact natif.
 *
 * v1.1 FIX : alignement sur le HTML réel
 *   - feedback  : .cp-feedback (was .form-feedback)
 *   - bouton    : .cp-submit > span (was .contact-submit / .btn-label)
 *   - champ     : name="sujet" (was name="service")
 */
(function () {
  'use strict';

  var form = document.getElementById('buur-contact-form');
  if (!form) return;

  var feedback = form.querySelector('.cp-feedback');

  function setError(input, msg) {
    input.classList.add('has-error');
    input.style.borderColor = 'rgba(248,113,113,0.7)';
    var group = input.closest('.cp-field');
    var err   = group && group.querySelector('.cp-field-error');
    if (err) err.textContent = msg;
  }

  function clearError(input) {
    input.classList.remove('has-error');
    input.style.borderColor = '';
    var group = input.closest('.cp-field');
    var err   = group && group.querySelector('.cp-field-error');
    if (err) err.textContent = '';
  }

  function validate() {
    var valid = true;
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

  form.querySelectorAll('input, select, textarea').forEach(function (el) {
    el.addEventListener('input', function () { clearError(el); });
    el.addEventListener('change', function () { clearError(el); });
  });

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    if (!validate()) return;

    var btn  = form.querySelector('.cp-submit');
    var span = btn && btn.querySelector('span');
    if (btn)  btn.disabled = true;
    if (span) span.textContent = 'Envoi en cours…';
    if (feedback) {
      feedback.textContent = '';
      feedback.className   = 'cp-feedback';
    }

    var data = new FormData(form);
    data.append('action', 'buur_contact');
    data.append('nonce',  (window.buurAjax && window.buurAjax.nonce) || '');

    fetch((window.buurAjax && window.buurAjax.url) || '/wp-admin/admin-ajax.php', {
      method: 'POST',
      body:   data,
    })
      .then(function (r) { return r.json(); })
      .then(function (res) {
        if (res.success) {
          if (feedback) {
            feedback.textContent = res.data || 'Message envoyé ! On vous répond sous 48h.';
            feedback.className   = 'cp-feedback success';
          }
          form.reset();
        } else {
          if (feedback) {
            feedback.textContent = res.data || 'Une erreur est survenue. Veuillez réessayer.';
            feedback.className   = 'cp-feedback error';
          }
        }
      })
      .catch(function () {
        if (feedback) {
          feedback.textContent = 'Erreur réseau. Veuillez réessayer.';
          feedback.className   = 'cp-feedback error';
        }
      })
      .finally(function () {
        if (btn)  btn.disabled = false;
        if (span) span.textContent = 'Envoyer le message';
      });
  });

})();
