#
# TABLE STRUCTURE FOR: media
#

DROP TABLE IF EXISTS `media`;

CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_grup` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `id_grup`, `username`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 1, 'admin', 'admin@xigni.te', '$2y$10$uMY3REeB1lPhqRuJ.Y38.Ol6OKUg6o1GAwsfWcpl.3yXFllJqGYk2', '2018-09-16 02:43:45', '2018-09-18 13:26:03', NULL);


#
# TABLE STRUCTURE FOR: users__groups
#

DROP TABLE IF EXISTS `users__groups`;

CREATE TABLE `users__groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_grup` varchar(255) NOT NULL,
  `modul_read` varchar(255) NOT NULL,
  `modul_write` varchar(255) NOT NULL,
  `modul_delete` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `users__groups` (`id`, `nama_grup`, `modul_read`, `modul_write`, `modul_delete`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'Administrator', '1,2,3,4,5', '1,2,3,4,5', '1,2,3,4,5', NULL, '2019-01-07 03:16:07', NULL);
INSERT INTO `users__groups` (`id`, `nama_grup`, `modul_read`, `modul_write`, `modul_delete`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 'Officer', '1,2,3,4,5', '1,2,3,4,5', '2,3,4', NULL, '2019-01-07 05:20:02', NULL);


#
# TABLE STRUCTURE FOR: users__groups_modules
#

DROP TABLE IF EXISTS `users__groups_modules`;

CREATE TABLE `users__groups_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_grup` varchar(255) NOT NULL,
  `modul_read` varchar(255) NOT NULL,
  `modul_write` varchar(255) NOT NULL,
  `modul_delete` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `users__groups_modules` (`id`, `nama_grup`, `modul_read`, `modul_write`, `modul_delete`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'Administrator', '1,2,3,4,5', '1,2,3,4,5', '1,2,3,4,5', NULL, '2019-01-07 03:16:07', NULL);
INSERT INTO `users__groups_modules` (`id`, `nama_grup`, `modul_read`, `modul_write`, `modul_delete`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 'Officer', '1,2,3,4,5', '1,2,3,4,5', '2,3,4', NULL, '2019-01-07 05:20:02', NULL);


#
# TABLE STRUCTURE FOR: users__modules
#

DROP TABLE IF EXISTS `users__modules`;

CREATE TABLE `users__modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_modul` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `users__modules` (`id`, `nama_modul`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'Users', NULL, NULL, NULL);
INSERT INTO `users__modules` (`id`, `nama_modul`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 'media', NULL, NULL, NULL);
INSERT INTO `users__modules` (`id`, `nama_modul`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 'master', NULL, NULL, NULL);


