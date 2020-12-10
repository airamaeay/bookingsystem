CREATE TABLE IF NOT EXISTS `providers` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `account_type` INT NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `first_name` INT NOT NULL,
    `last_name` INT NOT NULL,
    `phone_number` INT NOT NULL,
    `primary_category_id` INT NOT NULL,
    `modified` DATETIME NOT NULL,
    `created` DATETIME NOT NULL
);
CREATE TABLE IF NOT EXISTS `passwords`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `password` VARCHAR(255) NOT NULL,
    `user` INT NOT NULL,
    `user_type` INT NOT NULL,
    `created` DATETIME NOT NULL
);
CREATE TABLE IF NOT EXISTS `user_types`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_type` VARCHAR(50) NOT NULL,
);
CREATE TABLE IF NOT EXISTS `companies`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `company` VARCHAR(255) NOT NULL,
    `modified` DATETIME NOT NULL,
    `created` DATETIME NOT NULL
);
CREATE TABLE IF NOT EXISTS `account_types`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `account_type` VARCHAR(255) NOT NULL,
    `modified` DATETIME NOT NULL,
    `created` DATETIME NOT NULL,
    `created_by` INT NOT NULL,
    `deleted` DATETIME NOT NULL,
    `deleted_by` INT NOT NULL
);
CREATE TABLE IF NOT EXISTS `categories`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `category` INT NOT NULL,
    `photo` INT NOT NULL,
    `created` DATETIME NOT NULL,
    `created_by` INT NOT NULL,
    `deleted` DATETIME NULL,
    `deleted_by` INT NULL
);
CREATE TABLE IF NOT EXISTS `staffs`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `access_type` INT NOT NULL,
    `modified` DATETIME NOT NULL,
    `created` DATETIME NOT NULL
);
CREATE TABLE IF NOT EXISTS `access_types`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `access_type` VARCHAR(255) NOT NULL
);
CREATE TABLE IF NOT EXISTS `consumers`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `phone_number` INT NOT NULL,
    `email` INT NOT NULL,
    `password` INT NOT NULL,
    `modified` DATETIME NOT NULL,
    `created` DATETIME NOT NULL
);
CREATE TABLE IF NOT EXISTS `phone_numbers`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `phone_number` INT NOT NULL,
    `modified` DATETIME NOT NULL,
    `created` DATETIME NOT NULL
);
CREATE TABLE IF NOT EXISTS `emails`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL,
    `modified` DATETIME NOT NULL,
    `created` DATETIME NOT NULL
);
CREATE TABLE IF NOT EXISTS `modules`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `module` VARCHAR(255) NOT NULL,
    `modified` DATETIME NOT NULL,
    `created` DATETIME NOT NULL
);
CREATE TABLE IF NOT EXISTS `actions`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `create` INT NOT NULL,
    `read` INT NOT NULL,
    `update` INT NOT NULL,
    `delete` INT NOT NULL,
    `modified` DATETIME NOT NULL,
    `created` DATETIME NOT NULL
);
CREATE TABLE IF NOT EXISTS `categories_category_history`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `category` VARCHAR(255) NOT NULL,
    `created` DATETIME NOT NULL,
    `created_by` INT NOT NULL
);
CREATE TABLE IF NOT EXISTS `accessed_modules`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `access_type` INT NOT NULL,
    `module` INT NOT NULL,
    `actions` INT NOT NULL,
    `modified` DATETIME NOT NULL,
    `created` DATETIME NOT NULL
);
CREATE TABLE IF NOT EXISTS `categories_photo_history`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `photo` VARCHAR(255) NOT NULL,
    `created` DATETIME NOT NULL,
    `created_by` DATETIME NOT NULL
);

INSERT INTO `staffs`(`username`, `password`, `access_type`, `modified`, `created`) VALUES ('aira','pass1',1,NOW(),NOW());