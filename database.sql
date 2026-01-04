SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- -----------------------------------------------------
-- Таблиця користувачів
-- -----------------------------------------------------
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user','admin') NOT NULL DEFAULT 'user',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Таблиця постів
-- -----------------------------------------------------
DROP TABLE IF EXISTS posts;
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    content TEXT NOT NULL,
    is_published TINYINT(1) NOT NULL DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Тестовий адмін
-- пароль: admin123
-- -----------------------------------------------------
INSERT INTO users (email, password, role) VALUES (
    'admin@test.com',
    '$2y$10$wHn4j5N7w9VZz7F7R2fN0O5a9bO6Xv9tMZ9JzN9K6E8U0JH0w7EKa',
    'admin'
);

-- -----------------------------------------------------
-- Тестові пости
-- -----------------------------------------------------
INSERT INTO posts (title, slug, content, is_published) VALUES
(
    'Перший пост',
    'pershyi-post',
    'Це тестовий пост для перевірки MVC.',
    1
),
(
    'Другий пост',
    'druhyi-post',
    'Ще один пост для головної сторінки.',
    1
);