-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-03-2023 a las 21:19:10
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

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
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`name`, `surname`, `mail`, `img_path`, `description`) VALUES
('Alexander', 'López Vega', 'alexanlo@ucm.es', 'static/img/miembros/alex.jpg', 'Description goes here'),
('Dragos', 'Ionut Camarasán', 'dragosca@ucm.es', 'static/img/miembros/dragos.jpg', 'Description goes here'),
('Hugo', 'Silva Cacabelos', 'hsilva@ucm.es', 'static/img/miembros/hugo.jpg', 'Description goes here'),
('June', 'Zuazo Berasategi', 'jzuazo@ucm.es', 'static/img/miembros/june.jpg', 'Description goes here'),
('Paula', 'Garcia Pinilla', 'paugar22@ucm.es', 'static/img/miembros/paula.jpg', 'Description goes here'),
('Vicente', 'Garrido Juárez', 'viceng01@ucm.es', 'static/img/miembros/vicente.jpg', 'Description goes here');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 
-- Volcado de datos para la tabla `products` 
-- 
 
INSERT INTO `products` (`id`, `img_name`, `title`, `description`, `category`) VALUES 
(1, 'm4a1.jpg', 'Colt M4A1 5.56x45', 'La carabina Colt M4A1 es una variante completamente automática de la carabina M4 básica y fue diseñada principalmente para uso en operaciones especiales. Sin embargo, EE. UU. El Comando de Operaciones Especiales ( USSOCOM ) pronto adoptará el M4A1 para casi todas las unidades de operaciones especiales, seguido más tarde por la introducción general del M4A1 en servicio con los EE. UU. Ejército y Cuerpo de Marines.', 'Rifles de asalto'), 
(2, 'ak74.png', 'Kalashnikov AK-74 5.45x39', 'El rifle de asalto Kalashnikov de 5,45 mm, desarrollado en 1970 por M. T. Kalashnikov, se convirtió en una nueva evolución de AKM debido a la adopción de la nueva munición 5,45x39 por parte de los militares.', 'Rifles de asalto'), 
(3, '91BWA.jpg', 'DSR-1 AMP de Ares', 'Es un auténtico modelo de coleccionista, salieron muy pocas unidades y es muy difícil conseguir uno, en ZEUS AirSoft tenemos uno y además nuevo. No deje escapar ésta oportunidad de hacerte con esta fiel copia del fusil de francotirador usado por el GEO de la Policía Nacional española, cualquier amante de éste gran grupo especial desearía tener algo así.', 'Francotirador'), 
(4, 'chaleco.jpg', 'CHALECO 6094 ECO NEGRO', 'Chaleco 6094 fabricado en nylon\r\n-Ancho 29 cm/11.4\", altura 40 cm/15.7\"\r\n       1 bolsa utily: 23x15x11 cm\r\n       1 pouch de radio : 20x6x7 cm\r\n       3 pouch M4: 8x22x7 cm\r\n\r\n-Correas del hombro ajustables \r\n-Molle para la fijación de más bolsas u otros artículos\r\n-Material de nylon 600D.', 'Chaleco'), 
(5, 'ametralladoraDef.jpg', 'M60 \"Vietnam\" de LCT ACERO', 'M60 VN\r\n· Cuerpo: Acero estampado\r\n· Longitud total: 1100mm\r\n· Peso: 10kg\r\n· Rodamientos: Rodamientos de 8mm\r\n· Motor: 22000rpm\r\n· Cañón interno: Latón 6.02 ± 0.01mm / 610mm\r\n· Cámara Hop Up: Aluminio CNC\r\n· Cargador: 3500 bolas\r\n· Velocidad: 100m/s\r\n· Blowback: No\r\n· Cableado: 18AWG\r\n· Cilindro: Latón cromado\r\n· Cabeza de cilindro: Aluminio CNC\r\n· Cabeza de pistón: Aluminio CNC\r\n· MOSFET: No\r\n· Guía de muelle: Acero con rodamientos', 'Ametralladora'), 
(6, 'pistola.jpg', 'PISTOLA BLASTER-DL44 HAN SOLO', 'Recreación de la pistola BLASTER-DL44, o heavy blaster pistol usada por Han Solo en la saga de películas STAR WARS.\r\nUna fiel representación además de ser completamente funcional. Su cargador alimentado por gas puede contener hasta 10bb\'s + 1 en la recamara, con funcionamiento en semiautomático y automático, descarga sus 10 bb\'s a una velocidad alarmante con su increíble y seco blowback, con una potencia de salida ideal para el juego.', 'Pistola'), 
(7, 'escopeta.jpg', 'ESCOPETA M870 Breacher de Tokyo Marui', 'Tokyo Marui M870 Breacher (Gas Powered Shotgun)\r\n-- Escala 1/1 \r\n-- Calidad de fabricación superior y acabado perfecto de Tokyo Marui.\r\n-- Cuerpo y cañón de metal\r\n-- Guardamanos y empuñadura con las misma dimensiones que el real\r\n-- Raíl superior de 20mm\r\n-- 3 Cañones internos\r\n-- Imitación de cartucho que puede almacenar hasta 30bbs\r\n-- Cada disparo puede proyectar 3 o 6 bolas\r\n-- El modo de \"fuego rápido\" te permite disparar una y otra vez manteniendo el gatillo apretado y amartillando\r\n-- Almacenamiento de cartuchos en compartimento del guardamanos.\r\n-- Contenedor de gas ubicado en la empuñadura.\r\n-- Puede disparar unas 50 veces con una sola carga de gas cuando se encuentra en modo 3 disparos (depende la temperatura ambiente).\r\n \r\nHemos inventado este novedoso sistema en el que puedes elegir disparar 3 o 6 bolas al mismo tiempo. La nueva M870 tiene 3 cañones internos, cada uno equipado con su respectivo Hop-up. Cada cartucho tiene capacidad para 30bbs. La escopeta solo puede tener en uso un cartucho al mismo tiempo. La M870 Breacher es la versión corta de la M870 con una empuñadura y un guardamanos diferente. No lleva culata y por lo tanto el contenedor del gas va ubicado en la empuñadura y es totalmente diferente.', 'Escopeta'), 
(8, 'subfusil.jpg', 'Subfusil MP7 GBB', 'Características:\r\n* Mira trasera ajustable\r\n* Hop-Up ajustable\r\n* Cargador largo\r\n* Guardamanos RIS\r\n* Culata de 4 posiciones\r\n* Gas Blow Back\r\n \r\nEspecificaciones:\r\n* Tipo: GBB\r\n* Construcción: Metal y Nylon\r\n* Capacidad del cargador: 40bbs\r\n* Longitud: 380-590 mm\r\n* Longitud del cañón: 165 mm\r\n* Peso: 2.1 kg\r\n* Velocidad de salida: 360-380 FPS\r\n* Hop-Up: Sí, ajustable\r\n* Alimentación recomendada: Gas de Invierno\r\n\r\nEste modelo de la MP7 que fabrica es una brutalidad, el disparo es excepcional, la textura y el feeling, inigualables, si quieres hacerte con una primaria para CQB, éste es tú modelo sin lugar a dudas.', 'Subfusil'); 

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `states`
--

CREATE TABLE `states` (
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `states`
--

INSERT INTO `states` (`name`) VALUES
('Andalucía'),
('Aragón'),
('Asturias'),
('Baleares'),
('Canarias'),
('Cantabria'),
('Castilla y León'),
('Castilla-La Mancha'),
('Cataluña'),
('Ceuta'),
('Extremadura'),
('Galicia'),
('La Rioja'),
('Madrid'),
('Melilla'),
('Murcia'),
('Navarra'),
('País Vasco'),
('Valencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `state` varchar(50) NOT NULL,
  `zip` int(11) NOT NULL,
  `surname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`mail`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`mail`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_preguntas`
--

CREATE TABLE `foro_preguntas` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(500) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_respuestas`
--

CREATE TABLE `foro_respuestas` (
  `id` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `respuesta` varchar(500) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Indices de la tabla `foro_preguntas`
--
ALTER TABLE `foro_preguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `foro_respuestas`
--
ALTER TABLE `foro_respuestas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_foreign` (`id_pregunta`);


ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `states`
  ADD PRIMARY KEY (`name`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`mail`);

ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

-- 
-- AUTO_INCREMENT de las tablas volcadas 
-- 

-- 
-- AUTO_INCREMENT de la tabla `foro_preguntas` 
-- 
ALTER TABLE `foro_preguntas` 
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT; 

-- 
-- AUTO_INCREMENT de la tabla `foro_respuestas` 
-- 
ALTER TABLE `foro_respuestas` 
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT; 

-- 
-- Restricciones para tablas volcadas 
-- 

-- 
-- Filtros para la tabla `foro_respuestas` 
-- 
ALTER TABLE `foro_respuestas` 
  ADD CONSTRAINT `id_foreign` FOREIGN KEY (`id_pregunta`) REFERENCES `foro_preguntas` (`id`); 
-- 
-- Table structure for table `eventos` 
-- 

CREATE TABLE `eventos` ( 
  `id` int(11) NOT NULL, 
  `nombre` varchar(64) NOT NULL, 
  `descripcion` varchar(512) NOT NULL, 
  `fecha` date NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci; 

-- 
-- Dumping data for table `eventos` 
-- 

INSERT INTO `eventos` (`id`, `nombre`, `descripcion`, `fecha`) VALUES 
(1, 'Asalto al fortificado', 'Los reclutas se dividirán en dos equipos: un equipo ofensor y otro equipo defensor. El equipo defensor montará posiciones de defensa alrededor de un punto de interés, defendiendo una bandera. El equipo ofensor deberá obtener la bandera.', '2023-04-01'), 
(2, 'Combate a muerte por equipos', 'Dos equipos. Cada eliminación vale 1 punto. Cuando se acabe la ronda por tiempo, gana el equipo con mayor puntuación. Si todo el equipo está eliminado, se añade 5 puntos. 10 rondas en total.', '2023-04-02'); 

-- 
-- Indexes for dumped tables 
-- 

-- 
-- Indexes for table `eventos` 
-- 
ALTER TABLE `eventos` 
  ADD PRIMARY KEY (`id`); 
COMMIT; 

-- -------------------------------------------------------- 

-- 
-- Table structure for table `events_users` 
-- 

CREATE TABLE `events_users` ( 
  `event_id` int(11) NOT NULL, 
  `user` varchar(255) NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci; 

-- 
-- Dumping data for table `events_users` 
-- 

INSERT INTO `events_users` (`event_id`, `user`) VALUES 
(1, 'vicenteesunputo@gmail.com'), 
(2, 'alex.lopez.ve@gmail.com'), 
(2, 'vicenteesunputo@gmail.com'); 

-- 
-- Indexes for dumped tables 
-- 

-- 
-- Indexes for table `events_users` 
-- 
ALTER TABLE `events_users` 
  ADD PRIMARY KEY (`event_id`,`user`), 
  ADD KEY `user` (`user`); 

-- 
-- Constraints for dumped tables 
-- 

-- 
-- Constraints for table `events_users` 
-- 
ALTER TABLE `events_users` 
  ADD CONSTRAINT `events_users_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `eventos` (`id`), 
  ADD CONSTRAINT `events_users_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`mail`); 
COMMIT; 

-- 
-- Table structure for table `ofertas` 
-- 

CREATE TABLE `ofertas` ( 
  `id` int(11) NOT NULL, 
  `nombre` varchar(64) NOT NULL, 
  `descripcion` varchar(512) NOT NULL, 
  `codigo` varchar(64) NOT NULL, 
  `fecha` date NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci; 

-- 
-- Dumping data for table `ofertas` 
-- 

INSERT INTO `ofertas` (`id`, `nombre`, `descripcion`, `codigo`, `fecha`) VALUES 
(1, '2X1 en munición', 'Descuento del 50% en la primera compra de munición en nuestra tienda online.', 'OFTMUN23', '2023-04-01'), 
(2, 'Equipamiento gratis', 'Con la primera compra superior a 10€ en nuestra tienda te regalamos equipamiento valorado en más de 20€ gratis', 'OFTEQP23','2024-01-01'); 
-- 
-- Indexes for dumped tables 
-- 

-- 
-- Indexes for table `ofertas` 
-- 
ALTER TABLE `ofertas` 
  ADD PRIMARY KEY (`id`); 
COMMIT; 

-- -------------------------------------------------------- 

-- 
-- Table structure for table `offers_users` 
-- 

CREATE TABLE `offers_users` ( 
  `offer_id` int(11) NOT NULL, 
  `user` varchar(255) NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci; 

-- 
-- Dumping data for table `offers_users` 
-- 
-- 
-- Indexes for dumped tables 
-- 

-- 
-- Indexes for table `offers_users` 
-- 
ALTER TABLE `offers_users` 
  ADD PRIMARY KEY (`offer_id`,`user`), 
  ADD KEY `user` (`user`); 

-- 
-- Constraints for dumped tables 
-- 

-- 
-- Constraints for table `offers_users` 
-- 
ALTER TABLE `offers_users` 
  ADD CONSTRAINT `offers_users_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `ofertas` (`id`), 
  ADD CONSTRAINT `offers_users_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`mail`); 
COMMIT; 

