-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2015 at 09:46 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sekreti`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `gender` varchar(1) NOT NULL,
  `age` int(2) NOT NULL,
  `votes` varchar(11) DEFAULT '+0',
  `active` int(1) DEFAULT '0',
  `stitle` varchar(4) NOT NULL,
  `posted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `validity` int(11) NOT NULL DEFAULT '1',
  `invalidity` int(11) NOT NULL DEFAULT '1',
  `is_hot` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `content`, `gender`, `age`, `votes`, `active`, `stitle`, `posted`, `validity`, `invalidity`, `is_hot`) VALUES
(1, 'Faccio parte di una piccola azienda. Il mio superiore mi spia in continuazione, che sia in ufficio o a pranzo mi guarda continuamente il seno e il sedere, e ieri mi ha inviata ad andare da lui per parlare del lavoro, ma ho paura che mi faccia qualcosa...', 'f', 20, '+35', 1, 'Tdnh', '2015-01-23 11:16:24', 1, 1, 0),
(2, 'Alcune volte l''uccello mi si rizza senza motivo. Quindi mi ritrovo in classe con le gambe accavallate per nasconderlo. Poi, quando mi devo alzare scatta l''ansia e inizio a tenere la maglietta/felpa piu bassa possibile. Mi sembro scemo....', 'm', 15, '+62', 1, 'dtwH', '2015-07-05 09:15:47', 1, 1, 0),
(3, 'A month ago I made love for the first time with my boyfriend. the next day I would have to come the cycle, but, seeing that after two weeks did not come yet, I did a test. love, I&#039;m pregnant!', 'f', 16, '+4', 1, 'wi0f', '2015-08-26 16:10:19', 1, 1, 0),
(4, 'A week ago I got a tattoo on the thumb. the secret? My mom does not know and then use a ring to cover it.', 'f', 17, '+1', 0, 'f4vB', '2015-08-26 16:12:19', 7, 1, 0),
(5, 'When I go to the pitch with my friends always take me around because after 15 minutes I have to stop because I can not do more, they do not know that I have the heart of a 65-year-old, with his grandfather, without you I&#039;d be in paradise ...', 'm', 15, '+1', 0, 'w32c', '2015-08-26 16:15:28', 4, 4, 0),
(6, 'Ho voglia di lasciare una giornata i nostri bambini ai nonni e scopare tutto il giorno col mio compagno fino a farmi mancare le forze...peccato che siamo talmente sfigati che i nostri parenti non hanno mai tempo...', 'f', 30, '+1', 0, 'Ycwv', '2015-08-26 17:17:07', 7, 1, 0),
(10, 'Sono stato a ibiza, una sera sono uscito e ho incontrato per caso una trans che mi ha minacciato uscendo da sotto la gonna un coltello. dopo le minacce &egrave; passata ai fatti facendomi andare all&#039;ospedale con fratture multiple. adesso ho paura di uscire e dormo con un&#039;arma sotto il cuscino', 'm', 17, '+1', 0, 'ZQtn', '2015-08-27 18:35:19', 5, 3, 0),
(11, 'il mio prof del liceo aeronautico diceva che non sapr&ograve; mai volare e che avrei fatto precipitare tutti gli aerei che avrei guidato. sono uno dei migliori al mondo con pi&ugrave; di 7000 ore di volo alle spalle e domani sar&ograve; il primo pilota a volare su un nuovo aereo. ti sta bene prof di merda', 'm', 32, '+1', 0, 'AG9Z', '2015-09-04 16:09:57', 8, 4, 0),
(12, 'sadaskdjaskldaskl askdmaslkdmasd askld asdklasd akdakl', 'm', 0, '+0', 0, 'ZSUw', '2015-09-14 15:02:59', 1, 3, 0),
(13, 'Ogni giorno penso di avere qualcuno vicino a me che mi controlla...sar&aacute; la solitudine a causare questo :(', 'f', 14, '+0', 0, 'k1G7', '2015-09-14 15:53:42', 3, 1, 0),
(14, 'Lavoro in un officina e mi sono scopato il capo officina (gay) perche ho rotto un vetro per sbaglio e non volevo pagare 300 &euro; (meglio 20 minuti di dolore che meta mese di lavoro', 'm', 32, '+0', 0, 'FTGm', '2015-09-27 09:44:30', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `permissions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
