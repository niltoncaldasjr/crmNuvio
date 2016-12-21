-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.6.15 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para crmnuvio
CREATE DATABASE IF NOT EXISTS `crmnuvio` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `crmnuvio`;

-- Copiando estrutura para tabela crmnuvio.banco
CREATE TABLE IF NOT EXISTS `banco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `codigoBancoCentral` varchar(5) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.banco: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `banco` DISABLE KEYS */;
INSERT INTO `banco` (`id`, `nome`, `codigoBancoCentral`, `datacadastro`, `dataedicao`) VALUES
	(1, 'Bradeco', '12345', '2015-08-03 18:54:10', '2015-08-20 01:04:17'),
	(2, 'Brasil', '9282', '2015-08-07 18:36:18', '2015-08-25 23:02:56'),
	(3, 'Caixa', '777', '2015-08-07 19:00:05', '2015-08-20 01:24:42');
/*!40000 ALTER TABLE `banco` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.contabanco
CREATE TABLE IF NOT EXISTS `contabanco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agencia` varchar(10) DEFAULT NULL,
  `digitoAgencia` char(1) DEFAULT NULL,
  `numeroConta` varchar(10) DEFAULT NULL,
  `digitoConta` char(1) DEFAULT NULL,
  `numeroCarteira` varchar(10) DEFAULT NULL,
  `numeroConvenio` varchar(10) DEFAULT NULL,
  `nomeContato` varchar(70) DEFAULT NULL,
  `telefoneContato` varchar(30) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idbanco` int(11) NOT NULL,
  `idempresa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contaBanco_banco1_idx` (`idbanco`),
  KEY `fk_contaBanco_empresa1_idx` (`idempresa`),
  CONSTRAINT `fk_contaBanco_banco1` FOREIGN KEY (`idbanco`) REFERENCES `banco` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contaBanco_empresa1` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.contabanco: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `contabanco` DISABLE KEYS */;
INSERT INTO `contabanco` (`id`, `agencia`, `digitoAgencia`, `numeroConta`, `digitoConta`, `numeroCarteira`, `numeroConvenio`, `nomeContato`, `telefoneContato`, `datacadastro`, `dataedicao`, `idbanco`, `idempresa`) VALUES
	(1, '002', '2', '122', '5', '2222', '222', 'gdgdgd', '288282', '2015-08-03 19:01:04', '2015-08-03 19:01:04', 1, 1),
	(2, '002', '2', '122', '5', '2222', '222', 'gdgdgd', '288282', '2015-08-03 19:01:04', '2015-08-03 19:01:04', 1, 1),
	(3, '002', '3', '8888', '6', '1516561', '67676', 'nilton', '98790870', '2015-08-03 19:01:31', '2015-08-25 00:54:15', 1, 1),
	(4, '003', '4', '1234', '5', '001', '012', 'Patricia', '9393939', '2015-08-07 19:01:16', '2015-08-07 19:01:16', 3, 1);
/*!40000 ALTER TABLE `contabanco` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.contatolead
CREATE TABLE IF NOT EXISTS `contatolead` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datacontato` datetime DEFAULT NULL,
  `descricao` text,
  `dataretorno` datetime DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idusuario` int(11) NOT NULL,
  `idlead` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contatolead_usuario_idx` (`idusuario`),
  KEY `fk_contatolead_lead1_idx` (`idlead`),
  CONSTRAINT `fk_contatolead_lead1` FOREIGN KEY (`idlead`) REFERENCES `lead` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contatolead_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.contatolead: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `contatolead` DISABLE KEYS */;
INSERT INTO `contatolead` (`id`, `datacontato`, `descricao`, `dataretorno`, `datacadastro`, `dataedicao`, `idusuario`, `idlead`) VALUES
	(1, '2015-08-03 00:00:00', 'Contactado para visista', '2015-08-28 00:00:00', '2015-08-03 18:53:02', '2015-08-03 18:53:02', 1, 1),
	(2, '2015-08-16 00:00:00', 'teste 33', '2015-08-26 00:00:00', '2015-08-06 18:53:59', '2015-08-25 00:57:50', 1, 1);
/*!40000 ALTER TABLE `contatolead` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.contatopf
CREATE TABLE IF NOT EXISTS `contatopf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtipocontato` int(11) DEFAULT NULL,
  `idoperadoracontato` int(11) DEFAULT NULL,
  `contato` varchar(50) DEFAULT NULL,
  `idpessoafisica` int(11) NOT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idpessoa` (`idpessoafisica`),
  KEY `tipo` (`idtipocontato`),
  KEY `operadora` (`idoperadoracontato`),
  CONSTRAINT `contatopf_ibfk_1` FOREIGN KEY (`idtipocontato`) REFERENCES `tipocontato` (`id`),
  CONSTRAINT `contatopf_ibfk_2` FOREIGN KEY (`idoperadoracontato`) REFERENCES `operadoracontato` (`id`),
  CONSTRAINT `contato_pf_ibfk_1` FOREIGN KEY (`idpessoafisica`) REFERENCES `pessoafisica` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.contatopf: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `contatopf` DISABLE KEYS */;
INSERT INTO `contatopf` (`id`, `idtipocontato`, `idoperadoracontato`, `contato`, `idpessoafisica`, `datacadastro`, `dataedicao`) VALUES
	(1, 1, 1, '991364363', 1, '2015-09-04 17:03:50', '2015-09-04 17:03:50'),
	(2, 2, 3, 'paulo@gmail.com', 1, '2015-09-04 17:04:05', '2015-09-04 17:04:05'),
	(3, 1, 2, '981440856', 7, '2015-09-11 17:52:29', '2015-09-11 17:52:29'),
	(4, 2, 3, 'niltonbox@gmail.com', 7, '2015-09-11 17:54:35', '2015-09-11 17:54:35');
/*!40000 ALTER TABLE `contatopf` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.documentopf
CREATE TABLE IF NOT EXISTS `documentopf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('RG','CNH','CTPS','PASSAPORTE','OUTROS') DEFAULT NULL,
  `numero` varchar(30) DEFAULT NULL,
  `dataemissao` datetime DEFAULT NULL,
  `orgaoemissor` varchar(30) DEFAULT NULL,
  `via` int(11) DEFAULT NULL,
  `idpessoafisica` int(11) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idpessoa` (`idpessoafisica`),
  CONSTRAINT `documentos_pf_ibfk_1` FOREIGN KEY (`idpessoafisica`) REFERENCES `pessoafisica` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.documentopf: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `documentopf` DISABLE KEYS */;
INSERT INTO `documentopf` (`id`, `tipo`, `numero`, `dataemissao`, `orgaoemissor`, `via`, `idpessoafisica`, `datacadastro`, `dataedicao`) VALUES
	(1, 'RG', '12345', '2015-08-04 00:00:00', 'SSP-AM', 1, 1, '2015-08-28 18:24:56', '2015-08-28 18:24:56'),
	(2, 'CNH', '4242424', '2015-08-09 20:00:00', 'DETRAN-AM', 1, 1, '2015-08-31 10:29:18', '2015-08-31 10:29:18'),
	(3, 'RG', '12345678', '2015-09-08 20:00:00', 'SSP-AM', 1, 7, '2015-09-11 17:52:53', '2015-09-11 17:52:53');
/*!40000 ALTER TABLE `documentopf` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomeFantasia` varchar(70) DEFAULT NULL,
  `razaoSocial` varchar(70) DEFAULT NULL,
  `nomeReduzido` varchar(40) DEFAULT NULL,
  `CNPJ` varchar(15) DEFAULT NULL,
  `inscricaoEstadual` varchar(15) DEFAULT NULL,
  `inscricaoMunicipal` varchar(15) DEFAULT NULL,
  `endereco` varchar(60) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(70) DEFAULT NULL,
  `bairro` varchar(60) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `imagemLogotipo` varchar(45) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idlocalidade` int(11) NOT NULL,
  `idimposto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_empresa_localidade1_idx` (`idlocalidade`),
  KEY `fk_empresa_imposto1_idx` (`idimposto`),
  CONSTRAINT `fk_empresa_imposto1` FOREIGN KEY (`idimposto`) REFERENCES `imposto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_localidade1` FOREIGN KEY (`idlocalidade`) REFERENCES `localidade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.empresa: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` (`id`, `nomeFantasia`, `razaoSocial`, `nomeReduzido`, `CNPJ`, `inscricaoEstadual`, `inscricaoMunicipal`, `endereco`, `numero`, `complemento`, `bairro`, `cep`, `imagemLogotipo`, `datacadastro`, `dataedicao`, `idlocalidade`, `idimposto`) VALUES
	(1, 'Akto', 'Akto', 'Akto', '11111111', '11111', '11111', 'teste de Akto', '111', 'Tetet', 'Centro', '6900000', '11111111.png', '2015-07-30 18:56:28', '2015-08-18 23:08:44', 1, 1),
	(11, 'Nuvio', 'Nuvio', 'Nuvio', '22222222', '22222', '22222', 'Teste Nuvio', '222', 'Teste 2', 'Centro', '6900000', '22222222.png', '2015-08-04 18:57:59', '2015-08-25 00:08:17', 1, 1),
	(12, 'bemol', 'bemol', 'bemol', '3333333', '33333222', '33333', 'Teste 3', '3333', 'Teste Completro', 'Centro', '6900000', '3333333.png', '2015-08-04 19:23:34', '2015-08-25 00:08:40', 1, 1),
	(13, 'vap', 'vap', 'vap', '44444', '44444', '44444', 'hjkhkh', '6666', 'kjhkhkh', 'centro', '690000', '44444.png', '2015-08-07 18:44:37', '2015-08-08 00:08:12', 1, 1),
	(15, 'teste 5', 'testedfsffsdfjjjjj', 'teste 5', '66666666', '7666666', '666666', 'bkbjhg', '8787', 'mmkbb', 'hkjhk', '789798', '66666666.png', '2015-08-07 18:53:49', '2015-08-10 23:08:08', 1, 1);
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.empresausuario
CREATE TABLE IF NOT EXISTS `empresausuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idempresa` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_prestadorausuario_prestadora1_idx` (`idempresa`),
  KEY `fk_prestadorausuario_usuario1_idx` (`idusuario`),
  CONSTRAINT `fk_prestadorausuario_prestadora1` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_prestadorausuario_usuario1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.empresausuario: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `empresausuario` DISABLE KEYS */;
INSERT INTO `empresausuario` (`id`, `idempresa`, `idusuario`, `datacadastro`) VALUES
	(3, 1, 1, '2015-08-04 18:51:17'),
	(6, 1, 5, '2015-08-05 19:26:43'),
	(8, 11, 1, '2015-08-18 17:13:50'),
	(9, 12, 1, '2015-08-18 17:13:50'),
	(10, 11, 2, '2015-08-19 18:53:15'),
	(11, 15, 5, '2015-08-24 18:48:08'),
	(12, 1, 6, '2015-08-25 16:31:22'),
	(13, 11, 6, '2015-08-25 16:56:00');
/*!40000 ALTER TABLE `empresausuario` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.enderecopf
CREATE TABLE IF NOT EXISTS `enderecopf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtipoendereco` int(11) NOT NULL,
  `logradouro` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `idlocalidade` int(11) NOT NULL,
  `idpessoafisica` int(11) NOT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idpessoa` (`idpessoafisica`),
  KEY `idlocalidade` (`idlocalidade`),
  KEY `endereco_pf_ibfk_3` (`idtipoendereco`),
  CONSTRAINT `endereco_pf_ibfk_1` FOREIGN KEY (`idpessoafisica`) REFERENCES `pessoafisica` (`id`),
  CONSTRAINT `endereco_pf_ibfk_2` FOREIGN KEY (`idlocalidade`) REFERENCES `localidade` (`id`),
  CONSTRAINT `endereco_pf_ibfk_3` FOREIGN KEY (`idtipoendereco`) REFERENCES `tipoendereco` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.enderecopf: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `enderecopf` DISABLE KEYS */;
INSERT INTO `enderecopf` (`id`, `idtipoendereco`, `logradouro`, `numero`, `complemento`, `bairro`, `cep`, `idlocalidade`, `idpessoafisica`, `datacadastro`, `dataedicao`) VALUES
	(7, 1, 'Rua 7', '123', 'Data', 'Centro', '690000', 1, 1, '2015-09-04 17:04:42', '2015-09-04 17:04:42'),
	(8, 1, 'AV. 7 de Stembro', '877', 'Centro', 'Centro', '690000', 1, 7, '2015-09-11 17:53:43', '2015-09-11 17:53:43');
/*!40000 ALTER TABLE `enderecopf` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.imposto
CREATE TABLE IF NOT EXISTS `imposto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(70) DEFAULT NULL,
  `aliquotaICMS` decimal(10,2) DEFAULT NULL,
  `aliquotaPIS` decimal(10,2) DEFAULT NULL,
  `aliquotaCOFINS` decimal(10,2) DEFAULT NULL,
  `aliquotaCSLL` decimal(10,2) DEFAULT NULL,
  `aliquotaISS` decimal(10,2) DEFAULT NULL,
  `aliquotaIRPJ` decimal(10,2) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='				';

-- Copiando dados para a tabela crmnuvio.imposto: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `imposto` DISABLE KEYS */;
INSERT INTO `imposto` (`id`, `titulo`, `aliquotaICMS`, `aliquotaPIS`, `aliquotaCOFINS`, `aliquotaCSLL`, `aliquotaISS`, `aliquotaIRPJ`, `datacadastro`, `dataedicao`) VALUES
	(1, 'Simples', 1.00, 2.00, 1.00, 2.00, 1.00, 2.00, '2015-07-30 18:55:22', '2015-08-08 01:02:48'),
	(2, 'Presumido', 2.00, 1.00, 2.00, 1.00, 2.00, 1.00, '2015-08-03 19:08:17', '2015-08-08 01:01:49');
/*!40000 ALTER TABLE `imposto` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.lead
CREATE TABLE IF NOT EXISTS `lead` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `contato` varchar(100) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ativo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.lead: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `lead` DISABLE KEYS */;
INSERT INTO `lead` (`id`, `empresa`, `email`, `telefone`, `contato`, `datacadastro`, `dataedicao`, `ativo`) VALUES
	(1, 'Empresa de Teste', 'teste@gmail.com', '32494949', 'Nilton caldas', '2015-08-03 18:52:14', '2015-08-03 18:52:14', 1),
	(2, 'Nilton', 'sdfsfs', '4', 'fgdgdgd', '2015-08-10 17:21:49', '2015-08-10 23:35:41', 1),
	(3, 'Akto', 'akto@gasgs', '65454', 'Giovanni', '2015-08-10 17:36:10', '2015-08-10 17:36:10', 1);
/*!40000 ALTER TABLE `lead` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.localidade
CREATE TABLE IF NOT EXISTS `localidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigoIBGE` int(11) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idpais` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_localidade_pais1_idx` (`idpais`),
  CONSTRAINT `fk_localidade_pais1` FOREIGN KEY (`idpais`) REFERENCES `pais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.localidade: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `localidade` DISABLE KEYS */;
INSERT INTO `localidade` (`id`, `codigoIBGE`, `uf`, `cidade`, `datacadastro`, `dataedicao`, `idpais`) VALUES
	(1, 12345, 'AM', 'Manaus', '2015-07-30 18:55:06', '2015-07-30 18:55:06', 1),
	(2, 54321, 'AM', 'Itactoatiara', '2015-08-07 19:03:52', '2015-08-07 19:03:52', 1);
/*!40000 ALTER TABLE `localidade` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.logsistema
CREATE TABLE IF NOT EXISTS `logsistema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nivel` enum('BÁSICO','MODERADO','CRÍTICO') NOT NULL,
  `acao` enum('INCLUIR','ALTERAR','EXCLUIR','ESTORNAR','ROWBACK','OUTRA') NOT NULL,
  `class` varchar(30) NOT NULL,
  `idregistro` int(11) NOT NULL,
  `antes` text NOT NULL,
  `depois` text NOT NULL,
  `datacadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idusuario` (`idusuario`),
  CONSTRAINT `logsistema_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela crmnuvio.logsistema: ~45 rows (aproximadamente)
/*!40000 ALTER TABLE `logsistema` DISABLE KEYS */;
INSERT INTO `logsistema` (`id`, `nivel`, `acao`, `class`, `idregistro`, `antes`, `depois`, `datacadastro`, `idusuario`) VALUES
	(1, 'MODERADO', 'ALTERAR', 'Banco', 1, '{"id":"1","nome":"Bradesco","codigoBancoCentral":"12345","datacadastro":"2015-08-03 18:54:10","dataedicao":"2015-08-04 00:54:36"}', '{"id":1,"nome":"Bradeco","codigoBancoCentral":"12345","datacadastro":"2015-08-03T18:54:10-04:00","dataedicao":"2015-08-04T00:54:36-04:00"}', '2015-08-17 18:04:17', 1),
	(2, 'MODERADO', 'ALTERAR', 'Banco', 2, '{"id":"2","nome":"Brasil","codigoBancoCentral":"9282","datacadastro":"2015-08-07 18:36:18","dataedicao":"2015-08-07 18:36:18"}', '{"id":2,"nome":"Brasilia","codigoBancoCentral":"9282","datacadastro":"2015-08-07T18:36:18-04:00","dataedicao":"2015-08-07T18:36:18-04:00"}', '2015-08-17 18:04:25', 1),
	(3, 'MODERADO', 'ALTERAR', 'Banco', 3, '{"id":"3","nome":"Caixa Economica","codigoBancoCentral":"777","datacadastro":"2015-08-07 19:00:05","dataedicao":"2015-08-07 19:00:05"}', '{"id":3,"nome":"CEF","codigoBancoCentral":"777","datacadastro":"2015-08-07T19:00:05-04:00","dataedicao":"2015-08-07T19:00:05-04:00"}', '2015-08-18 19:04:33', 1),
	(4, 'BÁSICO', 'INCLUIR', 'Banco', 4, '{"id":4,"nome":"CEF","codigoBancoCentral":"4342","datacadastro":null,"dataedicao":null}', '{"id":4,"nome":"CEF","codigoBancoCentral":"4342","datacadastro":null,"dataedicao":null}', '2015-08-18 19:07:33', 1),
	(5, 'CRÍTICO', 'EXCLUIR', 'Banco', 4, '{"id":"4","nome":"CEF","codigoBancoCentral":"4342","datacadastro":"2015-08-19 19:07:33","dataedicao":"2015-08-19 19:07:33"}', '{"id":4,"nome":"CEF","codigoBancoCentral":"4342","datacadastro":"2015-08-19T19:07:33-04:00","dataedicao":"2015-08-19T19:07:33-04:00"}', '2015-08-19 19:09:17', 1),
	(6, 'MODERADO', 'ALTERAR', 'Banco', 3, '{"id":"3","nome":"CEF","codigoBancoCentral":"777","datacadastro":"2015-08-07 19:00:05","dataedicao":"2015-08-20 01:04:33"}', '{"id":3,"nome":"Caixa","codigoBancoCentral":"777","datacadastro":"2015-08-07T19:00:05-04:00","dataedicao":"2015-08-20T01:04:33-04:00"}', '2015-08-19 19:24:42', 5),
	(7, 'BÁSICO', 'INCLUIR', 'Banco', 5, '{"id":5,"nome":"Itau","codigoBancoCentral":"222","datacadastro":null,"dataedicao":null}', '{"id":5,"nome":"Itau","codigoBancoCentral":"222","datacadastro":null,"dataedicao":null}', '2015-08-19 19:25:02', 5),
	(8, 'MODERADO', 'ALTERAR', 'Empresa', 11, '{"id":"11","nomeFantasia":"Nuvio","razaoSocial":"Nuvio","nomeReduzido":"Nuvio","CNPJ":"22222222","inscricaoEstadual":"22222","inscricaoMunicipal":"22222","endereco":"Teste Nuvio","numero":"222","complemento":"Teste 2","bairro":"Centro","cep":"6900000","imagemLogotipo":"22222222.png","datacadastro":"2015-08-04 18:57:59","dataedicao":"2015-08-18 01:08:04","idlocalidade":{"id":"1","codigoIBGE":"12345","uf":"AM","cidade":"Manaus","datacadastro":"2015-07-30 18:55:06","dataedicao":"2015-07-30 18:55:06","idpais":{"id":"1","descricao":"Brasil","nacionalidade":"Brasileiro","datacadastro":"2015-07-31 00:54:20","dataedicao":"2015-07-31 00:54:20"}},"idimposto":{"id":"1","titulo":"1.00","aliquotaICMS":"2.00","aliquotaPIS":"1.00","aliquotaCOFINS":"2.00","aliquotaCSLL":"1.00","aliquotaISS":"2.00","aliquotaIRPJ":"2015-07-30 18:55:22","datacadastro":"2015-08-08 01:02:48","dataedicao":null}}', '{"id":"11","nomeFantasia":"Nuvio","razaoSocial":"Nuvio","nomeReduzido":"Nuvio","CNPJ":"22222222","inscricaoEstadual":"22222","inscricaoMunicipal":"22222","endereco":"Teste Nuvio","numero":"222","complemento":"Teste 2","bairro":"Centro","cep":"6900000","imagemLogotipo":"22222222.png","datacadastro":null,"dataedicao":"2015-08-25 00:08:17","idlocalidade":{"id":"1","codigoIBGE":null,"uf":null,"cidade":null,"datacadastro":null,"dataedicao":null,"idpais":null},"idimposto":{"id":"1","titulo":null,"aliquotaICMS":null,"aliquotaPIS":null,"aliquotaCOFINS":null,"aliquotaCSLL":null,"aliquotaISS":null,"aliquotaIRPJ":null,"datacadastro":null,"dataedicao":null}}', '2015-08-24 18:15:17', 1),
	(9, 'MODERADO', 'ALTERAR', 'Usuario', 5, '{"id":"5","nome":"Nilton","usuario":"ncaldas","senha":"d9b1d7db4cd6e70935368a1efb10e377","email":"nilton@teste","ativo":"0","dataCadastro":"2015-08-19 18:34:30","dataEdicao":"2015-08-19 18:34:30","perfil":{"id":"2","nome":"tester","ativo":null,"dataCadastro":"2015-07-30 18:53:30","dataEdicao":"2015-07-30 18:53:30"},"PessoaFisica":{"id":"7","nome":"NILTON CALDAS","cpf":"123456789","datanascimento":"2015-07-14","estadocivil":"CASADO","sexo":"MASCULINO","nomepai":"NILTON CALDAS","nomemae":"MARIA LUCIA","cor":"BRANCA","naturalidade":"MANAUS","nacionalidade":"BRASILEIRO","datacadastro":"2015-08-03 19:39:58","dataedicao":"2015-08-07 00:48:15"}}', '{"id":5,"nome":"Nilton","usuario":"ncaldas","senha":"d9b1d7db4cd6e70935368a1efb10e377","email":"nilton@teste","ativo":0,"dataCadastro":null,"dataEdicao":"2015-08-25 00:25:29","perfil":{"id":5,"nome":null,"ativo":null,"dataCadastro":null,"dataEdicao":null},"PessoaFisica":{"id":7,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null}}', '2015-08-24 18:25:29', 1),
	(10, 'BÁSICO', 'INCLUIR', 'Perfil', 6, '{"id":6,"nome":"teste","ativo":0,"dataCadastro":null,"dataEdicao":null}', '{"id":6,"nome":"teste","ativo":0,"dataCadastro":null,"dataEdicao":null}', '2015-08-24 18:29:26', 1),
	(11, 'BÁSICO', 'INCLUIR', 'Perfil', 7, '{"id":7,"nome":"teste 2","ativo":0,"dataCadastro":null,"dataEdicao":null}', '{"id":7,"nome":"teste 2","ativo":0,"dataCadastro":null,"dataEdicao":null}', '2015-08-24 18:32:43', 1),
	(12, 'MODERADO', 'ALTERAR', 'Empresa', 12, '{"id":"12","nomeFantasia":"bemol","razaoSocial":"bemol","nomeReduzido":"bemol","CNPJ":"3333333","inscricaoEstadual":"33333","inscricaoMunicipal":"33333","endereco":"Teste 3","numero":"3333","complemento":"Teste Completro","bairro":"Centro","cep":"6900000","imagemLogotipo":"3333333.png","datacadastro":"2015-08-04 19:23:34","dataedicao":"2015-08-08 00:08:36","idlocalidade":{"id":"1","codigoIBGE":"12345","uf":"AM","cidade":"Manaus","datacadastro":"2015-07-30 18:55:06","dataedicao":"2015-07-30 18:55:06","idpais":{"id":"1","descricao":"Brasil","nacionalidade":"Brasileiro","datacadastro":"2015-07-31 00:54:20","dataedicao":"2015-07-31 00:54:20"}},"idimposto":{"id":"1","titulo":"1.00","aliquotaICMS":"2.00","aliquotaPIS":"1.00","aliquotaCOFINS":"2.00","aliquotaCSLL":"1.00","aliquotaISS":"2.00","aliquotaIRPJ":"2015-07-30 18:55:22","datacadastro":"2015-08-08 01:02:48","dataedicao":null}}', '{"id":"12","nomeFantasia":"bemol","razaoSocial":"bemol","nomeReduzido":"bemol","CNPJ":"3333333","inscricaoEstadual":"33333222","inscricaoMunicipal":"33333","endereco":"Teste 3","numero":"3333","complemento":"Teste Completro","bairro":"Centro","cep":"6900000","imagemLogotipo":"3333333.png","datacadastro":null,"dataedicao":"2015-08-25 00:08:40","idlocalidade":{"id":"1","codigoIBGE":null,"uf":null,"cidade":null,"datacadastro":null,"dataedicao":null,"idpais":null},"idimposto":{"id":"1","titulo":null,"aliquotaICMS":null,"aliquotaPIS":null,"aliquotaCOFINS":null,"aliquotaCSLL":null,"aliquotaISS":null,"aliquotaIRPJ":null,"datacadastro":null,"dataedicao":null}}', '2015-08-24 18:52:40', 1),
	(13, 'MODERADO', 'ALTERAR', 'ContaBanco', 3, '{"id":"3","agencia":"002","digitoAgencia":"3","numeroConta":"8888","digitoConta":"6","numeroCarteira":"1516561","numeroConvenio":"67676","nomeContato":"njkjhikh","telefoneContato":"98790870","datacadastro":"2015-08-03 19:01:31","dataedicao":"2015-08-03 19:01:31","objBanco":{"id":"1","nome":"Bradeco","codigoBancoCentral":"12345","datacadastro":"2015-08-03 18:54:10","dataedicao":"2015-08-20 01:04:17"},"objEmpresa":{"id":"1","nomeFantasia":"Akto","razaoSocial":"Akto","nomeReduzido":"Akto","CNPJ":"11111111","inscricaoEstadual":"11111","inscricaoMunicipal":"11111","endereco":"teste de Akto","numero":"111","complemento":"Tetet","bairro":"Centro","cep":"6900000","imagemLogotipo":"11111111.png","datacadastro":"2015-07-30 18:56:28","dataedicao":"2015-08-18 23:08:44","idlocalidade":{"id":"1","codigoIBGE":"12345","uf":"AM","cidade":"Manaus","datacadastro":"2015-07-30 18:55:06","dataedicao":"2015-07-30 18:55:06","idpais":{"id":"1","descricao":"Brasil","nacionalidade":"Brasileiro","datacadastro":"2015-07-31 00:54:20","dataedicao":"2015-07-31 00:54:20"}},"idimposto":{"id":"1","titulo":"1.00","aliquotaICMS":"2.00","aliquotaPIS":"1.00","aliquotaCOFINS":"2.00","aliquotaCSLL":"1.00","aliquotaISS":"2.00","aliquotaIRPJ":"2015-07-30 18:55:22","datacadastro":"2015-08-08 01:02:48","dataedicao":null}}}', '{"id":3,"agencia":"002","digitoAgencia":3,"numeroConta":"8888","digitoConta":6,"numeroCarteira":"1516561","numeroConvenio":"67676","nomeContato":"nilton","telefoneContato":"98790870","datacadastro":"2015-08-03T19:01:31-04:00","dataedicao":"2015-08-03T19:01:31-04:00","idbanco":1,"idempresa":1}', '2015-08-24 18:54:15', 1),
	(14, 'MODERADO', 'ALTERAR', 'ContatoLead', 2, '{"id":"2","datacontato":"2015-08-06 00:00:00","descricao":"teste 33","dataretorno":"2015-08-08 00:00:00","datacadastro":"2015-08-06 18:53:59","dataeedicao":"2015-08-06 18:53:59","objUsuario":{"id":"1","nome":"Paulo Adm","usuario":"admin","senha":"c3284d0f94606de1fd2af172aba15bf3","email":"admin@admin.com.br","ativo":"1","dataCadastro":"2015-07-30 18:53:30","dataEdicao":"2015-07-31 00:59:13","perfil":{"id":"1","nome":"admin","ativo":null,"dataCadastro":"2015-07-30 18:53:30","dataEdicao":"2015-07-30 18:53:30"},"PessoaFisica":{"id":"1","nome":"Paulo Adm","cpf":"7655413","datanascimento":"2015-07-02","estadocivil":"SOLTEIRO","sexo":"MASCULINO","nomepai":"teste pai","nomemae":"teste mae","cor":"BRANCA","naturalidade":"manaus","nacionalidade":"brasil","datacadastro":"2015-07-30 18:53:30","dataedicao":"2015-08-07 00:51:00"}},"objLead":{"id":"1","empresa":"Empresa de Teste","email":"teste@gmail.com","telefone":"32494949","contato":"Nilton caldas","datacadastro":"2015-08-03 18:52:14","dataedicao":"2015-08-03 18:52:14","ativo":"1"}}', '{"id":2,"datacontato":"2015-08-16T20:00:00","descricao":"teste 33","dataretorno":"2015-08-26T20:00:00","datacadastro":"2015-08-06T18:53:59-04:00","dataedicao":"2015-08-06T18:53:59-04:00","idusuario":1,"idlead":1}', '2015-08-24 18:57:50', 1),
	(15, 'CRÍTICO', 'EXCLUIR', 'Banco', 5, '{"id":"5","nome":"Itau","codigoBancoCentral":"222","datacadastro":"2015-08-19 19:25:02","dataedicao":"2015-08-19 19:25:02"}', '{"id":5,"nome":"Itau","codigoBancoCentral":"222","datacadastro":"2015-08-19T19:25:02-04:00","dataedicao":"2015-08-19T19:25:02-04:00"}', '2015-08-25 15:35:49', 1),
	(16, 'BÁSICO', 'INCLUIR', 'Banco', 6, '{"id":6,"nome":"Itau","codigoBancoCentral":"545","datacadastro":null,"dataedicao":null}', '{"id":6,"nome":"Itau","codigoBancoCentral":"545","datacadastro":null,"dataedicao":null}', '2015-08-25 15:37:52', 1),
	(17, 'CRÍTICO', 'EXCLUIR', 'Banco', 6, '{"id":"6","nome":"Itau","codigoBancoCentral":"545","datacadastro":"2015-08-25 15:37:52","dataedicao":"2015-08-25 15:37:52"}', '{"id":6,"nome":"Itau","codigoBancoCentral":"545","datacadastro":"2015-08-25T15:37:52-04:00","dataedicao":"2015-08-25T15:37:52-04:00"}', '2015-08-25 15:38:06', 1),
	(18, 'BÁSICO', 'INCLUIR', 'Perfil', 6, '{"id":6,"nome":"Full","ativo":0,"dataCadastro":null,"dataEdicao":null}', '{"id":6,"nome":"Full","ativo":0,"dataCadastro":null,"dataEdicao":null}', '2015-08-25 15:39:28', 1),
	(19, 'MODERADO', 'ALTERAR', 'Perfil', 6, '{"id":"6","nome":"Full","ativo":"0","dataCadastro":"2015-08-25 15:39:28","dataEdicao":"2015-08-25 15:39:28"}', '{"id":6,"nome":"Estado","ativo":0,"dataCadastro":null,"dataEdicao":"2015-08-25 21:39:42"}', '2015-08-25 15:39:42', 1),
	(20, 'BÁSICO', 'INCLUIR', 'Perfil', 7, '{"id":7,"nome":"Fukll","ativo":0,"dataCadastro":null,"dataEdicao":null}', '{"id":7,"nome":"Fukll","ativo":0,"dataCadastro":null,"dataEdicao":null}', '2015-08-25 15:39:53', 1),
	(21, 'CRÍTICO', 'EXCLUIR', 'Perfil', 7, '{"id":"7","nome":"Fukll","ativo":"0","dataCadastro":"2015-08-25 15:39:53","dataEdicao":"2015-08-25 15:39:53"}', '{"id":7,"nome":"Fukll","ativo":0,"dataCadastro":null,"dataEdicao":"2015-08-25 21:40:15"}', '2015-08-25 15:40:15', 1),
	(22, 'BÁSICO', 'INCLUIR', 'Banco', 7, '{"id":7,"nome":"Itau","codigoBancoCentral":"655","datacadastro":null,"dataedicao":null}', '{"id":7,"nome":"Itau","codigoBancoCentral":"655","datacadastro":null,"dataedicao":null}', '2015-08-25 15:51:54', 1),
	(23, 'CRÍTICO', 'EXCLUIR', 'Banco', 7, '{"id":"7","nome":"Itau","codigoBancoCentral":"655","datacadastro":"2015-08-25 15:51:54","dataedicao":"2015-08-25 15:51:54"}', '{"id":7,"nome":"Itau","codigoBancoCentral":"655","datacadastro":"2015-08-25T15:51:54-04:00","dataedicao":"2015-08-25T15:51:54-04:00"}', '2015-08-25 15:52:04', 1),
	(24, 'CRÍTICO', 'EXCLUIR', 'Perfil', 6, '{"id":"6","nome":"Estado","ativo":"0","dataCadastro":"2015-08-25 15:39:28","dataEdicao":"2015-08-25 21:39:42"}', '{"id":6,"nome":"Estado","ativo":0,"dataCadastro":null,"dataEdicao":"2015-08-25 22:17:17"}', '2015-08-25 16:17:17', 1),
	(25, 'BÁSICO', 'INCLUIR', 'Perfil', 8, '{"id":8,"nome":"Super","ativo":0,"dataCadastro":null,"dataEdicao":null}', '{"id":8,"nome":"Super","ativo":0,"dataCadastro":null,"dataEdicao":null}', '2015-08-25 16:17:29', 1),
	(26, 'BÁSICO', 'INCLUIR', 'Usuario', 6, '{"id":6,"nome":"Givanni","usuario":"gio","senha":"202cb962ac59075b964b07152d234b70","email":"gio@akto.com","ativo":0,"dataCadastro":null,"dataEdicao":null,"perfil":{"id":1,"nome":null,"ativo":null,"dataCadastro":null,"dataEdicao":null},"PessoaFisica":{"id":10,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null}}', '{"id":6,"nome":"Givanni","usuario":"gio","senha":"202cb962ac59075b964b07152d234b70","email":"gio@akto.com","ativo":0,"dataCadastro":null,"dataEdicao":null,"perfil":{"id":1,"nome":null,"ativo":null,"dataCadastro":null,"dataEdicao":null},"PessoaFisica":{"id":10,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null}}', '2015-08-25 16:31:22', 1),
	(27, 'MODERADO', 'ALTERAR', 'Banco', 2, '{"id":"2","nome":"Brasilia","codigoBancoCentral":"9282","datacadastro":"2015-08-07 18:36:18","dataedicao":"2015-08-20 01:04:25"}', '{"id":2,"nome":"Brasil","codigoBancoCentral":"9282","datacadastro":"2015-08-07T18:36:18-04:00","dataedicao":"2015-08-20T01:04:25-04:00"}', '2015-08-25 17:02:56', 1),
	(28, 'BÁSICO', 'INCLUIR', 'Banco', 8, '{"id":8,"nome":"Itau","codigoBancoCentral":"565","datacadastro":null,"dataedicao":null}', '{"id":8,"nome":"Itau","codigoBancoCentral":"565","datacadastro":null,"dataedicao":null}', '2015-08-25 17:07:57', 1),
	(29, 'CRÍTICO', 'EXCLUIR', 'Banco', 8, '{"id":"8","nome":"Itau","codigoBancoCentral":"565","datacadastro":"2015-08-25 17:07:57","dataedicao":"2015-08-25 17:07:57"}', '{"id":8,"nome":"Itau","codigoBancoCentral":"565","datacadastro":"2015-08-25T17:07:57-04:00","dataedicao":"2015-08-25T17:07:57-04:00"}', '2015-08-25 17:08:09', 1),
	(30, 'BÁSICO', 'INCLUIR', 'Pais', 4, '{"id":4,"descricao":"Peru","nacionalidade":"Peruano","datacadastro":null,"dataedicao":null}', '{"id":4,"descricao":"Peru","nacionalidade":"Peruano","datacadastro":null,"dataedicao":null}', '2015-08-26 19:38:33', 1),
	(31, 'BÁSICO', 'INCLUIR', 'ContatoPF', 1, '{"id":1,"tipo":"Telefone","operadora":"TIM","pessoafisica":{"id":1,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '{"id":1,"tipo":"Telefone","operadora":"TIM","pessoafisica":{"id":1,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '2015-08-27 19:38:10', 1),
	(32, 'BÁSICO', 'INCLUIR', 'ContatoPF', 2, '{"id":2,"tipo":"Telefone","operadora":"VIVO","pessoafisica":{"id":1,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '{"id":2,"tipo":"Telefone","operadora":"VIVO","pessoafisica":{"id":1,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '2015-08-27 19:38:41', 1),
	(33, 'BÁSICO', 'INCLUIR', 'ContatoPF', 3, '{"id":3,"tipo":"Celulra","operadora":"TIM","pessoafisica":{"id":2,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '{"id":3,"tipo":"Celulra","operadora":"TIM","pessoafisica":{"id":2,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '2015-08-27 19:38:56', 1),
	(34, 'MODERADO', 'ALTERAR', 'ContatoPF', 3, '{"id":"3","tipo":"Celulra","operadora":"TIM","contato":"98123232","pessoafisica":{"id":"2","nome":"Carlos Testador","cpf":"6544321","datanascimento":"2015-07-30","estadocivil":"CASADO","sexo":"MASCULINO","nomepai":"teste pai","nomemae":"teste mae","cor":"BRANCA","naturalidade":"manaus","nacionalidade":"brasil","datacadastro":"2015-07-30 18:53:30","dataedicao":"2015-08-06 23:36:20"},"datacadastro":"2015-08-27 19:38:56","dataedicao":"2015-08-27 19:38:56"}', '{"id":3,"tipo":"Celular","operadora":"TIM","contato":"98123232","idpessoafisica":2,"datacadastro":"2015-08-27T19:38:56-04:00","dataedicao":"2015-08-27T19:38:56-04:00"}', '2015-08-28 18:24:26', 1),
	(35, 'BÁSICO', 'INCLUIR', 'DocumentoPF', 1, '{"id":1,"tipo":"RG","numero":"12345","dataemissao":"20150804","orgaoemissor":"SSP-AM","via":"1","pessoafisica":{"id":1,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '{"id":1,"tipo":"RG","numero":"12345","dataemissao":"20150804","orgaoemissor":"SSP-AM","via":"1","pessoafisica":{"id":1,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '2015-08-28 18:24:56', 1),
	(36, 'BÁSICO', 'INCLUIR', 'EnderecoPF', 1, '{"id":1,"tipo":"RUA","logradouro":"30","numero":"230","complemento":"Teste","bairro":"Centro","cep":"690000","idlocalidade":{"id":1,"codigoIBGE":null,"uf":null,"cidade":null,"datacadastro":null,"dataedicao":null,"idpais":null},"idpessoafisica":{"id":1,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '{"id":1,"tipo":"RUA","logradouro":"30","numero":"230","complemento":"Teste","bairro":"Centro","cep":"690000","idlocalidade":{"id":1,"codigoIBGE":null,"uf":null,"cidade":null,"datacadastro":null,"dataedicao":null,"idpais":null},"idpessoafisica":{"id":1,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '2015-08-28 18:25:24', 1),
	(37, 'BÁSICO', 'INCLUIR', 'DocumentoPF', 2, '{"id":2,"tipo":"CNH","numero":"4242424","dataemissao":"20150809200000","orgaoemissor":"DETRAN-AM","via":"1","pessoafisica":{"id":1,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '{"id":2,"tipo":"CNH","numero":"4242424","dataemissao":"20150809200000","orgaoemissor":"DETRAN-AM","via":"1","pessoafisica":{"id":1,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '2015-08-31 10:29:18', 1),
	(38, 'BÁSICO', 'INCLUIR', 'ContatoPF', 1, '{"id":1,"idtipocontato":{"id":1,"descricao":null,"datacadastro":null,"dataedicao":null},"idoperadoracontato":{"id":1,"descricao":null,"datacadastro":null,"dataedicao":null},"contato":"991364363","idpessoafisica":{"id":1,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '{"id":1,"idtipocontato":{"id":1,"descricao":null,"datacadastro":null,"dataedicao":null},"idoperadoracontato":{"id":1,"descricao":null,"datacadastro":null,"dataedicao":null},"contato":"991364363","idpessoafisica":{"id":1,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '2015-09-04 17:03:50', 1),
	(39, 'BÁSICO', 'INCLUIR', 'ContatoPF', 2, '{"id":2,"idtipocontato":{"id":2,"descricao":null,"datacadastro":null,"dataedicao":null},"idoperadoracontato":{"id":3,"descricao":null,"datacadastro":null,"dataedicao":null},"contato":"paulo@gmail.com","idpessoafisica":{"id":1,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '{"id":2,"idtipocontato":{"id":2,"descricao":null,"datacadastro":null,"dataedicao":null},"idoperadoracontato":{"id":3,"descricao":null,"datacadastro":null,"dataedicao":null},"contato":"paulo@gmail.com","idpessoafisica":{"id":1,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '2015-09-04 17:04:05', 1),
	(40, 'BÁSICO', 'INCLUIR', 'EnderecoPF', 7, '{"id":7,"idtipoendereco":{"id":1,"descricao":null,"datacadastro":null,"dataedicao":null},"logradouro":"Rua 7","numero":"123","complemento":"Data","bairro":"Centro","cep":"690000","idlocalidade":{"id":1,"codigoIBGE":null,"uf":null,"cidade":null,"datacadastro":null,"dataedicao":null,"idpais":null},"idpessoafisica":{"id":1,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '{"id":7,"idtipoendereco":{"id":1,"descricao":null,"datacadastro":null,"dataedicao":null},"logradouro":"Rua 7","numero":"123","complemento":"Data","bairro":"Centro","cep":"690000","idlocalidade":{"id":1,"codigoIBGE":null,"uf":null,"cidade":null,"datacadastro":null,"dataedicao":null,"idpais":null},"idpessoafisica":{"id":1,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '2015-09-04 17:04:42', 1),
	(41, 'BÁSICO', 'INCLUIR', 'ContatoPF', 3, '{"id":3,"idtipocontato":{"id":1,"descricao":null,"datacadastro":null,"dataedicao":null},"idoperadoracontato":{"id":2,"descricao":null,"datacadastro":null,"dataedicao":null},"contato":"981440856","idpessoafisica":{"id":7,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '{"id":3,"idtipocontato":{"id":1,"descricao":null,"datacadastro":null,"dataedicao":null},"idoperadoracontato":{"id":2,"descricao":null,"datacadastro":null,"dataedicao":null},"contato":"981440856","idpessoafisica":{"id":7,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '2015-09-11 17:52:30', 2),
	(42, 'BÁSICO', 'INCLUIR', 'DocumentoPF', 3, '{"id":3,"tipo":"RG","numero":"12345678","dataemissao":"20150908200000","orgaoemissor":"SSP-AM","via":"1","idpessoafisica":{"id":7,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '{"id":3,"tipo":"RG","numero":"12345678","dataemissao":"20150908200000","orgaoemissor":"SSP-AM","via":"1","idpessoafisica":{"id":7,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '2015-09-11 17:52:53', 2),
	(43, 'BÁSICO', 'INCLUIR', 'EnderecoPF', 8, '{"id":8,"idtipoendereco":{"id":1,"descricao":null,"datacadastro":null,"dataedicao":null},"logradouro":"AV. 7 de Stembro","numero":"877","complemento":"Centro","bairro":"Centro","cep":"690000","idlocalidade":{"id":1,"codigoIBGE":null,"uf":null,"cidade":null,"datacadastro":null,"dataedicao":null,"idpais":null},"idpessoafisica":{"id":7,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '{"id":8,"idtipoendereco":{"id":1,"descricao":null,"datacadastro":null,"dataedicao":null},"logradouro":"AV. 7 de Stembro","numero":"877","complemento":"Centro","bairro":"Centro","cep":"690000","idlocalidade":{"id":1,"codigoIBGE":null,"uf":null,"cidade":null,"datacadastro":null,"dataedicao":null,"idpais":null},"idpessoafisica":{"id":7,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '2015-09-11 17:53:43', 2),
	(44, 'BÁSICO', 'INCLUIR', 'ContatoPF', 4, '{"id":4,"idtipocontato":{"id":2,"descricao":null,"datacadastro":null,"dataedicao":null},"idoperadoracontato":{"id":3,"descricao":null,"datacadastro":null,"dataedicao":null},"contato":"niltonbox@gmail.com","idpessoafisica":{"id":7,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '{"id":4,"idtipocontato":{"id":2,"descricao":null,"datacadastro":null,"dataedicao":null},"idoperadoracontato":{"id":3,"descricao":null,"datacadastro":null,"dataedicao":null},"contato":"niltonbox@gmail.com","idpessoafisica":{"id":7,"nome":null,"cpf":null,"datanascimento":null,"estadocivil":null,"sexo":null,"nomepai":null,"nomemae":null,"cor":null,"naturalidade":null,"nacionalidade":null,"datacadastro":null,"dataedicao":null},"datacadastro":null,"dataedicao":null}', '2015-09-11 17:54:35', 5),
	(45, 'MODERADO', 'ALTERAR', 'PessoaFisica', 7, '{"id":"7","nome":"NILTON CALDAS","cpf":"123456789","datanascimento":"2015-07-14","estadocivil":"CASADO","sexo":"MASCULINO","nomepai":"NILTON CALDAS","nomemae":"MARIA LUCIA","cor":"BRANCA","naturalidade":"MANAUS","nacionalidade":"BRASILEIRO","datacadastro":"2015-08-03 19:39:58","dataedicao":"2015-08-07 00:48:15"}', '{"id":7,"nome":"NILTON CALDAS","cpf":"123456789","datanascimento":"2015-07-14","estadocivil":"CASADO","sexo":"MASCULINO","nomepai":"NILTON CALDAS","nomemae":"MARIA LUCIA CASTRO CALDAS","cor":"BRANCA","naturalidade":"MANAUS","nacionalidade":"BRASILEIRO","datacadastro":null,"dataedicao":"2015-09-12 00:04:50"}', '2015-09-11 18:04:50', 5),
	(46, 'MODERADO', 'ALTERAR', 'PessoaFisica', 7, '{"id":"7","nome":"NILTON CALDAS","cpf":"123456789","datanascimento":"2015-07-14","estadocivil":"CASADO","sexo":"MASCULINO","nomepai":"NILTON CALDAS","nomemae":"MARIA LUCIA CASTRO CALDAS","cor":"BRANCA","naturalidade":"MANAUS","nacionalidade":"BRASILEIRO","datacadastro":"2015-08-03 19:39:58","dataedicao":"2015-09-12 00:04:50","importado":null}', '{"id":7,"nome":"NILTON CALDAS","cpf":"123456789","datanascimento":"2015-07-14","estadocivil":"CASADO","sexo":"MASCULINO","nomepai":"NILTON CALDAS","nomemae":"MARIA LUCIA CALDAS","cor":"BRANCA","naturalidade":"MANAUS","nacionalidade":"BRASILEIRO","datacadastro":null,"dataedicao":"2015-09-12 00:38:35","importado":null}', '2015-09-11 18:38:35', 5),
	(47, 'MODERADO', 'ALTERAR', 'PessoaFisica', 7, '{"id":"7","nome":"NILTON CALDAS","cpf":"123456789","datanascimento":"2015-07-14","estadocivil":"CASADO","sexo":"MASCULINO","nomepai":"NILTON CALDAS","nomemae":"MARIA LUCIA CALDAS","cor":"BRANCA","naturalidade":"MANAUS","nacionalidade":"BRASILEIRO","datacadastro":"2015-08-03 19:39:58","dataedicao":"2015-09-12 00:38:35","importado":null}', '{"id":7,"nome":"NILTON CALDAS","cpf":"123456789","datanascimento":"2015-07-14","estadocivil":"CASADO","sexo":"MASCULINO","nomepai":"NILTON CALDAS","nomemae":"MARIA LUCIA CASTRO CALDAS","cor":"BRANCA","naturalidade":"MANAUS","nacionalidade":"BRASILEIRO","datacadastro":null,"dataedicao":"2015-09-12 00:39:19","importado":null}', '2015-09-11 18:39:19', 1);
/*!40000 ALTER TABLE `logsistema` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.operadoracontato
CREATE TABLE IF NOT EXISTS `operadoracontato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.operadoracontato: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `operadoracontato` DISABLE KEYS */;
INSERT INTO `operadoracontato` (`id`, `descricao`, `datacadastro`, `dataedicao`) VALUES
	(1, 'VIVO', '2015-09-04 17:02:18', '2015-09-04 17:02:18'),
	(2, 'TIM', '2015-09-04 17:02:21', '2015-09-04 17:02:21'),
	(3, 'GMAIL', '2015-09-04 17:02:28', '2015-09-04 17:02:28');
/*!40000 ALTER TABLE `operadoracontato` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.pais
CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(70) DEFAULT NULL,
  `nacionalidade` varchar(70) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.pais: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` (`id`, `descricao`, `nacionalidade`, `datacadastro`, `dataedicao`) VALUES
	(1, 'Brasil', 'Brasileiro', '2015-07-31 00:54:20', '2015-07-31 00:54:20'),
	(2, 'Argentina', 'Argentino', '2015-08-08 01:04:20', '2015-08-08 01:04:20'),
	(3, 'Bolivia', 'Boliviano', '2015-08-08 01:06:35', '2015-08-08 01:06:35'),
	(4, 'Peru', 'Peruano', '2015-08-26 19:38:33', '2015-08-26 19:38:33');
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.perfil
CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='Groups do menu';

-- Copiando dados para a tabela crmnuvio.perfil: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` (`id`, `nome`, `ativo`, `datacadastro`, `dataedicao`) VALUES
	(1, 'admin', NULL, '2015-07-30 18:53:30', '2015-07-30 18:53:30'),
	(2, 'tester', NULL, '2015-07-30 18:53:30', '2015-07-30 18:53:30'),
	(3, 'supervisor', 0, '2015-08-07 18:52:21', '2015-08-07 18:52:21'),
	(8, 'Super', 0, '2015-08-25 16:17:29', '2015-08-25 16:17:29');
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.perfilrotina
CREATE TABLE IF NOT EXISTS `perfilrotina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idrotina` int(11) NOT NULL,
  `idperfil` int(11) NOT NULL,
  `consulta` tinyint(1) NOT NULL,
  `incluir` tinyint(1) NOT NULL,
  `alterar` tinyint(1) NOT NULL,
  `excluir` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_perfilrotina_rotina1_idx` (`idrotina`),
  KEY `fk_perfilrotina_perfil1_idx` (`idperfil`),
  CONSTRAINT `fk_perfilrotina_perfil1` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_perfilrotina_rotina1` FOREIGN KEY (`idrotina`) REFERENCES `rotina` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='Permissoes';

-- Copiando dados para a tabela crmnuvio.perfilrotina: ~24 rows (aproximadamente)
/*!40000 ALTER TABLE `perfilrotina` DISABLE KEYS */;
INSERT INTO `perfilrotina` (`id`, `datacadastro`, `idrotina`, `idperfil`, `consulta`, `incluir`, `alterar`, `excluir`) VALUES
	(1, '2015-07-30 18:53:31', 1, 1, 0, 0, 0, 0),
	(2, '2015-07-30 18:53:31', 2, 1, 0, 0, 0, 0),
	(3, '2015-07-30 18:53:31', 3, 1, 0, 0, 0, 0),
	(4, '2015-07-30 18:53:31', 4, 1, 0, 0, 0, 0),
	(5, '2015-07-30 18:53:31', 5, 1, 0, 0, 0, 0),
	(6, '2015-07-30 18:53:31', 6, 1, 0, 0, 0, 0),
	(7, '2015-07-30 18:53:31', 7, 1, 0, 0, 0, 0),
	(8, '2015-07-30 18:53:31', 8, 1, 0, 0, 0, 0),
	(9, '2015-07-30 18:53:31', 9, 1, 0, 0, 0, 0),
	(10, '2015-07-30 18:53:31', 10, 1, 0, 0, 0, 0),
	(11, '2015-07-30 18:53:31', 11, 1, 0, 0, 0, 0),
	(12, '2015-07-30 18:53:31', 12, 1, 0, 0, 0, 0),
	(13, '2015-07-30 18:53:31', 13, 1, 0, 0, 0, 0),
	(14, '2015-07-30 18:53:31', 14, 1, 0, 0, 0, 0),
	(15, '2015-07-30 18:53:31', 2, 2, 0, 0, 0, 0),
	(16, '2015-07-30 18:53:31', 13, 2, 0, 0, 0, 0),
	(17, '2015-07-30 18:53:31', 14, 2, 0, 0, 0, 0),
	(18, '2015-08-10 16:45:43', 15, 1, 0, 0, 0, 0),
	(19, '2015-08-17 19:21:15', 16, 1, 0, 0, 0, 0),
	(29, '2015-08-25 16:21:27', 2, 8, 0, 0, 0, 0),
	(30, '2015-08-25 16:21:30', 13, 8, 0, 0, 0, 0),
	(31, '2015-08-25 16:21:32', 14, 8, 0, 0, 0, 0);
/*!40000 ALTER TABLE `perfilrotina` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.perfilusuario
CREATE TABLE IF NOT EXISTS `perfilusuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idusuario` int(11) NOT NULL,
  `idperfil` int(11) NOT NULL,
  `idempresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_perfilusuario_usuario1_idx` (`idusuario`),
  CONSTRAINT `fk_perfilusuario_usuario1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.perfilusuario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `perfilusuario` DISABLE KEYS */;
INSERT INTO `perfilusuario` (`id`, `datacadastro`, `idusuario`, `idperfil`, `idempresa`) VALUES
	(1, '2015-08-04 19:17:48', 1, 1, 1);
/*!40000 ALTER TABLE `perfilusuario` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.pessoafisica
CREATE TABLE IF NOT EXISTS `pessoafisica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `datanascimento` date DEFAULT NULL,
  `estadocivil` enum('SOLTEIRO','CASADO','DIVORCIADO','VIUVO') DEFAULT NULL,
  `sexo` enum('MASCULINO','FEMININO') DEFAULT NULL,
  `nomepai` varchar(70) DEFAULT NULL,
  `nomemae` varchar(70) DEFAULT NULL,
  `cor` enum('BRANCA','PRETA','PARDA','AMARELA') DEFAULT NULL,
  `naturalidade` varchar(30) DEFAULT NULL,
  `nacionalidade` varchar(30) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.pessoafisica: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `pessoafisica` DISABLE KEYS */;
INSERT INTO `pessoafisica` (`id`, `nome`, `cpf`, `datanascimento`, `estadocivil`, `sexo`, `nomepai`, `nomemae`, `cor`, `naturalidade`, `nacionalidade`, `datacadastro`, `dataedicao`) VALUES
	(1, 'Paulo Adm', '7655413', '2015-07-02', 'SOLTEIRO', 'MASCULINO', 'teste pai', 'teste mae', 'BRANCA', 'manaus', 'brasil', '2015-07-30 18:53:30', '2015-08-07 00:51:00'),
	(2, 'Carlos Testador', '6544321', '2015-07-30', 'CASADO', 'MASCULINO', 'teste pai', 'teste mae', 'BRANCA', 'manaus', 'brasil', '2015-07-30 18:53:30', '2015-08-06 23:36:20'),
	(5, 'AAAAA', '12345678', '2015-08-29', 'SOLTEIRO', 'MASCULINO', 'AAAAA', 'AAAAA', 'BRANCA', 'AAAA', 'AAAAAA', '2015-08-03 19:34:46', '2015-08-07 00:49:58'),
	(6, 'BBBBBB', '22222222', '2015-08-07', 'CASADO', 'MASCULINO', 'BBBBBB', 'BBB', 'BRANCA', 'BBBB', 'BBBBB', '2015-08-03 19:38:01', '2015-08-07 00:36:05'),
	(7, 'NILTON CALDAS', '123456789', '2015-07-14', 'CASADO', 'MASCULINO', 'NILTON CALDAS', 'MARIA LUCIA CASTRO CALDAS', 'BRANCA', 'MANAUS', 'BRASILEIRO', '2015-08-03 19:39:58', '2015-09-12 00:39:19'),
	(8, 'ADELSON', '8765544221', '2015-07-30', 'SOLTEIRO', 'MASCULINO', 'ADSAD', 'ADADA', 'BRANCA', 'ADADAD', 'ADSADAD', '2015-08-03 19:43:23', '2015-08-03 19:43:23'),
	(9, 'fabiano', '80980809', '2015-07-01', 'SOLTEIRO', 'MASCULINO', 'lmkhjkjh', 'hkjhkh', 'BRANCA', 'lklkj', 'lkjlkj', '2015-08-03 19:50:10', '2015-08-07 00:52:43'),
	(10, 'Fulano de Tal', '9809808', '2015-08-28', 'SOLTEIRO', 'MASCULINO', 'mlkkl', 'lhjlkhj', 'BRANCA', 'jhkjh', 'hk', '2015-08-06 19:04:35', '2015-08-06 19:04:35');
/*!40000 ALTER TABLE `pessoafisica` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.rotina
CREATE TABLE IF NOT EXISTS `rotina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `subrotina` int(11) DEFAULT NULL,
  `class` varchar(200) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='os Menus do crm';

-- Copiando dados para a tabela crmnuvio.rotina: ~16 rows (aproximadamente)
/*!40000 ALTER TABLE `rotina` DISABLE KEYS */;
INSERT INTO `rotina` (`id`, `nome`, `descricao`, `subrotina`, `class`, `ativo`, `datacadastro`, `dataedicao`, `icon`) VALUES
	(1, 'Administrativo', NULL, NULL, NULL, NULL, '2015-07-30 18:53:30', '2015-07-30 18:53:30', 'menu_icon_adm'),
	(2, 'CRM', NULL, NULL, NULL, NULL, '2015-07-30 18:53:30', '2015-07-30 18:53:30', 'menu_icon_crm'),
	(3, 'Relatorios', NULL, NULL, NULL, NULL, '2015-07-30 18:53:30', '2015-07-30 18:53:30', 'menu_icon_rel'),
	(4, 'Empresa', NULL, 1, 'empresapanel', NULL, '2015-07-30 18:53:30', '2015-07-30 18:53:30', 'menu_icon_empresa'),
	(5, 'Perfil', NULL, 1, 'perfilrotinapanel', NULL, '2015-07-30 18:53:31', '2015-07-30 18:53:31', 'menu_icon_perfil'),
	(6, 'Conta Banco', NULL, 1, 'contabancopanel', NULL, '2015-07-30 18:53:31', '2015-07-30 18:53:31', 'menu_icon_contabanco'),
	(7, 'Banco', NULL, 1, 'bancopanel', NULL, '2015-07-30 18:53:31', '2015-07-30 18:53:31', 'menu_icon_banco'),
	(8, 'Impostos', NULL, 1, 'impostopanel', NULL, '2015-07-30 18:53:31', '2015-07-30 18:53:31', 'menu_icon_imposto'),
	(9, 'Localidade', NULL, 1, 'localidadepanel', NULL, '2015-07-30 18:53:31', '2015-07-30 18:53:31', 'menu_icon_local'),
	(10, 'Pais', NULL, 1, 'paispanel', NULL, '2015-07-30 18:53:31', '2015-07-30 18:53:31', 'menu_icon_pais'),
	(11, 'Pessoa Fisica', NULL, 1, 'pessoafisicapanel', NULL, '2015-07-30 18:53:31', '2015-07-30 18:53:31', 'menu_icon_pf'),
	(12, 'Usuarios', NULL, 1, 'usuariopanel', NULL, '2015-07-30 18:53:31', '2015-07-30 18:53:31', 'menu_icon_usuario'),
	(13, 'Lead', NULL, 2, 'leadpanel', NULL, '2015-07-30 18:53:31', '2015-07-30 18:53:31', 'menu_icon_lead'),
	(14, 'Contato', NULL, 2, 'contatoleadpanel', NULL, '2015-07-30 18:53:31', '2015-07-30 18:53:31', 'menu_icon_contato'),
	(15, 'Logs do Sistema', NULL, 1, 'logsistemapanel', NULL, '2015-08-10 16:45:08', '2015-08-10 16:45:08', 'menu_icon_logsistema'),
	(16, 'Empresa  Usuário', NULL, 1, 'empresausuariopanel', NULL, '2015-08-17 19:20:38', '2015-08-17 19:20:38', 'menu_icon_logsistema');
/*!40000 ALTER TABLE `rotina` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.tipocontato
CREATE TABLE IF NOT EXISTS `tipocontato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.tipocontato: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `tipocontato` DISABLE KEYS */;
INSERT INTO `tipocontato` (`id`, `descricao`, `datacadastro`, `dataedicao`) VALUES
	(1, 'CELULAR', '2015-09-04 17:01:46', '2015-09-04 17:01:46'),
	(2, 'EMAIL', '2015-09-04 17:01:52', '2015-09-04 17:01:52'),
	(3, 'TELEFONE', '2015-09-04 17:02:06', '2015-09-04 17:02:06');
/*!40000 ALTER TABLE `tipocontato` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.tipoendereco
CREATE TABLE IF NOT EXISTS `tipoendereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.tipoendereco: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `tipoendereco` DISABLE KEYS */;
INSERT INTO `tipoendereco` (`id`, `descricao`, `datacadastro`, `dataedicao`) VALUES
	(1, 'COMERCIAL', '2015-09-04 17:02:40', '2015-09-04 17:02:40'),
	(2, 'ENTREGA', '2015-09-04 17:02:53', '2015-09-04 17:02:53');
/*!40000 ALTER TABLE `tipoendereco` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idperfil` int(11) NOT NULL,
  `idpessoafisica` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_perfil1_idx` (`idperfil`),
  KEY `fk_usuario_pessoafisica1_idx` (`idpessoafisica`),
  CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_pessoafisica1` FOREIGN KEY (`idpessoafisica`) REFERENCES `pessoafisica` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.usuario: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nome`, `usuario`, `senha`, `email`, `ativo`, `datacadastro`, `dataedicao`, `idperfil`, `idpessoafisica`) VALUES
	(1, 'Paulo Adm', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com.br', 1, '2015-07-30 18:53:30', '2015-07-31 00:59:13', 1, 1),
	(2, 'Carlos Testador', 'teste', '698dc19d489c4e4db73e28a713eab07b', 'teste@teste.com.br', NULL, '2015-07-30 18:53:30', '2015-07-30 18:53:30', 2, 2),
	(5, 'Nilton', 'ncaldas', '21232f297a57a5a743894a0e4a801fc3', 'nilton@teste', 0, '2015-08-19 18:34:30', '2015-08-25 00:25:29', 3, 7),
	(6, 'Givanni', 'gio', '202cb962ac59075b964b07152d234b70', 'gio@akto.com', 0, '2015-08-25 16:31:22', '2015-08-25 16:31:22', 1, 10);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Copiando estrutura para tabela crmnuvio.usuariorotina
CREATE TABLE IF NOT EXISTS `usuariorotina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idrotina` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `consulta` tinyint(1) NOT NULL,
  `incluir` tinyint(1) NOT NULL,
  `alterar` tinyint(1) NOT NULL,
  `excluir` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuariorotina_rotina1_idx` (`idrotina`),
  KEY `fk_usuariorotina_perfil1_idx` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COMMENT='Permissoes';

-- Copiando dados para a tabela crmnuvio.usuariorotina: ~42 rows (aproximadamente)
/*!40000 ALTER TABLE `usuariorotina` DISABLE KEYS */;
INSERT INTO `usuariorotina` (`id`, `datacadastro`, `idrotina`, `idusuario`, `consulta`, `incluir`, `alterar`, `excluir`) VALUES
	(1, '2015-08-19 18:30:21', 1, 1, 0, 0, 0, 0),
	(2, '2015-08-19 18:30:21', 2, 1, 0, 0, 0, 0),
	(3, '2015-08-19 18:30:21', 3, 1, 0, 0, 0, 0),
	(5, '2015-08-19 18:30:21', 5, 1, 0, 0, 0, 0),
	(6, '2015-08-19 18:30:21', 6, 1, 0, 0, 0, 0),
	(7, '2015-08-19 18:30:21', 7, 1, 0, 0, 0, 0),
	(8, '2015-08-19 18:30:21', 8, 1, 0, 0, 0, 0),
	(9, '2015-08-19 18:30:21', 9, 1, 0, 0, 0, 0),
	(10, '2015-08-19 18:30:21', 10, 1, 0, 0, 0, 0),
	(11, '2015-08-19 18:30:21', 11, 1, 0, 0, 0, 0),
	(12, '2015-08-19 18:30:21', 12, 1, 0, 0, 0, 0),
	(13, '2015-08-19 18:30:21', 13, 1, 0, 0, 0, 0),
	(14, '2015-08-19 18:30:21', 14, 1, 0, 0, 0, 0),
	(15, '2015-08-19 18:30:21', 15, 1, 0, 0, 0, 0),
	(16, '2015-08-19 18:30:21', 16, 1, 0, 0, 0, 0),
	(21, '2015-08-19 18:53:30', 4, 1, 0, 0, 0, 0),
	(24, '2015-08-24 18:25:29', 1, 5, 0, 0, 0, 0),
	(25, '2015-08-24 18:25:29', 2, 5, 0, 0, 0, 0),
	(26, '2015-08-24 18:25:29', 13, 5, 0, 0, 0, 0),
	(27, '2015-08-24 18:25:29', 14, 5, 0, 0, 0, 0),
	(28, '2015-08-24 18:25:29', 3, 5, 0, 0, 0, 0),
	(29, '2015-08-24 18:25:29', 7, 5, 0, 0, 0, 0),
	(30, '2015-08-24 18:25:29', 6, 5, 0, 0, 0, 0),
	(31, '2015-08-24 18:25:29', 11, 5, 0, 0, 0, 0),
	(32, '2015-08-24 18:26:06', 15, 5, 0, 0, 0, 0),
	(33, '2015-08-25 16:31:22', 1, 6, 0, 0, 0, 0),
	(34, '2015-08-25 16:31:22', 2, 6, 0, 0, 0, 0),
	(35, '2015-08-25 16:31:22', 3, 6, 0, 0, 0, 0),
	(36, '2015-08-25 16:31:22', 4, 6, 0, 0, 0, 0),
	(37, '2015-08-25 16:31:22', 5, 6, 0, 0, 0, 0),
	(38, '2015-08-25 16:31:22', 6, 6, 0, 0, 0, 0),
	(39, '2015-08-25 16:31:22', 7, 6, 0, 0, 0, 0),
	(40, '2015-08-25 16:31:22', 8, 6, 0, 0, 0, 0),
	(41, '2015-08-25 16:31:22', 9, 6, 0, 0, 0, 0),
	(42, '2015-08-25 16:31:22', 10, 6, 0, 0, 0, 0),
	(43, '2015-08-25 16:31:22', 11, 6, 0, 0, 0, 0),
	(45, '2015-08-25 16:31:22', 13, 6, 0, 0, 0, 0),
	(46, '2015-08-25 16:31:22', 14, 6, 0, 0, 0, 0),
	(47, '2015-08-25 16:31:22', 15, 6, 0, 0, 0, 0),
	(48, '2015-08-25 16:31:22', 16, 6, 0, 0, 0, 0),
	(49, '2015-08-25 16:31:22', 17, 6, 0, 0, 0, 0),
	(50, '2015-08-27 19:01:10', 2, 2, 0, 0, 0, 0),
	(51, '2015-08-27 19:01:15', 13, 2, 0, 0, 0, 0),
	(52, '2015-08-27 19:01:17', 14, 2, 0, 0, 0, 0);
/*!40000 ALTER TABLE `usuariorotina` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
