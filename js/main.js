// Controller: connects data to views and the DOM.
import { projects } from "./data/projects.js";
import { services } from "./data/services.js";
import { caseStudies } from "./data/caseStudies.js";
import { projectCard } from "./components/projectCard.js";
import { serviceCard } from "./components/serviceCard.js";
import { caseStudyCard } from "./components/caseStudyCard.js";

const render = (selector, items, view) => {
  const el = document.querySelector(selector);
  if (el) el.innerHTML = items.map(view).join("");
};

render("#project-grid", projects, projectCard);
render("#case-study-grid", caseStudies, caseStudyCard);
render("#service-grid", services, serviceCard);