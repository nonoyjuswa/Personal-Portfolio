USE portfolio;

TRUNCATE TABLE projects;
INSERT INTO projects (title, label, tags, href, image, sort_order) VALUES
('Project Title One',   'Project One',   'HTML/CSS,JavaScript',       '#', NULL, 1),
('Project Title Two',   'Project Two',   'Python,REST APIs',          '#', NULL, 2),
('Project Title Three', 'Project Three', 'Short description or tech', '#', NULL, 3);

TRUNCATE TABLE case_studies;
INSERT INTO case_studies (title, summary, href, theme, image, arch, sort_order) VALUES
('Project One',   'A short line about the result, e.g. what improved and how.', '#', 'wine',  NULL, 0, 1),
('Project Two',   'Redesigning a product so it tells a clearer story.',         '#', 'blush', NULL, 0, 2),
('Project Three', 'Building a digital experience that inspires and converts.',  '#', 'blush', NULL, 1, 3);

TRUNCATE TABLE services;
INSERT INTO services (title, text, icon, sort_order) VALUES
('Web Development',
 'Building responsive, accessible websites with HTML, CSS, and JavaScript.',
 '<path d="M8 7l-5 5 5 5"/><path d="M16 7l5 5-5 5"/><path d="M14 4l-4 16"/>', 1),
('Product Thinking',
 'Turning ideas into structured plans, always from the user''s perspective.',
 '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18"/><path d="M9 9v11"/>', 2),
('Backend & APIs',
 'Creating reliable logic and REST APIs with Python to power the front end.',
 '<rect x="3" y="4" width="18" height="6" rx="1.5"/><rect x="3" y="14" width="18" height="6" rx="1.5"/><path d="M7 7h.01M7 17h.01"/>', 3),
('Problem Solving',
 'Understanding how systems work and finding better ways to improve them.',
 '<circle cx="6" cy="6" r="2.5"/><circle cx="18" cy="12" r="2.5"/><circle cx="6" cy="18" r="2.5"/><path d="M8.5 6.5L15.5 11M8.5 17.5L15.5 13"/>', 4),
('Collaboration',
 'Working in teams with Git and GitHub, leading with clear communication.',
 '<circle cx="6" cy="5" r="2.2"/><circle cx="6" cy="19" r="2.2"/><circle cx="18" cy="9" r="2.2"/><path d="M6 7.2v9.6"/><path d="M18 11.2c0 4-6 3-12 5.6"/>', 5);