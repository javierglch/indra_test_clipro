CREATE DATABASE  IF NOT EXISTS `indra_test` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `indra_test`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: indra_test
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.13-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(25) NOT NULL COMMENT 'nombre del cliente',
  `Apellidos` varchar(65) NOT NULL COMMENT 'apellidos del cliente',
  `DNI` varchar(9) NOT NULL COMMENT 'nif del cliente',
  `Direccion` varchar(200) NOT NULL COMMENT 'direccion postal del cliente, incluye calle, numero, provincia, codigo postal (todo)',
  `Email` varchar(30) NOT NULL COMMENT 'email del cliente',
  `Telefono` varchar(20) NOT NULL COMMENT 'telefono, por ejemplo +34 600 600 600. Puede contener espacios',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  UNIQUE KEY `DNI_UNIQUE` (`DNI`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='lista de los clientes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Manuel','Hernandez','12440067B','Calle Vid, 1, 37006 Salamanca','manuel.hernandez@hotmail.com','657045484'),(2,'Victoria','Sanchez','53655247L','Av. de Salamanca, 126-120, 37006 Salamanca','victoria.sanchez@hotmail.com','621687531'),(3,'Raquel','Sanchez','66628200Y','Calle Tostado, 37008 Salamanca','raquel.sanchez@hotmail.com','685751356'),(4,'Ana','Rodriguez','11119079M','Calle Galileo, 16, 37004 Salamanca','ana.rodriguez@hotmail.com','789513872'),(5,'Jesús','Antona','03536599G','Paseo de Canalejas, 154-168, 37001 Salamanca','jesus.antona@hotmail.com','656657892'),(6,'Adrian','Perez','83359278X','Calle García Tejado, 2, 37007 Salamanca','adrian.perez@hotmail.com','678052100'),(7,'Teresa','Pérez','24258245F','Calle Don Quijote, 26-46, 37006 Salamanca','teresa.perez@gmail.com','600487654');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes_productos`
--

DROP TABLE IF EXISTS `clientes_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes_productos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDCliente` int(11) NOT NULL COMMENT 'ID del cliente al que se le asocia el producto',
  `IDProductos` int(11) NOT NULL COMMENT 'id del producto asociado al cliente',
  PRIMARY KEY (`ID`,`IDCliente`,`IDProductos`),
  UNIQUE KEY `ID_UNIQUE` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='Asociacion de productos con los clientes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes_productos`
--

LOCK TABLES `clientes_productos` WRITE;
/*!40000 ALTER TABLE `clientes_productos` DISABLE KEYS */;
INSERT INTO `clientes_productos` VALUES (4,2,3),(5,2,4),(6,2,5),(7,3,6),(8,3,7),(9,3,8),(13,1,1),(14,1,2),(15,1,3);
/*!40000 ALTER TABLE `clientes_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id del la fila',
  `Codigo` varchar(20) NOT NULL COMMENT 'codigo del producto',
  `Nombre` varchar(50) NOT NULL COMMENT 'nombre del producto',
  `Descripcion` varchar(255) DEFAULT NULL COMMENT 'descripción del producto',
  PRIMARY KEY (`ID`,`Codigo`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  UNIQUE KEY `Codigo_UNIQUE` (`Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='lista de productos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'B00T2XX7CO','Remington IPL6250 i-Light Essential - Depiladora d','Rápido: resultados permanentes en 3 tratamientos. Seguro: clínicamente probado, aprobado por la FDA (Agencia de alimentos y medicamentos de EEUU), recomendado por dermatólogos. Efectivo: Tecnología ProPulse. Uso: Cuerpo. Unisex. Resultados: Permanentes. P'),(2,'B003E7T9MQ','Gafas de protección contra láser, color rojo ','Par de gafas de protección ante láser. Un accesorio necesario para proteger los ojos de la exposición al láser. Proporciona una protección completa para los ojos frente al láser. '),(3,'B00AMAJZ8G','Braun Venus Braun Venus - Gel activador para depil','El gel activador Naked Skin V favorece un tratamiento suave y una reducción más efectiva del vello. '),(4,'B009GFML20','SafeLightPro - Gafas de protección para depilación','Las gafas SafeLightPro F5 protegen sus ojos de los impulsos de luz muy intensos (destellos) emitidos por los dispositivos HPL e IPL que se utilizan para la eliminación definitiva del vello. Por este motivo se establece un determinado nivel de oscuridad.'),(5,'B073T4BKRX','Silk\'n Glide Rapid para la depilación','La novedad mundial de Silkn, el Glide Rapid con 400.000 PULSOS DE LUZ, el último modelo de la serie Silk\'n Glide!'),(6,'B07649JJBW','Mujer Botas Zapatos, Gracosy Nieve Invierno Cortas','DENGBOSN Botas para mujer Botas de invierno Botas de nieve'),(7,'B0785L376C','Shiatsu Masajeador de Espalda Cuello y Hombros con','Nuestro objetivo en InvoSpa es proporcionarte placer y confort que puedes llevarte a donde quieras. Usamos pelotas de masaje con presión 3D para darte masajes con beneficios para tu cuello, hombros, espalda, lumbares, cintura, muslos, pantorrillas, pierna'),(8,'B01C4HCV58','Logitech MK235 - Teclado y ratón inalámbrico, colo','Logitech MK235 - Teclado y ratón inalámbrico, color negro. Teclado y ratón inalámbrico  ');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'indra_test'
--

--
-- Dumping routines for database 'indra_test'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-30 22:03:31
