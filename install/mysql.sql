-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 30. Okt 2023 um 14:53
-- Server-Version: 10.6.12-MariaDB-0ubuntu0.22.04.1-log
-- PHP-Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `d03e81bb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `boxes`
--

CREATE TABLE `boxes` (
  `id` int(11) NOT NULL,
  `BoxTitel` text NOT NULL,
  `BoxOrder` int(11) NOT NULL,
  `BoxLocation` text NOT NULL,
  `BoxFile` text NOT NULL,
  `BoxVisibleFor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `boxes`
--

INSERT INTO `boxes` (`id`, `BoxTitel`, `BoxOrder`, `BoxLocation`, `BoxFile`, `BoxVisibleFor`) VALUES
(1, 'Login', 100, 'navigation', 'login.php', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `GlobalConfig`
--

CREATE TABLE `GlobalConfig` (
  `id` int(11) NOT NULL,
  `domain` text NOT NULL,
  `no_user_start` text NOT NULL,
  `user_start` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `GlobalConfig`
--

INSERT INTO `GlobalConfig` (`id`, `domain`, `no_user_start`, `user_start`) VALUES
(1, '', 'no_user_start', 'user_start');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `SourceCode` text NOT NULL,
  `de` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `language`
--

INSERT INTO `language` (`id`, `SourceCode`, `de`) VALUES
(1, 'RegestryButton', 'Anmelden'),
(2, 'email_not_valid', 'Die E-Mail Adresse ist nicht gültig.'),
(3, 'password_not_same', 'Die Passwörter stimmen nicht überein.'),
(4, 'password_to_short', 'Das Passwort muss mindestens 8 Zeichen lang sein.'),
(5, 'username_already_exists', 'Benutzername ist bereits vergeben'),
(6, 'email_already_exists', 'E-Mail Adresse bereits vorhanden.'),
(7, 'field_required', 'Fülle bitte alle benötigten Felder aus.'),
(8, 'registry_success', 'Deine Anmeldung war erfolgreich.'),
(9, 'registry_error', 'Bei deiner Anmeldung ist ein Fehler aufgetretten. Bitte versuche es erneut.'),
(10, 'LoginEmailHelp', 'E-Mail Adresse oder Nickname'),
(11, 'LoginPassword', 'Benutzerpasswort'),
(12, 'LoginAutoLogin', 'Angemeldet bleiben'),
(13, 'LoginButton', 'Einloggen'),
(14, 'LoginEmail', 'E-Mail/Nutzername'),
(15, 'username_empty', 'Bitte Nutzername eingeben'),
(16, 'password_empty', 'Bitte Passwort angeben.'),
(17, 'user_not_found', 'Benutzer nicht gefunden'),
(18, 'user_not_active', 'Benutzer nicht aktiviert'),
(19, 'profil_button_home', 'Home'),
(20, 'profil_button_passwort', 'Passwort ändern'),
(21, 'profil_label_username', 'Nutzername/Nickname'),
(22, 'profil_label_email', 'E-Mail Adresse'),
(23, 'profil_label_name', 'Name'),
(24, 'profil_button_save', 'Daten Speichern'),
(25, 'profil_label_surname', 'Vorname'),
(26, 'LINK_NO_USER_MENU', 'Logout Menü'),
(27, 'LINK_USER_DEFAULT_MENU', 'Startseiten Links'),
(28, 'LINK_USER_PROFIL', 'Profil'),
(29, 'LINK_USER_LOGOUT', 'Logout'),
(30, 'LINK_USER_REGITRY', 'Registrieren'),
(31, 'LINK_USER_REGITRY', 'Registrieren'),
(32, 'NEW_PASSWORT', 'Neues Passwort'),
(33, 'NEW_PASSWORT_REPEAT', 'Neues Passwort wiederholen'),
(34, 'PROFIL_BUTTON_SAVE_NEW_PASS', 'Neues Passwort Speichern'),
(35, 'ERROR_PASSWORT_NOT_EQUAL', 'Die Passwörter stimmen nicht überein'),
(36, 'ERROR_PASSWORT_TO_SHORT', 'Das Passwort ist zu kurz'),
(37, 'PASSWORT_CHANGED', 'Passwort wurde geändert'),
(38, 'ERROR_PASSWORT_NOT_CHANGED', 'Passwort konnte nicht geändert werden'),
(39, 'USER_DATA_CHANGED', 'E-Mail Adresse geändert'),
(40, 'USER_DATA_NOT_CHANGED', 'E-Mail Adresse konnte nicht geändert werden.'),
(41, 'LINK_NO_USER_REGISTRY', 'Registrieren'),
(42, 'LOGIN_TRUE', 'Erfolgreich eingeloggt'),
(43, 'LINK_USER_HOME', 'Startseite'),
(44, '404', 'Die angegebene Seite ist nicht erreichbar.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `MainMenu`
--

CREATE TABLE `MainMenu` (
  `id` int(11) NOT NULL,
  `LinkName` text NOT NULL,
  `LinkURL` text NOT NULL,
  `child_from` int(11) NOT NULL,
  `LinkOrder` int(11) NOT NULL,
  `LinkAdmin` int(11) NOT NULL DEFAULT 0,
  `LinkLogin` int(11) NOT NULL DEFAULT 0,
  `LinkIcon` text NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT 1,
  `LinkDelete` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `MainMenu`
--

INSERT INTO `MainMenu` (`id`, `LinkName`, `LinkURL`, `child_from`, `LinkOrder`, `LinkAdmin`, `LinkLogin`, `LinkIcon`, `active`, `LinkDelete`) VALUES
(1, 'LINK_NO_USER_MENU', '', 0, 100, 0, 0, '0', 1, 0),
(2, 'LINK_NO_USER_REGISTRY', '?page=/extern/registrierung', 1, 100, 0, 0, 'bi bi-card-checklist', 1, 0),
(3, 'LINK_USER_DEFAULT_MENU', '', 0, 0, 0, 1, '0', 1, 0),
(4, 'LINK_USER_PROFIL', '?page=/konto/profil', 3, 100, 0, 1, '0', 1, 0),
(5, 'LINK_USER_LOGOUT', '?logout=true', 3, 1000, 0, 1, '0', 1, 0),
(6, 'LINK_USER_HOME', '?page=', 3, 1, 0, 1, 'bi bi-house-door-fill', 1, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `RegFields`
--

CREATE TABLE `RegFields` (
  `id` int(11) NOT NULL,
  `FieldName` text NOT NULL,
  `FieldType` text NOT NULL,
  `FieldLabel` text NOT NULL,
  `FieldIcon` text NOT NULL,
  `FieldValue` varchar(255) NOT NULL DEFAULT '0',
  `FieldChild` int(11) NOT NULL DEFAULT 0,
  `FieldPlaceholder` text NOT NULL,
  `FieldID` text NOT NULL,
  `FieldPage` text NOT NULL,
  `FieldOrder` int(11) NOT NULL,
  `FieldRequired` int(11) NOT NULL DEFAULT 0,
  `FieldDelete` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `RegFields`
--

INSERT INTO `RegFields` (`id`, `FieldName`, `FieldType`, `FieldLabel`, `FieldIcon`, `FieldValue`, `FieldChild`, `FieldPlaceholder`, `FieldID`, `FieldPage`, `FieldOrder`, `FieldRequired`, `FieldDelete`) VALUES
(1, 'name', 'text', 'Name', '', '0', 0, '', 'name', 'registry', 10, 1, 1),
(2, 'vorname', 'text', 'Vorname', '', '0', 0, '', 'vorname', 'registry', 20, 1, 1),
(3, 'email', 'text', 'E-Mail Adresse', '', '0', 0, '', 'email', 'registry', 30, 1, 1),
(4, 'passwort', 'password', 'Passwort', '', '0', 0, '', 'passwort', 'registry', 40, 1, 1),
(5, 'passwort2', 'password', 'Passwort wiederholen', '', '0', 0, '', 'repeat_passwort', 'registry', 50, 1, 1),
(6, 'nick', 'text', 'Nutzername', '', '0', 0, '', 'nick', 'registry', 21, 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `run_inc`
--

CREATE TABLE `run_inc` (
  `id` int(11) NOT NULL,
  `PostName` text NOT NULL,
  `PostFile` text NOT NULL,
  `PostRights` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `run_inc`
--

INSERT INTO `run_inc` (`id`, `PostName`, `PostFile`, `PostRights`) VALUES
(1, 'registrierung', 'extern/reg.php', 0),
(2, 'login', 'extern/login.php', 0),
(3, 'SaveDefaultProfil', 'konto/SaveDefaultProfil.php', 1),
(4, 'SetNewPass', 'konto/SetNewPass.php', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `template_setting`
--

CREATE TABLE `template_setting` (
  `id` int(11) NOT NULL,
  `TempKey` varchar(255) NOT NULL,
  `TempValue` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `template_setting`
--

INSERT INTO `template_setting` (`id`, `TempKey`, `TempValue`) VALUES
(1, 'navbar', 'sidebar'),
(2, 'defaultPage', 'startseite');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_nick` text NOT NULL,
  `user_name` text NOT NULL,
  `user_vorname` text NOT NULL,
  `user_mail` text NOT NULL,
  `user_pass` longtext NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT 0,
  `user_ip` int(11) NOT NULL DEFAULT 0,
  `user_regdate` int(11) NOT NULL,
  `user_lastlogin` int(11) NOT NULL,
  `user_admin` int(11) NOT NULL DEFAULT 0,
  `user_other` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`user_id`, `user_nick`, `user_name`, `user_vorname`, `user_mail`, `user_pass`, `user_status`, `user_ip`, `user_regdate`, `user_lastlogin`, `user_admin`, `user_other`) VALUES
(1, 'isaack', 'Admin', 'Admin', 'keine@keine.de', 'JEB7980jebI15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', 1, 83135, 1698516663, 0, 0, 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `boxes`
--
ALTER TABLE `boxes`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `GlobalConfig`
--
ALTER TABLE `GlobalConfig`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `MainMenu`
--
ALTER TABLE `MainMenu`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `RegFields`
--
ALTER TABLE `RegFields`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `run_inc`
--
ALTER TABLE `run_inc`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `template_setting`
--
ALTER TABLE `template_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `boxes`
--
ALTER TABLE `boxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `GlobalConfig`
--
ALTER TABLE `GlobalConfig`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT für Tabelle `MainMenu`
--
ALTER TABLE `MainMenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `RegFields`
--
ALTER TABLE `RegFields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `run_inc`
--
ALTER TABLE `run_inc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `template_setting`
--
ALTER TABLE `template_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
