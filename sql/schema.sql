CREATE DATABASE IF NOT EXISTS portfolio
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE portfolio;

-- Contact form submissions (Step 3)
CREATE TABLE IF NOT EXISTS messages (
  id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(100) NOT NULL,
  email      VARCHAR(150) NOT NULL,
  message    TEXT NOT NULL,
  is_read    TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Featured work cards (Step 4)
CREATE TABLE IF NOT EXISTS projects (
  id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title      VARCHAR(150) NOT NULL,
  label      VARCHAR(100) NULL,
  tags       VARCHAR(255) NOT NULL DEFAULT '',   -- comma-separated
  href       VARCHAR(255) NOT NULL DEFAULT '#',
  image      VARCHAR(255) NULL,
  sort_order INT NOT NULL DEFAULT 0
);

-- "What I Do" cards (Step 4)
CREATE TABLE IF NOT EXISTS services (
  id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title      VARCHAR(100) NOT NULL,
  text       VARCHAR(255) NOT NULL,
  icon       TEXT NOT NULL,                      -- inner SVG markup
  sort_order INT NOT NULL DEFAULT 0
);

-- Case study cards (Step 4)
CREATE TABLE IF NOT EXISTS case_studies (
  id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title      VARCHAR(150) NOT NULL,
  summary    VARCHAR(255) NOT NULL,
  href       VARCHAR(255) NOT NULL DEFAULT '#',
  theme      ENUM('wine','blush') NOT NULL DEFAULT 'wine',
  image      VARCHAR(255) NULL,
  arch       TINYINT(1) NOT NULL DEFAULT 0,
  sort_order INT NOT NULL DEFAULT 0
);