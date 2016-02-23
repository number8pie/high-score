CREATE DATABASE high_score DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE high_score;

CREATE TABLE IF NOT EXISTS `guitar_wars` (
  `id` INT AUTO_INCREMENT,
  `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `name` VARCHAR(32),
  `score` INT,
  `screenshot` VARCHAR(64),
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `guitar_wars` VALUES (1, '2008-04-22 14:37:34', 'Paco Jastorius', 127650, 'pacosscore.gif');
INSERT INTO `guitar_wars` VALUES (2, '2008-04-22 21:27:54', 'Nevil Johansson', 98430, 'nevilsscore.gif');
INSERT INTO `guitar_wars` VALUES (4, '2008-04-23 09:12:53', 'Belita Chevy', 282470, 'belitasscore.gif');
INSERT INTO `guitar_wars` VALUES (6, '2008-04-23 14:09:50', 'Kenny Lavitz', 64930, 'kennysscore.gif');
INSERT INTO `guitar_wars` VALUES (7, '2008-04-24 08:13:52', 'Phiz Lairston', 186580, 'phizsscore.gif');
INSERT INTO `guitar_wars` VALUES (8, '2008-04-25 07:22:19', 'Jean Paul Jones', 243260, 'jeanpaulsscore.gif');
INSERT INTO `guitar_wars` VALUES (9, '2008-04-25 11:49:23', 'Jacob Scorcherson', 389740, 'jacobsscore.gif');