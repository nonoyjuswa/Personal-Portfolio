// Controller: connects data to views and the DOM.
import { projects } from "./data/projects.js";
import { projectCard } from "./components/projectCard.js";

const grid = document.querySelector("#project-grid");
if (grid) grid.innerHTML = projects.map(projectCard).join("");