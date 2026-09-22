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

  function init() {
    document.querySelectorAll('.hr-header').forEach(initHeader);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
