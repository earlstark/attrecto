/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100411
Source Host           : localhost:3306
Source Database       : attrecto

Target Server Type    : MYSQL
Target Server Version : 100411
File Encoding         : 65001

Date: 2021-07-11 22:05:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('4', '2021_07_09_090702_create_todos_table', '1');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for todos
-- ----------------------------
DROP TABLE IF EXISTS `todos`;
CREATE TABLE `todos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of todos
-- ----------------------------
INSERT INTO `todos` VALUES ('1', '1', 'firest', '2021-07-20', '2021-07-11 17:13:21', '2021-07-11 17:13:21');
INSERT INTO `todos` VALUES ('2', '2', 'sc', '2021-07-19', '2021-07-11 17:14:19', '2021-07-11 17:14:19');
INSERT INTO `todos` VALUES ('4', '1', 'kk', '2021-07-21', '2021-07-11 18:20:14', '2021-07-11 18:20:14');
INSERT INTO `todos` VALUES ('5', '2', 'asdasd', '2021-08-05', '2021-07-11 19:20:53', '2021-07-11 19:20:53');
INSERT INTO `todos` VALUES ('6', '2', 'bb', '2021-08-07', '2021-07-11 19:23:46', '2021-07-11 19:23:46');
INSERT INTO `todos` VALUES ('7', '2', 'aaaa', '2021-08-02', '2021-07-11 19:24:23', '2021-07-11 19:24:23');
INSERT INTO `todos` VALUES ('8', '1', 'qqq', '2021-08-01', '2021-07-11 19:28:10', '2021-07-11 19:28:10');
INSERT INTO `todos` VALUES ('9', '7', 'Todo_test_0', '2021-07-05', '2021-07-11 20:03:21', '2021-07-11 20:03:21');
INSERT INTO `todos` VALUES ('10', '7', 'Todo_test_1', '2021-07-28', '2021-07-11 20:03:31', '2021-07-11 20:03:31');
INSERT INTO `todos` VALUES ('11', '7', 'Todo_test_2', '2021-07-30', '2021-07-11 20:03:44', '2021-07-11 20:03:44');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_img_ext` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', 'fressup@gmail.com', 'jpg', null, '$2y$10$IFOMcovagqGctgHSNAgQhus6u/7dJN3ee7bV4MsH0QEbMj8.03Pfa', null, null, '2021-07-11 18:28:56');
INSERT INTO `users` VALUES ('2', 'test', 'test@gmail.com', 'png', null, '$2y$10$3MhUgBxzRWhBA0kRwSh2xujFUfBvihaPZVW6C5VDM42g4NZqRXGgm', null, '2021-07-11 17:14:09', '2021-07-11 19:24:12');
INSERT INTO `users` VALUES ('4', 'xx', 'x@x.hu', 'jpg', null, '$2y$10$lACIYL/bNmk3o3ThXHMPh.GOSQruNumDpNCXTDVm7VWJ4qGovKvPe', null, '2021-07-11 19:26:49', '2021-07-11 19:26:59');
INSERT INTO `users` VALUES ('5', 'y', 'y@y.hu', 'jpg', null, '$2y$10$ZjNagjXXnaTzoOXShoaIUO72ReCyCEyEiJna4B/kcCRl4NCj53TSq', null, '2021-07-11 19:27:20', '2021-07-11 19:55:24');
INSERT INTO `users` VALUES ('6', 'z', 'z@z.hu', 'jpg', null, '$2y$10$gftDzM3TSQptxeX27ctuZuXF7LQVfzhDg2xiwi24MDaDEgUcaFiIO', null, '2021-07-11 19:27:38', '2021-07-11 19:55:15');
INSERT INTO `users` VALUES ('7', 'q', 'q@q.hu', 'jpg', null, '$2y$10$39fpRiYsFa5CDEPpVVolhOZA2iWYFyrBZRL/nuDOxdf9VH6KMs9vq', null, '2021-07-11 19:27:52', '2021-07-11 20:02:50');
SET FOREIGN_KEY_CHECKS=1;
