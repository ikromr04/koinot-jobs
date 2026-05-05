const formEl = document.querySelector('.resume-form');

if (formEl) {
  const fileEl = formEl.querySelector('[type="file"]');
  const submitEl = formEl.querySelector('[type="submit"]');

  fileEl.addEventListener('change', (evt) => {
    const spanEl = evt.target.previousElementSibling.querySelector('span');
    const file = evt.target.files[0];

    if (file) {
      spanEl.textContent = file.name;
    } else {
      spanEl.textContent = spanEl.dataset.label;
    }
  });

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
