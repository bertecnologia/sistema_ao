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
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movconta`
--

LOCK TABLES `movconta` WRITE;
/*!40000 ALTER TABLE `movconta` DISABLE KEYS */;
INSERT INTO `movconta` VALUES (1,'2023-01-01','Saldo Anterior','','','','Crédito','29868.83','29868.83','000000001'),(2,'2023-01-02','Pagamento Pix ***.069.464-** Servente_obra Jofpar','0','0','0','Débito','100.00','29768.83','20230102100001'),(3,'2023-01-02','','0','0','0','Débito','34.90','29733.93','2023010234901'),(4,'2023-01-04','Pagamento Pix ***.184.396-** Estagiario','0','0','0','Débito','1212.00','28521.93','202301041212001'),(5,'2023-01-05','Recebimento Pix Ct Pro Fit Ltda 42.234.810 0001-52','0','0','0','Crédito','3000.00','31521.93','202301053000001'),(6,'2023-01-06','Tinta_obra 12','0','0','0','Débito','640.90','30881.03','20230106640901'),(7,'2023-01-06','Tinta _ obra 12','0','0','0','Débito','106.70','30774.33','20230106106701'),(8,'2023-01-09','Pagamento Pix ***.578.966-** Pintor obra 12','0','0','0','Débito','200.00','30574.33','20230109200001'),(9,'2023-01-10','','0','0','0','Crédito','2.20','30576.53','202301102201'),(10,'2023-01-11','','0','0','0','Débito','6710.70','23865.83','202301116710701'),(11,'2023-01-13','TERMINAL.: 414301100006 AUT.: 00010','0','0','0','Débito','1500.00','22365.83','202301131500001'),(12,'2023-01-13','Pagamento Pix ***.044.068-** Empreiteiro obra 20','0','0','0','Débito','4000.00','18365.83','202301134000001'),(13,'2023-01-13','Pagamento Pix ***.578.966-** Pintor nei obra 12','0','0','0','Débito','300.00','18065.83','20230113300001'),(14,'2023-01-16','Contabilidade dezembro','0','0','0','Débito','503.00','17562.83','20230116503001'),(15,'2023-01-17','PAG*JulianoCesar EXTREMA BR','0','0','0','Débito','70.00','17492.83','2023011770001'),(16,'2023-01-17','','0','0','0','Crédito','70.00','17562.83','2023011770002'),(17,'2023-01-17','OLIMPIA HATSUMI N OSHIMA 127.984.518-09 CODIGO TED: T810400346 00000000000','0','0','0','Crédito','4150.00','21712.83','202301174150001'),(18,'2023-01-18','ANTONIO VITOR GOM BRAGANCA PAU LBR','0','0','0','Débito','38.80','21674.03','2023011838801'),(19,'2023-01-19','Combust?vel dezembro','0','0','0','Débito','1329.11','20344.92','202301191329111'),(20,'2023-01-20','Documento empresa','0','0','0','Débito','90.34','20254.58','2023012090341'),(21,'2023-01-20','Combust?vel_ janeiro 15','0','0','0','Débito','1303.26','18951.32','202301201303261'),(22,'2023-01-20','Imposto','0','0','0','Débito','2126.44','16824.88','202301202126441'),(23,'2023-01-20','Pagamento Pix ***.578.966-** Pintor obra 12','0','0','0','Débito','1000.00','15824.88','202301201000001'),(24,'2023-01-24','JOFPAR PARTICIPACOES LTDA 01.342.200 0001-95 CODIGO TED: T811568804','0','0','0','Crédito','7487.00','23311.88','202301247487001'),(25,'2023-01-25','','0','0','0','Débito','3340.32','19971.56','202301253340321'),(26,'2023-01-25','PANIFICADORA CRISTAL BRAGANCA PAU LBR','0','0','0','Débito','2.00','19969.56','202301252001'),(27,'2023-01-26','Tint_obra 12','0','0','0','Débito','260.50','19709.06','20230126260501'),(28,'2023-01-26','Plano sa?de_leandro','0','0','0','Débito','352.00','19357.06','20230126352001'),(29,'2023-01-26','CSNK Sao Paulo BR','0','0','0','Débito','259.80','19097.26','20230126259801'),(30,'2023-01-27','TERMINAL.: 414301100006 AUT.: 00009','0','0','0','Débito','1500.00','17597.26','202301271500001'),(31,'2023-01-27','Pagamento Pix ***.578.966-** Pintor obra 12','0','0','0','Débito','1100.00','16497.26','202301271100001'),(32,'2023-01-27','Pagamento Pix ***.138.268-** Empreiteiro obra 11 final','0','0','0','Débito','2029.50','14467.76','202301272029501'),(33,'2023-01-27','Recebimento Pix CRISTIANE LEONEL FERREIRA ***.709.308-**','0','0','0','Crédito','15000.00','29467.76','2023012715000001'),(34,'2023-01-30','POSTO CAPIVARAO BRAGANCA PAU LBR','0','0','0','Débito','188.94','29278.82','20230130188941'),(35,'2023-01-30','Pagamento Pix ***.138.268-** Empreiteiro Joao pestana obra 20','0','0','0','Débito','1900.00','27378.82','202301301900001'),(36,'2023-01-30','Pagamento Pix ***.116.736-** Lavagem carro','0','0','0','Débito','60.00','27318.82','2023013060001'),(37,'2023-01-30','Pagamento Pix ***.187.286-** Rafael','0','0','0','Débito','130.00','27188.82','20230130130001'),(38,'2023-01-30','Pagamento Pix ***.196.916-** Eletricista obra 20','0','0','0','Débito','1500.00','25688.82','202301301500001'),(39,'2023-01-31','Pagamento Pix ***.109.768-** Pedreiro Roni obra 20','0','0','0','Débito','85.00','25603.82','2023013185001'),(40,'2023-01-31','Pagamento Pix ***.044.068-** Empreiteiro obra 20','0','0','0','Débito','3830.00','21773.82','202301313830001'),(41,'2023-01-31','Pagamento Pix 29.614.550 0001-82 Programa financeiro Parc 2 2','0','0','0','Débito','1620.00','20153.82','202301311620001');
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

-- Dump completed on 2023-02-06 10:52:54
