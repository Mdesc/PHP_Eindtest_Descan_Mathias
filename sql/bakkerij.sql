-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 19 nov 2014 om 13:57
-- Serverversie: 5.6.16
-- PHP-versie: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `bakkerij`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling`
--

CREATE TABLE IF NOT EXISTS `bestelling` (
  `bestelling_id` int(11) NOT NULL AUTO_INCREMENT,
  `klant_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `aantal` int(11) NOT NULL,
  `datum_gemaakt` datetime NOT NULL,
  `datum_afhalen` datetime NOT NULL,
  PRIMARY KEY (`bestelling_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Gegevens worden geëxporteerd voor tabel `bestelling`
--

INSERT INTO `bestelling` (`bestelling_id`, `klant_id`, `product_id`, `aantal`, `datum_gemaakt`, `datum_afhalen`) VALUES
(1, 5, 1, 100, '2014-10-29 14:00:00', '2014-11-20 14:00:00'),
(2, 5, 5, 100, '2014-11-03 09:00:00', '2014-11-18 00:00:00'),
(3, 5, 4, 5, '2014-11-03 09:00:00', '2014-11-18 09:00:00'),
(6, 5, 1, 1, '2014-10-29 14:00:00', '2014-11-20 00:00:00'),
(10, 1, 1, 1, '2014-10-29 14:00:00', '2014-10-29 14:00:00'),
(14, 5, 1, 3, '2014-11-18 15:08:16', '2014-11-21 00:00:00'),
(15, 5, 10, 5, '2014-11-18 15:08:19', '2014-11-21 00:00:00'),
(16, 5, 6, 2, '2014-11-18 15:08:23', '2014-11-20 00:00:00'),
(17, 8, 4, 3, '2014-11-18 15:11:55', '2014-11-20 00:00:00'),
(18, 8, 6, 15, '2014-11-18 15:12:01', '2014-11-19 00:00:00'),
(19, 8, 7, 15, '2014-11-18 15:12:06', '2014-11-20 00:00:00'),
(20, 5, 1, 1, '2014-11-19 12:05:24', '2014-11-22 00:00:00'),
(21, 5, 2, 1, '2014-11-19 12:05:27', '2014-11-22 00:00:00'),
(22, 5, 10, 1, '2014-11-19 12:05:43', '2014-11-22 00:00:00'),
(23, 5, 7, 5, '2014-11-19 12:05:48', '2014-11-22 00:00:00'),
(24, 5, 6, 15, '2014-11-19 12:06:02', '2014-11-22 00:00:00'),
(25, 5, 5, 10, '2014-11-19 12:06:05', '2014-11-22 00:00:00'),
(26, 5, 1, 2, '2014-11-19 12:06:53', '0000-00-00 00:00:00'),
(27, 9, 1, 2, '2014-11-19 13:45:51', '2014-11-21 00:00:00'),
(28, 9, 9, 2, '2014-11-19 13:45:53', '2014-11-21 00:00:00'),
(29, 10, 9, 1, '2014-11-19 13:50:26', '2014-11-22 00:00:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruiker`
--

CREATE TABLE IF NOT EXISTS `gebruiker` (
  `klant_id` int(3) NOT NULL AUTO_INCREMENT,
  `naam` varchar(20) NOT NULL,
  `voornaam` varchar(20) NOT NULL,
  `straat` varchar(20) NOT NULL,
  `huisnr` int(4) NOT NULL,
  `bus` int(4) NOT NULL,
  `postcode_id` int(4) NOT NULL,
  `email` varchar(45) NOT NULL,
  `wachtwoord` varchar(45) NOT NULL,
  `block` tinyint(1) NOT NULL,
  PRIMARY KEY (`klant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Gegevens worden geëxporteerd voor tabel `gebruiker`
--

INSERT INTO `gebruiker` (`klant_id`, `naam`, `voornaam`, `straat`, `huisnr`, `bus`, `postcode_id`, `email`, `wachtwoord`, `block`) VALUES
(1, 'descan', 'jonas', 'hogestraat', 34, 0, 1, '0', '2014', 1),
(2, 'descan', 'mathias', 'hogestraat', 34, 0, 2, 'm', 'b9b948d5884c9f1df251a5f4d4dcfa82943137d7', 0),
(3, 'descan', 'jonas', 'hogestraat', 34, 0, 2, 'random.descan@yahoo.com', 'wachtwoord', 0),
(4, 'descan', 'jonas', 'hogestraat', 34, 0, 2, 'admin@yahoo.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0),
(5, 'feryn', 'floor', 'diksmuidemarkt', 12, 0, 1, 'floorj@hotmail.com', 'cac8aa6c2242d625eeb2a30d5080c9fba412fed7', 0),
(6, 'feryn', 'thijs', 'diksmuidemarkt', 12, 0, 1, 'thijstje@hotmail.com', '46dcaee9ccf5c7a2e3c758c7be11edfe26ed8639', 1),
(7, 'geen postcode', 'gemeente', '', 0, 0, 1, 'post@code.gemeente', '9ab64660b041c980bfb2dcd4a9a3608aa0e22925', 1),
(8, 'kolonel', 'maronzo', 'brugsesteenweg', 104, 0, 4, 'kolonel@ramport.com', '94a4fe33724d6e276b79b08fccfb4107bd14405f', 0),
(9, 'mathias', 'descan', 'hogestraat', 34, 0, 3, 'mathias.descan@yahoo.com', 'cab688b8c08abbeab2cab044a4327263356a6996', 0),
(10, 'descan', 'jonas', '', 0, 0, 1, 'jonas.descan@skynet.be', 'fa7c191392480807b4969ce58d0d6cb800ca89fb', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gemeente`
--

CREATE TABLE IF NOT EXISTS `gemeente` (
  `postcode_id` int(4) NOT NULL AUTO_INCREMENT,
  `postcode` int(6) NOT NULL,
  `gemeente` varchar(30) NOT NULL,
  PRIMARY KEY (`postcode_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Gegevens worden geëxporteerd voor tabel `gemeente`
--

INSERT INTO `gemeente` (`postcode_id`, `postcode`, `gemeente`) VALUES
(1, 0, 'geen waarde'),
(2, 8610, 'kortemark'),
(3, 8610, 'werken'),
(4, 8800, 'roeselare');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `productgroep_id` int(11) NOT NULL,
  `product` varchar(25) NOT NULL,
  `kostprijs_stuk` float NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`product_id`, `productgroep_id`, `product`, `kostprijs_stuk`) VALUES
(1, 1, 'groot wit brood', 2.5),
(2, 1, 'groot bruin brood', 2.4),
(3, 1, 'groot volkoren brood', 2.1),
(5, 3, 'sandwich', 0.95),
(6, 3, 'witte pistolet', 0.75),
(7, 3, 'bruine pistolet', 0.95),
(8, 3, 'meergranen', 1.05),
(9, 2, '4 personen biscuit', 14.5),
(10, 2, '4 personen fruittaart', 14.5),
(11, 3, 'ovenkoek', 1.8),
(12, 3, 'boterkoek', 0.65),
(13, 3, 'chocoladekoek', 0.95),
(14, 2, 'kerststronk', 16.9),
(15, 4, 'nieuw', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `productgroep`
--

CREATE TABLE IF NOT EXISTS `productgroep` (
  `productgroep_id` int(3) NOT NULL AUTO_INCREMENT,
  `productgroep_naam` varchar(25) NOT NULL,
  `productgroep_image` varchar(50) NOT NULL,
  PRIMARY KEY (`productgroep_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Gegevens worden geëxporteerd voor tabel `productgroep`
--

INSERT INTO `productgroep` (`productgroep_id`, `productgroep_naam`, `productgroep_image`) VALUES
(1, 'Brood', 'Images/Brood.jpg'),
(2, 'Gebak', 'Images/Gebak.jpg'),
(3, 'Pistolets', 'Images/Pistolets.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
