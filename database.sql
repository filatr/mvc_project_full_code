-- --------------------------------------------------------
-- Створення бази даних
-- --------------------------------------------------------
CREATE DATABASE IF NOT EXISTS `pdv0_mvc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `pdv0_mvc`;

-- --------------------------------------------------------
-- Таблиця users
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `role` ENUM('user','editor','admin') DEFAULT 'user',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` DATETIME DEFAULT NULL,
  `login_attempts` INT DEFAULT 0,
  `is_blocked` TINYINT(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Тестові користувачі
INSERT INTO `users` (`username`, `email`, `password_hash`, `role`)
VALUES 
('admin', 'admin@example.com', '$2y$10$examplehash', 'admin'),
('editor', 'editor@example.com', '$2y$10$examplehash', 'editor'),
('user1', 'user1@example.com', '$2y$10$examplehash', 'user');

-- --------------------------------------------------------
-- Таблиця posts
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `posts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL,
  `status` ENUM('draft','published') DEFAULT 'draft',
  `author_id` INT NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `views` INT DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  FOREIGN KEY (`author_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Тестові записи
INSERT INTO `posts` (`title`, `slug`, `content`, `status`, `author_id`)
VALUES
('Перша публікація', 'persha-publikatsiya', '<p>Текст першої публікації</p>', 'published', 1),
('Чернетка', 'chernetka', '<p>Це чернетка</p>', 'draft', 2);

-- --------------------------------------------------------
-- Таблиця categories (розділи)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Тестові категорії
INSERT INTO `categories` (`name`, `slug`, `description`)
VALUES
('Новини', 'novyny', 'Розділ з новинами'),
('Статті', 'statty', 'Розділ зі статтями');

-- --------------------------------------------------------
-- Таблиця post_categories (зв'язок постів з категоріями)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `post_categories` (
  `post_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  PRIMARY KEY (`post_id`, `category_id`),
  FOREIGN KEY (`post_id`) REFERENCES `posts`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Тестовий зв'язок
INSERT INTO `post_categories` (`post_id`, `category_id`)
VALUES
(1, 1), -- Перша публікація -> Новини
(1, 2); -- Перша публікація -> Статті

-- --------------------------------------------------------
-- Таблиця sitemap_logs (для SEO та автоматичного оновлення)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sitemap_logs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `last_generated` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `status` ENUM('success','error') DEFAULT 'success',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Таблиця uploads (для завантажених файлів/зображень)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `uploads` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `filename` VARCHAR(255) NOT NULL,
  `original_name` VARCHAR(255) NOT NULL,
  `mime_type` VARCHAR(100) NOT NULL,
  `size` INT NOT NULL,
  `uploaded_by` INT NOT NULL,
  `uploaded_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`uploaded_by`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Тестові файли
INSERT INTO `uploads` (`filename`, `original_name`, `mime_type`, `size`, `uploaded_by`)
VALUES
('image1.jpg', 'example1.jpg', 'image/jpeg', 102400, 1),
('image2.png', 'example2.png', 'image/png', 204800, 2);