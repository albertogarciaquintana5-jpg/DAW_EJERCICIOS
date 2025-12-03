-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2025 a las 13:35:09
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`user_id`, `item_id`, `cantidad`) VALUES
(1, 1, 24),
(1, 3, 1),
(1, 4, 15),
(1, 5, 1),
(4, 1, 10),
(4, 2, 3),
(4, 3, 10),
(4, 4, 1),
(4, 5, 4),
(4, 6, 5);

--
-- Disparadores `inventario`
--
DELIMITER $$
CREATE TRIGGER `trg_inventario_clean_after_update` AFTER UPDATE ON `inventario` FOR EACH ROW BEGIN
  IF NEW.cantidad <= 0 THEN
    DELETE FROM inventario WHERE user_id = NEW.user_id AND item_id = NEW.item_id;
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `icono` varchar(100) DEFAULT NULL,
  `effect_type` varchar(50) DEFAULT NULL,
  `effect_value` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `clave`, `nombre`, `descripcion`, `icono`, `effect_type`, `effect_value`, `price`) VALUES
(1, 'potion', 'Poción', 'Restaura 20 HP', 'potion.png', 'Curación', 20, 300.00),
(2, 'superpotion', 'Super Poción', 'Restaura 50 HP', 'superpotion.png', 'Curación', 50, 600.00),
(3, 'pokeball', 'Poké Ball', 'Captura un Pokémon x1', 'pokeball.png', 'Captura', NULL, 200.00),
(4, 'superball', 'Super Ball', 'Captura un Pokémon x1.5', 'superball.png', 'Captura', NULL, 600.00),
(5, 'revive', 'Revivir', 'Revive y restaura HP parcial', 'revivir.png', 'Revivir', 50, 1500.00),
(6, 'antidote', 'Antídoto', 'Quita el estado de veneno', 'antidoto.png', 'Curacion de estados', NULL, 100.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `money_transactions`
--

CREATE TABLE `money_transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` varchar(50) NOT NULL,
  `meta` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `money_transactions`
--

INSERT INTO `money_transactions` (`id`, `user_id`, `amount`, `type`, `meta`, `created_at`) VALUES
(1, 1, 50.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":50}', '2025-12-03 01:11:54'),
(2, 1, 50.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":50}', '2025-12-03 01:11:57'),
(3, 1, 50.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":50}', '2025-12-03 01:11:57'),
(4, 1, 50.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":50}', '2025-12-03 01:11:58'),
(5, 1, 50.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":50}', '2025-12-03 01:11:58'),
(6, 1, 50.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":50}', '2025-12-03 01:11:58'),
(7, 1, 50.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":50}', '2025-12-03 01:11:58'),
(8, 1, 50.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":50}', '2025-12-03 01:11:58'),
(9, 1, 50.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":50}', '2025-12-03 01:11:59'),
(10, 1, 50.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":50}', '2025-12-03 01:11:59'),
(11, 1, 50.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":50}', '2025-12-03 01:27:00'),
(12, 1, 50.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":50}', '2025-12-03 01:27:01'),
(13, 1, 50.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":50}', '2025-12-03 01:27:01'),
(14, 1, 120.00, 'purchase', '{\"item\":\"superpotion\",\"qty\":1,\"unit_price\":120}', '2025-12-03 01:27:03'),
(15, 1, 120.00, 'purchase', '{\"item\":\"superpotion\",\"qty\":1,\"unit_price\":120}', '2025-12-03 01:27:05'),
(16, 1, 40.00, 'purchase', '{\"item\":\"antidote\",\"qty\":1,\"unit_price\":40}', '2025-12-03 01:27:14'),
(17, 1, 40.00, 'purchase', '{\"item\":\"antidote\",\"qty\":1,\"unit_price\":40}', '2025-12-03 01:27:14'),
(18, 1, 350.00, 'purchase', '{\"item\":\"superball\",\"qty\":1,\"unit_price\":350}', '2025-12-03 01:27:21'),
(19, 1, 350.00, 'purchase', '{\"item\":\"superball\",\"qty\":1,\"unit_price\":350}', '2025-12-03 01:27:21'),
(20, 1, 350.00, 'purchase', '{\"item\":\"superball\",\"qty\":1,\"unit_price\":350}', '2025-12-03 01:27:21'),
(21, 1, 350.00, 'purchase', '{\"item\":\"superball\",\"qty\":1,\"unit_price\":350}', '2025-12-03 01:27:21'),
(22, 3, 1500.00, 'purchase', '{\"item\":\"revive\",\"qty\":1,\"unit_price\":1500}', '2025-12-03 02:34:07'),
(23, 3, 1500.00, 'purchase', '{\"item\":\"revive\",\"qty\":1,\"unit_price\":1500}', '2025-12-03 02:34:07'),
(24, 3, 1500.00, 'purchase', '{\"item\":\"revive\",\"qty\":1,\"unit_price\":1500}', '2025-12-03 02:34:07'),
(25, 3, 1500.00, 'purchase', '{\"item\":\"revive\",\"qty\":1,\"unit_price\":1500}', '2025-12-03 02:34:07'),
(26, 3, 1500.00, 'purchase', '{\"item\":\"revive\",\"qty\":1,\"unit_price\":1500}', '2025-12-03 02:34:07'),
(27, 3, 1500.00, 'purchase', '{\"item\":\"revive\",\"qty\":1,\"unit_price\":1500}', '2025-12-03 02:34:08'),
(28, 4, 1500.00, 'purchase', '{\"item\":\"revive\",\"qty\":1,\"unit_price\":1500}', '2025-12-03 02:34:09'),
(29, 4, 600.00, 'purchase', '{\"item\":\"superball\",\"qty\":1,\"unit_price\":600}', '2025-12-03 02:34:14'),
(30, 4, 100.00, 'purchase', '{\"item\":\"antidote\",\"qty\":1,\"unit_price\":100}', '2025-12-03 02:34:31'),
(31, 4, 200.00, 'purchase', '{\"item\":\"pokeball\",\"qty\":1,\"unit_price\":200}', '2025-12-03 02:34:35'),
(32, 4, 600.00, 'purchase', '{\"item\":\"superpotion\",\"qty\":1,\"unit_price\":600}', '2025-12-03 02:34:36'),
(33, 4, 300.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":300}', '2025-12-03 02:34:36'),
(34, 4, 200.00, 'purchase', '{\"item\":\"pokeball\",\"qty\":1,\"unit_price\":200}', '2025-12-03 02:35:09'),
(35, 4, 200.00, 'purchase', '{\"item\":\"pokeball\",\"qty\":1,\"unit_price\":200}', '2025-12-03 02:35:09'),
(36, 4, 600.00, 'purchase', '{\"item\":\"superpotion\",\"qty\":1,\"unit_price\":600}', '2025-12-03 02:35:10'),
(37, 4, 600.00, 'purchase', '{\"item\":\"superpotion\",\"qty\":1,\"unit_price\":600}', '2025-12-03 02:35:10'),
(38, 4, 300.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":300}', '2025-12-03 02:35:11'),
(39, 4, 300.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":300}', '2025-12-03 02:35:11'),
(40, 4, 300.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":300}', '2025-12-03 02:35:11'),
(41, 4, 300.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":300}', '2025-12-03 02:35:11'),
(42, 4, 200.00, 'purchase', '{\"item\":\"pokeball\",\"qty\":1,\"unit_price\":200}', '2025-12-03 02:35:12'),
(43, 4, 200.00, 'purchase', '{\"item\":\"pokeball\",\"qty\":1,\"unit_price\":200}', '2025-12-03 02:35:12'),
(44, 4, 200.00, 'purchase', '{\"item\":\"pokeball\",\"qty\":1,\"unit_price\":200}', '2025-12-03 02:35:12'),
(45, 4, 100.00, 'purchase', '{\"item\":\"antidote\",\"qty\":1,\"unit_price\":100}', '2025-12-03 02:35:13'),
(46, 3, 600.00, 'purchase', '{\"item\":\"superball\",\"qty\":1,\"unit_price\":600}', '2025-12-03 02:35:17'),
(47, 4, 1500.00, 'purchase', '{\"item\":\"revive\",\"qty\":1,\"unit_price\":1500}', '2025-12-03 02:35:28'),
(48, 4, 1500.00, 'purchase', '{\"item\":\"revive\",\"qty\":1,\"unit_price\":1500}', '2025-12-03 02:35:29'),
(49, 4, 1500.00, 'purchase', '{\"item\":\"revive\",\"qty\":1,\"unit_price\":1500}', '2025-12-03 02:35:31'),
(50, 4, 100.00, 'purchase', '{\"item\":\"antidote\",\"qty\":1,\"unit_price\":100}', '2025-12-03 02:36:33'),
(51, 4, 200.00, 'purchase', '{\"item\":\"pokeball\",\"qty\":1,\"unit_price\":200}', '2025-12-03 02:38:04'),
(52, 4, 200.00, 'purchase', '{\"item\":\"pokeball\",\"qty\":1,\"unit_price\":200}', '2025-12-03 02:38:05'),
(53, 4, 200.00, 'purchase', '{\"item\":\"pokeball\",\"qty\":1,\"unit_price\":200}', '2025-12-03 02:38:05'),
(54, 4, 200.00, 'purchase', '{\"item\":\"pokeball\",\"qty\":1,\"unit_price\":200}', '2025-12-03 02:38:06'),
(55, 4, 200.00, 'purchase', '{\"item\":\"pokeball\",\"qty\":1,\"unit_price\":200}', '2025-12-03 02:38:06'),
(56, 4, 200.00, 'purchase', '{\"item\":\"pokeball\",\"qty\":1,\"unit_price\":200}', '2025-12-03 02:38:06'),
(57, 4, 300.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":300}', '2025-12-03 02:39:03'),
(58, 4, 300.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":300}', '2025-12-03 02:39:04'),
(59, 4, 300.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":300}', '2025-12-03 02:39:06'),
(60, 4, 300.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":300}', '2025-12-03 02:39:07'),
(61, 4, 300.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":300}', '2025-12-03 02:39:07'),
(62, 1, 600.00, 'purchase', '{\"item\":\"superball\",\"qty\":1,\"unit_price\":600}', '2025-12-03 03:33:51'),
(63, 1, 600.00, 'purchase', '{\"item\":\"superball\",\"qty\":1,\"unit_price\":600}', '2025-12-03 03:33:51'),
(64, 1, 200.00, 'purchase', '{\"item\":\"pokeball\",\"qty\":1,\"unit_price\":200}', '2025-12-03 03:33:52'),
(65, 1, 200.00, 'purchase', '{\"item\":\"pokeball\",\"qty\":1,\"unit_price\":200}', '2025-12-03 03:33:53'),
(66, 1, 300.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":300}', '2025-12-03 03:33:56'),
(67, 1, 300.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":300}', '2025-12-03 03:33:56'),
(68, 1, 300.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":300}', '2025-12-03 03:33:56'),
(69, 1, 300.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":300}', '2025-12-03 03:33:57'),
(70, 1, 1500.00, 'purchase', '{\"item\":\"revive\",\"qty\":1,\"unit_price\":1500}', '2025-12-03 03:36:51'),
(71, 1, 1500.00, 'purchase', '{\"item\":\"revive\",\"qty\":1,\"unit_price\":1500}', '2025-12-03 03:36:56'),
(72, 1, 1500.00, 'purchase', '{\"item\":\"revive\",\"qty\":1,\"unit_price\":1500}', '2025-12-03 03:36:56'),
(73, 1, 1500.00, 'purchase', '{\"item\":\"revive\",\"qty\":1,\"unit_price\":1500}', '2025-12-03 03:36:57'),
(74, 1, 300.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":300}', '2025-12-03 03:37:10'),
(75, 1, 300.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":300}', '2025-12-03 03:37:10'),
(76, 1, 300.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":300}', '2025-12-03 03:37:18'),
(77, 1, 300.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":300}', '2025-12-03 03:37:19'),
(78, 1, 300.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":300}', '2025-12-03 03:37:20'),
(79, 1, 1500.00, 'purchase', '{\"item\":\"revive\",\"qty\":1,\"unit_price\":1500}', '2025-12-03 03:37:27'),
(80, 1, 1500.00, 'purchase', '{\"item\":\"revive\",\"qty\":1,\"unit_price\":1500}', '2025-12-03 03:37:28'),
(81, 1, 600.00, 'purchase', '{\"item\":\"superball\",\"qty\":1,\"unit_price\":600}', '2025-12-03 03:37:29'),
(82, 1, 600.00, 'purchase', '{\"item\":\"superball\",\"qty\":1,\"unit_price\":600}', '2025-12-03 03:37:29'),
(83, 1, 600.00, 'purchase', '{\"item\":\"superball\",\"qty\":1,\"unit_price\":600}', '2025-12-03 03:37:29'),
(84, 1, 600.00, 'purchase', '{\"item\":\"superball\",\"qty\":1,\"unit_price\":600}', '2025-12-03 03:37:30'),
(85, 1, 600.00, 'purchase', '{\"item\":\"superball\",\"qty\":1,\"unit_price\":600}', '2025-12-03 03:37:30'),
(86, 1, 600.00, 'purchase', '{\"item\":\"superball\",\"qty\":1,\"unit_price\":600}', '2025-12-03 03:37:30'),
(87, 1, 600.00, 'purchase', '{\"item\":\"superball\",\"qty\":1,\"unit_price\":600}', '2025-12-03 03:37:30'),
(88, 1, 600.00, 'purchase', '{\"item\":\"superball\",\"qty\":1,\"unit_price\":600}', '2025-12-03 03:37:38'),
(89, 1, 600.00, 'purchase', '{\"item\":\"superball\",\"qty\":1,\"unit_price\":600}', '2025-12-03 03:37:38'),
(90, 1, 600.00, 'purchase', '{\"item\":\"superball\",\"qty\":1,\"unit_price\":600}', '2025-12-03 03:37:38'),
(91, 1, 600.00, 'purchase', '{\"item\":\"superball\",\"qty\":1,\"unit_price\":600}', '2025-12-03 03:37:38'),
(92, 1, 600.00, 'purchase', '{\"item\":\"superball\",\"qty\":1,\"unit_price\":600}', '2025-12-03 03:37:38'),
(93, 1, 300.00, 'purchase', '{\"item\":\"potion\",\"qty\":1,\"unit_price\":300}', '2025-12-03 13:07:12'),
(94, 1, 200.00, 'purchase', '{\"item\":\"pokeball\",\"qty\":1,\"unit_price\":200}', '2025-12-03 13:12:53'),
(95, 1, 200.00, 'purchase', '{\"item\":\"pokeball\",\"qty\":1,\"unit_price\":200}', '2025-12-03 13:30:58'),
(96, 1, 200.00, 'purchase', '{\"item\":\"pokeball\",\"qty\":1,\"unit_price\":200}', '2025-12-03 13:30:58'),
(97, 1, 200.00, 'purchase', '{\"item\":\"pokeball\",\"qty\":1,\"unit_price\":200}', '2025-12-03 13:30:58'),
(98, 1, 200.00, 'purchase', '{\"item\":\"pokeball\",\"qty\":1,\"unit_price\":200}', '2025-12-03 13:30:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pokedex`
--

CREATE TABLE `pokedex` (
  `user_id` int(11) NOT NULL,
  `species_id` int(11) NOT NULL,
  `visto` tinyint(4) DEFAULT 0,
  `capturado` tinyint(4) DEFAULT 0,
  `veces_visto` int(11) DEFAULT 0,
  `first_seen_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pokedex`
--

INSERT INTO `pokedex` (`user_id`, `species_id`, `visto`, `capturado`, `veces_visto`, `first_seen_at`) VALUES
(1, 1, 1, 0, 1, '2025-12-02 22:01:11'),
(3, 4, 1, 1, 1, NULL),
(4, 5, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pokemon_box`
--

CREATE TABLE `pokemon_box` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `species_id` int(11) NOT NULL,
  `apodo` varchar(150) DEFAULT NULL,
  `nivel` int(11) DEFAULT 1,
  `cp` int(11) DEFAULT 0,
  `hp` int(11) DEFAULT NULL,
  `max_hp` int(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pokemon_box`
--

INSERT INTO `pokemon_box` (`id`, `user_id`, `species_id`, `apodo`, `nivel`, `cp`, `hp`, `max_hp`, `status`, `created_at`) VALUES
(1, 1, 1, 'Pika', 5, 200, 35, 35, '', '2025-12-02 22:01:11'),
(2, 1, 2, 'manolo', 5, 200, 20, 40, NULL, '2025-12-02 22:15:25'),
(4, 3, 4, 'Patata Frita', 1, 1, 30, 30, NULL, '2025-12-03 02:38:23'),
(5, 4, 5, 'Negro', 1, 1, 20, 20, NULL, '2025-12-03 02:41:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pokemon_species`
--

CREATE TABLE `pokemon_species` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `sprite` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pokemon_species`
--

INSERT INTO `pokemon_species` (`id`, `nombre`, `sprite`) VALUES
(1, 'Pikachu', 'pikachu.png'),
(2, 'Charmander', 'charmander.png'),
(3, 'Bulbasaur', 'bulbasaur.png'),
(4, 'Greninja', 'greninja.png'),
(5, 'Zekrom', 'zekrom.png\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `team`
--

CREATE TABLE `team` (
  `user_id` int(11) NOT NULL,
  `slot` tinyint(4) NOT NULL,
  `pokemon_box_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `team`
--

INSERT INTO `team` (`user_id`, `slot`, `pokemon_box_id`) VALUES
(1, 3, NULL),
(1, 4, NULL),
(1, 5, NULL),
(1, 6, NULL),
(1, 2, 1),
(1, 1, 2),
(3, 1, 4),
(4, 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `money` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `correo`, `contraseña`, `created_at`, `money`) VALUES
(1, 'ALberto', 'Garcia Quintana', 'albertogarciaquintana5@gmail.com', 'Albertosaurio', '2025-12-02 22:01:11', 99978199.99),
(3, 'Mario', 'Pacheco', 'mariopachecobarea@gmail.com', '$2y$12$QGgibLBjX5tpCYWDG4EBPOhVVfULvBxH8kApTpHLdWj31eEKNG7Wm', '2025-12-03 02:29:38', 40400.00),
(4, 'Pablo', 'Pingu', 'pablolorentemart@gmail.com', '$2y$12$S6UiVyAgIPokhnCQU6DzROxd53M0k8DMK772MZrbfe3/mvwUw4CE6', '2025-12-03 02:31:59', 35900.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`user_id`,`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clave` (`clave`);

--
-- Indices de la tabla `money_transactions`
--
ALTER TABLE `money_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `pokedex`
--
ALTER TABLE `pokedex`
  ADD PRIMARY KEY (`user_id`,`species_id`),
  ADD KEY `species_id` (`species_id`);

--
-- Indices de la tabla `pokemon_box`
--
ALTER TABLE `pokemon_box`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `species_id` (`species_id`);

--
-- Indices de la tabla `pokemon_species`
--
ALTER TABLE `pokemon_species`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`user_id`,`slot`),
  ADD KEY `pokemon_box_id` (`pokemon_box_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `money_transactions`
--
ALTER TABLE `money_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de la tabla `pokemon_box`
--
ALTER TABLE `pokemon_box`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pokemon_species`
--
ALTER TABLE `pokemon_species`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `money_transactions`
--
ALTER TABLE `money_transactions`
  ADD CONSTRAINT `money_transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pokedex`
--
ALTER TABLE `pokedex`
  ADD CONSTRAINT `pokedex_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pokedex_ibfk_2` FOREIGN KEY (`species_id`) REFERENCES `pokemon_species` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pokemon_box`
--
ALTER TABLE `pokemon_box`
  ADD CONSTRAINT `pokemon_box_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pokemon_box_ibfk_2` FOREIGN KEY (`species_id`) REFERENCES `pokemon_species` (`id`);

--
-- Filtros para la tabla `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `team_ibfk_2` FOREIGN KEY (`pokemon_box_id`) REFERENCES `pokemon_box` (`id`) ON DELETE SET NULL;

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `ev_clean_inventario` ON SCHEDULE EVERY 1 MINUTE STARTS '2025-12-03 13:28:31' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM inventario WHERE cantidad <= 0$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
