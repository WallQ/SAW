-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Jan-2022 às 15:26
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `saw`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(45) NOT NULL,
  `fileName` varchar(244) NOT NULL DEFAULT 'default.webp'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `category`
--

INSERT INTO `category` (`id`, `category`, `fileName`) VALUES
(1, 'Animals', '1.png'),
(2, 'Childrens', '2.png'),
(3, 'Automobiles', '3.png'),
(4, 'Smartphones', '4.png'),
(5, 'Equipment', '5.png'),
(6, 'Farming', '6.png'),
(7, 'Fashion', '7.png'),
(8, 'Furniture', '8.png'),
(9, 'Gaming', '9.png'),
(10, 'Jobs', '10.png'),
(11, 'Others', '11.png'),
(12, 'Properties', '12.png'),
(13, 'Services', '13.png'),
(14, 'Sports', '14.png'),
(15, 'Technology', '15.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `forgotpassword`
--

CREATE TABLE `forgotpassword` (
  `id` int(11) NOT NULL,
  `email` varchar(144) NOT NULL,
  `token` varchar(256) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `forgotpassword`
--

INSERT INTO `forgotpassword` (`id`, `email`, `token`, `date`) VALUES
(17, '8200615@estg.ipp.pt', '$2y$12$fHJLQrG.e4KOlto3zXlMMupRB2Z.K6T7gxdYZNcOh5iqzi3rCbahS', '2022-01-03 14:18:40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `gender` varchar(144) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `gender`
--

INSERT INTO `gender` (`id`, `gender`) VALUES
(1, 'Masculine'),
(2, 'Feminine'),
(3, 'Other');

-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `type` varchar(144) NOT NULL,
  `message` longtext NOT NULL,
  `error` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(144) NOT NULL,
  `price` double NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `description` longtext NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `data`, `description`, `category_id`, `user_id`) VALUES
(1, 'McLaren 570', 200000, '2021-12-21 17:12:04', 'McLaren 570 570cv', 3, 1),
(2, 'BMW M8', 150000, '2021-12-21 17:11:07', 'BMW M8 625cv', 3, 1),
(3, 'Audi R8', 100000, '2021-12-21 17:12:47', 'Audi R8 525cv', 3, 1),
(4, 'Bulldog francês', 600, '2021-12-21 17:24:04', 'Cão com excelente estado de saúde', 1, 2),
(5, 'Dobermann', 600, '2021-12-21 17:30:35', 'Excelente cadelinha exemplar da raça. Grande temperamento, morfologia e comportamento', 1, 2),
(6, 'Chihuahua', 500, '2021-12-21 17:31:12', 'Com boletim sanitário em dia ou seja vacinas e desparasitações adequadas a idade e microchip', 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `productimage`
--

CREATE TABLE `productimage` (
  `id` int(11) NOT NULL,
  `fileName` varchar(144) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `productimage`
--

INSERT INTO `productimage` (`id`, `fileName`, `product_id`) VALUES
(1, '124785509861c20ae475f682.04940147.jpg', 1),
(2, '165838050161c20ae4768ad2.19448274.jpg', 1),
(3, '201701900561c20ae477ba39.16347448.jpg', 1),
(4, '78505632461c20aabc3f797.84077461.jpg', 2),
(5, '141990013861c20aabc4bea5.10736946.jpg', 2),
(6, '117607394761c20aabc56fa6.70406089.jpg', 2),
(7, '121585311961c20b0f29f059.57664631.jpg', 3),
(8, '184590936961c20b0f2a7e33.36418526.jpg', 3),
(9, '59245697561c20b0f2b40d1.46712810.jpg', 3),
(10, '134239085961c20db4412585.78014182.jpg', 4),
(11, '102129248961c20db441a047.52231934.jpg', 4),
(12, '161594856461c20db4424408.39443926.jpg', 4),
(13, '163284207661c20f3bcd5d96.68166925.jpg', 5),
(14, '60297361061c20f3bcdcd80.96708351.jpg', 5),
(15, '79636370461c20f3bcfc004.09009411.jpg', 5),
(16, '62417297761c20f60190944.17642952.jpg', 6),
(17, '159711579561c20f601a5ae8.62157380.jpg', 6),
(18, '168875523661c20f601aaa00.07213128.jpg', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `state` varchar(144) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `state`
--

INSERT INTO `state` (`id`, `state`) VALUES
(1, 'Lisboa'),
(2, 'Porto'),
(3, 'Setúbal'),
(4, 'Braga'),
(5, 'Aveiro'),
(6, 'Faro'),
(7, 'Leiria'),
(8, 'Santarém'),
(9, 'Coimbra'),
(10, 'Viseu'),
(11, 'Madeira'),
(12, 'Açores'),
(13, 'Viana'),
(14, 'Vila'),
(15, 'Castelo'),
(16, 'Évora'),
(17, 'Beja'),
(18, 'Guarda'),
(19, 'Bragança'),
(20, 'Portalegre');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(144) NOT NULL,
  `lastName` varchar(144) NOT NULL,
  `telephone` int(11) NOT NULL,
  `city` varchar(144) NOT NULL,
  `zipCode` varchar(144) NOT NULL,
  `email` varchar(144) NOT NULL,
  `password` varchar(256) NOT NULL,
  `level` enum('Admin','User') NOT NULL DEFAULT 'User',
  `status` enum('Blocked','Allowed') NOT NULL DEFAULT 'Allowed',
  `imagePath` varchar(244) NOT NULL DEFAULT 'default.webp',
  `createdDate` datetime NOT NULL DEFAULT current_timestamp(),
  `state_id` int(11) NOT NULL,
  `gender_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `telephone`, `city`, `zipCode`, `email`, `password`, `level`, `status`, `imagePath`, `createdDate`, `state_id`, `gender_id`) VALUES
(1, 'Sérgio', 'Félix', 916275619, 'Felgueiras', '4610-806', '8200615@estg.ipp.pt', '$2y$12$87tOTtwiU7QFBYV2pCMhtugYO1Md58emsiEXcDRULju5gTUFD4g1q', 'User', 'Allowed', 'default.webp', '2021-12-21 16:49:48', 2, 1),
(2, 'André', 'Pinto', 918133838, 'Santo Tirso', '4780-000', '8200613@estg.ipp.pt', '$2y$12$3Z0TysN//4ieLLrIxnZWD.gogi1bihtA8bs6tGoFR7SRO8ytffr4e', 'User', 'Allowed', 'default.webp', '2021-12-21 17:20:14', 2, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `forgotpassword`
--
ALTER TABLE `forgotpassword`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_category1_idx` (`category_id`),
  ADD KEY `fk_product_user1_idx` (`user_id`);

--
-- Índices para tabela `productimage`
--
ALTER TABLE `productimage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productImage_product1_idx` (`product_id`);

--
-- Índices para tabela `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_state1_idx` (`state_id`),
  ADD KEY `fk_user_gender1_idx` (`gender_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `forgotpassword`
--
ALTER TABLE `forgotpassword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `productimage`
--
ALTER TABLE `productimage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de tabela `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `productimage`
--
ALTER TABLE `productimage`
  ADD CONSTRAINT `fk_productImage_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_gender1_idx` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_state1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
