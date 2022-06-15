-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Wrz 2020, 19:33
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.6

CREATE DATABASE yetea;
USE yetea;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `yetea`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Czarna'),
(2, 'Zielona'),
(3, 'Biała'),
(4, 'Ziołowa'),
(5, 'Owocowa'),
(6, 'Korzenna'),
(7, 'Yerba mate');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `ingredient`
--

INSERT INTO `ingredient` (`id`, `name`) VALUES
(6, 'H. czarna Ceylon'),
(7, 'Papaja'),
(8, 'Melon'),
(9, 'Mango'),
(10, 'Chaber bławatek'),
(11, 'H. zielona Sencha'),
(12, 'Trawa cytrynowa'),
(13, 'Skórka limonki'),
(14, 'Skórka pomarańczy'),
(15, 'Płatki róży'),
(16, 'Owoc dzikiej róży'),
(17, 'Kwiat hibiskusa'),
(18, 'Melisa'),
(19, 'Rumianek'),
(20, 'Szyszki chmielu'),
(21, 'Mięta'),
(22, 'Skrzyp'),
(23, 'Pokrzywa'),
(25, 'Klitoria ternateńska'),
(26, 'Skórka cytryny'),
(27, 'Yerba mate'),
(28, 'Żeń-szeń'),
(29, 'Ananas'),
(30, 'Cynamon'),
(31, 'Goździki'),
(32, 'Rodzynki'),
(33, 'Malina'),
(34, 'Porzeczka'),
(35, 'Jabłko'),
(36, 'Imbir'),
(37, 'Jagoda'),
(38, 'Jarzębina'),
(39, 'Truskawka'),
(40, 'H. biała'),
(41, 'Lawenda'),
(42, 'Kwiat pomarańczy'),
(43, 'Liść porzeczki'),
(44, 'Kwiat wrzosu'),
(84, 'Cukierki miodowe'),
(85, 'Cytryna kandyzowana'),
(86, 'Cukrowe serca'),
(87, 'Aronia'),
(88, 'Wiśnia'),
(89, 'Słonecznik'),
(90, 'Migdały'),
(91, 'Kandyzowana pomarańcza'),
(92, 'Nagietek'),
(93, 'Kardamon'),
(94, 'Gałka muszkatałowa'),
(95, 'Rooibos'),
(96, 'Czarna porzeczka'),
(97, 'Lukrecja'),
(98, 'Kawałki czekolady');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(6) UNSIGNED NOT NULL,
  `user_id` int(6) UNSIGNED NOT NULL,
  `order_id` varchar(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `postcode_left` int(2) UNSIGNED NOT NULL,
  `postcode_right` int(3) UNSIGNED NOT NULL,
  `supplier_id` int(6) UNSIGNED NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `status_id` int(6) UNSIGNED NOT NULL,
  `cart` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_id`, `name`, `lastname`, `address`, `city`, `postcode_left`, `postcode_right`, `supplier_id`, `price`, `status_id`, `cart`) VALUES
(13, 1, 'b71ff4d990', 'a', 'a', 'a', 'a', 1, 1, 1, 29, 2, 'a:1:{i:1;a:4:{s:8:\"img_path\";s:35:\"images/products/afrykanski_slon.jpg\";s:4:\"name\";s:18:\"Afrykański słoń\";s:5:\"price\";s:2:\"15\";s:6:\"amount\";s:1:\"1\";}}'),
(15, 1, '9f62fd446f', 'a', 'a', 'a', 'a', 1, 1, 1, 22, 2, 'a:1:{i:2;a:4:{s:8:\"img_path\";s:26:\"images/products/zozole.jpg\";s:4:\"name\";s:6:\"Zozole\";s:5:\"price\";s:1:\"8\";s:6:\"amount\";s:1:\"1\";}}'),
(16, 1, '1a3ba5a6ad', 'a', 'a', 'a', 'a', 1, 1, 1, 26, 1, 'a:1:{i:3;a:4:{s:8:\"img_path\";s:32:\"images/products/czarna_magia.jpg\";s:4:\"name\";s:12:\"Czarna magia\";s:5:\"price\";s:2:\"12\";s:6:\"amount\";s:1:\"1\";}}'),
(17, 1, '3ea267de8a', 'a', 'a', 'a', 'a', 1, 1, 1, 32, 1, 'a:1:{i:4;a:4:{s:8:\"img_path\";s:27:\"images/products/zielnik.jpg\";s:4:\"name\";s:7:\"Zielnik\";s:5:\"price\";s:1:\"6\";s:6:\"amount\";s:1:\"1\";}}'),
(18, 1, '35b5fa31c7', 'a', 'a', 'a', 'a', 1, 1, 1, 40, 1, 'a:1:{i:5;a:4:{s:8:\"img_path\";s:25:\"images/products/uroda.jpg\";s:4:\"name\";s:5:\"Uroda\";s:5:\"price\";s:1:\"8\";s:6:\"amount\";s:1:\"1\";}}'),
(20, 6, '5c9e1bff78', 'banan', 'bananowski', 'bananowo 1', 'bananowe', 20, 210, 1, 52, 2, 'a:2:{i:3;a:4:{s:8:\"img_path\";s:32:\"images/products/czarna_magia.jpg\";s:4:\"name\";s:12:\"Czarna magia\";s:5:\"price\";s:2:\"24\";s:6:\"amount\";s:1:\"2\";}i:13;a:4:{s:8:\"img_path\";s:26:\"images/products/relaks.jpg\";s:4:\"name\";s:6:\"Relaks\";s:5:\"price\";s:2:\"14\";s:6:\"amount\";s:1:\"1\";}}');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product`
--

CREATE TABLE `product` (
  `id` int(6) UNSIGNED NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `category_id` int(6) UNSIGNED NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `amount` int(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `product`
--

INSERT INTO `product` (`id`, `img_path`, `name`, `description`, `category_id`, `price`, `amount`) VALUES
(1, 'images/products/afrykanski_slon.jpg', 'Afrykański słoń', 'Wyśmienita kompozycja najlepszej cejlońskiej czarnej herbaty i owoców tropikalnych. Słodycz owoców doskonale łączy się z przyjemną goryczką herbaty, nadając jej przyjemnie orzeźwiający smak.', 1, 15, 3),
(2, 'images/products/zozole.jpg', 'Zozole', 'Dzięki połączeniu lekkiej japońskiej herbaty i cytrusów, Zozole jest idealną opcją na lato. Wyśmienicie smakuje również na zimno. ', 2, 8, 4),
(3, 'images/products/czarna_magia.jpg', 'Czarna magia', 'Napar o barwie tak głębokiej, jak sugeruje nazwa, za sprawą cejlońskiej herbaty ze Sri Lanki i kwiatu hibiskusa. Owoc dzikiej róży uszlachetnia smak, zaś płatki kwiatów dodają/wprowadzają element magiczny.', 1, 12, 2),
(4, 'images/products/zielnik.jpg', 'Zielnik', 'Jest to kompozycja ziół, która wyciszy skołatane nerwy czy nastroi organizm do snu.', 4, 6, 5),
(5, 'images/products/uroda.jpg', 'Uroda', 'Wszystko, co jest potrzebne dla pięknej skóry, włosów i paznokci!', 4, 8, 2),
(6, 'images/products/blue_lagoon.jpg', 'Blue lagoon', 'Popularny drink w wersji bezalkoholowej i na ciepło. Klitoria oraz chaber odpowiadają za charakterystyczną barwę,  zaś dodatki owocowe za smak.', 4, 12, 3),
(7, 'images/products/iq.jpg', 'IQ', 'Dzięki dodatkowi skórki pomarańczy, mieszanka cechuje się niezwykłą świeżością. Korzenne ziołowe nuty w fuzji z owocami tworzą doskonale zbilansowane połączenie.', 7, 13, 2),
(8, 'images/products/grzaniec.jpg', 'Grzaniec', 'Idealna propozycja na jesienne i zimowe wieczory. Korzenny aromat rozgrzeje zmarznięte ciało a wyobraźnię przeniesie w wygodny fotel nieopodal iskrzącego kominka.', 6, 15, 4),
(9, 'images/products/z_miloscia.jpg', 'Z miłością', 'Owocowa mieszanka o uniwersalnym smaku.  Słodko – kwaśne połączenie przełamane nutą mięty przypadnie każdemu do gustu.', 5, 12, 6),
(10, 'images/products/indie.jpg', 'Indie', 'Herbata korzenna na bazie cejlońskich listów. Mieszanka bardzo rozgrzewająca – idealna na zimę, przy leczeniu przeziębienia czy na rozgrzanie dla zmarźluchów. ', 1, 9, 1),
(11, 'images/products/lesny_dzban.jpg', 'Leśny dzban', 'Bardzo słodki napar o apetycznej barwie głębokiego bordo. Dzięki naturalnej słodyczy malin, jagód i truskawek herbata nie wymaga słodzenia, a co za tym idzie, jest zdrowsza i mniej kaloryczna.', 5, 15, 5),
(12, 'images/products/biala_mewa.jpg', 'Biała mewa', 'Najdelikatniejsza z naszych herbat. Biała herbata nie dominuje nad owocowymi aromatami, a idealnie z nimi współgra.', 3, 10, 3),
(13, 'images/products/relaks.jpg', 'Relaks', 'Tak jak nazwa mówi – idealna opcja dla poszukujących wypoczynku. Melisa i lawenda idealnie wyciszają, zaś pozostałe dodatki nadają naparowi charakterystyczny, lekko owocowy smak. ', 4, 14, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product_ingredients`
--

CREATE TABLE `product_ingredients` (
  `product_id` int(6) UNSIGNED NOT NULL,
  `ingredient_id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `product_ingredients`
--

INSERT INTO `product_ingredients` (`product_id`, `ingredient_id`) VALUES
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(3, 6),
(3, 10),
(3, 15),
(3, 16),
(3, 17),
(4, 18),
(4, 19),
(4, 20),
(4, 21),
(5, 19),
(5, 22),
(5, 23),
(6, 10),
(6, 14),
(6, 25),
(6, 26),
(7, 7),
(7, 14),
(7, 27),
(7, 28),
(7, 29),
(8, 16),
(8, 17),
(8, 30),
(8, 31),
(8, 32),
(9, 14),
(9, 21),
(9, 33),
(9, 34),
(9, 35),
(10, 6),
(10, 14),
(10, 30),
(10, 31),
(10, 36),
(11, 17),
(11, 33),
(11, 37),
(11, 38),
(11, 39),
(12, 14),
(12, 34),
(12, 35),
(12, 37),
(12, 40),
(13, 18),
(13, 41),
(13, 42),
(13, 43),
(13, 44);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `status`
--

CREATE TABLE `status` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Oczekiwanie na wpłatę'),
(2, 'Wpłacono'),
(3, 'Anulowano');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `supplier`
--

CREATE TABLE `supplier` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `price`) VALUES
(1, 'Kurier OutGet', 14),
(2, 'Kurier Pocztex', 12),
(3, 'Przesyłka priorytetowa', 8),
(4, 'Przesyłka ekonomiczna', 6);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `login` varchar(15) NOT NULL,
  `password` varchar(30) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `is_admin`) VALUES
(1, 'test', 'test123', 0),
(3, 'admin', 'admin', 1),
(4, 'Igor', 'haslo', 0),
(6, 'bananowiec', '123', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD KEY `status` (`status_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeksy dla tabeli `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD PRIMARY KEY (`product_id`,`ingredient_id`),
  ADD KEY `ingredient_id` (`ingredient_id`);

--
-- Indeksy dla tabeli `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `product`
--
ALTER TABLE `product`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT dla tabeli `status`
--
ALTER TABLE `status`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD CONSTRAINT `product_ingredients_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ingredients_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
