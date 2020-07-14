-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2020 at 07:53 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restoran_brze_hrane`
--

-- --------------------------------------------------------

--
-- Table structure for table `jelovnik`
--

CREATE TABLE `jelovnik` (
  `ID` int(250) NOT NULL,
  `Naziv_jela` varchar(250) COLLATE latin2_croatian_ci NOT NULL,
  `Kategorija` varchar(250) COLLATE latin2_croatian_ci NOT NULL,
  `Cijena` int(250) NOT NULL,
  `StatistikaJela` int(250) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `jelovnik`
--

INSERT INTO `jelovnik` (`ID`, `Naziv_jela`, `Kategorija`, `Cijena`, `StatistikaJela`) VALUES
(1, 'Hamburger', 'Burgeri', 15, 0),
(2, 'Cheeseburger', 'Burgeri', 17, 0),
(3, 'Tortilja sa piletinom', 'Tortilje i kebabi', 18, 0),
(4, 'Tortilja s govedinom', 'Tortilje i kebabi', 20, 0),
(5, 'Pomfrit', 'Prilozi', 10, 0),
(6, 'Restani krumpir\r\n', 'Prilozi', 12, 0),
(7, 'Čevapi\r\n', 'Ostalo', 20, 0),
(8, 'Hot dog\r\n', 'Ostalo', 15, 0),
(9, 'Coca cola\r\n', 'Pica', 10, 0),
(10, 'Mineralna voda', 'Pica', 10, 0),
(11, 'Chicken Burger', 'Burgeri', 17, 0),
(13, 'Vegi', 'Burgeri', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `ID` int(250) NOT NULL,
  `Korisnicko_ime` varchar(250) COLLATE latin2_croatian_ci NOT NULL,
  `Datum` datetime NOT NULL DEFAULT current_timestamp(),
  `Komentar` text COLLATE latin2_croatian_ci NOT NULL,
  `ID_stranice` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`ID`, `Korisnicko_ime`, `Datum`, `Komentar`, `ID_stranice`) VALUES
(4, 'Admin', '2020-07-07 10:41:50', 'com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `ID` int(250) NOT NULL,
  `Ime` varchar(250) COLLATE latin2_croatian_ci NOT NULL,
  `Prezime` varchar(250) COLLATE latin2_croatian_ci NOT NULL,
  `Korisnicko_ime` varchar(250) COLLATE latin2_croatian_ci NOT NULL,
  `Email` varchar(250) COLLATE latin2_croatian_ci NOT NULL,
  `Lozinka` varchar(250) COLLATE latin2_croatian_ci NOT NULL,
  `Uloga` varchar(250) COLLATE latin2_croatian_ci NOT NULL DEFAULT 'Korisnik',
  `Statistika` int(250) NOT NULL DEFAULT 0,
  `Potrosnja` int(250) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`ID`, `Ime`, `Prezime`, `Korisnicko_ime`, `Email`, `Lozinka`, `Uloga`, `Statistika`, `Potrosnja`) VALUES
(1, 'Robert', 'Horvat', 'Admin', 'admin@gmail.com', 'admin1234', 'Administrator', 16, 3415),
(10, 'Robi', 'Horvat', 'robi007', 'robi007@gmail.com', '1234qwer', 'Korisnik', 14, 1544);

-- --------------------------------------------------------

--
-- Table structure for table `narudzba`
--

CREATE TABLE `narudzba` (
  `ID` int(250) NOT NULL,
  `Korisnik_id` int(250) NOT NULL,
  `Korisnicko_ime` varchar(250) COLLATE latin2_croatian_ci NOT NULL,
  `Adresa` varchar(250) COLLATE latin2_croatian_ci NOT NULL,
  `Detalji_narudzbe` text COLLATE latin2_croatian_ci NOT NULL,
  `Datum` datetime NOT NULL DEFAULT current_timestamp(),
  `Ukupna_cijena` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `narudzba`
--

INSERT INTO `narudzba` (`ID`, `Korisnik_id`, `Korisnicko_ime`, `Adresa`, `Detalji_narudzbe`, `Datum`, `Ukupna_cijena`) VALUES
(92, 10, 'robi007', 'Adresa 2', 'ID: 1 - Naziv: Hamburger - Kolicina: 1 - Cijena: 15 kn - Ukupna cijena jela:15 kn <br />\r\nID: 5 - Naziv: Pomfrit - Kolicina: 1 - Cijena: 10 kn - Ukupna cijena jela:10 kn <br />\r\nID: 9 - Naziv: Coca cola<br />\r\n - Kolicina: 1 - Cijena: 10 kn - Ukupna cijena jela:10 kn <br />\r\n', '2020-07-02 18:03:53', 35),
(93, 10, 'robi007', 'Adresa 1', 'ID: 1 - Naziv: Hamburger - Kolicina: 1 - Cijena: 15 kn - Ukupna cijena jela:15 kn <br />\r\nID: 5 - Naziv: Pomfrit - Kolicina: 1 - Cijena: 10 kn - Ukupna cijena jela:10 kn <br />\r\n', '2020-07-02 18:09:02', 25),
(94, 10, 'robi007', 'Adresa 1', 'ID: 3 - Naziv: Tortilja sa piletinom - Kolicina: 1 - Cijena: 18 kn - Ukupna cijena jela:18 kn <br />\r\nID: 4 - Naziv: Tortilja s govedinom - Kolicina: 1 - Cijena: 20 kn - Ukupna cijena jela:20 kn <br />\r\n', '2020-07-02 18:10:47', 38),
(95, 10, 'robi007', 'Adresa 1', 'ID: 1 - Naziv: Hamburger - Kolicina: 1 - Cijena: 15 kn - Ukupna cijena jela:15 kn <br />\r\nID: 3 - Naziv: Tortilja sa piletinom - Kolicina: 1 - Cijena: 18 kn - Ukupna cijena jela:18 kn <br />\r\n', '2020-07-02 18:11:13', 33),
(96, 10, 'robi007', 'Adresa 1', 'ID: 1 - Naziv: Hamburger - Kolicina: 1 - Cijena: 15 kn - Ukupna cijena jela:15 kn <br />\r\nID: 3 - Naziv: Tortilja sa piletinom - Kolicina: 1 - Cijena: 18 kn - Ukupna cijena jela:18 kn <br />\r\n', '2020-07-02 18:12:56', 33),
(97, 10, 'robi007', 'Adresa 1', 'ID: 1 - Naziv: Hamburger - Kolicina: 1 - Cijena: 15 kn - Ukupna cijena jela:15 kn <br />\r\nID: 5 - Naziv: Pomfrit - Kolicina: 1 - Cijena: 10 kn - Ukupna cijena jela:10 kn <br />\r\n', '2020-07-02 18:15:05', 25),
(98, 10, 'robi007', 'Adresa 2', 'ID: 1 - Naziv: Hamburger - Kolicina: 1 - Cijena: 15 kn - Ukupna cijena jela:15 kn <br />\r\nID: 2 - Naziv: Cheeseburger - Kolicina: 1 - Cijena: 17 kn - Ukupna cijena jela:17 kn <br />\r\nID: 13 - Naziv: Vegi - Kolicina: 1 - Cijena: 5 kn - Ukupna cijena jela:5 kn <br />\r\nID: 7 - Naziv: Čevapi<br />\r\n - Kolicina: 1 - Cijena: 20 kn - Ukupna cijena jela:20 kn <br />\r\n', '2020-07-02 18:15:18', 57),
(99, 10, 'robi007', 'Adresa 1', 'ID: 1 - Naziv: Hamburger - Kolicina: 1 - Cijena: 15 kn - Ukupna cijena jela:15 kn <br />\r\nID: 2 - Naziv: Cheeseburger - Kolicina: 1 - Cijena: 17 kn - Ukupna cijena jela:17 kn <br />\r\n', '2020-07-06 14:07:42', 32),
(100, 1, 'Admin', 'Adresa 1', 'ID: 1 - Naziv: Hamburger - Kolicina: 1 - Cijena: 15 kn - Ukupna cijena jela:15 kn <br />\r\nID: 5 - Naziv: Pomfrit - Kolicina: 1 - Cijena: 10 kn - Ukupna cijena jela:10 kn <br />\r\n', '2020-07-08 20:03:20', 25),
(101, 1, 'Admin', 'Adresa 2', 'ID: 13 - Naziv: Vegi - Kolicina: 1 - Cijena: 5 kn - Ukupna cijena jela:5 kn <br />\r\n', '2020-07-08 20:10:56', 5),
(102, 1, 'Admin', 'Adresa 2', 'ID: 3 - Naziv: Tortilja sa piletinom - Kolicina: 1 - Cijena: 18 kn - Ukupna cijena jela:18 kn <br />\r\nID: 9 - Naziv: Coca cola<br />\r\n - Kolicina: 1 - Cijena: 10 kn - Ukupna cijena jela:10 kn <br />\r\n', '2020-07-09 20:27:45', 28),
(103, 1, 'Admin', 'Adresa 1', 'ID: 1 - Naziv: Hamburger - Kolicina: 1 - Cijena: 15 kn - Ukupna cijena jela:15 kn <br />\r\nID: 5 - Naziv: Pomfrit - Kolicina: 1 - Cijena: 10 kn - Ukupna cijena jela:10 kn <br />\r\n', '2020-07-09 21:33:33', 25),
(104, 1, 'Admin', 'Adresa 1', 'ID: 1 - Naziv: Hamburger - Kolicina: 1 - Cijena: 15 kn - Ukupna cijena jela:15 kn <br />\r\nID: 7 - Naziv: Čevapi<br />\r\n - Kolicina: 1 - Cijena: 20 kn - Ukupna cijena jela:20 kn <br />\r\n', '2020-07-09 21:36:03', 35),
(105, 1, 'Admin', 'Adresa 1', 'ID: 10 - Naziv: Mineralna voda - Kolicina: 1 - Cijena: 10 kn - Ukupna cijena jela:10 kn <br />\r\nID: 6 - Naziv: Restani krumpir<br />\r\n - Kolicina: 1 - Cijena: 12 kn - Ukupna cijena jela:12 kn <br />\r\n', '2020-07-09 21:39:31', 22),
(106, 1, 'Admin', 'Adresa 1', 'ID: 1 - Naziv: Hamburger - Kolicina: 1 - Cijena: 15 kn - Ukupna cijena jela:15 kn <br />\r\n', '2020-07-09 21:44:53', 15),
(107, 1, 'Admin', 'Adresa 1', 'ID: 1 - Naziv: Hamburger - Kolicina: 1 - Cijena: 15 kn - Ukupna cijena jela:15 kn <br />\r\nID: 7 - Naziv: Čevapi<br />\r\n - Kolicina: 1 - Cijena: 20 kn - Ukupna cijena jela:20 kn <br />\r\n', '2020-07-09 21:45:26', 35),
(108, 1, 'Admin', 'Adresa 1', 'ID: 1 - Naziv: Hamburger - Kolicina: 1 - Cijena: 15 kn - Ukupna cijena jela:15 kn <br />\r\nID: 7 - Naziv: Čevapi<br />\r\n - Kolicina: 1 - Cijena: 20 kn - Ukupna cijena jela:20 kn <br />\r\n', '2020-07-09 21:45:43', 35),
(109, 1, 'Admin', 'Adresa 1', 'ID: 1 - Naziv: Hamburger - Kolicina: 1 - Cijena: 15 kn - Ukupna cijena jela:15 kn <br />\r\nID: 7 - Naziv: Čevapi<br />\r\n - Kolicina: 1 - Cijena: 20 kn - Ukupna cijena jela:20 kn <br />\r\n', '2020-07-09 21:47:59', 35),
(110, 1, 'Admin', 'Adresa 1', 'ID: 1 - Naziv: Hamburger - Kolicina: 1 - Cijena: 15 kn - Ukupna cijena jela:15 kn <br />\r\nID: 9 - Naziv: Coca cola<br />\r\n - Kolicina: 1 - Cijena: 10 kn - Ukupna cijena jela:10 kn <br />\r\n', '2020-07-09 21:49:26', 25),
(111, 1, 'Admin', 'Adresa 1', 'ID: 1 - Naziv: Hamburger - Kolicina: 1 - Cijena: 15 kn - Ukupna cijena jela:15 kn <br />\r\nID: 5 - Naziv: Pomfrit - Kolicina: 1 - Cijena: 10 kn - Ukupna cijena jela:10 kn <br />\r\n', '2020-07-09 21:49:52', 25),
(112, 1, 'Admin', 'Adresa 1', 'ID: 1 - Naziv: Hamburger - Kolicina: 1 - Cijena: 15 kn - Ukupna cijena jela:15 kn <br />\r\nID: 8 - Naziv: Hot dog<br />\r\n - Kolicina: 1 - Cijena: 15 kn - Ukupna cijena jela:15 kn <br />\r\n', '2020-07-10 20:45:05', 30),
(113, 1, 'Admin', 'Adresa 1', 'ID: 1 - Naziv: Hamburger - Kolicina: 1 - Cijena: 15 kn - Ukupna cijena jela:15 kn <br />\r\nID: 3 - Naziv: Tortilja sa piletinom - Kolicina: 1 - Cijena: 18 kn - Ukupna cijena jela:18 kn <br />\r\n', '2020-07-10 20:48:53', 33),
(114, 1, 'Admin', 'Adresa 2', 'ID: 1 - Naziv: Hamburger - Kolicina: 1 - Cijena: 15 kn - Ukupna cijena jela:15 kn <br />\r\nID: 5 - Naziv: Pomfrit - Kolicina: 1 - Cijena: 10 kn - Ukupna cijena jela:10 kn <br />\r\n', '2020-07-10 20:50:02', 25),
(115, 1, 'Admin', 'Adresa 1', 'ID: 2 - Naziv: Cheeseburger - Kolicina: 1 - Cijena: 17 kn - Ukupna cijena jela:17 kn <br />\r\nID: 10 - Naziv: Mineralna voda - Kolicina: 1 - Cijena: 10 kn - Ukupna cijena jela:10 kn <br />\r\n', '2020-07-10 20:51:57', 27);

-- --------------------------------------------------------

--
-- Table structure for table `statistika`
--

CREATE TABLE `statistika` (
  `ID` int(250) NOT NULL,
  `Ukupno_narudzba` int(250) NOT NULL DEFAULT 0,
  `Ukupno_korisnika` int(250) NOT NULL DEFAULT 0,
  `Zbroj_zarade` int(250) NOT NULL DEFAULT 0,
  `Ukupno_pogleda_web` int(250) NOT NULL DEFAULT 0,
  `Narudzba_jela` text COLLATE latin2_croatian_ci DEFAULT NULL,
  `Najvise_narucivano_jelo` varchar(250) COLLATE latin2_croatian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `statistika`
--

INSERT INTO `statistika` (`ID`, `Ukupno_narudzba`, `Ukupno_korisnika`, `Zbroj_zarade`, `Ukupno_pogleda_web`, `Narudzba_jela`, `Najvise_narucivano_jelo`) VALUES
(1, 30, 1, 703, 46, 'Cheeseburger,Mineralna voda,Hamburger,Pomfrit,Hamburger,Tortilja sa piletinom,Hamburger,Hot dog\r\n,Hamburger,Pomfrit,Hamburger,Coca cola\r\n,Hamburger,Čevapi\r\n,Hamburger,Čevapi\r\n,Hamburger,Čevapi\r\n,Hamburger,Mineralna voda,Restani krumpir\r\n,Hamburger,Čevapi\r\n,Hamburger,Pomfrit,Tortilja sa piletinom,Coca cola\r\n,Vegi,Hamburger,Pomfrit,Hamburger,Cheeseburger,Hamburger,Cheeseburger,Vegi,Čevapi Hamburger,Pomfrit,Hamburger,Tortilja sa piletinom,Hamburger,Tortilja sa piletinom Tortilja sa piletinom,Tortilja s govedinom,Hamburger,Pomfrit', 'Hamburger');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jelovnik`
--
ALTER TABLE `jelovnik`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Korisnicko_ime` (`Korisnicko_ime`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `narudzba`
--
ALTER TABLE `narudzba`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`),
  ADD KEY `Korisnik_id` (`Korisnik_id`);

--
-- Indexes for table `statistika`
--
ALTER TABLE `statistika`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jelovnik`
--
ALTER TABLE `jelovnik`
  MODIFY `ID` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `komentari`
--
ALTER TABLE `komentari`
  MODIFY `ID` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `ID` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `narudzba`
--
ALTER TABLE `narudzba`
  MODIFY `ID` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `statistika`
--
ALTER TABLE `statistika`
  MODIFY `ID` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
