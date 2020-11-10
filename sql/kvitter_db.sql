-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28. Apr, 2018 00:28 AM
-- Server-versjon: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kvitter_db`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `follow`
--

CREATE TABLE `follow` (
  `user_id` int(11) NOT NULL,
  `user_id_follow` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `follow`
--

INSERT INTO `follow` (`user_id`, `user_id_follow`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 10),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 18),
(3, 1),
(3, 2),
(3, 16),
(15, 1),
(15, 2),
(15, 3);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_text` varchar(600) NOT NULL,
  `posttime` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `posts`
--

INSERT INTO `posts` (`post_id`, `post_text`, `posttime`, `user_id`) VALUES
(37, 'Velkommen til Kvitter!', '22:05 - 26 April 2018', 1),
(62, 'Hei, jeg er Per og dette er mitt første innlegg', '23:21 - 26 April 2018', 3),
(63, 'Nå mangler jeg bare, people search siden, følge knapp, og home some displayer alle du følger', '23:34 - 26 April 2018', 1),
(68, 'Heisann dette er et innlegg, tralalalalal', '10:07 - 27 April 2018', 13),
(69, 'Lorem ipsum er opprinnelig et lettere redigert utdrag fra De finibus bonorum et malorum (Om det høyeste mål for godt og ondt) av Cicero. Opprinnelig begynte avsnittet: Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit («Ingen liker smerte for smertens skyld, eller søker den og ønsker den, bare fordi den er smerte…») . ', '10:11 - 27 April 2018', 13),
(70, 'Ullern Basketball Klubb på Østlandet er den eldste norske basketballklubben og ble stiftet 1. desember 1956. Sporten hadde da blitt bragt hit av norske studenter som hadde studert i USA. Til å begynne med ble sporten kun spilt på universiteter og videregående skoler. De første årene var amerikanske mormoner aktive i organisering og som trenere og spillere. Den første hovedserien ble da også kalt mormonerserien og startet i 1962. NBBF (Norges Basketballforbund) ble stiftet i 1968, tolv år etter at Ullern hadde blitt stiftet. Til da hadde basketball bare vært organisert som et utvalg under Norge', '10:11 - 27 April 2018', 13),
(71, 'Neil deGrasse Tyson (født 5. oktober 1958 i Manhattan, New York City USA) er en amerikansk astrofysiker. Han er i dag direktør for Hayden Planetarium ved Rose Center for Earth and Space, samt forsker i avdelingen for astrofysikk ved det American Museum of Natural History. Siden 2006 har han arrangert det pedagogiske TV-programmet NOVA scienceNOW på PBS, og har vært en hyppig gjest på The Daily Show, The Colbert Report, Real Time with Bill Maher, og Jeopardy! som representant for det vitenskapelige miljøet. Den 1. juni 2009 satte Tyson i gang et radioprogram med navnet StarTalk Radio.', '10:12 - 27 April 2018', 3),
(72, 'Wikimedia Commons er et prosjekt drevet av Wikimedia Foundation som har som formål å bygge opp en sentral database for å gjøre bilder, videofilmer og lyd tilgjengelig for alle wikimedias prosjekter. Filene i commons-basen er direkte tilgjengelige for de andre wikimedia-prosjektene, for eksempel det flerspråklige nettleksikonet Wikipedia, nettordboka Wiktionary og fagboksamliga Wikibooks. Prosjektet ble satt i gang 7. september 2004. ', '10:12 - 27 April 2018', 3),
(73, 'Muhammad Ali (født Cassius Marcellus Clay jr. 17. januar 1942 i Louisville i Kentucky, død 3. juni 2016 i Scottsdale i Arizona[2]) var en amerikansk profesjonell bokser som flere ganger var verdensmester i vektklassen tungvekt. Ali regnes for å være en av tidenes beste boksere. Han forsvarte tungvektstittelen i alt 19 ganger.', '10:13 - 27 April 2018', 10),
(74, 'Ved slutten av 1963 hadde Clay blitt toppkandidat til Sonny Listons tittel. Kampen ble berammet til 25. februar 1964 i Miami Beach. Liston var en skremmende personlighet, en dominerende fighter med en kriminell fortid og bånd til mafiaen. Basert på Clays uinspirerte ytelse mot Jones og Cooper i sine to foregående kamper, og Liston fullstendige dominans over tidligere tungvektsmester Floyd Patterson med to knock outs i første runde, var Clay en 7-1 underdog blant bookmakerne. Til tross for dette hånet han Liston før kampen, og kalte ham blant annet «den store stygge bjørnen». «Liston lukter til', '10:14 - 27 April 2018', 10),
(75, 'Deilig vær ute i dag!', '10:14 - 27 April 2018', 10),
(82, 'Jeg er Jens, generalsekretær i NATO', '10:52 - 27 April 2018', 14),
(88, 'Siste som mangler nå er en Home som displayer alle du følger/like knapp', '15:25 - 27 April 2018', 1),
(91, 'Wazzup fellas?', '17:25 - 27 April 2018', 16),
(123, 'Jeg har du noen gang har vært med i går var det ikke så veldig lenge du ikke har fått svar på treningen er på vei hjem fra skolen til høsten er her og der var det ikke var det ikke er så mye å si noe om det var', '20:40 - 27 April 2018', 18),
(127, 'Nå er prosjektet ferdig og klar for å leveres!', '20:56 - 27 April 2018', 1);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pic` varchar(11) NOT NULL DEFAULT '1.jpg',
  `u_type` int(11) NOT NULL DEFAULT '1',
  `password` varchar(255) NOT NULL,
  `creationtime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `users`
--

INSERT INTO `users` (`user_id`, `username`, `f_name`, `l_name`, `email`, `pic`, `u_type`, `password`, `creationtime`) VALUES
(1, 'admin', 'Kasper', 'Emmerhoff', 'admin@kvitter.no', '2.jpg', 1, '$2y$10$CUX8RRb8IHhFw4wEcJA8teg469U1XhOYJJWk.2OVf.omp3HbL0Kkq', '2018-04-25 11:26:12'),
(2, 'alex', 'Alex', 'Pang', 'alex@bangerang.no', '2.jpg', 1, '$2y$10$CfUm5OBSe9lq9dast2ujYuzyXh9Rx0aWEB4/61GiradQ.Vhb4busa', '2018-04-25 11:50:23'),
(3, 'per', 'Per', 'Hansen', 'a@a.a', '4.jpg', 1, '$2y$10$AA3ZSmQNQ42HVn2SJEtUD.1shED5VAxeQFyMkTUoW0IVzHVT28jGe', '2018-04-25 12:40:07'),
(4, 'henrik', 'Steph', 'Curry', 'curry@nba.com', '1.jpg', 1, '$2y$10$.g.pZ4G12GkGq.FqGC/BbuGNMwh3YqvZbh676/zhLhIlRQO0gXFhS', '2018-04-25 14:45:07'),
(10, 'boxingchampion', 'Muhammad', 'Ali', 'muhammad@online.no', '3.jpg', 1, '$2y$10$ZWW8Ngh6Z6yLKC1ZSgzfy.BX3GYDptHAFKxphDqNc2H2G6TZJG7om', '2018-04-26 13:46:26'),
(13, 'muhammad3487', 'Muhammad', 'Ali Fanboy', 'll@ll.ll', '2.jpg', 1, '$2y$10$VbqCshnFGaKq7/eWslGGmuvY5r2Nit9LEBCgzYxw6xGD30cvJaeqW', '2018-04-26 21:17:56'),
(14, 'jensern', 'Jens', 'Stoltenberg', 'jens@meister.no', '4.jpg', 1, '$2y$10$gjVJ3uWof99aolWBfoSmY.yMmwz9MXo3O6vYvPyvM/tXFMWgFTtES', '2018-04-27 10:51:31'),
(15, 'rogerboi', 'Roger', 'Svensen', 'roger@gmail.com', '2.jpg', 1, '$2y$10$WghyiZBw0rPYSjUoAOX6WupHvwRZiXw7I/pFeIpVuL6t2a3wAHlAu', '2018-04-27 17:04:55'),
(16, 'vakuum', 'Henrik', 'Nordtorp', 'hn3107@gmail.com', '2.jpg', 1, '$2y$10$JHEBWFtrPaj1LybgKcgJIOtFmUdV7QruIj7iPts9sX5UDERcgUz76', '2018-04-27 17:15:44'),
(18, 'Saibot', 'Tobias', 'Remmis', 'Skal.dkdks@gmail.com', '1.jpg', 1, '$2y$10$.ZTlCLZHQpz.tZkj4DNHdeGF1bcmc79myTaTeH2lYm6yGfH/XwvnO', '2018-04-27 20:29:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`user_id`,`user_id_follow`),
  ADD KEY `user_id_idx` (`user_id_follow`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id_idx` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name_UNIQUE` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Begrensninger for dumpede tabeller
--

--
-- Begrensninger for tabell `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `user_id_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id_2` FOREIGN KEY (`user_id_follow`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Begrensninger for tabell `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
