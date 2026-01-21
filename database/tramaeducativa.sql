-- ============================================
-- Trama Educativa - Database Schema
-- Ejecutar en el servidor remoto
-- ============================================

SET FOREIGN_KEY_CHECKS = 0;

-- --------------------------------------------
-- Tabla: categories
-- --------------------------------------------
CREATE TABLE IF NOT EXISTS `categories` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `color` VARCHAR(255) NOT NULL DEFAULT '#C84347',
    `description` TEXT NULL,
    `order` INT NOT NULL DEFAULT 0,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------
-- Tabla: authors
-- --------------------------------------------
CREATE TABLE IF NOT EXISTS `authors` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NULL,
    `bio` TEXT NULL,
    `avatar` VARCHAR(255) NULL,
    `social_links` JSON NULL,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `authors_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------
-- Tabla: articles
-- --------------------------------------------
CREATE TABLE IF NOT EXISTS `articles` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `excerpt` TEXT NULL,
    `body` LONGTEXT NOT NULL,
    `featured_image` VARCHAR(255) NULL,
    `featured_image_caption` VARCHAR(255) NULL,
    `category_id` BIGINT UNSIGNED NOT NULL,
    `author_id` BIGINT UNSIGNED NOT NULL,
    `status` ENUM('draft', 'review', 'published') NOT NULL DEFAULT 'draft',
    `is_featured` TINYINT(1) NOT NULL DEFAULT 0,
    `views` INT UNSIGNED NOT NULL DEFAULT 0,
    `embedding` LONGTEXT NULL,
    `embedding_hash` VARCHAR(64) NULL,
    `published_at` TIMESTAMP NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `articles_slug_unique` (`slug`),
    KEY `articles_status_is_featured_published_at_index` (`status`, `is_featured`, `published_at`),
    KEY `articles_published_at_index` (`published_at`),
    KEY `articles_category_id_foreign` (`category_id`),
    KEY `articles_author_id_foreign` (`author_id`),
    CONSTRAINT `articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
    CONSTRAINT `articles_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------
-- Tabla: tags
-- --------------------------------------------
CREATE TABLE IF NOT EXISTS `tags` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `tags_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------
-- Tabla: article_tag (pivot)
-- --------------------------------------------
CREATE TABLE IF NOT EXISTS `article_tag` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `article_id` BIGINT UNSIGNED NOT NULL,
    `tag_id` BIGINT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `article_tag_article_id_tag_id_unique` (`article_id`, `tag_id`),
    KEY `article_tag_tag_id_foreign` (`tag_id`),
    CONSTRAINT `article_tag_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
    CONSTRAINT `article_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================
-- Si las tablas ya existen y solo necesitas
-- agregar las columnas de embedding:
-- ============================================
-- ALTER TABLE `articles`
--     ADD COLUMN `embedding` LONGTEXT NULL AFTER `views`,
--     ADD COLUMN `embedding_hash` VARCHAR(64) NULL AFTER `embedding`;
