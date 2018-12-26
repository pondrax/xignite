#
# TABLE STRUCTURE FOR: test
#

DROP TABLE IF EXISTS `test`;

CREATE TABLE `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `test` (`id`, `name`, `deleted_at`) VALUES (1, 'data test 1', NULL);
INSERT INTO `test` (`id`, `name`, `deleted_at`) VALUES (2, 'data test 2', NULL);


#
# TABLE STRUCTURE FOR: test__belongsto
#

DROP TABLE IF EXISTS `test__belongsto`;

CREATE TABLE `test__belongsto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test_id` int(11) NOT NULL,
  `belongsname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: test__hasmany
#

DROP TABLE IF EXISTS `test__hasmany`;

CREATE TABLE `test__hasmany` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test_id` int(11) NOT NULL,
  `manyname` varchar(255) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `test__hasmany` (`id`, `test_id`, `manyname`, `deleted_at`) VALUES (1, 1, 'data many 1 a', NULL);
INSERT INTO `test__hasmany` (`id`, `test_id`, `manyname`, `deleted_at`) VALUES (2, 1, 'data many 1 b', NULL);
INSERT INTO `test__hasmany` (`id`, `test_id`, `manyname`, `deleted_at`) VALUES (3, 2, 'data many 2 a', NULL);


#
# TABLE STRUCTURE FOR: test__hasmanypivot
#

DROP TABLE IF EXISTS `test__hasmanypivot`;

CREATE TABLE `test__hasmanypivot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manypivotname` varchar(255) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `test__hasmanypivot` (`id`, `manypivotname`, `deleted_at`) VALUES (1, 'data pivot 1', NULL);
INSERT INTO `test__hasmanypivot` (`id`, `manypivotname`, `deleted_at`) VALUES (2, 'data pivot 2', NULL);


#
# TABLE STRUCTURE FOR: test__hasone
#

DROP TABLE IF EXISTS `test__hasone`;

CREATE TABLE `test__hasone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test_id` int(11) NOT NULL,
  `hasname` varchar(255) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `test__hasone` (`id`, `test_id`, `hasname`, `deleted_at`) VALUES (1, 1, 'data hasone 1', NULL);
INSERT INTO `test__hasone` (`id`, `test_id`, `hasname`, `deleted_at`) VALUES (2, 2, 'data hasone 2', NULL);


#
# TABLE STRUCTURE FOR: test__pivot
#

DROP TABLE IF EXISTS `test__pivot`;

CREATE TABLE `test__pivot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test_id` int(11) NOT NULL,
  `pivot_id` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `test__pivot` (`id`, `test_id`, `pivot_id`, `deleted_at`) VALUES (1, 1, 1, NULL);
INSERT INTO `test__pivot` (`id`, `test_id`, `pivot_id`, `deleted_at`) VALUES (2, 1, 2, NULL);


