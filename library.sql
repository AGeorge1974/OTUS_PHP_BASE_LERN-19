-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 24 2022 г., 12:01
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `library`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `IdAuthor` int NOT NULL,
  `Name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`IdAuthor`, `Name`) VALUES
(1, 'Ильф И.А.'),
(2, 'Петров Е.П.'),
(3, 'Дронов В');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `IdBook` int NOT NULL,
  `Name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ISBN` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Year` int NOT NULL,
  `Pages` int NOT NULL,
  `IdPublisher` int NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`IdBook`, `Name`, `ISBN`, `Year`, `Pages`, `IdPublisher`, `Date`) VALUES
(1, 'Двенадцать стульев', '', 2016, 416, 1, '2018-02-01'),
(2, 'Laravel 8 Быстрая разработка веб-сайтов на PHP', '', 2021, 688, 2, '2021-12-01');

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE `photos` (
  `IdPhotos` int NOT NULL,
  `IdUser` int NOT NULL,
  `nameFiles` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `photos`
--

INSERT INTO `photos` (`IdPhotos`, `IdUser`, `nameFiles`, `date`) VALUES
(1, 15, 'Download.png', '2022-04-24 00:00:00'),
(2, 14, 's-valentinka0026.png', '2022-04-24 12:00:13');

-- --------------------------------------------------------

--
-- Структура таблицы `publisher`
--

CREATE TABLE `publisher` (
  `IdPublisher` int NOT NULL,
  `Name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `publisher`
--

INSERT INTO `publisher` (`IdPublisher`, `Name`) VALUES
(1, 'Текст'),
(2, 'БХВ-СанктПетербург');

-- --------------------------------------------------------

--
-- Структура таблицы `relbookauthor`
--

CREATE TABLE `relbookauthor` (
  `IdRel` int NOT NULL,
  `IdBook` int NOT NULL,
  `IdAuthor` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `relbookauthor`
--

INSERT INTO `relbookauthor` (`IdRel`, `IdBook`, `IdAuthor`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `idUser` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `password` varchar(250) NOT NULL,
  `token` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`idUser`, `name`, `password`, `token`) VALUES
(12, '111', '698d51a19d8a121ce581499d7b701668', '625ddf12bf617'),
(13, '222', 'bcbe3365e6ac95ea2c0343a2395834dd', '625de0c1e7eb8'),
(14, 'Юрий', '202cb962ac59075b964b07152d234b70', '62617248e76dd'),
(15, 'Антушев', '202cb962ac59075b964b07152d234b70', '62650e38edfdd');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`IdAuthor`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`IdBook`),
  ADD UNIQUE KEY `pages` (`Pages`) USING BTREE;

--
-- Индексы таблицы `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`IdPhotos`);

--
-- Индексы таблицы `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`IdPublisher`);

--
-- Индексы таблицы `relbookauthor`
--
ALTER TABLE `relbookauthor`
  ADD PRIMARY KEY (`IdRel`),
  ADD KEY `IdBook` (`IdBook`),
  ADD KEY `IdAuthor` (`IdAuthor`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `IdBook` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `photos`
--
ALTER TABLE `photos`
  MODIFY `IdPhotos` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `relbookauthor`
--
ALTER TABLE `relbookauthor`
  MODIFY `IdRel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
