// View: turns one project object into HTML.
import { esc, safeUrl } from "../utils/escape.js";

export function projectCard({ title, tags, href, image, label = title }) {
  const url = esc(safeUrl(href));
  return `
    <article class="work-card">
      <a href="${url}" target="_blank" rel="noopener" class="work-card__thumb" aria-label="Open ${esc(title)}">
        <span class="work-card__ph" aria-hidden="true">${esc(label)}</span>
        ${image ? `<img src="${esc(image)}" alt="${esc(title)} preview">` : ""}
      </a>
      <div class="work-card__meta">
        <div>
          <h3 class="work-card__title">${esc(title)}</h3>
          <p class="work-card__tags">${tags.map(esc).join(" &middot; ")}</p>
        </div>
        <a href="${url}" target="_blank" rel="noopener" class="work-card__plus" aria-label="View ${esc(title)}">+</a>
      </div>
    </article>`;
}