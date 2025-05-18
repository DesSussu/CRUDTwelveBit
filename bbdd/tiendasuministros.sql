-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2025 a las 18:40:40
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendasuministros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `Cod_Almacen` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Ubicacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `ID_Cliente` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Apellidos` varchar(100) DEFAULT NULL,
  `NIF` varchar(20) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`ID_Cliente`, `Nombre`, `Apellidos`, `NIF`, `Direccion`, `Telefono`, `Email`, `Password`) VALUES
(1, 'Desire Maya', 'Maya', NULL, NULL, '722806566', 'admin@admin', ''),
(2, 'Desire Maya', 'Ruiz De Valdivia', NULL, NULL, '7228065669', 'peakmanson.4@gmail.com', ''),
(3, 'Isabel', 'Olivares', NULL, NULL, '610056006', 'isa6_2@hotmail.com', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `Cod_Empleado` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Apellidos` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`Cod_Empleado`, `Nombre`, `Apellidos`, `Telefono`, `Email`) VALUES
(1, 'Desire Maya', 'Pitufa', '722806566', 'admin@admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_compra`
--

CREATE TABLE `facturas_compra` (
  `Num_Factura` int(11) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Importe` decimal(10,2) DEFAULT NULL,
  `ID_Proveedor` int(11) DEFAULT NULL,
  `Cod_Empleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturas_compra`
--

INSERT INTO `facturas_compra` (`Num_Factura`, `Fecha`, `Importe`, `ID_Proveedor`, `Cod_Empleado`) VALUES
(0, '2025-05-02', 46.00, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_venta`
--

CREATE TABLE `facturas_venta` (
  `Cod_Factura` int(11) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Importe` decimal(10,2) DEFAULT NULL,
  `ID_Cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturas_venta`
--

INSERT INTO `facturas_venta` (`Cod_Factura`, `Fecha`, `Importe`, `ID_Cliente`) VALUES
(1, '2025-05-08', 33.00, 3),
(2, '2025-05-17', 264.00, 3),
(3, '2025-05-07', 95.00, 2),
(4, '2025-05-07', 99.00, 3),
(5, '2025-05-02', 64.00, 1),
(6, '2025-05-24', 66.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_compra`
--

CREATE TABLE `lineas_compra` (
  `Num_Factura` int(11) NOT NULL,
  `Num_Linea` int(11) NOT NULL,
  `Codigo` int(11) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT 1,
  `Precio` decimal(10,2) DEFAULT 0.00,
  `TotalLinea` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lineas_compra`
--

INSERT INTO `lineas_compra` (`Num_Factura`, `Num_Linea`, `Codigo`, `Cantidad`, `Precio`, `TotalLinea`) VALUES
(0, 1, 1, 2, 23.00, 46.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_venta`
--

CREATE TABLE `lineas_venta` (
  `Cod_Factura` int(11) NOT NULL,
  `Num_Linea` int(11) NOT NULL,
  `Codigo` int(11) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT 1,
  `Precio` decimal(10,2) DEFAULT 0.00,
  `TotalLinea` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lineas_venta`
--

INSERT INTO `lineas_venta` (`Cod_Factura`, `Num_Linea`, `Codigo`, `Cantidad`, `Precio`, `TotalLinea`) VALUES
(1, 1, 1, 3, 0.00, 0.09),
(2, 1, 2, 8, 33.00, 264.00),
(2, 2, 1, 2, 31.00, 62.00),
(3, 1, 2, 1, 33.00, 33.00),
(3, 2, 1, 2, 31.00, 62.00),
(4, 1, 2, 3, 33.00, 99.00),
(5, 1, 1, 1, 31.00, 31.00),
(5, 2, 2, 1, 33.00, 33.00),
(6, 1, 2, 2, 33.00, 66.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Codigo` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Codigo`, `Nombre`, `Precio`, `Stock`) VALUES
(1, 'bnnn', 31.00, 76),
(2, 'Switch azul', 33.00, 64);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `ID_Proveedor` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `CIF` varchar(20) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`ID_Proveedor`, `Nombre`, `CIF`, `Direccion`, `Telefono`, `Email`) VALUES
(1, 'Gabriela', '8743589375834', 'Calle Vicent Blasco Ibañez', '2343', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacion_almacen_productos`
--

CREATE TABLE `relacion_almacen_productos` (
  `Cod_Almacen` int(11) NOT NULL,
  `Codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`Cod_Almacen`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID_Cliente`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`Cod_Empleado`);

--
-- Indices de la tabla `facturas_compra`
--
ALTER TABLE `facturas_compra`
  ADD PRIMARY KEY (`Num_Factura`),
  ADD KEY `ID_Proveedor` (`ID_Proveedor`),
  ADD KEY `Cod_Empleado` (`Cod_Empleado`);

--
-- Indices de la tabla `facturas_venta`
--
ALTER TABLE `facturas_venta`
  ADD PRIMARY KEY (`Cod_Factura`),
  ADD KEY `ID_Cliente` (`ID_Cliente`);

--
-- Indices de la tabla `lineas_compra`
--
ALTER TABLE `lineas_compra`
  ADD PRIMARY KEY (`Num_Factura`,`Num_Linea`),
  ADD KEY `Codigo` (`Codigo`);

--
-- Indices de la tabla `lineas_venta`
--
ALTER TABLE `lineas_venta`
  ADD PRIMARY KEY (`Cod_Factura`,`Num_Linea`),
  ADD KEY `Codigo` (`Codigo`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`ID_Proveedor`);

--
-- Indices de la tabla `relacion_almacen_productos`
--
ALTER TABLE `relacion_almacen_productos`
  ADD PRIMARY KEY (`Cod_Almacen`,`Codigo`),
  ADD KEY `Codigo` (`Codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `Cod_Empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `facturas_venta`
--
ALTER TABLE `facturas_venta`
  MODIFY `Cod_Factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `lineas_venta`
--
ALTER TABLE `lineas_venta`
  MODIFY `Cod_Factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `ID_Proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `facturas_compra`
--
ALTER TABLE `facturas_compra`
  ADD CONSTRAINT `facturas_compra_ibfk_1` FOREIGN KEY (`ID_Proveedor`) REFERENCES `proveedores` (`ID_Proveedor`),
  ADD CONSTRAINT `facturas_compra_ibfk_2` FOREIGN KEY (`Cod_Empleado`) REFERENCES `empleados` (`Cod_Empleado`);

--
-- Filtros para la tabla `facturas_venta`
--
ALTER TABLE `facturas_venta`
  ADD CONSTRAINT `facturas_venta_ibfk_1` FOREIGN KEY (`ID_Cliente`) REFERENCES `clientes` (`ID_Cliente`);

--
-- Filtros para la tabla `lineas_compra`
--
ALTER TABLE `lineas_compra`
  ADD CONSTRAINT `lineas_compra_ibfk_1` FOREIGN KEY (`Num_Factura`) REFERENCES `facturas_compra` (`Num_Factura`),
  ADD CONSTRAINT `lineas_compra_ibfk_2` FOREIGN KEY (`Codigo`) REFERENCES `productos` (`Codigo`);

--
-- Filtros para la tabla `lineas_venta`
--
ALTER TABLE `lineas_venta`
  ADD CONSTRAINT `lineas_venta_ibfk_1` FOREIGN KEY (`Cod_Factura`) REFERENCES `facturas_venta` (`Cod_Factura`),
  ADD CONSTRAINT `lineas_venta_ibfk_2` FOREIGN KEY (`Codigo`) REFERENCES `productos` (`Codigo`);

--
-- Filtros para la tabla `relacion_almacen_productos`
--
ALTER TABLE `relacion_almacen_productos`
  ADD CONSTRAINT `relacion_almacen_productos_ibfk_1` FOREIGN KEY (`Cod_Almacen`) REFERENCES `almacen` (`Cod_Almacen`),
  ADD CONSTRAINT `relacion_almacen_productos_ibfk_2` FOREIGN KEY (`Codigo`) REFERENCES `productos` (`Codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
