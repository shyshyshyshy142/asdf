-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 20 2024 г., 22:54
-- Версия сервера: 5.7.39
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `drive`
--

-- --------------------------------------------------------

--
-- Структура таблицы `car`
--

CREATE TABLE `car` (
  `id` int(11) NOT NULL,
  `марка` varchar(32) CHARACTER SET utf8 NOT NULL,
  `модель` varchar(255) CHARACTER SET utf8 NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `описание` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `номер машины` varchar(6) CHARACTER SET utf8 NOT NULL,
  `стоимость` float NOT NULL,
  `аренда` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `car`
--

INSERT INTO `car` (`id`, `марка`, `модель`, `img`, `описание`, `номер машины`, `стоимость`, `аренда`) VALUES
(1, 'лада', 'веста', 'https://i.trse.ru/2022/03/7H2w.jpg', 'asdasd', '54екп', 1000, 0),
(2, 'hynday', 'getz', 'https://cdn.matador.tech/source/gallery/2386/1198924/original.jpg', 'sdfdsf', 'св963н', 700, 0),
(3, 'bmw', 'x7', 'https://www.avtogide.ru/wp-content/uploads/2020/04/x7-m.jpg', 'dasd', '2133', 1000, 0),
(5, 'Volvo', 'xc90', 'https://foxmotorsports.com/admin/uploads/13820338710.jpg', 'вфывфы', 'weqw', 1, 0),
(7, 'shevrole', 'kruz', 'https://avtoshark.com/wp-content/uploads/2023/02/slabye-mesta-shevrole-kruz.jpg', 'йцуйц', 'цуцкк', 100, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `rent_history`
--

CREATE TABLE `rent_history` (
  `car` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_login` varchar(255) CHARACTER SET utf8 NOT NULL,
  `rent_data` datetime NOT NULL,
  `rent_data_ends` datetime NOT NULL,
  `ends` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(32) CHARACTER SET utf8 NOT NULL,
  `pass` varchar(32) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `rental_date` date DEFAULT NULL,
  `rented_car_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `email`, `phone`, `rental_date`, `rented_car_id`) VALUES
(1, '111', '111', '1111', '+789095666', NULL, NULL),
(2, 'rabbit', 'qwerty', 'lex@mail.com', '', NULL, NULL),
(3, 'zxc', '133', 'rtyu', '', '2024-03-01', NULL),
(4, '111', 'asd', 'asd', NULL, NULL, NULL),
(5, '111', 'asd', 'asd', NULL, NULL, NULL),
(6, 'уйцу', 'цйуйц', 'уйцуй', NULL, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `номер машины_2` (`номер машины`),
  ADD KEY `номер машины` (`номер машины`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `car`
--
ALTER TABLE `car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
