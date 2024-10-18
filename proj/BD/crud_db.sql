-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/10/2024 às 00:14
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
-- Banco de dados: `crud_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `logs`
--

CREATE TABLE `logs` (
  `id` int(6) UNSIGNED NOT NULL,
  `action` varchar(100) DEFAULT NULL,
  `action_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `logs`
--

INSERT INTO `logs` (`id`, `action`, `action_time`) VALUES
(1, 'Adicionou usuário: André Ferreira Zeferino', '2024-10-07 17:11:10'),
(2, 'Adicionou usuário: Ingrid de Lima', '2024-10-07 17:11:31'),
(3, 'Editou usuário ID: 1', '2024-10-07 17:11:45'),
(4, 'Editou usuário ID: 2', '2024-10-07 17:12:09'),
(5, 'Excluiu usuário ID: 2', '2024-10-07 17:12:24'),
(6, 'Excluiu usuário ID: 1', '2024-10-07 17:12:35'),
(7, 'Excluiu usuário ID: 1', '2024-10-08 21:30:23'),
(8, 'Adicionou usuário: André Ferreira Zeferino', '2024-10-08 21:50:46'),
(9, 'Excluiu usuário ID: 1', '2024-10-08 21:50:46'),
(10, 'Editou usuário ID: 3', '2024-10-08 21:52:46'),
(11, 'Editou usuário ID: 3', '2024-10-08 21:52:46'),
(12, 'Adicionou usuário: Ingrid de Lima', '2024-10-08 21:54:23'),
(13, 'Editou usuário ID: 4', '2024-10-08 21:55:07'),
(14, 'Excluiu usuário ID: 3', '2024-10-08 22:02:04'),
(15, 'Excluiu usuário ID: 4', '2024-10-08 22:02:07');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
