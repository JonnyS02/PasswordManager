-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 13. Nov 2023 um 21:18
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `passsafepro`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `passwords`
--

CREATE TABLE `passwords` (
  `ID` int(11) NOT NULL,
  `Plattform` varchar(400) NOT NULL,
  `Password` varchar(1000) NOT NULL,
  `Username` varchar(400) NOT NULL,
  `Additional` varchar(1000) NOT NULL,
  `Email` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `passwords`
--

INSERT INTO `passwords` (`ID`, `Plattform`, `Password`, `Username`, `Additional`, `Email`) VALUES
(1, 'Test', 'Paswrgf', 'Testser', 'thrsh', 'Test@test.de'),
(2, 'Hai', 'ergokklerg', 'weas geht rth', 'hrsth', 'ergerg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Name` varchar(400) NOT NULL,
  `Verified` tinyint(1) NOT NULL,
  `Email` varchar(400) NOT NULL,
  `Password` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`ID`, `Name`, `Verified`, `Email`, `Password`) VALUES
(1, 'Jonathan', 1, 'Test@test.de', '$2y$10$0Z4rA8yQlrJZ3TO0OsDXqePWbzGiyX1anLBKIj2a1hgaMVeDszKgy');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `passwords`
--
ALTER TABLE `passwords`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `passwords`
--
ALTER TABLE `passwords`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
