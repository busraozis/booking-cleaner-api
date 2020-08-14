-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 14 Ağu 2020, 11:11:55
-- Sunucu sürümü: 5.7.29-log
-- PHP Sürümü: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `justmob`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `cleaner_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `booking`
--

INSERT INTO `booking` (`id`, `cleaner_id`, `customer_id`, `start_time`, `end_time`) VALUES
(1, 2, 1, '2020-08-10 10:00:00', '2020-08-10 14:00:00'),
(2, 1, 2, '2020-08-10 09:00:00', '2020-08-10 11:00:00'),
(3, 3, 1, '2020-08-10 15:00:00', '2020-08-10 19:00:00'),
(4, 2, 3, '2020-08-10 20:00:00', '2020-08-10 22:00:00'),
(5, 2, 3, '2020-08-10 20:00:00', '2020-08-10 22:00:00'),
(6, 2, 3, '2020-08-10 20:00:00', '2020-08-10 22:00:00'),
(7, 2, 3, '2020-08-10 20:00:00', '2020-08-10 22:00:00'),
(8, 2, 4, '2020-08-11 12:00:00', '2020-08-11 16:00:00'),
(9, 1, 1, '2020-08-11 12:00:00', '2020-08-11 14:00:00'),
(10, 1, 1, '2020-08-11 12:00:00', '2020-08-11 14:00:00'),
(11, 1, 1, '2020-08-12 12:00:00', '2020-08-12 14:00:00'),
(12, 1, 1, '2020-08-13 12:00:00', '2020-08-13 14:00:00'),
(13, 3, 1, '2020-08-15 12:00:00', '2020-08-15 14:00:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cleaner`
--

CREATE TABLE `cleaner` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `cleaner`
--

INSERT INTO `cleaner` (`id`, `company_id`, `name`) VALUES
(1, 1, 'cleanerA'),
(2, 1, 'cleanerB'),
(3, 2, 'cleanerC');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `company`
--

INSERT INTO `company` (`id`, `name`) VALUES
(1, 'CompanyA'),
(2, 'companyB');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `customer`
--

INSERT INTO `customer` (`id`, `name`, `address`) VALUES
(1, 'customerA', 'address1'),
(2, 'customerB', 'address2');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `cleaner`
--
ALTER TABLE `cleaner`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `cleaner`
--
ALTER TABLE `cleaner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
