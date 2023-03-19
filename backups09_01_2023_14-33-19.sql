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
  `descricao_categoria` varchar(100) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Mão-de-obra','Gastos com mão de obra'),(2,'Material','Gastos com materiais'),(3,'Serviços','Gastos com serviços'),(4,'Combustível','Gastos com combustível'),(5,'Alimentação','Gastos com alimentação'),(6,'Ordenado','Gastos com ordenado'),(7,'Receita',''),(8,'TEXTE','');
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
  `endereco_cliente` varchar(120) NOT NULL,
  `bairro_cliente` varchar(25) NOT NULL,
  `cidade_cliente` varchar(25) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedores`
--

LOCK TABLES `fornecedores` WRITE;
/*!40000 ALTER TABLE `fornecedores` DISABLE KEYS */;
INSERT INTO `fornecedores` VALUES (1,'Fornecedor de Material 01','(11) 91111-1111','11.111.111/1111-11','PIX 01'),(2,'Fornecedor de Material 02','(22) 92222-2222','22.222.222/2222-22','PIX 02'),(3,'Fornecedor de Material 03','(33) 93333-3333','33.333.333/3333-33','PIX 03'),(4,'Fornecedor de Serviços 01','(99) 99999-9999','99.999.999/9999','Conta S01'),(5,'Fornecedor de Serviços 02','(88) 88888-8888','88.888.888/8888-88','Conta S02'),(6,'Fornecedor de Serviços 03','(77) 77777-7777','77.777.777/7777-77','Conta S03'),(7,'Fornecedor de Mao Obra 01','(55) 55555-5555','55.555.555/5555-55','Conta M01'),(8,'Fornecedor de Mao Obra 02','(44) 44444-4444','44.444.444/4444-44','Conta M02'),(9,'Fornecedor de Mao Obra 03','(66) 66666-6666','66.666.666/6666-66','Conta M03'),(10,'Posto de Combustível','(00) 00000-0000','00.000.000/0000-00','000000000'),(11,'Mecânica','(00) 00000-0000','00.000.000/0000-0','00000000000'),(12,'Receita','','',''),(13,'De Freitas','','',''),(14,'Testtttttttt','','','');
/*!40000 ALTER TABLE `fornecedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funcionarios` (
  `id_funcionario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_funcionario` varchar(50) NOT NULL,
  `doc_funcionario` varchar(25) NOT NULL,
  `fone_funcionario` varchar(15) NOT NULL,
  `endereco_funcionario` varchar(100) NOT NULL,
  `bairro_funcionario` varchar(50) NOT NULL,
  `cidade_funcionario` varchar(25) NOT NULL,
  `adicional_funcionario` varchar(100) NOT NULL,
  PRIMARY KEY (`id_funcionario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios`
--

LOCK TABLES `funcionarios` WRITE;
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gqu_usuarios`
--

DROP TABLE IF EXISTS `gqu_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gqu_usuarios` (
  `id_usu` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usu` varchar(120) NOT NULL,
  `matricula_usu` varchar(20) NOT NULL,
  `cpf_usu` varchar(11) NOT NULL,
  `email_usu` varchar(120) NOT NULL,
  `nivel_usu` varchar(1) NOT NULL,
  `pw_usu` varchar(120) NOT NULL,
  `turma_usu` int(11) NOT NULL,
  `ativo_usu` int(11) NOT NULL,
  PRIMARY KEY (`id_usu`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gqu_usuarios`
--

LOCK TABLES `gqu_usuarios` WRITE;
/*!40000 ALTER TABLE `gqu_usuarios` DISABLE KEYS */;
INSERT INTO `gqu_usuarios` VALUES (1,'BER','11766','00000000000','email@email.com','2','e7d80ffeefa212b7c5c55700e4f7193e',1,1);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `valor_movConta` varchar(20) NOT NULL,
  `saldo_movConta` varchar(20) NOT NULL,
  `fitid` varchar(30) NOT NULL,
  PRIMARY KEY (`id_movConta`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movconta`
--

LOCK TABLES `movconta` WRITE;
/*!40000 ALTER TABLE `movconta` DISABLE KEYS */;
INSERT INTO `movconta` VALUES (1,'2022-12-08','PAG*ClaudiaAparecidaR BRAGANCA PAU LBR','','','','Débito','22.00','-22','2022120822001'),(2,'2022-12-08','AUTOPISTA FERNAO POUSO ALEGRE BR','','','','Débito','2.70','-24.7','202212082701'),(3,'2022-12-08','Habite-se bentevis_ obra 7','','','','Débito','172.00','-196.7','20221208172001'),(4,'2022-12-09','AUTOPISTA FERNAO POUSO ALEGRE BR','','','','Débito','2.70','-199.4','202212092701'),(5,'2022-12-09','MERCADOPAGO*SEVEN CAMPINAS BR','','','','Débito','7.00','-206.4','202212097001'),(6,'2022-12-09','AUTOPISTA FERNAO POUSO ALEGRE BR','','','','Débito','2.70','-209.1','202212092702'),(7,'2022-12-09','AUTOPISTA FERNAO POUSO ALEGRE BR','','','','Débito','2.70','-211.8','202212092703'),(8,'2022-12-09','','','','','Débito','18.00','-229.8','2022120918001'),(9,'2022-12-12','','','','','Débito','5324.86','-5554.66','202212125324861'),(10,'2022-12-12','','','','','Crédito','2.60','-5552.06','202212122601'),(11,'2022-12-12','AUTOPISTA FERNAO POUSO ALEGRE BR','','','','Débito','2.70','-5554.76','202212122701'),(12,'2022-12-12','LO SARDO BRAGANCA PAU LBR','','','','Débito','27.67','-5582.43','2022121227671'),(13,'2022-12-12','PAG*ClaudiaAparecidaR BRAGANCA PAU LBR','','','','Débito','20.00','-5602.43','2022121220001'),(14,'2022-12-12','','','','','Débito','49.90','-5652.33','2022121249901'),(15,'2022-12-13','AUTOPISTA FERNAO POUSO ALEGRE BR','','','','Débito','2.70','-5655.03','202212132701'),(16,'2022-12-13','AUTOPISTA FERNAO POUSO ALEGRE BR','','','','Débito','2.70','-5657.73','202212132702'),(17,'2022-12-13','Combust?vel','','','','Débito','1562.09','-7219.82','202212131562091'),(18,'2022-12-13','Contabilidade setembro','','','','Débito','538.99','-7758.81','20221213538991'),(19,'2022-12-13','POWERNET INFORMATICA M EXTREMA BR','','','','Débito','40.00','-7798.81','2022121340001'),(20,'2022-12-14','Tintas obra 12_1824,50 -','','','','Débito','2149.60','-9948.41','202212142149601'),(21,'2022-12-14','PAYGO*I H L LEME BRAGANCA PAU LBR','','','','Débito','24.00','-9972.41','2022121424001'),(22,'2022-12-14','AUTOPISTA FERNAO POUSO ALEGRE BR','','','','Débito','2.70','-9975.11','202212142701'),(23,'2022-12-14','Pagamento Pix ***.122.557-** Aparelho Duda_desc. Leandro','','','','Débito','950.00','-10925.11','20221214950001'),(24,'2022-12-15','PAG*JulianoCesar EXTREMA BR','','','','Débito','60.00','-10985.11','2022121560001'),(25,'2022-12-15','AUTOPISTA FERNAO POUSO ALEGRE BR','','','','Débito','2.70','-10987.81','202212152701'),(26,'2022-12-15','AUTOPISTA FERNAO POUSO ALEGRE BR','','','','Débito','2.70','-10990.51','202212152702'),(27,'2022-12-16','Pagamento Pix ***.044.068-** Empreiteiro_obra 20','','','','Débito','4370.00','-15360.51','202212164370001'),(28,'2022-12-19','Pagamento Pix ***.112.948-** Pintor_obra 20','','','','Débito','1420.00','-16780.51','202212191420001'),(29,'2022-12-22','MA MATERIAIS DE CONSTR ITAPEVA BR','','','','Débito','60.00','-16840.51','2022122260001'),(30,'2022-12-22','Recebimento Pix ASSOCIACAO DOS PROPR DO LOT RES ROSARIO 59.023.929 0001-89 NF 15','','','','Crédito','15734.74','-1105.77','2022122215734741'),(31,'2022-12-22','Contabilidade dezembro','','','','Débito','509.39','-1615.16','20221222509391'),(32,'2022-12-22','Contabilidade dezembro 13','','','','Débito','506.91','-2122.07','20221222506911'),(33,'2022-12-23','REM.: EDNEA APARECIDA GABELINI Transfer?ncia Pix EDNEA APARECIDA GABELINI 18.010.699 0001-36 Leandro','','','','Crédito','2000.00','-122.07','202212232000001'),(34,'2022-12-23','REM.: EDNEA APARECIDA GABELINI Transfer?ncia Pix EDNEA APARECIDA GABELINI 18.010.699 0001-36 Leandro','','','','Crédito','8000.00','7877.93','202212238000001'),(35,'2022-12-23','Pagamento Pix ***.578.966-** Pintor _obra 12','','','','Débito','1300.00','6577.93','202212231300001'),(36,'2022-12-26','Pagamento Pix ***.138.268-** Empreiteiro_obra 11','','','','Débito','6000.00','577.93','202212266000001'),(37,'2022-12-26','','','','','Débito','3340.32','-2762.39','202212263340321'),(38,'2022-12-26','Pagamento Pix ***.925.236-** Esqudrias_obra 21','','','','Débito','1000.00','-3762.39','202212261000001'),(39,'2022-12-26','Estorno Pix ***.925.236-** Esqudrias_obra 21','','','','Crédito','1000.00','-2762.39','202212261000002'),(40,'2022-12-26','Pagamento Pix ***.925.236-** Serralheiro_obra 21','','','','Débito','1000.00','-3762.39','202212261000003');
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notas_obra`
--

LOCK TABLES `notas_obra` WRITE;
/*!40000 ALTER TABLE `notas_obra` DISABLE KEYS */;
INSERT INTO `notas_obra` VALUES (1,1,'qwertyuiop');
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
  `cliente_obra` varchar(30) NOT NULL,
  `inicio_obra` date NOT NULL,
  `prazo_obra` varchar(5) NOT NULL,
  `valor_obra` varchar(20) NOT NULL,
  `endereco_obra` varchar(150) NOT NULL,
  `pagamento_obra` varchar(150) NOT NULL,
  PRIMARY KEY (`id_obra`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obras`
--

LOCK TABLES `obras` WRITE;
/*!40000 ALTER TABLE `obras` DISABLE KEYS */;
INSERT INTO `obras` VALUES (1,'Obra A - Cliente 1','2023-01-02','120','150.000,00','Rua x','Em 10X');
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

-- Dump completed on 2023-01-09 14:33:19
