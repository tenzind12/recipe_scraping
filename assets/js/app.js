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

// T H E M E   C H A N G E R (cookies)

const changeClass = (val) => {
  if (!val) {
    document.getElementsByTagName('body')[0].classList.add('theme-dark');
    document.getElementsByTagName('body')[0].classList.remove('theme-light');
  } else {
    document.getElementsByTagName('body')[0].classList.add('theme-light');
    document.getElementsByTagName('body')[0].classList.remove('theme-dark');
  }
};

const themeChanger = document.getElementById('themeChanger');

themeChanger.addEventListener('change', (e) => {
  const val = e.target.checked;
  document.cookie = [
    'light=',
    val ? '1' : '0',
    '; expires=',
    new Date(Date.now() + 604800000),
    '; path=/',
  ].join('');
  changeClass(val);
});
