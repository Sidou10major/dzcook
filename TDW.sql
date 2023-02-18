-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 18 fév. 2023 à 10:10
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
Create database if not exists projet_tdw;
use projet_tdw;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_tdw`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `adminID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `mdp` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`adminID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`adminID`, `email`, `mdp`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `categorieID` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`categorieID`),
  UNIQUE KEY `titre` (`titre`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`categorieID`, `titre`) VALUES
(1, 'entree'),
(2, 'plat'),
(3, 'boisson'),
(4, 'dessert');

-- --------------------------------------------------------

--
-- Structure de la table `composent`
--

DROP TABLE IF EXISTS `composent`;
CREATE TABLE IF NOT EXISTS `composent` (
  `recetteID` int(11) NOT NULL,
  `ingredientID` int(11) NOT NULL,
  `modeID` int(11) DEFAULT NULL,
  `quantite` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`recetteID`,`ingredientID`),
  KEY `ingredientID` (`ingredientID`),
  KEY `modeID` (`modeID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `composent`
--

INSERT INTO `composent` (`recetteID`, `ingredientID`, `modeID`, `quantite`) VALUES
(4, 2, 1, '3'),
(4, 3, 1, '200'),
(4, 4, 1, '80'),
(4, 5, 1, '1'),
(4, 6, 1, '1'),
(42, 18, NULL, '1'),
(42, 21, NULL, '5'),
(42, 13, NULL, '1'),
(42, 19, NULL, '3'),
(42, 22, NULL, '1'),
(42, 20, NULL, '10'),
(42, 23, NULL, '3'),
(41, 15, NULL, '1'),
(41, 14, NULL, '2'),
(41, 17, NULL, '3'),
(41, 16, NULL, '2'),
(41, 13, NULL, '3'),
(41, 5, NULL, '1'),
(41, 18, NULL, '1'),
(42, 5, NULL, '1'),
(43, 24, NULL, '200'),
(43, 25, NULL, '0.25'),
(43, 18, NULL, '1'),
(43, 5, NULL, '1'),
(43, 26, NULL, '20'),
(48, 24, 40, '2'),
(48, 3, 64, '250'),
(47, 31, NULL, '1'),
(48, 34, 40, '1'),
(45, 27, NULL, '1'),
(45, 28, NULL, '1'),
(45, 30, NULL, '1'),
(45, 5, NULL, '1'),
(45, 17, NULL, '1'),
(45, 29, NULL, '1'),
(47, 5, NULL, '1'),
(47, 33, NULL, '15'),
(47, 32, NULL, '150'),
(48, 35, 40, '2'),
(48, 36, 40, '70'),
(48, 23, 40, '5'),
(51, 38, 40, '1'),
(51, 16, 40, '1'),
(51, 40, 40, '2'),
(51, 19, 40, '2'),
(51, 37, 40, '2'),
(51, 5, 40, '1'),
(51, 18, 40, '1'),
(51, 39, 40, '1'),
(51, 41, 40, '2'),
(52, 42, 64, '3'),
(52, 24, 40, '1'),
(52, 43, 40, '200'),
(52, 33, 40, '20'),
(52, 22, 40, '1'),
(52, 5, 40, '1'),
(52, 18, 40, '1'),
(52, 44, 40, '1'),
(52, 30, 40, '1');

-- --------------------------------------------------------

--
-- Structure de la table `diaporama`
--

DROP TABLE IF EXISTS `diaporama`;
CREATE TABLE IF NOT EXISTS `diaporama` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsID` int(11) DEFAULT NULL,
  `recetteID` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `newsID` (`newsID`),
  KEY `recetteID` (`recetteID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `diaporama`
--

INSERT INTO `diaporama` (`id`, `newsID`, `recetteID`, `url`) VALUES
(1, NULL, 3, 'index.php?action=detailDisplay&type=recettes&id=3'),
(2, 1, NULL, 'https://www.independent.co.uk/life-style/food-and-drink/grilled-whole-fish-bbq-recipe-b2095737.html'),
(3, NULL, 6, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `dispoingredient`
--

DROP TABLE IF EXISTS `dispoingredient`;
CREATE TABLE IF NOT EXISTS `dispoingredient` (
  `ingredientID` int(11) NOT NULL,
  `saisonID` int(11) NOT NULL,
  PRIMARY KEY (`ingredientID`,`saisonID`),
  KEY `saisonID` (`saisonID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dispoingredient`
--

INSERT INTO `dispoingredient` (`ingredientID`, `saisonID`) VALUES
(1, 1),
(13, 1),
(13, 2),
(13, 3),
(13, 4),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(15, 1),
(15, 2),
(15, 3),
(15, 4),
(16, 1),
(16, 2),
(16, 3),
(16, 4),
(17, 1),
(17, 2),
(17, 3),
(17, 4),
(18, 1),
(18, 3),
(18, 4),
(19, 1),
(19, 2),
(19, 3),
(19, 4),
(20, 1),
(20, 2),
(20, 3),
(20, 4),
(21, 1),
(21, 2),
(21, 3),
(21, 4),
(22, 1),
(22, 2),
(22, 3),
(22, 4),
(24, 1),
(24, 2),
(24, 3),
(24, 4),
(25, 1),
(25, 2),
(25, 3),
(25, 4),
(27, 1),
(27, 2),
(27, 3),
(27, 4),
(28, 1),
(28, 4),
(29, 1),
(29, 2),
(29, 3),
(29, 4),
(30, 1),
(30, 2),
(30, 3),
(30, 4),
(31, 1),
(31, 2),
(31, 3),
(31, 4),
(32, 1),
(32, 2),
(32, 3),
(32, 4),
(33, 1),
(33, 2),
(33, 3),
(33, 4),
(37, 1),
(37, 2),
(37, 3),
(37, 4),
(38, 1),
(38, 2),
(38, 3),
(38, 4),
(39, 1),
(39, 2),
(39, 3),
(39, 4),
(40, 1),
(40, 2),
(40, 3),
(40, 4);

-- --------------------------------------------------------

--
-- Structure de la table `etape`
--

DROP TABLE IF EXISTS `etape`;
CREATE TABLE IF NOT EXISTS `etape` (
  `recetteID` int(11) NOT NULL,
  `etape` int(11) NOT NULL,
  `instruction` mediumtext,
  PRIMARY KEY (`recetteID`,`etape`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etape`
--

INSERT INTO `etape` (`recetteID`, `etape`, `instruction`) VALUES
(3, 1, 'La veille, faites tremper vos haricots blancs dans une grande quantité d\'eau.\r\n'),
(3, 2, 'Le jour J, dans une cocotte, faites revenir 4 c.à café d\'huile avec l’oignon préalablement coupé. Ajoutez le poulet, le sel, le poivre, l\'ail et le cumin. Faites dorer le tout 5 min.\r\n\r\n'),
(3, 3, 'Mettez le concentré de tomates puis remplissez la cocotte de moitié d\'eau. Fermez-la et laissez cuire 25 min.\r\n\r\n'),
(3, 4, 'Retirez la peau du poulet, ajoutez à la cocotte les haricots blancs. Fermez et laissez cuire 30 min.\r\n\r\n'),
(4, 1, 'La veille, faites tremper les pois chiche dans l\'eau. Le jour de la recette, égouttez-les pois chiche. Réservez.\r\n\r\n'),
(4, 2, 'Préparez la farce : dans un saladier, déposez la viande hachée avec la cannelle et le riz.\r\n\r\n'),
(4, 3, 'Pelez et émincez finement l\'oignon, ajoutez-en la moitié à la préparation.\r\n\r\n'),
(4, 4, 'Ciselez finement le persil et ajoutez-en également la moitié à la farce de votre dolma algérienne.\r\n\r\n'),
(4, 5, 'Salez et poivrez selon votre goût. Liez la farce avec l\'oeuf battu. Réservez.\r\n\r\n'),
(4, 6, 'Epluchez les pommes de terre et videz-les. Coupez le haut des courgettes rondes et videz-les également.\r\n\r\n'),
(4, 7, 'Dans chaque légume vidé, déposez la farce de sorte à bien remplir le légume. Réservez.\r\n\r\n'),
(4, 8, 'Dans une poêle, faites fondre le beurre puis ajoutez le reste du persil et de l\'oignon. Faites dorer votre viande pendant 5 minutes de chaque côté. Lorsque la viande est suffisament colorée, ajoutez 1 litre d\'eau et les pois chiches réhydratés.\r\n\r\n'),
(4, 9, 'Déposez délicatement les légumes farcis dans cette sauce et laissez cuire à feu moyen durant 15 minutes, suffisamment pour que la farce et le légume cuise mais sans se déliter.\r\n\r\n'),
(4, 10, 'Servez votre dolma algérienne : dans votre assiette déposez les légumes accompagnés d\'un morceau de viande à part, de pois chiches et d\'une cuillère de sauce !\r\n\r\n'),
(42, 4, ' la ciboulette et la coriandre ciselées. Salez et poivrez à votre convenance. Versez cette vinaigrette dans le saladier et placez-le au frais jusqu\'au moment de servir.'),
(42, 1, 'Lavez les tomates et coupez-les en quartiers. Déposez-les ensuite dans un saladier'),
(42, 3, 'Préparez la vinaigrette en mélangeant l\'huile avec le vinaigre'),
(42, 2, 'Épluchez l\'oignon et émincez-le. Ajoutez-le aux quartiers de tomate puis mélangez'),
(41, 1, 'Épluchez la betterave puis la couper en petit dés'),
(41, 2, 'Placez le tout dans un saladier'),
(41, 3, 'Mélangez les ingrédients afin de faire une bonne vinaigrette puis mettez vos betteraves et remuez le tout'),
(41, 4, 'Décorez de quelques feuilles de persil'),
(41, 5, 'A servir frais'),
(41, 6, '41'),
(42, 5, '42'),
(43, 1, 'Peler les carottes'),
(43, 2, ' les râper à l\'aide d\'une râpe à larges entailles et les mettre dans un bol. Y verser la vinaigrette classique et le jus de citron'),
(43, 3, ' saler et poivrer'),
(43, 4, ' et bien mélanger'),
(43, 5, 'Servir'),
(43, 6, '43'),
(45, 1, 'La préparation du couscous est la plus longue et se fait à l’aide d’un couscoussier. Tout d’abord, versez le couscous dans un récipient et mouillez-le avec de l’eau. Egrainez le couscous avec vos doigts, puis égouttez le tout à l’aide d’un chinois, ou en se servant du haut du couscoussier.\r\n\r\n'),
(45, 2, 'Remettez le couscous dans le récipient et arrosez-le d’un filet d’huile d’olive. Egrainez de nouveau le couscous entre vos doigts pour qu’il s’imbibe bien d’huile d’olive.\r\n\r\n'),
(45, 3, 'Déposez le couscous huilé dans le haut du couscoussier et faites cuire à la vapeur. Quand la vapeur se dégage, laissez cuire environ 10 minutes.\r\n\r\n'),
(45, 4, 'Puis versez le couscous dans le récipient et arrosez avec un verre d’eau puis ajoutez du sel. Mélangez bien, toujours avec vos doigts, jusqu’à ce que le couscous ait bien absorbé l’eau.\r\n\r\n'),
(45, 5, 'Pendant ce temps, déposez les petits pois et les fèves dans le haut du couscoussier et faites-les cuire à la vapeur. Quand la vapeur commence à sortir du couscoussier, prolongez la cuisson de 10 minutes puis retirez les légumes du panier.\r\n\r\n'),
(45, 6, 'Préparez votre mesfouf algérien en mélangeant les petits pois, les fèves et le couscous dans la jatte, et servez bien chaud.'),
(51, 16, 'Saupoudrez de paprika'),
(51, 10, 'Déposez alors les poivrons sur une planche à découper et retirez la peau. Coupez les poivrons en deux'),
(51, 11, ' enlevez les pépins puis taillez en julienne (petits dés).'),
(51, 12, 'Faites bouillir une casserole d’eau et plongez les tomates une minute dedans. Egouttez-les'),
(51, 13, ' retirez la peau puis coupez-les en julienne.'),
(51, 14, 'Chauffez une poêle avec un peu d’huile d’olive et faites revenir l’ail quelques minutes avant d’ajouter les tomates'),
(51, 15, ' puis les poivrons. Poursuivez la cuisson pendant 5 minutes.'),
(48, 21, '48'),
(48, 19, 'Poursuivre la cuisson durant 10 minutes à couvert.'),
(48, 20, 'Servez aussitôt votre chorba algérienne en décorant d\'un peu de coriandre fraîche.'),
(48, 15, 'Ajoutez 1'),
(48, 16, '5 litre d\'eau dans la cocotte et faites mijoter votre chorba algérienne à feu fort durant 20 minutes.'),
(48, 17, 'Ajoutez le concentré de tomates'),
(48, 18, ' les vermicelles et les pois chiches et rectifiez l\'assaisonnement.'),
(48, 12, 'Ajoutez toutes les épices'),
(48, 13, ' salez et poivrez.'),
(48, 14, 'Ciselez la coriandre et versez la moitié dans la cocotte avec les légumes et la viande. Réservez le reste pour la décoration.'),
(48, 11, ' les tomates et l\'oignon à la viande puis laissez revenir 5 minutes.'),
(48, 10, 'Ajoutez les légumes'),
(48, 9, ' râpez les tomates.'),
(48, 6, ' faites chauffer l\'huile d\'olive et faites caraméliser la viande 2 minutes de chaque côté.'),
(48, 7, 'Parallèlement'),
(48, 8, ' pelez et émincez l\'oignon'),
(48, 5, 'Coupez la viande en petits morceaux. Dans une grande cocotte'),
(48, 2, ' mettre les pois chiches à tremper dans un grand volume d\'eau. Le jour de la recette'),
(48, 3, ' les égoutter et réserver.'),
(48, 4, 'Epluchez les légumes et coupez-les en dés grossiers.'),
(48, 1, 'La veille'),
(47, 1, 'Mélangez dans une gasaa en bois ou en terre et à défaut dans un large plat creux la semoule avec le sel.'),
(47, 2, 'Ramassez la semoule en ajoutant de l\'eau au fur et à mesure jusqu\'à obtention d\'une boule de pâte souple'),
(47, 3, ' ferme et qui ne colle pas. Recouvrez-la avec un linge propre et faites-la reposer 30 minutes.'),
(47, 4, 'Pour pétrir la pâte'),
(47, 5, ' utilisez un robot culinaire avec le crochet adapté. Sinon'),
(47, 6, ' faites-le à la main pendant au moins 10 minutes en travaillant énergiquement la pâte.'),
(47, 7, 'Divisez ensuite en petites boules de la taille d\'une balle de ping-pong et saupoudrez-les avec de la fécule avant de les recouvrir. Laissez reposer pendant 3 heures à température ambiante.'),
(47, 8, 'Passé ce temps'),
(47, 9, ' abaissez au rouleau à pâtisserie chaque boule sur un plan de travail propre fariné. Saupoudrez généreusement avec de la fécule avant de les passer à la machine à pâtes.'),
(47, 10, 'Laminez plusieurs fois chaque morceau de pâte en réduisant à chaque passage d\'un cran l\'épaisseur du laminoir et en saupoudrant également à chaque fois avec de la fécule. Vous devez obtenir une fine bande de pâte. Saupoudrez-la encore une fois de fécule sur chaque face avant de la réserver à plat sur un linge propre ou un séchoir à pâtes.'),
(47, 11, 'Renouvelez l\'opération jusqu\'à épuisement des boules.'),
(47, 12, 'Laissez sécher les feuilles de trida entre 15 et 30 minutes selon la saison et la température de la pièce. Elles ne doivent pas être trop sèches car il faut pouvoir les détailler sans qu\'elles cassent.'),
(47, 13, ''),
(47, 14, 'Découpez ensuite dans chaque feuille des bandelettes de 1 cm de large'),
(47, 15, ' puis'),
(47, 16, ' dans ces bandelettes'),
(47, 17, ' des petits carrés de 1 cm de côté.Étalez les carrés de trida algérien sur le linge propre et poursuivez le séchage pendant au moins 24 heures et jusqu\'à 2-3 jours en fonction toujours de la température ambiante.'),
(47, 18, 'Conservez vos pâtes trida algérien à l\'abri de l\'humidité'),
(47, 19, ' au sec dans une boîte fermée. Vous pouvez les conserver plusieurs semaines avant de les utiliser pour confectionner vos recettes de trida en sauce blanche ou rouge. Les petits carrés de pâte trida seront cuits à la vapeur au-dessus du bouillon de cuisson de la viande et des légumes.'),
(47, 20, '47'),
(51, 9, ' couvrez d’un film alimentaire et laissez reposer 15 minutes pour qu’ils refroidissent.'),
(51, 8, ' déposez-les dans un saladier'),
(51, 6, 'Dès que la peau commence à former des cloques'),
(51, 7, ' sortez-les du four'),
(51, 4, 'Lavez les poivrons'),
(51, 5, ' et déposez-les directement sur une grille allant au four. Enfournez pendant 25 à 30 minutes environ. Les poivrons doivent légèrement noircir sur toutes les faces.'),
(51, 3, 'Ciselez le persil.'),
(51, 2, 'Emincez les gousses d’ail. Réservez.'),
(51, 1, 'Préchauffez le four à 200°C (Th. 6/7).'),
(52, 2, '52'),
(52, 1, ''),
(51, 19, 'Saupoudrez de persil avant de servir bien chaud.'),
(51, 20, '51'),
(51, 18, 'Cassez les œufs dans la poêle et faites cuire comme des œufs au plat par dessus la garniture.'),
(51, 17, ' assaisonnez avec le sel et le poivre et laissez cuire jusqu’à ce que les poivrons deviennent fondants.');

-- --------------------------------------------------------

--
-- Structure de la table `fete`
--

DROP TABLE IF EXISTS `fete`;
CREATE TABLE IF NOT EXISTS `fete` (
  `feteID` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`feteID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fete`
--

INSERT INTO `fete` (`feteID`, `titre`) VALUES
(1, 'aid al fitr'),
(2, 'aid al adha'),
(6, 'halloween'),
(9, 'halloween'),
(10, ''),
(11, 'eid'),
(12, 'ramadan');

-- --------------------------------------------------------

--
-- Structure de la table `feterecette`
--

DROP TABLE IF EXISTS `feterecette`;
CREATE TABLE IF NOT EXISTS `feterecette` (
  `recetteID` int(11) NOT NULL,
  `feteID` int(11) NOT NULL,
  PRIMARY KEY (`recetteID`,`feteID`),
  KEY `feteID` (`feteID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `feterecette`
--

INSERT INTO `feterecette` (`recetteID`, `feteID`) VALUES
(6, 1),
(6, 2),
(8, 1),
(41, 6),
(42, 10),
(43, 10),
(45, 11),
(47, 12),
(51, 10),
(52, 10);

-- --------------------------------------------------------

--
-- Structure de la table `infonutritionnelle`
--

DROP TABLE IF EXISTS `infonutritionnelle`;
CREATE TABLE IF NOT EXISTS `infonutritionnelle` (
  `infoID` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) DEFAULT NULL,
  `description` mediumtext,
  `ingredientID` int(11) DEFAULT NULL,
  PRIMARY KEY (`infoID`),
  KEY `ingredientID` (`ingredientID`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `infonutritionnelle`
--

INSERT INTO `infonutritionnelle` (`infoID`, `titre`, `description`, `ingredientID`) VALUES
(1, 'Lipides', '0,3 g dans 100g', 2),
(2, 'Fer', '0,4 mg	dans 100g', 2),
(6, 'Cholestérol', '0mg', 13),
(5, 'Lipides', '0g', 13),
(7, 'Sodium', '2mg', 13),
(8, 'Potassium', '2mg', 13),
(9, 'Glucides', '0g', 13),
(10, 'Protéines', '0g', 13),
(11, 'Calories', '66', 14),
(12, 'Lipides', '4g', 14),
(13, 'Sodium', '1.135 mg', 14),
(14, 'Potassium', '138 mg', 14),
(15, 'Glucides', '5g', 14),
(16, 'Sodium', '213mg', 15),
(17, 'Potassium', '379mg', 15),
(18, 'Calories', '36', 16),
(19, 'Cholesterol', '0', 16),
(20, 'Sodium', '56mgPotassium', 16),
(21, 'Calories', '884', 17),
(22, 'Lipides', '100g', 17),
(23, 'calories', '304', 18),
(24, 'calories', '16', 19),
(25, 'Lipides', '0.7g', 20),
(26, 'Sodium', '3mg', 20),
(27, '', NULL, 21),
(28, 'Lipides', '0.1g', 22),
(29, 'Sodium', '4mg', 22),
(30, 'Calories', '41', 24),
(31, '', NULL, 25),
(32, 'Sodium', '5mg', 27),
(33, '', NULL, 28),
(34, 'Calories', '81', 29),
(35, 'Calories', '717', 30),
(36, 'Lipides', '81mg', 30),
(37, 'Calories', '360', 31),
(38, '', NULL, 32),
(39, '', NULL, 33),
(40, '', NULL, 37),
(41, '', NULL, 38),
(42, '', NULL, 39),
(43, '', NULL, 40);

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `ingredientID` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) DEFAULT NULL,
  `imgPath` varchar(255) DEFAULT NULL,
  `healthy` tinyint(1) DEFAULT NULL,
  `originSaison` int(11) DEFAULT '1',
  PRIMARY KEY (`ingredientID`),
  KEY `originSaison` (`originSaison`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`ingredientID`, `titre`, `imgPath`, `healthy`, `originSaison`) VALUES
(2, 'courgette', 'https://res.cloudinary.com/hv9ssmzrz/image/fetch/c_fill,f_auto,h_488,q_auto,w_650/https://images-ca-1-0-1-eu.s3-eu-west-1.amazonaws.com/photos/original/741/produit-courgettes-AdobeStock_86727844.jpg', 1, 0),
(3, 'agneau', 'https://res.cloudinary.com/hv9ssmzrz/image/fetch/c_fill,f_auto,h_387,q_auto,w_650/https://s3-eu-west-1.amazonaws.com/images-ca-1-0-1-eu/tag_photos/original/251/selle-d-agneau-crue-3000x2000.jpg', 1, 2),
(4, 'riz', 'https://res.cloudinary.com/hv9ssmzrz/image/fetch/c_fill,f_auto,h_488,q_auto,w_650/https://s3-eu-west-1.amazonaws.com/images-ca-1-0-1-eu/recipe_photos/original/871/bol-de-riz-3000x2000.jpg', 1, 3),
(5, 'Sel', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Table_salt_with_salt_shaker_V1.jpg/800px-Table_salt_with_salt_shaker_V1.jpg', 0, 4),
(6, 'oeuf', 'https://res.cloudinary.com/hv9ssmzrz/image/fetch/c_fill,f_auto,h_488,q_auto,w_650/https://s3-eu-west-1.amazonaws.com/images-ca-1-0-1-eu/recipe_photos/original/659/oeuf-dur-3000x2000.jpg', 1, 4),
(35, 'céleri', '', 1, NULL),
(13, 'Vinaigre', '../Asserts/63c8a9728cfdf', 1, 0),
(34, 'navet', '', 1, NULL),
(14, 'moutarde', '../Asserts/63c8a997729da', 1, 0),
(15, 'betterave', '../Asserts/63c886a05a4bftéléchargement.jfif', 1, 4),
(16, 'persil', '../Asserts/63c88702bc447téléchargement (4).jfif', 1, 4),
(17, 'huile d’olive', '../Asserts/63c887a488c3etéléchargement (2).jfif', 1, 3),
(18, 'poivre', '../Asserts/63c88824603a0téléchargement (3).jfif', 1, 3),
(19, 'tomate', '../Asserts/63c88d03ad211téléchargement (6).jfif', 1, 1),
(20, 'ciboulette', '../Asserts/63c88d8b6e971téléchargement (7).jfif', 1, 4),
(21, 'coriandre', '../Asserts/63c88de499e2ctéléchargement (8).jfif', 1, 1),
(22, 'oignon', '../Asserts/63c88e5716703téléchargement (9).jfif', 1, 2),
(23, 'huile d\'olive', '', 1, NULL),
(24, 'carotte', '../Asserts/63c8904136d34image_2023-01-19_013436252.png', 1, 1),
(25, 'citron', '../Asserts/63c890bf4b3b8image_2023-01-19_013625674.png', 1, 2),
(26, 'Vinaigrette', '', 0, NULL),
(27, 'couscous', '../Asserts/63c893de840baimage_2023-01-19_015014350.png', 0, 1),
(28, 'fève', '../Asserts/63c89418bbc07image_2023-01-19_015135738.png', 1, 4),
(29, 'petits pois', '../Asserts/63c89459e3bceimage_2023-01-19_015208644.png', 1, 4),
(30, 'beurre', '../Asserts/63c894a6916bcimage_2023-01-19_015301943.png', 0, 2),
(31, 'Semoule', '../Asserts/63c898019465cimage_2023-01-19_020724682.png', 1, 2),
(32, 'pomme de terre', '../Asserts/63c8983185a02image_2023-01-19_020840641.png', 1, 3),
(33, 'Eau', '../Asserts/63c8986d58098image_2023-01-19_020956196.png', 1, 0),
(36, 'vermicelles', '', 1, NULL),
(37, 'poivrons rouges', '../Asserts/63c8beec818dcimage_2023-01-19_045344657.png', 1, 1),
(38, 'poivron vert', '../Asserts/63c8bf204043eimage_2023-01-19_045454340.png', 1, 1),
(39, 'paprika', '../Asserts/63c8bf60638c4image_2023-01-19_045604290.png', 0, 1),
(40, 'gousses d\'ail', '../Asserts/63c8bf9e7edc5image_2023-01-19_045657060.png', 1, 1),
(41, 'œuf', '', 1, NULL),
(42, 'poulet', '', 1, NULL),
(43, 'champignon', '', 1, NULL),
(44, 'cannelle', '', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `modecuisson`
--

DROP TABLE IF EXISTS `modecuisson`;
CREATE TABLE IF NOT EXISTS `modecuisson` (
  `modeID` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`modeID`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `modecuisson`
--

INSERT INTO `modecuisson` (`modeID`, `titre`) VALUES
(1, 'frire'),
(40, 'sans'),
(44, 'fulminé'),
(58, 'tiede'),
(64, 'cuire');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `newsID` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) DEFAULT NULL,
  `description` mediumtext,
  `imgPath` varchar(255) DEFAULT NULL,
  `videoPath` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`newsID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`newsID`, `titre`, `description`, `imgPath`, `videoPath`) VALUES
(1, 'New easy recipe for orange jus', '', 'https://img.cuisineaz.com/660x660/2018/11/17/i144270-jus-d-orange.webp', ''),
(8, 'Today\'s the d-day', 'i want a 20 in TPW so i\'m still working till 6AM', '../Asserts/63c8caebbcbeatéléchargement (8).jfif', '../Asserts/63c8caebbd040');

-- --------------------------------------------------------

--
-- Structure de la table `newspage`
--

DROP TABLE IF EXISTS `newspage`;
CREATE TABLE IF NOT EXISTS `newspage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsID` int(11) DEFAULT NULL,
  `recetteID` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `newsID` (`newsID`),
  KEY `recetteID` (`recetteID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `newspage`
--

INSERT INTO `newspage` (`id`, `newsID`, `recetteID`, `url`) VALUES
(1, NULL, 3, 'www.google.com'),
(2, 1, NULL, 'www.google.com'),
(7, 8, NULL, 'http://localhost/wasfati/client/index.php?action=detailDisplay&type=recettes&id=4');

-- --------------------------------------------------------

--
-- Structure de la table `params`
--

DROP TABLE IF EXISTS `params`;
CREATE TABLE IF NOT EXISTS `params` (
  `paramID` int(11) NOT NULL AUTO_INCREMENT,
  `cle` varchar(100) DEFAULT NULL,
  `valeur` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`paramID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `params`
--

INSERT INTO `params` (`paramID`, `cle`, `valeur`) VALUES
(2, 'facebook', 'https://www.facebook.com/profile.php?id=100086463316458'),
(3, 'primary1', '#FFCE80'),
(4, 'primary2', '#E83845'),
(5, 'secondary1', '#E389B9'),
(6, 'secondary2', '#746AB0'),
(7, 'black', '0, 0, 0'),
(8, 'bgRGB', '128, 128, 128'),
(9, 'body', '205, 205,205'),
(10, 'instagram', 'https://www.instagram.com/bollyfoodbechar/'),
(11, 'linkedin', 'https://www.linkedin.com/in/sid-ahmed-boudaoud-416984196/');

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `recetteID` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) DEFAULT NULL,
  `description` mediumtext NOT NULL,
  `imgPath` varchar(255) DEFAULT NULL,
  `videoPath` varchar(255) DEFAULT NULL,
  `difficulte` varchar(25) DEFAULT NULL,
  `state` tinyint(1) DEFAULT '0',
  `tempsPreparation` int(11) DEFAULT NULL,
  `tempsRepo` int(11) DEFAULT NULL,
  `tempsCuisson` int(11) DEFAULT NULL,
  `calories` int(11) DEFAULT NULL,
  `categorieID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `healthy` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`recetteID`),
  KEY `categorieID` (`categorieID`),
  KEY `userID` (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`recetteID`, `titre`, `description`, `imgPath`, `videoPath`, `difficulte`, `state`, `tempsPreparation`, `tempsRepo`, `tempsCuisson`, `calories`, `categorieID`, `userID`, `healthy`) VALUES
(4, 'Dolma', 'La dolma algérienne est en réalité une recette de légumes farcis en sauce. L\'avantage est qu\'elle se décline facilement selon les goûts de tous ! Contrairement aux légumes farcis occidentaux, ceux-ci se cuisent dans une sauce déjà bien parfumée à la viande et aux pois chiches. Un délice servi lors du ramadan qui est particulièrement consistant, donc idéal pour cette période', 'https://img.cuisineaz.com/660x660/2016/07/03/i28720-dolma-algerienne.webp', NULL, 'facile', 1, 50, 0, 30, 140000, 2, 1, 0),
(3, 'LOUBIA', 'La loubia est un ragoût de haricots blancs à la tomate et aux épices d\'origine maghrébine. Il se prépare traditionnellement avec de l\'agneau, du mouton, du bœuf ou des tripes. Pour changer, voici une recette de loubia au poulet. Un plat réconfortant, consistant et bien chaud, idéal pour l\'hiver, que les maghrébins dégustent avec du pain.\r\n', 'https://img.cuisineaz.com/660x660/2022/06/11/i184227-loubia.webp', NULL, 'facile', 1, 15, 0, 60, 30000, 2, 1, 1),
(5, 'Sardines marinés frites', 'La sardine est le poisson le plus consommé en Algérie, car c’est le plus abondant vu que c’est la méditerranée, et le plus accessible aux bourses aussi. Dans la cuisine Algérienne il y a beaucoup de recettes à base de sardines, j’essaierais de vous les présenter au fur et à mesure. Aujourd’hui je vous présente les sardines frites, vous allez me dire quoi de plus simple, de la farine et hop!, mais non!, chez nous les sardines ne sont pas cuite comme ça, mais plutôt marinées dans une chermoula (Marinade), puis enroulé dans le farine, les sardines sont croustillantes et ont un gout sublime , croyez moi, vous ne pourrez plus vous en passer. La chermoula présenté ici peut être utilisée pour différents types de poissons, tels que : merlan, rouget, pageot…etc. Et les sardines marinée peuvent être aussi cuites au four, ou sur barbecue, à votre convenance.', 'https://img.cuisineaz.com/660x660/2016/03/31/i37739-sardines-marines-frites.webp', NULL, 'moyen', 1, 30, 60, 2, 198, 2, 1, 0),
(6, 'Jus d\'orange', 'Oubliez votre ancien presse agrumes ! Même s\'il a été votre ami certains matins difficiles, troquez-le sans plus hésiter contre un extracteur. Vous pourrez ainsi préparer vos jus d\'orange à l\'extracteur de jus et ensoleiller votre petit-déjeuner !', 'https://img.cuisineaz.com/660x660/2018/11/17/i144270-jus-d-orange.webp', NULL, 'facile', 1, 15, 0, 0, 45, 3, NULL, 1),
(7, 'Salade de maïs', 'Salade de maïs facile a faire', 'https://img.cuisineaz.com/660x660/2014/08/18/i22941-salade-de-mais.webp', NULL, 'facile', 1, 15, 0, 0, 78, 1, 1, 1),
(8, 'Gâteau simple au chocolat', 'Vous cherchez une idée de recette pour le goûter ou pour un dessert ? Pourquoi pas un gâteau simple au chocolat ? Qui a dit qu\'une recette sucrée devait absolument être originale pour être appréciée ? Ce bon vieux gâteau au chocolat de notre enfance est un classique indémodable : facile à cuisiner et rapide à faire. Si vous avez ces 6 ingrédients, et quelques minutes devant vous, faites plaisir aux bouches sucrées de votre entourage sans vous prendre la tête ! ', 'https://img.cuisineaz.com/660x660/2013/12/20/i91729-gateau-simple-au-chocolat.webp', 'https://www.cuisineaz.com/57bdbc11-a2c4-43a9-9248-5f214903a7c0', NULL, 1, 10, 0, 30, 501, 4, 1, 0),
(41, 'Salade de betterave', 'Salade de betterave facile a faire.', '../Asserts/63c88b784137ai38198-salade-de-betterave-facile.webp', '../Asserts/63c88b78419ad', 'facile', 1, 15, 0, 0, 122, 1, NULL, 1),
(42, 'Salade de tomates', 'Un grand classique de l\'été qui marche tout le temps, avec tout le monde : la salade de tomates ! Très rafraîchissante, très savoureuse, et excellente pour la santé, cette salade d\'été est tout simplement parfaite. Voilà une recette facile et rapide, qui régalera la tablée des petits et des grands. Des tomates bien mûres et bien juteuses, avec de l\'oignon, de la ciboulette, de la coriandre, et un bon assaisonnement. Une explosion de fraîcheur et de saveurs à tester très vite ! Vous serez ravis !', '../Asserts/63c88f530a45bimage_2023-01-19_012829857.png', '../Asserts/63c88f530a683', 'facile', 1, 10, 0, 0, 191, 1, NULL, 1),
(43, 'Salade de carotte', 'Salade de carotte facile a faire.', '../Asserts/63c8927bba6eaimage_2023-01-19_013957535.png', '../Asserts/63c8927bbab4b', 'facile', 1, 5, 0, 0, 65, 1, NULL, NULL),
(45, 'Mesfouf', 'La recette du mesfouf algérien est un incontournable de la cuisine musulmane pendant le Ramadan. Avec des fèves et des petits pois et son couscous fondant cuit à la vapeur, le mesfouf algérien saura enchanter vos papilles !', '../Asserts/63c895ba9a492image_2023-01-19_015429053.png', '../Asserts/yt5s.io-Mesfouf aux fèves et aux petits pois.mp4', 'facile', 1, 10, 0, 35, 164, 2, NULL, NULL),
(48, 'Chorba', 'La chorba à l\'algérienne est une soupe traditionnelle orientale principalement consommée en Algérie (comme son nom l\'indique !) mais également en Tunisie et au Maroc lors de la période du ramadan. C\'est une soupe à base de viande d\'agneau ou de mouton, de tomates, de vermicelles et de légumes. On trouve également des variantes à base de boeuf ou de veau', '../Asserts/63c8bc438fea7image_2023-01-19_042100853.png', '../Asserts/63c8bc439005f', 'facile', 1, 30, 0, 20, 344, 2, NULL, NULL),
(47, 'Trida', 'Le trida algérien tient son nom des petites pâtes carrées avec lesquelles différents plats de viandes et légumes en sauce rouge ou blanche sont préparés. Cette recette vous permettra de faire vous-même, avec l\'aide d\'une machine à pâtes, les petits carrés du trida algérien qu\'il est assez difficile de trouver dans le commerce. Nous vous conseillons de fabriquer vos pâtes quelques jours avant de vous lancer dans la préparation du plat !', '../Asserts/63c899b8a6cdfimage_2023-01-19_021031668.png', '../Asserts/63c899b8a7201', 'difficile', 1, 60, 210, 0, 300, 2, NULL, NULL),
(51, 'Chakchouka', 'La chakchouka algérienne est une délicieuse entrée aux légumes que l’on sert chaude ou froide et qui est très prisée pendant le Ramadan, accompagnée de baghrir. On peut la comparer à la ratatouille traditionnelle française. La chakchouka algérienne que l’on appelle aussi tchektchouka se prépare très facilement et est un plat diététique par excellence.', '../Asserts/63c8c17a52d19image_2023-01-19_050059161.png', '../Asserts/63c8c17a52ebc', 'facile', 1, 15, 15, 60, 375, 2, NULL, NULL),
(52, 'Tajine', 'Selon son pays d’origine, le tajine se pare d’ingrédients et de saveurs différentes. Coloré, savoureux et riche en épices, le tajine algérien nous emmène en voyage, le temps d’un délicieux repas.', '../Asserts/63c91bed656a3image_2023-01-19_112701176.png', '../Asserts/63c91bed658ec', 'facile', 1, 20, 0, 50, 130, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `recettefav`
--

DROP TABLE IF EXISTS `recettefav`;
CREATE TABLE IF NOT EXISTS `recettefav` (
  `recetteID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `rate` int(11) DEFAULT NULL,
  PRIMARY KEY (`recetteID`,`userID`),
  KEY `userID` (`userID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recettefav`
--

INSERT INTO `recettefav` (`recetteID`, `userID`, `rate`) VALUES
(4, 1, 3),
(6, 1, 3),
(3, 1, 4),
(7, 1, 1),
(43, 1, 1),
(41, 5, 5),
(3, 5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `recettesaison`
--

DROP TABLE IF EXISTS `recettesaison`;
CREATE TABLE IF NOT EXISTS `recettesaison` (
  `recetteID` int(11) NOT NULL,
  `saisonID` int(11) NOT NULL,
  PRIMARY KEY (`recetteID`,`saisonID`),
  KEY `saisonID` (`saisonID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recettesaison`
--

INSERT INTO `recettesaison` (`recetteID`, `saisonID`) VALUES
(4, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `saison`
--

DROP TABLE IF EXISTS `saison`;
CREATE TABLE IF NOT EXISTS `saison` (
  `saisonID` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`saisonID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `saison`
--

INSERT INTO `saison` (`saisonID`, `titre`) VALUES
(1, 'ete'),
(2, 'hiver'),
(3, 'automne'),
(4, 'printemps');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `mdp` varchar(100) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `dateNaissance` date DEFAULT NULL,
  `sexe` varchar(10) DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`userID`, `email`, `mdp`, `prenom`, `nom`, `dateNaissance`, `sexe`, `state`) VALUES
(1, 'js_boudaoud@esi.dz', 'Sidou2019', 'Sid Ahmed', 'Boudaoud', '2001-05-14', 'homme', 1),
(5, 'h_dellys@esi.dz', 'Tdw_2023', 'Nabil', 'Dellys', '1990-07-06', 'homme', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;