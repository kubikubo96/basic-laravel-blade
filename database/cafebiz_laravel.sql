/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50736
 Source Host           : localhost:3306
 Source Schema         : cafebiz_laravel

 Target Server Type    : MySQL
 Target Server Version : 50736
 File Encoding         : 65001

 Date: 04/06/2022 20:53:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NULL DEFAULT NULL,
  `post_id` int(20) NULL DEFAULT NULL,
  `content` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 0 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES (1, 5, 1, 'comment', NULL, '2022-06-04 15:53:15', '2022-06-04 15:53:15');

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `can_not_delete` tinyint(4) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 0 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'list-user', 'list-user', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (2, 'create-user', 'create-user', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (3, 'update-user', 'update-user', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (4, 'delete-user', 'delete-user', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (5, 'list-post', 'list-post', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (6, 'create-post', 'create-post', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (8, 'create-comment', 'create-comment', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (9, 'update-comment', 'update-comment', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (10, 'delete-comment', 'delete-comment', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (11, 'delete-any-post', 'delete-any-post', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(20) UNSIGNED NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 0 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES (1, 4, 'title 1', 'title-1', '<p>content 1</p>', 'danong.png', NULL, '2022-06-04 15:53:34', '2022-06-04 15:53:34');
INSERT INTO `posts` VALUES (2, 4, 'title 2', 'title-2', '<p>content 2</p>', 'docthan.jpg', NULL, '2022-06-04 15:53:35', '2022-06-04 15:53:35');
INSERT INTO `posts` VALUES (3, 5, 'title 3', 'title-3', '<p>content 3</p>', 'rangdong.jpg', NULL, '2022-06-04 20:10:31', '2022-06-04 20:10:31');

-- ----------------------------
-- Table structure for role_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_permissions`;
CREATE TABLE `role_permissions`  (
  `role_id` int(20) NOT NULL,
  `permission_id` int(20) NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of role_permissions
-- ----------------------------
INSERT INTO `role_permissions` VALUES (1, 1);
INSERT INTO `role_permissions` VALUES (1, 2);
INSERT INTO `role_permissions` VALUES (1, 3);
INSERT INTO `role_permissions` VALUES (1, 4);
INSERT INTO `role_permissions` VALUES (2, 5);
INSERT INTO `role_permissions` VALUES (2, 6);
INSERT INTO `role_permissions` VALUES (4, 11);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `can_not_delete` tinyint(4) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 0 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Quản lý user', 'users', NULL, '2022-06-04 19:26:07', '2022-06-04 19:26:07');
INSERT INTO `roles` VALUES (2, 'Quản lý post', 'posts', NULL, '2022-06-04 18:49:58', '2022-06-04 18:49:58');
INSERT INTO `roles` VALUES (3, 'Quản lý bình luận', 'comments', NULL, '2022-06-04 18:49:59', '2022-06-04 18:49:59');
INSERT INTO `roles` VALUES (4, 'Quyền xóa bất kỳ bài post nào', 'delete-any-post', 1, '2022-06-04 20:40:51', '2022-06-04 20:40:51');

-- ----------------------------
-- Table structure for user_roles
-- ----------------------------
DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles`  (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NULL DEFAULT NULL
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of user_roles
-- ----------------------------
INSERT INTO `user_roles` VALUES (2, 1);
INSERT INTO `user_roles` VALUES (2, 2);
INSERT INTO `user_roles` VALUES (3, 1);
INSERT INTO `user_roles` VALUES (4, 2);
INSERT INTO `user_roles` VALUES (2, 4);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` int(20) NOT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 0 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'supperadmin', 'supperadmin@gmail.com', '$2y$10$2bXEoeEyF6OUMyZePTuXU.SbfuB8EtGrEU8Wt.ITxv1gIzGpv6F2y', 1, NULL, NULL, NULL);
INSERT INTO `users` VALUES (2, 'admin', 'admin@gmail.com', '$2y$10$2bXEoeEyF6OUMyZePTuXU.SbfuB8EtGrEU8Wt.ITxv1gIzGpv6F2y', 1, NULL, NULL, NULL);
INSERT INTO `users` VALUES (3, 'user', 'user@gmail.com', '$2y$10$nMo7O4u/UaVzfh44UdSyHOOmbKwhHjWAOZly/exGwxrxi0hJo0786', 1, NULL, NULL, NULL);
INSERT INTO `users` VALUES (4, 'author1', 'author1@gmail.com', '$2y$10$nMo7O4u/UaVzfh44UdSyHOOmbKwhHjWAOZly/exGwxrxi0hJo0786', 1, NULL, NULL, NULL);
INSERT INTO `users` VALUES (5, 'author2', 'author2@gmail.com', '$2y$10$nMo7O4u/UaVzfh44UdSyHOOmbKwhHjWAOZly/exGwxrxi0hJo0786', 1, NULL, NULL, NULL);
INSERT INTO `users` VALUES (6, 'tiennt', 'tiennt@gmail.com', '$2y$10$nMo7O4u/UaVzfh44UdSyHOOmbKwhHjWAOZly/exGwxrxi0hJo0786', 0, NULL, NULL, NULL);
