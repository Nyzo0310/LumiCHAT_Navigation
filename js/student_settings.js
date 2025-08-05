// Dark mode toggle
const darkModeToggle = document.getElementById('darkModeToggle');

darkModeToggle.addEventListener('change', function () {
  document.body.classList.toggle('dark-theme', this.checked);
});
