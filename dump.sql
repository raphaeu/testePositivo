-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 31-Ago-2016 às 05:41
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `positivo_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`) VALUES
(1, 'nome do cliente 1'),
(2, 'Nome do cliente 2'),
(3, 'Nome do cliente 3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `embalagens`
--

CREATE TABLE `embalagens` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `volume` int(11) NOT NULL,
  `preco` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `embalagens`
--

INSERT INTO `embalagens` (`id`, `nome`, `volume`, `preco`) VALUES
(1, 'Embalagem 1', 10, 10.1),
(2, 'Embalagem 2', 20, 20.2),
(3, 'Embalagem 3', 30, 30.3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidoitens`
--

CREATE TABLE `pedidoitens` (
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `preco` float NOT NULL,
  `qtd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `dt_pedido` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `volume` int(11) NOT NULL,
  `preco` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `volume`, `preco`) VALUES
(1, 'Nome produto 1', 10, 1.1),
(2, 'Nome produto 2', 20, 2.2),
(3, 'Nome produto 3', 30, 3.3),
(4, 'Nome produto 4', 40, 4.4),
(5, 'Nome produto 5', 50, 5.5),
(6, 'Nome produto 6', 60, 6.6),
(7, 'Nome produto 7', 70, 7.7),
(8, 'Nome produto 8', 80, 8.8),
(9, 'Nome produto 9', 90, 9.9),
(10, 'Nome produto 10', 100, 10.1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `embalagens`
--
ALTER TABLE `embalagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pedidoitens`
--
ALTER TABLE `pedidoitens`
  ADD PRIMARY KEY (`id_produto`,`id_pedido`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `embalagens`
--
ALTER TABLE `embalagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
