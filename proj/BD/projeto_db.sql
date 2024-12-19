-- Seleciona o banco de dados
USE projeto;

-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: projeto
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Excluir tabelas se já existirem
DROP TABLE IF EXISTS `log_acoes`;
DROP TABLE IF EXISTS `usuarios`;

-- Table structure for table `log_acoes`
CREATE TABLE `log_acoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `acao` varchar(45) NOT NULL,
  `horario` datetime NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Dumping data for table `log_acoes`
LOCK TABLES `log_acoes` WRITE;
/*!40000 ALTER TABLE `log_acoes` DISABLE KEYS */;
INSERT INTO `log_acoes` VALUES (1,6,'Excluir','2024-11-25 00:45:07');
/*!40000 ALTER TABLE `log_acoes` ENABLE KEYS */;
UNLOCK TABLES;

-- Table structure for table `usuarios`
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomeMaterno` varchar(100) NOT NULL,
  `dataNascimento` date DEFAULT NULL,
  `telefoneF` varchar(20) NOT NULL,
  `telefoneC` varchar(20) NOT NULL,
  `genero` varchar(100) NOT NULL,
  `cep` varchar(100) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cSenha` varchar(255) NOT NULL,
  `classe` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Dumping data for table `usuarios`
LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES 
(1,'Cauã Tentempo de Souza','18858757700','cauatentempo@gmail.com','Aline Cristina Tentempo',NULL,'21986325986','21986325986','','21044020','Avenida Brigadeiro Trompowski','Rio de Janeiro','Ramos','RJ','Cauat','$2y$10$TbjzEn8nlaqOenvmUVdmKOYAlGdeG.jU4BGmCelXoEAktzbMP.VxG','$2y$10$TbjzEn8nlaqOenvmUVdmKOYAlGdeG.jU4BGmCelXoEAktzbMP.VxG','master'),
(2,'Alice Cristina dos santos','18858757704','cauatentempo@gmail.com','Aline Cristina Tentempo',NULL,'21986325986','21986325986','outros','21044020','Avenida Brigadeiro Trompowski','Rio de Janeiro','Ramos','RJ','Elice','$2y$10$9d3L02C0IGHm5BFDiSrKbuY24IMOQkbmmCXMGU6Eun.S1avJLgxTK','$2y$10$9d3L02C0IGHm5BFDiSrKbuY24IMOQkbmmCXMGU6Eun.S1avJLgxTK','cliente'),
(3,'MOZART','123456','mozart.calado@hotmail.com','LUCIENE',NULL,'12312312','123123','masculino','21044020','Avenida Brigadeiro Trompowski','Rio de Janeiro','Ramos','RJ','calado','$2y$10$H0u9MJYNa66mlX9uoRrtCuRqX..a0M.59sEXFkRW5xhgYy9ACSf2q','$2y$10$H0u9MJYNa66mlX9uoRrtCuRqX..a0M.59sEXFkRW5xhgYy9ACSf2q','master'),
(4,'ssd','111111','asd@AS','asdasdas','2003-01-01','1111','11111','masculino','21044020','Avenida Brigadeiro Trompowski','Rio de Janeiro','Ramos','','seb','$2y$10$Q9vCqFjwH40RIeaq3qUuM.qiWCpr.eCEuTGD4kR13KLyR9j2Uo/7O','$2y$10$Q9vCqFjwH40RIeaq3qUuM.qiWCpr.eCEuTGD4kR13KLyR9j2Uo/7O','adm'),
(5,'Caiane souza','18858757700','cauatentempo@gmail.com','Aline Cristina Tentempo',NULL,'21986325986','21986325986','feminino','21044020','Avenida Brigadeiro Trompowski','Rio de Janeiro','Ramos','RJ','caiane','$2y$10$gU7YI/PC/kDejTUeFeBZXOQ4qF8ZoMTllzzAuOrKcv20RhepHhMca','$2y$10$gU7YI/PC/kDejTUeFeBZXOQ4qF8ZoMTllzzAuOrKcv20RhepHhMca','cliente');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

-- Final
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-24 21:58:19
