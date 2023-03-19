-- MySQL dump 10.13  Distrib 5.7.36, for Win64 (x86_64)
--
-- Host: localhost    Database: sistema_ao
-- ------------------------------------------------------
-- Server version	5.7.36

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
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(45) NOT NULL,
  `descricao_categoria` varchar(120) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Mão-de-Obra','Gastos com Mão-de-Obra'),(2,'Material','Gastos com Material'),(3,'Serviços','Gastos com Serviços'),(4,'Viagem',''),(5,'Combustível','');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(50) NOT NULL,
  `doc_cliente` varchar(25) NOT NULL,
  `fone_cliente` varchar(15) NOT NULL,
  `endereco_cliente` varchar(150) NOT NULL,
  `bairro_cliente` varchar(25) NOT NULL,
  `cidade_cliente` varchar(25) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Cliente 01','11.111.111/1111-11','(35) 91111-1111','Rua de Asfalto 01','Bairro A','Itapeva'),(2,'Cliente 02','222.222.222-22','(35) 92222-2222','Rua de Concreto 02','Bairro B','Extrema'),(3,'Cliente 03','333.333.333-33','(35) 93333-3333','Rua de Paralelepipedo','Bairro C','Camanducaia');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fornecedores` (
  `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT,
  `nome_fornecedor` varchar(100) NOT NULL,
  `fone_fornecedor` varchar(18) NOT NULL,
  `doc_fornecedor` varchar(18) NOT NULL,
  `conta_fornecedor` varchar(150) NOT NULL,
  PRIMARY KEY (`id_fornecedor`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedores`
--

LOCK TABLES `fornecedores` WRITE;
/*!40000 ALTER TABLE `fornecedores` DISABLE KEYS */;
INSERT INTO `fornecedores` VALUES (1,'Fornecedor Material 01','(35) 91010-1010','00.000.000/0000-00','PIX CPF'),(2,'Fornecedor Material 02','(35) 92020-2020','22.222.222/2222-22','PIX EMAIL'),(3,'Fornecedor Material 03','(35) 93030-3030','11.111.111/1111-11','Banco Brasil'),(4,'Fornecedor Mão-Obra 01','(11) 91010-1010','33.333.333/3333-33','Banco Bradesco'),(5,'Fornecedor Mão-Obra 02','(11) 92020-2020','44.444.444/4444-44','Banco Nubank'),(6,'Fornecedor Mão-Obra 03','(11) 95050-5050','55.555.555/5555-55','Banco Inter'),(7,'Fornecedor Serviços A','(22) 97070-7070','66.666.666/6666-66','PIX CPF'),(8,'Fornecedor Serviços B','(22) 98080-8080','77.777.777/7777-77','PIX Telefone'),(9,'Fornecedor Serviços C','(22) 98080-8080','88.888.888/8888-88','PIX CPF');
/*!40000 ALTER TABLE `fornecedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gqu_usuarios`
--

DROP TABLE IF EXISTS `gqu_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gqu_usuarios` (
  `id_usu` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usu` varchar(50) NOT NULL,
  `matricula_usu` varchar(20) NOT NULL,
  `cpf_usu` varchar(11) NOT NULL,
  `email_usu` varchar(120) NOT NULL,
  `nivel_usu` varchar(1) NOT NULL,
  `pw_usu` varchar(120) NOT NULL,
  `turma_usu` tinyint(5) NOT NULL,
  `ativo_usu` tinyint(5) NOT NULL,
  PRIMARY KEY (`id_usu`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gqu_usuarios`
--

LOCK TABLES `gqu_usuarios` WRITE;
/*!40000 ALTER TABLE `gqu_usuarios` DISABLE KEYS */;
INSERT INTO `gqu_usuarios` VALUES (1,'B&R_ADM','197346','00000000000','victor@engenhabr.com.br','2','19c21758ac229b06afba047bc9a46755',1,1);
/*!40000 ALTER TABLE `gqu_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movcaixa`
--

DROP TABLE IF EXISTS `movcaixa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movcaixa` (
  `id_movCaixa` int(11) NOT NULL AUTO_INCREMENT,
  `data_movCaixa` date NOT NULL,
  `descricao_movCaixa` varchar(100) NOT NULL,
  `fornecedor_movCaixa` varchar(40) NOT NULL,
  `categoria_movCaixa` varchar(40) NOT NULL,
  `responsavel_movCaixa` varchar(40) NOT NULL,
  `tipo_movCaixa` varchar(15) NOT NULL,
  `valor_movCaixa` varchar(20) DEFAULT NULL,
  `saldo_movCaixa` varchar(20) NOT NULL,
  PRIMARY KEY (`id_movCaixa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movcaixa`
--

LOCK TABLES `movcaixa` WRITE;
/*!40000 ALTER TABLE `movcaixa` DISABLE KEYS */;
/*!40000 ALTER TABLE `movcaixa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movconta`
--

DROP TABLE IF EXISTS `movconta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movconta` (
  `id_movConta` int(11) NOT NULL AUTO_INCREMENT,
  `data_movConta` varchar(20) NOT NULL,
  `descricao_movConta` varchar(100) NOT NULL,
  `fornecedor_movConta` varchar(40) NOT NULL,
  `categoria_movConta` varchar(40) NOT NULL,
  `responsavel_movConta` varchar(40) NOT NULL,
  `tipo_movConta` varchar(25) NOT NULL,
  `valor_movConta` varchar(20) DEFAULT NULL,
  `saldo_movConta` varchar(20) NOT NULL,
  `fitid` varchar(30) NOT NULL,
  PRIMARY KEY (`id_movConta`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movconta`
--

LOCK TABLES `movconta` WRITE;
/*!40000 ALTER TABLE `movconta` DISABLE KEYS */;
INSERT INTO `movconta` VALUES (1,'2023-01-01','Saldo Anterior','','','','Crédito','29868.83','29868.83','000000001');
/*!40000 ALTER TABLE `movconta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notas_obra`
--

DROP TABLE IF EXISTS `notas_obra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notas_obra` (
  `id_nota` int(11) NOT NULL AUTO_INCREMENT,
  `id_obra` int(11) NOT NULL,
  `nota` text,
  PRIMARY KEY (`id_nota`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notas_obra`
--

LOCK TABLES `notas_obra` WRITE;
/*!40000 ALTER TABLE `notas_obra` DISABLE KEYS */;
/*!40000 ALTER TABLE `notas_obra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obras`
--

DROP TABLE IF EXISTS `obras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `obras` (
  `id_obra` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_obra` varchar(40) NOT NULL,
  `inicio_obra` date NOT NULL,
  `prazo_obra` varchar(5) NOT NULL,
  `valor_obra` varchar(20) NOT NULL,
  `endereco_obra` varchar(150) NOT NULL,
  `pagamento_obra` varchar(150) NOT NULL,
  PRIMARY KEY (`id_obra`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obras`
--

LOCK TABLES `obras` WRITE;
/*!40000 ALTER TABLE `obras` DISABLE KEYS */;
INSERT INTO `obras` VALUES (1,'Obra A - Cliente 1','2023-01-01','90','150.000,00','Rua das Abobrinhas, 159','Pagamento em 10X - PIX'),(2,'Obra B - Cliente 2','2023-01-02','120','90.000,00','Avenida de Asfalto, 683','Pagamento em 2X - Transferência Bradesco'),(3,'Obra C - Cliente 3','2023-01-03','150','280.000,00','Rua dos Pássaros, 658','Pagamento em 5X - PIX'),(-1,'Rateio','2023-01-01','0','0','0','0');
/*!40000 ALTER TABLE `obras` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-02-06 10:54:44
