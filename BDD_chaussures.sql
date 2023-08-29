-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 28 août 2023 à 07:46
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `chaussures`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `adresse` text NOT NULL,
  `complement` varchar(50) NOT NULL,
  `cp` varchar(20) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenom`, `tel`, `adresse`, `complement`, `cp`, `ville`, `user_id`) VALUES
(1, 'Durot', 'Logan', '0202020202', '1 avenue de la Nationale', 'appt 12', '75100', 'Paris', 1),
(4, 'DELPLACE', 'Alexis', '0666666666', '1 rue de la gouttière', '16e arrondissement', '75100', 'Paris', 12),
(5, '', '', '', '', '', '', '', 11);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `sujet` varchar(50) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `total_price` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `brand` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `color` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `ref` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `category`, `type`, `img`, `brand`, `name`, `color`, `price`, `ref`, `description`) VALUES
(1, 'FEMME', 'Baskets', 'img1.jpg', 'PUMA', 'Rebound V6', 'Gris', 64, 'SWYCFNB87M', 'Inspirée du basketball, la Rebound Low est de retour pour changer les règles. La V6 offre une coupe basse des plus agréables, pour un port quotidien sur et en dehors des parquets, un aspect cuir souple et tambouriné sur l\'empeigne, et un branding PUMA en couleur pour plus d\'impact.'),
(4, 'FEMME', 'Bottes', 'img4.jpg', 'MyB', 'Cuissardes', 'Noir', 50, 'CKEOQ7W10N', '- Type de fermeture Fermeture éclair\r\n- Type de talon Carré\r\n- Bout de la chaussure Rond\r\n- Matière dessus : Textile\r\n- Hauteur de talon 7 cm'),
(5, 'FEMME', 'Escarpins', 'img8.jpg', 'MyB', 'Escarpins', 'Noir', 30, '9UW4P6SQA3', 'Pour sublimer vos soirées festives, optez pour cet escarpin noir verni, chic et glamour ! Il est perché sur un talon aiguille métallisé de 11 cm, pour élancer votre silhouette tout en finesse ! Le bout pointu finalise le look élégant de cette chaussure féminine par excellence !\r\n\r\n- Type de fermeture  : A enfiler\r\n- Type de talon : Aiguille\r\n- Bout de la chaussure : Pointu\r\n- Matière dessus : Synthétique\r\n- Hauteur de talon : 11 cm'),
(6, 'HOMME', 'Baskets', 'img3.jpg', 'FILA', 'Levanto Mid', 'Blanc', 60, 'RNQRWW5F6J', '- Type de fermeture : Lacets\r\n- Matière dessus Synthétique'),
(7, 'HOMME', 'Bottes', 'img5.jpg', 'B-BLAKE', 'Bottines', 'Noir', 40, '6I8SD29BE3', ''),
(8, 'HOMME', 'Bottes', 'img7.jpg', 'Denim', 'Bottines', 'Noir', 40, '6ACC3I5VUU', ''),
(9, 'ENFANT', 'Baskets', 'img2.jpg', 'Airness', 'Ville', 'Noir', 28, 'ZRC0GBERUY', ''),
(10, 'ENFANT', 'Bottes', 'img6.jpg', 'Lovely Skull', 'Bottines', 'Noir', 25, '9CXL0D3IEZ', ''),
(11, 'ENFANT', 'Bottes', 'img9.jpg', 'SpiderMan', 'Bottes de pluie', 'Marine', 16, 'HWE13OVLNU', ''),
(12, 'FEMME', 'Escarpins', 'img10.jpg', 'MyB', 'Escarpins', 'Rouge', 30, 'X28N2ZJ689', ''),
(13, 'HOMME', 'Chaussons', 'img11.jpg', 'Freecoder', 'Chaussons', 'Noir', 15, 'M9D9PI79PE', ''),
(14, 'ENFANT', 'Baskets', 'img12.jpg', 'Puma', 'Rebound Layup', 'Noir et Blanc', 40, 'LTPY5ZP9SO', ''),
(15, 'ENFANT', 'Baskets', 'img13.jpg', 'Puma', 'Rebound Lo', 'Blanc', 50, '28K2FET6R9', ''),
(16, 'FEMME', 'Baskets', 'img14.jpg', 'Puma', 'Rebound V6', 'Noir', 65, 'BJEMLRS0G9', ''),
(17, 'HOMME', 'Baskets', 'img15.jpg', 'Unyk', 'Sportswear', 'Noir', 30, 'DMZDW688V2', ''),
(18, 'ENFANT', 'Baskets', 'img16.jpg', 'Puma', 'Smash V2 Glitz', 'Rose', 45, 'I3MW2E6QVV', ''),
(19, 'FEMME', 'Sandales', 'img17.jpg', 'Philov', 'Beachlife', 'Blanc', 15, '029TBENLOF', ''),
(20, 'HOMME', 'Derbies', 'img18.jpg', 'M.Rossi', 'Wedding Day', 'Noir', 55, 'IV7B7WIJCZ', '');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `mdp` varchar(150) NOT NULL,
  `role` varchar(15) NOT NULL,
  `isVerified` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `mdp`, `role`, `isVerified`) VALUES
(1, 'Logan', '$2y$10$oaQa6.Zl3Ruic3RD8U0He.MvnBAZUhbk510Y2Bx6D5IsCD87PwPVC', 'ADMIN', 0),
(11, 'Matito', '$2y$10$4yJDJxEKA8Y2C6hoFZySsefi59yZL2fkzUvcxMSo/6KWGA7vDoL9y', 'USER', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
