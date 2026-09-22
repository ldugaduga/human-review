(function () {
  const btn = document.getElementById('menu-btn');
  const menu = document.getElementById('mobile-menu');
  const iconOpen = document.getElementById('icon-open');
  const iconClose = document.getElementById('icon-close');

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
    if (window.innerWidth >= 768) closeMenu();
  });
})();
