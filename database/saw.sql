-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Jan-2022 às 00:27
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
-- Estrutura da tabela `attempt`
--

CREATE TABLE `attempt` (
  `id` int(11) NOT NULL,
  `email` varchar(144) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `type` enum('Error','Log') NOT NULL,
  `subType` enum('SELECT','INSERT','UPDATE','DELETE') NOT NULL,
  `message` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `ip` varchar(144) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `name` varchar(144) NOT NULL,
  `email` varchar(144) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(144) NOT NULL,
  `price` double NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `description` longtext NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `date`, `description`, `category_id`, `user_id`) VALUES
(1, 'McLaren 570', 200000, '2022-01-10 20:22:08', 'McLaren 570 570cv', 3, 1),
(2, 'BMW M8', 150000, '2021-12-21 17:11:07', 'BMW M8 625cv', 3, 1),
(3, 'Audi R8', 100000, '2021-12-21 17:12:47', 'Audi R8 525cv', 3, 1),
(4, 'Bulldog francês', 600, '2021-12-21 17:24:04', 'Cão com excelente estado de saúde', 1, 2),
(5, 'Dobermann', 600, '2021-12-21 17:30:35', 'Excelente cadelinha exemplar da raça. Grande temperamento, morfologia e comportamento', 1, 2),
(6, 'Chihuahua', 500, '2021-12-21 17:31:12', 'Com boletim sanitário em dia ou seja vacinas e desparasitações adequadas a idade e microchip', 1, 2),
(21, 'Bosh Aparafusadora', 180, '2022-01-10 20:34:57', 'Como nova!', 5, 1),
(22, 'Bosh Berbequim', 180, '2022-01-10 20:43:26', 'Com algum desgaste, mas funciona que nem uma maravilha!\r\nVerdadeiros interessados contactar!', 5, 1),
(23, 'Bosh SerraCircular', 220, '2022-01-10 20:44:01', 'Não funciona de resto esta impecável.', 5, 1),
(24, 'Motocultivador', 2500, '2022-01-10 20:45:27', 'Viatura impecável, poucos km&#39;s.\r\nVendo por motivo de falta de uso.\r\nSó pegar e lavrar!', 6, 2),
(25, 'Chicco Carrinho de passeio', 90, '2022-01-10 20:49:37', 'Usado poucas vezes pois o meu filho cresceu muito rápido.', 2, 5),
(26, 'Rolex Submariner', 1200, '2022-01-10 20:54:31', '100% Original\r\nComprado na loja dos chineses ainda tenho fatura.\r\nGarantia vitalícia.', 7, 5),
(27, 'Cozinha', 1800, '2022-01-10 21:00:44', 'Cozinhas por medida.\r\nEm melamina, termolaminado, lacado... orçamentos grátis sem compromisso.', 8, 6),
(28, 'Portátil Asus X556', 650, '2022-01-10 21:02:57', 'Portátil gaming XPTO roda Fortnite.', 9, 6),
(29, 'Bíblia Pastoral 3 Volumes', 100, '2022-01-10 21:06:25', 'Que a palavra do Senhor esteja convosco, pois comigo não está mais, passei para o outro lado...', 11, 6),
(30, 'OnePlus 9 Pro', 200, '2022-01-10 21:08:56', 'Negócio sincero...\r\nO telemóvel está bloqueado pois foi roubado e eu comprei pois não sabia.\r\nÉ para despachar...', 4, 2),
(31, 'Casa em Oeiras', 250000, '2022-01-10 21:23:12', 'Casa com 10 anos.', 12, 7),
(32, 'JBL Charge 3', 160, '2022-01-10 21:27:00', 'Vendo coluna de som JBL Charge 3 nova sem marcas de uso usada 3 vezes.\r\nMotivo de venda tenho uma coluna de som maior.', 15, 7),
(33, 'Trotinete Eletrica', 200, '2022-01-10 21:27:53', 'Vendo trotinete elétrica por falta de uso, a trotinete ta nova, foi apenas usada 2 ou 3 vezes, tem 2 meses apenas', 14, 7);

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
(18, '168875523661c20f601aaa00.07213128.jpg', 6),
(52, '5949130561dc9871584138.53543580.jpg', 21),
(53, '186121880861dc987158a566.65592906.jpg', 21),
(54, '203356198361dc9871598f38.10485136.jpg', 21),
(55, '204500270561dc9a6ed52215.42663908.jpg', 22),
(56, '17575127961dc9a6ed59d27.10079470.jpg', 22),
(57, '42812864861dc9a917f6387.34127172.jpg', 23),
(58, '129977309361dc9ae708daf3.54298208.jpg', 24),
(59, '169586416261dc9ae7098f40.69836375.jpg', 24),
(60, '65758526761dc9ae70a87e6.03650640.jpg', 24),
(61, '173230781061dc9be1232892.52977496.jpeg', 25),
(62, '22718710361dc9d0798b840.19022522.jpg', 26),
(63, '120583778061dc9d07994961.99385452.jpg', 26),
(64, '6563691161dc9d079a1a30.47325780.jpg', 26),
(65, '184856277061dc9e7ca6aa01.77551101.jpg', 27),
(66, '172808264761dc9e7ca71ba8.65550309.jpg', 27),
(67, '212380202361dc9e7ca846c0.11348711.jpg', 27),
(68, '22634608361dc9f01335609.55538333.jpg', 28),
(69, '148997731561dc9f01339eb5.52793776.jpg', 28),
(70, '167505555561dc9f013453b6.43394257.jpg', 28),
(71, '7826241161dc9fd118aec5.89551655.jpg', 29),
(72, '135992647761dc9fd11928e1.57358758.jpg', 29),
(73, '136533152361dc9fd119c911.28717458.jpg', 29),
(74, '2752413261dca068d74d26.36776011.jpg', 30),
(75, '170756850661dca068d78fc4.65744181.jpg', 30),
(76, '188609434861dca3c0a378c1.13939084.jpg', 31),
(77, '153384838861dca3c0a40e10.13972514.jpg', 31),
(78, '64354501661dca3c0a48124.00962664.jpg', 31),
(79, '89914892861dca3c0a4ee73.41957622.jpg', 31),
(80, '1247283961dca3c0a57a63.19634771.jpg', 31),
(81, '91264260561dca3c0a5d575.99768435.jpg', 31),
(82, '190780234661dca3c0a62786.09558385.jpg', 31),
(83, '72108600861dca3c0a67f19.93286549.jpg', 31),
(84, '26521637061dca3c0a6cdd4.50866479.jpg', 31),
(85, '138960950661dca4a42e2ab2.94125858.jpg', 32),
(86, '136477343361dca4a42e9c53.71864216.jpg', 32),
(87, '13452816961dca4a42f1068.72309070.jpg', 32),
(88, '62516739861dca4d94604b3.77360710.jpg', 33);

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
  `imagePath` varchar(244) NOT NULL DEFAULT 'default.jpg',
  `createdDate` datetime NOT NULL DEFAULT current_timestamp(),
  `state_id` int(11) NOT NULL,
  `gender_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `telephone`, `city`, `zipCode`, `email`, `password`, `level`, `status`, `imagePath`, `createdDate`, `state_id`, `gender_id`) VALUES
(1, 'Sérgio', 'Félix', 916275619, 'Felgueiras', '4610-806', '8200615@estg.ipp.pt', '$2y$12$87tOTtwiU7QFBYV2pCMhtugYO1Md58emsiEXcDRULju5gTUFD4g1q', 'Admin', 'Allowed', '37350761061dc97ebe88082.62939113.jpg', '2021-12-21 16:49:48', 2, 1),
(2, 'André', 'Pinto', 918133838, 'Santo Tirso', '4780-000', '8200613@estg.ipp.pt', '$2y$12$87tOTtwiU7QFBYV2pCMhtugYO1Md58emsiEXcDRULju5gTUFD4g1q', 'Admin', 'Allowed', '169458791161d9de3653bbf5.39946476.jpg', '2021-12-21 17:20:14', 2, 2),
(5, 'Rui', 'Silva', 919191919, 'Maceira', '2400-100', 'ruisilva@gmail.com', '$2y$12$FbErm.d4n7.wzlU6leRsce9VQvs5X8etumzBFRV8cNyPCfCvLTti.', 'User', 'Allowed', '44326659461dd91cfceeae2.85786194.jpg', '2022-01-10 20:48:19', 7, 1),
(6, 'Manuel', 'Alegre', 964596486, 'Neiva', '4900-293', 'manuelalegre@outlook.pt', '$2y$12$nResfcRkGADAtRbdPNOeJO0naxucsD/IUU3X3qDNg4ksUhBORQ9jC', 'User', 'Allowed', 'default.jpg', '2022-01-10 21:00:09', 15, 1),
(7, 'Joana', 'Albuquerque', 939393939, 'Sintra', '1685-464', 'joanaalbuquerque@gmail.com', '$2y$12$0JtV/dneO3iAUQ5X.oImXOd7Yzy07.BOaLrAR4MMdxAPZFuSj2MRW', 'User', 'Allowed', '190728396961dca26194ab02.15852208.jpg', '2022-01-10 21:16:27', 1, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `attempt`
--
ALTER TABLE `attempt`
  ADD PRIMARY KEY (`id`);

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
-- Índices para tabela `newsletter`
--
ALTER TABLE `newsletter`
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
-- AUTO_INCREMENT de tabela `attempt`
--
ALTER TABLE `attempt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de tabela `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `productimage`
--
ALTER TABLE `productimage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de tabela `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
