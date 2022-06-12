const eyeBtn = document.querySelector('#password-eye__icon');
let passwordInput = document.querySelector('#password__container input');

// password show eye button
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

// THEME CHANGER (cookies) --button
const changeClass = (val) => {
  if (!val) {
    document.getElementsByTagName('body')[0].classList.add('theme-dark');
    document.getElementsByTagName('body')[0].classList.remove('theme-light');
  } else {
    document.getElementsByTagName('body')[0].classList.add('theme-light');
    document.getElementsByTagName('body')[0].classList.remove('theme-dark');
  }
};

// THEME change slider button
const themeChanger = document.getElementById('themeChanger');
themeChanger.addEventListener('change', (e) => {
  const val = e.target.checked;
  // prettier-ignore
  document.cookie = ['light=', val ? '1' : '0', '; expires=',new Date(Date.now() + 604800000)].join('');
  changeClass(val);
});

// LANGUAGE CHANGER
const langChanger = document.querySelector('#language');

if (langChanger)
  langChanger.addEventListener('click', (e) => {
    const lang = e.target.value;
    document.cookie = ['language=', lang, '; expires=', new Date(Date.now() + 60000000)].join('');
  });
