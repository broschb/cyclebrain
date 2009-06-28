
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- cp_cities
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `cp_cities`;


CREATE TABLE `cp_cities`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`state_id` INTEGER(11)  NOT NULL,
	`name` VARCHAR(100)  NOT NULL,
	`latitude` DECIMAL(18,14),
	`longitude` DECIMAL(18,14),
	PRIMARY KEY (`id`),
	KEY `cp_cities_FI_1`(`state_id`),
	CONSTRAINT `cp_cities_FK_1`
		FOREIGN KEY (`state_id`)
		REFERENCES `cp_states` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- cp_countries
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `cp_countries`;


CREATE TABLE `cp_countries`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`code` VARCHAR(2)  NOT NULL,
	`name` VARCHAR(100)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- cp_states
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `cp_states`;


CREATE TABLE `cp_states`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`country_id` INTEGER(11)  NOT NULL,
	`name` VARCHAR(100)  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `cp_states_FI_1`(`country_id`),
	CONSTRAINT `cp_states_FK_1`
		FOREIGN KEY (`country_id`)
		REFERENCES `cp_countries` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- equip_function
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `equip_function`;


CREATE TABLE `equip_function`
(
	`function_id` INTEGER(10)  NOT NULL AUTO_INCREMENT,
	`function_name` VARCHAR(45)  NOT NULL,
	PRIMARY KEY (`function_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rides
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rides`;


CREATE TABLE `rides`
(
	`ride_key` INTEGER(10)  NOT NULL AUTO_INCREMENT,
	`ride_name` VARCHAR(45)  NOT NULL,
	PRIMARY KEY (`ride_key`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user_bikes
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_bikes`;


CREATE TABLE `user_bikes`
(
	`user_id` INTEGER(10)  NOT NULL,
	`user_bike_id` INTEGER(10)  NOT NULL AUTO_INCREMENT,
	`bike_year` INTEGER(10),
	`bike_make` VARCHAR(45),
	`bike_model` VARCHAR(45),
	`equip_function` INTEGER(10)  NOT NULL,
	`description` VARCHAR(40)  NOT NULL,
	PRIMARY KEY (`user_bike_id`),
	KEY `FK_user_bikes_1`(`user_id`),
	CONSTRAINT `user_bikes_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `users` (`user_id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user_equipement
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_equipement`;


CREATE TABLE `user_equipement`
(
	`user_id` INTEGER(10)  NOT NULL,
	`equipment_id` INTEGER(10)  NOT NULL AUTO_INCREMENT,
	`description` VARCHAR(45)  NOT NULL,
	`bike_id` INTEGER(10),
	`equip_function` INTEGER(10)  NOT NULL,
	`purchase_price` DECIMAL(10,2) default 0.00 NOT NULL,
	`purchase_date` DATE,
	`make` VARCHAR(50),
	`model` VARCHAR(50),
	PRIMARY KEY (`equipment_id`),
	KEY `FK_user_equipement_1`(`user_id`),
	KEY `FK_user_equipement_2`(`bike_id`),
	CONSTRAINT `user_equipement_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `users` (`user_id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `user_equipement_FK_2`
		FOREIGN KEY (`bike_id`)
		REFERENCES `user_bikes` (`user_bike_id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user_information
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_information`;


CREATE TABLE `user_information`
(
	`user_id` INTEGER(10) default 0 NOT NULL,
	`user_birthdate` DATETIME  NOT NULL,
	`user_weight` INTEGER(10)  NOT NULL,
	`user_height` INTEGER(10)  NOT NULL,
	PRIMARY KEY (`user_id`),
	CONSTRAINT `user_information_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `users` (`user_id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user_profile
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_profile`;


CREATE TABLE `user_profile`
(
	`user_id` INTEGER(10) default 0 NOT NULL,
	`birthdate` DATETIME,
	`country` INTEGER(11),
	`state` INTEGER(11),
	`city` INTEGER(11),
	`zip` INTEGER(11),
	`miles` TINYINT(1) default 1 NOT NULL,
	`weight` INTEGER(11),
	`height` INTEGER(11),
	PRIMARY KEY (`user_id`),
	KEY `countryFk`(`country`),
	KEY `stateFk`(`state`),
	KEY `cityFk`(`city`),
	CONSTRAINT `user_profile_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `users` (`user_id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `user_profile_FK_2`
		FOREIGN KEY (`country`)
		REFERENCES `cp_countries` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `user_profile_FK_3`
		FOREIGN KEY (`state`)
		REFERENCES `cp_states` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `user_profile_FK_4`
		FOREIGN KEY (`city`)
		REFERENCES `cp_cities` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user_ride_map
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_ride_map`;


CREATE TABLE `user_ride_map`
(
	`user_ride_id` INTEGER(10)  NOT NULL,
	`coord_order` INTEGER(11)  NOT NULL,
	`lat` DECIMAL(18,14),
	`long` DECIMAL(18,14),
	`elevation` DECIMAL(18,14),
	PRIMARY KEY (`user_ride_id`,`coord_order`),
	CONSTRAINT `user_ride_map_FK_1`
		FOREIGN KEY (`user_ride_id`)
		REFERENCES `user_rides` (`user_ride_id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user_rides
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_rides`;


CREATE TABLE `user_rides`
(
	`user_ride_id` INTEGER(10)  NOT NULL AUTO_INCREMENT,
	`ride_id` INTEGER(10)  NOT NULL,
	`user_id` INTEGER(10)  NOT NULL,
	`description` VARCHAR(45)  NOT NULL,
	`mileage` DECIMAL(10,2) default 0.00 NOT NULL,
	`altitude_gain` DECIMAL(10,2) default 0.00 NOT NULL,
	PRIMARY KEY (`user_ride_id`),
	KEY `FK_user_rides_1`(`ride_id`),
	KEY `FK_user_rides_2`(`user_id`),
	CONSTRAINT `user_rides_FK_1`
		FOREIGN KEY (`ride_id`)
		REFERENCES `rides` (`ride_key`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `user_rides_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `users` (`user_id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user_stat_equip
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_stat_equip`;


CREATE TABLE `user_stat_equip`
(
	`user_stat_equip_id` INTEGER(10)  NOT NULL AUTO_INCREMENT,
	`user_stat_id` INTEGER(10)  NOT NULL,
	`user_equip_id` INTEGER(10)  NOT NULL,
	PRIMARY KEY (`user_stat_equip_id`),
	KEY `FK_user_stat_equip_1`(`user_stat_id`),
	KEY `FK_user_stat_equip_2`(`user_equip_id`),
	CONSTRAINT `user_stat_equip_FK_1`
		FOREIGN KEY (`user_stat_id`)
		REFERENCES `user_stats` (`stat_no`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `user_stat_equip_FK_2`
		FOREIGN KEY (`user_equip_id`)
		REFERENCES `user_equipement` (`equipment_id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user_stats
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_stats`;


CREATE TABLE `user_stats`
(
	`user_id` INTEGER(10)  NOT NULL,
	`ride_date` DATETIME  NOT NULL,
	`ride_time` DECIMAL(10,2) default 0.00 NOT NULL,
	`avg_speed` DECIMAL(10,2) default 0.00 NOT NULL,
	`calories_burned` DECIMAL(10,0) default 0 NOT NULL,
	`stat_no` INTEGER(10)  NOT NULL AUTO_INCREMENT,
	`ride_key` INTEGER(10)  NOT NULL,
	`bike_id` INTEGER(10)  NOT NULL,
	`mileage` DECIMAL(10,2),
	PRIMARY KEY (`stat_no`),
	KEY `FK_user_stats_1`(`ride_key`),
	KEY `FK_bike_id_constraint`(`bike_id`),
	CONSTRAINT `user_stats_FK_1`
		FOREIGN KEY (`ride_key`)
		REFERENCES `user_rides` (`user_ride_id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `user_stats_FK_2`
		FOREIGN KEY (`bike_id`)
		REFERENCES `user_bikes` (`user_bike_id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- users
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `users`;


CREATE TABLE `users`
(
	`username` VARCHAR(15)  NOT NULL,
	`password` VARCHAR(40)  NOT NULL,
	`fname` VARCHAR(45)  NOT NULL,
	`lname` VARCHAR(45)  NOT NULL,
	`email` VARCHAR(45)  NOT NULL,
	`user_id` INTEGER(10)  NOT NULL AUTO_INCREMENT,
	`salt` VARCHAR(32)  NOT NULL,
	`active` VARCHAR(1) default 'N' NOT NULL,
	`join_date` DATETIME  NOT NULL,
	PRIMARY KEY (`user_id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
