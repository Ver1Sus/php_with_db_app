INSERT INTO `Inspector` (`inspector_id`,`first_name`,`last_name`) VALUES (1, "Иван", "Иванов"), (2, "Александр", "Романов"),(3, "Сергей", "Сидоров"),(4, "Кирилл", "Петров"),(5, "Василий", "Карпов");
INSERT INTO `Transport` (`id_transp`,`number`,`marka`) VALUES (7, "в992км", "BMW"), (8, "т678ло", "TOYOTA"), (9, "щ890рг", "OPEL"),(10, "ч567ло", "MAZDA"),(11, "ть098нг", "NISSAN");
INSERT INTO `Uchastniki`(`id_uchastnika`,`first_name`,`last_name`) VALUES (90, "Павел","Петрушин"),(54, "Мария","Калугина"),(12, "Егор","Кузнецов"),(78, "Никита","Николаев"),			(67, "Владимир","Ёжиков");

INSERT INTO `Svedenia_DTP`(`dtp_id`,`data_dtp`,`time`,`mesto`,`inspector_id`) VALUES (78, "2012-01-11", "12:23:50", "г.Екатеринбург, ул.Бебеля 53", 5), (53, "2014-11-23", "14:45:23", "г.Екатеринбург, ул.Ленина 1", 1), (47, "2014-10-14", "15:43:34", "г.Екатеринбург, ул.Крауля 69", 3),(62, "2012-05-30", "16:55:16", "г.Екатеринбург, ул.Горького 78",4),(35, "2012-08-25", "18:26:10", "г.Екатеринбург, ул.Попова 56",2);

INSERT INTO `Svideteli`(`id_svideteley`,`first_name`,`last_name`) VALUES (32, "Дарья", "Зорина"),(33, "Егор", "Бухаров"),(34, "Максим", "Устенко"),(35, "Михаил", "Прохоров"),(36, "Иван", "Тарасов");


INSERT INTO `Postradavshie`( `id_postradavshego`,`first_name`,`last_name`) VALUES (90, "Павел","Петрушин"),(54, "Мария","Калугина"),(12, "Ольга","Дмитриева"),(78, "Никита","Николаев"),(67, "Юлия","Петрова");
INSERT INTO `Transport_DTP` (`id_transp`, `dtp_id`) VALUES (7, 78), (11, 62), (10, 35),(9, 47),(9, 62);

INSERT INTO `Uchastniki_DTP` (`id_uchastnika`, `dtp_id`) VALUES (90, 53), (54, 62),(12, 35),(67, 47),(78, 62);
INSERT INTO `Svideteli_DTP` (`id_svideteley`, `dtp_id`) VALUES (36, 53), (35, 62),(33, 35),(34, 47),(32, 62);
INSERT INTO `Postradavshie_DTP` (`id_postradavshego`, `dtp_id`) VALUES (90, 53), (54, 62),(12, 35),	   (78, 47),(67, 62);

insert into `users` values ("root", "f77aafa695beecd3b9344a98d1116222");


