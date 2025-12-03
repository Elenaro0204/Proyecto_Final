-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2025 a las 18:30:18
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
-- Base de datos: `marvelpedia.sql`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('marvelpedia-cache-pelicula_tt10872600', 'a:25:{s:5:\"Title\";s:23:\"Spider-Man: No Way Home\";s:4:\"Year\";s:4:\"2021\";s:5:\"Rated\";s:5:\"PG-13\";s:8:\"Released\";s:11:\"17 Dec 2021\";s:7:\"Runtime\";s:7:\"148 min\";s:5:\"Genre\";s:26:\"Action, Adventure, Fantasy\";s:8:\"Director\";s:9:\"Jon Watts\";s:6:\"Writer\";s:37:\"Chris McKenna, Erik Sommers, Stan Lee\";s:6:\"Actors\";s:42:\"Tom Holland, Zendaya, Benedict Cumberbatch\";s:4:\"Plot\";s:151:\"With Spider-Man\'s identity now revealed, Peter asks Doctor Strange for help. When a spell goes wrong, dangerous foes from other worlds start to appear.\";s:8:\"Language\";s:16:\"English, Tagalog\";s:7:\"Country\";s:13:\"United States\";s:6:\"Awards\";s:53:\"Nominated for 1 Oscar. 35 wins & 71 nominations total\";s:6:\"Poster\";s:114:\"https://m.media-amazon.com/images/M/MV5BMmFiZGZjMmEtMTA0Ni00MzA2LTljMTYtZGI2MGJmZWYzZTQ2XkEyXkFqcGc@._V1_SX300.jpg\";s:7:\"Ratings\";a:3:{i:0;a:2:{s:6:\"Source\";s:23:\"Internet Movie Database\";s:5:\"Value\";s:6:\"8.2/10\";}i:1;a:2:{s:6:\"Source\";s:15:\"Rotten Tomatoes\";s:5:\"Value\";s:3:\"93%\";}i:2;a:2:{s:6:\"Source\";s:10:\"Metacritic\";s:5:\"Value\";s:6:\"71/100\";}}s:9:\"Metascore\";s:2:\"71\";s:10:\"imdbRating\";s:3:\"8.2\";s:9:\"imdbVotes\";s:7:\"987,207\";s:6:\"imdbID\";s:10:\"tt10872600\";s:4:\"Type\";s:5:\"movie\";s:3:\"DVD\";s:3:\"N/A\";s:9:\"BoxOffice\";s:12:\"$814,866,759\";s:10:\"Production\";s:3:\"N/A\";s:7:\"Website\";s:3:\"N/A\";s:8:\"Response\";s:4:\"True\";}', 1764026940);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foros`
--

CREATE TABLE `foros` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` enum('abierto','cerrado') NOT NULL DEFAULT 'abierto',
  `num_mensajes` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ultima_actividad` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color_fondo` varchar(255) DEFAULT NULL,
  `color_titulo` varchar(255) DEFAULT NULL,
  `imagen_portada` varchar(255) DEFAULT NULL,
  `visibilidad` enum('publico','privado') NOT NULL DEFAULT 'publico'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `foros`
--

INSERT INTO `foros` (`id`, `user_id`, `categoria`, `titulo`, `descripcion`, `estado`, `num_mensajes`, `ultima_actividad`, `created_at`, `updated_at`, `color_fondo`, `color_titulo`, `imagen_portada`, `visibilidad`) VALUES
(1, 1, NULL, 'Prueba de foro 2', 'prueba de foro nuevo', 'abierto', 0, NULL, '2025-11-22 17:55:41', '2025-11-23 18:11:08', 'linear-gradient(to right, #6366f1, #8b5cf6)', '#ffffff', NULL, 'privado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_reports`
--

CREATE TABLE `foro_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foro_id` bigint(20) UNSIGNED NOT NULL,
  `reported_by` bigint(20) UNSIGNED NOT NULL,
  `resolved` tinyint(1) NOT NULL DEFAULT 0,
  `deadline` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foro_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `contenido` text NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editado` tinyint(1) NOT NULL DEFAULT 0,
  `editado_en` timestamp NULL DEFAULT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `foro_id`, `user_id`, `contenido`, `parent_id`, `editado`, `editado_en`, `eliminado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'prueba de un nuevo mensaje de foro', NULL, 0, NULL, 0, '2025-11-22 17:56:05', '2025-11-22 17:56:05'),
(2, 1, 1, 'prueba de modificacion de respuesta', 1, 0, NULL, 0, '2025-11-22 17:59:20', '2025-11-23 17:59:16'),
(3, 1, 1, 'prueba 2', NULL, 0, NULL, 0, '2025-11-23 16:56:04', '2025-11-23 16:56:04'),
(4, 1, 1, 'prueba respuesta 2', NULL, 0, NULL, 0, '2025-11-23 17:46:49', '2025-11-23 17:46:49'),
(5, 1, 1, 'prueba a respuesta de respuesta', NULL, 0, NULL, 0, '2025-11-23 17:51:27', '2025-11-23 17:51:27'),
(6, 1, 1, 'prueba de respuesta 3', 1, 0, NULL, 0, '2025-11-23 17:56:33', '2025-11-23 17:56:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje_reports`
--

CREATE TABLE `mensaje_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mensaje_id` bigint(20) UNSIGNED NOT NULL,
  `reported_by` bigint(20) UNSIGNED NOT NULL,
  `resolved` tinyint(1) NOT NULL DEFAULT 0,
  `deadline` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `mensaje_reports`
--

INSERT INTO `mensaje_reports` (`id`, `mensaje_id`, `reported_by`, `resolved`, `deadline`, `created_at`, `updated_at`) VALUES
(5, 2, 1, 0, '2025-11-29 23:00:00', '2025-11-23 12:19:30', '2025-11-23 12:19:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_12_121422_add_profile_fields_to_users_table', 1),
(6, '2025_10_18_113705_add_role_to_users_table', 2),
(16, '2025_11_13_191115_add_reported_by_to_review_reports_table', 4),
(27, '2025_10_18_130711_create_settings_table', 5),
(28, '2025_11_02_171101_create_reviews_table', 5),
(29, '2025_11_12_192646_create_review_reports_table', 5),
(30, '2025_11_22_173146_create_foros_table', 5),
(31, '2025_11_22_173822_create_mensajes_table', 5),
(32, '2025_11_22_204717_add_reported_by_to_foro_reports_table', 6),
(33, '2025_11_23_103706_create_mensaje_reports_table', 7),
(34, '2025_11_23_180843_add_customization_to_foros_table', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `entity_id` varchar(255) NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL COMMENT 'De 1 a 5',
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `type`, `entity_id`, `rating`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 'pelicula', 'tt10872600', 3, 'prueba de reseña', '2025-11-23 09:31:06', '2025-11-23 09:31:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `review_reports`
--

CREATE TABLE `review_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `review_id` bigint(20) UNSIGNED NOT NULL,
  `reported_by` bigint(20) UNSIGNED DEFAULT NULL,
  `resolved` tinyint(1) NOT NULL DEFAULT 0,
  `deadline` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('dBvb64YRDcIGVsBTpxAdvaQ5VIEAFaEocdOWoYCh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQlZiZ3FwOUpIeE5STkpJVzFQelRlbXcxTFVtVDRRVmZUWUd0Z3BsVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764005340),
('uyX7JLUwCmHwXQRzp5yRosVmioeUEF5x6BRM2GQj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaUcxMEFYdk1QaWJKQlVPWUF6RkNIbWNsa1F0anJaUzFDSEFFUUNWMiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1763927250);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `avatar_url` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `favorito_personaje` varchar(255) DEFAULT NULL,
  `favorito_comic` varchar(255) DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `banner_url` varchar(255) DEFAULT NULL,
  `theme` varchar(255) NOT NULL DEFAULT 'default',
  `nivel` int(11) NOT NULL DEFAULT 1,
  `puntos` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `avatar_url`, `nickname`, `favorito_personaje`, `favorito_comic`, `pais`, `fecha_nacimiento`, `banner_url`, `theme`, `nivel`, `puntos`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Admin', 'elenaro2004@hotmail.com', '2025-10-26 16:38:48', '$2y$12$jr4bJqhKkhWlKR4ljdemLuXSxpbENztfKCFc1aD.FS8FUYH8L2AbG', NULL, 'admin', NULL, NULL, 'España', '2025-10-18', NULL, 'default', 1, 0, NULL, '2025-10-18 08:45:06', '2025-10-26 16:38:48', 'admin'),
(4, 'Elena', 'elena.rengel-olivares@iesruizgijon.com', '2025-11-02 11:51:03', '$2y$12$uBNC63FyJHMIBbfPFnksiO77t4vjXGokLXcoFSeMwvW2uN9nWaeGK', '/storage/avatars/zriMvWU9x2f01wPbr01vbMOX2k12vygALg2BjaU7.jpg', 'elenaro0204', NULL, NULL, 'España', '2004-04-02', NULL, 'default', 1, 0, NULL, '2025-10-18 08:50:31', '2025-11-02 11:51:03', 'user'),
(8, 'Relly', 'johnrelly@hotmail.com', '2025-11-12 18:54:41', '$2y$12$bUjmbtz.GxpidrN3I5PEFu2uowULVidnVBLPJGf8pF0PvchvJGiES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default', 1, 0, NULL, '2025-11-12 18:51:25', '2025-11-12 18:54:41', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `foros`
--
ALTER TABLE `foros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foros_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `foro_reports`
--
ALTER TABLE `foro_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foro_reports_foro_id_foreign` (`foro_id`),
  ADD KEY `foro_reports_reported_by_foreign` (`reported_by`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mensajes_foro_id_foreign` (`foro_id`),
  ADD KEY `mensajes_user_id_foreign` (`user_id`),
  ADD KEY `mensajes_parent_id_foreign` (`parent_id`);

--
-- Indices de la tabla `mensaje_reports`
--
ALTER TABLE `mensaje_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mensaje_reports_mensaje_id_foreign` (`mensaje_id`),
  ADD KEY `mensaje_reports_reported_by_foreign` (`reported_by`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `review_reports`
--
ALTER TABLE `review_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_reports_review_id_foreign` (`review_id`),
  ADD KEY `review_reports_reported_by_foreign` (`reported_by`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foros`
--
ALTER TABLE `foros`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `foro_reports`
--
ALTER TABLE `foro_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `mensaje_reports`
--
ALTER TABLE `mensaje_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `review_reports`
--
ALTER TABLE `review_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `foros`
--
ALTER TABLE `foros`
  ADD CONSTRAINT `foros_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `foro_reports`
--
ALTER TABLE `foro_reports`
  ADD CONSTRAINT `foro_reports_foro_id_foreign` FOREIGN KEY (`foro_id`) REFERENCES `foros` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foro_reports_reported_by_foreign` FOREIGN KEY (`reported_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_foro_id_foreign` FOREIGN KEY (`foro_id`) REFERENCES `foros` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mensajes_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `mensajes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mensajes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `mensaje_reports`
--
ALTER TABLE `mensaje_reports`
  ADD CONSTRAINT `mensaje_reports_mensaje_id_foreign` FOREIGN KEY (`mensaje_id`) REFERENCES `mensajes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mensaje_reports_reported_by_foreign` FOREIGN KEY (`reported_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `review_reports`
--
ALTER TABLE `review_reports`
  ADD CONSTRAINT `review_reports_reported_by_foreign` FOREIGN KEY (`reported_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_reports_review_id_foreign` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
