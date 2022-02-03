-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: productivity_plus
-- ------------------------------------------------------
-- Server version	5.7.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` char(60) NOT NULL,
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (2,'Axel','Montiel','mail@mail.com','$2y$10$pKYPfIUe8EHC/bbDxPw1mOWLrh7NrdzskGiYNSozzeaKo20n//0zi','Axel_admin'),(3,'Wendy','Bert','wendy@correo.com','$2y$10$FcgzQAK.rMzyHqLBrWo6WurtIMFif7Hoq2Sj8CmfMXbTUiTblfTbu','wendizx');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images_phrase`
--

DROP TABLE IF EXISTS `images_phrase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images_phrase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `images` varchar(200) NOT NULL,
  `adminId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `adminId_idx` (`adminId`),
  CONSTRAINT `images_phrase_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `admin` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images_phrase`
--

LOCK TABLES `images_phrase` WRITE;
/*!40000 ALTER TABLE `images_phrase` DISABLE KEYS */;
INSERT INTO `images_phrase` VALUES (16,'25f71524e25f18469df276d5a5056611.png',2),(17,'11148283de4c8ca33740c3466a7de7c1.png',2),(18,'7caa3be0306e524afe768ee29c3378b3.png',2),(19,'27b7b5ef025b59c4b98801796fa7e1b0.png',2),(20,'261baa84126b985ea65f0486d4c432e1.png',2),(21,'2dc22be3875b4029858a654aecdd6fca.png',2),(22,'e7712fda84d06ba095d7d6a8193200cf.png',2);
/*!40000 ALTER TABLE `images_phrase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phrase`
--

DROP TABLE IF EXISTS `phrase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phrase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phrase_content` mediumtext NOT NULL,
  `autor` varchar(30) DEFAULT NULL,
  `adminId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `adminId_idx` (`adminId`),
  CONSTRAINT `adminId` FOREIGN KEY (`adminId`) REFERENCES `admin` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phrase`
--

LOCK TABLES `phrase` WRITE;
/*!40000 ALTER TABLE `phrase` DISABLE KEYS */;
INSERT INTO `phrase` VALUES (11,'No trabajes duro, mejor trabaja inteligente.','Richard Stan',2),(12,'Aunque nadie puede volver atrás y hacer un nuevo comienzo, cualquiera puede comenzar a partir de ahora y crear un nuevo final.','Og Mandino',2),(13,'No conozco el secreto del éxito, pero el secreto del fracaso es procurar seguir siempre la voluntad de los otros.','Anonimo',3),(14,'Acepta la responsabilidad de tu vida. Date cuenta que tú eres quien va a llegar a donde quiere ir, nadie más.','Les Brown',3);
/*!40000 ALTER TABLE `phrase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userId_idx` (`userId`),
  CONSTRAINT `userId` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (43,'barrer la casa','f022c9013b6ced8616f0b0f0f1e7dccc.jpg',2,NULL),(46,'recogeer','',2,NULL),(47,'Ver la pelicula',NULL,2,NULL),(48,'Comprar la verdura',NULL,2,NULL),(49,'Sacudir mi tapete',NULL,2,NULL),(51,'Ir al cine mañana','',3,NULL),(53,'Entregar el libro','a206652ba6357a6d5654da36d0481902.jpg',3,'2022-01-29'),(55,'Comprar la comida',NULL,3,'2022-01-29'),(56,'Escribir mi carta',NULL,3,'2022-01-29'),(57,'Irme de pinta','93046802114183dc187e097b1baa4d77.jpg',5,'2022-01-30'),(58,'Visitar a mi abuela',NULL,5,'2022-01-30'),(59,'Acabar mi proyecto','c9a07f3ad35b051082872b40a34d28bd.jpg',5,'2022-01-30'),(60,'Pagar internet',NULL,5,'2022-01-30'),(61,'Inscribirme al gym',NULL,4,'2022-01-30'),(62,'Comprar boleto de avión','7f144d6dbc9b5e0e00f6e4448a1cdaae.jpg',4,'2022-01-30'),(64,'Entregar mi ensayo',NULL,3,'2022-01-30'),(65,'Ir a la biblioteca','cc5a985bd655d6ea2292283a7f52e436.jpg',3,'2022-01-30'),(66,'Acabar de leer Física','a5c39897f1bee5a7c9dfe80a6379b72f.jpg',3,'2022-01-30'),(67,'Lavar los trastes',NULL,3,'2022-01-30'),(68,'Llevar a mi perro a bañar','',3,'2022-01-30'),(69,'Comprar la comida',NULL,3,'2022-01-30'),(70,'Inscribirme al gimnasio',NULL,3,'2022-01-30');
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `tasks_completed` int(11) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `password` char(60) NOT NULL,
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'Sebas','Zamora',2,'sebas@correo.com','sebas_pro','sebis'),(3,'Kevin','Canuto',0,'kevin@correo.com','$2y$10$t0AY3NNDv1MYqTDAVFlapuAAzXrRvaPZR03q36hMM8SZhmu8mQMUi','mega_mortero'),(4,'Ana','Fregoso',0,'ana@correo.com','$2y$10$YsYrMPl5TDJb7sWNaXRaeuv/6VsWLMWIdROj56OnwNBZwUroEjr9u','anita_32'),(5,'Yuri','Dolome',0,'yuri@correo.com','$2y$10$OVhaCgxLdpo86XMRAIjyKeVuh7oUlPo5xsjTm4G2Z46sLBP8HzMdm','yuri_dolm');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-03 17:40:05
