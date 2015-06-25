-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.6.15 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para crmnuvio
CREATE DATABASE IF NOT EXISTS `crmnuvio` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `crmnuvio`;


-- Copiando estrutura para tabela crmnuvio.banco
CREATE TABLE IF NOT EXISTS `banco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `codigoBancoCentral` varchar(5) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.banco: ~0 rows (aproximadamente)
DELETE FROM `banco`;
/*!40000 ALTER TABLE `banco` DISABLE KEYS */;
/*!40000 ALTER TABLE `banco` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.contabanco
CREATE TABLE IF NOT EXISTS `contabanco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agencia` varchar(10) DEFAULT NULL,
  `digitoAgencia` char(1) DEFAULT NULL,
  `numeroConta` varchar(10) DEFAULT NULL,
  `digitoConta` char(1) DEFAULT NULL,
  `numeroCarterira` varchar(10) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.contabanco: ~0 rows (aproximadamente)
DELETE FROM `contabanco`;
/*!40000 ALTER TABLE `contabanco` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.contatolead: ~0 rows (aproximadamente)
DELETE FROM `contatolead`;
/*!40000 ALTER TABLE `contatolead` DISABLE KEYS */;
/*!40000 ALTER TABLE `contatolead` ENABLE KEYS */;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.empresa: ~0 rows (aproximadamente)
DELETE FROM `empresa`;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.empresausuario: ~0 rows (aproximadamente)
DELETE FROM `empresausuario`;
/*!40000 ALTER TABLE `empresausuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresausuario` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.imposto
CREATE TABLE IF NOT EXISTS `imposto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aliquotaICMS` decimal(10,2) DEFAULT NULL,
  `aliquotaPIS` decimal(10,2) DEFAULT NULL,
  `aliquotaCOFINS` decimal(10,2) DEFAULT NULL,
  `aliquotaCSLL` decimal(10,2) DEFAULT NULL,
  `aliquotaISS` decimal(10,2) DEFAULT NULL,
  `aliquotaIRPJ` decimal(10,2) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='				';

-- Copiando dados para a tabela crmnuvio.imposto: ~0 rows (aproximadamente)
DELETE FROM `imposto`;
/*!40000 ALTER TABLE `imposto` DISABLE KEYS */;
/*!40000 ALTER TABLE `imposto` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.lead
CREATE TABLE IF NOT EXISTS `lead` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `contato` varchar(100) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.lead: ~1 rows (aproximadamente)
DELETE FROM `lead`;
/*!40000 ALTER TABLE `lead` DISABLE KEYS */;
INSERT INTO `lead` (`id`, `empresa`, `email`, `telefone`, `contato`, `ativo`, `datacadastro`, `dataedicao`) VALUES
	(1, 'C&A', 'email@mail.com', '0000-0000', 'Email, Telefone', 1, '2015-06-18 14:00:00', '2015-06-18 14:00:00');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.localidade: ~0 rows (aproximadamente)
DELETE FROM `localidade`;
/*!40000 ALTER TABLE `localidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `localidade` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.logsistema
CREATE TABLE IF NOT EXISTS `logsistema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ocorrencia` varchar(200) DEFAULT NULL,
  `nivel` enum('BÁSICO','MODERADO','CRÍTICO') DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_logsistema_usuario1_idx` (`idusuario`),
  CONSTRAINT `fk_logsistema_usuario1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.logsistema: ~0 rows (aproximadamente)
DELETE FROM `logsistema`;
/*!40000 ALTER TABLE `logsistema` DISABLE KEYS */;
/*!40000 ALTER TABLE `logsistema` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.pais
CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(70) DEFAULT NULL,
  `nacionalidade` varchar(70) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.pais: ~1 rows (aproximadamente)
DELETE FROM `pais`;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` (`id`, `descricao`, `nacionalidade`, `datacadastro`, `dataedicao`) VALUES
	(2, 'Italia', 'Italiana', '2015-06-26 00:16:16', '2015-06-26 00:16:16');
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.perfil
CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.perfil: ~3 rows (aproximadamente)
DELETE FROM `perfil`;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` (`id`, `nome`, `ativo`, `datacadastro`, `dataedicao`) VALUES
	(2, 'Administrador', 1, '2015-06-20 00:28:57', '2015-06-20 00:28:57'),
	(3, 'Administrador', 1, '2015-06-20 00:29:13', '2015-06-20 00:29:13'),
	(5, 'Diretor', 0, '2015-06-23 00:18:08', '2015-06-23 00:18:08');
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.perfilrotina
CREATE TABLE IF NOT EXISTS `perfilrotina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idrotina` int(11) NOT NULL,
  `idperfil` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_perfilrotina_rotina1_idx` (`idrotina`),
  KEY `fk_perfilrotina_perfil1_idx` (`idperfil`),
  CONSTRAINT `fk_perfilrotina_perfil1` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_perfilrotina_rotina1` FOREIGN KEY (`idrotina`) REFERENCES `rotina` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.perfilrotina: ~0 rows (aproximadamente)
DELETE FROM `perfilrotina`;
/*!40000 ALTER TABLE `perfilrotina` DISABLE KEYS */;
/*!40000 ALTER TABLE `perfilrotina` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.perfilusuario
CREATE TABLE IF NOT EXISTS `perfilusuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_perfilusuario_usuario1_idx` (`idusuario`),
  CONSTRAINT `fk_perfilusuario_usuario1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.perfilusuario: ~0 rows (aproximadamente)
DELETE FROM `perfilusuario`;
/*!40000 ALTER TABLE `perfilusuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `perfilusuario` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.pessoafisica
CREATE TABLE IF NOT EXISTS `pessoafisica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `datanascimento` datetime DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.pessoafisica: ~4 rows (aproximadamente)
DELETE FROM `pessoafisica`;
/*!40000 ALTER TABLE `pessoafisica` DISABLE KEYS */;
INSERT INTO `pessoafisica` (`id`, `nome`, `cpf`, `datanascimento`, `estadocivil`, `sexo`, `nomepai`, `nomemae`, `cor`, `naturalidade`, `nacionalidade`, `datacadastro`, `dataedicao`) VALUES
	(1, 'Manuel', '33708118200', '2000-05-25 00:00:00', 'SOLTEIRO', 'MASCULINO', 'Jao', 'Talita', 'BRANCA', 'Cearense', 'Brasileiro', '2015-06-24 19:00:38', '2015-06-24 18:59:14'),
	(2, 'Renata Fernanda', '33708118200', '2000-05-25 00:00:00', 'SOLTEIRO', 'MASCULINO', 'Jao', 'Talita', 'BRANCA', 'Cearense', 'Brasileiro', '2015-06-24 19:00:38', '2015-06-24 18:59:14'),
	(3, 'Manuel', '33708118200', '2000-05-25 00:00:00', 'SOLTEIRO', 'MASCULINO', 'Jao', 'Talita', 'BRANCA', 'Cearense', 'Brasileiro', '2015-06-24 19:00:38', '2015-06-24 18:59:14'),
	(5, 'Manuel', '33708118200', '2000-05-25 00:00:00', 'SOLTEIRO', 'MASCULINO', 'Jao', 'Talita', 'BRANCA', 'Cearense', 'Brasileiro', '2015-06-24 19:00:38', '2015-06-24 18:59:14');
/*!40000 ALTER TABLE `pessoafisica` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.rotina
CREATE TABLE IF NOT EXISTS `rotina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.rotina: ~4 rows (aproximadamente)
DELETE FROM `rotina`;
/*!40000 ALTER TABLE `rotina` DISABLE KEYS */;
INSERT INTO `rotina` (`id`, `nome`, `descricao`, `ordem`, `url`, `ativo`, `datacadastro`, `dataedicao`) VALUES
	(9, 'Ultimo Teste', 'Teste Final', 1, 'www.com', 1, '2015-06-18 14:00:00', '2015-06-18 14:00:00'),
	(10, 'Ultimo Teste', 'Teste Final', 1, 'www.com', 1, '2015-06-18 14:00:00', '2015-06-18 14:00:00'),
	(11, 'Ultimo Teste', 'Teste Final', 1, 'www.com', 1, '2015-06-18 14:00:00', '2015-06-18 14:00:00'),
	(12, 'Ultimo Teste', 'Teste Final', 1, 'www.com', 1, '2015-06-18 14:00:00', '2015-06-18 14:00:00');
/*!40000 ALTER TABLE `rotina` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.usuario: ~2 rows (aproximadamente)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nome`, `usuario`, `senha`, `email`, `ativo`, `datacadastro`, `dataedicao`, `idperfil`, `idpessoafisica`) VALUES
	(2, 'Usuario Testando', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user@empresa.com', 0, '2015-06-26 00:08:38', '2015-06-26 00:08:38', 5, 1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
