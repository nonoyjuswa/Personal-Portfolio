USE portfolio;

CREATE TABLE IF NOT EXISTS settings (
  name  VARCHAR(50) PRIMARY KEY,
  value VARCHAR(255) NOT NULL DEFAULT ''
);

INSERT IGNORE INTO settings (name, value) VALUES
('email',     'joshua.tamayo.iloilo@gmail.com'),
('github',    'https://github.com/nonoyjuswa'),
('linkedin',  'https://www.linkedin.com/in/joshua-tamayo-iloilo/'),
('instagram', ''),
('location',  'Iloilo City, Philippines');