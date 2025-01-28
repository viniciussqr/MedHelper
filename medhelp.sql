-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Tempo de geração: 20/01/2025 às 11:27
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
-- Banco de dados: `medhelp`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `medicos`
--

CREATE TABLE `medicos` (
  `siape` varchar(12) NOT NULL,
  `crm` varchar(12) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `telefone` varchar(12) NOT NULL,
  `especializacao` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `matricula` int(11) NOT NULL,
  `genero` varchar(150) NOT NULL,
  `idade` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pacientes_finalizados`
--

CREATE TABLE `pacientes_finalizados` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `matricula` int(11) NOT NULL,
  `genero` varchar(150) NOT NULL,
  `idade` int(5) NOT NULL,
  `situacao` varchar(1500) NOT NULL,
  `medicamento` varchar(150) NOT NULL,
  `qtd_medicamento` int(255) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `qtd_atual` int(11) NOT NULL,
  `tipo_produto` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `servidores`
--

CREATE TABLE `servidores` (
  `siape` varchar(12) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `telefone` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`siape`);

--
-- Índices de tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`codigo`);

--
-- Índices de tabela `pacientes_finalizados`
--
ALTER TABLE `pacientes_finalizados`
  ADD PRIMARY KEY (`codigo`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`codigo`);

--
-- Índices de tabela `servidores`
--
ALTER TABLE `servidores`
  ADD PRIMARY KEY (`siape`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `pacientes_finalizados`
--
ALTER TABLE `pacientes_finalizados`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
