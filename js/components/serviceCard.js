// View: turns one service object into HTML.
export function serviceCard({ title, text, icon }) {
  return `
    <article class="service-card">
      <span class="service-card__icon">
        <svg viewBox="0 0 24 24" aria-hidden="true">${icon}</svg>
      </span>
      <h3 class="service-card__title">${title}</h3>
      <p class="service-card__text">${text}</p>
    </article>`;
}