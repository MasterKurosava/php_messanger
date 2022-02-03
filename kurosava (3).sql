-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 03 2022 г., 19:23
-- Версия сервера: 8.0.24
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kurosava`
--

-- --------------------------------------------------------

--
-- Структура таблицы `group_list`
--

CREATE TABLE `group_list` (
  `ID` varchar(12) NOT NULL,
  `NAME` varchar(40) NOT NULL,
  `USERS` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `message_list`
--

CREATE TABLE `message_list` (
  `ID` int NOT NULL,
  `CHAT_ID` varchar(20) NOT NULL,
  `USER_ID` int NOT NULL,
  `USER_NAME` varchar(40) NOT NULL,
  `CONTENT` text NOT NULL,
  `TIME` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `private_list`
--

CREATE TABLE `private_list` (
  `ID` varchar(12) NOT NULL,
  `USER1_ID` int NOT NULL,
  `USER2_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `ID` int NOT NULL,
  `LOGIN` varchar(40) NOT NULL,
  `PASSWORD` varchar(40) NOT NULL,
  `EMAIL` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `GROUP_CHAT_LIST` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `PRIVATE_CHAT_LIST` text NOT NULL,
  `IMG_PROFILE` blob,
  `VERIFICATION` int NOT NULL DEFAULT '0',
  `TOKEN` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `PASSWORD_COOKIE_TOKEN` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`ID`, `LOGIN`, `PASSWORD`, `EMAIL`, `GROUP_CHAT_LIST`, `PRIVATE_CHAT_LIST`, `IMG_PROFILE`, `VERIFICATION`, `TOKEN`, `PASSWORD_COOKIE_TOKEN`) VALUES
(1, 'Lizka', 'f5bb0c8de146c67b44babbf4e6584cc0liza', 'liza@mail.ru', '[]', '[]', NULL, 1, NULL, NULL),
(2, '', 'f5bb0c8de146c67b44babbf4e6584cc0liza', 'dima@mail.ru', '[]', '[]', NULL, 1, NULL, NULL),
(3, 'SuperKirill', 'f5bb0c8de146c67b44babbf4e6584cc0liza', 'skiril@mail.ru', '[]', '[]', NULL, 1, NULL, NULL),
(4, 'Мексика', 'f5bb0c8de146c67b44babbf4e6584cc0liza', 'meksika@mail.ru', '[]', '[]', NULL, 1, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `group_list`
--
ALTER TABLE `group_list`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `message_list`
--
ALTER TABLE `message_list`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `private_list`
--
ALTER TABLE `private_list`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `message_list`
--
ALTER TABLE `message_list`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
