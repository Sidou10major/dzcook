SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


Create database if not exists projet_tdw;
use projet_tdw;
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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
(4, 6, 1, '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `diaporama`
--

INSERT INTO `diaporama` (`id`, `newsID`, `recetteID`, `url`) VALUES
(1, NULL, 3, '/index.php/detailDisplay/recettes&3'),
(2, 1, NULL, 'https://www.independent.co.uk/life-style/food-and-drink/grilled-whole-fish-bbq-recipe-b2095737.html');

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
(4, 10, 'Servez votre dolma algérienne : dans votre assiette déposez les légumes accompagnés d\'un morceau de viande à part, de pois chiches et d\'une cuillère de sauce !\r\n\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `fete`
--

DROP TABLE IF EXISTS `fete`;
CREATE TABLE IF NOT EXISTS `fete` (
  `feteID` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`feteID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fete`
--

INSERT INTO `fete` (`feteID`, `titre`) VALUES
(1, 'aid al fitr'),
(2, 'aid al adha');

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
(8, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `infonutritionnelle`
--

INSERT INTO `infonutritionnelle` (`infoID`, `titre`, `description`, `ingredientID`) VALUES
(1, 'Lipides', '0,3 g dans 100g', 2),
(2, 'Fer', '0,4 mg	dans 100g', 2);

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
  `originSaison` int(11) DEFAULT NULL,
  PRIMARY KEY (`ingredientID`),
  KEY `originSaison` (`originSaison`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`ingredientID`, `titre`, `imgPath`, `healthy`, `originSaison`) VALUES
(2, 'courgettes', 'https://res.cloudinary.com/hv9ssmzrz/image/fetch/c_fill,f_auto,h_488,q_auto,w_650/https://images-ca-1-0-1-eu.s3-eu-west-1.amazonaws.com/photos/original/741/produit-courgettes-AdobeStock_86727844.jpg', 1, 1),
(3, 'agneau', 'https://res.cloudinary.com/hv9ssmzrz/image/fetch/c_fill,f_auto,h_387,q_auto,w_650/https://s3-eu-west-1.amazonaws.com/images-ca-1-0-1-eu/tag_photos/original/251/selle-d-agneau-crue-3000x2000.jpg', 1, 2),
(4, 'riz', 'https://res.cloudinary.com/hv9ssmzrz/image/fetch/c_fill,f_auto,h_488,q_auto,w_650/https://s3-eu-west-1.amazonaws.com/images-ca-1-0-1-eu/recipe_photos/original/871/bol-de-riz-3000x2000.jpg', 1, 3),
(5, 'Sel', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Table_salt_with_salt_shaker_V1.jpg/800px-Table_salt_with_salt_shaker_V1.jpg', 0, 4),
(6, 'oeuf', 'https://res.cloudinary.com/hv9ssmzrz/image/fetch/c_fill,f_auto,h_488,q_auto,w_650/https://s3-eu-west-1.amazonaws.com/images-ca-1-0-1-eu/recipe_photos/original/659/oeuf-dur-3000x2000.jpg', 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `modecuisson`
--

DROP TABLE IF EXISTS `modecuisson`;
CREATE TABLE IF NOT EXISTS `modecuisson` (
  `modeID` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`modeID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `modecuisson`
--

INSERT INTO `modecuisson` (`modeID`, `titre`) VALUES
(1, 'frire');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`newsID`, `titre`, `description`, `imgPath`, `videoPath`) VALUES
(1, 'An idiot’s guide to grilling whole fish', 'f I write about cooking fish, I almost always get a comment about how smelly it is. If I suggest moving the cooking outside to the grill, I hear from friends with sad tales of losing fillets to the white-hot coals or winding up with overcooked, dried-out food.', 'https://static.independent.co.uk/2022/06/07/14/onthefridge-0b656dc2-d5f0-11ec-80e7-0fac5856f7cb.jpg?quality=75&width=990&auto=webp&crop=982:726,smart', 'IMG');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `newspage`
--

INSERT INTO `newspage` (`id`, `newsID`, `recetteID`, `url`) VALUES
(1, NULL, 3, 'www.google.com'),
(2, 1, NULL, 'www.google.com');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `state` tinyint(1) DEFAULT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`recetteID`, `titre`, `description`, `imgPath`, `videoPath`, `difficulte`, `state`, `tempsPreparation`, `tempsRepo`, `tempsCuisson`, `calories`, `categorieID`, `userID`, `healthy`) VALUES
(4, 'Dolma', 'La dolma algérienne est en réalité une recette de légumes farcis en sauce. L\'avantage est qu\'elle se décline facilement selon les goûts de tous ! Contrairement aux légumes farcis occidentaux, ceux-ci se cuisent dans une sauce déjà bien parfumée à la viande et aux pois chiches. Un délice servi lors du ramadan qui est particulièrement consistant, donc idéal pour cette période', 'https://img.cuisineaz.com/660x660/2016/07/03/i28720-dolma-algerienne.webp', NULL, 'facile', 1, 50, 0, 30, 140000, 2, 1, 0),
(3, 'LOUBIA', 'La loubia est un ragoût de haricots blancs à la tomate et aux épices d\'origine maghrébine. Il se prépare traditionnellement avec de l\'agneau, du mouton, du bœuf ou des tripes. Pour changer, voici une recette de loubia au poulet. Un plat réconfortant, consistant et bien chaud, idéal pour l\'hiver, que les maghrébins dégustent avec du pain.\r\n', 'https://img.cuisineaz.com/660x660/2022/06/11/i184227-loubia.webp', NULL, 'facile', 1, 15, 0, 60, 30000, 2, 1, 1),
(5, 'Sardines marinés frites', 'La sardine est le poisson le plus consommé en Algérie, car c’est le plus abondant vu que c’est la méditerranée, et le plus accessible aux bourses aussi. Dans la cuisine Algérienne il y a beaucoup de recettes à base de sardines, j’essaierais de vous les présenter au fur et à mesure. Aujourd’hui je vous présente les sardines frites, vous allez me dire quoi de plus simple, de la farine et hop!, mais non!, chez nous les sardines ne sont pas cuite comme ça, mais plutôt marinées dans une chermoula (Marinade), puis enroulé dans le farine, les sardines sont croustillantes et ont un gout sublime , croyez moi, vous ne pourrez plus vous en passer. La chermoula présenté ici peut être utilisée pour différents types de poissons, tels que : merlan, rouget, pageot…etc. Et les sardines marinée peuvent être aussi cuites au four, ou sur barbecue, à votre convenance.', 'https://img.cuisineaz.com/660x660/2016/03/31/i37739-sardines-marines-frites.webp', NULL, 'moyen', 1, 30, 60, 2, 198, 2, 1, 0),
(6, 'Jus d\'orange', 'Oubliez votre ancien presse agrumes ! Même s\'il a été votre ami certains matins difficiles, troquez-le sans plus hésiter contre un extracteur. Vous pourrez ainsi préparer vos jus d\'orange à l\'extracteur de jus et ensoleiller votre petit-déjeuner !', 'https://img.cuisineaz.com/660x660/2018/11/17/i144270-jus-d-orange.webp', NULL, 'facile', 1, 15, 0, 0, 45, 3, NULL, 1),
(7, 'Salade de maïs', 'Salade de maïs facile a faire', 'https://img.cuisineaz.com/660x660/2014/08/18/i22941-salade-de-mais.webp', NULL, 'facile', 1, 15, 0, 0, 78, 1, 1, 1),
(8, 'Gâteau simple au chocolat', 'Vous cherchez une idée de recette pour le goûter ou pour un dessert ? Pourquoi pas un gâteau simple au chocolat ? Qui a dit qu\'une recette sucrée devait absolument être originale pour être appréciée ? Ce bon vieux gâteau au chocolat de notre enfance est un classique indémodable : facile à cuisiner et rapide à faire. Si vous avez ces 6 ingrédients, et quelques minutes devant vous, faites plaisir aux bouches sucrées de votre entourage sans vous prendre la tête ! ', 'https://img.cuisineaz.com/660x660/2013/12/20/i91729-gateau-simple-au-chocolat.webp', 'https://www.cuisineaz.com/57bdbc11-a2c4-43a9-9248-5f214903a7c0', NULL, 1, 10, 0, 30, 501, 4, 1, 0);

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
(7, 1, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`userID`, `email`, `mdp`, `prenom`, `nom`, `dateNaissance`, `sexe`, `state`) VALUES
(1, 'ja_aiteur@esi.dz', '$2y$10$gQ2uwa55lr.e9/HsPZ7eKOJWjpygNDr7bm2sa4wQLgv85DZyXBTfK', 'abdelatif', 'aiteur', '2001-12-15', 'homme', 1);
COMMIT;
