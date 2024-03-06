-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 04, 2024 alle 17:51
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbrestore`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `adozione`
--

CREATE TABLE `adozione` (
  `EmailCliente` varchar(255) NOT NULL,
  `Id_Bio` int(11) NOT NULL,
  `NomeProprio` varchar(255) NOT NULL,
  `Importo` decimal(10,2) NOT NULL,
  `Data_Adozione` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `biodiversita`
--

CREATE TABLE `biodiversita` (
  `Id_Bio` int(11) NOT NULL,
  `Nome_Comune` varchar(255) NOT NULL,
  `Specie` varchar(255) NOT NULL,
  `Sesso` char(1) DEFAULT NULL,
  `Età` int(11) DEFAULT NULL,
  `Parco` int(11) DEFAULT NULL,
  `Tipo` enum('Pianta','Animale') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger `biodiversita`
--
DELIMITER $$
CREATE TRIGGER `check_tipo_sesso` BEFORE INSERT ON `biodiversita` FOR EACH ROW BEGIN
    IF NEW.Tipo = 'Pianta' AND NEW.Sesso IS NOT NULL THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Il sesso deve essere NULL per le piante.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `clienti`
--

CREATE TABLE `clienti` (
  `Nome` varchar(255) NOT NULL,
  `Cognome` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Psw` varchar(255) NOT NULL,
  `Id_Iscr` int(11) DEFAULT NULL,
  `Data_Iscr` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `iscrizioni`
--

CREATE TABLE `iscrizioni` (
  `Id_Iscr` int(11) NOT NULL,
  `Tipologia` varchar(255) NOT NULL,
  `Merch` varchar(255) NOT NULL,
  `Importo_Mens` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `parchi`
--

CREATE TABLE `parchi` (
  `Id_Parco` int(25) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Regione` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `adozione`
--
ALTER TABLE `adozione`
  ADD PRIMARY KEY (`EmailCliente`,`Id_Bio`),
  ADD KEY `Id_Bio` (`Id_Bio`);

--
-- Indici per le tabelle `biodiversita`
--
ALTER TABLE `biodiversita`
  ADD PRIMARY KEY (`Id_Bio`),
  ADD KEY `Parco` (`Parco`);

--
-- Indici per le tabelle `clienti`
--
ALTER TABLE `clienti`
  ADD PRIMARY KEY (`Email`),
  ADD KEY `Id_Iscr` (`Id_Iscr`);

--
-- Indici per le tabelle `iscrizioni`
--
ALTER TABLE `iscrizioni`
  ADD PRIMARY KEY (`Id_Iscr`);

--
-- Indici per le tabelle `parchi`
--
ALTER TABLE `parchi`
  ADD PRIMARY KEY (`Id_Parco`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `iscrizioni`
--
ALTER TABLE `iscrizioni`
  MODIFY `Id_Iscr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `parchi`
--
ALTER TABLE `parchi`
  MODIFY `Id_Parco` int(25) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `adozione`
--
ALTER TABLE `adozione`
  ADD CONSTRAINT `adozione_ibfk_1` FOREIGN KEY (`EmailCliente`) REFERENCES `clienti` (`Email`),
  ADD CONSTRAINT `adozione_ibfk_2` FOREIGN KEY (`Id_Bio`) REFERENCES `biodiversita` (`Id_Bio`);

--
-- Limiti per la tabella `biodiversita`
--
ALTER TABLE `biodiversita`
  ADD CONSTRAINT `biodiversita_ibfk_1` FOREIGN KEY (`Parco`) REFERENCES `parchi` (`Id_Parco`);

--
-- Limiti per la tabella `clienti`
--
ALTER TABLE `clienti`
  ADD CONSTRAINT `clienti_ibfk_1` FOREIGN KEY (`Id_Iscr`) REFERENCES `iscrizioni` (`Id_Iscr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
