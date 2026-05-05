const formEl = document.querySelector('.vacancies__filter form');

formEl?.addEventListener('change', (evt) => {
  const url = new URL(window.location.href);
  url.hash = 'vacancies';

  url.searchParams.set('page', '1');

  if (evt.target.name === 'city') {
    if (evt.target.value) {
      url.searchParams.set('city', evt.target.value);
    } else {
      url.searchParams.delete('city');
    }
  }

  if (evt.target.dataset.type === 'category') {
    if (evt.target.checked) {
      url.searchParams.set('category', evt.target.value);
    } else {
      url.searchParams.delete('category');
    }
  }
  if (evt.target.dataset.type === 'company') {
    if (evt.target.checked) {
      url.searchParams.set('company', evt.target.value);
    } else {
      url.searchParams.delete('company');
    }
  }

  window.location.href = url.href;
})
