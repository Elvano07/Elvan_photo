# Host: localhost  (Version 5.5.5-10.1.21-MariaDB)
# Date: 2017-11-28 12:36:34
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "categories"
#

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

#
# Data for table "categories"
#

INSERT INTO `categories` VALUES (1,'Home'),(2,'Gaya Hidup'),(3,'Kartun'),(4,'Editorial'),(5,'Sains & Tekno'),(6,'Ekonomi'),(7,'Berita'),(8,'Tabik'),(9,'Laporan Khas'),(10,'Bincang'),(11,'Waini'),(12,'Piknik'),(13,'Seni Hiburan'),(14,'Arena'),(15,'Telatah'),(16,'Figur'),(17,'Film Bulan Ini'),(18,'Infografik'),(19,'Otogen'),(20,'Lokadata'),(21,'Uncategorized');

#
# Structure for table "users"
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `fullname` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) DEFAULT NULL,
  `gender` varchar(255) NOT NULL DEFAULT '',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `photo` varchar(100) DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Data for table "users"
#

INSERT INTO `users` VALUES (1,'Elvan','elvanrahmatilahi@gmail.com','$2a$06$eaOS0A9dGGHKpNSHOCAKBOeL2DsdOONY78b.lkOmyR3KjICDgNa1a','Elvan Rahmat Ilahi','Aku adalah anak gembala selalu riang juga gembira, karena aku anak gembala jadinya aku makan rumput. Aku adalah anak gembala selalu riang juga gembira, karena aku anak gembala jadinya aku makan rumput.','Male','SNOYVwpxJIEXfS2Sum1wdtqLkfaaW8TM67lV9r8ui9STpMBs1T76Qd8kbR9f',NULL,'2017-10-03 18:20:38','users/5LpZTSoakuTybx4xrqI0spvS7LK6zlV1WnADKVFE.png'),(2,'Elvano','elvano@yahoo.com','$2a$06$eaOS0A9dGGHKpNSHOCAKBOeL2DsdOONY78b.lkOmyR3KjICDgNa1a','Elvano','Cuma manusia biasa yang suka ngoding dan suka belajar tentang apa aja, ini sebenernya cuma buat menuh-menuhin textnya ajasih udah itu doang','Male','snI8qYRtKuXcoVUyTr2UvmS9djFqIjof25bJzeNIz9IquZP6oMOECJqjUiqW','2017-08-21 22:27:34','2017-08-30 01:30:08','users/5LpZTSoakuTybx4xrqI0spvS7LK6zlV1WnADKVFE.png');

#
# Structure for table "photos"
#

DROP TABLE IF EXISTS `photos`;
CREATE TABLE `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `categories_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `description` mediumtext,
  `filename` varchar(255) NOT NULL DEFAULT '',
  `filelocation` varchar(255) NOT NULL DEFAULT '',
  `download` int(5) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_id` (`categories_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `categories_id` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

#
# Data for table "photos"
#

INSERT INTO `photos` VALUES (6,1,11,'Zebra Fighting','Afrika','zebra, afrika, viral, fighting','Dua ekor zebra yang sedang berkelahi.','grevys-zebra-rolling-dust-dawn-nature-wildlife-photography-james-warwick.jpg','photo/rwUtcX8wvDptbX91jBPZP4xym7m09rXkQO3361DU.jpeg',0,'2017-09-26 14:13:56','2017-09-26 14:13:56',NULL),(7,1,2,'Kamera','Jakarta, Indonesia','kamera, photograpy','Kamera','pexels-photo-226243.jpeg','photo/2606IbXYdGjapheM0LzFdQvpT8MHKG5w3Oop3Nmn.jpeg',0,'2017-08-26 14:14:33','2017-09-26 14:14:33',NULL),(8,1,2,'Drone','Cichago, Amerika','cichago, drone, kamera, remote control','Drone yang saat ini sedang digemari oleh anak-anak muda.','stock-photo-169861971.jpg','photo/mIefJRlFpAcAsNfCozAR6euQ6aZLjDW3J8sdzUhg.jpeg',0,'2017-10-26 14:15:27','2017-09-26 14:15:27',NULL),(9,1,13,'Botol Cinta','Chi Bi, China','china, botol, love, cinta','Botol berhiaskan pita yang sangat cantik.','Mind-Blowing-Love-Photography-HD-Wallpapers-23.jpg','photo/d0YajdG9hVj0fqrxMCzn8dzofs7Ip6o3OWmLusNM.jpeg',0,'2017-11-26 14:16:11','2017-09-26 14:16:11',NULL),(10,1,10,'Elang pembunuh','London, Inggris','elang, pembunuh, berburu','Elang yang sedang ingin menangkap mangsanya.','web_bonnie-block_baldeaglegreat-blue-heron_-professional.jpg','photo/88arU0XObJqIJlKjwYClOhLQawTAl9WoUk8oQwkN.jpeg',0,'2017-07-26 14:16:52','2017-09-26 14:16:52',NULL),(11,1,2,'Pra Wedding','Savanah, Afrika','pernikahan, cinta, prawedding','Foto prawedding yang sangat menarik.','rdobwmb45odatjy8beku.jpg','photo/qlpv2ietaaD7dgCgLHmZSS1ipaEYitlwKXJVtQ76.jpeg',0,'2017-07-26 14:18:49','2017-09-26 14:18:49',NULL),(12,1,18,'Menari','Mexico','dance, menari, beautifull','Tarian yang indah dibawah sang bulan.','d4b4007-2048-jpg-tnfc.jpg','photo/vZGyzgYoGizxyRU257fmuCmWiiwvnVuEVpfwBavs.jpeg',0,'2017-09-26 14:19:29','2017-09-26 14:19:29',NULL),(13,1,15,'Kuda','Saudi Arabi','Kuda, black and white, monochrome','Kuda di dalam hitam putihnya dunia.\nKuda di dalam hitam putihnya dunia.\nKuda di dalam hitam putihnya dunia.\nKuda di dalam hitam putihnya dunia.\nKuda di dalam hitam putihnya dunia.\nKuda di dalam hitam putihnya dunia.\nKuda di dalam hitam putihnya dunia.\nKuda di dalam hitam putihnya dunia.\nKuda di dalam hitam putihnya dunia.\nKuda di dalam hitam putihnya dunia.\nKuda di dalam hitam putihnya dunia.\nKuda di dalam hitam putihnya dunia.\nKuda di dalam hitam putihnya dunia.\nKuda di dalam hitam putihnya dunia.\nKuda di dalam hitam putihnya dunia.\nKuda di dalam hitam putihnya dunia.\nKuda di dalam hitam putihnya dunia.\n','441ab084214ee5cad82026cd134ae190.jpg','photo/YVoKmOjTB0FPPiqzRAl2aiudss0PsMhkxCyyPbuS.jpeg',0,'2016-08-26 14:20:07','2017-09-26 14:20:07',NULL),(14,1,12,'Batu Karang','Anyer, Indonesia','piknik, liburan, anyer, pantai','Pantai yang sangat indah di selatan jawa.','Clifton_Beach_5.jpg','photo/CYtLyj13J4dZUgiLL4FWJF0zPyywyJ8ntrdc4DZs.jpeg',0,'2016-09-26 14:20:49','2017-09-26 14:20:49',NULL);
