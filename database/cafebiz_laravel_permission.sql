/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : cafebiz_laravel

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-11-11 17:24:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
                            `id` int(20) NOT NULL AUTO_INCREMENT,
                            `user_id` int(20) DEFAULT NULL,
                            `post_id` int(20) DEFAULT NULL,
                            `content_comment` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
                            `deleted_at` timestamp NULL DEFAULT NULL,
                            `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                            `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
                         `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                         `user_id` int(20) unsigned NOT NULL,
                         `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `title_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `content_post` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                         `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `deleted_at` timestamp NULL DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                         `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('1', '1', 'Sức mạnh khủng khiếp của người tiêu dùng Trung Quốc: Alibaba thu về 10 tỷ USD chỉ sau 30 phút đầu tiên của Ngày Cô Đơn, các thương hiệu toàn cầu từ nhỏ đến lớn đều tham gia bán hàng', 'suc-manh-khung-khiep -cua-nguoi-tieu-dung-trung-quoc', '<p>Người ti&ecirc;u d&ugrave;ng Trung Quốc đ&atilde; ti&ecirc;u khoảng 10 tỷ USD chỉ trong chưa đầy 30 ph&uacute;t đầu ti&ecirc;n của ng&agrave;y C&ocirc; đơn (Singles&#39;s Day) 2019. Rất nhiều h&agrave;ng ho&aacute; được b&aacute;n ra từ thiết bị điện tử ti&ecirc;u d&ugrave;ng đến cả những m&oacute;n đồ xa xỉ như &ocirc; t&ocirc;. Con số n&agrave;y tương đương với 1/3 tổng gia trị giao dịch cả ng&agrave;y n&agrave;y v&agrave;o năm ngo&aacute;i, đạt 30,8 tỷ USD.&nbsp;</p>\n\n<p>T&iacute;nh đến thời điểm n&agrave;y, cập nhập của tờ SCMP th&igrave; tổng gi&aacute; trị giao dịch ng&agrave;y C&ocirc; đơn năm nay đ&atilde; đạt 30 tỷ USD, tức l&agrave; vượt qua cả con số v&agrave;o năm ngo&aacute;i.&nbsp;</p>\n\n<p>Singles&#39; Day h&agrave;ng năm đ&atilde; trở th&agrave;nh lễ hội mua sắm lớn nhất tr&ecirc;n thế giới do Alibaba khởi xướng. Ngo&agrave;i Tmall v&agrave; Taobao l&agrave; 2 nền tảng mua sắm truyền thống, năm nay Alibaba c&ograve;n mở rộng sang c&aacute;c nền tảng gồm Lazada, AliExpress với mong muốn thu h&uacute;t th&ecirc;m những kh&aacute;ch h&agrave;ng b&ecirc;n ngo&agrave;i Trung Quốc.&nbsp;</p>\n\n<p>Mỹ, Anh, Australia v&agrave; Nhật Bản l&agrave; những thị trường nước ngo&agrave;i c&oacute; nhiều người mua nhất trong ng&agrave;y n&agrave;y.&nbsp;</p>\n\n<p>&quot;Singles&rsquo; Day đang được nhận diện tr&ecirc;n to&agrave;n cầu nhiều hơn nhưng đ&acirc;y vẫn l&agrave; một sự kiện trong nước hơn, n&oacute; cho thấy sức mạnh khủng khiếp của người ti&ecirc;u d&ugrave;ng Trung Quốc&quot;, một chuy&ecirc;n gia đến từ EY n&oacute;i.&nbsp;</p>\n\n<p>Alibaba tổ chức ng&agrave;y Singles&rsquo; Day đầu ti&ecirc;n v&agrave;o năm 2009 như một chiến dịch quảng c&aacute;o nhưng ng&agrave;y n&agrave;y đ&atilde; dần trở th&agrave;nh một sự kiện mua sắm khổng lồ. Năm ngo&aacute;i, người ti&ecirc;u d&ugrave;ng Trung Quốc đ&atilde; ti&ecirc;u nhiều hơn 4.000 lần so với tổng chi ti&ecirc;u trong Singles&rsquo; Day đầu ti&ecirc;n m&agrave; Alibaba tổ chức.&nbsp;</p>\n\n<p>Thậm ch&iacute;, từ trước khi ng&agrave;y 11/11 diễn ra, người ti&ecirc;u d&ugrave;ng đ&atilde; tỏ ra rất h&agrave;o hứng với sự kiện n&agrave;y. Thống k&ecirc; cho thấy 64 thương hiệu gồm cả Apple, Dyson, Lancome v&agrave; L&rsquo;Oreal... đ&atilde; chứng kiến doanh số b&aacute;n h&agrave;ng đặt trước đạt 100 triệu NDT.&nbsp;</p>\n\n<p>Tại Trung Quốc, ng&agrave;y h&ocirc;m nay được gọi l&agrave; Singles&rsquo; Day ( Ng&agrave;y C&ocirc; đơn ) bởi c&oacute; 4 số 1 đứng c&ugrave;ng nhau (11/11). Để kỷ niệm ng&agrave;y n&agrave;y, cư d&acirc;n mạng Trung Quốc (v&agrave; đặc biệt l&agrave; những người độc th&acirc;n) thường chi một lượng tiền khổng lồ để mua sắm trực tuyến.</p>\n\n<p><a href=\"http://cafebiz.vn/de-nghi-huu-o-tuoi-55-thanh-thoi-ngoi-tren-bai-bien-thi-ra-jack-ma-so-huu-1-co-may-in-tien-bi-mat-giup-ong-lien-tuc-giau-hon-du-khong-can-lam-gi-ca-20191031160840446.chn\" target=\"_blank\" title=\"Để nghỉ hưu ở tuổi 55, thảnh thơi ngồi trên bãi biển thì ra Jack Ma sở hữu 1 cỗ máy in tiền bí mật, giúp ông liên tục giàu hơn dù không cần làm gì cả\">Để nghỉ hưu ở tuổi 55, thảnh thơi &#39;ngồi tr&ecirc;n b&atilde;i biển&#39; th&igrave; ra Jack Ma sở hữu 1 cỗ m&aacute;y in tiền b&iacute; mật, gi&uacute;p &ocirc;ng li&ecirc;n tục gi&agrave;u hơn d&ugrave; kh&ocirc;ng cần l&agrave;m g&igrave; cả</a></p>\n\n<p><strong>V&acirc;n Đ&agrave;m</strong></p>\n\n<p>Theo Tr&iacute; Thức Trẻ</p>', 'docthan.jpg', null, '2019-11-11 02:21:41', '2019-11-11 02:21:41');
INSERT INTO `posts` VALUES ('2', '1', 'Ngày lễ độc thân 11.11 bắt nguồn từ đâu?', 'ngay-le-doc-than-11-11-bat-nguon-tu-dau', '<p><strong>Nguồn gốc&nbsp;</strong><strong>Ng&agrave;y lễ độc th&acirc;n 11.11</strong></p>\n\n<p>V&agrave;o ng&agrave;y 11.11.1990, một số học sinh tại Đại học Nam Kinh, Trung Quốc đ&atilde; tập hợp với nhau để &quot;ăn mừng&quot; sự c&ocirc; đơn của m&igrave;nh. Những học sinh n&agrave;y cũng gọi đ&acirc;y l&agrave; ng&agrave;y lễ độc th&acirc;n bởi ng&agrave;y n&agrave;y được cấu tạo từ 4 chữ số 1, giống như 4 c&acirc;y gậy xếp liền nhau.</p>\n\n<p>Người Trung Quốc gọi ng&agrave;y n&agrave;y l&agrave; ng&agrave;y &quot;quang c&ocirc;n&quot;, hay c&ograve;n gọi l&agrave; ng&agrave;y &quot;to&agrave;n gậy&quot;. &quot;Quang c&ocirc;n&quot; trong tiếng Trung c&ograve;n c&oacute; nghĩa l&agrave; độc th&acirc;n. Bởi vậy, ng&agrave;y lễ n&agrave;y đ&atilde; được giới trẻ Trung Quốc lấy l&agrave;m dịp lễ đặc biệt d&agrave;nh cho những người c&ograve;n độc th&acirc;n.</p>\n\n<p>V&agrave;o ng&agrave;y n&agrave;y, những người độc th&acirc;n sẽ tụ tập ăn uống, uống rượu v&agrave; vui chơi để qu&ecirc;n đi sự c&ocirc; đơn. Hiện, Ng&agrave;y lễ độc th&acirc;n kh&ocirc;ng chỉ d&agrave;nh ri&ecirc;ng cho giới trẻ Trung Quốc. Kh&aacute;i niệm &quot;Single&#39;s Day - Lễ độc th&acirc;n 11.11 &quot; đ&atilde; được phổ biến tr&ecirc;n nhiều quốc gia tr&ecirc;n thế giới trong đ&oacute; c&oacute; Việt Nam.</p>\n\n<p><strong>Ng&agrave;y hội mua sắm lớn nhất Trung Quốc</strong></p>\n\n<p>Ng&agrave;y 11.11.2009, tỉ ph&uacute; Jack Ma đ&atilde; đưa ng&agrave;y n&agrave;y v&agrave;o một trong những dịp lễ, tết để thực hiện c&aacute;c chương tr&igrave;nh khuyến m&atilde;i, mua sắm tại Alibaba.</p>\n\n<p>Năm đầu ti&ecirc;n &aacute;p dụng, Alibaba hướng đến khuyến kh&iacute;ch người ti&ecirc;u d&ugrave;ng cho m&igrave;nh quyền &quot;tự thưởng&quot; cho bản th&acirc;n để ăn mừng Ng&agrave;y lễ độc th&acirc;n . Ngay sau khi chiến dịch khuyến m&atilde;i của Alibaba đạt hiệu ứng lớn, đối thủ JD.com đ&atilde; nhanh ch&oacute;ng &aacute;p dụng khuyến m&atilde;i nh&acirc;n ng&agrave;y 11.11 v&agrave; đạt được doanh thu lớn.</p>\n\n<p>Sau đ&oacute; một loạt c&aacute;c tập đo&agrave;n lớn, trong đ&oacute; c&oacute; Amazon cũng tung ra những chiến dịch khuyến m&atilde;i quy m&ocirc; lớn nh&acirc;n ng&agrave;y 11.11 v&agrave;o năm 2015.</p>\n\n<p>Năm 2011, doanh thu ng&agrave;y 11.11 của Alibaba đạt 168,2 tỉ nh&acirc;n d&acirc;n tệ (tương đương với 25,4 tỉ USD). Trong khu đ&oacute; JD.com đạt doanh thu 19,1 tỉ USD.</p>\n\n<p>Hiện nay, tại Việt Nam, nhiều cửa h&agrave;ng kinh doanh, c&ocirc;ng ty cũng &aacute;p dụng chiến dịch khuyến m&atilde;i lớn nh&acirc;n dịp lễ độc th&acirc;n 11.11 .</p>\n\n<p><a href=\"http://cafebiz.vn/thien-tai-lua-dao-khet-tieng-moi-thoi-dai-victor-lustig-ban-dong-sat-vun-eiffel-den-2-lan-so-huu-chiec-hop-rumani-bien-giay-thanh-tien-ngay-ca-trum-xa-hoi-den-cung-lua-khong-tha-20191109193322062.chn\" target=\"_blank\" title=\"Thiên tài lừa đảo khét tiếng mọi thời đại Victor Lustig: Bán ‘đống sắt vụn’ Eiffel đến 2 lần, sở hữu ‘Chiếc hộp Rumani’ biến giấy thành tiền, ngay cả trùm xã hội đen cũng lừa không tha!\">Thi&ecirc;n t&agrave;i lừa đảo kh&eacute;t tiếng mọi thời đại Victor Lustig: B&aacute;n &lsquo;đống sắt vụn&rsquo; Eiffel đến 2 lần, sở hữu &lsquo;Chiếc hộp Rumani&rsquo; biến giấy th&agrave;nh tiền, ngay cả tr&ugrave;m x&atilde; hội đen cũng lừa kh&ocirc;ng tha!</a></p>\n\n<p><strong>Theo L.C</strong></p>\n\n<p>Lao động</p>', 'docthan.jpg', null, '2019-11-11 02:23:02', '2019-11-11 02:23:02');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
                         `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                         `role_id` int(20) DEFAULT NULL,
                         `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `admin` int(20) NOT NULL,
                         `deleted_at` timestamp NULL DEFAULT NULL,
                         `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', 'root', 'root@gmail.com', '$2y$10$2bXEoeEyF6OUMyZePTuXU.SbfuB8EtGrEU8Wt.ITxv1gIzGpv6F2y', '1', null, null, '2019-11-08 07:54:44', '2019-11-08 07:54:44'); /*pass: 1*/
INSERT INTO `users` VALUES ('2', null, 'NGUYỄN TẤT TIẾN', 'tien.nguyentat.1@gmail.com', '$2y$10$nMo7O4u/UaVzfh44UdSyHOOmbKwhHjWAOZly/exGwxrxi0hJo0786', '0', null, null, '2019-11-10 10:04:47', '2019-11-11 10:15:22');
