-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-03-2019 a las 03:54:13
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `examen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones`
--

CREATE TABLE `acciones` (
  `idacciones` int(11) NOT NULL,
  `creacion` datetime NOT NULL,
  `idtipo` int(11) NOT NULL,
  `fechainicio` date NOT NULL,
  `fechafinal` date DEFAULT NULL,
  `observaciones` text
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Volcado de datos para la tabla `acciones`
--

INSERT INTO `acciones` (`idacciones`, `creacion`, `idtipo`, `fechainicio`, `fechafinal`, `observaciones`) VALUES
(80, '2019-03-10 05:21:58', 1, '2019-03-11', '2019-03-18', 'Semana de Vacaciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canton`
--

CREATE TABLE `canton` (
  `idcanton` int(11) NOT NULL,
  `nombrecanton` varchar(75) NOT NULL,
  `idprovincia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Volcado de datos para la tabla `canton`
--

INSERT INTO `canton` (`idcanton`, `nombrecanton`, `idprovincia`) VALUES
(0, 'San Jose Central', 0),
(1, 'Escazu', 0),
(2, 'Desamparados', 0),
(3, 'Coronado', 0),
(4, 'Barva', 1),
(5, 'Belen', 1),
(6, 'San Isidro', 1),
(7, 'San Pablo', 1),
(8, 'San Ramon', 2),
(9, 'Grecia', 2),
(10, 'Oreamuno', 3),
(11, 'El Guarco', 3),
(12, 'Guacimo', 4),
(13, 'Matina', 4),
(14, 'Liberia', 5),
(15, 'Bagaces', 5),
(16, 'Buenos Aires', 6),
(17, 'Golfito', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `iddepartamento` int(11) NOT NULL,
  `nombredepartamento` varchar(50) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`iddepartamento`, `nombredepartamento`, `descripcion`) VALUES
(1, 'Ventas', 'Primer Piso'),
(2, 'Recursos Humanos', 'Segundo Piso'),
(3, 'Auditoria', 'Tercer Piso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distrito`
--

CREATE TABLE `distrito` (
  `iddistrito` int(11) NOT NULL,
  `nombredistrito` varchar(75) NOT NULL,
  `idprovincia` int(11) NOT NULL,
  `idcanton` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Volcado de datos para la tabla `distrito`
--

INSERT INTO `distrito` (`iddistrito`, `nombredistrito`, `idprovincia`, `idcanton`) VALUES
(0, 'El Carmen', 0, 0),
(1, 'San Miguel', 0, 1),
(2, 'Calle Fallas', 0, 2),
(3, 'Dulce Nombre', 0, 3),
(4, 'San Pablo', 1, 4),
(5, 'La Ribera', 1, 5),
(6, 'San Rafael', 1, 6),
(7, 'Puebla', 1, 7),
(8, 'Santiago', 2, 8),
(9, 'Tacares', 2, 9),
(10, 'San Rafael', 3, 10),
(11, 'Tobosi', 3, 11),
(12, 'Pococi', 4, 12),
(13, 'Baltimore', 4, 13),
(14, 'Canas Dulces', 5, 14),
(15, 'La fortuna', 5, 15),
(16, 'Boruca', 6, 16),
(17, 'Golfito', 6, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `cedula` varchar(25) NOT NULL,
  `idnacionalidad` int(11) NOT NULL,
  `idprovincia` int(11) NOT NULL,
  `idcanton` int(11) NOT NULL,
  `iddistrito` int(11) NOT NULL,
  `direccion` varchar(500) NOT NULL,
  `telefono` int(11) NOT NULL,
  `celular` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `idestudio` tinyint(4) NOT NULL,
  `nacimiento` date NOT NULL,
  `iddepartamento` int(11) NOT NULL,
  `puesto` varchar(50) NOT NULL,
  `banco` varchar(200) NOT NULL,
  `bancaria` varchar(25) NOT NULL,
  `idestado` int(11) NOT NULL,
  `usuario` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `idrol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `nombre`, `apellido`, `cedula`, `idnacionalidad`, `idprovincia`, `idcanton`, `iddistrito`, `direccion`, `telefono`, `celular`, `email`, `idestudio`, `nacimiento`, `iddepartamento`, `puesto`, `banco`, `bancaria`, `idestado`, `usuario`, `password`, `idrol`) VALUES
(12, 'Priscilla', 'Cascante', '116530780', 0, 0, 0, 0, 'San Cayetano', 22268517, 60024503, 'prisgudi17@hotmail.com', 6, '1996-09-17', 1, 'Jefe', 'BCR', '111111111111', 1, 'priscg17', 'admin1', 0),
(13, 'Juan', 'Sanchez', '111111111', 0, 0, 0, 0, 'Algo', 11111111, 11111111, 'algo@gmail.com', 6, '1996-09-17', 1, 'Vendedor', 'aaaaaaaa', '1234567890', 0, 'consultor', 'admin2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `idestado` int(11) NOT NULL,
  `nombreestado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`idestado`, `nombreestado`) VALUES
(0, 'Inactivo'),
(1, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudio`
--

CREATE TABLE `estudio` (
  `idestudio` tinyint(4) NOT NULL,
  `nombreestudio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Volcado de datos para la tabla `estudio`
--

INSERT INTO `estudio` (`idestudio`, `nombreestudio`) VALUES
(0, 'primaria completa'),
(1, 'primaria incompleta'),
(2, 'secundaria completa'),
(3, 'secundaria incompleta'),
(4, 'universidad incompleta'),
(5, 'bachillerato universitario'),
(6, 'licenciatura'),
(7, 'especialidad'),
(8, 'maestr?a'),
(9, 'doctorado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacionalidad`
--

CREATE TABLE `nacionalidad` (
  `idnacionalidad` int(11) NOT NULL,
  `nombrenacionalidad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Volcado de datos para la tabla `nacionalidad`
--

INSERT INTO `nacionalidad` (`idnacionalidad`, `nombrenacionalidad`) VALUES
(0, 'Costarricense');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `idprovincia` int(11) NOT NULL,
  `nombreprovincia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`idprovincia`, `nombreprovincia`) VALUES
(0, 'San Jose'),
(1, 'Heredia'),
(2, 'Alajuela'),
(3, 'Cartago'),
(4, 'Limon'),
(5, 'Guanacaste'),
(6, 'Puntarenas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idrol` int(11) NOT NULL,
  `nombreroles` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idrol`, `nombreroles`) VALUES
(0, 'Gestor'),
(1, 'Consulta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `idtipo` int(11) NOT NULL,
  `nombretipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`idtipo`, `nombretipo`) VALUES
(0, 'Nombramiento'),
(1, 'Vacaciones'),
(2, 'Despido');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD PRIMARY KEY (`idacciones`),
  ADD KEY `idtipo` (`idtipo`);

--
-- Indices de la tabla `canton`
--
ALTER TABLE `canton`
  ADD PRIMARY KEY (`idcanton`),
  ADD KEY `idprovincia` (`idprovincia`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`iddepartamento`);

--
-- Indices de la tabla `distrito`
--
ALTER TABLE `distrito`
  ADD PRIMARY KEY (`iddistrito`),
  ADD KEY `idprovincia` (`idprovincia`,`idcanton`),
  ADD KEY `idcanton` (`idcanton`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idestudio` (`idestudio`),
  ADD KEY `iddepartamento` (`iddepartamento`),
  ADD KEY `idestado` (`idestado`),
  ADD KEY `idrol` (`idrol`),
  ADD KEY `idnacionalidad` (`idnacionalidad`,`idprovincia`,`idcanton`,`iddistrito`),
  ADD KEY `idnacionalidad_2` (`idnacionalidad`,`idprovincia`,`idcanton`,`iddistrito`),
  ADD KEY `idprovincia` (`idprovincia`),
  ADD KEY `iddepartamento_2` (`iddepartamento`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`idestado`);

--
-- Indices de la tabla `estudio`
--
ALTER TABLE `estudio`
  ADD PRIMARY KEY (`idestudio`);

--
-- Indices de la tabla `nacionalidad`
--
ALTER TABLE `nacionalidad`
  ADD PRIMARY KEY (`idnacionalidad`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`idprovincia`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`idtipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acciones`
--
ALTER TABLE `acciones`
  MODIFY `idacciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `iddepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `idtipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD CONSTRAINT `acciones_ibfk_1` FOREIGN KEY (`idtipo`) REFERENCES `tipos` (`idtipo`);

--
-- Filtros para la tabla `canton`
--
ALTER TABLE `canton`
  ADD CONSTRAINT `canton_ibfk_1` FOREIGN KEY (`idprovincia`) REFERENCES `provincia` (`idprovincia`);

--
-- Filtros para la tabla `distrito`
--
ALTER TABLE `distrito`
  ADD CONSTRAINT `distrito_ibfk_1` FOREIGN KEY (`idprovincia`) REFERENCES `provincia` (`idprovincia`),
  ADD CONSTRAINT `distrito_ibfk_2` FOREIGN KEY (`idcanton`) REFERENCES `canton` (`idcanton`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`idestudio`) REFERENCES `estudio` (`idestudio`),
  ADD CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`idprovincia`) REFERENCES `provincia` (`idprovincia`),
  ADD CONSTRAINT `empleado_ibfk_3` FOREIGN KEY (`idnacionalidad`) REFERENCES `nacionalidad` (`idnacionalidad`),
  ADD CONSTRAINT `empleado_ibfk_5` FOREIGN KEY (`idrol`) REFERENCES `roles` (`idrol`),
  ADD CONSTRAINT `empleado_ibfk_6` FOREIGN KEY (`idestado`) REFERENCES `estado` (`idestado`),
  ADD CONSTRAINT `empleado_ibfk_7` FOREIGN KEY (`iddepartamento`) REFERENCES `departamento` (`iddepartamento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
