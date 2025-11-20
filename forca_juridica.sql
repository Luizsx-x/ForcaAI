-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 03/11/2025 às 05:33
-- Versão do servidor: 11.5.2-MariaDB
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `forca_juridica`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `advogados`
--

DROP TABLE IF EXISTS `advogados`;
CREATE TABLE IF NOT EXISTS `advogados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `oab_frente` varchar(255) DEFAULT NULL,
  `oab_verso` varchar(255) DEFAULT NULL,
  `data_cadastro` timestamp NULL DEFAULT current_timestamp(),
  `estado` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `advogados`
--

INSERT INTO `advogados` (`id`, `nome`, `email`, `telefone`, `senha_hash`, `oab_frente`, `oab_verso`, `data_cadastro`, `estado`) VALUES
(1, 'advogado1', 'advogado1@gmail.com', '(11) 00000-0000', '123', NULL, NULL, '2025-09-11 16:08:44', 'São Paulo'),
(2, 'advogado2', 'advogado2@gmail.com', '(11) 00000-0000', '123', NULL, NULL, '2025-09-13 15:54:21', 'Rio de Janeiro'),
(3, 'advogado3', 'advogado3@gmail.com', '(11) 00000-0000', '123', NULL, NULL, '2025-09-13 15:54:21', 'Bahia'),
(5, 'miguel', 'miguel@gmail.com', '(11)00000-0000', '123', 'sla', 'sla', '2025-09-13 16:40:09', 'São Paulo'),
(6, 'bruna', 'bruna@gmail.com', '(11)00000-0000', '123', 'sla', 'sla', '2025-09-13 16:48:37', 'Bahia');

-- --------------------------------------------------------

--
-- Estrutura para tabela `advogado_especialidade`
--

DROP TABLE IF EXISTS `advogado_especialidade`;
CREATE TABLE IF NOT EXISTS `advogado_especialidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `advogado_id` int(11) NOT NULL,
  `especialidade_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `advogado_id` (`advogado_id`),
  KEY `especialidade_id` (`especialidade_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `advogado_especialidade`
--

INSERT INTO `advogado_especialidade` (`id`, `advogado_id`, `especialidade_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 5, 2),
(5, 6, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `aceitou_termos` tinyint(1) NOT NULL DEFAULT 0,
  `maior_idade` tinyint(1) NOT NULL DEFAULT 0,
  `data_criacao` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `telefone`, `senha`, `aceitou_termos`, `maior_idade`, `data_criacao`) VALUES
(1, 'joao', 'joao@gmail.com', '(11) 00000-0000', '123', 1, 18, '2025-09-11 14:56:36'),
(2, 'maria', 'maria@gmail.com', '(11)00000-0000', '123', 1, 1, '2025-09-13 16:13:51'),
(3, 'carla', 'carla@gmail.com', '(11)00000-0000', '123', 1, 1, '2025-10-13 00:15:01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `especialidades`
--

DROP TABLE IF EXISTS `especialidades`;
CREATE TABLE IF NOT EXISTS `especialidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `especialidades`
--

INSERT INTO `especialidades` (`id`, `nome`) VALUES
(1, 'Direito Civil'),
(2, 'Direito Trabalhista'),
(3, 'Direito Penal');

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `advogado_especialidade`
--
ALTER TABLE `advogado_especialidade`
  ADD CONSTRAINT `advogado_especialidade_ibfk_1` FOREIGN KEY (`advogado_id`) REFERENCES `advogados` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `advogado_especialidade_ibfk_2` FOREIGN KEY (`especialidade_id`) REFERENCES `especialidades` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
CREATE TABLE IF NOT EXISTS casos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    advogado_id INT NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'Em andamento',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (advogado_id) REFERENCES advogados(id) ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS agenda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    advogado_id INT NOT NULL,
    data DATE NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    FOREIGN KEY (advogado_id) REFERENCES advogados(id) ON DELETE CASCADE
);-- Criar tabela casos, se não existir
CREATE TABLE IF NOT EXISTS casos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    advogado_id INT NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'Em andamento',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (advogado_id) REFERENCES advogados(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Criar tabela agenda, se não existir
CREATE TABLE IF NOT EXISTS agenda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    advogado_id INT NOT NULL,
    data DATE NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    FOREIGN KEY (advogado_id) REFERENCES advogados(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
  