-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.14-log - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para weekit
CREATE DATABASE IF NOT EXISTS `weekit` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `weekit`;


-- Copiando estrutura para tabela weekit.acl_privileges
CREATE TABLE IF NOT EXISTS `acl_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acl_privileges_acl_roles1_idx` (`role_id`),
  KEY `fk_acl_privileges_acl_resources1_idx` (`resource_id`),
  CONSTRAINT `fk_acl_privileges_acl_resources1` FOREIGN KEY (`resource_id`) REFERENCES `acl_resources` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_acl_privileges_acl_roles1` FOREIGN KEY (`role_id`) REFERENCES `acl_roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela weekit.acl_resources
CREATE TABLE IF NOT EXISTS `acl_resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela weekit.acl_roles
CREATE TABLE IF NOT EXISTS `acl_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acl_roles_acl_roles1_idx` (`parent_id`),
  CONSTRAINT `fk_acl_roles_acl_roles1` FOREIGN KEY (`parent_id`) REFERENCES `acl_roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela weekit.evento
CREATE TABLE IF NOT EXISTS `evento` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `identificador` varchar(5) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `inicio` datetime NOT NULL,
  `fim` datetime NOT NULL,
  `carga_horaria` float NOT NULL,
  `maximo_participantes` int(11) NOT NULL,
  `preco` float NOT NULL DEFAULT '0',
  `tipo` enum('palestra','minicurso') NOT NULL,
  `cadastrado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `local_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identificador_UNIQUE` (`identificador`),
  KEY `fk_evento_local_idx` (`local_id`),
  CONSTRAINT `fk_evento_local` FOREIGN KEY (`local_id`) REFERENCES `local` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela weekit.evento_has_monitor
CREATE TABLE IF NOT EXISTS `evento_has_monitor` (
  `evento_id` bigint(20) NOT NULL,
  `monitor_id` bigint(20) NOT NULL,
  PRIMARY KEY (`evento_id`,`monitor_id`),
  KEY `fk_evento_has_monitor_monitor1_idx` (`monitor_id`),
  KEY `fk_evento_has_monitor_evento1_idx` (`evento_id`),
  CONSTRAINT `fk_evento_has_monitor_evento1` FOREIGN KEY (`evento_id`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_evento_has_monitor_monitor1` FOREIGN KEY (`monitor_id`) REFERENCES `monitor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela weekit.evento_has_palestrante
CREATE TABLE IF NOT EXISTS `evento_has_palestrante` (
  `evento_id` bigint(20) NOT NULL,
  `palestrante_id` bigint(20) NOT NULL,
  PRIMARY KEY (`evento_id`,`palestrante_id`),
  KEY `fk_evento_has_palestrante_palestrante1_idx` (`palestrante_id`),
  KEY `fk_evento_has_palestrante_evento1_idx` (`evento_id`),
  CONSTRAINT `fk_evento_has_palestrante_evento1` FOREIGN KEY (`evento_id`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_evento_has_palestrante_palestrante1` FOREIGN KEY (`palestrante_id`) REFERENCES `palestrante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela weekit.inscricao
CREATE TABLE IF NOT EXISTS `inscricao` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('andamento','pago','cancelado') NOT NULL DEFAULT 'andamento',
  `presente` tinyint(1) DEFAULT NULL,
  `participante_id` bigint(20) NOT NULL,
  `evento_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_inscricao_participante1_idx` (`participante_id`),
  KEY `fk_inscricao_evento1_idx` (`evento_id`),
  CONSTRAINT `fk_inscricao_evento1` FOREIGN KEY (`evento_id`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_inscricao_participante1` FOREIGN KEY (`participante_id`) REFERENCES `participante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela weekit.local
CREATE TABLE IF NOT EXISTS `local` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `cadastrado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `descricao_UNIQUE` (`descricao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela weekit.monitor
CREATE TABLE IF NOT EXISTS `monitor` (
  `id` bigint(20) NOT NULL,
  `cadastrado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `participante_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_monitor_participante1_idx` (`participante_id`),
  CONSTRAINT `fk_monitor_participante1` FOREIGN KEY (`participante_id`) REFERENCES `participante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela weekit.palestrante
CREATE TABLE IF NOT EXISTS `palestrante` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `descricao_UNIQUE` (`descricao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela weekit.participante
CREATE TABLE IF NOT EXISTS `participante` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `instituicao` varchar(255) DEFAULT NULL,
  `sexo` enum('masculino','feminino') NOT NULL,
  `telefone1` varchar(15) DEFAULT NULL,
  `telefone2` varchar(15) DEFAULT NULL,
  `campus` varchar(150) DEFAULT NULL,
  `curso` varchar(255) DEFAULT NULL,
  `tipo` enum('aluno','professor','coordenador') NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cadastrado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_UNIQUE` (`email`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para trigger weekit.evento_BEFORE_INSERT
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `evento_BEFORE_INSERT` BEFORE INSERT ON `evento` FOR EACH ROW BEGIN
	SET @evento_no_local_no_horario = (
		SELECT count(*) 
		FROM evento 
		WHERE (evento.local_id = NEW.local_id
		AND evento.inicio BETWEEN  NEW.inicio AND NEW.fim) OR
        (evento.local_id = NEW.local_id
        AND evento.fim BETWEEN  NEW.inicio AND NEW.fim)
    );
    
    
    IF( @evento_no_local_no_horario > 0) THEN 
		SIGNAL SQLSTATE '45000' 
		SET MESSAGE_TEXT = "Já existe um evento para esse local no horario selecionado";
    END IF;
    
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Copiando estrutura para trigger weekit.impedir_multiplas_inscricoes_no_mesmo_evento_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `impedir_multiplas_inscricoes_no_mesmo_evento_before_insert` BEFORE INSERT ON `inscricao` FOR EACH ROW BEGIN
	SET @inscricao_no_evento = (
		SELECT count(*) 
		FROM inscricao 
		WHERE inscricao.evento_id = NEW.evento_id
		AND inscricao.participante_id = NEW.participante_id
    );
    
    
    IF( @inscricao_no_evento >= 1) THEN
		SIGNAL SQLSTATE '45000' 
		SET MESSAGE_TEXT = "Você já está inscrito nesse evento";
    END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Copiando estrutura para trigger weekit.limite_de_inscricoes_BEFORE_INSERT
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `limite_de_inscricoes_BEFORE_INSERT` BEFORE INSERT ON `inscricao` FOR EACH ROW BEGIN
	SET @total_inscricoes_evento = (
		SELECT count(*) 
		FROM inscricao 
		WHERE inscricao.evento_id = NEW.evento_id
    );
    
   SET  @maximo_participantes = (
	   SELECT evento.maximo_participantes
		FROM evento 
		WHERE evento.id = NEW.evento_id
	);
    
    IF( @total_inscricoes_evento >= @maximo_participantes) THEN
		SIGNAL SQLSTATE '45000' 
		SET MESSAGE_TEXT = "Inscrições esgotadas para esse evento";
    END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
