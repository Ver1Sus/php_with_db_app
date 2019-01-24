create database Moiseeva character set  utf8 collate utf8_general_ci;
use Moiseeva;
create table `Inspector` (
				`inspector_id` smallint unsigned primary key,
				`first_name` varchar(10),
				`last_name` varchar(10)
				);

create table `Transport` (`id_transp` smallint unsigned primary key,`number` varchar(10),`marka` varchar(10));
create table `Uchastniki` (`id_uchastnika` smallint unsigned primary key,`first_name` varchar(10),`last_name` varchar(10));
create table `Svedenia_DTP` (`dtp_id` smallint unsigned primary key,`data_dtp` date not null,`time` time, `mesto` varchar(40), `inspector_id` smallint unsigned, constraint fk_in foreign key(`inspector_id`) references `Inspector`(`inspector_id`) on update cascade on delete cascade);
create table `Svideteli` (`id_svideteley` smallint unsigned primary key, `first_name` varchar(10), `last_name` varchar(10) );
create table `Postradavshie` ( `id_postradavshego` smallint unsigned primary key, `first_name` varchar(10), `last_name` varchar(10) );
create table `Transport_DTP` (IDT int auto_increment,`id_transp` smallint unsigned,`dtp_id` smallint unsigned, constraint pk_IDT primary key(IDT), constraint foreign key(`id_transp`) references `Transport`(`id_transp`), constraint foreign key(`dtp_id`) references `Svedenia_DTP`(`dtp_id`));
create table `Uchastniki_DTP` (IDU int auto_increment, `id_uchastnika` smallint unsigned, `dtp_id` smallint unsigned,constraint pk_IDU primary key(IDU),constraint foreign key(`id_uchastnika`) references `Uchastniki`(`id_uchastnika`),constraint foreign key(`dtp_id`) references `Svedenia_DTP`(`dtp_id`));
create table `Svideteli_DTP` (IDS int auto_increment,`id_svideteley` smallint unsigned,`dtp_id` smallint unsigned,constraint pk_IDS primary key(IDS),constraint foreign key(`id_svideteley`) references `Svideteli`(`id_svideteley`),constraint foreign key(`dtp_id`) references `Svedenia_DTP`(`dtp_id`)
			);
create table `Postradavshie_DTP` (
			IDP int auto_increment,
			 `id_postradavshego` smallint unsigned,
			 `dtp_id` smallint unsigned,
			  constraint pk_IDP primary key(IDP),
			  constraint foreign key(`id_postradavshego`) references `Postradavshie`(`id_postradavshego`),
			  constraint foreign key(`dtp_id`) references `Svedenia_DTP`(`dtp_id`)
			
			);

CREATE TABLE `users` (`user_login` varchar(30) NOT NULL, `user_password` varchar(32) NOT NULL);

