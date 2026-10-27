// View: turns one project object into HTML.
export function projectCard({ title, summary, tags, demo, source }) {
  return `
    <article class="project-card">
      <h3 class="project-card__title">${title}</h3>
      <p class="project-card__summary">${summary}</p>
      <ul class="project-card__tags">
        ${tags.map(t => `<li class="project-card__tag">${t}</li>`).join("")}
      </ul>
      <a class="project-card__link" href="${demo}" target="_blank" rel="noopener">Live Demo</a>
      <a class="project-card__link" href="${source}" target="_blank" rel="noopener">Source Code</a>
    </article>`;
}