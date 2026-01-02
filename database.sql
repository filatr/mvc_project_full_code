-- =========================================
-- DATABASE
-- =========================================

CREATE DATABASE IF NOT EXISTS mvc_project
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE mvc_project;

-- =========================================
-- USERS
-- =========================================

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(191) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =========================================
-- POSTS
-- =========================================

CREATE TABLE posts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL,

    CONSTRAINT fk_posts_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- =========================================
-- SESSIONS (optional, if stored in DB)
-- =========================================

CREATE TABLE sessions (
    id VARCHAR(128) PRIMARY KEY,
    user_id INT UNSIGNED DEFAULT NULL,
    data BLOB NOT NULL,
    last_activity TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_sessions_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE SET NULL
) ENGINE=InnoDB;

-- =========================================
-- DEFAULT ADMIN USER
-- password: admin123
-- =========================================

INSERT INTO users (email, password, name, role)
VALUES (
    'admin@example.com',
    '$2y$10$7tZqgRZ0uY7F8Q8A3P1e7.7E0lGQq0n5sNnYt9Z8x8xj0g9uE8K9C',
    'Administrator',
    'admin'
);

-- =========================================
-- SAMPLE POSTS
-- =========================================

INSERT INTO posts (user_id, title, content) VALUES
(
    1,
    'Перший пост',
    'Це перший тестовий пост у MVC-проєкті.'
),
(
    1,
    'Другий пост',
    'MVC працює. Авторизація, контролери та вʼюхи підключені.'
);
