-- Database: `siga`
--

CREATE DATABASE IF NOT EXISTS `siga` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `siga`;

-- --------------------------------------------------------

--
-- Table structure for table `disciplina`
--

CREATE TABLE `disciplina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `matricula` varchar(255) NOT NULL,
  `contato` varchar(255) DEFAULT NULL,
  `tipo` int(11) NOT NULL COMMENT '1: Professor, 2: Aluno',
  `nome_prof` varchar(255) DEFAULT NULL,
  `nome_aluno` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `matricula` (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `atividade`
--

CREATE TABLE `atividade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `peso` float NOT NULL,
  `anexo` varchar(255) DEFAULT NULL,
  `tipo` int(11) NOT NULL COMMENT '1: Prova, 2: Trabalho',
  `recuperacao` tinyint(1) DEFAULT NULL,
  `equipe` tinyint(1) DEFAULT NULL,
  `idDisciplina` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idDisciplina` (`idDisciplina`),
  CONSTRAINT `atividade_ibfk_1` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;