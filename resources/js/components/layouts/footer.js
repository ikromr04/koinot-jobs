const formEl = document.querySelector('.footer__form');

if (formEl) {
  const submitEl = formEl.querySelector('[type="submit"]');

  formEl.addEventListener('submit', (evt) => {
    evt.preventDefault();

    submitEl.classList.add('submitting');

    setTimeout(() => {
      submitEl.classList.remove('submitting');
      submitEl.classList.add('success');
      formEl.reset();

      setTimeout(() => {
        submitEl.classList.remove('success');
      }, 1000);
    }, 2000);
  })
}
