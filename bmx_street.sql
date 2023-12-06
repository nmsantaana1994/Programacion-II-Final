-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2022 a las 11:18:52
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bmx_street`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bicicletas`
--

CREATE TABLE `bicicletas` (
  `id` int(10) UNSIGNED NOT NULL,
  `modelo` varchar(256) NOT NULL,
  `marca_id` int(10) UNSIGNED NOT NULL,
  `descripcion` text NOT NULL,
  `precio` float(8,2) NOT NULL,
  `foto` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bicicletas`
--

INSERT INTO `bicicletas` (`id`, `modelo`, `marca_id`, `descripcion`, `precio`, `foto`) VALUES
(1, 'Control', 5, 'La Cult Control es una BMX de gama media. La Control tiene un cuadro con tubo superior de 20.75 hecho con un triángulo delantero 100% de cromo, horquillas y barras de cromo. Se ha montado con piezas sólidas de calidad del mercado de accesorios, buje trasero de cassette de 9t sellado, juego de dirección sellado, bielas de cromo con BB medio sellado, neumáticos de 2,4 Cult X Vans neumáticos, freno trasero 990 U-Brake, potencia forjada Salvation y mucho más.', 142400.00, 'cult_control.png'),
(2, 'Gateway', 5, 'La bicicleta Gateway de Cult es la base de la linea, ideal para principiantes y con un diseño caracteristico de la marca. Bike Check: Cuadro: Triangulo frontal TT Cromo - 20.5 Puños: Ricany x ODI Grips Stem: Top Load Juego de dirección: Integrado Pedales: CULT Nylon Palancas: CROMO 3 pc 170mm Heat Treated Caja: Sealed Mid Bottom Bracket Cadenas: CULT 410 Maza Delantera: Sealed Front Hub Maza Trasera: Sealed Rear 9T Cassette Hub Engranaje: 25T Member style Sprocket Asientos: 1pc Padded Seat w/ CULT logo Cubiertas: 2.40 SLICK Tires Frenos: 990 U-Brake Colores: Black Frame w/ ALL Black Parts - Chrome Frame w/ ALL Black Parts\'', 138600.00, 'cult_gateway.jpg'),
(3, 'Highway', 6, 'HIGHWAY es una de las grandes novedades para 2022, este modelo de DRB Bikes es una gran opción para principiantes en BMX. Con calidad y el mejor costo y beneficio del mercado. La geometría de este modelo es adecuada a los estándares mundiales de Bmx. Los componentes son fáciles de reemplazar, lo que permite actualizaciones a piezas profesionales. Como dirección integrada, mov MID central, tija de sillín 25.4, mesa Ahead-Set (over) etc; el Frame tiene refuerzos en el tubo superior e inferior dando mayor resistencia; Ratio de 25 (corona) 9 (cog), Neumáticos 2.35 con un perfil ancho, reforzado y resistente', 107100.00, 'drb_highway.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(10) UNSIGNED NOT NULL,
  `categoria` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `categoria`) VALUES
(1, 'cuadros'),
(2, 'mazas'),
(3, 'llantas'),
(4, 'platos'),
(5, 'horquillas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `ano` year(4) NOT NULL,
  `logo` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id`, `nombre`, `ano`, `logo`) VALUES
(1, 'Primo', 1986, 'primo.png'),
(2, 'We The People', 1996, 'we_the_people.png'),
(3, 'Animal', 2000, 'animal.png'),
(4, 'Salt', 2006, 'salt.png'),
(5, 'Cult', 2009, 'cult.png'),
(6, 'DRB', 2015, 'drb_bikes.png'),
(7, 'Eighties', 2007, 'eighties.png'),
(8, 'Federal', 1999, 'federal.png'),
(9, 'Fitbikeco', 2007, 'fitbikeco.png'),
(10, 'Stranger', 2009, 'stranger.png'),
(11, 'S&M', 1987, 'sym_bikes.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca_x_bicicleta`
--

CREATE TABLE `marca_x_bicicleta` (
  `id` int(10) UNSIGNED NOT NULL,
  `bicicleta_id` int(10) UNSIGNED NOT NULL,
  `marca_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marca_x_bicicleta`
--

INSERT INTO `marca_x_bicicleta` (`id`, `bicicleta_id`, `marca_id`) VALUES
(39, 2, 2),
(40, 2, 3),
(41, 2, 4),
(42, 3, 7),
(43, 3, 8),
(44, 3, 9),
(51, 1, 1),
(52, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repuestos`
--

CREATE TABLE `repuestos` (
  `id` int(10) UNSIGNED NOT NULL,
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `modelo` varchar(256) NOT NULL,
  `marca_id` int(10) UNSIGNED NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` float(8,2) NOT NULL,
  `foto` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `repuestos`
--

INSERT INTO `repuestos` (`id`, `categoria_id`, `modelo`, `marca_id`, `descripcion`, `precio`, `foto`) VALUES
(1, 1, 'Perrin', 8, 'El cuadro Perrin de Federal es un cuadro de BMX de freestyle de alto rendimiento, y está hecho de acero cromado duradero y súper sólido. Gracias a su parte trasera corta, el Perrin es ideal para los riders técnicos que buscan capacidad de respuesta.', 88000.00, 'cuadro_federal.jpg'),
(2, 1, 'Ricany', 5, 'El cuadro Cult Shory, signature de Sean Ricany esta construido en cromo 4130 con TT conico y DT reforzados, clamp integrado, frente integrado y caja MID. Tratado termicamente, tetones removibles. Geometría: Angulo Headtube: 75,5 ° Angulo Seattube: 70 ° Longitud final trasera: 13 -13.325 Altura BB: 11.7 Standover Altura: 8,75 Tamaño Dropout: 14 mm Tipo BB: Mid Soportes de freno: extraíble Peso: 2.32 Kg.', 95200.00, 'cuadro_cult.jpg'),
(3, 1, 'RPG', 10, 'El cuadro Crux V2 de Stranger presenta un nuevo extremo trasero más corto que su predecesor y tensores de cadena integrados, al tiempo que mantiene el mismo tubo de cromo 4130 probado y los métodos de construcción utilizados en el cuadro Crux original, y cuenta con fuelles en los tubos superior e inferior, abrazadera de sillín integrada y punteras gruesas de 5 mm, manteniendo el precio bajo sin sacrificar la resistencia.', 94860.00, 'cuadro_stranger.jpg'),
(4, 2, 'Holy Driver', 7, 'Maza Eighties modelo Holy Driver de 36 agujeros con driver de 9 dientes. Es Freecoaster color negro para lado derecho.', 35360.00, 'maza_eighties.jpg'),
(5, 2, 'Arrow', 2, 'La maza trasera Arrow de WTP esta construida en aluminio 6061-T6 mecanizada en CNC. Cuenta con tres rulemanes sellados internamente para tener un sistema de rodamientos de calidad, eje female de cromo y bulones de cromo especiales patentados por WTP. La Arrow cuenta con el sistema SDS lo cual le permite ser utilazada tanto del lado izquierdo o derecho, tiene un peso de 409 gr.', 48600.00, 'maza_wtp.jpg'),
(6, 2, 'Javelin', 3, 'La JAVELIN de Animal tiene 36 agujeros y CNC de aluminio 7075, la carcasa de la maza tiene una brida del lado más pequeño para una mejor protección. El driver de Cromo de 9 dientes de una pieza utiliza dos casquillos de polímero, en lugar de un juego de trabas comunes, para una mayor duración. El eje de Cromo de 14 mm es hueco y cuenta con un ajuste allen de 8 mm y tuercas de eje de aluminio 7075 del mismo color. Peso: 435gr.', 58140.00, 'maza_animal.jpg'),
(7, 3, 'VSXL+', 1, 'Basada en la popular llanta VS de Primo, la VSXL+ es su contraparte más ancha. Fabricada en aluminio 6061-T6, la llanta VSXL+ cuenta con un diseño de encaje cruzado para una mayor resistencia y rigidez. Con 38 mm de ancho, la llanta VSXL+ es un 12% más ancha que la VS, lo que le permite mantener el perfil correcto de los tamaños de neumáticos modernos.', 24480.00, 'aro_primo.jpg'),
(8, 3, 'Crux XL', 10, 'Tremendo Aro de Llanta para BMX Freestyle de alto nivel. A nuestro criterio se encuentra en el podio de los mejores del mundo. Ya que combina: Extrema Resistencia, Excelente acabado de pintura Negro Mate, El Formato consagrado de Doble Pared y lo que más atrae de este producto su tremendo ancho de casi 43MM.', 13700.00, 'aro_stranger.jpg'),
(9, 3, 'Match V2', 5, 'Un modelo de nivel extremo, con una resistencia suprema, que permite todo tipo de uso y exigencia para BMX Freestyle. Construido en el mejor Aluminio de aleación 6061-T6. Con una estructura de Doble pared. Reforzada a su vez de manera interna con dos columnas en la zona central, dandole una solida e inamovible construcción. Cuenta además con un excelente ancho de 34mm, que permite equipar la gran variedad de cubiertas modernas de BMX Freestyle de hoy en dia, que vienen bien anchas. Otro punto fuerte a destacar , que solo muy pocos aros de BMX lo poseen, es que la unión del aro, es soldada, Welded. Lo que asegura la mejor y más fuerte unión que un aro podria tener.', 19080.00, 'aro_cult.jpg'),
(10, 4, 'Griffin Guard', 1, 'El plato Primo BMX Griffin es uno de los nuevos modelos de Primo BMX. Diseñado y mecanizado en el mejor Aluminio 7075. Con un formato sólido que incluye Guard integrado, para protección de sus dientes y transmisión en trucos arriesgados. Por todo esto se convierte en uno de los platos de BMX Freestyle más resistentes y fuertes del mundo, que te acompañará por años.', 22560.00, 'plato_primo.jpg'),
(11, 4, 'X-Man Guard', 11, 'El engranaje X-MAN de S&M está construido en aluminio 7075 T6, mecanizado en 3D y cuenta con el logotipo de S&M grabado. Cubreplato ultra resistente. Viene con arandelas para ser adaptado a 19mm y 22mm. Disponible en color Pulido.', 25380.00, 'plato_sym.jpg'),
(12, 4, 'V4 Guard', 3, 'El engranaje V4 Full Guard de Animal, esta construido en aluminio 7075 mecanizado en CNC. Tiene dientes de 6.5mm de espesor, 6 recortes para alivianar el plato, un cubre ultra resistente y viene con todos los adaptadores. Peso de 171 gr. y disponible en color negro y 25/28D.', 23200.00, 'plato_animal.jpg'),
(13, 5, 'Pro HD', 1, 'La Horquilla Pro HD presenta la misma geometría que la popular horquilla Strand con la nueva tecnología de fundición de inversión duradera. Construida en Cromo 4130 para una extrema duración.', 41760.00, 'horquilla_primo.jpg'),
(14, 5, 'Plus HQ', 4, 'La horquilla HQ de Saltplus esta construida en una sola pieza de Cromo M2 hidroformada y hecha bajo tratamiento de calor. Tiene un off set de 26mm y un top bolt M24 de aluminio. Tiene un peso de 1047 gr. Disponible en color Negro', 30600.00, 'horquilla_salt.jpg'),
(15, 5, 'Shiv V3', 9, 'La horquilla Fit Shiv V3, es la nueva versión de esta clásica horquilla de la marca. El objetivo de Fit era diseñar y producir una horquilla extremadamente fuerte con mucho espacio para las cubiertas. Está disponible con un offset de 25 mm. Las patas sin costura y estampadas proporcionan más resistencia que las tapas soldadas o fundidas y los extremos de estas patas están formados, no tapados ni soldados, por lo que no hay nada que se pueda fracturar.', 50400.00, 'horquilla_fitbikeco.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(256) NOT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `apellido` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `roles` enum('superadmin','admin','usuario','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `nombre_usuario`, `nombre`, `apellido`, `password`, `roles`) VALUES
(1, 'nicolas.santa@davinci.edu.ar', 'superadmin', 'Nicolás', 'Santa Ana', '$2y$10$Ao91Ug3d5jSYfzuco8akc.aPEzs5dbZbm0t2Xlvr4ntjhBAfInoDi', 'superadmin'),
(2, 'admin@admin.com.ar', 'admin', 'Jose', 'Lopez', '$2y$10$awIPvgs81pPyQR3XLI0CouokMaYmneBTJYt8VA6DzYNgcCU.8suzS', 'admin'),
(3, 'usuario@usuario.com.ar', 'usuario', 'Jorge', 'Perez', '$2y$10$TuGdoinXi1NCZ/.ZmsIHfe3rDhgZ94Sz0hD8oUR8Sl1MUz5ze6HLO', 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bicicletas`
--
ALTER TABLE `bicicletas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marca_id` (`marca_id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marca_x_bicicleta`
--
ALTER TABLE `marca_x_bicicleta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bicicleta_id` (`bicicleta_id`),
  ADD KEY `marca_id` (`marca_id`);

--
-- Indices de la tabla `repuestos`
--
ALTER TABLE `repuestos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `marca_id` (`marca_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bicicletas`
--
ALTER TABLE `bicicletas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `marca_x_bicicleta`
--
ALTER TABLE `marca_x_bicicleta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `repuestos`
--
ALTER TABLE `repuestos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bicicletas`
--
ALTER TABLE `bicicletas`
  ADD CONSTRAINT `bicicletas_ibfk_1` FOREIGN KEY (`marca_id`) REFERENCES `marca` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `marca_x_bicicleta`
--
ALTER TABLE `marca_x_bicicleta`
  ADD CONSTRAINT `marca_x_bicicleta_ibfk_1` FOREIGN KEY (`bicicleta_id`) REFERENCES `bicicletas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `marca_x_bicicleta_ibfk_2` FOREIGN KEY (`marca_id`) REFERENCES `marca` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `repuestos`
--
ALTER TABLE `repuestos`
  ADD CONSTRAINT `repuestos_ibfk_1` FOREIGN KEY (`marca_id`) REFERENCES `marca` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `repuestos_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
