function toggleMenu(e) {
  e.preventDefault();

  const nav = document.getElementById('myTopnav');
  const icon = document.getElementById('menuIcon');

  nav.classList.toggle('responsive');

  // Toggle the icon class
  if (nav.classList.contains('responsive')) {
    icon.className = 'fa-solid fa-x';
  } else {
    icon.className = 'fas fa-bars';
  }
}

document.getElementById('toggleBtn').addEventListener('click', toggleMenu);
document.getElementById('toggleTxt').addEventListener('click', toggleMenu);