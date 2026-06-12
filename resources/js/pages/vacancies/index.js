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
        const value = evt.target.value;

        const categories = new Set(
            (url.searchParams.get('category') ?? '')
                .split(',')
                .filter(Boolean)
        );

        if (evt.target.checked) {
            categories.add(value);
        } else {
            categories.delete(value);
        }

        if (categories.size) {
            url.searchParams.set('category', [...categories].join(','));
        } else {
            url.searchParams.delete('category');
        }
    }
    if (evt.target.dataset.type === 'company') {
        const value = evt.target.value;

        const companies = new Set(
            (url.searchParams.get('company') ?? '')
                .split(',')
                .filter(Boolean)
        );

        if (evt.target.checked) {
            companies.add(value);
        } else {
            companies.delete(value);
        }

        if (companies.size) {
            url.searchParams.set('company', [...companies].join(','));
        } else {
            url.searchParams.delete('company');
        }
    }

    window.location.href = url.href;
})
