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
      if (window.innerWidth >= 770) closeMenu();
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

  function init() {
    document.querySelectorAll('.hr-header').forEach(initHeader);
    document.querySelectorAll('.hr-contact').forEach(initContactTabs);
    initCounters();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
