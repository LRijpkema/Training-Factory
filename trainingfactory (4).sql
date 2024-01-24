-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 19 jun 2023 om 11:18
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trainingfactory`
--
CREATE DATABASE IF NOT EXISTS `trainingfactory` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `trainingfactory`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230613111041', '2023-06-13 13:20:16', 136),
('DoctrineMigrations\\Version20230613131412', '2023-06-13 15:14:21', 20),
('DoctrineMigrations\\Version20230613132100', '2023-06-13 15:21:14', 43),
('DoctrineMigrations\\Version20230613134600', '2023-06-13 15:46:08', 34),
('DoctrineMigrations\\Version20230613134808', '2023-06-13 15:48:36', 85);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `training_id` int(11) DEFAULT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `max_persons` int(11) NOT NULL,
  `trainer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `lesson`
--

INSERT INTO `lesson` (`id`, `training_id`, `time`, `date`, `location`, `max_persons`, `trainer_id`) VALUES
(3, 4, '15:00:00', '2024-08-01', 'Den Haag', 10, 1),
(4, 4, '12:00:00', '2018-06-11', 'Den Haag', 56, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `payment` tinyint(1) DEFAULT NULL,
  `lesson_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `registration`
--

INSERT INTO `registration` (`id`, `payment`, `lesson_id`, `member_id`) VALUES
(12, 1, 3, 5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `training`
--

CREATE TABLE `training` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `extra_cost` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `training`
--

INSERT INTO `training` (`id`, `name`, `description`, `duration`, `extra_cost`, `image`) VALUES
(2, 'Boxing', 'Onze bokslessen bieden een combinatie van krachttraining, uithoudingsvermogen en techniek, waarbij je onder begeleiding van ervaren instructeurs werkt aan je conditie, coördinatie en stressvermindering.', 90, 0, 'imgs/boxing.jpg'),
(4, 'Kickboxing', 'Onze kickbokslessen bieden een energieke mix van kracht, techniek en cardio, met aandacht voor verschillende kickbokstechnieken zoals trappen, stoten en verdediging. Onder begeleiding van ervaren instructeurs verbeter je je conditie, coördinatie en stress', 60, 0, 'imgs/kickboxing.jpg'),
(5, 'Hiit', 'Onze HIIT-lessen: intens, effectief en resultaatgericht. Verbeter je conditie, verbrand vet en bouw spierkracht op met afwisselende oefeningen onder begeleiding van ervaren instructeurs. Haal het maximale uit elke trainingssessie!', 60, 0, 'imgs/hiit.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `hiring_date` date DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `social_sec_number` int(11) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`, `hiring_date`, `salary`, `social_sec_number`, `street`, `place`) VALUES
(1, 'trainer@trainingfactory.nl', '[\"ROLE_TRAINER\"]', '$2y$13$eJeBZGbgBX.LffYo5ZHGJOmD.vN7grd48sRbAbdcNByKO35yz.3Yq', 'Chad', 'van Dijk', '2025-10-06', 2000, 2147483647, 'Straat 232', 'Den Haag'),
(2, 'member@trainingfactory.nl', '[\"ROLE_MEMBER\"]', '$2y$13$ktSrsR2cyaqsO3hMQCy1W./Uf.h/P3BJ508VK99zqklELaGvi08KG', 'Lulu', 'Rijpkema', NULL, NULL, NULL, 'Straat 123', 'Den Haag'),
(3, 'trainer2@trainingfactory.nl', '[\"ROLE_TRAINER\"]', '$2y$13$imwyDKaBUoaQhlvyN5Jns.F0ikq0s3O9nVJvoxs4xCo4t1.MTbIEW', 'Sofia ', 'Bakker', '2023-10-09', -35, 28534534, 'Straat', 'Den Haag'),
(4, 'admin@trainingfactory.nl', '[\"ROLE_ADMIN\"]', '$2y$13$yN.Sbir15JIScEGP.kjnRud9/IlbBguO7m7SKxQrHP1C7ceR3fG76', 'admin', 'admin', NULL, NULL, NULL, 'admin 123', 'admin'),
(5, 'member3@gmail.com', '[\"ROLE_MEMBER\"]', '$2y$13$QOeMWhPtVGI0jTf8i3qyT.47TpyYpmjLr1qxMQnsNUVIir0ekstZm', 'Lars ', 'Vermeulen', NULL, NULL, NULL, 'Staat 123', 'Den Haag');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexen voor tabel `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F87474F3BEFD98D1` (`training_id`),
  ADD KEY `IDX_F87474F3FB08EDF6` (`trainer_id`);

--
-- Indexen voor tabel `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexen voor tabel `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_62A8A7A7CDF80196` (`lesson_id`),
  ADD KEY `IDX_62A8A7A77597D3FE` (`member_id`);

--
-- Indexen voor tabel `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `training`
--
ALTER TABLE `training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `FK_F87474F3BEFD98D1` FOREIGN KEY (`training_id`) REFERENCES `training` (`id`),
  ADD CONSTRAINT `FK_F87474F3FB08EDF6` FOREIGN KEY (`trainer_id`) REFERENCES `user` (`id`);

--
-- Beperkingen voor tabel `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `FK_62A8A7A77597D3FE` FOREIGN KEY (`member_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_62A8A7A7CDF80196` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
