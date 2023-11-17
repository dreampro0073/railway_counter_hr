<?php 

// Devendra 02Nov2023

CREATE TABLE `r_hos`.`sitting_entries` ( `id` INT NOT NULL AUTO_INCREMENT , `unique_id` INT NULL DEFAULT NULL , `name` VARCHAR(255) NULL DEFAULT NULL , `pnr_uid` VARCHAR(20) NULL DEFAULT NULL , `mobile_no` VARCHAR(20) NULL DEFAULT NULL , `train_no` VARCHAR(20) NULL DEFAULT NULL , `address` VARCHAR(255) NULL DEFAULT NULL , `no_of_adults` INT NULL DEFAULT '0' , `no_of_children` INT NOT NULL DEFAULT '0' , `no_of_baby_staff` INT NOT NULL DEFAULT '0' , `seat_no` VARCHAR(10) NULL DEFAULT NULL , `check_in` TIMESTAMP NULL DEFAULT NULL , `check_out` TIMESTAMP NULL DEFAULT NULL , `hours_occ` INT NOT NULL DEFAULT '0' , `paid_amount` VARCHAR(20) NULL DEFAULT NULL , `pay_type` TINYINT(1) NULL DEFAULT NULL , `remarks` VARCHAR(255) NULL DEFAULT NULL , `status` TINYINT(1) NULL DEFAULT '0' , `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `created_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `sitting_entries` ADD `shift` VARCHAR(10) NULL DEFAULT NULL AFTER `remarks`;

ALTER TABLE `sitting_entries` ADD `date` DATE NULL DEFAULT NULL AFTER `seat_no`;

ALTER TABLE `massage_entries` ADD `name` VARCHAR(255) NULL DEFAULT NULL AFTER `unique_id`;

ALTER TABLE `massage_entries` ADD `time_period` INT NOT NULL DEFAULT '0' AFTER `pay_type`;

?>