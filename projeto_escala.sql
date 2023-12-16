-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/12/2023 às 13:22
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
-- Estrutura para tabela `clinicas`
--

CREATE TABLE `clinicas` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clinicas`
--

INSERT INTO `clinicas` (`id`, `nome`, `endereco`) VALUES
(85, 'Clinica 1', 'aaaaaaaaaaaaaa'),
(136, 'Clinica 2', 'aaaaaaaaa'),
(139, 'Clinica 3', '123213123');

-- --------------------------------------------------------

--
-- Estrutura para tabela `detalhes_clinica`
--

CREATE TABLE `detalhes_clinica` (
  `id` int(11) NOT NULL,
  `id_clinica` int(11) NOT NULL,
  `id_modalidade` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `verificar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `detalhes_clinica`
--

INSERT INTO `detalhes_clinica` (`id`, `id_clinica`, `id_modalidade`, `id_medico`, `verificar`) VALUES
(17, 85, 13, 0, 0),
(18, 85, 0, 7, 0),
(19, 85, 0, 38, 0),
(20, 136, 0, 7, 0),
(21, 85, 30, 0, 0),
(22, 85, 32, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `detalhes_medico`
--

CREATE TABLE `detalhes_medico` (
  `id` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `id_modalidade` int(11) NOT NULL,
  `verificar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Estrutura para tabela `medicos`
--

CREATE TABLE `medicos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `medicos`
--

INSERT INTO `medicos` (`id`, `nome`, `email`, `cpf`, `senha`) VALUES
(7, 'Medico 1', 'medico@gmail.com', '111.111.111-11', '81dc9bdb52d04dc20036dbd8313ed055'),
(38, 'Medico 2', 'medico2@gmail.com', '123.123.123-21', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Estrutura para tabela `modalidades`
--

CREATE TABLE `modalidades` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `modalidades`
--

INSERT INTO `modalidades` (`id`, `nome`) VALUES
(13, 'Modalidade 1'),
(30, 'Modalidade 2'),
(32, 'Modalidade 3');

-- --------------------------------------------------------

--
-- Estrutura para tabela `recuperacao`
--

CREATE TABLE `recuperacao` (
  `utilizador` varchar(255) NOT NULL,
  `confirmacao` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `recuperacao`
--

INSERT INTO `recuperacao` (`utilizador`, `confirmacao`) VALUES
('john@gmail.com', '20504c3cf30fa045a0ea8a11a04edeb22e2104d3'),
('john@gmail.com', 'dfebb672d09be310340b4a5c6e15eb14d332c20e'),
('john@gmail.com', 'e304c1585abf6ce952068e3a11c52a015893f78c'),
('john@gmail.com', 'fd32a4e4bacf6583bd121a6d24a17570499c7105');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sub_modalidades`
--

CREATE TABLE `sub_modalidades` (
  `id` int(11) NOT NULL,
  `id_modalidades` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `icone_nome` varchar(255) NOT NULL,
  `recuperar_senha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `cpf`, `senha`, `icone_nome`, `recuperar_senha`) VALUES
(10, 'John Lenon', 'john@gmail.com', '342.342.343-43', '$2y$10$K7pCo7HKuEKs21CDhsu3puuLER5V5jVmB3WICEPHsvztAF5NSJMNO', 'imagens/6579e9eea4db7_Dicas-para-comprar-um-carro-novo-como-T-Cross.jpg', 'NULL');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clinicas`
--
ALTER TABLE `clinicas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `detalhes_clinica`
--
ALTER TABLE `detalhes_clinica`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `detalhes_medico`
--
ALTER TABLE `detalhes_medico`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `escalas`
--
ALTER TABLE `escalas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `modalidades`
--
ALTER TABLE `modalidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `recuperacao`
--
ALTER TABLE `recuperacao`
  ADD KEY `utilizador` (`utilizador`,`confirmacao`);

--
-- Índices de tabela `sub_modalidades`
--
ALTER TABLE `sub_modalidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clinicas`
--
ALTER TABLE `clinicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT de tabela `detalhes_clinica`
--
ALTER TABLE `detalhes_clinica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `detalhes_medico`
--
ALTER TABLE `detalhes_medico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `escalas`
--
ALTER TABLE `escalas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `modalidades`
--
ALTER TABLE `modalidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `sub_modalidades`
--
ALTER TABLE `sub_modalidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
