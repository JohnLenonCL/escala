-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/01/2024 às 15:12
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto_escala`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `escalas`
--

CREATE TABLE `escalas` (
  `id` int(11) NOT NULL,
  `id_clinica` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `data_adicionada` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fim` time NOT NULL,
  `vigencia` varchar(255) NOT NULL,
  `semana` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `escalas`
--

INSERT INTO `escalas` (`id`, `id_clinica`, `id_medico`, `data_adicionada`, `hora_inicio`, `hora_fim`, `vigencia`, `semana`) VALUES
(91, 85, 7, '2024-01-23', '10:00:00', '10:04:00', 'dia', 'segunda'),
(93, 85, 38, '2024-01-17', '11:07:00', '11:08:00', 'ano', 'segunda');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `escalas`
--
ALTER TABLE `escalas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `escalas`
--
ALTER TABLE `escalas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
