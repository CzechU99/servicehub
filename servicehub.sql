-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 15, 2025 at 05:15 PM
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
-- Database: `servicehub`
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
('DoctrineMigrations\\Version20241208202939', '2024-12-08 20:29:46', 10),
('DoctrineMigrations\\Version20241211105725', '2024-12-11 10:57:38', 20),
('DoctrineMigrations\\Version20241211130451', '2024-12-11 13:04:55', 14),
('DoctrineMigrations\\Version20241212172850', '2024-12-12 17:28:54', 158);

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
(1, 1),
(1, 46),
(2, 45),
(4, 46),
(7, 46),
(10, 46),
(11, 45),
(14, 45),
(19, 43),
(22, 43),
(25, 43),
(30, 1);

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
-- Struktura tabeli dla tabeli `obserwowane`
--

CREATE TABLE `obserwowane` (
  `id` int(11) NOT NULL,
  `uzytkownik_id` int(11) NOT NULL,
  `usluga_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `obserwowane`
--

INSERT INTO `obserwowane` (`id`, `uzytkownik_id`, `usluga_id`) VALUES
(16, 1, 43),
(17, 1, 45);

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
(53, 1, 43, 46, 'Dzień dobry, jestem zainteresowany rezerwacją usługi. Chciałbym ustalić szczegóły dotyczące: miejsca spotkania (czy możliwe są zajęcia online lub w wyznaczonej lokalizacji), materiałów, które są wykorzystywane podczas nauki, wszelkie dodatkowe szczegóły dotyczące współpracy. Z góry dziękuję za odpowiedź i liczę na owocną współpracę!', 1, '2025-01-21 00:00:00', NULL, '2025-01-15 16:16:17', 0, 0, 0),
(54, 1, 45, NULL, NULL, 0, '2025-01-16 00:00:00', '2025-01-17 00:00:00', '2025-01-15 16:16:42', 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_waznosc` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `reset_token`, `reset_token_waznosc`) VALUES
(1, 'test@test.com', '[]', '$2y$13$l.Hh51hLw3dz8spyimwQNuWt6RdUbYaZDpz2wZ29V3x8Vjg52Ngvy', NULL, NULL),
(24, 'd39052964@gmail.com', '[]', '$2y$13$1tY8tlNKSedGcR2bB1Rom.nIQnXFgzy4X1h6di5pkjrromfCUtPAG', '17042d3e07763f2dc440fdef2e1d369e67d2d3629738a56ebe154dff0560e54b', '2024-12-11 16:10:22');

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
  `czy_stawka_godzinowa` tinyint(1) NOT NULL,
  `wyswietlenia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uslugi`
--

INSERT INTO `uslugi` (`id`, `uzytkownik_id`, `nazwa_uslugi`, `cena`, `data_dodania`, `glowne_zdjecie`, `opis_uslugi`, `do_negocjacji`, `czy_firma`, `czy_wymiana`, `czy_stawka_godzinowa`, `wyswietlenia`) VALUES
(1, 1, 'Koszenie trawy, ogródków, rowów itd...', 30, '2024-12-03 18:36:02', '1_R.jpeg', 'Oferuję profesjonalne koszenie trawy, pielęgnację ogródków oraz utrzymanie rowów w czystości. Usługa obejmuje dokładne koszenie przy użyciu odpowiedniego sprzętu, dopasowanego do rodzaju terenu. Dzięki wieloletniemu doświadczeniu zapewniam precyzję, terminowość oraz wysoką jakość wykonania.', 1, 0, 1, 1, 3),
(43, 24, 'Korepetycje z języka niemieckiego na poziomie B2.', 80, '2024-12-07 13:56:31', '1_OSK.jpeg', 'Oferuję korepetycje z języka niemieckiego na poziomie średnio zaawansowanym wyższym (B2). Moje zajęcia mają na celu rozwinięcie umiejętności komunikacyjnych, zrozumienia tekstu pisanego oraz poprawnego użycia gramatyki. Dzięki indywidualnemu podejściu pomagam w osiągnięciu biegłości językowej potrzebnej do pracy, studiów lub codziennego życia w niemieckojęzycznym środowisku.', 1, 1, 1, 1, 8),
(45, 24, 'Kompleksowe sprzątanie domów, mieszkań, biur oraz innych lokali', 40, '2024-12-10 19:49:14', '1_sprzatanie-mieszkan.jpg', 'Świadczę usługi kompleksowego sprzątania różnego rodzaju lokali: domów, mieszkań, biur oraz przestrzeni użytkowych. Gwarantuję dokładność, rzetelność oraz dostosowanie zakresu prac do indywidualnych potrzeb klienta. Dzięki profesjonalnemu podejściu zapewniam czystość i porządek w każdej przestrzeni.', 0, 1, 0, 1, 4),
(46, 1, 'Nauka języka angielskiego. Poziom C1', 120, '2024-12-11 19:00:37', '1_OIP.jpeg', 'Oferuję profesjonalne lekcje języka angielskiego na poziomie zaawansowanym (C1). Zajęcia są dostosowane do indywidualnych potrzeb ucznia, skupiając się na rozwijaniu umiejętności komunikacyjnych, gramatyki oraz płynności wypowiedzi. Dzięki skutecznym metodom nauczania, pomagam osiągnąć wysoki poziom biegłości językowej.', 1, 0, 1, 1, 0),
(52, 24, 'Oferuję opiekę nad zwierzętami, spacery, karmienie itd...', 25.99, '2025-01-03 15:37:02', '1_f-113590-opieka-nas-zwierzetami-podczas-nieobecnosci-wlasciciela-jakie-mamy-rozwiazania.jpg', 'Jeśli potrzebujesz pomocy w opiece nad swoim pupilem, jestem do Twojej dyspozycji! Oferuję kompleksową opiekę nad zwierzętami, w tym spacery, karmienie, a także towarzystwo w czasie Twojej nieobecności. Zapewniam troskę, bezpieczeństwo i indywidualne podejście do każdego zwierzaka, niezależnie od jego potrzeb.', 0, 0, 0, 1, 2);

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
-- Indeksy dla tabeli `obserwowane`
--
ALTER TABLE `obserwowane`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2375A0BB31D6FDE9` (`uzytkownik_id`),
  ADD KEY `IDX_2375A0BB589399BD` (`usluga_id`);

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
-- AUTO_INCREMENT for table `obserwowane`
--
ALTER TABLE `obserwowane`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `uslugi`
--
ALTER TABLE `uslugi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

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
-- Constraints for table `obserwowane`
--
ALTER TABLE `obserwowane`
  ADD CONSTRAINT `FK_2375A0BB31D6FDE9` FOREIGN KEY (`uzytkownik_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_2375A0BB589399BD` FOREIGN KEY (`usluga_id`) REFERENCES `uslugi` (`id`);

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
