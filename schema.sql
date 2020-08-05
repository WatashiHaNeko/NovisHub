CREATE DATABASE IF NOT EXISTS `novis_hub`
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin
;

CREATE TABLE IF NOT EXISTS `novis_hub`.`tags`
  (
    `id` int NOT NULL AUTO_INCREMENT,
    `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    `used_count` int NOT NULL DEFAULT "0",
    `created` datetime NOT NULL,
    `modified` datetime NOT NULL,
    `deleted` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
  )
  ENGINE=InnoDB
  DEFAULT CHARSET=utf8 COLLATE=utf8_bin
;

CREATE TABLE IF NOT EXISTS `novis_hub`.`user_tags`
  (
    `id` int NOT NULL AUTO_INCREMENT,
    `user_id` int NOT NULL,
    `tag_id` int NOT NULL,
    `created` datetime NOT NULL,
    `modified` datetime NOT NULL,
    `deleted` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
  )
  ENGINE=InnoDB
  DEFAULT CHARSET=utf8 COLLATE=utf8_bin
;

CREATE TABLE IF NOT EXISTS `novis_hub`.`users`
  (
    `id` int NOT NULL AUTO_INCREMENT,
    `auth_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
    `auth_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
    `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    `profile` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
    `profile_summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
    `avatar_filename` varchar(255) COLLATE utf8_bin DEFAULT NULL,
    `created` datetime NOT NULL,
    `modified` datetime NOT NULL,
    `deleted` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
  )
  ENGINE=InnoDB
  DEFAULT CHARSET=utf8 COLLATE=utf8_bin
;

