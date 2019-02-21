-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Sty 2018, 09:01
-- Wersja serwera: 10.1.29-MariaDB
-- Wersja PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ogloszenia`
--

CREATE TABLE `ogloszenia` (
  `idOgloszenia` int(11) NOT NULL,
  `tytul` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `tresc` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `idUser` int(11) NOT NULL,
  `data` date NOT NULL,
  `telefon` varchar(9) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `ogloszenia`
--

INSERT INTO `ogloszenia` (`idOgloszenia`, `tytul`, `tresc`, `idUser`, `data`, `telefon`) VALUES
(14, 'Sprzedam Opla!', 'Mam do sprzedania Opla z przebiegiem 200 tyś. km. Zainteresowanych zapraszam do kontaktu.', 13, '2018-01-16', '543212643'),
(15, 'Sprzedam opony do Opla!', 'Mam do sprzedania opony do Opla!', 13, '2018-01-16', '534212777'),
(17, 'Kupię opony do Opla', 'Kupię opony do Opla Corsy.', 14, '2018-01-18', '879321000'),
(18, 'ogłoszenie testowe-edit', 'tresc testowa -edytowana', 15, '2018-01-19', '987654321');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `idUser` int(10) NOT NULL,
  `login` varchar(255) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rejestracja` int(10) NOT NULL,
  `logowanie` int(10) NOT NULL,
  `ip` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`idUser`, `login`, `haslo`, `email`, `rejestracja`, `logowanie`, `ip`) VALUES
(15, 'beata', '$2y$10$EJF2bMIesmOE8lV3fqXEH.Qi3k4zMD5jTnT/EKz3qz2auv4DZ/l/.', 'vcxcvx@wp.pl', 1516348375, 1516348409, '::1'),
(14, 'adam1234', '$2y$10$Oc.j6ip4lBY0vzoFW2Vz2.7dBO.GlFqWuUPX0kHHr78XUlvcHr1oG', 'adam123@gmail.com', 1516124257, 1516347934, '::1'),
(13, 'administrator', '$2y$10$ZGlyiHkyZsmz03PiSqj8fe7T5X4fVAmoH8yZrb7wxsZf3Zvby1pDa', 'admin@wp.pl', 1516123566, 1516347955, '::1');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `ogloszenia`
--
ALTER TABLE `ogloszenia`
  ADD PRIMARY KEY (`idOgloszenia`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `ogloszenia`
--
ALTER TABLE `ogloszenia`
  MODIFY `idOgloszenia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
