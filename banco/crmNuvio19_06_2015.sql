# Host: localhost  (Version: 5.6.24)
# Date: 2015-06-19 18:14:37
# Generator: MySQL-Front 5.3  (Build 4.212)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "banco"
#

DROP TABLE IF EXISTS `banco`;
CREATE TABLE `banco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `codigoBancoCentral` varchar(5) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "banco"
#


#
# Structure for table "contato_pf"
#

DROP TABLE IF EXISTS `contato_pf`;
CREATE TABLE `contato_pf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) DEFAULT NULL,
  `operadora` varchar(50) DEFAULT NULL,
  `contato` varchar(50) DEFAULT NULL,
  `idpessoafisica` int(11) NOT NULL,
  `datacadastro` datetime DEFAULT NULL,
  `dataatualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "contato_pf"
#


#
# Structure for table "documentos_pf"
#

DROP TABLE IF EXISTS `documentos_pf`;
CREATE TABLE `documentos_pf` (
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

#
# Data for table "documentos_pf"
#


#
# Structure for table "endereco_pf"
#

DROP TABLE IF EXISTS `endereco_pf`;
CREATE TABLE `endereco_pf` (
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

#
# Data for table "endereco_pf"
#


#
# Structure for table "imposto"
#

DROP TABLE IF EXISTS `imposto`;
CREATE TABLE `imposto` (
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

#
# Data for table "imposto"
#


#
# Structure for table "lead"
#

DROP TABLE IF EXISTS `lead`;
CREATE TABLE `lead` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `contato` varchar(100) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "lead"
#


#
# Structure for table "ocupacao"
#

DROP TABLE IF EXISTS `ocupacao`;
CREATE TABLE `ocupacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "ocupacao"
#


#
# Structure for table "operadora_contato"
#

DROP TABLE IF EXISTS `operadora_contato`;
CREATE TABLE `operadora_contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  `datacadastro` datetime DEFAULT NULL,
  `dataatualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Data for table "operadora_contato"
#


#
# Structure for table "pais"
#

DROP TABLE IF EXISTS `pais`;
CREATE TABLE `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(70) DEFAULT NULL,
  `nacionalidade` varchar(70) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "pais"
#


#
# Structure for table "localidade"
#

DROP TABLE IF EXISTS `localidade`;
CREATE TABLE `localidade` (
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

#
# Data for table "localidade"
#


#
# Structure for table "empresa"
#

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa` (
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
  CONSTRAINT `fk_empresa_imposto1` FOREIGN KEY (`idimposto`) REFERENCES `imposto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_localidade1` FOREIGN KEY (`idlocalidade`) REFERENCES `localidade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "empresa"
#


#
# Structure for table "contabanco"
#

DROP TABLE IF EXISTS `contabanco`;
CREATE TABLE `contabanco` (
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

#
# Data for table "contabanco"
#


#
# Structure for table "contrato"
#

DROP TABLE IF EXISTS `contrato`;
CREATE TABLE `contrato` (
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

#
# Data for table "contrato"
#


#
# Structure for table "perfil"
#

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  `datacadastrado` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "perfil"
#


#
# Structure for table "pessoa"
#

DROP TABLE IF EXISTS `pessoa`;
CREATE TABLE `pessoa` (
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

#
# Data for table "pessoa"
#


#
# Structure for table "pessoafisica"
#

DROP TABLE IF EXISTS `pessoafisica`;
CREATE TABLE `pessoafisica` (
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

#
# Data for table "pessoafisica"
#


#
# Structure for table "rotina"
#

DROP TABLE IF EXISTS `rotina`;
CREATE TABLE `rotina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "rotina"
#

INSERT INTO `rotina` VALUES (1,'Teste Rotina','Teste 1',1,'www.com',1,'2015-06-18 00:00:00','2015-06-18 00:00:00'),(2,'Rotina Alterado','Esta rotina foi alterada',1,'www.com',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,'Teste Rotina','Teste 1',1,'www.com',1,'2015-06-18 14:00:00','2015-06-18 14:00:00'),(6,'Ultimo Teste','Teste Final',1,'www.com',1,'2015-06-18 14:00:00','2015-06-18 14:00:00');

#
# Structure for table "perfilrotina"
#

DROP TABLE IF EXISTS `perfilrotina`;
CREATE TABLE `perfilrotina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idrotina` int(11) NOT NULL,
  `idperfil` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_perfilrotina_rotina1_idx` (`idrotina`),
  KEY `fk_perfilrotina_perfil1_idx` (`idperfil`),
  CONSTRAINT `fk_perfilrotina_perfil1` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_perfilrotina_rotina1` FOREIGN KEY (`idrotina`) REFERENCES `rotina` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "perfilrotina"
#


#
# Structure for table "servico"
#

DROP TABLE IF EXISTS `servico`;
CREATE TABLE `servico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `tipo` char(1) DEFAULT 'S',
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "servico"
#


#
# Structure for table "setor"
#

DROP TABLE IF EXISTS `setor`;
CREATE TABLE `setor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(60) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "setor"
#


#
# Structure for table "statusservico"
#

DROP TABLE IF EXISTS `statusservico`;
CREATE TABLE `statusservico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "statusservico"
#


#
# Structure for table "tipo_contato"
#

DROP TABLE IF EXISTS `tipo_contato`;
CREATE TABLE `tipo_contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  `datacadastro` datetime DEFAULT NULL,
  `dataatualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "tipo_contato"
#


#
# Structure for table "tipo_endereco"
#

DROP TABLE IF EXISTS `tipo_endereco`;
CREATE TABLE `tipo_endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `datacadastro` datetime DEFAULT NULL,
  `dataatualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "tipo_endereco"
#


#
# Structure for table "unidade"
#

DROP TABLE IF EXISTS `unidade`;
CREATE TABLE `unidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `datasis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "unidade"
#


#
# Structure for table "paramentroservico"
#

DROP TABLE IF EXISTS `paramentroservico`;
CREATE TABLE `paramentroservico` (
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
  CONSTRAINT `fk_paramentroServico_servico1` FOREIGN KEY (`idservico`) REFERENCES `servico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_paramentroServico_unidade1` FOREIGN KEY (`idunidade`) REFERENCES `unidade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "paramentroservico"
#


#
# Structure for table "unidadege"
#

DROP TABLE IF EXISTS `unidadege`;
CREATE TABLE `unidadege` (
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
  CONSTRAINT `fk_unidadeGE_localidade1` FOREIGN KEY (`idlocalidade`) REFERENCES `localidade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_unidadeGE_unidadeGE1` FOREIGN KEY (`idGE`) REFERENCES `unidadege` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "unidadege"
#


#
# Structure for table "unidadecontratante"
#

DROP TABLE IF EXISTS `unidadecontratante`;
CREATE TABLE `unidadecontratante` (
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

#
# Data for table "unidadecontratante"
#


#
# Structure for table "responsavel"
#

DROP TABLE IF EXISTS `responsavel`;
CREATE TABLE `responsavel` (
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
  CONSTRAINT `fk_responsavel_ocupacao1` FOREIGN KEY (`idocupacao`) REFERENCES `ocupacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_responsavel_pessoa1` FOREIGN KEY (`idpessoa`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_responsavel_unidadeGE1` FOREIGN KEY (`idunidadeGE`) REFERENCES `unidadege` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "responsavel"
#


#
# Structure for table "usuario"
#

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
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

#
# Data for table "usuario"
#


#
# Structure for table "perfilusuario"
#

DROP TABLE IF EXISTS `perfilusuario`;
CREATE TABLE `perfilusuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_perfilusuario_usuario1_idx` (`idusuario`),
  CONSTRAINT `fk_perfilusuario_usuario1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "perfilusuario"
#


#
# Structure for table "empresausuario"
#

DROP TABLE IF EXISTS `empresausuario`;
CREATE TABLE `empresausuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idempresa` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_prestadorausuario_prestadora1_idx` (`idempresa`),
  KEY `fk_prestadorausuario_usuario1_idx` (`idusuario`),
  CONSTRAINT `fk_prestadorausuario_prestadora1` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_prestadorausuario_usuario1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "empresausuario"
#


#
# Structure for table "contatolead"
#

DROP TABLE IF EXISTS `contatolead`;
CREATE TABLE `contatolead` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datacontato` datetime DEFAULT NULL,
  `descricao` text,
  `dataretorno` datetime DEFAULT NULL,
  `idusuario` int(11) NOT NULL,
  `idlead` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contatolead_usuario_idx` (`idusuario`),
  KEY `fk_contatolead_lead1_idx` (`idlead`),
  CONSTRAINT `fk_contatolead_lead1` FOREIGN KEY (`idlead`) REFERENCES `lead` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contatolead_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "contatolead"
#

