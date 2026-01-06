-- ================================
-- DATABASE: mvc_project
-- ================================

CREATE DATABASE IF NOT EXISTS mvc_project
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE mvc_project;

-- ================================
-- TABLE: users
-- ================================
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100) DEFAULT NULL,
    is_admin TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- тестовий адмін (пароль: admin123)
INSERT INTO users (email, password, name, is_admin) VALUES
(
  'admin@example.com',
  '$2y$10$9eK1Zq2k5eJ6Kzv8rJ0g5Oq1F8G7f8l7F0O0zU8e8vY9y9rQvQZkW',
  'Admin',
  1
);

-- ================================
-- TABLE: posts
-- ================================
DROP TABLE IF EXISTS posts;

CREATE TABLE posts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO posts (title, content) VALUES
(
  'Перший тестовий пост',
  'Це тестовий запис із бази даних. Якщо ти це бачиш — MVC працює коректно.'
),
(
  'Другий пост',
  'Другий запис для перевірки списку постів.'
);

-- ================================
-- TABLE: migrations (на майбутнє)
-- ================================
DROP TABLE IF EXISTS migrations;

CREATE TABLE migrations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    migration VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;