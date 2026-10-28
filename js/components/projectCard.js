// View: turns one project object into HTML.
export function projectCard({ title, tags, href, image, label = title }) {
  return `
    <article class="work-card">
      <a href="${href}" target="_blank" rel="noopener" class="work-card__thumb" aria-label="Open ${title}">
        <span class="work-card__ph" aria-hidden="true">${label}</span>
        ${image ? `<img src="${image}" alt="${title} preview">` : ""}
      </a>
      <div class="work-card__meta">
        <div>
          <h3 class="work-card__title">${title}</h3>
          <p class="work-card__tags">${tags.join(" &middot; ")}</p>
        </div>
        <a href="${href}" target="_blank" rel="noopener" class="work-card__plus" aria-label="View ${title}">+</a>
      </div>
    </article>`;
}