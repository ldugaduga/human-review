(function () {
  function initHeader(header) {
    const btn = header.querySelector('.hr-menu-btn');
    const menu = header.querySelector('.hr-mobile-menu');
    const iconOpen = header.querySelector('.hr-icon-open');
    const iconClose = header.querySelector('.hr-icon-close');

    if (!btn || !menu || !iconOpen || !iconClose) return;

    function closeMenu() {
      menu.classList.add('hidden');
      iconOpen.classList.remove('hidden');
      iconClose.classList.add('hidden');
      btn.setAttribute('aria-expanded', 'false');
    }

    function toggleMenu() {
      const isOpen = !menu.classList.contains('hidden');
      menu.classList.toggle('hidden');
      iconOpen.classList.toggle('hidden');
      iconClose.classList.toggle('hidden');
      btn.setAttribute('aria-expanded', String(!isOpen));
    }

    btn.addEventListener('click', toggleMenu);
    menu.querySelectorAll('a').forEach((link) => link.addEventListener('click', closeMenu));
    window.addEventListener('resize', () => {
      if (window.innerWidth >= 880) closeMenu();
    });
  }

  function animateCounter(el) {
    const match = el.textContent.trim().match(/^(\d+)(.*)$/);
    if (!match) return;
    const target = parseInt(match[1], 10);
    const suffix = match[2];
    const duration = 1400;
    const start = performance.now();

    function step(now) {
      const progress = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      el.textContent = Math.floor(eased * target) + suffix;
      if (progress < 1) requestAnimationFrame(step);
      else el.textContent = target + suffix;
    }
    requestAnimationFrame(step);
  }

  function initCounters() {
    const counters = document.querySelectorAll('.js-counter');
    if (!counters.length) return;

    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.4 });

    counters.forEach((el) => observer.observe(el));
  }

  function initContactTabs(section) {
    const tabs = section.querySelectorAll('.hr-contact-tab');
    const panels = section.querySelectorAll('.hr-contact-panel');

    tabs.forEach((tab) => {
      tab.addEventListener('click', () => {
        tabs.forEach((t) => t.setAttribute('aria-selected', String(t === tab)));
        panels.forEach((panel) => {
          panel.hidden = panel.dataset.panel !== tab.dataset.tab;
        });
      });
    });
  }

  /*
   * Contact form validation. The embedded plugin form only had the browser's
   * native popup, which is easy to miss and leaves the field unmarked, so we
   * validate inline: red border + message under each invalid field, focus the
   * first one, and clear the error as the user fixes it. Runs in the capture
   * phase on document so it fires before the form plugin's own submit handler.
   */
  function fieldMessage(field) {
    if (field.validity.valueMissing) return 'This field is required.';
    if (field.validity.typeMismatch && field.type === 'email') return 'Please enter a valid email address.';
    return field.validationMessage || 'Please check this field.';
  }

  function fieldGroup(field) {
    // Prefer the form plugin's field wrapper (Elementor Pro, WPForms, Gravity
    // Forms, CF7) so the message sits under the whole field, not inside it.
    return (
      field.closest('.elementor-field-group') ||
      field.closest('.wpforms-field') ||
      field.closest('.gfield') ||
      field.closest('.wpcf7-form-control-wrap') ||
      field.parentElement
    );
  }

  function clearFieldError(field) {
    field.removeAttribute('aria-invalid');
    const group = fieldGroup(field);
    group.classList.remove('hr-field-invalid');
    const msg = group.querySelector('.hr-field-error');
    if (msg) msg.remove();
  }

  function showFieldError(field) {
    clearFieldError(field);
    const group = fieldGroup(field);
    const msg = document.createElement('span');
    msg.className = 'hr-field-error';
    msg.id = (field.id || field.name.replace(/\W+/g, '-')) + '-error';
    msg.setAttribute('role', 'alert');
    msg.textContent = fieldMessage(field);
    field.setAttribute('aria-invalid', 'true');
    field.setAttribute('aria-describedby', msg.id);
    group.classList.add('hr-field-invalid');
    group.appendChild(msg);
  }

  function validateContactForm(event) {
    const form = event.target;
    if (!(form instanceof HTMLFormElement) || !form.closest('.hr-contact-form')) return;

    const fields = Array.from(form.querySelectorAll('input, textarea, select')).filter(
      (f) => f.willValidate && f.type !== 'hidden' && f.offsetParent !== null
    );
    const invalid = fields.filter((f) => !f.checkValidity());
    fields.forEach((f) => (invalid.includes(f) ? showFieldError(f) : clearFieldError(f)));

    if (invalid.length) {
      event.preventDefault();
      event.stopImmediatePropagation();
      // Centre it rather than relying on focus scrolling, which can leave the
      // field hidden under the fixed header.
      invalid[0].focus({ preventScroll: true });
      invalid[0].scrollIntoView({ block: 'center', behavior: 'smooth' });
    }
  }

  function initContactValidation() {
    document.querySelectorAll('.hr-contact-form form').forEach((form) => {
      // Our inline messages replace the native popup.
      form.noValidate = true;
      form.addEventListener('input', (e) => {
        const field = e.target;
        if (field.getAttribute('aria-invalid') === 'true' && field.checkValidity()) clearFieldError(field);
      });
    });
  }

  function init() {
    document.querySelectorAll('.hr-header').forEach(initHeader);
    document.querySelectorAll('.hr-contact').forEach(initContactTabs);
    initContactValidation();
    initCounters();
  }

  document.addEventListener('submit', validateContactForm, true);

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
