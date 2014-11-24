CREATE TABLE `languages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `language_name` VARCHAR(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` TINYINT(1) DEFAULT '1',
  `created` DATETIME DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified` DATETIME DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `villages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `village_name` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` TINYINT(1) DEFAULT '1',
  `created` DATETIME DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified` DATETIME DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `blood_groups` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
  `blood_group_name` CHAR(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` TINYINT(1) DEFAULT '1',
  `created` DATETIME DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified` DATETIME DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `countries` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `country_name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` TINYINT(1) DEFAULT '1',
  `created` DATETIME DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified` DATETIME DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `country_name` (`country_name`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `states` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `state_name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` INT(11) NOT NULL,
  `active` TINYINT(1) DEFAULT '1',
  `created` DATETIME DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified` DATETIME DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `state_name` (`state_name`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `districts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `district_name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `state_id` INT(11) NOT NULL,
  `active` TINYINT(1) DEFAULT '1',
  `created` DATETIME DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified` DATETIME DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`district_name`),
  UNIQUE KEY `district_name` (`district_name`,`state_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `cities` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `city_name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `district_id` INT(11) NOT NULL,
  `active` TINYINT(1) DEFAULT '1',
  `created` DATETIME DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified` DATETIME DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `city_name` (`city_name`,`district_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `educations` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `education_name` VARCHAR(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` TINYINT(1) DEFAULT '1',
  `created` DATETIME DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified` DATETIME DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `people_addresses` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `no_of_rooms` INT(11) DEFAULT NULL,
  `ownership_type` ENUM('1','2','3','4') COLLATE utf8_unicode_ci NOT NULL DEFAULT '4' COMMENT 'Ownership, Rental, Pagadi, Other',
  `wing` VARCHAR(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `room_no` VARCHAR(50) DEFAULT NULL,
  `building` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plot_no` VARCHAR(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address1` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `road` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cross_road` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `landmark` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suburb` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` SMALLINT(6) NOT NULL,
  `state_id` SMALLINT(6) DEFAULT NULL,
  `district_id` SMALLINT(6) DEFAULT NULL,
  `city_id` SMALLINT(6) DEFAULT NULL,
  `pincode` INT(11) DEFAULT NULL,
  `std_code` VARCHAR(10) COLLATE utf8_unicode_ci NOT NULL,
  `phone1` INT(11) NOT NULL,
  `phone2` INT(11) DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `created_date` DATETIME DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  `modified_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `translations` (
  `id` INT(11) NOT NULL,
  `language_id` INT(11) NOT NULL,
  `translated_text` VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL,
  `active` TINYINT(1) DEFAULT '1',
  `created_by` INT(11) DEFAULT NULL,
  `created_date` DATETIME DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  `modified_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`language_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `people` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `group_id` INT(11) DEFAULT NULL,
  `late` TINYINT(1) DEFAULT '0',
  `title` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maiden_surname` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father` INT(11) DEFAULT '0',
  `husband` INT(11) DEFAULT '0',
  `wife` INT(11) DEFAULT '0',
  `mother` INT(11) DEFAULT '0',
  `x_partner` INT(11) DEFAULT '0',
  `gender` ENUM('Male','Female') COLLATE utf8_unicode_ci DEFAULT NULL,
  `village_id` INT(11) DEFAULT NULL,
  `maiden_village_id` INT(11) DEFAULT NULL,
  `fario` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mahajan_membership_number` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` DATE DEFAULT NULL,
  `mobile` BIGINT(20) DEFAULT NULL,
  `marriage_status` ENUM('1','2','3','4','5') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '1=>Married,2=>Unmarried,3=>Divorced,4=>Widow(er),5=>Separated',
  `marriage_date` DATE DEFAULT NULL,
  `education_id` INT(11) DEFAULT NULL,
  `blood_group` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email1` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email2` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `occupation` VARCHAR(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_of_business_id` INT(11) DEFAULT NULL,
  `business_name` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `people_business_address_id` INT(11) NOT NULL,
  `people_address_id` INT(11) NOT NULL,
  `sect` ENUM('1','2','3') COLLATE utf8_unicode_ci NOT NULL DEFAULT '3' COMMENT 'Deravasi, Sthanakvasi, Other',
  `main_surname` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` TINYINT(1) DEFAULT '1',
  `created_by` INT(11) DEFAULT NULL,
  `created_date` DATETIME DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  `modified_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
