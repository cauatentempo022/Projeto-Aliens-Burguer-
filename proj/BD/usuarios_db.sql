CREATE DATABASE  IF NOT EXISTS `projeto` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci */;
USE `projeto`;
-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: projeto
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomeMaterno` varchar(100) NOT NULL,
  `dataNascimento` date NOT NULL,
  `telefoneF` varchar(100) NOT NULL,
  `telefoneC` varchar(100) NOT NULL,
  `genero` varchar(100) NOT NULL,
  `cep` varchar(100) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `cSenha` varchar(100) NOT NULL,
  `classe` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Cauã Tentempo de Souza','18858757700','cauatentempo@gmail.com','Aline Cristina Tentempo','0000-00-00','21986325986','21986325986','','21044020','Avenida Brigadeiro Trompowski','Rio de Janeiro','Ramos','RJ','Cauat','$2y$10$TbjzEn8nlaqOenvmUVdmKOYAlGdeG.jU4BGmCelXoEAktzbMP.VxG','$2y$10$TbjzEn8nlaqOenvmUVdmKOYAlGdeG.jU4BGmCelXoEAktzbMP.VxG','master'),(2,'Alice Cristina dos santos','18858757704','cauatentempo@gmail.com','Aline Cristina Tentempo','0000-00-00','21986325986','21986325986','outros','21044020','Avenida Brigadeiro Trompowski','Rio de Janeiro','Ramos','RJ','Elice','$2y$10$9d3L02C0IGHm5BFDiSrKbuY24IMOQkbmmCXMGU6Eun.S1avJLgxTK','$2y$10$9d3L02C0IGHm5BFDiSrKbuY24IMOQkbmmCXMGU6Eun.S1avJLgxTK','cliente'),(3,'MOZART','123456','mozart.calado@hotmail.com','LUCIENE','0000-00-00','12312312','123123','masculino','21044020','Avenida Brigadeiro Trompowski','Rio de Janeiro','Ramos','RJ','calado','$2y$10$H0u9MJYNa66mlX9uoRrtCuRqX..a0M.59sEXFkRW5xhgYy9ACSf2q','$2y$10$H0u9MJYNa66mlX9uoRrtCuRqX..a0M.59sEXFkRW5xhgYy9ACSf2q','master'),(4,'ssda','111111','asd@AS','asdasdas','0000-00-00','1111','11111','masculino','21044020','Avenida Brigadeiro Trompowski','Rio de Janeiro','Ramos','RJ','seb','$2y$10$Q9vCqFjwH40RIeaq3qUuM.qiWCpr.eCEuTGD4kR13KLyR9j2Uo/7O','$2y$10$Q9vCqFjwH40RIeaq3qUuM.qiWCpr.eCEuTGD4kR13KLyR9j2Uo/7O','adm');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-23 16:31:54
