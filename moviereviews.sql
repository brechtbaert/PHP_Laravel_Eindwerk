-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 16 jun 2019 om 15:07
-- Serverversie: 5.7.24
-- PHP-versie: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviereviews`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_acteurs`
--

DROP TABLE IF EXISTS `tbl_acteurs`;
CREATE TABLE IF NOT EXISTS `tbl_acteurs` (
  `acteur_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `fname` varchar(250) NOT NULL,
  PRIMARY KEY (`acteur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_acteurs`
--

INSERT INTO `tbl_acteurs` (`acteur_id`, `name`, `fname`) VALUES
(1, 'De Niro', 'Robert'),
(2, 'Pacino', 'Al'),
(3, 'Di Caprio', 'Leonardo'),
(4, 'Winslet', 'Kate'),
(5, 'Travolta', 'John'),
(6, 'Jackson', 'Samuel L.'),
(7, 'Dreyfuss', 'Richard'),
(8, 'Pitt', 'Brad'),
(9, 'Norton', 'Edward');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_films`
--

DROP TABLE IF EXISTS `tbl_films`;
CREATE TABLE IF NOT EXISTS `tbl_films` (
  `film_id` int(11) NOT NULL AUTO_INCREMENT,
  `titel` varchar(250) NOT NULL,
  `jaar` int(4) NOT NULL,
  PRIMARY KEY (`film_id`),
  UNIQUE KEY `tbl_films_film_id_uindex` (`film_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_films`
--

INSERT INTO `tbl_films` (`film_id`, `titel`, `jaar`) VALUES
(1, 'A Good Day to Die Hard', 2013),
(2, 'Avengers: Endgame', 2019),
(3, 'Deadpool', 2016),
(4, 'Rogue One: A Star Wars Story', 2016),
(5, 'Blade Runner 2049', 2017),
(6, 'It', 2017),
(7, 'The Incredibles', 2004),
(8, 'Toy Story 3', 2010),
(11, 'The Lego Movie 2', 2019);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_films_regisseur`
--

DROP TABLE IF EXISTS `tbl_films_regisseur`;
CREATE TABLE IF NOT EXISTS `tbl_films_regisseur` (
  `film_reg_id` int(11) NOT NULL AUTO_INCREMENT,
  `film_id` int(11) NOT NULL,
  `reg_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`film_reg_id`),
  KEY `tbl_films_regisseur_tbl_films_film_id_fk` (`film_id`),
  KEY `tbl_films_regisseur_tbl_regisseurs_regisseur_id_fk` (`reg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_films_regisseur`
--

INSERT INTO `tbl_films_regisseur` (`film_reg_id`, `film_id`, `reg_id`) VALUES
(1, 1, 3),
(2, 2, 2),
(3, 11, 6),
(4, 3, 2),
(5, 4, 6),
(6, 5, 2),
(7, 6, 7),
(8, 7, 5),
(9, 8, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_film_acteur`
--

DROP TABLE IF EXISTS `tbl_film_acteur`;
CREATE TABLE IF NOT EXISTS `tbl_film_acteur` (
  `film_act_id` int(11) NOT NULL AUTO_INCREMENT,
  `film_id` int(11) NOT NULL,
  `acteur_id` int(11) NOT NULL,
  PRIMARY KEY (`film_act_id`),
  KEY `tbl_film_acteur_tbl_acteurs_acteur_id_fk` (`acteur_id`),
  KEY `tbl_film_acteur_tbl_films_film_id_fk` (`film_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_film_acteur`
--

INSERT INTO `tbl_film_acteur` (`film_act_id`, `film_id`, `acteur_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_regisseurs`
--

DROP TABLE IF EXISTS `tbl_regisseurs`;
CREATE TABLE IF NOT EXISTS `tbl_regisseurs` (
  `regisseur_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `fname` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`regisseur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_regisseurs`
--

INSERT INTO `tbl_regisseurs` (`regisseur_id`, `name`, `fname`) VALUES
(1, 'Coppola', 'Francis F.'),
(2, 'Tarantino', 'Quentin'),
(3, 'Spielberg', 'Stephen'),
(4, 'Scorsese', 'Martin'),
(5, 'Fincher', 'David'),
(6, 'Burton', 'Tim'),
(7, 'Cameron', 'James');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_review`
--

DROP TABLE IF EXISTS `tbl_review`;
CREATE TABLE IF NOT EXISTS `tbl_review` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `film_id` int(11) DEFAULT NULL,
  `review` longtext NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`review_id`),
  KEY `tbl_review_tbl_users_user_id_fk` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_review`
--

INSERT INTO `tbl_review` (`review_id`, `user_id`, `film_id`, `review`, `rating`) VALUES
(1, 1, 11, 'test', 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'brecht', 'brechtbaert95@gmail.com', NULL, '$2y$10$FLJyP15V7557ssXQHanJDeudfqa81l6v6MnUXUG7gWQrtM37bQ/We', NULL, '2019-05-17 06:28:06', '2019-05-17 06:28:06');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
