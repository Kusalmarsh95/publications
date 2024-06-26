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

 Date: 13/05/2024 18:55:19
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
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `account_no` int NULL DEFAULT NULL,
  `bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank_branch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1, 'AAA', 'abc@gmail.com', '0375151515', 'dsdadf', 'rare', NULL, 5285163, 'BOC', 'Colombo', '2024-05-06 17:37:14', '2024-05-06 17:37:14');
INSERT INTO `customers` VALUES (3, 'Samson Perera', 'abc@gmail.com', '0372222456', '421/1, Colombo', NULL, NULL, NULL, NULL, NULL, '2024-05-10 09:43:34', '2024-05-10 09:43:34');

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for issue_details
-- ----------------------------
DROP TABLE IF EXISTS `issue_details`;
CREATE TABLE `issue_details`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `issue_id` bigint NOT NULL,
  `item_id` bigint NOT NULL,
  `quantity` double NOT NULL,
  `unit_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `total` double NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of issue_details
-- ----------------------------
INSERT INTO `issue_details` VALUES (5, 1, 1, 40, '5.00', 200, '2024-05-06 16:56:43', '2024-05-06 16:56:43');
INSERT INTO `issue_details` VALUES (6, 1, 3, 5, '100.00', 500, '2024-05-06 16:56:43', '2024-05-06 16:56:43');

-- ----------------------------
-- Table structure for issues
-- ----------------------------
DROP TABLE IF EXISTS `issues`;
CREATE TABLE `issues`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `worker_id` bigint NOT NULL,
  `date` date NOT NULL,
  `issue_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` int NULL DEFAULT NULL,
  `total_items` double NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of issues
-- ----------------------------
INSERT INTO `issues` VALUES (1, 2, '2024-05-06', '0001', 1, 45, 'Super Admin', 'Super Admin', '2024-05-06 16:46:28', '2024-05-06 17:03:42');

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of items
-- ----------------------------
INSERT INTO `items` VALUES (1, '3', NULL, NULL, 'P001', '520', 5, 6, 50, NULL, '2024-05-02 09:22:26', '2024-05-06 17:03:42', 'A4');
INSERT INTO `items` VALUES (3, '4', NULL, NULL, 'BND001', '500', 100, 110, 50, 'Black spirals only', '2024-05-04 07:30:43', '2024-05-06 17:03:42', 'Spiral');

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
INSERT INTO `migrations` VALUES (15, '2024_05_03_060651_create_purchases_table', 7);
INSERT INTO `migrations` VALUES (16, '2024_05_03_062054_create_purchase_details_table', 7);
INSERT INTO `migrations` VALUES (17, '2024_05_06_150424_create_issues_table', 8);
INSERT INTO `migrations` VALUES (18, '2024_05_06_150443_create_issue_details_table', 8);
INSERT INTO `migrations` VALUES (19, '2024_05_06_151704_create_workers_table', 8);
INSERT INTO `migrations` VALUES (20, '2024_05_06_174344_create_orders_table', 9);
INSERT INTO `migrations` VALUES (21, '2024_05_06_174453_create_order_details_table', 9);
INSERT INTO `migrations` VALUES (22, '2024_05_09_085314_create_order_assigns_table', 10);

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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (1, 'App\\Models\\User', 1);
INSERT INTO `model_has_roles` VALUES (45, 'App\\Models\\User', 142);
INSERT INTO `model_has_roles` VALUES (47, 'App\\Models\\User', 140);
INSERT INTO `model_has_roles` VALUES (48, 'App\\Models\\User', 2);
INSERT INTO `model_has_roles` VALUES (48, 'App\\Models\\User', 141);

-- ----------------------------
-- Table structure for order_assigns
-- ----------------------------
DROP TABLE IF EXISTS `order_assigns`;
CREATE TABLE `order_assigns`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint NOT NULL,
  `fwd_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `notes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `fwd_to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_assigns
-- ----------------------------
INSERT INTO `order_assigns` VALUES (2, 21, '1', 'Test', 'Super Admin', '2024-05-09 09:33:34', '2024-05-09 09:33:34');
INSERT INTO `order_assigns` VALUES (3, 21, '1', 'Test 2', 'Super Admin', '2024-05-09 10:29:45', '2024-05-09 10:29:45');
INSERT INTO `order_assigns` VALUES (4, 23, 'Customer', 'Initial order', 'Publication OC', '2024-05-13 04:48:09', '2024-05-13 04:48:09');

-- ----------------------------
-- Table structure for order_details
-- ----------------------------
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint NOT NULL,
  `service_id` bigint NOT NULL,
  `quantity` double NOT NULL,
  `unit_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `total` double NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of order_details
-- ----------------------------
INSERT INTO `order_details` VALUES (4, 21, 1, 15, '5.00', 75, '2024-05-08 15:17:43', '2024-05-08 15:17:43');
INSERT INTO `order_details` VALUES (9, 22, 1, 25, '5.00', 125, '2024-05-08 15:26:42', '2024-05-08 15:26:42');
INSERT INTO `order_details` VALUES (10, 23, 1, 15, '5.00', 75, NULL, NULL);

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint NOT NULL,
  `date` date NOT NULL,
  `order_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `files` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` int NULL DEFAULT NULL,
  `discount` double NULL DEFAULT NULL,
  `total_amount` double NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `order_no`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (21, 1, '2024-05-06', '00000002', '', 'Black and white print', 1, 0, 75, 'Super Admin', NULL, '2024-05-08 14:48:25', '2024-05-09 09:28:20');
INSERT INTO `orders` VALUES (22, 1, '2024-05-06', '00000003', 'uploads/OftWQcjn2Cqnl8xh4XuFFlMmYMGnCfFkU6YN8eSu.pptx', 'A', 1, 0, 125, 'Super Admin', NULL, '2024-05-08 15:20:57', '2024-05-08 15:26:42');
INSERT INTO `orders` VALUES (23, 1, '2024-05-13', '00000004', '', NULL, 1, 0, 75, 'Super Admin', NULL, '2024-05-13 04:48:09', '2024-05-13 04:48:09');

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 1172 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
INSERT INTO `permissions` VALUES (1045, 'master-data-service-category', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1046, 'master-data-service-category-create', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1047, 'master-data-service-category-edit', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1048, 'master-data-service-category-delete', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1049, 'master-data-service', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1050, 'master-data-service-create', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1051, 'master-data-service-edit', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1052, 'master-data-service-delete', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1053, 'stock-management', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1054, 'stock-management-suppliers', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1055, 'stock-management-suppliers-create', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1056, 'stock-management-suppliers-edit', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1057, 'stock-management-suppliers-delete', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1058, 'stock-management-workers', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1059, 'stock-management-workers-create', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1060, 'stock-management-workers-edit', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1061, 'stock-management-workers-delete', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1062, 'stock-management-purchase', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1063, 'stock-management-purchase-create', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1064, 'stock-management-purchase-edit', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1065, 'stock-management-purchase-delete', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1066, 'stock-management-issues', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1067, 'stock-management-issues-create', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1068, 'stock-management-issues-edit', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1069, 'stock-management-issues-delete', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1070, 'publication-management', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1071, 'publication-management-customers', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1072, 'publication-management-customers-create', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1073, 'publication-management-customers-edit', 'web', '2024-01-30 10:35:08', '2024-01-30 10:35:08');
INSERT INTO `permissions` VALUES (1074, 'publication-management-customers-delete', 'web', '2024-01-30 10:35:09', '2024-01-30 10:35:09');
INSERT INTO `permissions` VALUES (1075, 'publication-management-orders', 'web', '2024-01-30 10:35:09', '2024-01-30 10:35:09');
INSERT INTO `permissions` VALUES (1076, 'publication-management-orders-create', 'web', '2024-01-30 10:35:09', '2024-01-30 10:35:09');
INSERT INTO `permissions` VALUES (1077, 'publication-management-orders-edit', 'web', '2024-01-30 10:35:09', '2024-01-30 10:35:09');
INSERT INTO `permissions` VALUES (1078, 'publication-management-orders-delete', 'web', '2024-01-30 10:35:09', '2024-01-30 10:35:09');
INSERT INTO `permissions` VALUES (1167, 'publication-management-orders-view', 'web', '2024-01-30 10:35:09', '2024-01-30 10:35:09');
INSERT INTO `permissions` VALUES (1168, 'publication-management-orders-complete', 'web', '2024-01-30 10:35:09', '2024-01-30 10:35:09');
INSERT INTO `permissions` VALUES (1169, 'publication-management-orders-forward', 'web', '2024-01-30 10:35:09', '2024-01-30 10:35:09');
INSERT INTO `permissions` VALUES (1170, 'publication-management-orders-all', 'web', '2024-01-30 10:35:09', '2024-01-30 10:35:09');
INSERT INTO `permissions` VALUES (1171, 'publication-management-orders-reject', 'web', '2024-01-30 10:35:09', '2024-01-30 10:35:09');

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for purchase_details
-- ----------------------------
DROP TABLE IF EXISTS `purchase_details`;
CREATE TABLE `purchase_details`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `purchase_id` bigint NOT NULL,
  `item_id` bigint NOT NULL,
  `quantity` double NOT NULL,
  `unit_price` double NULL DEFAULT NULL,
  `total` double NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of purchase_details
-- ----------------------------
INSERT INTO `purchase_details` VALUES (9, 16, 1, 100, 5, 500, NULL, NULL);
INSERT INTO `purchase_details` VALUES (10, 16, 3, 10, 100, 1000, NULL, NULL);

-- ----------------------------
-- Table structure for purchases
-- ----------------------------
DROP TABLE IF EXISTS `purchases`;
CREATE TABLE `purchases`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint NOT NULL,
  `date` date NOT NULL,
  `purchase_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` int NULL DEFAULT NULL,
  `discount` double NULL DEFAULT NULL,
  `total_amount` double NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of purchases
-- ----------------------------
INSERT INTO `purchases` VALUES (16, 1, '2024-05-06', '0001', 1, 0, 1500, NULL, NULL, '2024-05-06 10:19:22', '2024-05-06 15:48:48');

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
INSERT INTO `role_has_permissions` VALUES (1053, 45);
INSERT INTO `role_has_permissions` VALUES (1053, 48);
INSERT INTO `role_has_permissions` VALUES (1054, 1);
INSERT INTO `role_has_permissions` VALUES (1054, 48);
INSERT INTO `role_has_permissions` VALUES (1055, 1);
INSERT INTO `role_has_permissions` VALUES (1055, 48);
INSERT INTO `role_has_permissions` VALUES (1056, 1);
INSERT INTO `role_has_permissions` VALUES (1056, 48);
INSERT INTO `role_has_permissions` VALUES (1057, 1);
INSERT INTO `role_has_permissions` VALUES (1057, 48);
INSERT INTO `role_has_permissions` VALUES (1058, 1);
INSERT INTO `role_has_permissions` VALUES (1058, 48);
INSERT INTO `role_has_permissions` VALUES (1059, 1);
INSERT INTO `role_has_permissions` VALUES (1059, 48);
INSERT INTO `role_has_permissions` VALUES (1060, 1);
INSERT INTO `role_has_permissions` VALUES (1060, 48);
INSERT INTO `role_has_permissions` VALUES (1061, 1);
INSERT INTO `role_has_permissions` VALUES (1061, 48);
INSERT INTO `role_has_permissions` VALUES (1062, 1);
INSERT INTO `role_has_permissions` VALUES (1062, 48);
INSERT INTO `role_has_permissions` VALUES (1063, 1);
INSERT INTO `role_has_permissions` VALUES (1063, 48);
INSERT INTO `role_has_permissions` VALUES (1064, 1);
INSERT INTO `role_has_permissions` VALUES (1064, 48);
INSERT INTO `role_has_permissions` VALUES (1065, 1);
INSERT INTO `role_has_permissions` VALUES (1065, 48);
INSERT INTO `role_has_permissions` VALUES (1066, 1);
INSERT INTO `role_has_permissions` VALUES (1066, 45);
INSERT INTO `role_has_permissions` VALUES (1066, 48);
INSERT INTO `role_has_permissions` VALUES (1067, 1);
INSERT INTO `role_has_permissions` VALUES (1067, 45);
INSERT INTO `role_has_permissions` VALUES (1067, 48);
INSERT INTO `role_has_permissions` VALUES (1068, 1);
INSERT INTO `role_has_permissions` VALUES (1068, 45);
INSERT INTO `role_has_permissions` VALUES (1068, 48);
INSERT INTO `role_has_permissions` VALUES (1069, 1);
INSERT INTO `role_has_permissions` VALUES (1069, 48);
INSERT INTO `role_has_permissions` VALUES (1070, 1);
INSERT INTO `role_has_permissions` VALUES (1070, 45);
INSERT INTO `role_has_permissions` VALUES (1070, 48);
INSERT INTO `role_has_permissions` VALUES (1071, 1);
INSERT INTO `role_has_permissions` VALUES (1071, 48);
INSERT INTO `role_has_permissions` VALUES (1072, 1);
INSERT INTO `role_has_permissions` VALUES (1072, 48);
INSERT INTO `role_has_permissions` VALUES (1073, 1);
INSERT INTO `role_has_permissions` VALUES (1073, 48);
INSERT INTO `role_has_permissions` VALUES (1074, 1);
INSERT INTO `role_has_permissions` VALUES (1074, 48);
INSERT INTO `role_has_permissions` VALUES (1075, 1);
INSERT INTO `role_has_permissions` VALUES (1075, 45);
INSERT INTO `role_has_permissions` VALUES (1075, 48);
INSERT INTO `role_has_permissions` VALUES (1076, 1);
INSERT INTO `role_has_permissions` VALUES (1076, 48);
INSERT INTO `role_has_permissions` VALUES (1077, 1);
INSERT INTO `role_has_permissions` VALUES (1077, 48);
INSERT INTO `role_has_permissions` VALUES (1078, 1);
INSERT INTO `role_has_permissions` VALUES (1078, 48);
INSERT INTO `role_has_permissions` VALUES (1167, 1);
INSERT INTO `role_has_permissions` VALUES (1167, 45);
INSERT INTO `role_has_permissions` VALUES (1167, 48);
INSERT INTO `role_has_permissions` VALUES (1168, 1);
INSERT INTO `role_has_permissions` VALUES (1168, 48);
INSERT INTO `role_has_permissions` VALUES (1169, 1);
INSERT INTO `role_has_permissions` VALUES (1169, 45);
INSERT INTO `role_has_permissions` VALUES (1169, 48);
INSERT INTO `role_has_permissions` VALUES (1170, 1);
INSERT INTO `role_has_permissions` VALUES (1170, 48);
INSERT INTO `role_has_permissions` VALUES (1171, 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Super Admin', 'web', '2023-09-27 05:14:54', '2024-01-24 09:30:04');
INSERT INTO `roles` VALUES (45, 'Operator-Print', 'web', '2024-01-24 10:04:38', '2024-05-13 10:15:13');
INSERT INTO `roles` VALUES (46, 'Operator 2', 'web', '2024-01-24 10:04:48', '2024-01-24 10:04:48');
INSERT INTO `roles` VALUES (47, 'Customer', 'web', '2024-01-24 10:05:00', '2024-05-10 10:21:23');
INSERT INTO `roles` VALUES (48, 'Publication OC', 'web', '2024-05-13 04:38:37', '2024-05-13 04:38:37');

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
  `shop_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` int NULL DEFAULT NULL,
  `bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank_branch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `account_no` bigint NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES (1, 'A.B. Perera', 'abc@gmail.com', '0375512622', 'Pronto', 'abc', 'producer', 1, 'BOC', 'Colombo', 2552623, '2024-05-04 07:28:31', '2024-05-04 07:28:31');

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
) ENGINE = InnoDB AUTO_INCREMENT = 143 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Super Admin', 'admin@gmail.com', NULL, '$2y$10$yHuYapn2xuOkmahe1xokkeaZU3P0c3dqsa9QzWIauZn63Q3THXXtu', 'NQRjDmf9sDUylRXXS8zsTKj6RjPeMYXNvz9KUmnLtMuGCxzddSjTmUClsx5z', '2023-09-27 05:14:54', '2023-09-27 05:14:54');
INSERT INTO `users` VALUES (2, 'Publication OC', 'publicationoc@gmail.com', NULL, '$2y$10$hgOA41KIPcXqPFBBVcEkHejvCVxx/LC9.oaBNeEitRjKmO4LNiWkW', NULL, '2024-05-13 04:40:53', '2024-05-13 04:40:53');
INSERT INTO `users` VALUES (140, 'Samson Perera', 'abc@gmail.com', NULL, '$2y$10$VaFVukuQsTVsQDo6wK1Th.OIqDZvKSaUWGuOJUdGxAVh1pUyc1cmW', NULL, '2024-05-10 09:43:34', '2024-05-10 09:43:34');
INSERT INTO `users` VALUES (142, 'Print Operator', 'print@gmail.com', NULL, '$2y$10$SKoMRvjLvcVGYPqG0zGC7uXP7EVVni5TLR82IKVc1byySZNn.e4zm', NULL, '2024-05-13 10:14:03', '2024-05-13 10:14:03');

-- ----------------------------
-- Table structure for workers
-- ----------------------------
DROP TABLE IF EXISTS `workers`;
CREATE TABLE `workers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `regiment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of workers
-- ----------------------------
INSERT INTO `workers` VALUES (2, 'S121545', 'L/Cpl', 'Operator', 'SLASC', '0771234567', '1', NULL, '2024-05-06 16:16:14', '2024-05-06 16:16:14');

SET FOREIGN_KEY_CHECKS = 1;
