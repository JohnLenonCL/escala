-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Jan-2024 às 22:02
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

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
-- Estrutura da tabela `clinicas`
--

CREATE TABLE `clinicas` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `clinicas`
--

INSERT INTO `clinicas` (`id`, `nome`, `endereco`) VALUES
(85, 'Clinica 1', 'aaaaaaaaaaaaaa'),
(136, 'Clinica 2', 'aaaaaaaaa'),
(139, 'Clinica 3', '123213123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `detalhes_clinica`
--

CREATE TABLE `detalhes_clinica` (
  `id` int(11) NOT NULL,
  `id_clinica` int(11) NOT NULL,
  `id_modalidade` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `verificar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `detalhes_clinica`
--

INSERT INTO `detalhes_clinica` (`id`, `id_clinica`, `id_modalidade`, `id_medico`, `verificar`) VALUES
(26, 85, 13, 0, 1),
(27, 85, 30, 0, 1),
(28, 85, 32, 0, 1),
(29, 85, 0, 7, 1),
(30, 85, 0, 38, 1),
(31, 85, 0, 55, 1),
(32, 85, 0, 54, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `detalhes_medico`
--

CREATE TABLE `detalhes_medico` (
  `id` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `id_modalidade` int(11) NOT NULL,
  `id_sub` int(11) NOT NULL,
  `verificar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `detalhes_medico`
--

INSERT INTO `detalhes_medico` (`id`, `id_medico`, `id_modalidade`, `id_sub`, `verificar`) VALUES
(22, 7, 13, 57, 1),
(23, 7, 13, 58, 1),
(24, 7, 30, 59, 0),
(25, 38, 13, 58, 0),
(26, 38, 30, 59, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `escalas`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `escalas`
--

INSERT INTO `escalas` (`id`, `id_clinica`, `id_medico`, `data_adicionada`, `hora_inicio`, `hora_fim`, `vigencia`, `semana`) VALUES
(76, 85, 38, '2024-01-16', '17:08:00', '17:10:00', 'dia', 'segunda'),
(77, 85, 7, '2024-01-18', '17:23:00', '20:23:00', 'semana', 'segunda');

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicos`
--

CREATE TABLE `medicos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `medicos`
--

INSERT INTO `medicos` (`id`, `nome`, `email`, `cpf`, `senha`, `cor`) VALUES
(7, 'Medico 1', 'medico@gmail.com', '111.111.111-11', '$2y$10$XvppY0Pb6mtAfr2NFl4xy.PujqUjSIYBoS8TO7ecILcClvdk7azJG', '#ff0000'),
(38, 'Medico 2', 'medico2@gmail.com', '123.123.123-21', '$2y$10$6P/u4gVHOAh7i.1sLCok5OcvTA9JU15X6HaqOIr8tdMw3sJhcbaYC', '#74d241'),
(54, 'Medico 3', 'medico3@gmail.com', '123.456.789-09', '4d2f946194482b44a1b209259cc66c81', '#264b6d'),
(55, 'Medico 4', 'medico4@gmail.com', '132.121.321-23', '202cb962ac59075b964b07152d234b70', '#6fff0f');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modalidades`
--

CREATE TABLE `modalidades` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `modalidades`
--

INSERT INTO `modalidades` (`id`, `nome`) VALUES
(13, 'Modalidade 1'),
(30, 'Modalidade 2'),
(32, 'Modalidade 3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `recuperacao`
--

CREATE TABLE `recuperacao` (
  `utilizador` varchar(255) NOT NULL,
  `confirmacao` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `recuperacao`
--

INSERT INTO `recuperacao` (`utilizador`, `confirmacao`) VALUES
('john@gmail.com', '20504c3cf30fa045a0ea8a11a04edeb22e2104d3'),
('john@gmail.com', 'dfebb672d09be310340b4a5c6e15eb14d332c20e'),
('john@gmail.com', 'e304c1585abf6ce952068e3a11c52a015893f78c'),
('john@gmail.com', 'fd32a4e4bacf6583bd121a6d24a17570499c7105');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sub_modalidades`
--

CREATE TABLE `sub_modalidades` (
  `id` int(11) NOT NULL,
  `id_modalidades` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `sub_modalidades`
--

INSERT INTO `sub_modalidades` (`id`, `id_modalidades`, `nome`) VALUES
(57, 13, 'Sub 1'),
(58, 13, 'Sub 2'),
(59, 30, 'Sub 1 (Modalidade 2)');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `icone_nome` varchar(255) NOT NULL,
  `recuperar_senha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `cpf`, `senha`, `icone_nome`, `recuperar_senha`) VALUES
(10, 'John Lenon', 'john@gmail.com', '342.342.343-43', '$2y$10$xbSPUAKaH.pSFTAl.d.93uqgY8PiKQ6MU9Sz/OKMfrLPyebjLkxUy', 'imagens/6579e9eea4db7_Dicas-para-comprar-um-carro-novo-como-T-Cross.jpg', 'NULL');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clinicas`
--
ALTER TABLE `clinicas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `detalhes_clinica`
--
ALTER TABLE `detalhes_clinica`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `detalhes_medico`
--
ALTER TABLE `detalhes_medico`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `escalas`
--
ALTER TABLE `escalas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `modalidades`
--
ALTER TABLE `modalidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `recuperacao`
--
ALTER TABLE `recuperacao`
  ADD KEY `utilizador` (`utilizador`,`confirmacao`);

--
-- Índices para tabela `sub_modalidades`
--
ALTER TABLE `sub_modalidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clinicas`
--
ALTER TABLE `clinicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT de tabela `detalhes_clinica`
--
ALTER TABLE `detalhes_clinica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `detalhes_medico`
--
ALTER TABLE `detalhes_medico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `escalas`
--
ALTER TABLE `escalas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=757;

--
-- AUTO_INCREMENT de tabela `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `modalidades`
--
ALTER TABLE `modalidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `sub_modalidades`
--
ALTER TABLE `sub_modalidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
