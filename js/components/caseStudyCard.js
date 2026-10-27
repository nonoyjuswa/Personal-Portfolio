// View: turns one case study (and its index) into HTML.
export function caseStudyCard({ title, summary, href, theme = "wine", image, arch = false }, index) {
  const num = String(index + 1).padStart(2, "0");
  return `
    <article class="case-card case-card--${theme}">
      <div class="case-card__body">
        <span class="case-card__num">${num}</span>
        <h3 class="case-card__title">${title}</h3>
        <p class="case-card__summary">${summary}</p>
        <a href="${href}" class="case-card__link">View case study <span class="arrow-btn" aria-hidden="true">&rarr;</span></a>
      </div>
      <div class="case-card__media${arch ? " case-card__media--arch" : ""}">
        ${image ? `<img src="${image}" alt="${title} preview">` : ""}
      </div>
    </article>`;
}