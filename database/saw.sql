SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(45) NOT NULL,
  `image` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `forgotpassword` (
  `id` int(11) NOT NULL,
  `email` varchar(144) NOT NULL,
  `token` varchar(256) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `gender` enum('Masculine','Feminine','Other') NOT NULL DEFAULT 'Other'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `type` varchar(144) NOT NULL,
  `message` longtext NOT NULL,
  `error` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(144) NOT NULL,
  `price` double NOT NULL,
  `data` datetime NOT NULL,
  `description` longtext NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `productimage` (
  `id` int(11) NOT NULL,
  `name` varchar(144) NOT NULL,
  `type` varchar(144) NOT NULL,
  `data` blob NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `state` varchar(144) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `createdDate` datetime NOT NULL,
  `state_id` int(11) NOT NULL,
  `gender_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `userimage` (
  `id` int(11) NOT NULL,
  `name` varchar(144) NOT NULL,
  `type` varchar(144) NOT NULL,
  `data` blob NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `forgotpassword`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_category1_idx` (`category_id`),
  ADD KEY `fk_product_user1_idx` (`user_id`);

ALTER TABLE `productimage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productImage_product1_idx` (`product_id`);

ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_state1_idx` (`state_id`),
  ADD KEY `fk_user_gender1_idx` (`gender_id`);

ALTER TABLE `userimage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_userImage_user1_idx` (`user_id`);

ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `forgotpassword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `productimage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `userimage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `productimage`
  ADD CONSTRAINT `fk_productImage_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_state1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `userimage`
  ADD CONSTRAINT `fk_userImage_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;