const langEl = document.querySelector('.lang');
const togglerEl = document.querySelector('.lang__toggler');

if (langEl && togglerEl) {
  const hideLang = () => {
    langEl.classList.remove('lang--shown');
    detachEvents();
  };

  const handleDocumentKeydown = (e) => {
    if (e.key === 'Escape') hideLang();
  };

  const handleDocumentClick = (e) => {
    if (!e.target.closest('.lang')) hideLang();
  };

  const handleDocumentScroll = () => hideLang();

  const attachEvents = () => {
    document.addEventListener('keydown', handleDocumentKeydown);
    document.addEventListener('click', handleDocumentClick);
    document.addEventListener('scroll', handleDocumentScroll);
  };

  const detachEvents = () => {
    document.removeEventListener('keydown', handleDocumentKeydown);
    document.removeEventListener('click', handleDocumentClick);
    document.removeEventListener('scroll', handleDocumentScroll);
  };

  togglerEl.addEventListener('click', () => {
    if (langEl.classList.contains('lang--shown')) {
      hideLang();
    } else {
      langEl.classList.add('lang--shown');
      attachEvents();
    }
  });
}
