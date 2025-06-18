-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Jun-2025 às 14:09
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pap`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `data_publicacao` date DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `descricao`, `data_publicacao`, `imagem`) VALUES
(1, 'Volta Do passado', 'Temporal Ages', '2025-06-18', 'noticia_68527d1e2eec1.jpg'),
(2, 'd', 'd', '2025-06-18', 'noticia_6852aad9b6c83.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `mensagem` text NOT NULL,
  `data_postagem` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `titulo`, `autor`, `mensagem`, `data_postagem`) VALUES
(1, 'Teste', '', 'Teste', '2025-06-18 08:43:32'),
(2, 'Teste', 'aaaaaaa', 'Teste', '2025-06-18 10:03:00'),
(3, 'teste', 'aaaaaaa', 'teste', '2025-06-18 10:04:42'),
(4, 'teste', 'aaaaaaa', '11111111111111111111111111111111111111111111111111111111111111111', '2025-06-18 10:07:23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id_utl` int(11) NOT NULL,
  `pais` varchar(30) NOT NULL,
  `email` varchar(70) NOT NULL,
  `data_nasc` date NOT NULL,
  `battletag` varchar(30) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`id_utl`, `pais`, `email`, `data_nasc`, `battletag`, `pass`) VALUES
(1, '', 'franciscof140706@icloud.com', '2025-02-26', 's1mple', '1'),
(3, '', 's1mples.pt@gmail.com', '2000-12-12', 'Ferrerzzzz', '$2y$10$ZMOkVSIhl1CkY'),
(4, '', '1234@gmail.com', '2000-12-12', 'Ferrerzzz', '$2y$10$mJY6boVT4s27Y'),
(6, '', 'teste', '2000-12-12', '1234', '$2y$10$idRPa5OU2ee.V'),
(7, '', 'teste1234', '2000-12-12', 'aaaaaaa', '$2y$10$GlxcIuAkPDhFl2oyJWejeeqpa6vLV9YeiYUYwLz33lt..4sPlv3Tu'),
(8, '', 'admin@temporalages.gg', '2000-12-12', 'Admin', '$2y$10$9dPK3kXlsyDJAcvqYDKwDe6RYXuySWgfAtK9JZEQfvjwr4KUscgD6');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id_utl`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id_utl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
