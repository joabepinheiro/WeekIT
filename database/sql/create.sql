-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.19 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela weekit2018.configuracoes
CREATE TABLE IF NOT EXISTS `configuracoes` (
  `chave` varchar(255) NOT NULL,
  `valor` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`chave`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela weekit2018.evento
CREATE TABLE IF NOT EXISTS `evento` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `identificador` varchar(5) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `data_inicio` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `hora_fim` time DEFAULT NULL,
  `carga_horaria` float NOT NULL,
  `maximo_participantes` int(11) NOT NULL,
  `preco` float NOT NULL DEFAULT '0',
  `tipo` enum('palestra','minicurso') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `local_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identificador_UNIQUE` (`identificador`),
  KEY `fk_evento_local_idx` (`local_id`),
  CONSTRAINT `fk_evento_local` FOREIGN KEY (`local_id`) REFERENCES `local` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela weekit2018.evento_has_monitor
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
-- Copiando estrutura para tabela weekit2018.evento_has_palestrante
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
-- Copiando estrutura para tabela weekit2018.inscricao
CREATE TABLE IF NOT EXISTS `inscricao` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('andamento','pago','cancelado') NOT NULL DEFAULT 'andamento',
  `presente` tinyint(1) DEFAULT NULL,
  `participante_id` bigint(20) NOT NULL,
  `evento_id` bigint(20) NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_inscricao_participante1_idx` (`participante_id`),
  KEY `fk_inscricao_evento1_idx` (`evento_id`),
  CONSTRAINT `fk_inscricao_evento1` FOREIGN KEY (`evento_id`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_inscricao_participante1` FOREIGN KEY (`participante_id`) REFERENCES `participante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=473 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela weekit2018.local
CREATE TABLE IF NOT EXISTS `local` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `descricao_UNIQUE` (`descricao`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela weekit2018.log
CREATE TABLE IF NOT EXISTS `log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `antigo` longtext,
  `novo` longtext,
  `tipo` varchar(45) DEFAULT NULL,
  `tabela` varchar(45) DEFAULT NULL,
  `pk_tabela` varchar(45) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cadastrado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9900 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela weekit2018.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela weekit2018.monitor
CREATE TABLE IF NOT EXISTS `monitor` (
  `id` bigint(20) NOT NULL,
  `participante_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_monitor_participante1_idx` (`participante_id`),
  CONSTRAINT `fk_monitor_participante1` FOREIGN KEY (`participante_id`) REFERENCES `participante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela weekit2018.palestrante
CREATE TABLE IF NOT EXISTS `palestrante` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `descricao_UNIQUE` (`descricao`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela weekit2018.participante
CREATE TABLE IF NOT EXISTS `participante` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `instituicao` varchar(255) DEFAULT NULL,
  `sexo` enum('masculino','feminino') NOT NULL,
  `telefone1` varchar(15) DEFAULT NULL,
  `telefone2` varchar(15) DEFAULT NULL,
  `campus` varchar(150) DEFAULT NULL,
  `curso` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `roles_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_UNIQUE` (`email`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  KEY `FK_participante_roles` (`roles_id`),
  CONSTRAINT `FK_participante_roles` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=349 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela weekit2018.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela weekit2018.privileges
CREATE TABLE IF NOT EXISTS `privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resources_id` int(11) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_privileges_resources1_idx` (`resources_id`),
  KEY `fk_privileges_roles1_idx` (`roles_id`),
  CONSTRAINT `fk_privileges_resources1` FOREIGN KEY (`resources_id`) REFERENCES `resources` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_privileges_roles1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela weekit2018.resources
CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(45) DEFAULT NULL,
  `uri` varchar(100) DEFAULT NULL,
  `controller` varchar(100) DEFAULT NULL,
  `action` varchar(45) DEFAULT NULL,
  `method` varchar(6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `middleware` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela weekit2018.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela weekit2018.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `roles_id` int(11) NOT NULL,
  `telefone1` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone2` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cadastrado_por` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_roles1_idx` (`roles_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para trigger weekit2018.evento_BEFORE_INSERT
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

-- Copiando estrutura para trigger weekit2018.TR_INSCRICAO_BEFORE_INSERT
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `TR_INSCRICAO_BEFORE_INSERT` BEFORE INSERT ON `inscricao` FOR EACH ROW BEGIN
	SET @inscricao_no_evento = (
		SELECT count(*) 
		FROM inscricao 
		WHERE inscricao.evento_id = NEW.evento_id
		AND inscricao.participante_id = NEW.participante_id
		AND inscricao.status != 'cancelado'
    );
    
    
    IF( @inscricao_no_evento >= 1) THEN
		SIGNAL SQLSTATE '45000' 
		SET MESSAGE_TEXT = "Você já está inscrito nesse evento";
    END IF;
    
    
    SET @maximo_participantes = (
		SELECT evento.maximo_participantes 
		FROM evento 
		WHERE evento.id = NEW.evento_id
    );
    
    /** seleciona o total de isncritos nesse evento **/
    SET @numero_total_de_participantes_inscritos = (
		SELECT count(*)
		FROM inscricao 
		WHERE inscricao.evento_id = NEW.evento_id
		AND inscricao.status != 'cancelado'
    );
    
    
    IF( @numero_total_de_participantes_inscritos  >= @maximo_participantes) THEN
		SIGNAL SQLSTATE '45000' 
		SET MESSAGE_TEXT = "Esse evento já contem o número máximo de participantes";
    END IF;
    /** fim da validação **/
    
    
    
    /**
    *** Validação
	 * Verifica se o participante já esta inscrito em um curso naquelehorário 
	 **/
	 
		SET @data_inicio_evento_a_inscrever = (
			SELECT evento.inicio from  evento where evento.id = NEW.evento_id
		);
		  
		SET @data_fim_evento_a_inscrever = (
			SELECT evento.fim from evento where evento.id = NEW.evento_id
		);
		
		
		SET @total_de_inscricoes_no_horario = (
		SELECT count(*) 
			from inscricao, evento
			where
			inscricao.participante_id = NEW.participante_id and 
			inscricao.status != 'cancelado' and
			evento.id = inscricao.evento_id and
			evento.id IN 
			(
				SELECT evento.id from evento  
				where
				evento.inicio 
				BETWEEN @data_inicio_evento_a_inscrever 
				and @data_fim_evento_a_inscrever
				or 
				evento.fim 
				BETWEEN @data_inicio_evento_a_inscrever 
				and @data_fim_evento_a_inscrever
			)
		);
		
		IF( @total_de_inscricoes_no_horario  >= 1) THEN
		SIGNAL SQLSTATE '45000' 
		SET MESSAGE_TEXT = "Você não pode se inscrever nesse evento pois já tem uma inscrição em outro evento no mesmo horário";
    END IF;

  		/** fim da validação **/
   
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
