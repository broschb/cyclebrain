ALTER TABLE `cycleBrainDev`.`user_ride_map` ADD COLUMN `elevation` DECIMAL(18,14)  DEFAULT NULL AFTER `long`;
ALTER TABLE `cyclebraindev`.`user_stats` ADD COLUMN `mileage` DECIMAL(10,2) DEFAULT NULL AFTER `bike_id`;
update user_stats s set mileage = (select mileage from user_rides where user_ride_id=s.ride_key);