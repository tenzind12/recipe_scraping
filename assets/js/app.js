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

{
  /* <i class="fa-solid fa-eye-slash"></i>; */
}
