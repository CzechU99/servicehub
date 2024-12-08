-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 09:45 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skillsplatform`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dane_uzytkownika`
--

CREATE TABLE `dane_uzytkownika` (
  `id` int(11) NOT NULL,
  `uzytkownik_id` int(11) NOT NULL,
  `imie` varchar(255) NOT NULL,
  `nazwisko` varchar(255) NOT NULL,
  `miejscowosc` varchar(255) NOT NULL,
  `numer_domu` varchar(255) NOT NULL,
  `kod_pocztowy` varchar(255) NOT NULL,
  `miasto` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `szerokosc_geograficzna` double NOT NULL,
  `dlugosc_geograficzna` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dane_uzytkownika`
--

INSERT INTO `dane_uzytkownika` (`id`, `uzytkownik_id`, `imie`, `nazwisko`, `miejscowosc`, `numer_domu`, `kod_pocztowy`, `miasto`, `telefon`, `szerokosc_geograficzna`, `dlugosc_geograficzna`) VALUES
(1, 1, 'Paweł', 'Kościuszko', 'Ozimska', '32', '46-034', 'Pokój', '+48829387263', 50.9017945, 17.8369082),
(2, 24, 'Karol', 'Wielki', 'Kościuszki', '43', '45-017', 'Opole', '+48927465312', 50.6668184, 17.9236408);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20241208151908', '2024-12-08 15:19:39', 232),
('DoctrineMigrations\\Version20241208200002', '2024-12-08 20:00:07', 12),
('DoctrineMigrations\\Version20241208202939', '2024-12-08 20:29:46', 10);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `nazwa_kategorii` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazwa_kategorii`) VALUES
(1, 'Ogród'),
(2, 'Mechanika'),
(3, 'Szkoła'),
(4, 'Hydraulika i Elektryka'),
(5, 'Budownictwo i Remonty'),
(6, 'Ogród i Krajobraz'),
(7, 'Transport i Przeprowadzki'),
(8, 'Sprzątanie i Czystość'),
(9, 'Kosmetyka i Fryzjerstwo'),
(10, 'Edukacja i Korepetycje'),
(11, 'IT i Technologie'),
(12, 'Naprawa i Serwis'),
(13, 'Zdrowie i Uroda'),
(14, 'Fotografia i Filmowanie'),
(15, 'Eventy i Imprezy'),
(16, 'Usługi Motoryzacyjne'),
(17, 'Rękodzieło i Artystyczne'),
(18, 'Marketing i Reklama'),
(19, 'Tłumaczenia i Pisanie'),
(20, 'Fitness i Trening'),
(21, 'Opieka nad Zwierzętami'),
(22, 'Prawo i Finanse'),
(23, 'Gastronomia i Catering'),
(24, 'Montaż i Instalacje'),
(25, 'Prace Sezonowe'),
(26, 'Nieruchomości'),
(27, 'Turystyka'),
(28, 'Szkolenia i Coaching'),
(29, 'Usługi Dla Dzieci'),
(30, 'Projektowanie i Wnętrze'),
(31, 'Usługi Rolnicze'),
(32, 'Hobby i Zainteresowania'),
(33, 'Usługi Sprzedażowe'),
(34, 'Inne');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie_uslugi`
--

CREATE TABLE `kategorie_uslugi` (
  `kategorie_id` int(11) NOT NULL,
  `uslugi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategorie_uslugi`
--

INSERT INTO `kategorie_uslugi` (`kategorie_id`, `uslugi_id`) VALUES
(2, 44),
(12, 1),
(15, 1),
(19, 43),
(22, 43),
(25, 43);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messenger_messages`
--

INSERT INTO `messenger_messages` (`id`, `body`, `headers`, `queue_name`, `created_at`, `available_at`, `delivered_at`) VALUES
(1, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;s:44:\\\"Please click the link to reset your password\\\";i:1;s:5:\\\"utf-8\\\";i:2;s:116:\\\"<p>Please click the link to reset your password: <a href=\\\"http://localhost:8000/email_verify\\\">Reset Password</a></p>\\\";i:3;s:5:\\\"utf-8\\\";i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:21:\\\"nor-replay@skills.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:19:\\\"d39052964@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:14:\\\"Reset Password\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2024-02-14 13:10:43', '2024-02-14 13:10:43', NULL),
(2, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;s:44:\\\"Please click the link to reset your password\\\";i:1;s:5:\\\"utf-8\\\";i:2;s:116:\\\"<p>Please click the link to reset your password: <a href=\\\"http://localhost:8000/email_verify\\\">Reset Password</a></p>\\\";i:3;s:5:\\\"utf-8\\\";i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:21:\\\"nor-replay@skills.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:19:\\\"d39052964@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:14:\\\"Reset Password\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2024-02-14 13:15:45', '2024-02-14 13:15:45', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezerwacje`
--

CREATE TABLE `rezerwacje` (
  `id` int(11) NOT NULL,
  `uzytkownik_id_id` int(11) NOT NULL,
  `usluga_do_rezerwacji_id` int(11) NOT NULL,
  `usluga_na_wymiane_id` int(11) DEFAULT NULL,
  `wiadomosc` varchar(1000) DEFAULT NULL,
  `udostepnij_telefon` tinyint(1) DEFAULT NULL,
  `od_kiedy` datetime NOT NULL,
  `do_kiedy` datetime DEFAULT NULL,
  `data_zlozenia` datetime NOT NULL,
  `czy_potwierdzona` tinyint(1) NOT NULL,
  `czy_anulowana` tinyint(1) NOT NULL,
  `czy_odrzucona` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rezerwacje`
--

INSERT INTO `rezerwacje` (`id`, `uzytkownik_id_id`, `usluga_do_rezerwacji_id`, `usluga_na_wymiane_id`, `wiadomosc`, `udostepnij_telefon`, `od_kiedy`, `do_kiedy`, `data_zlozenia`, `czy_potwierdzona`, `czy_anulowana`, `czy_odrzucona`) VALUES
(2, 1, 43, 1, 'Siemka', 1, '2024-12-04 00:00:00', NULL, '2024-12-08 17:41:06', 0, 0, 0),
(4, 1, 43, 1, NULL, 0, '2024-12-04 00:00:00', NULL, '2024-12-08 17:59:03', 0, 0, 0),
(5, 1, 43, 1, NULL, 0, '2024-12-07 00:00:00', NULL, '2024-12-08 18:00:10', 0, 0, 0),
(7, 1, 43, NULL, NULL, 0, '2024-12-04 00:00:00', NULL, '2024-12-08 18:11:45', 0, 0, 0),
(9, 24, 1, NULL, NULL, NULL, '2024-12-08 21:09:19', '2024-12-25 21:09:19', '2024-12-08 21:09:19', 0, 0, 1),
(10, 24, 1, NULL, NULL, NULL, '2024-12-08 21:09:19', '2024-12-25 21:09:19', '2024-12-08 21:09:19', 1, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'test@test.com', '[]', '$2y$13$PNyIEAAYqUhBfT8U7GU6L.Fpw5QGCoLWuJlF5Bq6wkyQOQdYt8Foy'),
(24, 'd39052964@gmail.com', '[]', '$2y$13$bp0oCcnCh.Ar.yFPoOw5Ae9ZOMNNyA7EAmiWBF5D3VMDShKZClA/.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uslugi`
--

CREATE TABLE `uslugi` (
  `id` int(11) NOT NULL,
  `uzytkownik_id` int(11) NOT NULL,
  `nazwa_uslugi` varchar(255) NOT NULL,
  `cena` double NOT NULL,
  `data_dodania` datetime NOT NULL,
  `glowne_zdjecie` varchar(255) DEFAULT NULL,
  `opis_uslugi` varchar(1000) NOT NULL,
  `do_negocjacji` tinyint(1) NOT NULL,
  `czy_firma` tinyint(1) NOT NULL,
  `czy_wymiana` tinyint(1) NOT NULL,
  `czy_stawka_godzinowa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uslugi`
--

INSERT INTO `uslugi` (`id`, `uzytkownik_id`, `nazwa_uslugi`, `cena`, `data_dodania`, `glowne_zdjecie`, `opis_uslugi`, `do_negocjacji`, `czy_firma`, `czy_wymiana`, `czy_stawka_godzinowa`) VALUES
(1, 1, 'Koszenie trawy, ogródków, rowów itd...', 50.99, '2024-12-03 18:36:02', '1_pobrane.jpeg', 'Oferuję profesjonalne koszenie trawy dla Twojego ogrodu, działki lub terenu firmowego. Zadbany trawnik to wizytówka każdej przestrzeni, a moje usługi pomogą Ci utrzymać go w idealnym stanie. Dzięki doświadczeniu i wykorzystaniu nowoczesnego sprzętu zapewniam precyzyjne i szybkie wykonanie zlecenia. Gwarantuję terminowość, dokładność i dostosowanie usługi do indywidualnych potrzeb klienta. Niezależnie od wielkości terenu, podejmuję się każdego wyzwania, zapewniając najwyższą jakość obsługi. Twój trawnik stanie się piękny i zdrowy, gotowy do odpoczynku lub podziwiania.', 1, 1, 0, 1),
(43, 24, 'Testowa usługa robienia czegoś', 23, '2024-12-07 13:56:31', '1_IRO436_4_2024.jpg', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 1, 1, 1),
(44, 1, 'USLUGA 2 TESTOWA', 23, '2024-12-08 14:16:06', '1_Neural_network.svg.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 1, 1, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `dane_uzytkownika`
--
ALTER TABLE `dane_uzytkownika`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E1DD69B131D6FDE9` (`uzytkownik_id`);

--
-- Indeksy dla tabeli `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `kategorie_uslugi`
--
ALTER TABLE `kategorie_uslugi`
  ADD PRIMARY KEY (`kategorie_id`,`uslugi_id`),
  ADD KEY `IDX_9C725424BAF991D3` (`kategorie_id`),
  ADD KEY `IDX_9C7254249D27B152` (`uslugi_id`);

--
-- Indeksy dla tabeli `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indeksy dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_850574D2ED0C63F` (`uzytkownik_id_id`),
  ADD KEY `IDX_850574D234D64902` (`usluga_do_rezerwacji_id`),
  ADD KEY `IDX_850574D2D46CB69A` (`usluga_na_wymiane_id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- Indeksy dla tabeli `uslugi`
--
ALTER TABLE `uslugi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6947615231D6FDE9` (`uzytkownik_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dane_uzytkownika`
--
ALTER TABLE `dane_uzytkownika`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `uslugi`
--
ALTER TABLE `uslugi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dane_uzytkownika`
--
ALTER TABLE `dane_uzytkownika`
  ADD CONSTRAINT `FK_E1DD69B131D6FDE9` FOREIGN KEY (`uzytkownik_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `kategorie_uslugi`
--
ALTER TABLE `kategorie_uslugi`
  ADD CONSTRAINT `FK_9C7254249D27B152` FOREIGN KEY (`uslugi_id`) REFERENCES `uslugi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_9C725424BAF991D3` FOREIGN KEY (`kategorie_id`) REFERENCES `kategorie` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD CONSTRAINT `FK_850574D234D64902` FOREIGN KEY (`usluga_do_rezerwacji_id`) REFERENCES `uslugi` (`id`),
  ADD CONSTRAINT `FK_850574D2D46CB69A` FOREIGN KEY (`usluga_na_wymiane_id`) REFERENCES `uslugi` (`id`),
  ADD CONSTRAINT `FK_850574D2ED0C63F` FOREIGN KEY (`uzytkownik_id_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `uslugi`
--
ALTER TABLE `uslugi`
  ADD CONSTRAINT `FK_6947615231D6FDE9` FOREIGN KEY (`uzytkownik_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
