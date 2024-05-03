/*
 Navicat Premium Data Transfer

 Source Server         : root
 Source Server Type    : MySQL
 Source Server Version : 100427
 Source Host           : localhost:3306
 Source Schema         : pms_db

 Target Server Type    : MySQL
 Target Server Version : 100427
 File Encoding         : 65001

 Date: 03/05/2024 09:54:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_no` int NOT NULL,
  `bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_branch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers
-- ----------------------------

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for item_categories
-- ----------------------------
DROP TABLE IF EXISTS `item_categories`;
CREATE TABLE `item_categories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of item_categories
-- ----------------------------
INSERT INTO `item_categories` VALUES (3, 'Papers', 'Printing and draft papers', '2024-05-02 07:13:35', '2024-05-02 07:17:08');
INSERT INTO `item_categories` VALUES (4, 'Binding', 'Book binding items', '2024-05-02 07:13:56', '2024-05-02 07:13:56');

-- ----------------------------
-- Table structure for items
-- ----------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `item_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `quantity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `buying_price` double NULL DEFAULT NULL,
  `selling_price` double NULL DEFAULT NULL,
  `quantity_alert` int NULL DEFAULT NULL,
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of items
-- ----------------------------
INSERT INTO `items` VALUES (1, '3', NULL, NULL, 'P001', '500', 3500, 3900, 50, NULL, '2024-05-02 09:22:26', '2024-05-02 10:32:35', 'A4');

-- ----------------------------
-- Table structure for measure_units
-- ----------------------------
DROP TABLE IF EXISTS `measure_units`;
CREATE TABLE `measure_units`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of measure_units
-- ----------------------------
INSERT INTO `measure_units` VALUES (1, 'Money', 'Rs.', '2024-05-02 10:50:51', '2024-05-02 10:54:57');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2024_04_10_102614_create_permission_tables', 1);
INSERT INTO `migrations` VALUES (7, '2014_10_12_100000_create_password_resets_table', 2);
INSERT INTO `migrations` VALUES (8, '2024_05_02_062650_create_item_categories_table', 2);
INSERT INTO `migrations` VALUES (9, '2024_05_02_062829_create_items_table', 2);
INSERT INTO `migrations` VALUES (10, '2024_05_02_103524_create_measure_units_table', 3);
INSERT INTO `migrations` VALUES (11, '2024_05_02_110049_create_suppliers_table', 4);
INSERT INTO `migrations` VALUES (12, '2024_05_02_171850_create_customers_table', 5);
INSERT INTO `migrations` VALUES (13, '2024_05_02_175519_create_services_table', 6);
INSERT INTO `migrations` VALUES (14, '2024_05_02_175924_create_service_categories_table', 6);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (1, 'App\\Models\\User', 1);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1165 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1023, 'administration', 'web', '2024-01-30 10:35:07', '2024-01-30 10:35:07');
INSERT INTO `permissions` VALUES (1024, 'administration-user', 'web', '2024-01-30 10:35:07', '2024-01-30 10:35:07');
INSERT INTO `permissions` VALUES (1025, 'administration-user-create', 'web', '2024-01-30 10:35:07', '2024-01-30 10:35:07');
INSERT INTO `permissions` VALUES (1026, 'administration-user-edit', 'web', '2024-01-30 10:35:07', '2024-01-30 10:35:07');
INSERT INTO `permissions` VALUES (1027, 'administration-user-delete', 'web', '2024-01-30 10:35:07', '2024-01-30 10:35:07');
INSERT INTO `permissions` VALUES (1028, 'administration-role', 'web', '2024-01-30 10:35:07', '2024-01-30 10:35:07');
INSERT INTO `permissions` VALUES (1029, 'administration-role-create', 'web', '2024-01-30 10:35:07', '2024-01-30 10:35:07');
INSERT INTO `permissions` VALUES (1030, 'administration-role-edit', 'web', '2024-01-30 10:35:07', '2024-01-30 10:35:07');
INSERT INTO `permissions` VALUES (1031, 'administration-role-delete', 'web', '2024-01-30 10:35:07', '2024-01-30 10:35:07');
INSERT INTO `permissions` VALUES (1032, 'master-data', 'web', '2024-01-30 10:35:07', '2024-01-30 10:35:07');
INSERT INTO `permissions` VALUES (1033, 'master-data-unit', 'web', '2024-01-30 10:35:07', '2024-01-30 10:35:07');
INSERT INTO `permissions` VALUES (1034, 'master-data-unit-create', 'web', '2024-01-30 10:35:07', '2024-01-30 10:35:07');
INSERT INTO `permissions` VALUES (1035, 'master-data-unit-edit', 'web', '2024-01-30 10:35:07', '2024-01-30 10:35:07');
INSERT INTO `permissions` VALUES (1036, 'master-data-unit-delete', 'web', '2024-01-30 10:35:07', '2024-01-30 10:35:07');
INSERT INTO `permissions` VALUES (1037, 'master-data-items-category', 'web', '2024-01-30 10:35:07', '2024-01-30 10:35:07');
INSERT INTO `permissions` VALUES (1038, 'master-data-items-category-create', 'web', '2024-01-30 10:35:07', '2024-01-30 10:35:07');
INSERT INTO `permissions` VALUES (1039, 'master-data-items-category-edit', 'web', '2024-01-30 10:35:07', '2024-01-30 10:35:07');
INSERT INTO `permissions` VALUES (1040, 'master-data-items-category-delete', 'web', '2024-01-30 10:35:07', '2024-01-30 10:35:07');
INSERT INTO `permissions` VALUES (1041, 'master-data-items', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1042, 'master-data-items-create', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1043, 'master-data-items-edit', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1044, 'master-data-items-delete', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1045, 'master-data-relashionship', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1046, 'master-data-relashionship-create', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1047, 'master-data-relashionship-edit', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1048, 'master-data-relashionship-delete', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1049, 'master-data-district', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1050, 'master-data-district-create', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1051, 'master-data-district-edit', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1052, 'master-data-district-delete', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1053, 'master-data-bank', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1054, 'master-data-bank-create', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1055, 'master-data-bank-edit', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1056, 'master-data-bank-delete', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1057, 'master-data-bank-branch', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1058, 'master-data-bank-branch-create', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1059, 'master-data-bank-branch-edit', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1060, 'master-data-bank-branch-delete', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1061, 'master-data-reject-reason', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1062, 'master-data-reject-reason-create', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1063, 'master-data-reject-reason-edit', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1064, 'master-data-reject-reason-delete', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1065, 'master-data-member-status', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1066, 'master-data-member-status-create', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1067, 'master-data-member-status-edit', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1068, 'master-data-member-status-delete', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1069, 'master-data-withdrawal-product', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1070, 'master-data-withdrawal-product-create', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1071, 'master-data-withdrawal-product-edit', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1072, 'master-data-withdrawal-product-delete', 'web', '2024-01-30 10:35:09', '2024-01-30 10:35:09');
INSERT INTO `permissions` VALUES (1073, 'master-data-contribution-interest', 'web', '2024-01-30 10:35:09', '2024-01-30 10:35:09');
INSERT INTO `permissions` VALUES (1074, 'master-data-contribution-interest-create', 'web', '2024-01-30 10:35:09', '2024-01-30 10:35:09');
INSERT INTO `permissions` VALUES (1075, 'master-data-contribution-interest-edit', 'web', '2024-01-30 10:35:09', '2024-01-30 10:35:09');
INSERT INTO `permissions` VALUES (1076, 'master-data-contribution-interest-delete', 'web', '2024-01-30 10:35:09', '2024-01-30 10:35:09');
INSERT INTO `permissions` VALUES (1077, 'master-data-loan-product', 'web', '2024-01-30 10:35:09', '2024-01-30 10:35:09');
INSERT INTO `permissions` VALUES (1078, 'master-data-loan-product-create', 'web', '2024-01-30 10:35:09', '2024-01-30 10:35:09');
INSERT INTO `permissions` VALUES (1079, 'master-data-loan-product-edit', 'web', '2024-01-30 10:35:09', '2024-01-30 10:35:09');
INSERT INTO `permissions` VALUES (1080, 'master-data-loan-product-delete', 'web', '2024-01-30 10:35:09', '2024-01-30 10:35:09');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id` ASC) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES (951, 14);
INSERT INTO `role_has_permissions` VALUES (951, 15);
INSERT INTO `role_has_permissions` VALUES (951, 16);
INSERT INTO `role_has_permissions` VALUES (951, 17);
INSERT INTO `role_has_permissions` VALUES (951, 19);
INSERT INTO `role_has_permissions` VALUES (951, 23);
INSERT INTO `role_has_permissions` VALUES (951, 24);
INSERT INTO `role_has_permissions` VALUES (951, 25);
INSERT INTO `role_has_permissions` VALUES (951, 38);
INSERT INTO `role_has_permissions` VALUES (951, 39);
INSERT INTO `role_has_permissions` VALUES (951, 40);
INSERT INTO `role_has_permissions` VALUES (952, 16);
INSERT INTO `role_has_permissions` VALUES (952, 17);
INSERT INTO `role_has_permissions` VALUES (953, 14);
INSERT INTO `role_has_permissions` VALUES (954, 14);
INSERT INTO `role_has_permissions` VALUES (954, 15);
INSERT INTO `role_has_permissions` VALUES (954, 16);
INSERT INTO `role_has_permissions` VALUES (954, 17);
INSERT INTO `role_has_permissions` VALUES (954, 19);
INSERT INTO `role_has_permissions` VALUES (954, 23);
INSERT INTO `role_has_permissions` VALUES (954, 24);
INSERT INTO `role_has_permissions` VALUES (954, 25);
INSERT INTO `role_has_permissions` VALUES (954, 38);
INSERT INTO `role_has_permissions` VALUES (954, 39);
INSERT INTO `role_has_permissions` VALUES (954, 40);
INSERT INTO `role_has_permissions` VALUES (955, 14);
INSERT INTO `role_has_permissions` VALUES (955, 15);
INSERT INTO `role_has_permissions` VALUES (955, 16);
INSERT INTO `role_has_permissions` VALUES (955, 17);
INSERT INTO `role_has_permissions` VALUES (955, 19);
INSERT INTO `role_has_permissions` VALUES (955, 23);
INSERT INTO `role_has_permissions` VALUES (955, 24);
INSERT INTO `role_has_permissions` VALUES (955, 25);
INSERT INTO `role_has_permissions` VALUES (955, 38);
INSERT INTO `role_has_permissions` VALUES (955, 39);
INSERT INTO `role_has_permissions` VALUES (955, 40);
INSERT INTO `role_has_permissions` VALUES (956, 16);
INSERT INTO `role_has_permissions` VALUES (959, 16);
INSERT INTO `role_has_permissions` VALUES (960, 17);
INSERT INTO `role_has_permissions` VALUES (960, 19);
INSERT INTO `role_has_permissions` VALUES (961, 17);
INSERT INTO `role_has_permissions` VALUES (962, 16);
INSERT INTO `role_has_permissions` VALUES (963, 14);
INSERT INTO `role_has_permissions` VALUES (963, 15);
INSERT INTO `role_has_permissions` VALUES (963, 16);
INSERT INTO `role_has_permissions` VALUES (963, 17);
INSERT INTO `role_has_permissions` VALUES (963, 23);
INSERT INTO `role_has_permissions` VALUES (963, 24);
INSERT INTO `role_has_permissions` VALUES (963, 25);
INSERT INTO `role_has_permissions` VALUES (963, 38);
INSERT INTO `role_has_permissions` VALUES (963, 39);
INSERT INTO `role_has_permissions` VALUES (963, 40);
INSERT INTO `role_has_permissions` VALUES (964, 14);
INSERT INTO `role_has_permissions` VALUES (964, 15);
INSERT INTO `role_has_permissions` VALUES (964, 16);
INSERT INTO `role_has_permissions` VALUES (965, 16);
INSERT INTO `role_has_permissions` VALUES (992, 17);
INSERT INTO `role_has_permissions` VALUES (993, 17);
INSERT INTO `role_has_permissions` VALUES (994, 17);
INSERT INTO `role_has_permissions` VALUES (995, 17);
INSERT INTO `role_has_permissions` VALUES (998, 17);
INSERT INTO `role_has_permissions` VALUES (999, 17);
INSERT INTO `role_has_permissions` VALUES (1002, 17);
INSERT INTO `role_has_permissions` VALUES (1003, 14);
INSERT INTO `role_has_permissions` VALUES (1003, 15);
INSERT INTO `role_has_permissions` VALUES (1003, 16);
INSERT INTO `role_has_permissions` VALUES (1003, 23);
INSERT INTO `role_has_permissions` VALUES (1003, 24);
INSERT INTO `role_has_permissions` VALUES (1003, 25);
INSERT INTO `role_has_permissions` VALUES (1003, 38);
INSERT INTO `role_has_permissions` VALUES (1003, 39);
INSERT INTO `role_has_permissions` VALUES (1003, 40);
INSERT INTO `role_has_permissions` VALUES (1004, 14);
INSERT INTO `role_has_permissions` VALUES (1004, 15);
INSERT INTO `role_has_permissions` VALUES (1004, 16);
INSERT INTO `role_has_permissions` VALUES (1004, 23);
INSERT INTO `role_has_permissions` VALUES (1004, 24);
INSERT INTO `role_has_permissions` VALUES (1004, 25);
INSERT INTO `role_has_permissions` VALUES (1004, 38);
INSERT INTO `role_has_permissions` VALUES (1004, 39);
INSERT INTO `role_has_permissions` VALUES (1004, 40);
INSERT INTO `role_has_permissions` VALUES (1005, 14);
INSERT INTO `role_has_permissions` VALUES (1005, 15);
INSERT INTO `role_has_permissions` VALUES (1005, 16);
INSERT INTO `role_has_permissions` VALUES (1005, 23);
INSERT INTO `role_has_permissions` VALUES (1005, 24);
INSERT INTO `role_has_permissions` VALUES (1005, 25);
INSERT INTO `role_has_permissions` VALUES (1006, 38);
INSERT INTO `role_has_permissions` VALUES (1006, 39);
INSERT INTO `role_has_permissions` VALUES (1006, 40);
INSERT INTO `role_has_permissions` VALUES (1007, 14);
INSERT INTO `role_has_permissions` VALUES (1007, 15);
INSERT INTO `role_has_permissions` VALUES (1007, 16);
INSERT INTO `role_has_permissions` VALUES (1008, 14);
INSERT INTO `role_has_permissions` VALUES (1008, 15);
INSERT INTO `role_has_permissions` VALUES (1008, 16);
INSERT INTO `role_has_permissions` VALUES (1008, 23);
INSERT INTO `role_has_permissions` VALUES (1008, 24);
INSERT INTO `role_has_permissions` VALUES (1008, 25);
INSERT INTO `role_has_permissions` VALUES (1008, 38);
INSERT INTO `role_has_permissions` VALUES (1008, 39);
INSERT INTO `role_has_permissions` VALUES (1008, 40);
INSERT INTO `role_has_permissions` VALUES (1009, 14);
INSERT INTO `role_has_permissions` VALUES (1009, 15);
INSERT INTO `role_has_permissions` VALUES (1009, 16);
INSERT INTO `role_has_permissions` VALUES (1009, 23);
INSERT INTO `role_has_permissions` VALUES (1009, 24);
INSERT INTO `role_has_permissions` VALUES (1009, 25);
INSERT INTO `role_has_permissions` VALUES (1009, 38);
INSERT INTO `role_has_permissions` VALUES (1009, 39);
INSERT INTO `role_has_permissions` VALUES (1009, 40);
INSERT INTO `role_has_permissions` VALUES (1010, 14);
INSERT INTO `role_has_permissions` VALUES (1011, 23);
INSERT INTO `role_has_permissions` VALUES (1012, 39);
INSERT INTO `role_has_permissions` VALUES (1013, 38);
INSERT INTO `role_has_permissions` VALUES (1014, 14);
INSERT INTO `role_has_permissions` VALUES (1014, 15);
INSERT INTO `role_has_permissions` VALUES (1014, 23);
INSERT INTO `role_has_permissions` VALUES (1014, 24);
INSERT INTO `role_has_permissions` VALUES (1014, 25);
INSERT INTO `role_has_permissions` VALUES (1014, 38);
INSERT INTO `role_has_permissions` VALUES (1014, 39);
INSERT INTO `role_has_permissions` VALUES (1014, 40);
INSERT INTO `role_has_permissions` VALUES (1015, 14);
INSERT INTO `role_has_permissions` VALUES (1015, 15);
INSERT INTO `role_has_permissions` VALUES (1015, 16);
INSERT INTO `role_has_permissions` VALUES (1015, 23);
INSERT INTO `role_has_permissions` VALUES (1015, 24);
INSERT INTO `role_has_permissions` VALUES (1015, 25);
INSERT INTO `role_has_permissions` VALUES (1015, 38);
INSERT INTO `role_has_permissions` VALUES (1015, 39);
INSERT INTO `role_has_permissions` VALUES (1015, 40);
INSERT INTO `role_has_permissions` VALUES (1016, 15);
INSERT INTO `role_has_permissions` VALUES (1016, 16);
INSERT INTO `role_has_permissions` VALUES (1016, 23);
INSERT INTO `role_has_permissions` VALUES (1016, 24);
INSERT INTO `role_has_permissions` VALUES (1016, 25);
INSERT INTO `role_has_permissions` VALUES (1016, 38);
INSERT INTO `role_has_permissions` VALUES (1016, 39);
INSERT INTO `role_has_permissions` VALUES (1016, 40);
INSERT INTO `role_has_permissions` VALUES (1017, 14);
INSERT INTO `role_has_permissions` VALUES (1017, 15);
INSERT INTO `role_has_permissions` VALUES (1017, 16);
INSERT INTO `role_has_permissions` VALUES (1018, 15);
INSERT INTO `role_has_permissions` VALUES (1018, 16);
INSERT INTO `role_has_permissions` VALUES (1018, 23);
INSERT INTO `role_has_permissions` VALUES (1018, 24);
INSERT INTO `role_has_permissions` VALUES (1018, 25);
INSERT INTO `role_has_permissions` VALUES (1018, 39);
INSERT INTO `role_has_permissions` VALUES (1018, 40);
INSERT INTO `role_has_permissions` VALUES (1019, 39);
INSERT INTO `role_has_permissions` VALUES (1020, 38);
INSERT INTO `role_has_permissions` VALUES (1021, 23);
INSERT INTO `role_has_permissions` VALUES (1021, 24);
INSERT INTO `role_has_permissions` VALUES (1021, 25);
INSERT INTO `role_has_permissions` VALUES (1021, 38);
INSERT INTO `role_has_permissions` VALUES (1021, 39);
INSERT INTO `role_has_permissions` VALUES (1021, 40);
INSERT INTO `role_has_permissions` VALUES (1023, 1);
INSERT INTO `role_has_permissions` VALUES (1024, 1);
INSERT INTO `role_has_permissions` VALUES (1025, 1);
INSERT INTO `role_has_permissions` VALUES (1026, 1);
INSERT INTO `role_has_permissions` VALUES (1027, 1);
INSERT INTO `role_has_permissions` VALUES (1028, 1);
INSERT INTO `role_has_permissions` VALUES (1029, 1);
INSERT INTO `role_has_permissions` VALUES (1030, 1);
INSERT INTO `role_has_permissions` VALUES (1031, 1);
INSERT INTO `role_has_permissions` VALUES (1032, 1);
INSERT INTO `role_has_permissions` VALUES (1033, 1);
INSERT INTO `role_has_permissions` VALUES (1034, 1);
INSERT INTO `role_has_permissions` VALUES (1035, 1);
INSERT INTO `role_has_permissions` VALUES (1036, 1);
INSERT INTO `role_has_permissions` VALUES (1037, 1);
INSERT INTO `role_has_permissions` VALUES (1038, 1);
INSERT INTO `role_has_permissions` VALUES (1039, 1);
INSERT INTO `role_has_permissions` VALUES (1040, 1);
INSERT INTO `role_has_permissions` VALUES (1041, 1);
INSERT INTO `role_has_permissions` VALUES (1042, 1);
INSERT INTO `role_has_permissions` VALUES (1043, 1);
INSERT INTO `role_has_permissions` VALUES (1044, 1);
INSERT INTO `role_has_permissions` VALUES (1045, 1);
INSERT INTO `role_has_permissions` VALUES (1046, 1);
INSERT INTO `role_has_permissions` VALUES (1047, 1);
INSERT INTO `role_has_permissions` VALUES (1048, 1);
INSERT INTO `role_has_permissions` VALUES (1049, 1);
INSERT INTO `role_has_permissions` VALUES (1050, 1);
INSERT INTO `role_has_permissions` VALUES (1051, 1);
INSERT INTO `role_has_permissions` VALUES (1052, 1);
INSERT INTO `role_has_permissions` VALUES (1053, 1);
INSERT INTO `role_has_permissions` VALUES (1054, 1);
INSERT INTO `role_has_permissions` VALUES (1055, 1);
INSERT INTO `role_has_permissions` VALUES (1056, 1);
INSERT INTO `role_has_permissions` VALUES (1057, 1);
INSERT INTO `role_has_permissions` VALUES (1058, 1);
INSERT INTO `role_has_permissions` VALUES (1059, 1);
INSERT INTO `role_has_permissions` VALUES (1060, 1);
INSERT INTO `role_has_permissions` VALUES (1061, 1);
INSERT INTO `role_has_permissions` VALUES (1062, 1);
INSERT INTO `role_has_permissions` VALUES (1063, 1);
INSERT INTO `role_has_permissions` VALUES (1064, 1);
INSERT INTO `role_has_permissions` VALUES (1065, 1);
INSERT INTO `role_has_permissions` VALUES (1066, 1);
INSERT INTO `role_has_permissions` VALUES (1067, 1);
INSERT INTO `role_has_permissions` VALUES (1068, 1);
INSERT INTO `role_has_permissions` VALUES (1069, 1);
INSERT INTO `role_has_permissions` VALUES (1070, 1);
INSERT INTO `role_has_permissions` VALUES (1071, 1);
INSERT INTO `role_has_permissions` VALUES (1072, 1);
INSERT INTO `role_has_permissions` VALUES (1073, 1);
INSERT INTO `role_has_permissions` VALUES (1074, 1);
INSERT INTO `role_has_permissions` VALUES (1075, 1);
INSERT INTO `role_has_permissions` VALUES (1076, 1);
INSERT INTO `role_has_permissions` VALUES (1077, 1);
INSERT INTO `role_has_permissions` VALUES (1078, 1);
INSERT INTO `role_has_permissions` VALUES (1079, 1);
INSERT INTO `role_has_permissions` VALUES (1080, 1);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 48 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Super Admin', 'web', '2023-09-27 05:14:54', '2024-01-24 09:30:04');
INSERT INTO `roles` VALUES (14, 'Registration OC - Loans', 'web', '2024-01-24 09:48:45', '2024-01-24 09:48:45');
INSERT INTO `roles` VALUES (15, 'Registration IC - Loans', 'web', '2024-01-24 09:50:36', '2024-01-24 09:50:36');
INSERT INTO `roles` VALUES (16, 'Registration Clerk - Loans', 'web', '2024-01-24 09:50:50', '2024-01-30 09:31:23');
INSERT INTO `roles` VALUES (17, 'Registration OC - Withdrawal', 'web', '2024-01-24 09:51:16', '2024-01-24 09:51:16');
INSERT INTO `roles` VALUES (18, 'Registration IC - Withdrawal', 'web', '2024-01-24 09:51:55', '2024-01-24 09:51:55');
INSERT INTO `roles` VALUES (19, 'Registration Clerk - Withdrawal', 'web', '2024-01-24 09:52:28', '2024-01-30 09:32:06');
INSERT INTO `roles` VALUES (20, 'Ledger Section OC', 'web', '2024-01-24 09:52:49', '2024-01-24 10:17:40');
INSERT INTO `roles` VALUES (21, 'Ledger Section IC', 'web', '2024-01-24 09:53:08', '2024-01-24 10:17:49');
INSERT INTO `roles` VALUES (22, 'Ledger Section Cleark', 'web', '2024-01-24 09:53:22', '2024-01-24 10:18:01');
INSERT INTO `roles` VALUES (23, 'Loan Section 85 - OC', 'web', '2024-01-24 09:54:25', '2024-01-24 09:54:25');
INSERT INTO `roles` VALUES (24, 'Loan Section 85 - IC', 'web', '2024-01-24 09:54:50', '2024-01-24 09:54:50');
INSERT INTO `roles` VALUES (25, 'Loan Section 85 - Cleark', 'web', '2024-01-24 09:55:11', '2024-01-24 09:55:11');
INSERT INTO `roles` VALUES (26, 'Loan Recovery OC', 'web', '2024-01-24 09:55:48', '2024-01-24 09:55:48');
INSERT INTO `roles` VALUES (27, 'Loan Recovery IC', 'web', '2024-01-24 09:56:04', '2024-01-24 09:56:04');
INSERT INTO `roles` VALUES (28, 'Loan Recovery Cleark', 'web', '2024-01-24 09:56:34', '2024-01-24 09:56:34');
INSERT INTO `roles` VALUES (29, 'Audit Section OC', 'web', '2024-01-24 09:57:12', '2024-01-24 10:17:09');
INSERT INTO `roles` VALUES (30, 'Audit Section  IC', 'web', '2024-01-24 09:57:25', '2024-01-24 10:17:30');
INSERT INTO `roles` VALUES (31, 'Audit Section Cleark', 'web', '2024-01-24 09:57:40', '2024-01-24 10:18:13');
INSERT INTO `roles` VALUES (32, 'Full Payment Section OC', 'web', '2024-01-24 09:58:06', '2024-01-24 09:58:06');
INSERT INTO `roles` VALUES (33, 'Full Payment Section IC', 'web', '2024-01-24 09:58:23', '2024-01-24 09:58:23');
INSERT INTO `roles` VALUES (34, 'Full Payment Section Cleark', 'web', '2024-01-24 09:58:45', '2024-01-24 09:58:45');
INSERT INTO `roles` VALUES (35, '80 Payment Section OC', 'web', '2024-01-24 09:59:37', '2024-01-24 09:59:37');
INSERT INTO `roles` VALUES (36, '80 Payment Section IC', 'web', '2024-01-24 09:59:55', '2024-01-24 09:59:55');
INSERT INTO `roles` VALUES (37, '80 Payment Section Cleark', 'web', '2024-01-24 10:00:12', '2024-01-24 10:00:12');
INSERT INTO `roles` VALUES (38, 'Account Section OC', 'web', '2024-01-24 10:01:48', '2024-01-24 10:18:37');
INSERT INTO `roles` VALUES (39, 'Account Section IC', 'web', '2024-01-24 10:02:08', '2024-01-24 10:19:25');
INSERT INTO `roles` VALUES (40, 'Account Section Clerk', 'web', '2024-01-24 10:02:39', '2024-01-30 09:35:56');
INSERT INTO `roles` VALUES (41, 'CEO', 'web', '2024-01-24 10:02:56', '2024-01-24 10:02:56');
INSERT INTO `roles` VALUES (42, 'Director', 'web', '2024-01-24 10:03:09', '2024-01-24 10:03:09');
INSERT INTO `roles` VALUES (43, 'SO1(IT)', 'web', '2024-01-24 10:03:47', '2024-01-24 10:03:47');
INSERT INTO `roles` VALUES (44, 'SO2(IT)', 'web', '2024-01-24 10:04:04', '2024-01-24 10:04:04');
INSERT INTO `roles` VALUES (45, 'Operator 1', 'web', '2024-01-24 10:04:38', '2024-01-24 10:04:38');
INSERT INTO `roles` VALUES (46, 'Operator 2', 'web', '2024-01-24 10:04:48', '2024-01-24 10:04:48');
INSERT INTO `roles` VALUES (47, 'Operator 3', 'web', '2024-01-24 10:05:00', '2024-01-24 10:05:00');

-- ----------------------------
-- Table structure for service_categories
-- ----------------------------
DROP TABLE IF EXISTS `service_categories`;
CREATE TABLE `service_categories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of service_categories
-- ----------------------------
INSERT INTO `service_categories` VALUES (1, 'Printing', 'Duplo, Laser, Color and black', '2024-05-03 03:52:04', '2024-05-03 03:52:04');

-- ----------------------------
-- Table structure for services
-- ----------------------------
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `unit_price` double NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of services
-- ----------------------------
INSERT INTO `services` VALUES (1, 1, 'Duplo Printing', 'PRN001', 5, '2024-05-03 03:54:14', '2024-05-03 03:54:14');

-- ----------------------------
-- Table structure for suppliers
-- ----------------------------
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `shopname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank_branch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `account_number` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of suppliers
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 139 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Super Admin', 'admin@gmail.com', NULL, '$2y$10$yHuYapn2xuOkmahe1xokkeaZU3P0c3dqsa9QzWIauZn63Q3THXXtu', 'DF8CVDIt3AlUfsCRfDK9rrS9Qqa52gc2Jyd1SHb7cMV0nWKfYNSkBCeas2O5', '2023-09-27 05:14:54', '2023-09-27 05:14:54');

SET FOREIGN_KEY_CHECKS = 1;
