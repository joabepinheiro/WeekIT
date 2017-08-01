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
-- Copiando dados para a tabela weekit.acl_privileges: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `acl_privileges` DISABLE KEYS */;
INSERT INTO `acl_privileges` (`id`, `nome`, `created_at`, `updated_at`, `role_id`, `resource_id`) VALUES
	(60, 'dashboard', '2017-07-31 21:36:47', '2017-07-31 21:36:47', 6, 30),
	(61, 'cadastrar', '2017-07-31 21:37:25', '2017-07-31 21:37:25', 6, 31),
	(62, 'editar', '2017-07-31 21:37:42', '2017-07-31 21:37:42', 6, 31),
	(63, 'detalhes', '2017-07-31 21:38:04', '2017-07-31 21:38:04', 6, 31),
	(64, 'deletar', '2017-07-31 21:38:26', '2017-07-31 21:38:26', 6, 31),
	(65, 'listar', '2017-07-31 21:54:36', '2017-07-31 21:54:36', 6, 31),
	(66, 'cadastrar', '2017-07-31 21:56:26', '2017-07-31 21:56:26', 6, 32),
	(67, 'deletar', '2017-07-31 21:56:49', '2017-07-31 21:56:49', 6, 32),
	(68, 'detalhes', '2017-07-31 21:57:09', '2017-07-31 21:57:09', 6, 32),
	(69, 'listar', '2017-07-31 21:57:48', '2017-07-31 21:57:48', 6, 32),
	(70, 'editar', '2017-07-31 21:58:55', '2017-07-31 21:58:55', 6, 32),
	(71, 'deletar', '2017-07-31 22:01:36', '2017-07-31 22:01:36', 6, 33),
	(72, 'cadastrar', '2017-07-31 22:02:28', '2017-07-31 22:02:27', 6, 33),
	(73, 'listar', '2017-07-31 22:02:33', '2017-07-31 22:02:33', 6, 33),
	(74, 'editar', '2017-07-31 22:02:41', '2017-07-31 22:02:41', 6, 33),
	(75, 'detalhes', '2017-07-31 22:03:20', '2017-07-31 22:03:20', 6, 33),
	(76, 'deletar', '2017-07-31 22:15:37', '2017-07-31 22:15:37', 6, 35),
	(77, 'cadastrar', '2017-07-31 22:15:50', '2017-07-31 22:15:50', 6, 35),
	(78, 'editar', '2017-07-31 22:15:57', '2017-07-31 22:15:57', 6, 35),
	(79, 'listar', '2017-07-31 22:16:01', '2017-07-31 22:16:01', 6, 35),
	(80, 'cadastrar', '2017-07-31 22:18:29', '2017-07-31 22:18:29', 6, 36),
	(81, 'detalhes', '2017-07-31 22:18:47', '2017-07-31 22:18:47', 6, 36),
	(82, 'editar', '2017-07-31 22:18:51', '2017-07-31 22:18:51', 6, 36),
	(83, 'listar', '2017-07-31 22:18:54', '2017-07-31 22:18:54', 6, 36),
	(84, 'deletar', '2017-07-31 22:19:00', '2017-07-31 22:19:00', 6, 36),
	(85, 'cadastrar', '2017-07-31 22:22:10', '2017-07-31 22:22:10', 6, 37),
	(86, 'listar', '2017-07-31 22:22:38', '2017-07-31 22:22:38', 6, 37),
	(87, 'editar', '2017-07-31 22:22:43', '2017-07-31 22:22:43', 6, 37),
	(88, 'deletar', '2017-07-31 22:22:48', '2017-07-31 22:22:48', 6, 37),
	(89, 'eventos', '2017-07-31 22:23:33', '2017-07-31 22:23:33', 6, 38),
	(90, 'eventos', '2017-07-31 22:23:41', '2017-07-31 22:23:40', 5, 38),
	(91, 'cadastrar', '2017-07-31 22:24:36', '2017-07-31 22:24:36', 5, 32),
	(92, 'deletar', '2017-07-31 22:24:49', '2017-07-31 22:24:49', 5, 32),
	(93, 'cadastrar', '2017-07-31 22:25:49', '2017-07-31 22:25:49', 6, 25),
	(94, 'editar', '2017-07-31 22:25:55', '2017-07-31 22:25:55', 6, 25),
	(95, 'listar', '2017-07-31 22:26:03', '2017-07-31 22:26:03', 6, 25),
	(96, 'deletar', '2017-07-31 22:26:08', '2017-07-31 22:26:08', 6, 25),
	(97, 'cadastrar', '2017-07-31 22:26:27', '2017-07-31 22:26:27', 6, 26),
	(98, 'editar', '2017-07-31 22:26:31', '2017-07-31 22:26:31', 6, 26),
	(99, 'listar', '2017-07-31 22:26:42', '2017-07-31 22:26:42', 6, 26),
	(100, 'deletar', '2017-07-31 22:26:49', '2017-07-31 22:26:49', 6, 26),
	(101, 'cadastrar', '2017-07-31 22:26:57', '2017-07-31 22:26:57', 6, 27),
	(102, 'listar', '2017-07-31 22:27:07', '2017-07-31 22:27:07', 6, 27),
	(103, 'editar', '2017-07-31 22:27:14', '2017-07-31 22:27:14', 6, 27),
	(104, 'deletar', '2017-07-31 22:27:20', '2017-07-31 22:27:20', 6, 27),
	(105, 'perfil', '2017-07-31 22:46:32', '2017-07-31 22:46:32', 5, 29);
/*!40000 ALTER TABLE `acl_privileges` ENABLE KEYS */;

-- Copiando dados para a tabela weekit.acl_resources: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `acl_resources` DISABLE KEYS */;
INSERT INTO `acl_resources` (`id`, `nome`, `descricao`, `created_at`, `updated_at`) VALUES
	(25, 'Acl\\Controller\\Roles', '', '2017-07-31 21:27:52', '2017-07-31 21:27:51'),
	(26, 'Acl\\Controller\\Resources', '', '2017-07-31 21:28:42', '2017-07-31 21:28:42'),
	(27, 'Acl\\Controller\\Privileges', '', '2017-07-31 21:28:57', '2017-07-31 21:28:57'),
	(28, 'Application\\Controller\\Auth', '', '2017-07-31 21:29:00', '2017-07-31 21:29:00'),
	(29, 'Application\\Controller\\Aluno', '', '2017-07-31 21:29:46', '2017-07-31 21:29:46'),
	(30, 'Application\\Controller\\Coordenador', '', '2017-07-31 21:29:57', '2017-07-31 21:29:56'),
	(31, 'Application\\Controller\\Evento', '', '2017-07-31 21:30:15', '2017-07-31 21:30:15'),
	(32, 'Application\\Controller\\Inscricao', '', '2017-07-31 21:30:15', '2017-07-31 21:30:15'),
	(33, 'Application\\Controller\\Local', '', '2017-07-31 21:30:25', '2017-07-31 21:30:24'),
	(35, 'Application\\Controller\\Monitor', '', '2017-07-31 21:31:31', '2017-07-31 21:31:31'),
	(36, 'Application\\Controller\\Palestrante', '', '2017-07-31 21:31:45', '2017-07-31 21:31:45'),
	(37, 'Application\\Controller\\Participante', '', '2017-07-31 21:32:03', '2017-07-31 21:32:03'),
	(38, 'Application\\Controller\\Perfil', '', '2017-07-31 21:32:22', '2017-07-31 21:32:22');
/*!40000 ALTER TABLE `acl_resources` ENABLE KEYS */;

-- Copiando dados para a tabela weekit.acl_roles: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `acl_roles` DISABLE KEYS */;
INSERT INTO `acl_roles` (`id`, `nome`, `descricao`, `created_at`, `updated_at`, `parent_id`) VALUES
	(5, 'aluno', '', '2017-07-31 21:34:39', '2017-07-31 21:34:39', NULL),
	(6, 'coordenador', '', '2017-07-31 21:34:54', '2017-07-31 21:34:54', NULL);
/*!40000 ALTER TABLE `acl_roles` ENABLE KEYS */;

-- Copiando dados para a tabela weekit.evento: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
INSERT INTO `evento` (`id`, `identificador`, `titulo`, `inicio`, `fim`, `carga_horaria`, `maximo_participantes`, `preco`, `tipo`, `cadastrado_em`, `local_id`) VALUES
	(1, 'MC1', 'Desenvolvendo sua primeira aplicação web na Nuvem com o Software Livre Openshift', '2017-02-10 07:08:00', '2017-02-10 08:00:00', 5, 10, 8, 'minicurso', '2017-07-31 17:31:06', 6),
	(3, 'MC2', 'Desmistificando Algoritmos Recursivos – aplicação em Java', '2017-04-03 11:01:00', '2017-04-03 12:00:00', 10, 10, 5.9, 'palestra', '2017-07-31 19:49:20', 3);
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;

-- Copiando dados para a tabela weekit.evento_has_monitor: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `evento_has_monitor` DISABLE KEYS */;
/*!40000 ALTER TABLE `evento_has_monitor` ENABLE KEYS */;

-- Copiando dados para a tabela weekit.evento_has_palestrante: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `evento_has_palestrante` DISABLE KEYS */;
INSERT INTO `evento_has_palestrante` (`evento_id`, `palestrante_id`) VALUES
	(1, 3),
	(3, 3),
	(1, 8),
	(3, 8);
/*!40000 ALTER TABLE `evento_has_palestrante` ENABLE KEYS */;

-- Copiando dados para a tabela weekit.inscricao: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `inscricao` DISABLE KEYS */;
INSERT INTO `inscricao` (`id`, `data`, `status`, `presente`, `participante_id`, `evento_id`) VALUES
	(6, '2017-07-31 19:41:48', 'andamento', NULL, 6, 1),
	(9, '2017-07-31 22:47:12', 'cancelado', NULL, 2, 3);
/*!40000 ALTER TABLE `inscricao` ENABLE KEYS */;

-- Copiando dados para a tabela weekit.local: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `local` DISABLE KEYS */;
INSERT INTO `local` (`id`, `descricao`, `cadastrado_em`) VALUES
	(2, 'Laboratório C3/2', '2017-07-31 14:57:40'),
	(3, 'Laboratório C3/3', '2017-07-31 14:57:49'),
	(4, 'Laboratório G1', '2017-07-31 14:57:57'),
	(5, 'Laboratório D1', '2017-07-31 14:58:06'),
	(6, 'Laboratório CVT', '2017-07-31 14:58:15'),
	(8, 'Laboratório G4', '2017-07-31 14:58:33'),
	(9, 'Laboratório G5', '2017-07-31 14:58:42'),
	(12, 'Laboratório B12', '2017-07-31 15:01:08');
/*!40000 ALTER TABLE `local` ENABLE KEYS */;

-- Copiando dados para a tabela weekit.monitor: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `monitor` DISABLE KEYS */;
/*!40000 ALTER TABLE `monitor` ENABLE KEYS */;

-- Copiando dados para a tabela weekit.palestrante: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `palestrante` DISABLE KEYS */;
INSERT INTO `palestrante` (`id`, `descricao`) VALUES
	(8, 'MSc. Cláudio Rodolfo Sousa de Oliveira'),
	(5, 'Prof. Esp. Bruno Silvério Costa (IFBA)'),
	(7, 'Prof. Esp. Iggor Lincolln (FAINNOR)'),
	(3, 'Prof. Esp. Luiz Fernando Cardeal de Souza (IFBA)'),
	(6, 'Prof. MSc. Liojes Carneiro'),
	(4, 'Prof. MSc. Luis Paulo Da Silva Carvalho (IFBA)'),
	(9, 'Prof. MSc. Mailson Couto'),
	(1, 'Prof. MSc. Stenio Longo (UESB/IFBA)'),
	(2, 'Prof. Pedro Maioli (UESB)');
/*!40000 ALTER TABLE `palestrante` ENABLE KEYS */;

-- Copiando dados para a tabela weekit.participante: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `participante` DISABLE KEYS */;
INSERT INTO `participante` (`id`, `nome`, `sobrenome`, `cpf`, `instituicao`, `sexo`, `telefone1`, `telefone2`, `campus`, `curso`, `tipo`, `email`, `senha`, `cadastrado_em`) VALUES
	(2, 'Fernanda', 'Lima', '426.350.523-95', 'Instituto Federal de Educação, Ciência e Tecnologia da Bahia (IFBA)', 'feminino', '7798854632', '', 'Vitória da Conquista', 'Sistemas de informação', 'aluno', 'fernandalima@live.com', 'Jm/tJ4ar', '2017-07-31 16:13:34'),
	(3, 'Maria', 'Oliveira', '885.646.549-38', 'Faculdade Independente do Nordeste (FAINOR)', 'feminino', '77985632', '', 'Vitória da Conquista', 'Sistemas de informação', 'aluno', 'maria@gmail.com', 'Jm/tJ4ar', '2017-07-31 16:20:49'),
	(4, 'Higor', 'Coltinho', '450.587.414-15', 'Faculdade de Tecnologia e Ciências (FTC)', 'masculino', '77986523', '', 'Vitória da Conquista', 'Nutrição', 'aluno', 'higor.c@gmail.com', 'Jm/tJ4ar', '2017-07-31 16:23:15'),
	(6, 'Pablo', 'Matos', '553.496.981-41', 'Instituto Federal de Educação, Ciência e Tecnologia da Bahia (IFBA)', 'masculino', '779685698', '', 'Vitória da Conquista', 'Sistemas de informação', 'coordenador', 'pablomatos@gmail.com', 'Jm/tJ4ar', '2017-07-31 16:25:49');
/*!40000 ALTER TABLE `participante` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
