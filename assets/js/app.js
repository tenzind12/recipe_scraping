const eyeBtn = document.querySelector('#password-eye__icon');
let passwordInput = document.querySelector('#password__container input');

if (eyeBtn) {
  eyeBtn.addEventListener('click', () => {
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      eyeBtn.classList.replace('fa-eye-slash', 'fa-eye');
    } else {
      passwordInput.type = 'password';
      eyeBtn.classList.replace('fa-eye', 'fa-eye-slash');
    }
  });
}
// T H E M E   C H A N G E R

const themeChanger = document.getElementById('themeChanger');
themeChanger.addEventListener('change', () => {
  const savedTheme = localStorage.getItem('theme');
  localStorage.setItem('theme', savedTheme === 'dark' ? 'light' : 'dark');

  if (savedTheme === 'light') {
    document.getElementsByTagName('body')[0].classList.add('theme-dark');
    document.getElementsByTagName('body')[0].classList.remove('theme-light');
  } else {
    document.getElementsByTagName('body')[0].classList.add('theme-light');
    document.getElementsByTagName('body')[0].classList.remove('theme-dark');
  }
});

const currentTheme = localStorage.getItem('theme');
if (currentTheme === 'dark') {
  document.getElementsByTagName('body')[0].classList.add('theme-dark');
  document.getElementsByTagName('body')[0].classList.remove('theme-light');
  themeChanger.checked = true;
} else {
  document.getElementsByTagName('body')[0].classList.add('theme-light');
  document.getElementsByTagName('body')[0].classList.remove('theme-dark');
  themeChanger.checked = false;
}
