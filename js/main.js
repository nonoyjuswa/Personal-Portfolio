// Controller: loads content from PHP and renders it with the view components.
import { projectCard } from "./components/projectCard.js";
import { serviceCard } from "./components/serviceCard.js";
import { caseStudyCard } from "./components/caseStudyCard.js";

const render = (selector, items, view) => {
  const el = document.querySelector(selector);
  if (el) el.innerHTML = items.map(view).join("");
};

async function init() {
  try {
    const res = await fetch("php/content.php");
    if (!res.ok) throw new Error("Server responded " + res.status);
    const { projects, services, caseStudies } = await res.json();

    render("#project-grid", projects, projectCard);
    render("#case-study-grid", caseStudies, caseStudyCard);
    render("#service-grid", services, serviceCard);
  } catch (err) {
    console.error("Could not load content:", err);
    ["#project-grid", "#case-study-grid", "#service-grid"].forEach((sel) => {
      const el = document.querySelector(sel);
      if (el) el.textContent = "Content could not be loaded right now.";
    });
  }
}

init();