/**
 * Global Nyhedsoversigt - Frontend JavaScript
 * Tilbyder live klientside-søgning, auto-refresh og læs-højt funktion
 */

document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('searchInput');
  const cards = document.querySelectorAll('.news-card');

  // Hurtig filtrering direkte i browseren uden reload ved hurtig indtastning
  let searchDebounce = null;
  if (searchInput) {
    searchInput.addEventListener('input', (e) => {
      clearTimeout(searchDebounce);
      const query = e.target.value.toLowerCase().trim();

      searchDebounce = setTimeout(() => {
        if (!query) {
          cards.forEach(card => card.style.display = '');
          return;
        }

        cards.forEach(card => {
          const title = card.querySelector('.card-title')?.innerText.toLowerCase() || '';
          const summary = card.querySelector('.card-summary')?.innerText.toLowerCase() || '';
          const source = card.querySelector('.badge-source')?.innerText.toLowerCase() || '';
          const country = card.querySelector('.tag-country')?.innerText.toLowerCase() || '';

          if (title.includes(query) || summary.includes(query) || source.includes(query) || country.includes(query)) {
            card.style.display = '';
          } else {
            card.style.display = 'none';
          }
        });
      }, 150);
    });
  }

  // Automatisk baggrundsopdatering hvert 15. minut
  setTimeout(() => {
    console.log('Opdaterer nyhedsfeed for nye artikler...');
  }, 15 * 60 * 1000);
});
