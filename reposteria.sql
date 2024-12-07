-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2024 a las 20:32:11
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
-- Base de datos: `reposteria`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_crear_pedido` (IN `_ID_usuario` INT, IN `_fecha_entrega` DATE, IN `_productos` JSON)   BEGIN
    DECLARE _id_pedido INT;
    DECLARE _idx INT DEFAULT 0;
    DECLARE _n INT DEFAULT JSON_LENGTH(_productos);

    -- Crear pedido
    INSERT INTO pedido (ID_cliente, fecha_entrega, fecha_creacion)
    VALUES (_ID_usuario, _fecha_entrega, NOW());

    -- Obtener el ID del último pedido insertado
    SET _id_pedido = LAST_INSERT_ID();

    -- Insertar detalles del pedido
    WHILE _idx < _n DO
        INSERT INTO detalle_pedido (ID_pedido, ID_producto, cantidad, ID_size, ID_sabor, ID_top, ID_relleno, ID_cubierta)
        VALUES (
            _id_pedido,
            JSON_UNQUOTE(JSON_EXTRACT(_productos, CONCAT('$[', _idx, '].ID_producto'))),
            JSON_UNQUOTE(JSON_EXTRACT(_productos, CONCAT('$[', _idx, '].cantidad'))),
            JSON_UNQUOTE(JSON_EXTRACT(_productos, CONCAT('$[', _idx, '].ID_size'))),
            JSON_UNQUOTE(JSON_EXTRACT(_productos, CONCAT('$[', _idx, '].ID_sabor'))),
            JSON_UNQUOTE(JSON_EXTRACT(_productos, CONCAT('$[', _idx, '].ID_top'))),
            JSON_UNQUOTE(JSON_EXTRACT(_productos, CONCAT('$[', _idx, '].ID_relleno'))),
            JSON_UNQUOTE(JSON_EXTRACT(_productos, CONCAT('$[', _idx, '].ID_cubierta')))
        );

        SET _idx = _idx + 1;
    END WHILE;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `ID_cliente` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cubierta`
--

CREATE TABLE `cubierta` (
  `ID_cubierta` int(11) NOT NULL,
  `nombre_c` varchar(100) DEFAULT NULL,
  `precio_cub` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cubierta`
--

INSERT INTO `cubierta` (`ID_cubierta`, `nombre_c`, `precio_cub`) VALUES
(1, 'Nutella', 55),
(2, 'Chocolate blanco', 64);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `ID_detalle` int(11) NOT NULL,
  `ID_pedido` int(11) DEFAULT NULL,
  `ID_producto` int(11) DEFAULT NULL,
  `ID_sabor` int(11) DEFAULT NULL,
  `ID_size` int(11) DEFAULT NULL,
  `ID_top` int(11) DEFAULT NULL,
  `ID_cubierta` int(11) DEFAULT NULL,
  `ID_relleno` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

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
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `ID_pedido` int(11) NOT NULL,
  `fecha_pedido` datetime DEFAULT NULL,
  `fecha_entrega` datetime DEFAULT NULL,
  `ID_usuario` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `ID_detalle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `tipo_producto` enum('pastel','galleta','pan','otro') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID`, `descripcion`, `tipo_producto`) VALUES
(1, 'Fresa con mermelada de fresa y cajeta.', 'pastel'),
(2, 'Chocolate y nuez', 'galleta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relleno`
--

CREATE TABLE `relleno` (
  `ID_relleno` int(11) NOT NULL,
  `nombre_r` varchar(100) DEFAULT NULL,
  `precio_relleno` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `relleno`
--

INSERT INTO `relleno` (`ID_relleno`, `nombre_r`, `precio_relleno`) VALUES
(1, 'Cajeta', 60),
(2, 'Nutella', 80);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sabor`
--

CREATE TABLE `sabor` (
  `ID_Sabor` int(11) NOT NULL,
  `nombre_s` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sabor`
--

INSERT INTO `sabor` (`ID_Sabor`, `nombre_s`) VALUES
(1, 'Vainilla'),
(2, 'Fresa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamano`
--

CREATE TABLE `tamano` (
  `ID_size` int(11) NOT NULL,
  `nombreT` varchar(100) DEFAULT NULL,
  `precio_size` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tamano`
--

INSERT INTO `tamano` (`ID_size`, `nombreT`, `precio_size`) VALUES
(1, 'Chico', 150),
(2, 'Mediano', 280),
(3, 'Grande', 400),
(4, 'Extragrande', 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topping`
--

CREATE TABLE `topping` (
  `ID_top` int(11) NOT NULL,
  `nombre_top` varchar(100) DEFAULT NULL,
  `precio_top` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `topping`
--

INSERT INTO `topping` (`ID_top`, `nombre_top`, `precio_top`) VALUES
(1, 'Chocolate triturado', 15),
(2, 'Azucar Glass', 6.5);

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `telefono` varchar(24) NOT NULL,
  `domicilio` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`, `telefono`, `domicilio`) VALUES
(1, 'Francisco', 'paco_0809@gmail.com', NULL, '$2y$12$8jqENZT7uByeHHS1bNLv3OduMIkgvz6uStgTXR0hnpw3BOTTncc9.', NULL, '2024-12-04 20:37:56', '2024-12-04 20:37:56', 0, '3122439309', 'Higuera de el Espinal, coloniaFalsa, #1556, 28984'),
(2, 'Cesar Alejandro', 'cavr_587@cavrbach.com', NULL, '$2y$12$dna8JrtztKvfPln6NE0cNOPKwrEBnteNyBaV9KnO7IPxC.O/UdSQu', NULL, '2024-12-07 19:29:26', '2024-12-07 19:29:26', 0, '3122211879', 'Roxburgh, falsa colonia, #189,28000');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID_cliente`);

--
-- Indices de la tabla `cubierta`
--
ALTER TABLE `cubierta`
  ADD PRIMARY KEY (`ID_cubierta`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`ID_detalle`),
  ADD KEY `ID_pedido` (`ID_pedido`),
  ADD KEY `ID_producto` (`ID_producto`),
  ADD KEY `ID_sabor` (`ID_sabor`),
  ADD KEY `ID_size` (`ID_size`),
  ADD KEY `ID_top` (`ID_top`),
  ADD KEY `ID_cubierta` (`ID_cubierta`),
  ADD KEY `ID_relleno` (`ID_relleno`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`ID_pedido`),
  ADD KEY `ID_cliente` (`ID_usuario`),
  ADD KEY `detallep_ibfk_01` (`ID_detalle`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `relleno`
--
ALTER TABLE `relleno`
  ADD PRIMARY KEY (`ID_relleno`);

--
-- Indices de la tabla `sabor`
--
ALTER TABLE `sabor`
  ADD PRIMARY KEY (`ID_Sabor`);

--
-- Indices de la tabla `tamano`
--
ALTER TABLE `tamano`
  ADD PRIMARY KEY (`ID_size`);

--
-- Indices de la tabla `topping`
--
ALTER TABLE `topping`
  ADD PRIMARY KEY (`ID_top`);

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
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cubierta`
--
ALTER TABLE `cubierta`
  MODIFY `ID_cubierta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `ID_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `ID_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `relleno`
--
ALTER TABLE `relleno`
  MODIFY `ID_relleno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sabor`
--
ALTER TABLE `sabor`
  MODIFY `ID_Sabor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tamano`
--
ALTER TABLE `tamano`
  MODIFY `ID_size` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `topping`
--
ALTER TABLE `topping`
  MODIFY `ID_top` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`ID_pedido`) REFERENCES `pedido` (`ID_pedido`),
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`ID_producto`) REFERENCES `producto` (`ID`),
  ADD CONSTRAINT `detalle_pedido_ibfk_3` FOREIGN KEY (`ID_sabor`) REFERENCES `sabor` (`ID_Sabor`),
  ADD CONSTRAINT `detalle_pedido_ibfk_4` FOREIGN KEY (`ID_size`) REFERENCES `tamano` (`ID_size`),
  ADD CONSTRAINT `detalle_pedido_ibfk_5` FOREIGN KEY (`ID_top`) REFERENCES `topping` (`ID_top`),
  ADD CONSTRAINT `detalle_pedido_ibfk_6` FOREIGN KEY (`ID_cubierta`) REFERENCES `cubierta` (`ID_cubierta`),
  ADD CONSTRAINT `detalle_pedido_ibfk_7` FOREIGN KEY (`ID_relleno`) REFERENCES `relleno` (`ID_relleno`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `detallep_ibfk_01` FOREIGN KEY (`ID_detalle`) REFERENCES `detalle_pedido` (`ID_detalle`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
