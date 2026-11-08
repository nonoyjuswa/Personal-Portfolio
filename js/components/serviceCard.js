// View: turns one service object into HTML.
import { esc } from "../utils/escape.js";

export function serviceCard({ title, text, icon }) {
  // icon is raw SVG shapes on purpose. The admin form checks it (php/svg.php) before saving.
  return `
    <article class="service-card">
      <span class="service-card__icon">
        <svg viewBox="0 0 24 24" aria-hidden="true">${icon}</svg>
      </span>
      <h3 class="service-card__title">${esc(title)}</h3>
      <p class="service-card__text">${esc(text)}</p>
    </article>`;
}