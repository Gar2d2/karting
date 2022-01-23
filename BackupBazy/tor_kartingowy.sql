-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 23 Sty 2022, 17:15
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `tor_kartingowy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kart`
--

CREATE TABLE `kart` (
  `id` int(11) NOT NULL,
  `numerKarta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `kart`
--

INSERT INTO `kart` (`id`, `numerKarta`) VALUES
(1, 1),
(2, 2),
(5, 2),
(6, 3),
(7, 4),
(8, 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `naprawy`
--

CREATE TABLE `naprawy` (
  `id` int(11) NOT NULL,
  `dataRozpoczecia` date NOT NULL DEFAULT current_timestamp(),
  `dataZakonczenia` date DEFAULT NULL,
  `stanNaprawy` enum('WTRAKCIE','OCZEKIWANIE_NA_CZESCI','NOWA','ZAKONCZONA') NOT NULL,
  `id_kart` int(11) NOT NULL,
  `id_osoba` int(11) NOT NULL,
  `usterka` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `osoba`
--

CREATE TABLE `osoba` (
  `id` int(11) NOT NULL,
  `pseudonim` varchar(255) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `imie` varchar(255) NOT NULL,
  `nazwisko` varchar(255) NOT NULL,
  `uprawnienia` enum('KIEROWNIK','PRACOWNIK_WARSZTATU','PRACOWNIK_RECEPCJI','PRACOWNIK_PITSTOP','UZYTKOWNIK') NOT NULL,
  `zdjecie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `osoba`
--

INSERT INTO `osoba` (`id`, `pseudonim`, `haslo`, `imie`, `nazwisko`, `uprawnienia`, `zdjecie`) VALUES
(8, 'admin', 'admin', 'admin', 'admin', 'KIEROWNIK', 'http://kierownik-produktu.pl/wp-content/uploads/2018/12/kierownik-we-wlasnej-firmie.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przejazd`
--

CREATE TABLE `przejazd` (
  `id` int(11) NOT NULL,
  `dataPrzejazdu` date NOT NULL,
  `godzinaRozpoczecia` varchar(255) NOT NULL,
  `godzinaZakonczenia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `raport`
--

CREATE TABLE `raport` (
  `id` int(11) NOT NULL,
  `dataUtworzenia` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezerwacja`
--

CREATE TABLE `rezerwacja` (
  `id` int(11) NOT NULL,
  `idOsoby` int(11) NOT NULL,
  `idPrzejazdu` int(11) NOT NULL,
  `potwierdzono` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sekcja`
--

CREATE TABLE `sekcja` (
  `id` int(11) NOT NULL,
  `idRaportu` int(11) NOT NULL,
  `idOsoby` int(11) NOT NULL,
  `tytul` varchar(255) NOT NULL,
  `tresc` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zakonczoneprzejazdy`
--

CREATE TABLE `zakonczoneprzejazdy` (
  `id` int(11) NOT NULL,
  `idOsoby` int(11) NOT NULL,
  `idPrzejazdu` int(11) NOT NULL,
  `idKarta` int(11) NOT NULL,
  `czas` varchar(255) NOT NULL,
  `iloscOkrazen` int(11) NOT NULL,
  `miejsce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kart`
--
ALTER TABLE `kart`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `naprawy`
--
ALTER TABLE `naprawy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kart` (`id_kart`),
  ADD KEY `id_osoba` (`id_osoba`);

--
-- Indeksy dla tabeli `osoba`
--
ALTER TABLE `osoba`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `przejazd`
--
ALTER TABLE `przejazd`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `raport`
--
ALTER TABLE `raport`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `rezerwacja`
--
ALTER TABLE `rezerwacja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idOsoby` (`idOsoby`),
  ADD KEY `idPrzejazdu` (`idPrzejazdu`);

--
-- Indeksy dla tabeli `sekcja`
--
ALTER TABLE `sekcja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idOsoby` (`idOsoby`),
  ADD KEY `idRaportu` (`idRaportu`);

--
-- Indeksy dla tabeli `zakonczoneprzejazdy`
--
ALTER TABLE `zakonczoneprzejazdy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idOsoby` (`idOsoby`),
  ADD KEY `idPrzejazdu` (`idPrzejazdu`),
  ADD KEY `idKarta` (`idKarta`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `kart`
--
ALTER TABLE `kart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `naprawy`
--
ALTER TABLE `naprawy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `osoba`
--
ALTER TABLE `osoba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `przejazd`
--
ALTER TABLE `przejazd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT dla tabeli `raport`
--
ALTER TABLE `raport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `rezerwacja`
--
ALTER TABLE `rezerwacja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT dla tabeli `sekcja`
--
ALTER TABLE `sekcja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `zakonczoneprzejazdy`
--
ALTER TABLE `zakonczoneprzejazdy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `naprawy`
--
ALTER TABLE `naprawy`
  ADD CONSTRAINT `naprawy_ibfk_1` FOREIGN KEY (`id_kart`) REFERENCES `kart` (`id`),
  ADD CONSTRAINT `naprawy_ibfk_2` FOREIGN KEY (`id_osoba`) REFERENCES `osoba` (`id`);

--
-- Ograniczenia dla tabeli `rezerwacja`
--
ALTER TABLE `rezerwacja`
  ADD CONSTRAINT `rezerwacja_ibfk_1` FOREIGN KEY (`idOsoby`) REFERENCES `osoba` (`id`),
  ADD CONSTRAINT `rezerwacja_ibfk_2` FOREIGN KEY (`idPrzejazdu`) REFERENCES `przejazd` (`id`);

--
-- Ograniczenia dla tabeli `sekcja`
--
ALTER TABLE `sekcja`
  ADD CONSTRAINT `sekcja_ibfk_1` FOREIGN KEY (`idOsoby`) REFERENCES `osoba` (`id`),
  ADD CONSTRAINT `sekcja_ibfk_2` FOREIGN KEY (`idRaportu`) REFERENCES `raport` (`id`);

--
-- Ograniczenia dla tabeli `zakonczoneprzejazdy`
--
ALTER TABLE `zakonczoneprzejazdy`
  ADD CONSTRAINT `zakonczoneprzejazdy_ibfk_1` FOREIGN KEY (`idOsoby`) REFERENCES `osoba` (`id`),
  ADD CONSTRAINT `zakonczoneprzejazdy_ibfk_2` FOREIGN KEY (`idPrzejazdu`) REFERENCES `przejazd` (`id`),
  ADD CONSTRAINT `zakonczoneprzejazdy_ibfk_3` FOREIGN KEY (`idKarta`) REFERENCES `kart` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
