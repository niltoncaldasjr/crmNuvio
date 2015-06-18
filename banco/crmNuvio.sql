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
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
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
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
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

-- -----------------------------------------------------
-- Table `crmnuvio`.`contatolead`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `crmnuvio`.`contatolead` (
  `id` INT NOT NULL,
  `datacontato` DATETIME NULL,
  `descricao` TEXT NULL,
  `dataretorno` DATETIME NULL,
  `idusuario` INT NOT NULL,
  `idlead` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_contatolead_usuario_idx` (`idusuario` ASC),
  INDEX `fk_contatolead_lead1_idx` (`idlead` ASC),
  CONSTRAINT `fk_contatolead_usuario`
    FOREIGN KEY (`idusuario`)
    REFERENCES `crmnuvio`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contatolead_lead1`
    FOREIGN KEY (`idlead`)
    REFERENCES `crmnuvio`.`lead` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.contatolead: ~0 rows (aproximadamente)
DELETE FROM `contatolead`;
/*!40000 ALTER TABLE `contatolead` DISABLE KEYS */;
/*!40000 ALTER TABLE `contatolead` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.contato_pf
CREATE TABLE IF NOT EXISTS `contato_pf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) DEFAULT NULL,
  `operadora` varchar(50) DEFAULT NULL,
  `contato` varchar(50) DEFAULT NULL,
  `idpessoafisica` int(11) NOT NULL,
  `datacadastro` datetime DEFAULT NULL,
  `dataatualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.contato_pf: ~0 rows (aproximadamente)
DELETE FROM `contato_pf`;
/*!40000 ALTER TABLE `contato_pf` DISABLE KEYS */;
/*!40000 ALTER TABLE `contato_pf` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.contrato
CREATE TABLE IF NOT EXISTS `contrato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dataInicio` date DEFAULT NULL,
  `prazo` int(11) DEFAULT NULL,
  `percentualJuros` decimal(10,2) DEFAULT NULL,
  `percentualMulta` decimal(10,2) DEFAULT NULL,
  `percentualDesconto` decimal(10,2) DEFAULT NULL,
  `indiceReajuste` decimal(10,2) DEFAULT NULL,
  `dataUltimoReajuste` date DEFAULT NULL,
  `dataValidade` date DEFAULT NULL,
  `ativo` char(1) DEFAULT NULL,
  `observacao` varchar(200) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idcontaBanco` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contrato_contaBanco1_idx` (`idcontaBanco`),
  CONSTRAINT `fk_contrato_contaBanco1` FOREIGN KEY (`idcontaBanco`) REFERENCES `contabanco` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.contrato: ~0 rows (aproximadamente)
DELETE FROM `contrato`;
/*!40000 ALTER TABLE `contrato` DISABLE KEYS */;
/*!40000 ALTER TABLE `contrato` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.documentos_pf
CREATE TABLE IF NOT EXISTS `documentos_pf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('RG','CNH','CTPS','PASSAPORTE','OUTROS') DEFAULT NULL,
  `numero` varchar(30) DEFAULT NULL,
  `dataemissao` datetime DEFAULT NULL,
  `orgaoemissor` varchar(30) DEFAULT NULL,
  `via` int(11) DEFAULT NULL,
  `idpessoafisica` int(11) DEFAULT NULL,
  `datacadastro` datetime DEFAULT NULL,
  `dataatualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.documentos_pf: ~0 rows (aproximadamente)
DELETE FROM `documentos_pf`;
/*!40000 ALTER TABLE `documentos_pf` DISABLE KEYS */;
/*!40000 ALTER TABLE `documentos_pf` ENABLE KEYS */;


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
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idlocalidade` int(11) NOT NULL,
  `idimposto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_empresa_localidade1_idx` (`idlocalidade`),
  KEY `fk_empresa_imposto1_idx` (`idimposto`),
  CONSTRAINT `fk_empresa_localidade1` FOREIGN KEY (`idlocalidade`) REFERENCES `localidade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_imposto1` FOREIGN KEY (`idimposto`) REFERENCES `imposto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.empresa: ~0 rows (aproximadamente)
DELETE FROM `empresa`;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.empresausuario
CREATE TABLE IF NOT EXISTS `empresausuario` (
  `id` int(11) NOT NULL,
  `idempresa` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
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


-- Copiando estrutura para tabela crmnuvio.endereco_pf
CREATE TABLE IF NOT EXISTS `endereco_pf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) DEFAULT NULL,
  `logradouro` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `idcidade` int(11) NOT NULL,
  `idpessoafisica` int(11) NOT NULL,
  `datacadastro` datetime DEFAULT NULL,
  `dataatualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.endereco_pf: ~0 rows (aproximadamente)
DELETE FROM `endereco_pf`;
/*!40000 ALTER TABLE `endereco_pf` DISABLE KEYS */;
/*!40000 ALTER TABLE `endereco_pf` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.imposto
CREATE TABLE IF NOT EXISTS `imposto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aliquotaICMS` decimal(10,2) DEFAULT NULL,
  `aliquotaPIS` decimal(10,2) DEFAULT NULL,
  `aliquotaCOFINS` decimal(10,2) DEFAULT NULL,
  `aliquotaCSLL` decimal(10,2) DEFAULT NULL,
  `aliquotaISS` decimal(10,2) DEFAULT NULL,
  `aliquotaIRPJ` decimal(10,2) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='				';

-- Copiando dados para a tabela crmnuvio.imposto: ~0 rows (aproximadamente)
DELETE FROM `imposto`;
/*!40000 ALTER TABLE `imposto` DISABLE KEYS */;
/*!40000 ALTER TABLE `imposto` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.lead
CREATE TABLE IF NOT EXISTS `lead` (
  `id` int(11) NOT NULL,
  `empresa` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `contato` varchar(100) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.lead: ~0 rows (aproximadamente)
DELETE FROM `lead`;
/*!40000 ALTER TABLE `lead` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.localidade
CREATE TABLE IF NOT EXISTS `localidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigoIBGE` int(11) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idpais` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_localidade_pais1_idx` (`idpais`),
  CONSTRAINT `fk_localidade_pais1` FOREIGN KEY (`idpais`) REFERENCES `pais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.localidade: ~0 rows (aproximadamente)
DELETE FROM `localidade`;
/*!40000 ALTER TABLE `localidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `localidade` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.ocupacao
CREATE TABLE IF NOT EXISTS `ocupacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.ocupacao: ~0 rows (aproximadamente)
DELETE FROM `ocupacao`;
/*!40000 ALTER TABLE `ocupacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `ocupacao` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.operadora_contato
CREATE TABLE IF NOT EXISTS `operadora_contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  `datacadastro` datetime DEFAULT NULL,
  `dataatualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.operadora_contato: ~0 rows (aproximadamente)
DELETE FROM `operadora_contato`;
/*!40000 ALTER TABLE `operadora_contato` DISABLE KEYS */;
/*!40000 ALTER TABLE `operadora_contato` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.pais
CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(70) DEFAULT NULL,
  `nacionalidade` varchar(70) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.pais: ~0 rows (aproximadamente)
DELETE FROM `pais`;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.paramentroservico
CREATE TABLE IF NOT EXISTS `paramentroservico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(60) DEFAULT NULL,
  `valorParametro` decimal(10,2) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idunidade` int(11) NOT NULL,
  `idservico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idservico_UNIQUE` (`idservico`),
  KEY `fk_paramentroServico_unidade1_idx` (`idunidade`),
  KEY `fk_paramentroServico_servico1_idx` (`idservico`),
  CONSTRAINT `fk_paramentroServico_unidade1` FOREIGN KEY (`idunidade`) REFERENCES `unidade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_paramentroServico_servico1` FOREIGN KEY (`idservico`) REFERENCES `servico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.paramentroservico: ~0 rows (aproximadamente)
DELETE FROM `paramentroservico`;
/*!40000 ALTER TABLE `paramentroservico` DISABLE KEYS */;
/*!40000 ALTER TABLE `paramentroservico` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.perfil
CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  `datacadastrado` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.perfil: ~0 rows (aproximadamente)
DELETE FROM `perfil`;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.perfilrotina
CREATE TABLE IF NOT EXISTS `perfilrotina` (
  `id` int(11) NOT NULL,
  `idrotina` int(11) NOT NULL,
  `idperfil` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_perfilrotina_rotina1_idx` (`idrotina`),
  KEY `fk_perfilrotina_perfil1_idx` (`idperfil`),
  CONSTRAINT `fk_perfilrotina_rotina1` FOREIGN KEY (`idrotina`) REFERENCES `rotina` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_perfilrotina_perfil1` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.perfilrotina: ~0 rows (aproximadamente)
DELETE FROM `perfilrotina`;
/*!40000 ALTER TABLE `perfilrotina` DISABLE KEYS */;
/*!40000 ALTER TABLE `perfilrotina` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.perfilusuario
CREATE TABLE IF NOT EXISTS `perfilusuario` (
  `id` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_perfilusuario_usuario1_idx` (`idusuario`),
  CONSTRAINT `fk_perfilusuario_usuario1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.perfilusuario: ~0 rows (aproximadamente)
DELETE FROM `perfilusuario`;
/*!40000 ALTER TABLE `perfilusuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `perfilusuario` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.pessoa
CREATE TABLE IF NOT EXISTS `pessoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) DEFAULT NULL,
  `CPF` varchar(12) DEFAULT NULL,
  `dataNascimento` date DEFAULT NULL,
  `foneMovel` varchar(12) DEFAULT NULL,
  `foneFixo` varchar(12) DEFAULT NULL,
  `foneAdicional` varchar(12) DEFAULT NULL,
  `ramal` varchar(5) DEFAULT NULL,
  `email1` varchar(100) DEFAULT NULL,
  `email2` varchar(100) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `acessoSRC` char(1) DEFAULT 'N',
  `senhaSRC` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.pessoa: ~0 rows (aproximadamente)
DELETE FROM `pessoa`;
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;


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
  `datacadastro` datetime DEFAULT NULL,
  `dataatualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.pessoafisica: ~0 rows (aproximadamente)
DELETE FROM `pessoafisica`;
/*!40000 ALTER TABLE `pessoafisica` DISABLE KEYS */;
/*!40000 ALTER TABLE `pessoafisica` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.responsavel
CREATE TABLE IF NOT EXISTS `responsavel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `observacao` varchar(100) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idunidadeGE` int(11) NOT NULL,
  `idpessoa` int(11) NOT NULL,
  `idocupacao` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_responsavel_unidadeGE1_idx` (`idunidadeGE`),
  KEY `fk_responsavel_pessoa1_idx` (`idpessoa`),
  KEY `fk_responsavel_ocupacao1_idx` (`idocupacao`),
  CONSTRAINT `fk_responsavel_unidadeGE1` FOREIGN KEY (`idunidadeGE`) REFERENCES `unidadege` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_responsavel_pessoa1` FOREIGN KEY (`idpessoa`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_responsavel_ocupacao1` FOREIGN KEY (`idocupacao`) REFERENCES `ocupacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.responsavel: ~0 rows (aproximadamente)
DELETE FROM `responsavel`;
/*!40000 ALTER TABLE `responsavel` DISABLE KEYS */;
/*!40000 ALTER TABLE `responsavel` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.rotina
CREATE TABLE IF NOT EXISTS `rotina` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.rotina: ~0 rows (aproximadamente)
DELETE FROM `rotina`;
/*!40000 ALTER TABLE `rotina` DISABLE KEYS */;
/*!40000 ALTER TABLE `rotina` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.servico
CREATE TABLE IF NOT EXISTS `servico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `tipo` char(1) DEFAULT 'S',
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.servico: ~0 rows (aproximadamente)
DELETE FROM `servico`;
/*!40000 ALTER TABLE `servico` DISABLE KEYS */;
/*!40000 ALTER TABLE `servico` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.setor
CREATE TABLE IF NOT EXISTS `setor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(60) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.setor: ~0 rows (aproximadamente)
DELETE FROM `setor`;
/*!40000 ALTER TABLE `setor` DISABLE KEYS */;
/*!40000 ALTER TABLE `setor` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.statusservico
CREATE TABLE IF NOT EXISTS `statusservico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.statusservico: ~0 rows (aproximadamente)
DELETE FROM `statusservico`;
/*!40000 ALTER TABLE `statusservico` DISABLE KEYS */;
/*!40000 ALTER TABLE `statusservico` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.tipo_contato
CREATE TABLE IF NOT EXISTS `tipo_contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  `datacadastro` datetime DEFAULT NULL,
  `dataatualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.tipo_contato: ~0 rows (aproximadamente)
DELETE FROM `tipo_contato`;
/*!40000 ALTER TABLE `tipo_contato` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_contato` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.tipo_endereco
CREATE TABLE IF NOT EXISTS `tipo_endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `datacadastro` datetime DEFAULT NULL,
  `dataatualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.tipo_endereco: ~0 rows (aproximadamente)
DELETE FROM `tipo_endereco`;
/*!40000 ALTER TABLE `tipo_endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_endereco` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.unidade
CREATE TABLE IF NOT EXISTS `unidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.unidade: ~0 rows (aproximadamente)
DELETE FROM `unidade`;
/*!40000 ALTER TABLE `unidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `unidade` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.unidadecontratante
CREATE TABLE IF NOT EXISTS `unidadecontratante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `observacao` varchar(45) DEFAULT NULL,
  `dataAtivacao` date DEFAULT NULL,
  `dataInicioCobranca` date DEFAULT NULL,
  `dataCancelamento` date DEFAULT NULL,
  `valorServico` decimal(10,2) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idcontrato` int(11) NOT NULL,
  `idunidadeGE` int(11) NOT NULL,
  `idservico` int(11) NOT NULL,
  `idstatusServico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_unidadeContratada_contrato1_idx` (`idcontrato`),
  KEY `fk_unidadeContratada_unidadeGE1_idx` (`idunidadeGE`),
  KEY `fk_unidadeContratante_servico1_idx` (`idservico`),
  KEY `fk_unidadeContratante_statusServico1_idx` (`idstatusServico`),
  CONSTRAINT `fk_unidadeContratada_contrato1` FOREIGN KEY (`idcontrato`) REFERENCES `contrato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_unidadeContratada_unidadeGE1` FOREIGN KEY (`idunidadeGE`) REFERENCES `unidadege` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_unidadeContratante_servico1` FOREIGN KEY (`idservico`) REFERENCES `servico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_unidadeContratante_statusServico1` FOREIGN KEY (`idstatusServico`) REFERENCES `statusservico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.unidadecontratante: ~0 rows (aproximadamente)
DELETE FROM `unidadecontratante`;
/*!40000 ALTER TABLE `unidadecontratante` DISABLE KEYS */;
/*!40000 ALTER TABLE `unidadecontratante` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.unidadege
CREATE TABLE IF NOT EXISTS `unidadege` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomeFantasia` varchar(70) DEFAULT NULL,
  `razaoSocial` varchar(70) DEFAULT NULL,
  `nomeReduzido` varchar(40) DEFAULT NULL,
  `CNPJ` varchar(15) DEFAULT NULL,
  `inscricaoEstadual` varchar(15) DEFAULT NULL,
  `inscricaoMunicipal` varchar(15) DEFAULT NULL,
  `CFOP` varchar(5) DEFAULT NULL,
  `endereco` varchar(60) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(60) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `telefoneGeral` varchar(12) DEFAULT NULL,
  `observacoes` varchar(200) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idGE` int(11) DEFAULT NULL,
  `idlocalidade` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_unidadeGE_unidadeGE1_idx` (`idGE`),
  KEY `fk_unidadeGE_localidade1_idx` (`idlocalidade`),
  CONSTRAINT `fk_unidadeGE_unidadeGE1` FOREIGN KEY (`idGE`) REFERENCES `unidadege` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_unidadeGE_localidade1` FOREIGN KEY (`idlocalidade`) REFERENCES `localidade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela crmnuvio.unidadege: ~0 rows (aproximadamente)
DELETE FROM `unidadege`;
/*!40000 ALTER TABLE `unidadege` DISABLE KEYS */;
/*!40000 ALTER TABLE `unidadege` ENABLE KEYS */;


-- Copiando estrutura para tabela crmnuvio.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `senha` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  `datacadastrado` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idperfil` int(11) NOT NULL,
  `idpessoafisica` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_perfil1_idx` (`idperfil`),
  KEY `fk_usuario_pessoafisica1_idx` (`idpessoafisica`),
  CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_pessoafisica1` FOREIGN KEY (`idpessoafisica`) REFERENCES `pessoafisica` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



