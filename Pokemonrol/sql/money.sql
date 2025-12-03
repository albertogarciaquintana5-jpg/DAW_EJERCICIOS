-- SQL de referencia para la funcionalidad de dinero
CREATE TABLE IF NOT EXISTS `money_transactions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  `type` VARCHAR(50) NOT NULL,
  `meta` TEXT DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Ejemplo de cómo añadir dinero a un usuario (id = 1)
-- UPDATE usuarios SET money = money + 500 WHERE id = 1;
