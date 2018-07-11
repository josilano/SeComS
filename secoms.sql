-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 11-Jul-2018 às 02:25
-- Versão do servidor: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `secoms`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `preco` double(8,2) NOT NULL,
  `url_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `preco`, `url_img`, `created_at`, `updated_at`) VALUES
(1, 'sapato', 'sapato muito confortavel para o dia a dia', 150.00, 'port1.jpg', '2005-07-18 17:44:48', '2018-07-07 21:24:48'),
(2, 'tenis', 'ideal para corrida', 179.63, 'port1.jpg', '2005-07-18 17:49:42', '2005-07-18 17:49:42'),
(3, 'meias nike', 'meias esportivas', 41.90, 'port1.jpg', '2005-07-18 17:59:26', '2005-07-18 17:59:26'),
(4, 'chuteira', 'costura reforÃ§ada nas laterais', 32.56, 'port1.jpg', '2018-07-05 18:02:12', '2018-07-05 18:02:12'),
(5, 'chapeu', 'chapeu preto diluskas', 11.99, 'port1.jpg', '2018-07-05 19:18:30', '2018-07-05 19:18:30'),
(6, 'luvas kargu', 'luvas de luta e treino mma', 45.67, 'port1.jpg', '2018-07-05 19:21:59', '2018-07-05 19:21:59'),
(7, 'luvas maguire', 'luvas de luta para boxe', 44.53, 'port1.jpg', '2018-07-05 19:25:25', '2018-07-05 19:25:25'),
(8, 'teste', 'teste teste', 33.56, 'port1.jpg', '2018-07-05 20:55:47', '2018-07-10 16:06:41'),
(9, 'moto', 'bros preta 2016', 6342.98, 'port1.jpg', '2018-07-05 22:31:07', '2018-07-05 22:31:07'),
(10, 'moto honda', 'bros branca', 4003.45, 'port1.jpg', '2018-07-05 22:35:18', '2018-07-10 15:43:44'),
(11, 'moto honda 150cc', 'moto honda branca bros semi nova', 5678.90, 'port1.jpg', '2018-07-05 22:48:59', '2018-07-05 22:48:59'),
(12, 'moto painel', 'painel da bros branca', 435.68, '339d183074864d6033f3e7cbced0dcd0.jpg', '2018-07-05 22:55:46', '2018-07-10 16:14:00'),
(13, 'cb twister', 'moto honda cb twister muito nova', 8746.58, '34c5fb0bab8a8a07b1113bcfa17e274b.jpg', '2018-07-05 23:14:18', '2018-07-10 21:28:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `promocoes`
--

CREATE TABLE `promocoes` (
  `id` int(10) UNSIGNED NOT NULL,
  `produto_id` int(10) UNSIGNED NOT NULL,
  `preco_promocional` double(8,2) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `promocoes`
--

INSERT INTO `promocoes` (`id`, `produto_id`, `preco_promocional`, `data_inicio`, `data_fim`, `created_at`, `updated_at`) VALUES
(1, 1, 120.03, '2018-07-07', '2018-07-10', '2018-07-07 13:00:01', '2018-07-07 13:01:01'),
(2, 2, 70.53, '2018-07-07', '2018-07-07', '2018-07-07 13:03:01', '2018-07-07 13:03:01'),
(3, 3, 49.01, '2018-07-07', '2018-07-07', '2018-07-07 13:05:01', '2018-07-07 13:05:01'),
(4, 10, 2950.00, '2018-07-10', '2018-07-12', '2018-07-10 15:43:44', '2018-07-10 15:43:44'),
(5, 8, 25.00, '2018-07-09', '2018-07-10', '2018-07-10 16:06:41', '2018-07-10 16:06:41'),
(6, 12, 300.21, '2018-07-08', '2018-07-10', '2018-07-10 16:14:00', '2018-07-10 16:14:00'),
(7, 13, 7500.00, '2018-07-10', '2018-07-10', '2018-07-10 21:28:17', '2018-07-10 21:28:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promocoes`
--
ALTER TABLE `promocoes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `promocoes`
--
ALTER TABLE `promocoes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
