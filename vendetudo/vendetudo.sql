-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Dez-2021 às 21:21
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `vendetudo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `app_configs`
--

CREATE TABLE `app_configs` (
  `config_id` varchar(100) NOT NULL,
  `config_value` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `app_configs`
--

INSERT INTO `app_configs` (`config_id`, `config_value`) VALUES
('APP_TITLE', 'Vendetudo® | A sua plataforma de classificados online',
 ;);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `password` varchar(250) NOT NULL,
  `user_level` int(11) NOT NULL COMMENT '1 : normal user\r\n2 : admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`username`, `nome`, `password`, `user_level`) VALUES
('apinto', 'André Pinto', '123', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `app_configs`
--
ALTER TABLE `app_configs`
  ADD PRIMARY KEY (`config_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
