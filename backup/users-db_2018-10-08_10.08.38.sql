#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grup_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `grup_id`, `username`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 1, 'admin', 'admin@dlh', '$2y$10$uMY3REeB1lPhqRuJ.Y38.Ol6OKUg6o1GAwsfWcpl.3yXFllJqGYk2', '2018-09-16 02:43:45', '2018-09-18 13:26:03', NULL);
INSERT INTO `users` (`id`, `grup_id`, `username`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 2, 'kaupt', 'kaupt@dlh', '$2y$10$3gSn65smL3dpnonOz08v.u7chRoi8yHcgNNLJqBCJ1OvTMu4Uyp.G', '2018-09-16 02:56:46', '2018-09-18 13:26:08', NULL);
INSERT INTO `users` (`id`, `grup_id`, `username`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 3, 'manajerteknis', 'mteknis@dlh', '$2y$10$3/jyvmUDNizfOf3GSl/oaumcSdQ0KN6Y06/3g.d..M98GGUSo9D.a', '2018-09-16 02:56:46', '2018-09-18 13:26:14', NULL);
INSERT INTO `users` (`id`, `grup_id`, `username`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 4, 'analis', 'analislab@dlh', '$2y$10$O7NoA9khOP/Z7yLsmUU.T.SiRJe7Au.WV7rruzAQhHfXy5X4ebWq6', '2018-09-17 16:36:46', '2018-09-18 15:00:29', NULL);
INSERT INTO `users` (`id`, `grup_id`, `username`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 5, 'penyelia', 'penyelia@dlh.go', '$2y$10$7z5xpzuPWbflu.cc4P6RbefbzQ6iKkSOMFx3E3Z.I.xHPLD9YKUg6', '2018-09-17 16:36:46', '2018-09-18 15:12:36', NULL);
INSERT INTO `users` (`id`, `grup_id`, `username`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 6, 'frontdesk', 'front.desk@dlh.go.id', '$2y$10$ESyyQlC5OuuBItcw13rF9uC4bOT.L5rbLl30i0Hhd/v8/Ep7LLuwG', '2018-09-17 16:37:36', '2018-09-21 11:13:40', NULL);
INSERT INTO `users` (`id`, `grup_id`, `username`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 7, 'pemohon', 'pemohon@dlh.go.id', '$2y$10$6/Gg/3ffGTt0CH9yRBGjxuLLg.lN0e6lv0E.sYVjhkY/rmXXUNM2K', '2018-09-18 15:57:11', '2018-09-21 13:22:05', NULL);
INSERT INTO `users` (`id`, `grup_id`, `username`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES (18, 5, 'wakakak', 'test@email.com', '$2y$10$j9c3OYG3g56U8dmq2wO6iOodB/YedGtNIv6JSHr5xb66zcFDDFFUC', '2018-09-21 13:18:51', '2018-09-21 13:18:51', '2018-09-21 13:21:56');


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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO `users__groups` (`id`, `nama_grup`, `modul_read`, `modul_write`, `modul_delete`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'Super Administrator', '1,2,3,4,5', '1,2,3,4,5', '1,2,3,4,5', NULL, NULL, NULL);
INSERT INTO `users__groups` (`id`, `nama_grup`, `modul_read`, `modul_write`, `modul_delete`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 'Manajer Puncak', '1,2,3,4,5', '1,2,3,4,5', '2,3,4', NULL, NULL, NULL);
INSERT INTO `users__groups` (`id`, `nama_grup`, `modul_read`, `modul_write`, `modul_delete`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 'Manajer Teknis', '', '', '', NULL, NULL, NULL);
INSERT INTO `users__groups` (`id`, `nama_grup`, `modul_read`, `modul_write`, `modul_delete`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 'Analis Laboratorium', '', '', '', NULL, NULL, NULL);
INSERT INTO `users__groups` (`id`, `nama_grup`, `modul_read`, `modul_write`, `modul_delete`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 'Penyelia', '', '', '', NULL, NULL, NULL);
INSERT INTO `users__groups` (`id`, `nama_grup`, `modul_read`, `modul_write`, `modul_delete`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 'Front Office', '', '', '', NULL, NULL, NULL);
INSERT INTO `users__groups` (`id`, `nama_grup`, `modul_read`, `modul_write`, `modul_delete`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 'Pemohon', '', '', '', NULL, NULL, NULL);


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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO `users__modules` (`id`, `nama_modul`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'Users', NULL, NULL, NULL);
INSERT INTO `users__modules` (`id`, `nama_modul`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 'Requests', NULL, NULL, NULL);
INSERT INTO `users__modules` (`id`, `nama_modul`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 'Analyze', NULL, NULL, NULL);
INSERT INTO `users__modules` (`id`, `nama_modul`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 'Master', NULL, NULL, NULL);
INSERT INTO `users__modules` (`id`, `nama_modul`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 'Penyelia', NULL, NULL, NULL);
INSERT INTO `users__modules` (`id`, `nama_modul`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 'Front Office', NULL, NULL, NULL);
INSERT INTO `users__modules` (`id`, `nama_modul`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 'Pemohon', NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: users__workers
#

DROP TABLE IF EXISTS `users__workers`;

CREATE TABLE `users__workers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `akses_modul` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19600204 DEFAULT CHARSET=utf8;

INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (1, '19600203 198603 2 005', 'Dr. Ir. DIAH SUSILOWATI, MT', 'KEPALA DINAS LINGKUNGAN HIDUP', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (2, '19611220 198608 1 001', 'Drs. Ec. SUHARYONO BASUKI, MM', 'KEPALA UPT LABORATORIUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (3, '19640621 198903 2 009', 'Dra. S. PURWATININGSIH, MT', 'KASIE PELAYANAN TEKNIS LABORATORIUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (4, '19720523 199803 1 007 ', 'HARIS WAHYUDI, MM', 'KASIE PENGEMBANGAN LABORATORIUM & PEMANTAUAN', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (5, '19711209 199803 2 007', 'IDA YOELIANTI, S.Sos', 'KASUBAG TATA USAHA', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (6, '19680808 199403 2 016', 'Dra.AGUSTINA TRI HENDRIATI, MM', 'PENGELOLA PENGADUAN PUBLIK', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (7, '19770312 199803 2 002', 'IKE DWI LUKYANAWATI, S.Sos, MM', 'PENGADMINISTRASI UMUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (8, '19830315 200901 2 009', 'MUFNAITI PRIHATINI, ST, MT', 'PENGENDALI DAMPAK LINGKUNGAN', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (9, '19810806 201001 2 009', 'FONI FITRI KARDIANA, ST', 'PENGENDALI DAMPAK LINGKUNGAN', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (10, '19770902 201001 2 003', 'QOULIN ADINNE, SE', 'BENDAHARA PENGELUARAN', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (11, '19870312 201101 2 023', 'VITA SIRVIA PISCAWATI, S.Si', 'BENDAHARA PENERIMAAN', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (12, '19890912 201403 2 003', 'SEPTHIA DWI SUKARTININGRUM, S.Si', 'PRANATA LABORATORIUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (13, '19721003 200801 1 009', 'PANCA ROMI PRAHASTO', 'ANALIS LABORATORIUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (14, '19730606 2 00801 1 008', 'RIMAN', 'PENGADMINISTRASI UMUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (15, '19710928 200901 1 002', 'TOTOK MUDJIJANTO', 'ANALIS LABORATORIUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (16, '19670225 200701 1 016', 'ABDUL MU\'IN', 'ANALIS LABORATORIUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (17, '19860619 201001 2 002', 'FATMA DWI SAFITRI, ST', 'ANALIS LABORATORIUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (18, '19950830 201503 1 001', 'ALRIDHO ADE ARIYANTO', 'ANALIS LABORATORIUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (19, '19950928 201503 2 001', 'SITI ANISA', 'ANALIS LABORATORIUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (20, '196909612 200701 1 028', 'SUYADI', 'PENGADMINISTRASI UMUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (21, '', 'WAHYU NUGROHO', 'ANALIS LABORATORIUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (22, '', 'SHINTA DEWI', 'ANALIS LABORATORIUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (23, '', 'ANTIK SEPDIAN SARI', 'ANALIS LABORATORIUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (24, '', 'HADI PURWANTO, SIP', 'PENGADMINISTRASI UMUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (25, '', 'DIMAS AGENG SUTRISNO, SSi', 'ANALIS LABORATORIUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (26, '', 'HAYAT TULLOH HUSAINI', 'ANALIS LABORATORIUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (27, '', 'IRZA FAROBI NURDIANSYAH', 'ANALIS LABORATORIUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (28, '', 'DANIAR KUSUMA SARI', 'ANALIS LABORATORIUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (29, '', 'M. SYAFII', 'ANALIS LABORATORIUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (30, '', 'SEFTIANI YUSNIA, S.Si', 'ANALIS LABORATORIUM', 0);
INSERT INTO `users__workers` (`id`, `nip`, `nama`, `jabatan`, `akses_modul`) VALUES (31, '', 'DANDI PRADANA', 'PENGADMINISTRASI UMUM', 0);


