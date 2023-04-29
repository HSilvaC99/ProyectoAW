-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-04-2023 a las 17:53:05
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `zeus_airsoft`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `street` varchar(1000) NOT NULL,
  `floor` varchar(1000) NOT NULL,
  `zip` int(11) NOT NULL,
  `city` varchar(1000) NOT NULL,
  `province` varchar(1000) NOT NULL,
  `country` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `addresses`
--

INSERT INTO `addresses` (`id`, `street`, `floor`, `zip`, `city`, `province`, `country`) VALUES
(1, 'Calle Velez 34', '2º izq', 28006, 'Madrid', 'Madrid', 'España'),
(2, 'Calle Jesus', '12', 245738, 'Madrid', 'Madrid', 'España');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL,
  `number` int(16) NOT NULL,
  `expirate` varchar(5) NOT NULL,
  `cvv` int(3) NOT NULL,
  `name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `date`) VALUES
(12, 'Asalto al fortificado', 'Esta es la descripción del evento. Debe contener un texto medianamente largo que describe en profundidad las actividades que se realizarán a lo largo del evento para informar a los participantes.', '2023-04-15'),
(13, 'Numero de pedidos', 'asdfasdfasd', '0001-01-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events_users`
--

CREATE TABLE `events_users` (
  `eventID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `eventRoleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `events_users`
--

INSERT INTO `events_users` (`eventID`, `userID`, `eventRoleID`) VALUES
(12, 6, 3),
(12, 12, 1),
(12, 6, 3),
(12, 12, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `event_roles`
--

CREATE TABLE `event_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `maximum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `event_roles`
--

INSERT INTO `event_roles` (`id`, `name`, `maximum`) VALUES
(1, 'Fusilero', 45),
(2, 'Tirador selecto', 4),
(3, 'Apoyo', 4),
(4, 'Francotirador', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `state` varchar(1000) NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `paymentMethod` varchar(1000) NOT NULL,
  `address` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `state`, `date`, `amount`, `quantity`, `paymentMethod`, `address`) VALUES
(64, 'en proceso', '2023-04-28', 668.11, 1, 'Tarjeta Credito', ''),
(65, 'pendiente', '2023-04-28', 668.11, 1, 'Transferencia Bancaria', ''),
(66, 'en proceso', '2023-04-28', 668.11, 1, 'Tarjeta Credito', ''),
(67, 'pendiente', '2023-04-28', 668.11, 0, 'Transferencia Bancaria', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`) VALUES
(1, 'Tarjeta de crédito'),
(2, 'Bizum'),
(3, 'Transferencia bancaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `imgName` varchar(256) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `offer` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `imgName`, `price`, `offer`) VALUES
(1, 'Colt M4A1 5.56x45', 'La carabina Colt M4A1 es una variante completamente automática de la carabina M4 básica y fue diseñada principalmente para uso en operaciones especiales. Sin embargo, EE. UU. El Comando de Operaciones Especiales ( USSOCOM ) pronto adoptará el M4A1 para casi todas las unidades de operaciones especiales, seguido más tarde por la introducción general del M4A1 en servicio con los EE. UU. Ejército y Cuerpo de Marines.', 'm4a1.jpg', 668.11, 0),
(2, 'Kalashnikov AK-74 5.45x39', 'El rifle de asalto Kalashnikov de 5,45 mm, desarrollado en 1970 por M. T. Kalashnikov, se convirtió en una nueva evolución de AKM debido a la adopción de la nueva munición 5,45x39 por parte de los militares.', 'ak74.png', 375.90, 0),
(3, 'DSR-1 AMP de Ares', 'Es un auténtico modelo de coleccionista, salieron muy pocas unidades y es muy difícil conseguir uno, en ZEUS AirSoft tenemos uno y además nuevo. No deje escapar ésta oportunidad de hacerte con esta fiel copia del fusil de francotirador usado por el GEO de la Policía Nacional española, cualquier amante de éste gran grupo especial desearía tener algo así.', '91BWA.jpg', 799.90, 0),
(5, 'M60 LCT ACERO', 'M60 VN\r\n· Cuerpo: Acero estampado\r\n· Longitud total: 1100mm\r\n· Peso: 10kg\r\n· Rodamientos: Rodamientos de 8mm\r\n· Motor: 22000rpm\r\n· Cañón interno: Latón 6.02 ± 0.01mm / 610mm\r\n· Cámara Hop Up: Aluminio CNC\r\n· Cargador: 3500 bolas\r\n· Velocidad: 100m/s\r\n· Blowback: No\r\n· Cableado: 18AWG\r\n· Cilindro: Latón cromado\r\n· Cabeza de cilindro: Aluminio CNC\r\n· Cabeza de pistón: Aluminio CNC\r\n· MOSFET: No\r\n· Guía de muelle: Acero con rodamientos', 'ametralladoraDef.jpg', 562.49, 0),
(6, 'PISTOLA BLASTER-DL44 HAN SOLO', 'Recreación de la pistola BLASTER-DL44, o heavy blaster pistol usada por Han Solo en la saga de películas STAR WARS.\r\nUna fiel representación además de ser completamente funcional. Su cargador alimentado por gas puede contener hasta 10bb\'s + 1 en la recamara, con funcionamiento en semiautomático y automático, descarga sus 10 bb\'s a una velocidad alarmante con su increíble y seco blowback, con una potencia de salida ideal para el juego.', 'pistola.jpg', 340.12, 0),
(7, 'ESCOPETA M870 Breacher de Tokyo Marui', 'Tokyo Marui M870 Breacher (Gas Powered Shotgun)\r\n-- Escala 1/1 \r\n-- Calidad de fabricación superior y acabado perfecto de Tokyo Marui.\r\n-- Cuerpo y cañón de metal\r\n-- Guardamanos y empuñadura con las misma dimensiones que el real\r\n-- Raíl superior de 20mm\r\n-- 3 Cañones internos\r\n-- Imitación de cartucho que puede almacenar hasta 30bbs\r\n-- Cada disparo puede proyectar 3 o 6 bolas\r\n-- El modo de \"fuego rápido\" te permite disparar una y otra vez manteniendo el gatillo apretado y amartillando\r\n-- Almacenamiento de cartuchos en compartimento del guardamanos.\r\n-- Contenedor de gas ubicado en la empuñadura.\r\n-- Puede disparar unas 50 veces con una sola carga de gas cuando se encuentra en modo 3 disparos (depende la temperatura ambiente).\r\n \r\nHemos inventado este novedoso sistema en el que puedes elegir disparar 3 o 6 bolas al mismo tiempo. La nueva M870 tiene 3 cañones internos, cada uno equipado con su respectivo Hop-up. Cada cartucho tiene capacidad para 30bbs. La escopeta solo puede tener en uso un cartucho al mismo tiempo. La M870 Breacher es la versión corta de la M870 con una empuñadura y un guardamanos diferente. No lleva culata y por lo tanto el contenedor del gas va ubicado en la empuñadura y es totalmente diferente.', 'escopeta.jpg', 314.99, 0),
(8, 'Subfusil MP7 GBB', 'Características:\r\n* Mira trasera ajustable\r\n* Hop-Up ajustable\r\n* Cargador largo\r\n* Guardamanos RIS\r\n* Culata de 4 posiciones\r\n* Gas Blow Back\r\n \r\nEspecificaciones:\r\n* Tipo: GBB\r\n* Construcción: Metal y Nylon\r\n* Capacidad del cargador: 40bbs\r\n* Longitud: 380-590 mm\r\n* Longitud del cañón: 165 mm\r\n* Peso: 2.1 kg\r\n* Velocidad de salida: 360-380 FPS\r\n* Hop-Up: Sí, ajustable\r\n* Alimentación recomendada: Gas de Invierno\r\n\r\nEste modelo de la MP7 que fabrica es una brutalidad, el disparo es excepcional, la textura y el feeling, inigualables, si quieres hacerte con una primaria para CQB, éste es tú modelo sin lugar a dudas.', 'subfusil.jpg', 395.00, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products_categories`
--

CREATE TABLE `products_categories` (
  `productID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_user_reviews`
--

CREATE TABLE `product_user_reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `product_user_reviews`
--

INSERT INTO `product_user_reviews` (`review_id`, `product_id`, `user_id`) VALUES
(46, 1, 13),
(47, 1, 13),
(49, 1, 12),
(50, 3, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `creationDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questions_answers`
--

CREATE TABLE `questions_answers` (
  `questionID` int(11) NOT NULL,
  `answerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `review` int(1) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reviews`
--

INSERT INTO `reviews` (`id`, `comment`, `review`, `date`) VALUES
(46, 'Sin comentario', 5, '2023-04-10 14:16:12'),
(47, 'hola xd', 5, '2023-04-13 20:17:44'),
(49, 'prueba', 5, '2023-04-17 17:29:15'),
(50, 'prueba', 3, '2023-04-17 17:29:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `roleName` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `roleName`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'guest');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `states`
--

INSERT INTO `states` (`id`, `name`) VALUES
(1, 'Pendiente'),
(2, 'En proceso'),
(3, 'Enviado'),
(4, 'Entregado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `email` varchar(320) NOT NULL,
  `passwordHash` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `passwordHash`) VALUES
(6, 'Alexander', 'López Vega', 'alex.lopez.ve@gmail.com', '$2y$10$bOVt7M3p2mQtvQTkStsNj.x3Rw9rKmvvHrqTt.RF7z46bJONYM2AG'),
(12, 'Hugo', 'Silva', 'hsilva@ucm.es', '$2y$10$J.hO7gzo7cEjUbkH4oy6nuBV80raqlHCo6h41t2vt5vqwwwXFm8Qy'),
(13, 'Dragos Ionut', 'Camarasan', 'dragosca@ucm.es', '$2y$10$e4IOMlAGUKEI7CBH1AxDfuK8lbd1A62F6bQ7oxUtt5k/rva14EVL.'),
(15, 'June', 'Zuazo', '1234@ucm.es', '$2y$10$mIW8YlcHRGZRufAsQ47jpOCTbMtMVx.hNu6Sek3vDBki9TC5rX17a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_addresses`
--

CREATE TABLE `users_addresses` (
  `userID` int(11) NOT NULL,
  `addressID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_addresses`
--

INSERT INTO `users_addresses` (`userID`, `addressID`) VALUES
(15, 2),
(15, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_answers`
--

CREATE TABLE `users_answers` (
  `userID` int(11) NOT NULL,
  `answerID` int(11) NOT NULL,
  `questionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_orders`
--

CREATE TABLE `users_orders` (
  `userID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_orders`
--

INSERT INTO `users_orders` (`userID`, `orderID`) VALUES
(15, 64),
(15, 65),
(15, 66),
(15, 67);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_products`
--

CREATE TABLE `users_products` (
  `userID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_questions`
--

CREATE TABLE `users_questions` (
  `userID` int(11) NOT NULL,
  `questionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_roles`
--

CREATE TABLE `users_roles` (
  `userID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_roles`
--

INSERT INTO `users_roles` (`userID`, `roleID`) VALUES
(6, 1),
(12, 1),
(13, 1),
(15, 1),
(6, 2),
(12, 2),
(13, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `events_users`
--
ALTER TABLE `events_users`
  ADD KEY `eventID` (`eventID`),
  ADD KEY `eventRoleID` (`eventRoleID`),
  ADD KEY `userID` (`userID`);

--
-- Indices de la tabla `event_roles`
--
ALTER TABLE `event_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products_categories`
--
ALTER TABLE `products_categories`
  ADD PRIMARY KEY (`productID`,`categoryID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indices de la tabla `product_user_reviews`
--
ALTER TABLE `product_user_reviews`
  ADD PRIMARY KEY (`review_id`,`product_id`,`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `questions_answers`
--
ALTER TABLE `questions_answers`
  ADD PRIMARY KEY (`questionID`,`answerID`),
  ADD KEY `questionID` (`questionID`,`answerID`),
  ADD KEY `answerID` (`answerID`);

--
-- Indices de la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users_addresses`
--
ALTER TABLE `users_addresses`
  ADD KEY `userID` (`userID`),
  ADD KEY `addressID` (`addressID`);

--
-- Indices de la tabla `users_answers`
--
ALTER TABLE `users_answers`
  ADD PRIMARY KEY (`userID`,`answerID`,`questionID`),
  ADD KEY `questionID` (`questionID`),
  ADD KEY `answerID` (`answerID`),
  ADD KEY `userID` (`userID`,`answerID`,`questionID`);

--
-- Indices de la tabla `users_orders`
--
ALTER TABLE `users_orders`
  ADD KEY `userID` (`userID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indices de la tabla `users_products`
--
ALTER TABLE `users_products`
  ADD PRIMARY KEY (`userID`,`productID`),
  ADD KEY `productID` (`productID`);

--
-- Indices de la tabla `users_questions`
--
ALTER TABLE `users_questions`
  ADD PRIMARY KEY (`userID`,`questionID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `questionID` (`questionID`);

--
-- Indices de la tabla `users_roles`
--
ALTER TABLE `users_roles`
  ADD PRIMARY KEY (`roleID`,`userID`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `card`
--
ALTER TABLE `card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT de la tabla `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `events_users`
--
ALTER TABLE `events_users`
  ADD CONSTRAINT `events_users_ibfk_1` FOREIGN KEY (`eventID`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `events_users_ibfk_2` FOREIGN KEY (`eventRoleID`) REFERENCES `event_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `events_users_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `products_categories`
--
ALTER TABLE `products_categories`
  ADD CONSTRAINT `products_categories_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_categories_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `product_user_reviews`
--
ALTER TABLE `product_user_reviews`
  ADD CONSTRAINT `product_user_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_user_reviews_ibfk_2` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_user_reviews_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `questions_answers`
--
ALTER TABLE `questions_answers`
  ADD CONSTRAINT `questions_answers_ibfk_1` FOREIGN KEY (`answerID`) REFERENCES `answers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questions_answers_ibfk_2` FOREIGN KEY (`questionID`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users_addresses`
--
ALTER TABLE `users_addresses`
  ADD CONSTRAINT `users_addresses_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_addresses_ibfk_2` FOREIGN KEY (`addressID`) REFERENCES `addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users_answers`
--
ALTER TABLE `users_answers`
  ADD CONSTRAINT `users_answers_ibfk_1` FOREIGN KEY (`answerID`) REFERENCES `answers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_answers_ibfk_2` FOREIGN KEY (`questionID`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_answers_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users_orders`
--
ALTER TABLE `users_orders`
  ADD CONSTRAINT `users_orders_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_orders_ibfk_2` FOREIGN KEY (`orderID`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users_products`
--
ALTER TABLE `users_products`
  ADD CONSTRAINT `users_products_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_products_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users_questions`
--
ALTER TABLE `users_questions`
  ADD CONSTRAINT `users_questions_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_questions_ibfk_2` FOREIGN KEY (`questionID`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users_roles`
--
ALTER TABLE `users_roles`
  ADD CONSTRAINT `users_roles_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_roles_ibfk_2` FOREIGN KEY (`roleID`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
