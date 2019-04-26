/*
 Navicat Premium Data Transfer

 Source Server         : laravel16.zent
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : shoes

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 25/04/2019 20:27:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admins_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (1, 'admin', 'admin@gmail.com', '$2y$10$eG0NX5H7zLPsZJJRwu.OoOhrUcotu0uDY2HiIxCYMHLQgjbeDBSxm', 'ivXwVwoO1Ea2R2Z008sopdX1JJr37ss0FaMOuOSdmPZg05hUmi74Rm4adNAc', '2019-03-28 13:30:23', '2019-03-29 11:37:10');
INSERT INTO `admins` VALUES (2, 'phong', 'phong@gmail.com', '$2y$10$KoflClYEG5Fa3VhHC2vbWOW.LdVom29Bc8QXLjB.m/LHk7qO0uT1C', NULL, '2019-04-04 02:44:12', '2019-04-04 02:44:12');

-- ----------------------------
-- Table structure for brands
-- ----------------------------
DROP TABLE IF EXISTS `brands`;
CREATE TABLE `brands`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of brands
-- ----------------------------
INSERT INTO `brands` VALUES (1, 'Adidas', '2019-03-29 13:27:30', '2019-04-12 13:32:03', 'adidas');
INSERT INTO `brands` VALUES (2, 'Nike', '2019-03-29 13:40:11', '2019-04-12 13:31:59', 'nike');
INSERT INTO `brands` VALUES (20, 'New Balance', '2019-04-12 01:47:39', '2019-04-12 13:31:56', 'new-balance');
INSERT INTO `brands` VALUES (21, 'Converse', '2019-04-12 02:18:19', '2019-04-12 13:31:51', 'converse');
INSERT INTO `brands` VALUES (22, 'Không có', '2019-04-12 02:30:04', '2019-04-12 13:31:45', 'khong-co');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `parent_id` tinyint(4) NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `categories_slug_unique`(`slug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'HOME', 0, 'home', 'Trang chủ', '2019-04-03 03:20:22', '2019-04-03 03:20:22');
INSERT INTO `categories` VALUES (2, 'MAN', 0, 'man', 'Giày nam', '2019-04-03 03:22:44', '2019-04-12 11:50:31');
INSERT INTO `categories` VALUES (3, 'WOMEN', 0, 'women', 'Giày nữ', '2019-04-03 03:25:46', '2019-04-12 11:50:27');

-- ----------------------------
-- Table structure for colors
-- ----------------------------
DROP TABLE IF EXISTS `colors`;
CREATE TABLE `colors`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `colors_name_unique`(`name`) USING BTREE,
  UNIQUE INDEX `colors_description_unique`(`description`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of colors
-- ----------------------------
INSERT INTO `colors` VALUES (1, '#000000', 'Black', '2019-04-11 13:33:25', '2019-04-11 13:34:25');
INSERT INTO `colors` VALUES (2, '#FF0000', 'Red', '2019-04-11 13:34:37', '2019-04-11 13:34:51');
INSERT INTO `colors` VALUES (3, '#FFFF00', 'Yellow', '2019-04-11 13:35:01', '2019-04-11 13:35:01');
INSERT INTO `colors` VALUES (4, '#00FF00', 'Green', '2019-04-11 13:35:24', '2019-04-11 13:35:24');
INSERT INTO `colors` VALUES (5, '#A9A9A9', 'Gray', '2019-04-12 01:07:27', '2019-04-12 01:07:27');
INSERT INTO `colors` VALUES (6, '#FFFFFF', 'White', '2019-04-12 01:37:52', '2019-04-12 01:37:52');
INSERT INTO `colors` VALUES (7, '#B6A289', 'Beige', '2019-04-12 02:33:21', '2019-04-12 02:33:21');

-- ----------------------------
-- Table structure for materials
-- ----------------------------
DROP TABLE IF EXISTS `materials`;
CREATE TABLE `materials`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `materials_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of materials
-- ----------------------------
INSERT INTO `materials` VALUES (5, 'Chất liệu tổng hợp', '2019-04-12 01:02:15', '2019-04-12 01:02:15');
INSERT INTO `materials` VALUES (6, 'Sợi tổng hợp', '2019-04-12 01:39:01', '2019-04-12 01:39:01');
INSERT INTO `materials` VALUES (7, 'Da', '2019-04-12 01:58:30', '2019-04-12 01:58:30');
INSERT INTO `materials` VALUES (8, 'Da trơn', '2019-04-12 01:58:36', '2019-04-12 01:58:36');
INSERT INTO `materials` VALUES (9, 'Vải', '2019-04-12 02:18:44', '2019-04-12 02:18:44');
INSERT INTO `materials` VALUES (10, 'Da tổng hợp', '2019-04-12 02:37:17', '2019-04-12 02:37:17');
INSERT INTO `materials` VALUES (11, 'Da lộn', '2019-04-12 04:41:37', '2019-04-12 04:41:37');
INSERT INTO `materials` VALUES (12, 'Da bóng', '2019-04-12 04:46:17', '2019-04-12 04:46:17');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (6, '2019_03_25_125217_create_categories_table', 1);
INSERT INTO `migrations` VALUES (7, '2019_03_25_125321_create_sizes_table', 1);
INSERT INTO `migrations` VALUES (11, '2019_03_25_125633_create_brands_table', 1);
INSERT INTO `migrations` VALUES (13, '2019_03_25_130745_create_styles_table', 1);
INSERT INTO `migrations` VALUES (14, '2019_03_25_130809_create_materials_table', 1);
INSERT INTO `migrations` VALUES (19, '2019_03_25_125137_create_product_images_table', 1);
INSERT INTO `migrations` VALUES (21, '2014_10_12_000000_create_users_table', 2);
INSERT INTO `migrations` VALUES (23, '2019_03_28_123111_create_admins_table', 2);
INSERT INTO `migrations` VALUES (26, '2019_03_25_125051_create_product_details_table', 4);
INSERT INTO `migrations` VALUES (29, '2019_03_25_125338_create_colors_table', 7);
INSERT INTO `migrations` VALUES (30, '2019_03_25_122328_create_products_table', 8);
INSERT INTO `migrations` VALUES (31, '2019_04_12_132347_add_slug_to_brands', 9);
INSERT INTO `migrations` VALUES (32, '2019_04_17_022936_create_ratings_table', 10);
INSERT INTO `migrations` VALUES (33, '2019_03_25_125450_create_order_details_table', 11);
INSERT INTO `migrations` VALUES (35, '2019_03_25_125427_create_orders_table', 12);

-- ----------------------------
-- Table structure for order_details
-- ----------------------------
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `color_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `size_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of order_details
-- ----------------------------
INSERT INTO `order_details` VALUES (1, 1, 2, 4, '6', '1', '2019-04-22 12:19:27', '2019-04-22 12:19:27');
INSERT INTO `order_details` VALUES (2, 2, 1, 3, '5', '16', '2019-04-22 12:48:11', '2019-04-22 12:48:11');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_mobile` int(11) NOT NULL,
  `customer_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `orders_code_unique`(`code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (1, 1068, 'Nguyễn Hữu Phong', 986501670, 'P211 - I7 Đống Đa Hà Nội', 'Đang chờ', '2019-04-22 12:19:27', '2019-04-22 12:19:27');
INSERT INTO `orders` VALUES (2, 6670, 'Nguyễn Hữu Phong', 986501670, 'P211 - I7 Đống Đa Hà Nội', 'Đang chờ', '2019-04-22 12:48:11', '2019-04-22 12:48:11');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for product_details
-- ----------------------------
DROP TABLE IF EXISTS `product_details`;
CREATE TABLE `product_details`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `style_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 131 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of product_details
-- ----------------------------
INSERT INTO `product_details` VALUES (15, 1, 5, 14, 1, 5, 10, '2019-04-12 01:22:54', '2019-04-12 01:22:54');
INSERT INTO `product_details` VALUES (16, 1, 5, 15, 1, 5, 10, '2019-04-12 01:23:09', '2019-04-12 01:23:09');
INSERT INTO `product_details` VALUES (17, 1, 5, 16, 1, 5, 10, '2019-04-12 01:23:21', '2019-04-12 01:23:21');
INSERT INTO `product_details` VALUES (18, 1, 5, 1, 1, 5, 10, '2019-04-12 01:23:39', '2019-04-12 01:23:39');
INSERT INTO `product_details` VALUES (19, 1, 5, 2, 1, 5, 10, '2019-04-12 01:23:46', '2019-04-12 01:23:46');
INSERT INTO `product_details` VALUES (20, 1, 5, 3, 1, 5, 10, '2019-04-12 01:23:52', '2019-04-12 01:23:52');
INSERT INTO `product_details` VALUES (21, 1, 5, 4, 1, 5, 10, '2019-04-12 01:24:00', '2019-04-12 01:24:00');
INSERT INTO `product_details` VALUES (22, 1, 5, 5, 1, 5, 10, '2019-04-12 01:24:07', '2019-04-12 01:24:07');
INSERT INTO `product_details` VALUES (23, 1, 5, 6, 1, 5, 0, '2019-04-12 01:24:24', '2019-04-12 01:24:24');
INSERT INTO `product_details` VALUES (24, 2, 6, 14, 1, 6, 10, '2019-04-12 01:43:42', '2019-04-12 01:43:42');
INSERT INTO `product_details` VALUES (25, 2, 6, 15, 1, 6, 10, '2019-04-12 01:43:48', '2019-04-12 01:43:48');
INSERT INTO `product_details` VALUES (26, 2, 6, 16, 1, 6, 10, '2019-04-12 01:43:53', '2019-04-12 01:43:53');
INSERT INTO `product_details` VALUES (27, 2, 6, 1, 1, 6, 11, '2019-04-12 01:43:59', '2019-04-12 01:43:59');
INSERT INTO `product_details` VALUES (28, 2, 6, 2, 1, 6, 12, '2019-04-12 01:44:03', '2019-04-12 01:44:03');
INSERT INTO `product_details` VALUES (29, 2, 6, 3, 1, 6, 0, '2019-04-12 01:44:07', '2019-04-12 01:44:07');
INSERT INTO `product_details` VALUES (30, 2, 6, 4, 1, 6, 20, '2019-04-12 01:44:13', '2019-04-12 01:44:13');
INSERT INTO `product_details` VALUES (31, 2, 6, 5, 1, 6, 10, '2019-04-12 01:44:20', '2019-04-12 01:44:20');
INSERT INTO `product_details` VALUES (32, 2, 6, 6, 1, 6, 10, '2019-04-12 01:44:27', '2019-04-12 01:44:27');
INSERT INTO `product_details` VALUES (33, 3, 1, 2, 1, 5, 10, '2019-04-12 01:54:44', '2019-04-12 01:54:44');
INSERT INTO `product_details` VALUES (34, 3, 1, 3, 1, 5, 10, '2019-04-12 01:54:50', '2019-04-12 01:54:50');
INSERT INTO `product_details` VALUES (35, 3, 1, 4, 1, 5, 10, '2019-04-12 01:55:12', '2019-04-12 01:55:12');
INSERT INTO `product_details` VALUES (36, 3, 1, 5, 1, 5, 13, '2019-04-12 01:55:18', '2019-04-12 01:55:18');
INSERT INTO `product_details` VALUES (37, 3, 1, 6, 1, 5, 8, '2019-04-12 01:55:25', '2019-04-12 01:55:25');
INSERT INTO `product_details` VALUES (38, 3, 1, 7, 1, 5, 0, '2019-04-12 01:55:31', '2019-04-12 01:55:31');
INSERT INTO `product_details` VALUES (39, 4, 6, 14, 1, 6, 10, '2019-04-12 02:15:40', '2019-04-12 02:15:40');
INSERT INTO `product_details` VALUES (40, 4, 6, 15, 1, 6, 0, '2019-04-12 02:15:53', '2019-04-12 02:15:53');
INSERT INTO `product_details` VALUES (41, 4, 6, 16, 1, 6, 0, '2019-04-12 02:15:57', '2019-04-12 02:15:57');
INSERT INTO `product_details` VALUES (42, 4, 6, 1, 1, 6, 10, '2019-04-12 02:16:06', '2019-04-12 02:16:06');
INSERT INTO `product_details` VALUES (43, 4, 6, 2, 1, 6, 10, '2019-04-12 02:16:11', '2019-04-12 02:16:11');
INSERT INTO `product_details` VALUES (44, 4, 6, 3, 1, 6, 10, '2019-04-12 02:16:16', '2019-04-12 02:16:16');
INSERT INTO `product_details` VALUES (45, 4, 6, 4, 1, 6, 0, '2019-04-12 02:16:20', '2019-04-12 02:16:20');
INSERT INTO `product_details` VALUES (46, 4, 6, 5, 1, 6, 0, '2019-04-12 02:16:25', '2019-04-12 02:16:25');
INSERT INTO `product_details` VALUES (47, 4, 6, 6, 1, 6, 20, '2019-04-12 02:16:31', '2019-04-12 02:16:31');
INSERT INTO `product_details` VALUES (48, 5, 1, 14, 1, 9, 10, '2019-04-12 02:22:52', '2019-04-12 02:22:52');
INSERT INTO `product_details` VALUES (49, 5, 1, 15, 1, 9, 10, '2019-04-12 02:22:57', '2019-04-12 02:22:57');
INSERT INTO `product_details` VALUES (50, 5, 1, 16, 1, 9, 0, '2019-04-12 02:23:02', '2019-04-12 02:23:02');
INSERT INTO `product_details` VALUES (51, 5, 1, 1, 1, 9, 0, '2019-04-12 02:23:08', '2019-04-12 02:23:08');
INSERT INTO `product_details` VALUES (52, 5, 1, 2, 1, 9, 10, '2019-04-12 02:23:15', '2019-04-12 02:23:15');
INSERT INTO `product_details` VALUES (53, 5, 1, 3, 1, 9, 10, '2019-04-12 02:23:19', '2019-04-12 02:23:19');
INSERT INTO `product_details` VALUES (54, 5, 1, 4, 1, 9, 0, '2019-04-12 02:23:24', '2019-04-12 02:23:24');
INSERT INTO `product_details` VALUES (55, 5, 1, 5, 1, 9, 10, '2019-04-12 02:23:29', '2019-04-12 02:23:29');
INSERT INTO `product_details` VALUES (56, 6, 7, 13, 6, 10, 10, '2019-04-12 02:37:41', '2019-04-12 02:37:41');
INSERT INTO `product_details` VALUES (57, 6, 7, 14, 6, 10, 10, '2019-04-12 02:37:48', '2019-04-12 02:37:48');
INSERT INTO `product_details` VALUES (58, 6, 7, 15, 6, 10, 0, '2019-04-12 02:37:56', '2019-04-12 02:37:56');
INSERT INTO `product_details` VALUES (59, 6, 7, 16, 6, 10, 10, '2019-04-12 02:38:00', '2019-04-12 02:38:00');
INSERT INTO `product_details` VALUES (60, 6, 7, 1, 6, 10, 1, '2019-04-12 02:38:05', '2019-04-12 02:38:05');
INSERT INTO `product_details` VALUES (61, 7, 1, 13, 8, 10, 10, '2019-04-12 03:05:06', '2019-04-12 03:05:06');
INSERT INTO `product_details` VALUES (62, 7, 1, 14, 8, 10, 0, '2019-04-12 03:05:12', '2019-04-12 03:05:12');
INSERT INTO `product_details` VALUES (63, 7, 1, 15, 8, 10, 0, '2019-04-12 03:05:16', '2019-04-12 03:05:16');
INSERT INTO `product_details` VALUES (64, 7, 1, 16, 8, 10, 10, '2019-04-12 03:05:21', '2019-04-12 03:05:21');
INSERT INTO `product_details` VALUES (65, 7, 1, 1, 8, 10, 20, '2019-04-12 03:05:28', '2019-04-12 03:05:28');
INSERT INTO `product_details` VALUES (66, 8, 1, 13, 8, 10, 10, '2019-04-12 03:08:13', '2019-04-12 03:08:13');
INSERT INTO `product_details` VALUES (67, 8, 1, 14, 8, 10, 30, '2019-04-12 03:08:22', '2019-04-12 03:08:22');
INSERT INTO `product_details` VALUES (68, 8, 1, 15, 8, 10, 0, '2019-04-12 03:08:27', '2019-04-12 03:08:27');
INSERT INTO `product_details` VALUES (69, 8, 1, 16, 8, 10, 0, '2019-04-12 03:08:30', '2019-04-12 03:08:30');
INSERT INTO `product_details` VALUES (70, 8, 1, 1, 8, 10, 20, '2019-04-12 03:08:37', '2019-04-12 03:08:37');
INSERT INTO `product_details` VALUES (71, 9, 7, 13, 8, 10, 10, '2019-04-12 03:17:59', '2019-04-12 03:17:59');
INSERT INTO `product_details` VALUES (72, 9, 7, 14, 8, 10, 10, '2019-04-12 03:20:28', '2019-04-12 03:20:28');
INSERT INTO `product_details` VALUES (73, 9, 7, 15, 8, 10, 10, '2019-04-12 03:20:33', '2019-04-12 03:20:33');
INSERT INTO `product_details` VALUES (74, 9, 7, 16, 8, 10, 0, '2019-04-12 03:20:37', '2019-04-12 03:20:37');
INSERT INTO `product_details` VALUES (75, 9, 7, 1, 8, 10, 0, '2019-04-12 03:20:41', '2019-04-12 03:20:41');
INSERT INTO `product_details` VALUES (76, 10, 7, 13, 8, 10, 10, '2019-04-12 03:33:11', '2019-04-12 03:33:11');
INSERT INTO `product_details` VALUES (77, 10, 7, 14, 8, 10, 0, '2019-04-12 03:33:16', '2019-04-12 03:33:16');
INSERT INTO `product_details` VALUES (78, 10, 7, 15, 8, 10, 0, '2019-04-12 03:33:20', '2019-04-12 03:33:20');
INSERT INTO `product_details` VALUES (79, 10, 7, 16, 8, 10, 10, '2019-04-12 03:33:24', '2019-04-12 03:33:24');
INSERT INTO `product_details` VALUES (80, 10, 7, 1, 8, 10, 0, '2019-04-12 03:33:28', '2019-04-12 03:33:28');
INSERT INTO `product_details` VALUES (81, 11, 6, 13, 8, 10, 10, '2019-04-12 03:48:13', '2019-04-12 03:48:13');
INSERT INTO `product_details` VALUES (82, 11, 6, 14, 8, 10, 10, '2019-04-12 03:48:23', '2019-04-12 03:48:23');
INSERT INTO `product_details` VALUES (83, 11, 6, 15, 8, 10, 0, '2019-04-12 03:48:28', '2019-04-12 03:48:28');
INSERT INTO `product_details` VALUES (84, 11, 6, 16, 8, 10, 0, '2019-04-12 03:48:32', '2019-04-12 03:48:32');
INSERT INTO `product_details` VALUES (85, 11, 6, 1, 8, 10, 0, '2019-04-12 03:48:35', '2019-04-12 03:48:35');
INSERT INTO `product_details` VALUES (86, 12, 6, 13, 6, 10, 10, '2019-04-12 03:53:02', '2019-04-12 03:53:02');
INSERT INTO `product_details` VALUES (87, 12, 6, 14, 6, 10, 0, '2019-04-12 03:53:07', '2019-04-12 03:53:07');
INSERT INTO `product_details` VALUES (88, 12, 6, 15, 6, 10, 0, '2019-04-12 03:53:11', '2019-04-12 03:53:11');
INSERT INTO `product_details` VALUES (89, 12, 6, 16, 6, 10, 0, '2019-04-12 03:53:16', '2019-04-12 03:53:16');
INSERT INTO `product_details` VALUES (90, 12, 6, 1, 6, 10, 20, '2019-04-12 03:53:20', '2019-04-12 03:53:20');
INSERT INTO `product_details` VALUES (91, 13, 1, 13, 6, 10, 10, '2019-04-12 03:55:09', '2019-04-12 03:55:09');
INSERT INTO `product_details` VALUES (92, 13, 1, 14, 6, 10, 10, '2019-04-12 03:55:14', '2019-04-12 03:55:14');
INSERT INTO `product_details` VALUES (93, 13, 1, 15, 6, 10, 20, '2019-04-12 03:55:18', '2019-04-12 03:55:18');
INSERT INTO `product_details` VALUES (94, 13, 1, 16, 6, 10, 0, '2019-04-12 03:55:22', '2019-04-12 03:55:22');
INSERT INTO `product_details` VALUES (95, 13, 1, 1, 6, 10, 0, '2019-04-12 03:55:25', '2019-04-12 03:55:25');
INSERT INTO `product_details` VALUES (96, 14, 5, 13, 6, 10, 0, '2019-04-12 03:57:31', '2019-04-12 03:57:31');
INSERT INTO `product_details` VALUES (97, 14, 5, 14, 6, 10, 0, '2019-04-12 03:57:35', '2019-04-12 03:57:35');
INSERT INTO `product_details` VALUES (98, 14, 5, 15, 6, 10, 10, '2019-04-12 03:57:42', '2019-04-12 03:57:42');
INSERT INTO `product_details` VALUES (99, 14, 5, 16, 6, 10, 40, '2019-04-12 03:57:46', '2019-04-12 03:57:46');
INSERT INTO `product_details` VALUES (100, 14, 5, 1, 6, 10, 0, '2019-04-12 03:57:50', '2019-04-12 03:57:50');
INSERT INTO `product_details` VALUES (101, 15, 1, 13, 6, 10, 0, '2019-04-12 04:00:12', '2019-04-12 04:00:12');
INSERT INTO `product_details` VALUES (102, 15, 1, 14, 6, 10, 30, '2019-04-12 04:00:19', '2019-04-12 04:00:19');
INSERT INTO `product_details` VALUES (103, 15, 1, 15, 6, 10, 10, '2019-04-12 04:00:25', '2019-04-12 04:00:25');
INSERT INTO `product_details` VALUES (104, 15, 1, 16, 6, 10, 0, '2019-04-12 04:00:29', '2019-04-12 04:00:29');
INSERT INTO `product_details` VALUES (105, 15, 1, 1, 6, 10, 0, '2019-04-12 04:00:32', '2019-04-12 04:00:32');
INSERT INTO `product_details` VALUES (106, 16, 1, 12, 4, 10, 20, '2019-04-12 04:35:04', '2019-04-12 04:35:04');
INSERT INTO `product_details` VALUES (107, 16, 1, 13, 4, 10, 0, '2019-04-12 04:35:09', '2019-04-12 04:35:09');
INSERT INTO `product_details` VALUES (108, 16, 1, 14, 4, 10, 0, '2019-04-12 04:35:13', '2019-04-12 04:35:13');
INSERT INTO `product_details` VALUES (109, 16, 1, 15, 4, 10, 10, '2019-04-12 04:35:16', '2019-04-12 04:35:16');
INSERT INTO `product_details` VALUES (110, 16, 1, 16, 4, 10, 0, '2019-04-12 04:35:20', '2019-04-12 04:35:20');
INSERT INTO `product_details` VALUES (111, 16, 1, 1, 4, 10, 0, '2019-04-12 04:35:23', '2019-04-12 04:35:23');
INSERT INTO `product_details` VALUES (112, 17, 1, 12, 4, 11, 10, '2019-04-12 04:42:18', '2019-04-12 04:42:18');
INSERT INTO `product_details` VALUES (113, 17, 4, 12, 4, 11, 10, '2019-04-12 04:42:26', '2019-04-12 04:42:26');
INSERT INTO `product_details` VALUES (114, 17, 1, 13, 4, 11, 0, '2019-04-12 04:42:37', '2019-04-12 04:42:37');
INSERT INTO `product_details` VALUES (115, 17, 4, 13, 4, 11, 10, '2019-04-12 04:42:42', '2019-04-12 04:42:42');
INSERT INTO `product_details` VALUES (116, 17, 1, 14, 4, 11, 0, '2019-04-12 04:42:45', '2019-04-12 04:43:56');
INSERT INTO `product_details` VALUES (117, 17, 4, 14, 4, 11, 10, '2019-04-12 04:44:05', '2019-04-12 04:44:51');
INSERT INTO `product_details` VALUES (118, 17, 1, 15, 4, 11, 20, '2019-04-12 04:45:14', '2019-04-12 04:45:14');
INSERT INTO `product_details` VALUES (119, 17, 4, 15, 4, 11, 0, '2019-04-12 04:45:19', '2019-04-12 04:45:19');
INSERT INTO `product_details` VALUES (120, 18, 1, 13, 4, 12, 50, '2019-04-12 04:47:28', '2019-04-12 04:47:28');
INSERT INTO `product_details` VALUES (121, 19, 1, 13, 4, 10, 10, '2019-04-12 04:52:00', '2019-04-12 04:52:00');
INSERT INTO `product_details` VALUES (122, 19, 1, 14, 4, 10, 10, '2019-04-12 04:52:05', '2019-04-12 04:52:05');
INSERT INTO `product_details` VALUES (123, 19, 1, 15, 4, 10, 20, '2019-04-12 04:52:10', '2019-04-12 04:52:10');
INSERT INTO `product_details` VALUES (124, 19, 1, 16, 4, 10, 10, '2019-04-12 04:52:52', '2019-04-12 04:52:52');
INSERT INTO `product_details` VALUES (125, 19, 1, 1, 4, 10, 15, '2019-04-12 04:53:00', '2019-04-12 04:53:00');
INSERT INTO `product_details` VALUES (126, 20, 1, 13, 4, 12, 10, '2019-04-12 04:54:54', '2019-04-12 04:54:54');
INSERT INTO `product_details` VALUES (127, 20, 1, 14, 4, 12, 20, '2019-04-12 04:55:01', '2019-04-12 04:55:01');
INSERT INTO `product_details` VALUES (128, 20, 1, 15, 4, 12, 21, '2019-04-12 04:55:07', '2019-04-12 04:55:07');
INSERT INTO `product_details` VALUES (129, 20, 1, 16, 4, 12, 30, '2019-04-12 04:55:11', '2019-04-12 04:55:11');
INSERT INTO `product_details` VALUES (130, 20, 1, 1, 4, 12, 0, '2019-04-12 04:55:16', '2019-04-12 04:55:16');

-- ----------------------------
-- Table structure for product_images
-- ----------------------------
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED NOT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 122 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of product_images
-- ----------------------------
INSERT INTO `product_images` VALUES (17, 1, 'Yh9E_ss_addias_prophere_0000_IMG_6977.jpg', '2019-04-12 01:26:19', '2019-04-12 01:26:19');
INSERT INTO `product_images` VALUES (18, 1, 'fkw2_ss_addias_prophere_0001_IMG_6974.jpg', '2019-04-12 01:26:19', '2019-04-12 01:26:19');
INSERT INTO `product_images` VALUES (19, 1, 'hLMm_ss_addias_prophere_0002_IMG_6972.jpg', '2019-04-12 01:26:19', '2019-04-12 01:26:19');
INSERT INTO `product_images` VALUES (20, 1, '33Ve_ss_addias_prophere_0003_IMG_6962.jpg', '2019-04-12 01:26:19', '2019-04-12 01:26:19');
INSERT INTO `product_images` VALUES (21, 1, '3PXu_ss_addias_prophere_0004_IMG_6959.jpg', '2019-04-12 01:26:19', '2019-04-12 01:26:19');
INSERT INTO `product_images` VALUES (22, 1, '5ufy_ss_addias_prophere_0005_IMG_6956.jpg', '2019-04-12 01:26:19', '2019-04-12 01:26:19');
INSERT INTO `product_images` VALUES (23, 1, 'ZwQI_ss_addias_prophere_0006_IMG_6983.jpg', '2019-04-12 01:26:19', '2019-04-12 01:26:19');
INSERT INTO `product_images` VALUES (24, 1, 'ISg8_ss_addias_prophere_0007_IMG_6978.jpg', '2019-04-12 01:26:19', '2019-04-12 01:26:19');
INSERT INTO `product_images` VALUES (25, 2, 'N1Vl_footshop-Adidas-Alphabounce-Beyond-W-Ftw-White-Silver-Metallic-Ftw-White.jpeg', '2019-04-12 01:44:46', '2019-04-12 01:44:46');
INSERT INTO `product_images` VALUES (26, 2, 'nrgY_footshop-Adidas-Alphabounce-Beyond-W-Ftw-White-Silver-Metallic-Ftw-White-1.jpeg', '2019-04-12 01:44:46', '2019-04-12 01:44:46');
INSERT INTO `product_images` VALUES (27, 2, '6f0s_ss_alphabounce_0001_IMG_8430.jpg', '2019-04-12 01:44:46', '2019-04-12 01:44:46');
INSERT INTO `product_images` VALUES (28, 2, '8g44_ss_alphabounce_0001_IMG_8453.jpg', '2019-04-12 01:44:46', '2019-04-12 01:44:46');
INSERT INTO `product_images` VALUES (29, 2, 'Za08_ss_alphabounce_0001_IMG_8461.jpg', '2019-04-12 01:44:46', '2019-04-12 01:44:46');
INSERT INTO `product_images` VALUES (30, 2, 'Jjwo_ss_alphabounce_0002_IMG_8451.jpg', '2019-04-12 01:44:46', '2019-04-12 01:44:46');
INSERT INTO `product_images` VALUES (31, 2, '0MIV_ss_alphabounce_0002_IMG_8457.jpg', '2019-04-12 01:44:46', '2019-04-12 01:44:46');
INSERT INTO `product_images` VALUES (32, 2, 'yfcb_ss_alphabounce_0003_IMG_8448.jpg', '2019-04-12 01:44:46', '2019-04-12 01:44:46');
INSERT INTO `product_images` VALUES (33, 2, 'GaPA_ss_alphabounce_0003_IMG_8456.jpg', '2019-04-12 01:44:46', '2019-04-12 01:44:46');
INSERT INTO `product_images` VALUES (34, 2, 'u3z5_ss_alphabounce_0004_IMG_8417.jpg', '2019-04-12 01:44:46', '2019-04-12 01:44:46');
INSERT INTO `product_images` VALUES (35, 3, 'ica9_1-14.jpg', '2019-04-12 01:53:59', '2019-04-12 01:53:59');
INSERT INTO `product_images` VALUES (36, 3, '5sze_2-14.jpg', '2019-04-12 01:53:59', '2019-04-12 01:53:59');
INSERT INTO `product_images` VALUES (37, 3, 'inqD_3-13.jpg', '2019-04-12 01:53:59', '2019-04-12 01:53:59');
INSERT INTO `product_images` VALUES (38, 3, '0WE4_4-13.jpg', '2019-04-12 01:53:59', '2019-04-12 01:53:59');
INSERT INTO `product_images` VALUES (39, 3, 'tG82_5-13.jpg', '2019-04-12 01:53:59', '2019-04-12 01:53:59');
INSERT INTO `product_images` VALUES (40, 3, '0CHz_6-10.jpg', '2019-04-12 01:53:59', '2019-04-12 01:53:59');
INSERT INTO `product_images` VALUES (41, 3, 'QOiQ_7-5.jpg', '2019-04-12 01:53:59', '2019-04-12 01:53:59');
INSERT INTO `product_images` VALUES (42, 4, 'nncW_1-3.jpg', '2019-04-12 02:14:44', '2019-04-12 02:14:44');
INSERT INTO `product_images` VALUES (43, 4, '23Jr_2-2.jpg', '2019-04-12 02:14:44', '2019-04-12 02:14:44');
INSERT INTO `product_images` VALUES (44, 4, 'zD9A_3-2.jpg', '2019-04-12 02:14:44', '2019-04-12 02:14:44');
INSERT INTO `product_images` VALUES (45, 4, 'uL4m_4-2.jpg', '2019-04-12 02:14:44', '2019-04-12 02:14:44');
INSERT INTO `product_images` VALUES (46, 4, 'bMtX_5-2.jpg', '2019-04-12 02:14:44', '2019-04-12 02:14:44');
INSERT INTO `product_images` VALUES (47, 5, '2dDD_81.jpg', '2019-04-12 02:22:28', '2019-04-12 02:22:28');
INSERT INTO `product_images` VALUES (48, 5, 'TlVp_82.jpg', '2019-04-12 02:22:28', '2019-04-12 02:22:28');
INSERT INTO `product_images` VALUES (49, 5, 'XwV4_83.jpg', '2019-04-12 02:22:28', '2019-04-12 02:22:28');
INSERT INTO `product_images` VALUES (50, 5, '3ZQQ_84.jpg', '2019-04-12 02:22:28', '2019-04-12 02:22:28');
INSERT INTO `product_images` VALUES (51, 5, '0mKE_85.jpg', '2019-04-12 02:22:28', '2019-04-12 02:22:28');
INSERT INTO `product_images` VALUES (52, 6, 'kbjf_44792_1551338778.jpg', '2019-04-12 02:36:32', '2019-04-12 02:36:32');
INSERT INTO `product_images` VALUES (53, 6, 'Pnjz_44793_1551338802.jpg', '2019-04-12 02:36:32', '2019-04-12 02:36:32');
INSERT INTO `product_images` VALUES (54, 6, 'zqJB_44797_1551338874.jpg', '2019-04-12 02:36:32', '2019-04-12 02:36:32');
INSERT INTO `product_images` VALUES (55, 6, '77QZ_44799_1551338883.jpg', '2019-04-12 02:36:32', '2019-04-12 02:36:32');
INSERT INTO `product_images` VALUES (56, 6, '0YII_44800_1551338903.jpg', '2019-04-12 02:36:32', '2019-04-12 02:36:32');
INSERT INTO `product_images` VALUES (57, 7, 'YDdu_44254_1547548142.jpg', '2019-04-12 03:07:02', '2019-04-12 03:07:02');
INSERT INTO `product_images` VALUES (58, 7, '3LZt_44255_1547548165.jpg', '2019-04-12 03:07:02', '2019-04-12 03:07:02');
INSERT INTO `product_images` VALUES (59, 7, 'yZXX_44256_1547548184.jpg', '2019-04-12 03:07:02', '2019-04-12 03:07:02');
INSERT INTO `product_images` VALUES (60, 7, 'uncF_44258_1547548193.jpg', '2019-04-12 03:07:02', '2019-04-12 03:07:02');
INSERT INTO `product_images` VALUES (61, 7, 'U1wU_44263_1547548228.jpg', '2019-04-12 03:07:02', '2019-04-12 03:07:02');
INSERT INTO `product_images` VALUES (62, 8, 'N43h_45619_1554095926.jpg', '2019-04-12 03:09:42', '2019-04-12 03:09:42');
INSERT INTO `product_images` VALUES (63, 8, 'ogsw_45621_1554095944.jpg', '2019-04-12 03:09:42', '2019-04-12 03:09:42');
INSERT INTO `product_images` VALUES (64, 8, 'qnCM_45623_1554095964.jpg', '2019-04-12 03:09:42', '2019-04-12 03:09:42');
INSERT INTO `product_images` VALUES (65, 8, '4HaK_45628_1554096039.jpg', '2019-04-12 03:09:42', '2019-04-12 03:09:42');
INSERT INTO `product_images` VALUES (66, 8, 'nZ4J_45631_1554096064.jpg', '2019-04-12 03:09:42', '2019-04-12 03:09:42');
INSERT INTO `product_images` VALUES (67, 9, '3SQN_45616_1554095877.jpg', '2019-04-12 03:11:45', '2019-04-12 03:11:45');
INSERT INTO `product_images` VALUES (68, 9, 'LefD_45617_1554095895.jpg', '2019-04-12 03:11:45', '2019-04-12 03:11:45');
INSERT INTO `product_images` VALUES (69, 9, 'GRD5_45618_1554095914.jpg', '2019-04-12 03:11:45', '2019-04-12 03:11:45');
INSERT INTO `product_images` VALUES (70, 9, 'biQh_45620_1554095933.jpg', '2019-04-12 03:11:45', '2019-04-12 03:11:45');
INSERT INTO `product_images` VALUES (71, 9, 'DpZy_45622_1554095954.jpg', '2019-04-12 03:11:45', '2019-04-12 03:11:45');
INSERT INTO `product_images` VALUES (72, 10, 'aq7f_45961_1554432875.jpg', '2019-04-12 03:38:07', '2019-04-12 03:38:07');
INSERT INTO `product_images` VALUES (73, 10, 'f4ut_45962_1554432895.jpg', '2019-04-12 03:38:07', '2019-04-12 03:38:07');
INSERT INTO `product_images` VALUES (74, 10, 'Pl4q_45964_1554432968.jpg', '2019-04-12 03:38:07', '2019-04-12 03:38:07');
INSERT INTO `product_images` VALUES (75, 10, 'B0yo_45965_1554432977.jpg', '2019-04-12 03:38:07', '2019-04-12 03:38:07');
INSERT INTO `product_images` VALUES (76, 10, 'dXXb_45966_1554432997.jpg', '2019-04-12 03:38:07', '2019-04-12 03:38:07');
INSERT INTO `product_images` VALUES (77, 11, 'AI0e_45972_1554433440.jpg', '2019-04-12 03:47:37', '2019-04-12 03:47:37');
INSERT INTO `product_images` VALUES (78, 11, 'UL6j_45973_1554433463.jpg', '2019-04-12 03:47:37', '2019-04-12 03:47:37');
INSERT INTO `product_images` VALUES (79, 11, 'G4oW_45974_1554433490.jpg', '2019-04-12 03:47:37', '2019-04-12 03:47:37');
INSERT INTO `product_images` VALUES (80, 11, '1hXT_45975_1554433510.jpg', '2019-04-12 03:47:37', '2019-04-12 03:47:37');
INSERT INTO `product_images` VALUES (81, 11, 'N4vU_45976_1554433537.jpg', '2019-04-12 03:47:37', '2019-04-12 03:47:37');
INSERT INTO `product_images` VALUES (82, 12, 'lMCc_44932_1551342165.jpg', '2019-04-12 03:52:28', '2019-04-12 03:52:28');
INSERT INTO `product_images` VALUES (83, 12, '2xVw_44933_1551342186.jpg', '2019-04-12 03:52:28', '2019-04-12 03:52:28');
INSERT INTO `product_images` VALUES (84, 12, 'mcPc_44937_1551342255.jpg', '2019-04-12 03:52:28', '2019-04-12 03:52:28');
INSERT INTO `product_images` VALUES (85, 12, 'GXI3_44938_1551342266.jpg', '2019-04-12 03:52:28', '2019-04-12 03:52:28');
INSERT INTO `product_images` VALUES (86, 12, 'NGqs_44941_1551342294.jpg', '2019-04-12 03:52:28', '2019-04-12 03:52:28');
INSERT INTO `product_images` VALUES (87, 13, 'Uhyc_44935_1551342230.jpg', '2019-04-12 03:54:50', '2019-04-12 03:54:50');
INSERT INTO `product_images` VALUES (88, 13, '3qoW_44936_1551342249.jpg', '2019-04-12 03:54:50', '2019-04-12 03:54:50');
INSERT INTO `product_images` VALUES (89, 13, '3Hj4_44939_1551342270.jpg', '2019-04-12 03:54:50', '2019-04-12 03:54:50');
INSERT INTO `product_images` VALUES (90, 13, 'yRlG_44945_1551342367.jpg', '2019-04-12 03:54:50', '2019-04-12 03:54:50');
INSERT INTO `product_images` VALUES (91, 13, 'aPHn_44948_1551342407.jpg', '2019-04-12 03:54:50', '2019-04-12 03:54:50');
INSERT INTO `product_images` VALUES (92, 14, 'J6h8_45637_1554096234.jpg', '2019-04-12 03:57:15', '2019-04-12 03:57:15');
INSERT INTO `product_images` VALUES (93, 14, 'oH9u_45638_1554096253.jpg', '2019-04-12 03:57:15', '2019-04-12 03:57:15');
INSERT INTO `product_images` VALUES (94, 14, 'F0pC_45639_1554096272.jpg', '2019-04-12 03:57:15', '2019-04-12 03:57:15');
INSERT INTO `product_images` VALUES (95, 14, 'IjPQ_45643_1554096326.jpg', '2019-04-12 03:57:15', '2019-04-12 03:57:15');
INSERT INTO `product_images` VALUES (96, 14, 'vl2B_45644_1554096348.jpg', '2019-04-12 03:57:15', '2019-04-12 03:57:15');
INSERT INTO `product_images` VALUES (97, 15, 'hpg4_45637_1554096234.jpg', '2019-04-12 03:59:56', '2019-04-12 03:59:56');
INSERT INTO `product_images` VALUES (98, 15, 'rfnj_45638_1554096253.jpg', '2019-04-12 03:59:56', '2019-04-12 03:59:56');
INSERT INTO `product_images` VALUES (99, 15, 'qHfd_45639_1554096272.jpg', '2019-04-12 03:59:56', '2019-04-12 03:59:56');
INSERT INTO `product_images` VALUES (100, 15, 'XCty_45643_1554096326.jpg', '2019-04-12 03:59:56', '2019-04-12 03:59:56');
INSERT INTO `product_images` VALUES (101, 15, 'R2IR_45644_1554096348.jpg', '2019-04-12 03:59:56', '2019-04-12 03:59:56');
INSERT INTO `product_images` VALUES (102, 16, 'CXB6_4czrSp.jpg', '2019-04-12 04:30:04', '2019-04-12 04:30:04');
INSERT INTO `product_images` VALUES (103, 16, '9sWX_glXkZX.jpg', '2019-04-12 04:30:04', '2019-04-12 04:30:04');
INSERT INTO `product_images` VALUES (104, 16, 'lEPg_lGI3M8.jpg', '2019-04-12 04:30:04', '2019-04-12 04:30:04');
INSERT INTO `product_images` VALUES (105, 16, '8kqo_wxvt9E_simg_de2fe0_500x500_maxb.jpg', '2019-04-12 04:30:04', '2019-04-12 04:30:04');
INSERT INTO `product_images` VALUES (106, 17, '5e1s_5bmTeZ_simg_de2fe0_500x500_maxb.jpg', '2019-04-12 04:41:48', '2019-04-12 04:41:48');
INSERT INTO `product_images` VALUES (107, 17, 'lfaa_c0OXCw.jpg', '2019-04-12 04:41:48', '2019-04-12 04:41:48');
INSERT INTO `product_images` VALUES (108, 17, 'wABv_OpJqmd.jpg', '2019-04-12 04:41:48', '2019-04-12 04:41:48');
INSERT INTO `product_images` VALUES (109, 17, '8ijF_oxddYm.jpg', '2019-04-12 04:41:48', '2019-04-12 04:41:48');
INSERT INTO `product_images` VALUES (110, 18, 'WCZf_1FhvsN_simg_de2fe0_500x500_maxb.jpg', '2019-04-12 04:49:59', '2019-04-12 04:49:59');
INSERT INTO `product_images` VALUES (111, 18, 's6RI_bTp8Fo.jpg', '2019-04-12 04:49:59', '2019-04-12 04:49:59');
INSERT INTO `product_images` VALUES (112, 18, 'xxdn_byoik8.jpg', '2019-04-12 04:49:59', '2019-04-12 04:49:59');
INSERT INTO `product_images` VALUES (113, 19, '31tK_auXdzI_simg_de2fe0_500x500_maxb.jpg', '2019-04-12 04:52:28', '2019-04-12 04:52:28');
INSERT INTO `product_images` VALUES (114, 19, '7Kn1_KM75gM.jpg', '2019-04-12 04:52:28', '2019-04-12 04:52:28');
INSERT INTO `product_images` VALUES (115, 19, 'hMDh_ro0kno.jpg', '2019-04-12 04:52:28', '2019-04-12 04:52:28');
INSERT INTO `product_images` VALUES (116, 19, 'HeHn_yeeRAQ.jpg', '2019-04-12 04:52:28', '2019-04-12 04:52:28');
INSERT INTO `product_images` VALUES (117, 20, 'ubnS_0DDemV.jpg', '2019-04-12 04:55:26', '2019-04-12 04:55:26');
INSERT INTO `product_images` VALUES (118, 20, 'rxgX_EuRKa0.jpg', '2019-04-12 04:55:26', '2019-04-12 04:55:26');
INSERT INTO `product_images` VALUES (119, 20, 'rYgW_G85UKA.jpg', '2019-04-12 04:55:26', '2019-04-12 04:55:26');
INSERT INTO `product_images` VALUES (120, 20, 'f8Zp_PofHGm_simg_de2fe0_500x500_maxb.jpg', '2019-04-12 04:55:26', '2019-04-12 04:55:26');
INSERT INTO `product_images` VALUES (121, 20, '8O7J_XW3Msq.jpg', '2019-04-12 04:55:26', '2019-04-12 04:55:26');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `sale_price` int(11) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `content` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `products_slug_unique`(`slug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'A0001', 'Giày Adidas Prophere Sneakers Unisex Xám/Grey', 'giay-adidas-prophere-sneakers-unisex-xamgrey', 1090000, 0, 1, 1, '<span style=\"color: #707070; font-family: Roboto, Roboto; font-size: 15px;\">Adidas Prophere ch&iacute;nh l&agrave; c&aacute;i t&ecirc;n đang được nhắc đến nhiều nhất tr&ecirc;n c&aacute;c cộng đồng người chơi gi&agrave;y. Bộ đế v&agrave; midsole được thiết kế v&ocirc; c&ugrave;ng đặc biệt chắc chắn sẽ kh&ocirc;ng thể t&igrave;m thấy ở bất k&igrave; phi&ecirc;n bản n&agrave;o kh&aacute;c.Một trong những mẫu gi&agrave;y được thiết kế d&agrave;nh cho tương lai. Phong c&aacute;ch hiện đại, trẻ trung, sống động v&agrave; v&ocirc; c&ugrave;ng c&aacute; t&iacute;nh. Mang đậm sự kết hợp giữa thời trang đường phố streetwear v&agrave; thời trang thể thao. Đệm midsole ấn tượng v&agrave; kh&ocirc;ng thể lẫn lộn, Ngo&agrave;i ra, Prophere vẫn giữ những nguy&ecirc;n bản từ Adidas Original với c&aacute;c chi tiết g&oacute;c cạnh mạnh mẽ. Chất liệu da lộn tổng hợp sang trọng v&agrave; logo 3 sọc 3-Stripes nổi bật từ Adidas.</span>', 1, 'Adidas Prophere code A0001', 'FTnZ_ss_addias_prophere_0006_IMG_6983.jpg', '2019-04-12 01:20:29', '2019-04-12 01:50:52');
INSERT INTO `products` VALUES (2, 'A0002', 'Giày Sneakers Adidas Alphabounce Beyond Nam Nữ All White/Trắng', 'giay-sneakers-adidas-alphabounce-beyond-nam-nu-all-whitetrang', 1190000, 0, 1, 1, '<span style=\"color: #707070; font-family: Roboto, Roboto; font-size: 15px;\">Adidas Alphabounce l&agrave; mẫu gi&agrave;y chạy trung t&iacute;nh được thiết kế n&acirc;ng cấp hỗ trợ cho việc tập luyện v&agrave; hoạt động hằng ng&agrave;y. Upper với thiết kế lưới nguy&ecirc;n khối hỗ trợ tuyệt vời cho c&aacute;c chuyển động đa chiều. Đệm midsole &ldquo;phản ứng nhanh&rdquo; ở phần mu trước v&agrave; g&oacute;t ch&acirc;n tạo n&ecirc;n sự chắc chắn cho c&aacute;c b&agrave;i tập sức mạnh. Ngo&agrave;i ra, Alphabounce cũng được xem l&agrave; mẫu gi&agrave;y thời trang năng động với phong c&aacute;ch thiết kế hiện đại.&nbsp;&nbsp;</span>', 1, 'Adidas Alphabounce code A0002', '1ABU_footshop-Adidas-Alphabounce-Beyond-W-Ftw-White-Silver-Metallic-Ftw-White-1.jpeg', '2019-04-12 01:41:58', '2019-04-12 01:51:28');
INSERT INTO `products` VALUES (3, 'B0001', 'Giày New Balance NB MS247MR MENS CLASSIC (Đen)', 'giay-new-balance-nb-ms247mr-mens-classic-den', 2095000, 0, 2, 20, '', 1, 'New Balance code B0001', 'Cns1_1-14.jpg', '2019-04-12 01:53:36', '2019-04-12 01:53:36');
INSERT INTO `products` VALUES (4, 'N0001', 'Giày bóng rổ Nike Air Jordan 1 x \"Off-white\" Sneaker unisex nam nữ white/trắng', 'giay-bong-ro-nike-air-jordan-1-x-off-white-sneaker-unisex-nam-nu-whitetrang', 1690000, 0, 1, 2, '<p style=\"box-sizing: border-box; border: 0px; font-size: 15px; margin: 0px 0px 1.75em; outline: 0px; padding: 0px; vertical-align: baseline; color: #707070; font-family: Roboto, Roboto;\">Ph&aacute;t h&agrave;nh v&agrave;o ng&agrave;y 3/3/2018, mẫu Air Jordan 1 Retro High OFF-WHITE của Virgil Abloh đang được kỳ vọng l&agrave; phi&ecirc;n bản sneakers xuất sắc nhất năm nay. Với số lượng ph&aacute;t h&agrave;nh nhỏ giọt ở ch&acirc;u &Acirc;u, Air Jordan 1 Retro High OFF-WHITE c&agrave;ng khiến người y&ecirc;u gi&agrave;y ở Bắc Mỹ v&agrave; ch&acirc;u &Aacute; th&egrave;m muốn. Kết quả, mẫu gi&agrave;y n&agrave;y đứng đầu bảng xếp hạng v&igrave; gi&aacute; b&aacute;n lại cực cao tr&ecirc;n StockX: 1771 USD (khoảng 40 triệu đồng).</p>\n<p class=\"VCSortableInPreviewMode active\" style=\"box-sizing: border-box; border: 0px; font-size: 15px; margin: 0px 0px 1.75em; outline: 0px; padding: 0px; vertical-align: baseline; color: #707070; font-family: Roboto, Roboto;\"><em style=\"box-sizing: border-box; border: 0px; font-weight: inherit; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline;\"><span style=\"box-sizing: border-box; border: 0px; font-style: inherit; font-weight: bold; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline;\">Gi&agrave;y Off White X Nike Air Jordan</span></em>&nbsp;l&agrave; một sản phẩm kết hợp xu hướng&nbsp;<em style=\"box-sizing: border-box; border: 0px; font-weight: inherit; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline;\"><span style=\"box-sizing: border-box; border: 0px; font-style: inherit; font-weight: bold; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline;\">Off White</span></em>&nbsp;đang thống trị xu thế đường phố vẫn với tinh thần Gi&agrave;y Nike Air Jordan k&egrave;m với một số chi tiết nổi bật đặc trưng c&ugrave;a Off White.Ch&iacute;nh những điều đ&oacute; đ&atilde; mang đến n&eacute;t mới lạ cho Air Jordan.</p>', 1, 'Nike Air code N0001', 'ja3s_1-3.jpg', '2019-04-12 02:14:27', '2019-04-12 02:14:27');
INSERT INTO `products` VALUES (5, 'C0001', 'Giày Converse Classic Rubber Cổ Thấp Unisex Sneakers in Black/Đen', 'giay-converse-classic-rubber-co-thap-unisex-sneakers-in-blackden', 890000, 0, 1, 21, '<span style=\"color: #707070; font-family: Roboto, Roboto; font-size: 15px;\">Với thiết kế đơn giản, trẻ trung v&agrave; năng động đ&atilde; gi&uacute;p Converse dần trở th&agrave;nh một item thời trang đ&aacute;ng c&oacute; trong bộ sưu tập gi&agrave;y của tất cả mọi người n&oacute;i chung v&agrave; của c&aacute;c đầu gi&agrave;y n&oacute;i ri&ecirc;ng, nhất l&agrave; trong list thời trang của mọi c&ocirc; g&aacute;i đều chắc chắn c&oacute; 1 đ&ocirc;i gi&agrave;y Converse. Hướng đến ti&ecirc;u thời trang, Classic trở th&agrave;nh biểu tượng ph&ugrave; hợp với mọi độ tuổi, mọi tầng lớp, kh&ocirc;ng bao giờ lỗi thời.</span>', 1, 'Converse Classic code C0001', 'CCmq_81.jpg', '2019-04-12 02:21:50', '2019-04-12 02:22:11');
INSERT INTO `products` VALUES (6, 'C0002', 'Giày Cao Gót Đính Nơ - BMN 0331 - Màu Be', 'giay-cao-got-dinh-no-bmn-0331-mau-be', 545000, 0, 3, 22, '', 1, 'Giày cao gót đính nơ code C0002', 'gUVX_44792_1551338778.jpg', '2019-04-12 02:36:18', '2019-04-12 02:36:18');
INSERT INTO `products` VALUES (7, 'S0001', 'Giày Sandal Gót Vuông Quai Cổ Chân - SDN 0629 - Màu Đen', 'giay-sandal-got-vuong-quai-co-chan-sdn-0629-mau-den', 525000, 0, 3, 22, '', 1, 'Giày sandal gót vuông code S0001', 'ijiv_44254_1547548142.jpg', '2019-04-12 03:04:47', '2019-04-12 03:04:47');
INSERT INTO `products` VALUES (8, 'S0002', 'Giày Ankle Strap Bít Gót - SDK 0293 - Màu Đen', 'giay-ankle-strap-bit-got-sdk-0293-mau-den', 495000, 0, 3, 22, '', 1, 'Giày ankle strap code S0002', '0aTf_45619_1554095926.jpg', '2019-04-12 03:07:51', '2019-04-12 03:07:51');
INSERT INTO `products` VALUES (9, 'S0003', 'Giày Ankle Strap Bít Gót - SDK 0293 - Màu Be', 'giay-ankle-strap-bit-got-sdk-0293-mau-be', 495000, 0, 3, 22, '', 1, 'Giày ankle strap code S0003', '9krn_45616_1554095877.jpg', '2019-04-12 03:11:30', '2019-04-12 03:11:30');
INSERT INTO `products` VALUES (10, 'S0004', 'Giày Sandal Phối Khóa Cài - SDK 0294 - Màu Be', 'giay-sandal-phoi-khoa-cai-sdk-0294-mau-be', 475000, 0, 3, 22, '', 1, 'Giày sandal khối code S0004', '6nbd_45962_1554432895.jpg', '2019-04-12 03:28:16', '2019-04-12 03:28:16');
INSERT INTO `products` VALUES (11, 'S0005', 'Giày Sandal Phối Khóa Cài - SDK 0294 - Màu Trắng', 'giay-sandal-phoi-khoa-cai-sdk-0294-mau-trang', 475000, 0, 3, 22, '', 1, 'Giày sandal code S0005', 'EjSi_45973_1554433463.jpg', '2019-04-12 03:47:16', '2019-04-12 03:47:16');
INSERT INTO `products` VALUES (12, 'C0003', 'Giày Sandal Họa Tiết Nhiệt Đới - SDN 0631 - Màu Trắng', 'giay-sandal-hoa-tiet-nhiet-doi-sdn-0631-mau-trang', 545000, 0, 3, 22, '', 1, 'Giày sandal cao gót code C0003', 'C0z7_44933_1551342186.jpg', '2019-04-12 03:52:17', '2019-04-12 03:52:17');
INSERT INTO `products` VALUES (13, 'C0004', 'Giày Sandal Họa Tiết Nhiệt Đới - SDN 0631 - Màu Đen', 'giay-sandal-hoa-tiet-nhiet-doi-sdn-0631-mau-den', 545000, 0, 3, 22, '', 1, 'Giày sandal cao gót code C0004', '29F4_44936_1551342249.jpg', '2019-04-12 03:54:32', '2019-04-12 03:54:32');
INSERT INTO `products` VALUES (14, 'C0005', 'Giày Sandal Gót Trụ Trong Suốt - SDN 0630 - Màu Xám', 'giay-sandal-got-tru-trong-suot-sdn-0630-mau-xam', 575000, 0, 3, 22, '', 1, 'Giày cao gót C0005', 'y0i9_45638_1554096253.jpg', '2019-04-12 03:57:01', '2019-04-12 03:57:01');
INSERT INTO `products` VALUES (15, 'C0006', 'Giày Cao Gót Đính Nơ - BMN 0331 - Màu Đen', 'giay-cao-got-dinh-no-bmn-0331-mau-den', 545000, 0, 3, 22, '', 1, 'Giày cao gót C0006', '3QGE_45638_1554096253.jpg', '2019-04-12 03:59:47', '2019-04-12 03:59:47');
INSERT INTO `products` VALUES (16, 'B0002', 'Giày boot nữ cao gót đế vuông 9cm - 6391', 'giay-boot-nu-cao-got-de-vuong-9cm-6391', 330000, 0, 3, 22, '', 1, 'Giày boots B0002', 'yq47_4czrSp.jpg', '2019-04-12 04:28:22', '2019-04-12 04:28:22');
INSERT INTO `products` VALUES (17, 'B0003', 'Giày boot viền đinh - boot_viendinh', 'giay-boot-vien-dinh-bootviendinh', 245000, 0, 3, 22, '', 1, 'boots viền B0003', 'Cz0B_5bmTeZ_simg_de2fe0_500x500_maxb.jpg', '2019-04-12 04:41:28', '2019-04-12 04:41:28');
INSERT INTO `products` VALUES (18, 'B0004', 'Bốt nữ da phong cách Hàn Quốc - bdn', 'bot-nu-da-phong-cach-han-quoc-bdn', 200000, 0, 3, 22, '', 1, 'Boots nữ B0004', 'raSZ_1FhvsN_simg_de2fe0_500x500_maxb.jpg', '2019-04-12 04:47:02', '2019-04-12 04:47:02');
INSERT INTO `products` VALUES (19, 'B0005', 'Bốt lưới nữ xinh - M010', 'bot-luoi-nu-xinh-m010', 300000, 0, 3, 22, '', 1, 'Boots lưới B0005', 'RwaP_auXdzI_simg_de2fe0_500x500_maxb.jpg', '2019-04-12 04:51:39', '2019-04-12 04:51:39');
INSERT INTO `products` VALUES (20, 'B0006', 'Giày boot chelsea dây kéo - Giày boot chelsea dây kéo', 'giay-boot-chelsea-day-keo-giay-boot-chelsea-day-keo', 400000, 0, 3, 22, '', 1, 'Giày boots chelsea B0006', 'pSEN_PofHGm_simg_de2fe0_500x500_maxb.jpg', '2019-04-12 04:54:35', '2019-04-12 04:54:35');

-- ----------------------------
-- Table structure for ratings
-- ----------------------------
DROP TABLE IF EXISTS `ratings`;
CREATE TABLE `ratings`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `rateable_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rateable_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `ratings_rateable_type_rateable_id_index`(`rateable_type`, `rateable_id`) USING BTREE,
  INDEX `ratings_rateable_id_index`(`rateable_id`) USING BTREE,
  INDEX `ratings_rateable_type_index`(`rateable_type`) USING BTREE,
  INDEX `ratings_user_id_index`(`user_id`) USING BTREE,
  CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for sizes
-- ----------------------------
DROP TABLE IF EXISTS `sizes`;
CREATE TABLE `sizes`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `sizes_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sizes
-- ----------------------------
INSERT INTO `sizes` VALUES (1, '39', '2019-04-04 03:24:29', '2019-04-04 03:24:29');
INSERT INTO `sizes` VALUES (2, '40', '2019-04-04 03:24:33', '2019-04-04 03:24:33');
INSERT INTO `sizes` VALUES (3, '41', '2019-04-04 03:24:36', '2019-04-04 03:24:36');
INSERT INTO `sizes` VALUES (4, '42', '2019-04-04 03:24:38', '2019-04-04 03:24:38');
INSERT INTO `sizes` VALUES (5, '43', '2019-04-04 03:24:41', '2019-04-04 03:24:41');
INSERT INTO `sizes` VALUES (6, '44', '2019-04-04 03:24:44', '2019-04-04 03:24:44');
INSERT INTO `sizes` VALUES (7, '45', '2019-04-04 03:24:52', '2019-04-04 03:24:52');
INSERT INTO `sizes` VALUES (8, '46', '2019-04-04 03:24:55', '2019-04-04 03:24:59');
INSERT INTO `sizes` VALUES (9, '47', '2019-04-04 03:25:02', '2019-04-04 03:25:02');
INSERT INTO `sizes` VALUES (10, '48', '2019-04-04 03:25:06', '2019-04-04 03:25:06');
INSERT INTO `sizes` VALUES (11, '49', '2019-04-04 03:25:09', '2019-04-04 03:25:09');
INSERT INTO `sizes` VALUES (12, '34', '2019-04-04 03:25:24', '2019-04-04 03:25:24');
INSERT INTO `sizes` VALUES (13, '35', '2019-04-04 03:25:27', '2019-04-04 03:25:27');
INSERT INTO `sizes` VALUES (14, '36', '2019-04-04 03:25:31', '2019-04-04 03:25:31');
INSERT INTO `sizes` VALUES (15, '37', '2019-04-04 03:25:34', '2019-04-04 03:25:34');
INSERT INTO `sizes` VALUES (16, '38', '2019-04-04 03:25:36', '2019-04-04 03:25:36');

-- ----------------------------
-- Table structure for styles
-- ----------------------------
DROP TABLE IF EXISTS `styles`;
CREATE TABLE `styles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `styles_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of styles
-- ----------------------------
INSERT INTO `styles` VALUES (1, 'Sneaker', '2019-04-04 05:42:09', '2019-04-12 00:53:09');
INSERT INTO `styles` VALUES (2, 'Giày tây', '2019-04-04 05:42:27', '2019-04-12 00:53:05');
INSERT INTO `styles` VALUES (3, 'Giày lười', '2019-04-04 05:42:50', '2019-04-12 00:53:01');
INSERT INTO `styles` VALUES (4, 'Bốt', '2019-04-04 05:43:06', '2019-04-12 00:51:38');
INSERT INTO `styles` VALUES (6, 'Giày  cao gót', '2019-04-04 05:43:20', '2019-04-12 00:52:18');
INSERT INTO `styles` VALUES (7, 'Giày đế bằng', '2019-04-04 05:43:31', '2019-04-12 00:52:41');
INSERT INTO `styles` VALUES (8, 'Sandal', '2019-04-12 00:52:53', '2019-04-12 00:52:53');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  UNIQUE INDEX `users_address_unique`(`address`) USING BTREE,
  UNIQUE INDEX `users_phone_unique`(`phone`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Nguyễn Hữu Phong', 'phong147x@gmail.com', '$2y$10$6rjQSEIx.tT9D5h1KHs/GuKNBm6.R16PddzZHJ9Uqm1bCNHuD2SZm', 'P211 - I7 Đống Đa Hà Nội', '0986501670', 'ElHeJVeVC7BUuNS320H3YgXQdZKO1vr8OVhXo40Ooy7aOC1HDGctI5bao8PO', '2019-03-28 12:52:49', '2019-03-29 02:58:17');

SET FOREIGN_KEY_CHECKS = 1;
