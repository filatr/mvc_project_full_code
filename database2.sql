SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- Таблиця користувачів
-- --------------------------------------------------------

DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('user','editor','admin') DEFAULT 'user',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    last_login DATETIME DEFAULT NULL,
    is_blocked TINYINT(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Тестовий адмін (пароль: admin123)
INSERT INTO users (username, email, password_hash, role)
VALUES (
    'admin',
    'admin@example.com',
    '$2y$10$WlE8X9Z7Z1m0M8Z3Ff0QeOZ2eZgQn9gFJxE3k9PZ8xJt7FqQy9XbS',
    'admin'
);

-- --------------------------------------------------------
-- Таблиця постів
-- --------------------------------------------------------

DROP TABLE IF EXISTS posts;
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    content TEXT NOT NULL,
    status ENUM('draft','published') DEFAULT 'draft',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    author_id INT DEFAULT NULL,
    views INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Тестовий пост
INSERT INTO posts (title, slug, content, status, author_id)
VALUES (
    'Перший тестовий пост',
    'pershyi-testovyi-post',
    '<p>Це <strong>перший</strong> тестовий пост у твоїй власній CMS 🎉</p>',
    'published',
    1
);

-- --------------------------------------------------------
-- Таблиця категорій
-- --------------------------------------------------------

DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO categories (name, slug)
VALUES ('Загальне', 'zagalne');

-- --------------------------------------------------------
-- Звʼязок постів і категорій (many-to-many)
-- --------------------------------------------------------

DROP TABLE IF EXISTS post_category;
CREATE TABLE post_category (
    post_id INT NOT NULL,
    category_id INT NOT NULL,
    PRIMARY KEY (post_id, category_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO post_category (post_id, category_id)
VALUES (1, 1);

-- --------------------------------------------------------
-- Таблиця медіафайлів
-- --------------------------------------------------------

DROP TABLE IF EXISTS media;
CREATE TABLE media (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) NOT NULL,
    filepath VARCHAR(255) NOT NULL,
    mime_type VARCHAR(100) NOT NULL,
    size INT NOT NULL,
    uploaded_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    uploaded_by INT DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;