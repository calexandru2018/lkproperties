-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 27-Set-2018 às 17:45
-- Versão do servidor: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lkproper_lk`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `activity_gallery`
--

DROP TABLE IF EXISTS `activity_gallery`;
CREATE TABLE IF NOT EXISTS `activity_gallery` (
  `activity_gallery_ID` int(11) NOT NULL AUTO_INCREMENT,
  `activity_link_ID` int(11) NOT NULL,
  `thumbnailURL` varchar(500) NOT NULL,
  `fullsizeURL` varchar(500) NOT NULL,
  `photoOrder` tinyint(2) DEFAULT NULL,
  `isPrimary` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`activity_gallery_ID`),
  KEY `ag_activity_link_FK` (`activity_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `activity_gallery`
--

INSERT INTO `activity_gallery` (`activity_gallery_ID`, `activity_link_ID`, `thumbnailURL`, `fullsizeURL`, `photoOrder`, `isPrimary`) VALUES
(18, 1, 'DSC_1954.jpeg', 'DSC_1954.jpeg', NULL, NULL),
(19, 1, 'DSC_1955.jpeg', 'DSC_1955.jpeg', NULL, NULL),
(21, 1, 'DSC_1956.jpeg', 'DSC_1956.jpeg', NULL, NULL),
(27, 4, 'DSC_1641.jpeg', 'DSC_1641.jpeg', NULL, NULL),
(28, 4, 'DSC_1697.jpeg', 'DSC_1697.jpeg', NULL, NULL),
(29, 4, 'DSC_1728.jpeg', 'DSC_1728.jpeg', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `activity_link`
--

DROP TABLE IF EXISTS `activity_link`;
CREATE TABLE IF NOT EXISTS `activity_link` (
  `activity_link_ID` int(11) NOT NULL AUTO_INCREMENT,
  `city_link_ID` int(11) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`activity_link_ID`),
  KEY `city_link_ID_FK` (`city_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='table denormalized to reduce query complexity';

--
-- Extraindo dados da tabela `activity_link`
--

INSERT INTO `activity_link` (`activity_link_ID`, `city_link_ID`, `dateCreated`) VALUES
(1, 1, '2018-08-17 20:00:53'),
(4, 5, '2018-08-19 22:34:04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `activity_translation`
--

DROP TABLE IF EXISTS `activity_translation`;
CREATE TABLE IF NOT EXISTS `activity_translation` (
  `activity_translation_ID` int(11) NOT NULL AUTO_INCREMENT,
  `activity_link_ID` int(11) NOT NULL,
  `langCode` varchar(5) NOT NULL,
  `nameTranslated` varchar(200) NOT NULL,
  `descriptionTranslated` text NOT NULL,
  PRIMARY KEY (`activity_translation_ID`),
  KEY `activity_link_FK` (`activity_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `activity_translation`
--

INSERT INTO `activity_translation` (`activity_translation_ID`, `activity_link_ID`, `langCode`, `nameTranslated`, `descriptionTranslated`) VALUES
(1, 1, 'pt', 'Slide&Splash', '<p>Breve descri&ccedil;&atilde;o do&nbsp;Slide&amp;Splash.</p>\n'),
(2, 1, 'en', 'Slide&Splash', '<p>Short description about&nbsp;Slide&amp;Splash.</p>\n'),
(7, 4, 'pt', 'Forte de Sagres', '<p>0xgJyViBs</p>\n'),
(8, 4, 'en', 'Fortress of Sagres', '<p>Z8uybCSS1</p>\n');

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dateModified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `isPublicVisible` tinyint(1) NOT NULL,
  `adminPrivilege` tinyint(1) NOT NULL,
  `thumbnailURL` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`admin_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`admin_ID`, `name`, `email`, `password`, `dateCreated`, `dateModified`, `isActive`, `isPublicVisible`, `adminPrivilege`, `thumbnailURL`) VALUES
(1, 'Alexandru Cheltuitor', 'ac@test.com', '$2y$10$8SeubF4IZaX401DRqxUHVu8Ew8300RlK7Y8i7Vswflfxse3wLgWjO', '2018-08-17 18:34:10', '2018-09-01 23:46:51', 1, 1, 2, 'Insparksbilder-40-kopia.jpeg'),
(2, 'Lilia Ungureanu', 'test@testl.com', '$2y$10$E5rG3C2qvZ28ruVoCas8DeeR2GwX5EjC5iK5fJ40CQUZS9N/KcUqO', '2018-08-20 18:48:26', '2018-09-01 23:24:21', 1, 1, 2, 'IMG_6791_1.jpeg'),
(3, 'Joao Lopes', 'jl@gmail.com', '$2y$10$6q6l8te3BoaDcCQNp/41cutyHsKPjdhv2hj.oe9BWXDAZR5niYJ1G', '2018-08-20 18:48:56', '2018-08-20 18:58:58', 1, 1, 2, 'IMG_6782.jpeg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin_activity`
--

DROP TABLE IF EXISTS `admin_activity`;
CREATE TABLE IF NOT EXISTS `admin_activity` (
  `admin_activity_ID` int(11) NOT NULL AUTO_INCREMENT,
  `admin_ID` int(11) NOT NULL,
  `lastLogin` varchar(40) NOT NULL,
  `lastLogout` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`admin_activity_ID`),
  KEY `admin_ID_FK` (`admin_ID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `city_gallery`
--

DROP TABLE IF EXISTS `city_gallery`;
CREATE TABLE IF NOT EXISTS `city_gallery` (
  `city_gallery_ID` int(11) NOT NULL AUTO_INCREMENT,
  `city_link_ID` int(11) NOT NULL,
  `thumbnailURL` varchar(500) NOT NULL,
  `fullsizeURL` varchar(500) NOT NULL,
  `photoOrder` tinyint(2) DEFAULT NULL,
  `isPrimary` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`city_gallery_ID`),
  KEY `cg_city_link_FK` (`city_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `city_gallery`
--

INSERT INTO `city_gallery` (`city_gallery_ID`, `city_link_ID`, `thumbnailURL`, `fullsizeURL`, `photoOrder`, `isPrimary`) VALUES
(68, 1, 'P8020267.jpeg', 'P8020267.jpeg', NULL, NULL),
(69, 1, 'SDC10907.jpeg', 'SDC10907.jpeg', NULL, NULL),
(70, 1, 'SDC10986.jpeg', 'SDC10986.jpeg', NULL, NULL),
(71, 1, 'SDC13089.jpeg', 'SDC13089.jpeg', NULL, NULL),
(110, 3, 'SDC17199.jpeg', 'SDC17199.jpeg', NULL, NULL),
(113, 1, 'SDC17200.jpeg', 'SDC17200.jpeg', NULL, NULL),
(115, 3, 'SDC13561.jpeg', 'SDC13561.jpeg', NULL, NULL),
(116, 1, 'SDC17202.jpeg', 'SDC17202.jpeg', NULL, NULL),
(117, 3, 'SDC17170.jpeg', 'SDC17170.jpeg', NULL, NULL),
(119, 3, 'SDC13561_1.jpeg', 'SDC13561_1.jpeg', NULL, NULL),
(121, 3, 'SDC17202.jpeg', 'SDC17202.jpeg', NULL, NULL),
(125, 3, 'SDC17200.jpeg', 'SDC17200.jpeg', NULL, NULL),
(127, 3, 'SDC17200_1.jpeg', 'SDC17200.jpeg', NULL, NULL),
(128, 3, 'SDC17182.jpeg', 'SDC17182.jpeg', NULL, NULL),
(133, 3, 'SDC17182_1.jpeg', 'SDC17182_1.jpeg', NULL, NULL),
(134, 6, 'IMG_0078.jpeg', 'IMG_0078.jpeg', NULL, NULL),
(135, 6, 'IMG_0081.jpeg', 'IMG_0081.jpeg', NULL, NULL),
(136, 6, 'IMG_0082.jpeg', 'IMG_0082.jpeg', NULL, NULL),
(137, 6, 'IMG_0083.jpeg', 'IMG_0083.jpeg', NULL, NULL),
(138, 6, 'WC-servico.jpeg', 'WC-servico.jpeg', NULL, NULL),
(139, 1, 'P6170667.jpeg', 'P6170667.jpeg', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `city_link`
--

DROP TABLE IF EXISTS `city_link`;
CREATE TABLE IF NOT EXISTS `city_link` (
  `city_link_ID` int(11) NOT NULL AUTO_INCREMENT,
  `videoURL` varchar(500) DEFAULT NULL,
  `postalCode` smallint(4) NOT NULL,
  `isPopular` tinyint(1) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`city_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `city_link`
--

INSERT INTO `city_link` (`city_link_ID`, `videoURL`, `postalCode`, `isPopular`, `dateCreated`) VALUES
(1, '', 8500, 1, '2018-08-17 18:35:09'),
(3, '', 8100, 1, '2018-08-19 18:37:38'),
(4, '2GlaokDKJ', 8501, 0, '2018-08-19 22:14:23'),
(5, '', 8650, 1, '2018-08-19 22:32:58'),
(6, '', 7000, 1, '2018-09-01 22:53:23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `city_poi_link`
--

DROP TABLE IF EXISTS `city_poi_link`;
CREATE TABLE IF NOT EXISTS `city_poi_link` (
  `city_poi_link_ID` int(11) NOT NULL AUTO_INCREMENT,
  `city_link_ID` int(11) NOT NULL,
  `poi_link_ID` int(11) DEFAULT NULL,
  `isAlgarve` tinyint(1) NOT NULL,
  PRIMARY KEY (`city_poi_link_ID`),
  KEY `city_link_FK` (`city_link_ID`),
  KEY `poi_link_FK` (`poi_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `city_poi_link`
--

INSERT INTO `city_poi_link` (`city_poi_link_ID`, `city_link_ID`, `poi_link_ID`, `isAlgarve`) VALUES
(1, 1, 1, 1),
(3, 4, 3, 1),
(4, 4, 5, 1),
(5, 6, 6, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `city_translation`
--

DROP TABLE IF EXISTS `city_translation`;
CREATE TABLE IF NOT EXISTS `city_translation` (
  `city_translation_ID` int(11) NOT NULL AUTO_INCREMENT,
  `city_link_ID` int(11) NOT NULL,
  `langCode` varchar(5) NOT NULL,
  `nameTranslated` varchar(200) NOT NULL,
  `descriptionTranslated` text NOT NULL,
  PRIMARY KEY (`city_translation_ID`),
  KEY `city_translation_FK` (`city_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `city_translation`
--

INSERT INTO `city_translation` (`city_translation_ID`, `city_link_ID`, `langCode`, `nameTranslated`, `descriptionTranslated`) VALUES
(1, 1, 'pt', 'PortimÃ£o', '<p>Isto &eacute; descri&ccedil;&atilde;o da cidade Portim&atilde;o.</p>\n'),
(2, 1, 'en', 'PortimÃ£o', '<p>This is a description in English.</p>\n'),
(5, 3, 'pt', 'Faro', '<p>Breve descricao de Faro</p>\n'),
(6, 3, 'en', 'Faro', '<p>Short Description about Faro</p>\n'),
(7, 4, 'pt', 'Alvor', '<p>jAwVEPtf0</p>\n'),
(8, 4, 'en', 'Alvor', '<p>kUQSitw7V</p>\n'),
(9, 5, 'pt', 'Sagres', '<p>fIAFSuoqS</p>\n'),
(10, 5, 'en', 'Sagres', '<p>8hZEAemeH</p>\n'),
(11, 6, 'pt', 'Vilamoura', '<p>Vilamoura PT</p>\n'),
(12, 6, 'en', 'Vilamoura', '<p>Vilamoura EN</p>\n');

-- --------------------------------------------------------

--
-- Estrutura da tabela `common_service_link`
--

DROP TABLE IF EXISTS `common_service_link`;
CREATE TABLE IF NOT EXISTS `common_service_link` (
  `common_service_link_ID` int(11) NOT NULL AUTO_INCREMENT,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`common_service_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `common_service_link`
--

INSERT INTO `common_service_link` (`common_service_link_ID`, `dateCreated`) VALUES
(1, '2018-08-17 19:58:16'),
(2, '2018-08-17 19:58:16'),
(3, '2018-08-17 19:59:29'),
(4, '2018-08-20 16:47:04'),
(5, '2018-08-20 16:47:04'),
(6, '2018-08-20 16:47:04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `common_service_translation`
--

DROP TABLE IF EXISTS `common_service_translation`;
CREATE TABLE IF NOT EXISTS `common_service_translation` (
  `common_service_translation_ID` int(11) NOT NULL AUTO_INCREMENT,
  `common_service_link_ID` int(11) NOT NULL,
  `langCode` varchar(5) NOT NULL,
  `serviceTranslated` varchar(200) NOT NULL,
  PRIMARY KEY (`common_service_translation_ID`),
  KEY `service_link_FK` (`common_service_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `common_service_translation`
--

INSERT INTO `common_service_translation` (`common_service_translation_ID`, `common_service_link_ID`, `langCode`, `serviceTranslated`) VALUES
(1, 1, 'pt', 'MÃ¡quina de Lavar LoiÃ§a'),
(2, 1, 'en', 'Dishwashing machine'),
(3, 2, 'pt', 'MÃ¡quina de Lavar Roupa'),
(4, 2, 'en', 'Washing Machine'),
(5, 3, 'pt', 'Talheres'),
(6, 3, 'en', 'Cutlery'),
(7, 4, 'pt', 'Cofre'),
(8, 4, 'en', 'Safe'),
(9, 5, 'pt', 'Toalhas'),
(10, 5, 'en', 'Towels'),
(11, 6, 'pt', 'UtensÃ­lio de Cozinha'),
(12, 6, 'en', 'Kitchenware');

-- --------------------------------------------------------

--
-- Estrutura da tabela `faq_answer_translation`
--

DROP TABLE IF EXISTS `faq_answer_translation`;
CREATE TABLE IF NOT EXISTS `faq_answer_translation` (
  `faq_answer_translated_ID` int(11) NOT NULL AUTO_INCREMENT,
  `faq_link_ID` int(11) NOT NULL,
  `langCode` varchar(5) NOT NULL,
  `answerTranslated` text NOT NULL,
  PRIMARY KEY (`faq_answer_translated_ID`),
  KEY `fat_faq_link_FK` (`faq_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `faq_answer_translation`
--

INSERT INTO `faq_answer_translation` (`faq_answer_translated_ID`, `faq_link_ID`, `langCode`, `answerTranslated`) VALUES
(3, 2, 'pt', '<p><strong>PORTUGUES</strong></p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eleifend vitae ligula eget ultricies. Vestibulum efficitur interdum purus, eu elementum lorem accumsan non. Nulla et semper massa. Vivamus dignissim lectus id magna rhoncus maximus ut vel dui. Ut a elementum leo. In urna urna, tempor non dui non, laoreet tempus elit. Vestibulum lacinia, purus quis elementum viverra, orci quam auctor nisl, vitae pretium nisl felis cursus est. Nullam consectetur quis diam ultricies pretium. Sed congue dictum efficitur.</p>\n\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed sed sem dui. Vestibulum tempor facilisis libero, ac maximus odio gravida vitae. Vivamus auctor risus quis aliquam sagittis. Vivamus sed bibendum libero. Quisque tristique nulla vitae elementum ullamcorper. In rutrum sed sem a molestie. Vivamus auctor, arcu a molestie iaculis, urna felis bibendum augue, sit amet aliquam eros enim a metus. Pellentesque venenatis felis erat, non vulputate elit fringilla at. Quisque eu malesuada est.</p>\n\n<p>Pellentesque vel tortor ut quam fringilla tempus in pretium nunc. Ut quis tempus dolor. Vivamus dui dui, feugiat quis magna vel, tincidunt bibendum nibh. Morbi sodales tempus eros, in rutrum dolor interdum quis. Cras sed metus ut dui congue hendrerit at dapibus tellus. Maecenas nec laoreet dolor, id euismod lorem. Praesent eu mi sed augue lobortis luctus ac ac ex. Aliquam vel mollis ex, at aliquam dolor. Cras eget sapien placerat, faucibus purus in, ullamcorper ligula. Nam dictum, dolor non molestie tincidunt, purus neque aliquet metus, quis condimentum tellus augue vel neque. Curabitur rutrum, nibh sit amet lobortis malesuada, metus risus commodo nisl, at ornare ipsum eros faucibus lorem. Nam congue odio a aliquam maximus.</p>\n\n<p>Donec est massa, ullamcorper in accumsan quis, tempus nec erat. Quisque non ex est. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dictum, tortor eu placerat elementum, neque lorem auctor enim, eu commodo nulla nulla non arcu. Cras a laoreet dolor. Donec sollicitudin arcu quis blandit cursus. Morbi orci mi, cursus id fermentum ut, laoreet eget turpis. In hac habitasse platea dictumst. Fusce magna ante, porta a viverra nec, accumsan et tortor. Donec ullamcorper, tellus quis venenatis posuere, quam enim accumsan quam, eu scelerisque lorem lorem in lacus. Ut pharetra eu lacus quis imperdiet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus vel aliquet leo. Vivamus eu lobortis felis, eget tristique lectus. Aliquam suscipit risus at massa gravida tincidunt.</p>\n\n<p>Vivamus suscipit odio eu lectus consequat porta. Nullam non leo ex. Nunc posuere tincidunt arcu, a volutpat eros. Cras sed velit ornare, dictum sapien a, volutpat leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus elit nulla, efficitur sit amet ante quis, rutrum molestie ante. Curabitur euismod dui eget magna accumsan, quis dignissim quam pretium. Sed sit amet ex id leo condimentum euismod sed at lacus. Pellentesque bibendum massa ex, sit amet luctus orci hendrerit convallis. Praesent elementum sagittis enim, et dapibus dolor.</p>\n\n<p>Morbi tincidunt nisl vitae condimentum cursus. Curabitur et lorem pharetra erat pellentesque varius. Vivamus tortor diam, lobortis nec imperdiet et, convallis eu dolor. In aliquet urna quis neque scelerisque volutpat. Integer venenatis malesuada metus, sit amet tristique odio suscipit id. Donec in turpis eu mauris aliquet finibus. Nulla non ultricies dui. Suspendisse elementum est ac convallis mollis. In condimentum non est id blandit. In hac habitasse platea dictumst. Etiam sit amet dignissim nibh, cursus ullamcorper nisi. Vivamus volutpat posuere mi. Morbi luctus feugiat ante, in condimentum ligula finibus vitae. Donec semper nisi id turpis interdum, at feugiat ligula porttitor. Curabitur sed ante vel ipsum vulputate elementum.</p>\n\n<p>Quisque sollicitudin lacinia mi, at faucibus felis volutpat vitae. Proin laoreet fermentum laoreet. Phasellus aliquet dictum tristique. Morbi viverra, felis et cursus elementum, nisi libero interdum ante, non aliquet orci velit non turpis. Nulla facilisi. Morbi sit amet felis nibh. Cras in magna placerat turpis dapibus aliquet et id ante. Quisque interdum, metus in commodo gravida, enim lorem hendrerit diam, in elementum lacus purus vel erat. Sed feugiat urna metus, eu vestibulum elit ultrices id. Aenean non leo sapien. Duis bibendum, turpis eu scelerisque auctor, purus nulla bibendum justo, vel pretium nunc justo a nunc. Interdum et malesuada fames ac ante ipsum primis in faucibus. Proin nec feugiat ligula. Fusce ut faucibus nisl. Mauris eget mauris eget arcu tincidunt sodales sed in libero. Praesent ex justo, pulvinar sed ullamcorper vitae, condimentum vel lacus.</p>\n'),
(4, 2, 'en', '<p><strong>ENGLISH</strong></p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eleifend vitae ligula eget ultricies. Vestibulum efficitur interdum purus, eu elementum lorem accumsan non. Nulla et semper massa. Vivamus dignissim lectus id magna rhoncus maximus ut vel dui. Ut a elementum leo. In urna urna, tempor non dui non, laoreet tempus elit. Vestibulum lacinia, purus quis elementum viverra, orci quam auctor nisl, vitae pretium nisl felis cursus est. Nullam consectetur quis diam ultricies pretium. Sed congue dictum efficitur.</p>\n\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed sed sem dui. Vestibulum tempor facilisis libero, ac maximus odio gravida vitae. Vivamus auctor risus quis aliquam sagittis. Vivamus sed bibendum libero. Quisque tristique nulla vitae elementum ullamcorper. In rutrum sed sem a molestie. Vivamus auctor, arcu a molestie iaculis, urna felis bibendum augue, sit amet aliquam eros enim a metus. Pellentesque venenatis felis erat, non vulputate elit fringilla at. Quisque eu malesuada est.</p>\n\n<p>Pellentesque vel tortor ut quam fringilla tempus in pretium nunc. Ut quis tempus dolor. Vivamus dui dui, feugiat quis magna vel, tincidunt bibendum nibh. Morbi sodales tempus eros, in rutrum dolor interdum quis. Cras sed metus ut dui congue hendrerit at dapibus tellus. Maecenas nec laoreet dolor, id euismod lorem. Praesent eu mi sed augue lobortis luctus ac ac ex. Aliquam vel mollis ex, at aliquam dolor. Cras eget sapien placerat, faucibus purus in, ullamcorper ligula. Nam dictum, dolor non molestie tincidunt, purus neque aliquet metus, quis condimentum tellus augue vel neque. Curabitur rutrum, nibh sit amet lobortis malesuada, metus risus commodo nisl, at ornare ipsum eros faucibus lorem. Nam congue odio a aliquam maximus.</p>\n\n<p>Donec est massa, ullamcorper in accumsan quis, tempus nec erat. Quisque non ex est. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dictum, tortor eu placerat elementum, neque lorem auctor enim, eu commodo nulla nulla non arcu. Cras a laoreet dolor. Donec sollicitudin arcu quis blandit cursus. Morbi orci mi, cursus id fermentum ut, laoreet eget turpis. In hac habitasse platea dictumst. Fusce magna ante, porta a viverra nec, accumsan et tortor. Donec ullamcorper, tellus quis venenatis posuere, quam enim accumsan quam, eu scelerisque lorem lorem in lacus. Ut pharetra eu lacus quis imperdiet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus vel aliquet leo. Vivamus eu lobortis felis, eget tristique lectus. Aliquam suscipit risus at massa gravida tincidunt.</p>\n\n<p>Vivamus suscipit odio eu lectus consequat porta. Nullam non leo ex. Nunc posuere tincidunt arcu, a volutpat eros. Cras sed velit ornare, dictum sapien a, volutpat leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus elit nulla, efficitur sit amet ante quis, rutrum molestie ante. Curabitur euismod dui eget magna accumsan, quis dignissim quam pretium. Sed sit amet ex id leo condimentum euismod sed at lacus. Pellentesque bibendum massa ex, sit amet luctus orci hendrerit convallis. Praesent elementum sagittis enim, et dapibus dolor.</p>\n\n<p>Morbi tincidunt nisl vitae condimentum cursus. Curabitur et lorem pharetra erat pellentesque varius. Vivamus tortor diam, lobortis nec imperdiet et, convallis eu dolor. In aliquet urna quis neque scelerisque volutpat. Integer venenatis malesuada metus, sit amet tristique odio suscipit id. Donec in turpis eu mauris aliquet finibus. Nulla non ultricies dui. Suspendisse elementum est ac convallis mollis. In condimentum non est id blandit. In hac habitasse platea dictumst. Etiam sit amet dignissim nibh, cursus ullamcorper nisi. Vivamus volutpat posuere mi. Morbi luctus feugiat ante, in condimentum ligula finibus vitae. Donec semper nisi id turpis interdum, at feugiat ligula porttitor. Curabitur sed ante vel ipsum vulputate elementum.</p>\n\n<p>Quisque sollicitudin lacinia mi, at faucibus felis volutpat vitae. Proin laoreet fermentum laoreet. Phasellus aliquet dictum tristique. Morbi viverra, felis et cursus elementum, nisi libero interdum ante, non aliquet orci velit non turpis. Nulla facilisi. Morbi sit amet felis nibh. Cras in magna placerat turpis dapibus aliquet et id ante. Quisque interdum, metus in commodo gravida, enim lorem hendrerit diam, in elementum lacus purus vel erat. Sed feugiat urna metus, eu vestibulum elit ultrices id. Aenean non leo sapien. Duis bibendum, turpis eu scelerisque auctor, purus nulla bibendum justo, vel pretium nunc justo a nunc. Interdum et malesuada fames ac ante ipsum primis in faucibus. Proin nec feugiat ligula. Fusce ut faucibus nisl. Mauris eget mauris eget arcu tincidunt sodales sed in libero. Praesent ex justo, pulvinar sed ullamcorper vitae, condimentum vel lacus.</p>\n');

-- --------------------------------------------------------

--
-- Estrutura da tabela `faq_link`
--

DROP TABLE IF EXISTS `faq_link`;
CREATE TABLE IF NOT EXISTS `faq_link` (
  `faq_link_ID` int(11) NOT NULL AUTO_INCREMENT,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateModified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `isVisible` tinyint(1) NOT NULL DEFAULT '1',
  `questionOrder` tinyint(2) DEFAULT NULL,
  `admin` int(11) NOT NULL,
  PRIMARY KEY (`faq_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `faq_link`
--

INSERT INTO `faq_link` (`faq_link_ID`, `dateCreated`, `dateModified`, `isVisible`, `questionOrder`, `admin`) VALUES
(2, '2018-08-17 20:11:33', NULL, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `faq_question_translation`
--

DROP TABLE IF EXISTS `faq_question_translation`;
CREATE TABLE IF NOT EXISTS `faq_question_translation` (
  `faq_question_translated_ID` int(11) NOT NULL AUTO_INCREMENT,
  `faq_link_ID` int(11) NOT NULL,
  `langCode` varchar(5) NOT NULL,
  `questionTranslated` varchar(200) NOT NULL,
  PRIMARY KEY (`faq_question_translated_ID`),
  KEY `fqt_faq_link_FK` (`faq_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `faq_question_translation`
--

INSERT INTO `faq_question_translation` (`faq_question_translated_ID`, `faq_link_ID`, `langCode`, `questionTranslated`) VALUES
(3, 2, 'pt', 'Pergunta 2'),
(4, 2, 'en', 'Question 2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `long_desc_link`
--

DROP TABLE IF EXISTS `long_desc_link`;
CREATE TABLE IF NOT EXISTS `long_desc_link` (
  `long_desc_link_ID` int(11) NOT NULL AUTO_INCREMENT,
  `property_ID` int(11) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`long_desc_link_ID`),
  KEY `ld_property_ID_FK` (`property_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `long_desc_link`
--

INSERT INTO `long_desc_link` (`long_desc_link_ID`, `property_ID`, `dateCreated`) VALUES
(1, 1, '2018-08-17 20:08:58'),
(2, 2, '2018-08-17 20:09:49'),
(3, 3, '2018-08-20 15:43:44'),
(4, 4, '2018-08-20 15:54:46'),
(5, 5, '2018-09-12 21:41:50'),
(6, 6, '2018-09-24 15:00:23'),
(7, 7, '2018-09-24 15:01:18'),
(8, 8, '2018-09-25 21:02:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `long_desc_translation`
--

DROP TABLE IF EXISTS `long_desc_translation`;
CREATE TABLE IF NOT EXISTS `long_desc_translation` (
  `long_desc_translation_ID` int(11) NOT NULL AUTO_INCREMENT,
  `long_desc_link_ID` int(11) NOT NULL,
  `langCode` varchar(5) NOT NULL,
  `longDescription` text NOT NULL,
  PRIMARY KEY (`long_desc_translation_ID`),
  KEY `long_desc_link_FK` (`long_desc_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `long_desc_translation`
--

INSERT INTO `long_desc_translation` (`long_desc_translation_ID`, `long_desc_link_ID`, `langCode`, `longDescription`) VALUES
(1, 1, 'pt', '<p>Descri&ccedil;&aacute;o longa da vista</p>\n'),
(2, 1, 'en', '<p>Long description of the view</p>\n'),
(3, 2, 'pt', '<p>Descri&ccedil;&atilde;o longa do apartamento.</p>\n'),
(4, 2, 'en', '<p>Long Description of the apartment.</p>\n'),
(5, 3, 'pt', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eleifend vitae ligula eget ultricies. Vestibulum efficitur interdum purus, eu elementum lorem accumsan non. Nulla et semper massa. Vivamus dignissim lectus id magna rhoncus maximus ut vel dui. Ut a elementum leo. In urna urna, tempor non dui non, laoreet tempus elit. Vestibulum lacinia, purus quis elementum viverra, orci quam auctor nisl, vitae pretium nisl felis cursus est. Nullam consectetur quis diam ultricies pretium. Sed congue dictum efficitur.</p>\n\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed sed sem dui. Vestibulum tempor facilisis libero, ac maximus odio gravida vitae. Vivamus auctor risus quis aliquam sagittis. Vivamus sed bibendum libero. Quisque tristique nulla vitae elementum ullamcorper. In rutrum sed sem a molestie. Vivamus auctor, arcu a molestie iaculis, urna felis bibendum augue, sit amet aliquam eros enim a metus. Pellentesque venenatis felis erat, non vulputate elit fringilla at. Quisque eu malesuada est.</p>\n\n<p>Pellentesque vel tortor ut quam fringilla tempus in pretium nunc. Ut quis tempus dolor. Vivamus dui dui, feugiat quis magna vel, tincidunt bibendum nibh. Morbi sodales tempus eros, in rutrum dolor interdum quis. Cras sed metus ut dui congue hendrerit at dapibus tellus. Maecenas nec laoreet dolor, id euismod lorem. Praesent eu mi sed augue lobortis luctus ac ac ex. Aliquam vel mollis ex, at aliquam dolor. Cras eget sapien placerat, faucibus purus in, ullamcorper ligula. Nam dictum, dolor non molestie tincidunt, purus neque aliquet metus, quis condimentum tellus augue vel neque. Curabitur rutrum, nibh sit amet lobortis malesuada, metus risus commodo nisl, at ornare ipsum eros faucibus lorem. Nam congue odio a aliquam maximus.</p>\n'),
(6, 3, 'en', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eleifend vitae ligula eget ultricies. Vestibulum efficitur interdum purus, eu elementum lorem accumsan non. Nulla et semper massa. Vivamus dignissim lectus id magna rhoncus maximus ut vel dui. Ut a elementum leo. In urna urna, tempor non dui non, laoreet tempus elit. Vestibulum lacinia, purus quis elementum viverra, orci quam auctor nisl, vitae pretium nisl felis cursus est. Nullam consectetur quis diam ultricies pretium. Sed congue dictum efficitur.</p>\n\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed sed sem dui. Vestibulum tempor facilisis libero, ac maximus odio gravida vitae. Vivamus auctor risus quis aliquam sagittis. Vivamus sed bibendum libero. Quisque tristique nulla vitae elementum ullamcorper. In rutrum sed sem a molestie. Vivamus auctor, arcu a molestie iaculis, urna felis bibendum augue, sit amet aliquam eros enim a metus. Pellentesque venenatis felis erat, non vulputate elit fringilla at. Quisque eu malesuada est.</p>\n\n<p>Pellentesque vel tortor ut quam fringilla tempus in pretium nunc. Ut quis tempus dolor. Vivamus dui dui, feugiat quis magna vel, tincidunt bibendum nibh. Morbi sodales tempus eros, in rutrum dolor interdum quis. Cras sed metus ut dui congue hendrerit at dapibus tellus. Maecenas nec laoreet dolor, id euismod lorem. Praesent eu mi sed augue lobortis luctus ac ac ex. Aliquam vel mollis ex, at aliquam dolor. Cras eget sapien placerat, faucibus purus in, ullamcorper ligula. Nam dictum, dolor non molestie tincidunt, purus neque aliquet metus, quis condimentum tellus augue vel neque. Curabitur rutrum, nibh sit amet lobortis malesuada, metus risus commodo nisl, at ornare ipsum eros faucibus lorem. Nam congue odio a aliquam maximus.</p>\n'),
(7, 4, 'pt', '<p><strong>PORTUGUES</strong></p>\n\n<p>&nbsp;</p>\n\n<hr />\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris posuere lorem vitae quam tempor, sit amet rhoncus magna tristique. Duis pellentesque hendrerit velit sit amet cursus. Donec pulvinar orci sed augue dictum tempus. Sed non erat non eros iaculis iaculis a et augue. Nullam vitae ligula ut massa rutrum ultricies. Pellentesque arcu massa, sodales porta placerat id, commodo ut velit. Sed eget dui mauris. Nam pulvinar eleifend magna, id tempor ipsum mollis ac. In velit tellus, tempus maximus tellus vel, tempus ullamcorper ligula. Mauris tincidunt, dui sit amet porta placerat, leo tellus fringilla sapien, nec fringilla felis ipsum hendrerit nisl. Pellentesque lacinia sapien nec risus varius varius.</p>\n\n<p>In vel orci sit amet massa mollis rutrum ut in lorem. Aliquam erat volutpat. Cras eleifend nunc pharetra, fringilla neque ac, mattis augue. Sed facilisis augue sapien, vel feugiat dolor fringilla ut. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce ultricies commodo justo. In hac habitasse platea dictumst. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>\n\n<p>Duis interdum sodales purus non pellentesque. Sed laoreet est eu tellus imperdiet, in pulvinar diam volutpat. Nulla id justo id eros ultricies condimentum. Vivamus dignissim aliquet purus a varius. Aenean porttitor nisl id est aliquam volutpat. Vivamus pellentesque neque sem. Nam ut ante vehicula, ultrices dolor eu, vestibulum ex. Nunc pretium nisi eu magna finibus, non elementum eros eleifend.</p>\n\n<p>Nunc tempus luctus imperdiet. Fusce posuere at metus sed feugiat. Quisque tempor augue a velit feugiat, quis maximus arcu pulvinar. Donec nibh nulla, tincidunt id lacus nec, convallis finibus mauris. Nunc ac lacus ante. Proin viverra viverra tellus sit amet vestibulum. Aenean at ultrices augue, eget vehicula dui. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras malesuada nulla ullamcorper, consectetur mauris a, posuere enim. Mauris neque lectus, cursus ut dolor vitae, vulputate accumsan sapien. Nunc ut sem quis magna molestie pretium.</p>\n\n<p>Donec accumsan nec urna pelle</p>\n'),
(8, 4, 'en', '<p><strong>ENGLISH</strong></p>\n\n<hr />\n<p>&nbsp;</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris posuere lorem vitae quam tempor, sit amet rhoncus magna tristique. Duis pellentesque hendrerit velit sit amet cursus. Donec pulvinar orci sed augue dictum tempus. Sed non erat non eros iaculis iaculis a et augue. Nullam vitae ligula ut massa rutrum ultricies. Pellentesque arcu massa, sodales porta placerat id, commodo ut velit. Sed eget dui mauris. Nam pulvinar eleifend magna, id tempor ipsum mollis ac. In velit tellus, tempus maximus tellus vel, tempus ullamcorper ligula. Mauris tincidunt, dui sit amet porta placerat, leo tellus fringilla sapien, nec fringilla felis ipsum hendrerit nisl. Pellentesque lacinia sapien nec risus varius varius.</p>\n\n<p>In vel orci sit amet massa mollis rutrum ut in lorem. Aliquam erat volutpat. Cras eleifend nunc pharetra, fringilla neque ac, mattis augue. Sed facilisis augue sapien, vel feugiat dolor fringilla ut. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce ultricies commodo justo. In hac habitasse platea dictumst. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>\n\n<p>Duis interdum sodales purus non pellentesque. Sed laoreet est eu tellus imperdiet, in pulvinar diam volutpat. Nulla id justo id eros ultricies condimentum. Vivamus dignissim aliquet purus a varius. Aenean porttitor nisl id est aliquam volutpat. Vivamus pellentesque neque sem. Nam ut ante vehicula, ultrices dolor eu, vestibulum ex. Nunc pretium nisi eu magna finibus, non elementum eros eleifend.</p>\n\n<p>Nunc tempus luctus imperdiet. Fusce posuere at metus sed feugiat. Quisque tempor augue a velit feugiat, quis maximus arcu pulvinar. Donec nibh nulla, tincidunt id lacus nec, convallis finibus mauris. Nunc ac lacus ante. Proin viverra viverra tellus sit amet vestibulum. Aenean at ultrices augue, eget vehicula dui. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras malesuada nulla ullamcorper, consectetur mauris a, posuere enim. Mauris neque lectus, cursus ut dolor vitae, vulputate accumsan sapien. Nunc ut sem quis magna molestie pretium.</p>\n\n<p>Donec accumsan nec urna pelle</p>\n'),
(9, 5, 'pt', '<p>8WAWP6WPf</p>\n'),
(10, 5, 'en', '<p>RnTK7FGSQ</p>\n'),
(11, 6, 'pt', '<p>WxAyUvn2Y</p>\n'),
(12, 6, 'en', '<p>ATapCUH9K</p>\n'),
(13, 7, 'pt', '<p>aRTkolV89</p>\n'),
(14, 7, 'en', '<p>nsuXfH5Jc</p>\n'),
(15, 8, 'pt', '<p>7BxJe50TA</p>\n'),
(16, 8, 'en', '<p>DFOKESNnB</p>\n');

-- --------------------------------------------------------

--
-- Estrutura da tabela `poi_gallery`
--

DROP TABLE IF EXISTS `poi_gallery`;
CREATE TABLE IF NOT EXISTS `poi_gallery` (
  `poi_gallery_ID` int(11) NOT NULL AUTO_INCREMENT,
  `poi_link_ID` int(11) NOT NULL,
  `thumbnailURL` varchar(500) NOT NULL,
  `fullsizeURL` varchar(500) NOT NULL,
  `photoOrder` int(11) DEFAULT NULL,
  `isPrimary` int(11) DEFAULT NULL,
  PRIMARY KEY (`poi_gallery_ID`),
  KEY `pg_poi_link_FK` (`poi_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `poi_gallery`
--

INSERT INTO `poi_gallery` (`poi_gallery_ID`, `poi_link_ID`, `thumbnailURL`, `fullsizeURL`, `photoOrder`, `isPrimary`) VALUES
(12, 1, '0101.jpeg', '0101.jpeg', NULL, NULL),
(13, 1, '000000111.jpeg', '000000111.jpeg', NULL, NULL),
(14, 1, '12211.jpeg', '12211.jpeg', NULL, NULL),
(15, 1, 'P6170651.jpeg', 'P6170651.jpeg', NULL, NULL),
(16, 1, 'P6170653.jpeg', 'P6170653.jpeg', NULL, NULL),
(17, 1, 'P6170656.jpeg', 'P6170656.jpeg', NULL, NULL),
(18, 1, 'P6170657.jpeg', 'P6170657.jpeg', NULL, NULL),
(19, 1, 'P6170662.jpeg', 'P6170662.jpeg', NULL, NULL),
(20, 1, 'P6170664.jpeg', 'P6170664.jpeg', NULL, NULL),
(21, 1, 'P6170665.jpeg', 'P6170665.jpeg', NULL, NULL),
(22, 1, 'P6170667.jpeg', 'P6170667.jpeg', NULL, NULL),
(23, 1, 'P6170671.jpeg', 'P6170671.jpeg', NULL, NULL),
(24, 1, 'P6170672.jpeg', 'P6170672.jpeg', NULL, NULL),
(25, 1, 'P6170674.jpeg', 'P6170674.jpeg', NULL, NULL),
(26, 1, 'P6170675.jpeg', 'P6170675.jpeg', NULL, NULL),
(27, 1, 'P6170677.jpeg', 'P6170677.jpeg', NULL, NULL),
(28, 1, 'P6180693.jpeg', 'P6180693.jpeg', NULL, NULL),
(29, 1, 'P6180717.jpeg', 'P6180717.jpeg', NULL, NULL),
(30, 1, 'P6180727.jpeg', 'P6180727.jpeg', NULL, NULL),
(31, 1, 'P6191068.jpeg', 'P6191068.jpeg', NULL, NULL),
(48, 3, 'DSC05277.jpeg', 'DSC05277.jpeg', NULL, NULL),
(49, 3, 'DSC07710.jpeg', 'DSC07710.jpeg', NULL, NULL),
(50, 3, 'DSC07711.jpeg', 'DSC07711.jpeg', NULL, NULL),
(51, 3, 'DSC08090.jpeg', 'DSC08090.jpeg', NULL, NULL),
(52, 3, 'DSC08091.jpeg', 'DSC08091.jpeg', NULL, NULL),
(53, 3, 'DSC08219.jpeg', 'DSC08219.jpeg', NULL, NULL),
(54, 3, 'DSC08254.jpeg', 'DSC08254.jpeg', NULL, NULL),
(55, 3, 'Prainha11-12-2014-Mica-Andreia-039.jpeg', 'Prainha11-12-2014-Mica-Andreia-039.jpeg', NULL, NULL),
(56, 3, 'Prainha11-12-2014-Mica-Andreia-041.jpeg', 'Prainha11-12-2014-Mica-Andreia-041.jpeg', NULL, NULL),
(57, 3, 'SDC17227.jpeg', 'SDC17227.jpeg', NULL, NULL),
(58, 3, 'SDC17239.jpeg', 'SDC17239.jpeg', NULL, NULL),
(59, 6, 'P6170664.jpeg', 'P6170664.jpeg', NULL, NULL),
(60, 6, 'P6170665.jpeg', 'P6170665.jpeg', NULL, NULL),
(61, 6, 'P6170675.jpeg', 'P6170675.jpeg', NULL, NULL),
(62, 6, 'P6180727.jpeg', 'P6180727.jpeg', NULL, NULL),
(63, 6, 'P6180734.jpeg', 'P6180734.jpeg', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `poi_link`
--

DROP TABLE IF EXISTS `poi_link`;
CREATE TABLE IF NOT EXISTS `poi_link` (
  `poi_link_ID` int(11) NOT NULL AUTO_INCREMENT,
  `videoURL` varchar(500) DEFAULT NULL,
  `isPopular` tinyint(1) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`poi_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `poi_link`
--

INSERT INTO `poi_link` (`poi_link_ID`, `videoURL`, `isPopular`, `dateCreated`) VALUES
(1, '', 1, '2018-08-17 19:56:55'),
(3, 'https://www.youtube.com/embed/8gi-chAjHPU', 1, '2018-08-19 22:15:09'),
(4, '', 0, '2018-09-01 22:54:18'),
(5, '', 1, '2018-09-01 23:00:04'),
(6, '', 1, '2018-09-12 21:25:25');

-- --------------------------------------------------------

--
-- Estrutura da tabela `poi_translation`
--

DROP TABLE IF EXISTS `poi_translation`;
CREATE TABLE IF NOT EXISTS `poi_translation` (
  `poi_translation_ID` int(11) NOT NULL AUTO_INCREMENT,
  `poi_link_ID` int(11) NOT NULL,
  `langCode` varchar(5) NOT NULL,
  `nameTranslated` varchar(200) NOT NULL,
  `descriptionTranslated` text NOT NULL,
  PRIMARY KEY (`poi_translation_ID`),
  KEY `poi_translation_FK` (`poi_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `poi_translation`
--

INSERT INTO `poi_translation` (`poi_translation_ID`, `poi_link_ID`, `langCode`, `nameTranslated`, `descriptionTranslated`) VALUES
(1, 1, 'pt', 'Praia da Rocha', '<p>Descri&ccedil;&atilde;o sobre a Praia da Rocha</p>\n'),
(2, 1, 'en', 'Rocha Beach', '<p>Rocha beach description</p>\n'),
(5, 3, 'pt', 'Praia de Alvor', '<p>YvEY9PrXk</p>\n'),
(6, 3, 'en', 'Alvor Beach', '<p>NjThTi2rE</p>\n'),
(7, 4, 'pt', '', ''),
(8, 4, 'en', '', ''),
(9, 5, 'pt', 'Casa Inglesa', '<p>Casa Inglesa PT&nbsp;</p>\n'),
(10, 5, 'en', 'English house', '<p>English house EN</p>\n'),
(11, 6, 'pt', 'Marina de Vilamoura', '<p>Isto e a marina de vilamour</p>\n'),
(12, 6, 'en', 'Vilamoura Dock', '<p>this is vilamoura dock area</p>\n');

-- --------------------------------------------------------

--
-- Estrutura da tabela `property`
--

DROP TABLE IF EXISTS `property`;
CREATE TABLE IF NOT EXISTS `property` (
  `property_ID` int(11) NOT NULL AUTO_INCREMENT,
  `isForSale` tinyint(1) NOT NULL,
  `propertyType` tinyint(4) NOT NULL,
  `viewType` tinyint(4) NOT NULL,
  `hasPoolAccess` tinyint(4) NOT NULL,
  `isVisible` tinyint(4) NOT NULL,
  `roomAmmount` smallint(6) NOT NULL,
  `maxAllowedGuests` smallint(6) NOT NULL,
  `beachDistance` int(11) DEFAULT NULL,
  `publicID` int(7) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateModified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`property_ID`),
  UNIQUE KEY `publicID` (`publicID`),
  KEY `publicID_2` (`publicID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `property`
--

INSERT INTO `property` (`property_ID`, `isForSale`, `propertyType`, `viewType`, `hasPoolAccess`, `isVisible`, `roomAmmount`, `maxAllowedGuests`, `beachDistance`, `publicID`, `dateCreated`, `dateModified`) VALUES
(1, 0, 2, 1, 1, 1, 5, 2, 500, 8500479, '2018-08-17 20:08:58', '2018-08-21 12:42:44'),
(2, 0, 2, 1, 1, 1, 3, 14, 500, 8500112, '2018-08-17 20:09:49', '2018-08-21 12:41:29'),
(3, 1, 2, 1, 1, 1, 5, 14, 800, 8501989, '2018-08-20 15:43:44', '2018-08-21 12:41:32'),
(4, 1, 2, 2, 1, 1, 8, 14, 1500, 8501404, '2018-08-20 15:54:46', '2018-08-21 12:39:20'),
(5, 0, 1, 1, 0, 1, 2, 4, 15054, 7000343, '2018-09-12 21:41:50', '2018-09-27 15:46:19'),
(6, 0, 1, 1, 1, 1, 1, 2, 2808, 8501501, '2018-09-24 15:00:23', '2018-09-27 15:46:34'),
(7, 0, 2, 2, 1, 1, 3, 5, 2614, 8500658, '2018-09-24 15:01:18', '2018-09-27 15:46:46'),
(8, 0, 1, 1, 0, 1, 2, 4, 624, 8501836, '2018-09-25 21:02:08', '2018-09-27 15:46:56');

-- --------------------------------------------------------

--
-- Estrutura da tabela `property_city_poi`
--

DROP TABLE IF EXISTS `property_city_poi`;
CREATE TABLE IF NOT EXISTS `property_city_poi` (
  `property_city_poi_ID` int(11) NOT NULL AUTO_INCREMENT,
  `property_ID` int(11) NOT NULL,
  `city_poi_link_ID` int(11) NOT NULL,
  PRIMARY KEY (`property_city_poi_ID`),
  KEY `pcp_city_poi_link_FK` (`city_poi_link_ID`),
  KEY `pcp_property_FK` (`property_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `property_city_poi`
--

INSERT INTO `property_city_poi` (`property_city_poi_ID`, `property_ID`, `city_poi_link_ID`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 3),
(4, 4, 3),
(5, 5, 5),
(6, 6, 3),
(7, 7, 5),
(8, 8, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `property_common_service`
--

DROP TABLE IF EXISTS `property_common_service`;
CREATE TABLE IF NOT EXISTS `property_common_service` (
  `property_common_service_ID` int(11) NOT NULL AUTO_INCREMENT,
  `property_ID` int(11) NOT NULL,
  `common_service_link_ID` int(11) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateModified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`property_common_service_ID`),
  KEY `ps_property_FK` (`property_ID`),
  KEY `ps_service_link_FK` (`common_service_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `property_common_service`
--

INSERT INTO `property_common_service` (`property_common_service_ID`, `property_ID`, `common_service_link_ID`, `dateCreated`, `dateModified`) VALUES
(8, 4, 2, '2018-08-20 15:54:46', NULL),
(9, 1, 1, '2018-08-20 16:47:23', NULL),
(10, 1, 2, '2018-08-20 16:47:23', NULL),
(11, 1, 3, '2018-08-20 16:47:23', NULL),
(12, 1, 4, '2018-08-20 16:47:23', NULL),
(13, 1, 5, '2018-08-20 16:47:23', NULL),
(14, 1, 6, '2018-08-20 16:47:23', NULL),
(15, 2, 1, '2018-08-20 16:47:36', NULL),
(16, 2, 2, '2018-08-20 16:47:36', NULL),
(17, 2, 3, '2018-08-20 16:47:36', NULL),
(18, 2, 4, '2018-08-20 16:47:36', NULL),
(19, 2, 5, '2018-08-20 16:47:36', NULL),
(20, 3, 1, '2018-08-20 18:23:12', NULL),
(21, 3, 2, '2018-08-20 18:23:12', NULL),
(22, 3, 3, '2018-08-20 18:23:12', NULL),
(23, 5, 2, '2018-09-12 21:41:50', NULL),
(24, 6, 1, '2018-09-24 15:00:23', NULL),
(25, 6, 2, '2018-09-24 15:00:23', NULL),
(26, 6, 3, '2018-09-24 15:00:23', NULL),
(27, 6, 4, '2018-09-24 15:00:23', NULL),
(28, 6, 6, '2018-09-24 15:00:23', NULL),
(29, 7, 1, '2018-09-24 15:01:18', NULL),
(30, 7, 2, '2018-09-24 15:01:18', NULL),
(31, 7, 4, '2018-09-24 15:01:18', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `property_gallery`
--

DROP TABLE IF EXISTS `property_gallery`;
CREATE TABLE IF NOT EXISTS `property_gallery` (
  `property_gallery_ID` int(11) NOT NULL AUTO_INCREMENT,
  `property_ID` int(11) NOT NULL,
  `thumbnailURL` varchar(500) NOT NULL,
  `fullsizeURL` varchar(500) NOT NULL,
  `photoOrder` tinyint(2) DEFAULT NULL,
  `isPrimary` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`property_gallery_ID`),
  KEY `pg_property_FK` (`property_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `property_gallery`
--

INSERT INTO `property_gallery` (`property_gallery_ID`, `property_ID`, `thumbnailURL`, `fullsizeURL`, `photoOrder`, `isPrimary`) VALUES
(65, 1, 'RT14e11.jpeg', 'RT14e11.jpeg', NULL, NULL),
(66, 1, 'RT14e12.jpeg', 'RT14e12.jpeg', NULL, NULL),
(67, 1, 'RT14e13.jpeg', 'RT14e13.jpeg', NULL, NULL),
(68, 1, 'RT14e14.jpeg', 'RT14e14.jpeg', NULL, NULL),
(69, 1, 'RT14e15.jpeg', 'RT14e15.jpeg', NULL, NULL),
(70, 1, 'RT14e16.jpeg', 'RT14e16.jpeg', NULL, NULL),
(71, 2, '14-c-1.jpeg', '14-c-1.jpeg', NULL, NULL),
(72, 1, 'RT14e17.jpeg', 'RT14e17.jpeg', NULL, NULL),
(73, 2, '14-c-2.jpeg', '14-c-2.jpeg', NULL, NULL),
(74, 2, '14-c-4.jpeg', '14-c-4.jpeg', NULL, NULL),
(75, 2, '14-c-5.jpeg', '14-c-5.jpeg', NULL, NULL),
(76, 2, '14-c-6.jpeg', '14-c-6.jpeg', NULL, NULL),
(77, 2, '14-c-7.jpeg', '14-c-7.jpeg', NULL, NULL),
(78, 2, '14-c-b-vista.jpeg', '14-c-b-vista.jpeg', NULL, NULL),
(79, 3, 'IMG_6786.jpeg', 'IMG_6786.jpeg', NULL, NULL),
(80, 3, 'IMG_6791.jpeg', 'IMG_6791.jpeg', NULL, NULL),
(81, 3, 'IMG_6797.jpeg', 'IMG_6797.jpeg', NULL, NULL),
(82, 3, 'IMG_6823.jpeg', 'IMG_6823.jpeg', NULL, NULL),
(83, 3, 'IMG_6824.jpeg', 'IMG_6824.jpeg', NULL, NULL),
(84, 3, 'IMG_6832.jpeg', 'IMG_6832.jpeg', NULL, NULL),
(85, 3, 'IMG_6842.jpeg', 'IMG_6842.jpeg', NULL, NULL),
(86, 3, 'IMG_6845.jpeg', 'IMG_6845.jpeg', NULL, NULL),
(87, 3, 'IMG_6848-HDR.jpeg', 'IMG_6848-HDR.jpeg', NULL, NULL),
(88, 3, 'IMG_6853.jpeg', 'IMG_6853.jpeg', NULL, NULL),
(89, 4, 'P2020651.jpeg', 'P2020651.jpeg', NULL, NULL),
(90, 4, 'P2020667.jpeg', 'P2020667.jpeg', NULL, NULL),
(91, 4, 'P2020711.jpeg', 'P2020711.jpeg', NULL, NULL),
(92, 4, 'P2020713.jpeg', 'P2020713.jpeg', NULL, NULL),
(93, 4, 'P2020742.jpeg', 'P2020742.jpeg', NULL, NULL),
(94, 5, 'RT14a1.jpeg', 'RT14a1.jpeg', NULL, NULL),
(95, 5, 'RT14a2.jpeg', 'RT14a2.jpeg', NULL, NULL),
(96, 5, 'RT14a3.jpeg', 'RT14a3.jpeg', NULL, NULL),
(97, 5, 'RT14a4.jpeg', 'RT14a4.jpeg', NULL, NULL),
(98, 5, 'RT14a5.jpeg', 'RT14a5.jpeg', NULL, NULL),
(99, 5, 'RT14a6.jpeg', 'RT14a6.jpeg', NULL, NULL),
(100, 5, 'RT14a7.jpeg', 'RT14a7.jpeg', NULL, NULL),
(101, 5, 'RT14a8.jpeg', 'RT14a8.jpeg', NULL, NULL),
(102, 6, 'RT14a7.jpeg', 'RT14a7.jpeg', NULL, NULL),
(103, 7, 'RT14a1.jpeg', 'RT14a1.jpeg', NULL, NULL),
(104, 8, 'RT27.jpeg', 'RT27.jpeg', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `property_price`
--

DROP TABLE IF EXISTS `property_price`;
CREATE TABLE IF NOT EXISTS `property_price` (
  `property_price_ID` int(11) NOT NULL AUTO_INCREMENT,
  `property_ID` int(11) NOT NULL,
  `cat1` int(11) NOT NULL,
  `cat2` smallint(6) NOT NULL,
  `cat3` smallint(6) NOT NULL,
  `cat4` smallint(6) NOT NULL,
  `cat5` smallint(6) NOT NULL,
  `cat6` smallint(6) NOT NULL,
  `cat7` smallint(6) NOT NULL,
  `cat8` smallint(6) NOT NULL,
  `cat9` smallint(6) NOT NULL,
  `cat10` smallint(6) NOT NULL,
  `minPrice` int(11) NOT NULL,
  `maxPrice` int(11) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateModified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`property_price_ID`),
  KEY `pp_property_FK` (`property_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `property_price`
--

INSERT INTO `property_price` (`property_price_ID`, `property_ID`, `cat1`, `cat2`, `cat3`, `cat4`, `cat5`, `cat6`, `cat7`, `cat8`, `cat9`, `cat10`, `minPrice`, `maxPrice`, `dateCreated`, `dateModified`) VALUES
(1, 1, 34, 2, 3, 4, 5, 6, 450, 645, 9, 10, 2, 645, '2018-08-17 20:08:58', '2018-08-24 19:47:17'),
(2, 2, 9605, 6089, 1612, 5504, 5269, 3942, 7266, 3674, 2865, 3888, 1612, 9605, '2018-08-17 20:09:49', '2018-08-21 10:32:58'),
(3, 4, 130000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-08-20 15:54:46', '2018-08-21 11:24:44'),
(4, 3, 124000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-08-20 15:56:50', '2018-08-20 15:57:10'),
(5, 5, 751, 2334, 3907, 638, 8002, 8540, 7588, 8718, 7134, 7400, 638, 8718, '2018-09-12 21:41:50', NULL),
(6, 6, 7981, 4586, 7140, 3352, 5304, 9133, 2650, 8212, 190, 9259, 190, 9259, '2018-09-24 15:00:23', NULL),
(7, 7, 3493, 9305, 5836, 4710, 2392, 6345, 9243, 1442, 3156, 176, 176, 9305, '2018-09-24 15:01:18', NULL),
(8, 8, 2683, 5503, 1822, 2117, 774, 7714, 3997, 4145, 6089, 4589, 774, 7714, '2018-09-25 21:02:08', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `property_unique_service`
--

DROP TABLE IF EXISTS `property_unique_service`;
CREATE TABLE IF NOT EXISTS `property_unique_service` (
  `property_unique_service_ID` int(11) NOT NULL AUTO_INCREMENT,
  `property_ID` int(11) NOT NULL,
  `unique_service_link_ID` int(11) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateModified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`property_unique_service_ID`),
  KEY `pus_property_FK` (`property_ID`),
  KEY `pus_unique_service_link_FK` (`unique_service_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `property_unique_service`
--

INSERT INTO `property_unique_service` (`property_unique_service_ID`, `property_ID`, `unique_service_link_ID`, `dateCreated`, `dateModified`) VALUES
(6, 4, 2, '2018-08-20 15:54:46', NULL),
(7, 1, 1, '2018-08-20 16:47:23', NULL),
(8, 1, 2, '2018-08-20 16:47:23', NULL),
(9, 2, 2, '2018-08-20 16:47:36', NULL),
(10, 3, 1, '2018-08-20 18:23:12', NULL),
(11, 3, 2, '2018-08-20 18:23:12', NULL),
(12, 5, 2, '2018-09-12 21:41:50', NULL),
(13, 6, 1, '2018-09-24 15:00:23', NULL),
(14, 6, 2, '2018-09-24 15:00:23', NULL),
(15, 7, 2, '2018-09-24 15:01:18', NULL),
(19, 8, 3, '2018-09-25 21:13:03', NULL),
(20, 8, 4, '2018-09-25 21:13:03', NULL),
(21, 8, 5, '2018-09-25 21:13:03', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `short_desc_link`
--

DROP TABLE IF EXISTS `short_desc_link`;
CREATE TABLE IF NOT EXISTS `short_desc_link` (
  `short_desc_link_ID` int(11) NOT NULL AUTO_INCREMENT,
  `property_ID` int(11) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`short_desc_link_ID`),
  KEY `sd_property_ID_FK` (`property_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `short_desc_link`
--

INSERT INTO `short_desc_link` (`short_desc_link_ID`, `property_ID`, `dateCreated`) VALUES
(1, 1, '2018-08-17 20:08:58'),
(2, 2, '2018-08-17 20:09:49'),
(3, 3, '2018-08-20 15:43:44'),
(4, 4, '2018-08-20 15:54:46'),
(5, 5, '2018-09-12 21:41:50'),
(6, 6, '2018-09-24 15:00:23'),
(7, 7, '2018-09-24 15:01:18'),
(8, 8, '2018-09-25 21:02:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `short_desc_translation`
--

DROP TABLE IF EXISTS `short_desc_translation`;
CREATE TABLE IF NOT EXISTS `short_desc_translation` (
  `short_desc_translation_ID` int(11) NOT NULL AUTO_INCREMENT,
  `short_desc_link_ID` int(11) NOT NULL,
  `langCode` varchar(5) NOT NULL,
  `shortDescription` varchar(200) NOT NULL,
  PRIMARY KEY (`short_desc_translation_ID`),
  KEY `short_desc_link_FK` (`short_desc_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `short_desc_translation`
--

INSERT INTO `short_desc_translation` (`short_desc_translation_ID`, `short_desc_link_ID`, `langCode`, `shortDescription`) VALUES
(1, 1, 'pt', 'DescriÃ§Ã£o bem curta da vista bonita'),
(2, 1, 'en', 'Really short description of the view'),
(3, 2, 'pt', 'Apartamento fantÃ¡stico com uma vista impecÃ¡vel.'),
(4, 2, 'en', 'Apartment with an amazing view.'),
(5, 3, 'pt', 'Uma vila muito bonita e compacta'),
(6, 3, 'en', 'Very pretty villa, small and compact'),
(7, 4, 'pt', 'Muito moderno e robusto'),
(8, 4, 'en', 'Very modern and robust'),
(9, 5, 'pt', 'uehDwIZ5M'),
(10, 5, 'en', 'smQ8MIZFy'),
(11, 6, 'pt', 'plZcRJNf4'),
(12, 6, 'en', 'DEn7OyNa4'),
(13, 7, 'pt', 'A2RX2GDxF'),
(14, 7, 'en', '4zVkmxHc7'),
(15, 8, 'pt', 'w7gzCo6Pn'),
(16, 8, 'en', 'OCYZTmbqM');

-- --------------------------------------------------------

--
-- Estrutura da tabela `title_link`
--

DROP TABLE IF EXISTS `title_link`;
CREATE TABLE IF NOT EXISTS `title_link` (
  `title_link_ID` int(11) NOT NULL AUTO_INCREMENT,
  `property_ID` int(1) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`title_link_ID`),
  KEY `tl_property_ID_FK` (`property_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `title_link`
--

INSERT INTO `title_link` (`title_link_ID`, `property_ID`, `dateCreated`) VALUES
(1, 1, '2018-08-17 20:08:58'),
(2, 2, '2018-08-17 20:09:49'),
(3, 3, '2018-08-20 15:43:44'),
(4, 4, '2018-08-20 15:54:46'),
(5, 5, '2018-09-12 21:41:50'),
(6, 6, '2018-09-24 15:00:23'),
(7, 7, '2018-09-24 15:01:18'),
(8, 8, '2018-09-25 21:02:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `title_translation`
--

DROP TABLE IF EXISTS `title_translation`;
CREATE TABLE IF NOT EXISTS `title_translation` (
  `title_translation_ID` int(11) NOT NULL AUTO_INCREMENT,
  `title_link_ID` int(11) NOT NULL,
  `langCode` varchar(5) NOT NULL,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`title_translation_ID`),
  KEY `title_link_FK` (`title_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `title_translation`
--

INSERT INTO `title_translation` (`title_translation_ID`, `title_link_ID`, `langCode`, `title`) VALUES
(1, 1, 'pt', 'Torre Rocha 14E'),
(2, 1, 'en', 'Rocha Tower 14E'),
(3, 2, 'pt', 'Torre Rocha 14C'),
(4, 2, 'en', 'Rocha Tower 14C'),
(5, 3, 'pt', 'Villa Jac'),
(6, 3, 'en', 'Jac Villa'),
(7, 4, 'pt', 'Vila do Patamar'),
(8, 4, 'en', 'Patamar Villa'),
(9, 5, 'pt', 'UhIceL7nB'),
(10, 5, 'en', 'attDT0Xxs'),
(11, 6, 'pt', 'q74RlhLe8'),
(12, 6, 'en', '06jT6vVB5'),
(13, 7, 'pt', '61MziGqhV'),
(14, 7, 'en', 'isf6Ng5v5'),
(15, 8, 'pt', 'ubpVBVYLj'),
(16, 8, 'en', 'W8wgXzp8Q');

-- --------------------------------------------------------

--
-- Estrutura da tabela `unique_service_link`
--

DROP TABLE IF EXISTS `unique_service_link`;
CREATE TABLE IF NOT EXISTS `unique_service_link` (
  `unique_service_link_ID` int(11) NOT NULL AUTO_INCREMENT,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`unique_service_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `unique_service_link`
--

INSERT INTO `unique_service_link` (`unique_service_link_ID`, `dateCreated`) VALUES
(1, '2018-08-17 20:00:04'),
(2, '2018-08-17 20:00:04'),
(3, '2018-09-25 21:01:05'),
(4, '2018-09-25 21:01:30'),
(5, '2018-09-25 21:01:41');

-- --------------------------------------------------------

--
-- Estrutura da tabela `unique_service_translation`
--

DROP TABLE IF EXISTS `unique_service_translation`;
CREATE TABLE IF NOT EXISTS `unique_service_translation` (
  `unique_service_translation_ID` int(11) NOT NULL AUTO_INCREMENT,
  `unique_service_link_ID` int(11) NOT NULL,
  `langCode` varchar(5) NOT NULL,
  `uniqueServiceTranslated` varchar(200) NOT NULL,
  PRIMARY KEY (`unique_service_translation_ID`),
  KEY `unique_service_link_FK` (`unique_service_link_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `unique_service_translation`
--

INSERT INTO `unique_service_translation` (`unique_service_translation_ID`, `unique_service_link_ID`, `langCode`, `uniqueServiceTranslated`) VALUES
(1, 1, 'pt', 'Piscina Privada'),
(2, 1, 'en', 'Private Pool'),
(3, 2, 'pt', 'Garagem Privada'),
(4, 2, 'en', 'Private Parking'),
(5, 3, 'pt', 'Grelhador'),
(6, 3, 'en', 'Grill'),
(7, 4, 'pt', 'Jardim'),
(8, 4, 'en', 'Garden'),
(9, 5, 'pt', 'TerraÃ§o Privado'),
(10, 5, 'en', 'Private Terrace');

-- --------------------------------------------------------

--
-- Estrutura da tabela `webpage`
--

DROP TABLE IF EXISTS `webpage`;
CREATE TABLE IF NOT EXISTS `webpage` (
  `webpage_ID` int(11) NOT NULL AUTO_INCREMENT,
  `mainImageURL` varchar(500) NOT NULL,
  PRIMARY KEY (`webpage_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `webpage`
--

INSERT INTO `webpage` (`webpage_ID`, `mainImageURL`) VALUES
(8, '20180730_160507_HDR.jpeg');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `activity_gallery`
--
ALTER TABLE `activity_gallery`
  ADD CONSTRAINT `ag_activity_link_FK` FOREIGN KEY (`activity_link_ID`) REFERENCES `activity_link` (`activity_link_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `activity_link`
--
ALTER TABLE `activity_link`
  ADD CONSTRAINT `city_link_ID_FK` FOREIGN KEY (`city_link_ID`) REFERENCES `city_link` (`city_link_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `activity_translation`
--
ALTER TABLE `activity_translation`
  ADD CONSTRAINT `activity_link_FK` FOREIGN KEY (`activity_link_ID`) REFERENCES `activity_link` (`activity_link_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `admin_activity`
--
ALTER TABLE `admin_activity`
  ADD CONSTRAINT `admin_ID` FOREIGN KEY (`admin_ID`) REFERENCES `admin` (`admin_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `city_gallery`
--
ALTER TABLE `city_gallery`
  ADD CONSTRAINT `cg_city_link_FK` FOREIGN KEY (`city_link_ID`) REFERENCES `city_link` (`city_link_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `city_poi_link`
--
ALTER TABLE `city_poi_link`
  ADD CONSTRAINT `city_link_FK` FOREIGN KEY (`city_link_ID`) REFERENCES `city_link` (`city_link_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `poi_link_FK` FOREIGN KEY (`poi_link_ID`) REFERENCES `poi_link` (`poi_link_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `city_translation`
--
ALTER TABLE `city_translation`
  ADD CONSTRAINT `city_translation_FK` FOREIGN KEY (`city_link_ID`) REFERENCES `city_link` (`city_link_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `common_service_translation`
--
ALTER TABLE `common_service_translation`
  ADD CONSTRAINT `service_link_FK` FOREIGN KEY (`common_service_link_ID`) REFERENCES `common_service_link` (`common_service_link_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `faq_answer_translation`
--
ALTER TABLE `faq_answer_translation`
  ADD CONSTRAINT `fat_faq_link_FK` FOREIGN KEY (`faq_link_ID`) REFERENCES `faq_link` (`faq_link_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `faq_question_translation`
--
ALTER TABLE `faq_question_translation`
  ADD CONSTRAINT `fqt_faq_link_FK` FOREIGN KEY (`faq_link_ID`) REFERENCES `faq_link` (`faq_link_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `long_desc_link`
--
ALTER TABLE `long_desc_link`
  ADD CONSTRAINT `ld_property_ID_FK` FOREIGN KEY (`property_ID`) REFERENCES `property` (`property_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `long_desc_translation`
--
ALTER TABLE `long_desc_translation`
  ADD CONSTRAINT `long_desc_link_FK` FOREIGN KEY (`long_desc_link_ID`) REFERENCES `long_desc_link` (`long_desc_link_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `poi_gallery`
--
ALTER TABLE `poi_gallery`
  ADD CONSTRAINT `pg_poi_link_FK` FOREIGN KEY (`poi_link_ID`) REFERENCES `poi_link` (`poi_link_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `poi_translation`
--
ALTER TABLE `poi_translation`
  ADD CONSTRAINT `poi_translation_FK` FOREIGN KEY (`poi_link_ID`) REFERENCES `poi_link` (`poi_link_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `property_city_poi`
--
ALTER TABLE `property_city_poi`
  ADD CONSTRAINT `pcp_city_poi_link_FK` FOREIGN KEY (`city_poi_link_ID`) REFERENCES `city_poi_link` (`city_poi_link_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pcp_property_FK` FOREIGN KEY (`property_ID`) REFERENCES `property` (`property_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `property_common_service`
--
ALTER TABLE `property_common_service`
  ADD CONSTRAINT `ps_property_FK` FOREIGN KEY (`property_ID`) REFERENCES `property` (`property_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ps_service_link_FK` FOREIGN KEY (`common_service_link_ID`) REFERENCES `common_service_link` (`common_service_link_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `property_gallery`
--
ALTER TABLE `property_gallery`
  ADD CONSTRAINT `pg_property_FK` FOREIGN KEY (`property_ID`) REFERENCES `property` (`property_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `property_price`
--
ALTER TABLE `property_price`
  ADD CONSTRAINT `pp_property_FK` FOREIGN KEY (`property_ID`) REFERENCES `property` (`property_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `property_unique_service`
--
ALTER TABLE `property_unique_service`
  ADD CONSTRAINT `pus_property_FK` FOREIGN KEY (`property_ID`) REFERENCES `property` (`property_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pus_unique_service_link_FK` FOREIGN KEY (`unique_service_link_ID`) REFERENCES `unique_service_link` (`unique_service_link_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `short_desc_link`
--
ALTER TABLE `short_desc_link`
  ADD CONSTRAINT `sd_property_ID_FK` FOREIGN KEY (`property_ID`) REFERENCES `property` (`property_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `short_desc_translation`
--
ALTER TABLE `short_desc_translation`
  ADD CONSTRAINT `short_desc_link_FK` FOREIGN KEY (`short_desc_link_ID`) REFERENCES `short_desc_link` (`short_desc_link_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `title_link`
--
ALTER TABLE `title_link`
  ADD CONSTRAINT `tl_property_ID_FK` FOREIGN KEY (`property_ID`) REFERENCES `property` (`property_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `title_translation`
--
ALTER TABLE `title_translation`
  ADD CONSTRAINT `title_link_FK` FOREIGN KEY (`title_link_ID`) REFERENCES `title_link` (`title_link_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `unique_service_translation`
--
ALTER TABLE `unique_service_translation`
  ADD CONSTRAINT `unique_service_link_FK` FOREIGN KEY (`unique_service_link_ID`) REFERENCES `unique_service_link` (`unique_service_link_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
