-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Gru 2019, 22:43
-- Wersja serwera: 10.1.37-MariaDB
-- Wersja PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `e14`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pytania`
--

CREATE TABLE `pytania` (
  `id` int(11) NOT NULL,
  `pytanie` text COLLATE utf8_polish_ci NOT NULL,
  `obrazek` text COLLATE utf8_polish_ci,
  `odpowiedz` varchar(1) COLLATE utf8_polish_ci NOT NULL,
  `odpowiedz_a` text COLLATE utf8_polish_ci NOT NULL,
  `odpowiedz_b` text COLLATE utf8_polish_ci NOT NULL,
  `odpowiedz_c` text COLLATE utf8_polish_ci NOT NULL,
  `odpowiedz_d` text COLLATE utf8_polish_ci NOT NULL,
  `good_answers` int(11) NOT NULL DEFAULT '0',
  `all_answers` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pytania`
--

INSERT INTO `pytania` (`id`, `pytanie`, `obrazek`, `odpowiedz`, `odpowiedz_a`, `odpowiedz_b`, `odpowiedz_c`, `odpowiedz_d`, `good_answers`, `all_answers`) VALUES
(3, 'W instrukcji CREATE TABLE użycie klauzuli PRIMARY KEY przy deklaracji pola tabeli spowoduje, że pole to stanie się', NULL, 'D', 'kluczem obcym', 'indeksem klucza', 'indeksem unikalnym', 'kluczem podstawowym', 3, 5),
(4, 'Aby zapisać prostą animację na potrzeby strony internetowej, można skorzystać z formatu', NULL, 'A', 'GIF', 'JPG', 'PNG', 'CDR', 3, 7),
(16, 'W celu dodania rekordu do tabeli Pracownicy należy użyć polecenia SQL', NULL, 'A', 'INSERT INTO Pracownicy VALUES (\"Jan\", \"Kowalski\");', 'INSERT VALUES (Jan; Kowalski) INTO Pracownicy;', 'INSERT VALUES Pracownicy INTO (Jan, Kowalski);', 'INSERT (Jan), (Kowalski) INTO TABLE Pracownicy;', 2, 7),
(18, 'Jeśli rozmiar pliku graficznego jest zbyt duży do publikacji w Internecie, należy', NULL, 'B', 'dodać kanał alfa', 'zmniejszyć jego rozdzielczość', 'zwiększyć jego głębię kolorów', 'zapisać w formacie BMP', 3, 8),
(19, 'Edytując grafikę w edytorze grafiki rastrowej należy pozbyć się kolorów z rysunku tak, aby obraz był w odcieniach szarości. Można do tego efektu wykorzystać funkcję', NULL, 'A', 'desaturacji', 'kadrowania', 'szumu RGB', 'filtru rozmycia', 1, 3),
(20, 'Przekierowanie 301 służące przekierowaniu użytkownika z jednego adresu URL na inny można ustawić w pliku konfiguracji serwera Apache o nazwie', NULL, 'B', 'conf.php', '.htaccess', '.apacheConf', 'configuration.php', 5, 7),
(21, 'Który z formatów graficznych pozwala na zapis przejrzystego tła?', NULL, 'A', 'GIF', 'RAW', 'BMP', 'JPEG', 5, 6),
(22, 'Co należy zastosować w organizacji danych, aby zapytania w bazie danych były wykonywane szybciej?', NULL, 'B', 'Reguły', 'Indeksy', 'Wartości domyślne', 'Klucze podstawowe', 4, 7),
(23, 'W języku JavaScript, aby sprawdzić warunek czy liczba znajduje się w przedziale (100;200>, należy zapisać:', NULL, 'C', 'if (liczba > 100 || liczba <= 200)', 'if (liczba < 100 || liczba >= 200)', 'if (liczba > 100 && liczba <= 200)', 'if (liczba < 100 && liczba <= 200)', 2, 5),
(24, 'Który kod jest alternatywny do kodu zamieszczonego w ramce?', 'kod.jpg', 'A', 'A', 'B', 'C', 'D', 3, 8),
(25, 'Jak nazywa się element bazy danych, za pomocą którego można jedynie odczytać dane z bazy, prezentując je w postaci tekstu lub wykresu?', NULL, 'B', 'Tabela', 'Raport', 'Zapytanie', 'Formularz', 3, 5),
(27, 'Przedstawiono kod tabeli 3x2. Której z modyfikacji w jej drugim wierszu należy dokonać, aby tabela wyglądała jak na obrazku z niewidocznym wierszem?', 'html.jpg', 'C', '&lt;tr style=&quot;clear: none&quot;&gt;', '&lt;tr style=&quot;display: none&quot;&gt;', '&lt;tr style=&quot;visibility: hidden&quot;&gt;', '&lt;tr style=&quot;display: table-cell&quot;&gt;', 2, 4),
(28, 'Przedstawiona linia kreskowana w stylu obramowania CSS jest określona właściwością', 'css.jpg', 'D', 'solid', 'double', 'dotted', 'dashed', 2, 5),
(29, 'Aby policzyć wszystkie wiersze tabeli Koty należy użyć polecenia:', NULL, 'A', 'SELECT COUNT(*) FROM Koty', 'SELECT ROWNUM() FROM Koty', 'SELECT COUNT(Koty) AS ROWNUM', 'SELECT COUNT(ROWNUM) FROM Koty', 3, 6),
(30, 'Zamieszczony w ramce fragment skryptu w języku JavaScript', 'js.jpg', 'C', 'przypisze zmiennej s zmienną t', 'wyświetli długość napisu ze zmiennej t ', 'przypisze zmiennej s długość napisu ze zmiennej t', 'przypisze zmiennej s fragment napisu ze zmiennej t, o określonej przez zmienną length długości', 3, 7);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `login` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `good_answers` int(11) NOT NULL DEFAULT '0',
  `all_answers` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `password`, `isAdmin`, `good_answers`, `all_answers`) VALUES
(12, 'admin', '$2y$10$O1PDgmFxtVVPOHlV9/plwezC7JNTyW3LjaWKvUMNJdASnL9F0vE6C', 1, 11, 30),
(18, 'test', '$2y$10$1gcvoSVyxnvhLfAhZdKgoeX8A/qQssi4c30MiWnAYPMRmpYG9gKR6', 0, 17, 20),
(19, 'żółciak', '$2y$10$GZzxFKoXXRvRsuBNW4g0U.uyIJxmpHECq4Zzg9A0rp.4GeS66enLe', 0, 9, 20);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `pytania`
--
ALTER TABLE `pytania`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `pytania`
--
ALTER TABLE `pytania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
