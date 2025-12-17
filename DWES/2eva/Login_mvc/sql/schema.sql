-- Esquema SQL para tabla `users`

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL,
  `nombre` VARCHAR(100) DEFAULT NULL,
  `rol` VARCHAR(20) DEFAULT 'user',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Usuario de ejemplo (contraseña: demo123)
-- INSERT INTO users (email, password_hash, nombre) VALUES ('admin@example.com', '$2y$10$examplehash', 'Admin');
