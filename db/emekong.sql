-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 06, 2015 at 12:16 AM
-- Server version: 5.5.37
-- PHP Version: 5.4.36-1+deb.sury.org~precise+2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `emekong`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_commentmeta`
--

DROP TABLE IF EXISTS `wp_commentmeta`;
CREATE TABLE IF NOT EXISTS `wp_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_comments`
--

DROP TABLE IF EXISTS `wp_comments`;
CREATE TABLE IF NOT EXISTS `wp_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wp_comments`
--

INSERT INTO `wp_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'Mr WordPress', '', 'https://wordpress.org/', '', '2015-01-03 07:43:02', '2015-01-03 07:43:02', 'Hi, this is a comment.\nTo delete a comment, just log in and view the post&#039;s comments. There you will have the option to edit or delete them.', 0, '1', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_links`
--

DROP TABLE IF EXISTS `wp_links`;
CREATE TABLE IF NOT EXISTS `wp_links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_options`
--

DROP TABLE IF EXISTS `wp_options`;
CREATE TABLE IF NOT EXISTS `wp_options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=360 ;

--
-- Dumping data for table `wp_options`
--

INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://emekong.dev', 'yes'),
(2, 'home', 'http://emekong.dev', 'yes'),
(3, 'blogname', 'Sàn Bất Động Sản Emekong', 'yes'),
(4, 'blogdescription', 'Just another WordPress site', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'dao.hunter@gmail.com', 'yes'),
(7, 'start_of_week', '1', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '10', 'yes'),
(13, 'rss_use_excerpt', '0', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'open', 'yes'),
(20, 'default_ping_status', 'open', 'yes'),
(21, 'default_pingback_flag', '1', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'F j, Y', 'yes'),
(24, 'time_format', 'g:i a', 'yes'),
(25, 'links_updated_date_format', 'F j, Y g:i a', 'yes'),
(26, 'comment_moderation', '0', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '', 'yes'),
(29, 'gzipcompression', '0', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:3:{i:0;s:19:"emekong/emekong.php";i:1;s:31:"featured-post/featured-post.php";i:2;s:27:"php-code-widget/execphp.php";}', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'advanced_edit', '0', 'yes'),
(37, 'comment_max_links', '2', 'yes'),
(38, 'gmt_offset', '0', 'yes'),
(39, 'default_email_category', '1', 'yes'),
(40, 'recently_edited', 'a:2:{i:0;s:51:"/var/www/emekong/wp-content/themes/Avenue/style.css";i:1;s:0:"";}', 'no'),
(41, 'template', 'emekong', 'yes'),
(42, 'stylesheet', 'emekong', 'yes'),
(43, 'comment_whitelist', '1', 'yes'),
(44, 'blacklist_keys', '', 'no'),
(45, 'comment_registration', '0', 'yes'),
(46, 'html_type', 'text/html', 'yes'),
(47, 'use_trackback', '0', 'yes'),
(48, 'default_role', 'subscriber', 'yes'),
(49, 'db_version', '29630', 'yes'),
(50, 'uploads_use_yearmonth_folders', '1', 'yes'),
(51, 'upload_path', '', 'yes'),
(52, 'blog_public', '1', 'yes'),
(53, 'default_link_category', '2', 'yes'),
(54, 'show_on_front', 'posts', 'yes'),
(55, 'tag_base', '', 'yes'),
(56, 'show_avatars', '1', 'yes'),
(57, 'avatar_rating', 'G', 'yes'),
(58, 'upload_url_path', '', 'yes'),
(59, 'thumbnail_size_w', '150', 'yes'),
(60, 'thumbnail_size_h', '150', 'yes'),
(61, 'thumbnail_crop', '1', 'yes'),
(62, 'medium_size_w', '300', 'yes'),
(63, 'medium_size_h', '300', 'yes'),
(64, 'avatar_default', 'mystery', 'yes'),
(65, 'large_size_w', '1024', 'yes'),
(66, 'large_size_h', '1024', 'yes'),
(67, 'image_default_link_type', 'file', 'yes'),
(68, 'image_default_size', '', 'yes'),
(69, 'image_default_align', '', 'yes'),
(70, 'close_comments_for_old_posts', '0', 'yes'),
(71, 'close_comments_days_old', '14', 'yes'),
(72, 'thread_comments', '1', 'yes'),
(73, 'thread_comments_depth', '5', 'yes'),
(74, 'page_comments', '0', 'yes'),
(75, 'comments_per_page', '50', 'yes'),
(76, 'default_comments_page', 'newest', 'yes'),
(77, 'comment_order', 'asc', 'yes'),
(78, 'sticky_posts', 'a:0:{}', 'yes'),
(79, 'widget_categories', 'a:2:{i:2;a:4:{s:5:"title";s:0:"";s:5:"count";i:0;s:12:"hierarchical";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(80, 'widget_text', 'a:0:{}', 'yes'),
(81, 'widget_rss', 'a:0:{}', 'yes'),
(82, 'uninstall_plugins', 'a:0:{}', 'no'),
(83, 'timezone_string', '', 'yes'),
(84, 'page_for_posts', '0', 'yes'),
(85, 'page_on_front', '0', 'yes'),
(86, 'default_post_format', '0', 'yes'),
(87, 'link_manager_enabled', '0', 'yes'),
(88, 'initial_db_version', '29630', 'yes'),
(89, 'wp_user_roles', 'a:5:{s:13:"administrator";a:2:{s:4:"name";s:13:"Administrator";s:12:"capabilities";a:70:{s:13:"switch_themes";b:1;s:11:"edit_themes";b:1;s:16:"activate_plugins";b:1;s:12:"edit_plugins";b:1;s:10:"edit_users";b:1;s:10:"edit_files";b:1;s:14:"manage_options";b:1;s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:6:"import";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:8:"level_10";b:1;s:7:"level_9";b:1;s:7:"level_8";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:12:"delete_users";b:1;s:12:"create_users";b:1;s:17:"unfiltered_upload";b:1;s:14:"edit_dashboard";b:1;s:14:"update_plugins";b:1;s:14:"delete_plugins";b:1;s:15:"install_plugins";b:1;s:13:"update_themes";b:1;s:14:"install_themes";b:1;s:11:"update_core";b:1;s:10:"list_users";b:1;s:12:"remove_users";b:1;s:9:"add_users";b:1;s:13:"promote_users";b:1;s:18:"edit_theme_options";b:1;s:13:"delete_themes";b:1;s:6:"export";b:1;s:19:"edit_wpp_properties";b:1;s:17:"edit_wpp_property";b:1;s:26:"edit_others_wpp_properties";b:1;s:19:"delete_wpp_property";b:1;s:22:"publish_wpp_properties";b:1;s:19:"manage_wpp_settings";b:1;s:21:"manage_wpp_categories";b:1;s:21:"manage_wpp_admintools";b:1;}}s:6:"editor";a:2:{s:4:"name";s:6:"Editor";s:12:"capabilities";a:34:{s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;}}s:6:"author";a:2:{s:4:"name";s:6:"Author";s:12:"capabilities";a:10:{s:12:"upload_files";b:1;s:10:"edit_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:4:"read";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;s:22:"delete_published_posts";b:1;}}s:11:"contributor";a:2:{s:4:"name";s:11:"Contributor";s:12:"capabilities";a:5:{s:10:"edit_posts";b:1;s:4:"read";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;}}s:10:"subscriber";a:2:{s:4:"name";s:10:"Subscriber";s:12:"capabilities";a:2:{s:4:"read";b:1;s:7:"level_0";b:1;}}}', 'yes'),
(90, 'widget_search', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(91, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(92, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(93, 'widget_archives', 'a:2:{i:2;a:3:{s:5:"title";s:0:"";s:5:"count";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(94, 'widget_meta', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(95, 'sidebars_widgets', 'a:7:{s:16:"footer-copyright";a:2:{i:0;s:9:"execphp-6";i:1;s:9:"execphp-7";}s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}s:9:"sidebar-2";a:0:{}s:14:"footer-columns";a:4:{i:0;s:9:"execphp-2";i:1;s:9:"execphp-3";i:2;s:9:"execphp-4";i:3;s:9:"execphp-5";}s:13:"footer-bottom";a:2:{i:0;s:9:"execphp-8";i:1;s:9:"execphp-9";}s:13:"array_version";i:3;}', 'yes'),
(96, 'cron', 'a:5:{i:1420486740;a:1:{s:20:"wp_maybe_auto_update";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1420486996;a:3:{s:16:"wp_version_check";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:17:"wp_update_plugins";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:16:"wp_update_themes";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1420530253;a:1:{s:19:"wp_scheduled_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1420530459;a:1:{s:30:"wp_scheduled_auto_draft_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}s:7:"version";i:2;}', 'yes'),
(98, '_site_transient_update_core', 'O:8:"stdClass":4:{s:7:"updates";a:3:{i:0;O:8:"stdClass":10:{s:8:"response";s:7:"upgrade";s:8:"download";s:57:"https://downloads.wordpress.org/release/wordpress-4.1.zip";s:6:"locale";s:5:"en_US";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:57:"https://downloads.wordpress.org/release/wordpress-4.1.zip";s:10:"no_content";s:68:"https://downloads.wordpress.org/release/wordpress-4.1-no-content.zip";s:11:"new_bundled";s:69:"https://downloads.wordpress.org/release/wordpress-4.1-new-bundled.zip";s:7:"partial";b:0;s:8:"rollback";b:0;}s:7:"current";s:3:"4.1";s:7:"version";s:3:"4.1";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"4.1";s:15:"partial_version";s:0:"";}i:1;O:8:"stdClass":11:{s:8:"response";s:10:"autoupdate";s:8:"download";s:57:"https://downloads.wordpress.org/release/wordpress-4.1.zip";s:6:"locale";s:5:"en_US";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:57:"https://downloads.wordpress.org/release/wordpress-4.1.zip";s:10:"no_content";s:68:"https://downloads.wordpress.org/release/wordpress-4.1-no-content.zip";s:11:"new_bundled";s:69:"https://downloads.wordpress.org/release/wordpress-4.1-new-bundled.zip";s:7:"partial";b:0;s:8:"rollback";b:0;}s:7:"current";s:3:"4.1";s:7:"version";s:3:"4.1";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"4.1";s:15:"partial_version";s:0:"";s:13:"support_email";s:26:"updatehelp40@wordpress.org";}i:2;O:8:"stdClass":12:{s:8:"response";s:10:"autoupdate";s:8:"download";s:59:"https://downloads.wordpress.org/release/wordpress-4.0.1.zip";s:6:"locale";s:5:"en_US";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:59:"https://downloads.wordpress.org/release/wordpress-4.0.1.zip";s:10:"no_content";s:70:"https://downloads.wordpress.org/release/wordpress-4.0.1-no-content.zip";s:11:"new_bundled";s:71:"https://downloads.wordpress.org/release/wordpress-4.0.1-new-bundled.zip";s:7:"partial";s:69:"https://downloads.wordpress.org/release/wordpress-4.0.1-partial-0.zip";s:8:"rollback";s:70:"https://downloads.wordpress.org/release/wordpress-4.0.1-rollback-0.zip";}s:7:"current";s:5:"4.0.1";s:7:"version";s:5:"4.0.1";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"4.1";s:15:"partial_version";s:3:"4.0";s:12:"notify_email";s:1:"1";s:13:"support_email";s:26:"updatehelp40@wordpress.org";}}s:12:"last_checked";i:1420461869;s:15:"version_checked";s:3:"4.0";s:12:"translations";a:0:{}}', 'yes'),
(99, '_transient_random_seed', '2c870ab78b92a2bba9d4239e24216b0d', 'yes'),
(104, '_site_transient_timeout_browser_9144b8475a7ea4baab9c7fb910a15a58', '1420875807', 'yes'),
(105, '_site_transient_browser_9144b8475a7ea4baab9c7fb910a15a58', 'a:9:{s:8:"platform";s:5:"Linux";s:4:"name";s:6:"Chrome";s:7:"version";s:13:"35.0.1916.153";s:10:"update_url";s:28:"http://www.google.com/chrome";s:7:"img_src";s:49:"http://s.wordpress.org/images/browsers/chrome.png";s:11:"img_src_ssl";s:48:"https://wordpress.org/images/browsers/chrome.png";s:15:"current_version";s:2:"18";s:7:"upgrade";b:0;s:8:"insecure";b:0;}', 'yes'),
(109, 'can_compress_scripts', '0', 'yes'),
(127, 'auto_core_update_notified', 'a:4:{s:4:"type";s:6:"manual";s:5:"email";s:20:"dao.hunter@gmail.com";s:7:"version";s:5:"4.0.1";s:9:"timestamp";i:1420271022;}', 'yes'),
(132, 'current_theme', 'Emekong', 'yes'),
(133, 'theme_mods_Avenue', 'a:3:{i:0;b:0;s:18:"nav_menu_locations";a:1:{s:7:"primary";i:5;}s:16:"sidebars_widgets";a:2:{s:4:"time";i:1420272228;s:4:"data";a:3:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}s:9:"sidebar-2";a:0:{}}}}', 'yes'),
(134, 'theme_switched', '', 'yes'),
(137, 'type_children', 'a:0:{}', 'yes'),
(138, 'ffref', '335461', 'yes'),
(139, 'fflink', 'Website by Wordpress', 'yes'),
(140, 'nav_menu_options', 'a:2:{i:0;b:0;s:8:"auto_add";a:0:{}}', 'yes'),
(143, 'area_children', 'a:0:{}', 'yes'),
(144, 'range_children', 'a:0:{}', 'yes'),
(145, 'location_children', 'a:0:{}', 'yes'),
(146, 'property_children', 'a:0:{}', 'yes'),
(150, 'recently_activated', 'a:2:{s:33:"simple-real-estate-pack-4/srp.php";i:1420389726;s:27:"wp-property/wp-property.php";i:1420272673;}', 'yes'),
(151, 'wpp_version', '1.42.2', 'yes'),
(152, 'ud_log', 'a:2:{i:0;a:6:{s:4:"time";i:1420272428;s:7:"message";s:137:"Feature Update Error: An error occurred during premium feature check. API Key ''<b>We cannot validate your domain name!</b>'' is incorrect.";s:4:"user";i:1;s:4:"type";s:7:"default";s:6:"object";b:0;s:8:"instance";s:11:"WP-Property";}i:1;a:6:{s:4:"time";i:1420272432;s:7:"message";s:137:"Feature Update Error: An error occurred during premium feature check. API Key ''<b>We cannot validate your domain name!</b>'' is incorrect.";s:4:"user";i:0;s:4:"type";s:7:"default";s:6:"object";b:0;s:8:"instance";s:11:"WP-Property";}}', 'yes'),
(154, 'srp_general_options', 'a:1:{s:7:"content";a:3:{s:11:"srp_gre_css";s:2:"on";s:16:"srp_profile_tabs";s:2:"on";s:16:"srp_profile_ajax";s:2:"on";}}', 'yes'),
(155, 'srp_ext_gre_options', 'a:2:{s:7:"content";a:15:{s:3:"map";s:2:"on";s:7:"schools";s:2:"on";s:11:"altos_stats";s:2:"on";s:9:"financial";s:2:"on";s:4:"yelp";s:2:"on";s:9:"walkscore";s:2:"on";s:13:"mortgage_calc";s:2:"on";s:17:"closing_estimator";s:2:"on";s:18:"affordability_calc";s:2:"on";s:11:"description";s:2:"on";s:6:"photos";s:2:"on";s:5:"video";s:2:"on";s:8:"panorama";s:2:"on";s:9:"downloads";s:2:"on";s:9:"community";s:2:"on";}s:4:"tabs";a:7:{s:3:"map";a:2:{s:7:"tabname";s:3:"Map";s:7:"heading";s:12:"Location Map";}s:7:"schools";a:2:{s:7:"tabname";s:7:"Schools";s:7:"heading";s:13:"Local Schools";}s:12:"trulia_stats";a:2:{s:7:"tabname";s:12:"Market Stats";s:7:"heading";s:17:"Market Statistics";}s:11:"altos_stats";a:2:{s:7:"tabname";s:12:"Market Stats";s:7:"heading";s:17:"Market Statistics";}s:9:"financial";a:2:{s:7:"tabname";s:9:"Financing";s:7:"heading";s:15:"Financial Tools";}s:4:"yelp";a:2:{s:7:"tabname";s:17:"Nearby Businesses";s:7:"heading";s:30:"Businesses in the Neighborhood";}s:9:"walkscore";a:2:{s:7:"tabname";s:11:"Walkability";s:7:"heading";s:31:"Walkability of the Neighborhood";}}}', 'yes'),
(156, 'srp_mortgage_calc_options', 'a:16:{s:20:"annual_interest_rate";i:6;s:13:"mortgage_term";i:30;s:17:"property_tax_rate";i:1;s:19:"home_insurance_rate";d:0.5;s:3:"pmi";d:0.5;s:15:"origination_fee";i:1;s:11:"lender_fees";i:600;s:17:"credit_report_fee";i:50;s:9:"appraisal";i:300;s:15:"title_insurance";i:800;s:16:"reconveyance_fee";i:75;s:13:"recording_fee";i:45;s:16:"wire_courier_fee";i:55;s:15:"endorsement_fee";i:75;s:17:"title_closing_fee";i:125;s:18:"title_doc_prep_fee";i:30;}', 'yes'),
(157, 'srp_walkscore_api_key', 'YOUR-WSID-HERE', 'yes'),
(158, 'srp_mortgage_rates', 'a:4:{s:22:"getratesummary_api_key";b:0;s:20:"getratesummary_state";b:0;s:13:"display_rates";b:0;s:18:"use_rates_in_calcs";b:0;}', 'yes'),
(160, '_transient_twentyfourteen_category_count', '1', 'yes'),
(164, 'theme_mods_flatmagazine', 'a:2:{i:0;b:0;s:16:"sidebars_widgets";a:2:{s:4:"time";i:1420276932;s:4:"data";a:23:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}s:9:"sidebar-2";a:0:{}s:9:"sidebar-3";a:0:{}s:9:"sidebar-4";N;s:9:"sidebar-5";N;s:9:"sidebar-6";N;s:9:"sidebar-7";N;s:9:"sidebar-8";N;s:9:"sidebar-9";N;s:10:"sidebar-10";N;s:4:"shop";N;s:10:"sidebar-12";N;s:10:"sidebar-13";N;s:10:"sidebar-14";N;s:10:"sidebar-15";N;s:10:"sidebar-16";N;s:10:"sidebar-17";N;s:10:"sidebar-18";N;s:10:"sidebar-19";N;s:10:"sidebar-20";N;s:10:"sidebar-21";N;s:10:"sidebar-22";N;}}}', 'yes');
INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(165, 'ls_template', 'a:87:{i:0;a:3:{s:4:"name";s:16:"General Settings";s:4:"link";s:16:"General Settings";s:4:"type";s:7:"heading";}i:1;a:5:{s:4:"name";s:7:"Top Bar";s:4:"desc";s:0:"";s:2:"id";s:10:"ls_top_bar";s:3:"std";s:646:"Follow Us:   [icon name="icon-pinterest" url="#" align="right" color="#BBBBBB"] [icon name="icon-linkedin" url="#" color="#BBBBBB"] [icon name="icon-facebook" url="#" color="#BBBBBB"] [icon name="icon-google-plus" url="#" color="#BBBBBB"] [icon name="icon-twitter" url="#" color="#BBBBBB"] [icon name="icon-rss" url="#" color="#BBBBBB"] [icon name="icon-tumblr-sign" url="#" color="#BBBBBB"] [icon name="icon-youtube" url="#" color="#BBBBBB"] [icon name="icon-skype" url="#" color="#BBBBBB"] [icon name="icon-instagram" url="#" color="#BBBBBB"] [icon name="icon-flickr" url="#" color="#BBBBBB"] [icon name="icon-dribbble" url="#" color="#BBBBBB"]";s:4:"type";s:8:"textarea";}i:2;a:5:{s:4:"name";s:15:"Top Banner Area";s:4:"desc";s:0:"";s:2:"id";s:18:"ls_top_banner_area";s:3:"std";s:112:"<img src="http://www.startis.ru/flatmagazine/files/2013/06/tf_728x90_v2.gif" alt="728x90" style="float:right" />";s:4:"type";s:8:"textarea";}i:3;a:5:{s:4:"name";s:11:"Custom Logo";s:4:"desc";s:78:"Upload a logo for your theme, or image url. (e.g. http://example.com/logo.png)";s:2:"id";s:7:"ls_logo";s:3:"std";s:0:"";s:4:"type";s:6:"upload";}i:4;a:5:{s:4:"name";s:11:"Custom Logo";s:4:"desc";s:78:"Upload a logo for your theme, or image url. (e.g. http://example.com/logo.png)";s:2:"id";s:7:"ls_logo";s:3:"std";s:0:"";s:4:"type";s:6:"upload";}i:5;a:5:{s:4:"name";s:17:"Enable Fixed Menu";s:4:"desc";s:38:"Check this to enable Fixed Header Menu";s:2:"id";s:14:"ls_fixedheader";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:6;a:5:{s:4:"name";s:17:"Enable Breadcrubs";s:4:"desc";s:32:"Check this to enable Breadcrubs.";s:2:"id";s:14:"ls_breadcrumbs";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:7;a:5:{s:4:"name";s:14:"Custom Favicon";s:4:"desc";s:36:"Upload a (16x16px) Png or Gif image.";s:2:"id";s:17:"ls_custom_favicon";s:3:"std";s:0:"";s:4:"type";s:6:"upload";}i:8;a:5:{s:4:"name";s:14:"FeedBurner URL";s:4:"desc";s:25:"Enter your FeedBurner URL";s:2:"id";s:13:"ls_feedburner";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:9;a:5:{s:4:"name";s:15:"Show Demo panel";s:4:"desc";s:39:"Check this to enable a show demo panel.";s:2:"id";s:13:"ls_demo_panel";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:10;a:3:{s:4:"name";s:11:"Subscribers";s:4:"link";s:11:"Subscribers";s:4:"type";s:7:"heading";}i:11;a:5:{s:4:"name";s:27:"Twitter Subscribers Counter";s:4:"desc";s:43:"Check this to enable a show Twitter counter";s:2:"id";s:6:"ls_tsc";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:12;a:5:{s:4:"name";s:28:"Facebook Subscribers Counter";s:4:"desc";s:44:"Check this to enable a show Facebook counter";s:2:"id";s:6:"ls_fsc";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:13;a:5:{s:4:"name";s:27:"YouTube Subscribers Counter";s:4:"desc";s:43:"Check this to enable a show YouTube counter";s:2:"id";s:6:"ls_ysc";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:14;a:5:{s:4:"name";s:35:"WordPress Users Subscribers Counter";s:4:"desc";s:51:"Check this to enable a show WordPress Users counter";s:2:"id";s:6:"ls_wsc";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:15;a:5:{s:4:"name";s:24:"Twitter Subscribers Text";s:4:"desc";s:14:"std. Followers";s:2:"id";s:11:"ls_tsc_text";s:3:"std";s:9:"Followers";s:4:"type";s:4:"text";}i:16;a:5:{s:4:"name";s:25:"Facebook Subscribers Text";s:4:"desc";s:9:"std. Fans";s:2:"id";s:11:"ls_fsc_text";s:3:"std";s:4:"Fans";s:4:"type";s:4:"text";}i:17;a:5:{s:4:"name";s:24:"YouTube Subscribers Text";s:4:"desc";s:16:"std. Subscrubers";s:2:"id";s:11:"ls_ysc_text";s:3:"std";s:11:"Subscrubers";s:4:"type";s:4:"text";}i:18;a:5:{s:4:"name";s:32:"WordPress Users Subscribers Text";s:4:"desc";s:10:"std. Users";s:2:"id";s:11:"ls_wsc_text";s:3:"std";s:5:"Users";s:4:"type";s:4:"text";}i:19;a:3:{s:4:"name";s:7:"Styling";s:4:"link";s:7:"Styling";s:4:"type";s:7:"heading";}i:20;a:6:{s:4:"name";s:12:"Layout Style";s:4:"desc";s:13:"Wide or Boxed";s:2:"id";s:9:"ls_layout";s:3:"std";s:5:"Boxed";s:4:"type";s:6:"select";s:7:"options";a:2:{i:0;s:4:"Wide";i:1;s:5:"Boxed";}}i:21;a:6:{s:4:"name";s:17:"Predefinded skins";s:4:"desc";s:0:"";s:2:"id";s:9:"ls_pcolor";s:3:"std";s:6:"336699";s:4:"type";s:6:"pcolor";s:7:"options";a:16:{i:0;s:6:"19AFE5";i:1;s:6:"95C343";i:2;s:6:"1D83B9";i:3;s:6:"8572c1";i:4;s:6:"9d6e48";i:5;s:6:"456399";i:6;s:6:"FA3800";i:7;s:6:"37B7D9";i:8;s:6:"8dc563";i:9;s:6:"ac68aa";i:10;s:6:"FA2020";i:11;s:6:"85bb27";i:12;s:6:"667384";i:13;s:6:"1aa54c";i:14;s:6:"336699";i:15;s:6:"F95601";}}i:22;a:5:{s:4:"name";s:20:"Use Theme skin color";s:4:"desc";s:53:"Use a specific Theme skin color instead of predefined";s:2:"id";s:13:"ls_use_scolor";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:23;a:5:{s:4:"name";s:16:"Theme skin color";s:4:"desc";s:17:"(default #F95601)";s:2:"id";s:9:"ls_scolor";s:3:"std";s:7:"#F95601";s:4:"type";s:5:"color";}i:24;a:5:{s:4:"name";s:21:"Body Background color";s:4:"desc";s:17:"(default #2A354A)";s:2:"id";s:24:"ls_body_background_color";s:3:"std";s:7:"#2A354A";s:4:"type";s:5:"color";}i:25;a:6:{s:4:"name";s:16:"Texture Overlays";s:4:"desc";s:0:"";s:2:"id";s:19:"ls_texture_overlays";s:3:"std";s:12:"bgwline1.png";s:4:"type";s:6:"images";s:7:"options";a:64:{s:11:"bgnoise.png";s:76:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgnoise.png";s:8:"pat1.png";s:73:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/pat1.png";s:8:"pat2.png";s:73:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/pat2.png";s:8:"pat3.png";s:73:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/pat3.png";s:15:"bgdiagonall.png";s:80:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiagonall.png";s:16:"bgdiagonall2.png";s:81:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiagonall2.png";s:16:"bgdiagonall4.png";s:81:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiagonall4.png";s:16:"bgdiagonall5.png";s:81:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiagonall5.png";s:15:"bgdiagonalr.png";s:80:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiagonalr.png";s:16:"bgdiagonalr2.png";s:81:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiagonalr2.png";s:16:"bgdiagonalr4.png";s:81:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiagonalr4.png";s:16:"bgdiagonalr5.png";s:81:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiagonalr5.png";s:14:"bgdiamonds.png";s:79:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiamonds.png";s:15:"bgdiamonds1.png";s:80:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiamonds1.png";s:15:"bgdiamonds2.png";s:80:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiamonds2.png";s:15:"bgdiamonds3.png";s:80:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiamonds3.png";s:12:"bghline1.png";s:77:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bghline1.png";s:12:"bghline2.png";s:77:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bghline2.png";s:11:"bghwave.png";s:76:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bghwave.png";s:13:"bgradial2.png";s:78:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgradial2.png";s:13:"bgradial4.png";s:78:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgradial4.png";s:10:"bgsqrs.png";s:75:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgsqrs.png";s:11:"bgsqrs1.png";s:76:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgsqrs1.png";s:11:"bgsqrs2.png";s:76:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgsqrs2.png";s:11:"bgsqrs3.png";s:76:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgsqrs3.png";s:11:"bgsqrs4.png";s:76:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgsqrs4.png";s:11:"bgwline.png";s:76:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgwline.png";s:12:"bgwline1.png";s:77:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgwline1.png";s:12:"bgwline2.png";s:77:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgwline2.png";s:12:"bgwline3.png";s:77:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgwline3.png";s:11:"bgwwave.png";s:76:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgwwave.png";s:12:"bgwwline.png";s:77:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgwwline.png";s:9:"pat1b.png";s:74:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/pat1b.png";s:9:"pat2b.png";s:74:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/pat2b.png";s:9:"pat3b.png";s:74:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/pat3b.png";s:16:"bgdiagonallb.png";s:81:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiagonallb.png";s:17:"bgdiagonall2b.png";s:82:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiagonall2b.png";s:17:"bgdiagonall4b.png";s:82:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiagonall4b.png";s:17:"bgdiagonall5b.png";s:82:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiagonall5b.png";s:16:"bgdiagonalrb.png";s:81:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiagonalrb.png";s:17:"bgdiagonalr2b.png";s:82:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiagonalr2b.png";s:17:"bgdiagonalr4b.png";s:82:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiagonalr4b.png";s:17:"bgdiagonalr5b.png";s:82:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiagonalr5b.png";s:15:"bgdiamondsb.png";s:80:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiamondsb.png";s:16:"bgdiamonds1b.png";s:81:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiamonds1b.png";s:16:"bgdiamonds2b.png";s:81:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiamonds2b.png";s:16:"bgdiamonds3b.png";s:81:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgdiamonds3b.png";s:13:"bghline1b.png";s:78:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bghline1b.png";s:13:"bghline2b.png";s:78:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bghline2b.png";s:12:"bghwaveb.png";s:77:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bghwaveb.png";s:14:"bgradial2b.png";s:79:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgradial2b.png";s:14:"bgradial4b.png";s:79:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgradial4b.png";s:11:"bgsqrsb.png";s:76:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgsqrsb.png";s:12:"bgsqrs1b.png";s:77:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgsqrs1b.png";s:12:"bgsqrs2b.png";s:77:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgsqrs2b.png";s:12:"bgsqrs3b.png";s:77:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgsqrs3b.png";s:12:"bgsqrs4b.png";s:77:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgsqrs4b.png";s:12:"bgwlineb.png";s:77:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgwlineb.png";s:13:"bgwline1b.png";s:78:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgwline1b.png";s:13:"bgwline2b.png";s:78:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgwline2b.png";s:13:"bgwline3b.png";s:78:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgwline3b.png";s:12:"bgwwaveb.png";s:77:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgwwaveb.png";s:13:"bgwwlineb.png";s:78:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/bgwwlineb.png";s:0:"";s:73:"http://emekong.dev/wp-content/themes/flatmagazine/images/pat/prw/none.png";}}i:26;a:5:{s:4:"name";s:18:"Primary link color";s:4:"desc";s:17:"(default #000000)";s:2:"id";s:16:"ls_primary_color";s:3:"std";s:7:"#000000";s:4:"type";s:5:"color";}i:27;a:5:{s:4:"name";s:24:"Primary link hover color";s:4:"desc";s:17:"(default #343434)";s:2:"id";s:22:"ls_primary_hover_color";s:3:"std";s:7:"#343434";s:4:"type";s:5:"color";}i:28;a:6:{s:4:"name";s:11:"Main Layout";s:4:"desc";s:26:"Select sidebars alignment.";s:2:"id";s:16:"ls_sidebar_align";s:3:"std";s:12:"sidebar-left";s:4:"type";s:6:"images";s:7:"options";a:2:{s:13:"sidebar-right";s:70:"http://emekong.dev/wp-content/themes/flatmagazine/admin/images/2cl.png";s:12:"sidebar-left";s:70:"http://emekong.dev/wp-content/themes/flatmagazine/admin/images/2cr.png";}}i:29;a:5:{s:4:"name";s:10:"Custom CSS";s:4:"desc";s:15:"Enter some CSS.";s:2:"id";s:13:"ls_custom_css";s:3:"std";s:0:"";s:4:"type";s:8:"textarea";}i:30;a:3:{s:4:"name";s:6:"CallMe";s:4:"link";s:6:"CallMe";s:4:"type";s:7:"heading";}i:31;a:5:{s:4:"name";s:13:"Enable Callme";s:4:"desc";s:34:"Enable request a callback function";s:2:"id";s:13:"ls_callme_top";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:32;a:5:{s:4:"name";s:18:"Callme button Text";s:4:"desc";s:0:"";s:2:"id";s:14:"ls_callme_text";s:3:"std";s:12:"Call Me Now!";s:4:"type";s:4:"text";}i:33;a:5:{s:4:"name";s:17:"Callme email text";s:4:"desc";s:51:"%NAME% has requested a callback on %PHONE AND TIME%";s:2:"id";s:20:"ls_callme_email_text";s:3:"std";s:27:"has requested a callback on";s:4:"type";s:4:"text";}i:34;a:5:{s:4:"name";s:16:"Callme Name text";s:4:"desc";s:0:"";s:2:"id";s:19:"ls_callme_name_text";s:3:"std";s:10:"Your name:";s:4:"type";s:4:"text";}i:35;a:5:{s:4:"name";s:17:"Callme Phone text";s:4:"desc";s:0:"";s:2:"id";s:20:"ls_callme_phone_text";s:3:"std";s:11:"Your phone:";s:4:"type";s:4:"text";}i:36;a:5:{s:4:"name";s:16:"Callme Time text";s:4:"desc";s:0:"";s:2:"id";s:19:"ls_callme_time_text";s:3:"std";s:13:"Time to call:";s:4:"type";s:4:"text";}i:37;a:5:{s:4:"name";s:34:"Message after a successful sending";s:4:"desc";s:0:"";s:2:"id";s:17:"ls_callme_suc_msg";s:3:"std";s:54:"Your message has been sent, you will be contacted soon";s:4:"type";s:4:"text";}i:38;a:5:{s:4:"name";s:42:"Alternative content for Mobile Callme Area";s:4:"desc";s:18:"Enter your content";s:2:"id";s:19:"ls_alternative_area";s:3:"std";s:0:"";s:4:"type";s:8:"textarea";}i:39;a:3:{s:4:"name";s:6:"Header";s:4:"link";s:6:"header";s:4:"type";s:7:"heading";}i:40;a:5:{s:4:"name";s:13:"Header Height";s:4:"desc";s:12:"(default 90)";s:2:"id";s:16:"ls_header_height";s:3:"std";s:3:"137";s:4:"type";s:4:"text";}i:41;a:5:{s:4:"name";s:15:"Menu Font Color";s:4:"desc";s:17:"(default #444444)";s:2:"id";s:18:"ls_menu_font_color";s:3:"std";s:7:"#eeeeee";s:4:"type";s:5:"color";}i:42;a:5:{s:4:"name";s:23:"Show Background Overlay";s:4:"desc";s:47:"Check this to enable Background Overlay effects";s:2:"id";s:14:"ls_show_header";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:43;a:6:{s:4:"name";s:16:"Texture Overlays";s:4:"desc";s:22:"Header Texture Overlay";s:2:"id";s:26:"ls_header_texture_overlays";s:3:"std";s:4:"none";s:4:"type";s:6:"select";s:7:"options";a:18:{i:0;s:4:"none";i:1;s:9:"Squares 1";i:2;s:9:"Squares 2";i:3;s:9:"Squares 3";i:4;s:9:"Squares 4";i:5;s:13:"Diagonal Left";i:6;s:14:"Diagonal Right";i:7;s:10:"Diamonds 1";i:8;s:10:"Diamonds 2";i:9;s:10:"Diamonds 3";i:10;s:14:"Vertical Lines";i:11;s:18:"Horizontal Lines 1";i:12;s:18:"Horizontal Lines 2";i:13;s:14:"Vertical Waves";i:14;s:16:"Horizontal Waves";i:15;s:5:"Noise";i:16;s:9:"Pattern 1";i:17;s:9:"Pattern 2";}}i:44;a:5:{s:4:"name";s:16:"Background Color";s:4:"desc";s:17:"(default #162226)";s:2:"id";s:26:"ls_header_background_color";s:3:"std";s:7:"#ffffff";s:4:"type";s:5:"color";}i:45;a:5:{s:4:"name";s:24:"Background Color Opacity";s:4:"desc";s:43:"Percent of Background Color Opacity (0-100)";s:2:"id";s:28:"ls_header_background_opacity";s:3:"std";s:3:"100";s:4:"type";s:4:"text";}i:46;a:3:{s:4:"name";s:15:"Mobile settings";s:4:"link";s:6:"mobile";s:4:"type";s:7:"heading";}i:47;a:5:{s:4:"name";s:21:"Show Mobile Area Left";s:4:"desc";s:44:"Check this to enable a show Mobile Area Left";s:2:"id";s:19:"ls_mobile_area_left";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:48;a:5:{s:4:"name";s:22:"Show Mobile Area Right";s:4:"desc";s:45:"Check this to enable a show Mobile Area Right";s:2:"id";s:20:"ls_mobile_area_right";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:49;a:5:{s:4:"name";s:40:"Button icon for open Left Mobile Sidebar";s:4:"desc";s:46:"You can any FontAwesome icon (default fa-bars)";s:2:"id";s:21:"ls_mobile_button_left";s:3:"std";s:7:"fa-bars";s:4:"type";s:4:"text";}i:50;a:5:{s:4:"name";s:41:"Button icon for open Right Mobile Sidebar";s:4:"desc";s:45:"You can any FontAwesome icon (default fa-cog)";s:2:"id";s:22:"ls_mobile_button_right";s:3:"std";s:6:"fa-cog";s:4:"type";s:4:"text";}i:51;a:3:{s:4:"name";s:5:"Fonts";s:4:"link";s:5:"Fonts";s:4:"type";s:7:"heading";}i:52;a:6:{s:4:"name";s:16:"Body Font family";s:4:"desc";s:99:"Body Font family - Supported <a href=\\"http://www.google.com/webfonts\\"> Google Font Directory</a>.";s:2:"id";s:19:"ls_body_font_family";s:3:"std";s:9:"Open+Sans";s:4:"type";s:6:"select";s:7:"options";a:534:{i:0;s:5:"Arial";i:1;s:13:"Comic Sans MS";i:2;s:9:"Helvetica";i:3;s:7:"Georgia";i:4;s:19:"Lucida Sans Unicode";i:5;s:6:"Tahoma";i:6;s:12:"Trebuchet MS";i:7;s:7:"Verdana";i:8;s:4:"Abel";i:9;s:13:"Abril+Fatface";i:10;s:8:"Aclonica";i:11;s:4:"Acme";i:12;s:5:"Actor";i:13;s:7:"Adamina";i:14;s:10:"Advent+Pro";i:15;s:15:"Aguafina+Script";i:16;s:6:"Aladin";i:17;s:7:"Aldrich";i:18;s:8:"Alegreya";i:19;s:11:"Alegreya+SC";i:20;s:10:"Alex+Brush";i:21;s:13:"Alfa+Slab+One";i:22;s:5:"Alice";i:23;s:5:"Alike";i:24;s:13:"Alike+Angular";i:25;s:5:"Allan";i:26;s:7:"Allerta";i:27;s:15:"Allerta+Stencil";i:28;s:6:"Allura";i:29;s:8:"Almendra";i:30;s:11:"Almendra+SC";i:31;s:8:"Amaranth";i:32;s:9:"Amatic+SC";i:33;s:9:"Amethysta";i:34;s:6:"Andada";i:35;s:6:"Andika";i:36;s:6:"Angkor";i:37;s:24:"Annie+Use+Your+Telescope";i:38;s:13:"Anonymous+Pro";i:39;s:5:"Antic";i:40;s:12:"Antic+Didone";i:41;s:10:"Antic+Slab";i:42;s:5:"Anton";i:43;s:6:"Arapey";i:44;s:7:"Arbutus";i:45;s:19:"Architects+Daughter";i:46;s:5:"Arimo";i:47;s:8:"Arizonia";i:48;s:6:"Armata";i:49;s:8:"Artifika";i:50;s:4:"Arvo";i:51;s:4:"Asap";i:52;s:5:"Asset";i:53;s:7:"Astloch";i:54;s:4:"Asul";i:55;s:10:"Atomic+Age";i:56;s:6:"Aubrey";i:57;s:9:"Audiowide";i:58;s:7:"Average";i:59;s:19:"Averia+Gruesa+Libre";i:60;s:12:"Averia+Libre";i:61;s:17:"Averia+Sans+Libre";i:62;s:18:"Averia+Serif+Libre";i:63;s:10:"Bad+Script";i:64;s:9:"Balthazar";i:65;s:7:"Bangers";i:66;s:5:"Basic";i:67;s:10:"Battambang";i:68;s:7:"Baumans";i:69;s:5:"Bayon";i:70;s:8:"Belgrano";i:71;s:7:"Belleza";i:72;s:7:"Bentham";i:73;s:15:"Berkshire+Swash";i:74;s:5:"Bevan";i:75;s:11:"Bigshot+One";i:76;s:5:"Bilbo";i:77;s:16:"Bilbo+Swash+Caps";i:78;s:6:"Bitter";i:79;s:13:"Black+Ops+One";i:80;s:5:"Bokor";i:81;s:6:"Bonbon";i:82;s:8:"Boogaloo";i:83;s:10:"Bowlby+One";i:84;s:13:"Bowlby+One+SC";i:85;s:7:"Brawler";i:86;s:10:"Bree+Serif";i:87;s:14:"Bubblegum+Sans";i:88;s:4:"Buda";i:89;s:7:"Buenard";i:90;s:10:"Butcherman";i:91;s:14:"Butterfly+Kids";i:92;s:5:"Cabin";i:93;s:15:"Cabin+Condensed";i:94;s:12:"Cabin+Sketch";i:95;s:15:"Caesar+Dressing";i:96;s:10:"Cagliostro";i:97;s:14:"Calligraffitti";i:98;s:5:"Cambo";i:99;s:6:"Candal";i:100;s:9:"Cantarell";i:101;s:11:"Cantata+One";i:102;s:5:"Cardo";i:103;s:5:"Carme";i:104;s:10:"Carter+One";i:105;s:6:"Caudex";i:106;s:18:"Cedarville+Cursive";i:107;s:11:"Ceviche+One";i:108;s:10:"Changa+One";i:109;s:6:"Chango";i:110;s:18:"Chau+Philomene+One";i:111;s:14:"Chelsea+Market";i:112;s:6:"Chenla";i:113;s:17:"Cherry+Cream+Soda";i:114;s:5:"Chewy";i:115;s:6:"Chicle";i:116;s:5:"Chivo";i:117;s:4:"Coda";i:118;s:12:"Coda+Caption";i:119;s:8:"Codystar";i:120;s:9:"Comfortaa";i:121;s:11:"Coming+Soon";i:122;s:11:"Concert+One";i:123;s:9:"Condiment";i:124;s:7:"Content";i:125;s:12:"Contrail+One";i:126;s:11:"Convergence";i:127;s:6:"Cookie";i:128;s:5:"Copse";i:129;s:6:"Corben";i:130;s:7:"Cousine";i:131;s:8:"Coustard";i:132;s:21:"Covered+By+Your+Grace";i:133;s:12:"Crafty+Girls";i:134;s:9:"Creepster";i:135;s:11:"Crete+Round";i:136;s:12:"Crimson+Text";i:137;s:7:"Crushed";i:138;s:6:"Cuprum";i:139;s:6:"Cutive";i:140;s:6:"Damion";i:141;s:14:"Dancing+Script";i:142;s:7:"Dangrek";i:143;s:20:"Dawning+of+a+New+Day";i:144;s:8:"Days+One";i:145;s:6:"Delius";i:146;s:17:"Delius+Swash+Caps";i:147;s:14:"Delius+Unicase";i:148;s:13:"Della+Respira";i:149;s:10:"Devonshire";i:150;s:13:"Didact+Gothic";i:151;s:9:"Diplomata";i:152;s:12:"Diplomata+SC";i:153;s:10:"Doppio+One";i:154;s:5:"Dorsa";i:155;s:5:"Dosis";i:156;s:11:"Dr+Sugiyama";i:157;s:10:"Droid+Sans";i:158;s:15:"Droid+Sans+Mono";i:159;s:11:"Droid+Serif";i:160;s:9:"Duru+Sans";i:161;s:9:"Dynalight";i:162;s:11:"EB+Garamond";i:163;s:5:"Eater";i:164;s:9:"Economica";i:165;s:11:"Electrolize";i:166;s:11:"Emblema+One";i:167;s:12:"Emilys+Candy";i:168;s:10:"Engagement";i:169;s:9:"Enriqueta";i:170;s:9:"Erica+One";i:171;s:7:"Esteban";i:172;s:15:"Euphoria+Script";i:173;s:5:"Ewert";i:174;s:3:"Exo";i:175;s:13:"Expletus+Sans";i:176;s:12:"Fanwood+Text";i:177;s:9:"Fascinate";i:178;s:16:"Fascinate+Inline";i:179;s:8:"Federant";i:180;s:6:"Federo";i:181;s:6:"Felipa";i:182;s:9:"Fjord+One";i:183;s:8:"Flamenco";i:184;s:7:"Flavors";i:185;s:10:"Fondamento";i:186;s:16:"Fontdiner+Swanky";i:187;s:5:"Forum";i:188;s:12:"Francois+One";i:189;s:20:"Fredericka+the+Great";i:190;s:11:"Fredoka+One";i:191;s:8:"Freehand";i:192;s:6:"Fresca";i:193;s:7:"Frijole";i:194;s:9:"Fugaz+One";i:195;s:9:"GFS+Didot";i:196;s:15:"GFS+Neohellenic";i:197;s:8:"Galdeano";i:198;s:13:"Gentium+Basic";i:199;s:18:"Gentium+Book+Basic";i:200;s:3:"Geo";i:201;s:7:"Geostar";i:202;s:12:"Geostar+Fill";i:203;s:12:"Germania+One";i:204;s:14:"Give+You+Glory";i:205;s:13:"Glass+Antiqua";i:206;s:6:"Glegoo";i:207;s:17:"Gloria+Hallelujah";i:208;s:10:"Goblin+One";i:209;s:10:"Gochi+Hand";i:210;s:8:"Gorditas";i:211;s:21:"Goudy+Bookletter+1911";i:212;s:8:"Graduate";i:213;s:12:"Gravitas+One";i:214;s:11:"Great+Vibes";i:215;s:6:"Gruppo";i:216;s:5:"Gudea";i:217;s:6:"Habibi";i:218;s:15:"Hammersmith+One";i:219;s:7:"Handlee";i:220;s:7:"Hanuman";i:221;s:12:"Happy+Monkey";i:222;s:11:"Henny+Penny";i:223;s:20:"Herr+Von+Muellerhoff";i:224;s:15:"Holtwood+One+SC";i:225;s:14:"Homemade+Apple";i:226;s:8:"Homenaje";i:227;s:15:"IM+Fell+DW+Pica";i:228;s:18:"IM+Fell+DW+Pica+SC";i:229;s:19:"IM+Fell+Double+Pica";i:230;s:22:"IM+Fell+Double+Pica+SC";i:231;s:15:"IM+Fell+English";i:232;s:18:"IM+Fell+English+SC";i:233;s:20:"IM+Fell+French+Canon";i:234;s:23:"IM+Fell+French+Canon+SC";i:235;s:20:"IM+Fell+Great+Primer";i:236;s:23:"IM+Fell+Great+Primer+SC";i:237;s:7:"Iceberg";i:238;s:7:"Iceland";i:239;s:7:"Imprima";i:240;s:11:"Inconsolata";i:241;s:5:"Inder";i:242;s:12:"Indie+Flower";i:243;s:5:"Inika";i:244;s:12:"Irish+Grover";i:245;s:9:"Istok+Web";i:246;s:8:"Italiana";i:247;s:9:"Italianno";i:248;s:14:"Jim+Nightshade";i:249;s:10:"Jockey+One";i:250;s:12:"Jolly+Lodger";i:251;s:12:"Josefin+Sans";i:252;s:12:"Josefin+Slab";i:253;s:6:"Judson";i:254;s:5:"Julee";i:255;s:5:"Junge";i:256;s:4:"Jura";i:257;s:17:"Just+Another+Hand";i:258;s:23:"Just+Me+Again+Down+Here";i:259;s:7:"Kameron";i:260;s:5:"Karla";i:261;s:14:"Kaushan+Script";i:262;s:10:"Kelly+Slab";i:263;s:5:"Kenia";i:264;s:5:"Khmer";i:265;s:7:"Knewave";i:266;s:9:"Kotta+One";i:267;s:6:"Koulen";i:268;s:6:"Kranky";i:269;s:5:"Kreon";i:270;s:6:"Kristi";i:271;s:9:"Krona+One";i:272;s:15:"La+Belle+Aurore";i:273;s:8:"Lancelot";i:274;s:4:"Lato";i:275;s:13:"League+Script";i:276;s:12:"Leckerli+One";i:277;s:6:"Ledger";i:278;s:6:"Lekton";i:279;s:5:"Lemon";i:280;s:10:"Lilita+One";i:281;s:9:"Limelight";i:282;s:11:"Linden+Hill";i:283;s:7:"Lobster";i:284;s:11:"Lobster+Two";i:285;s:16:"Londrina+Outline";i:286;s:15:"Londrina+Shadow";i:287;s:15:"Londrina+Sketch";i:288;s:14:"Londrina+Solid";i:289;s:4:"Lora";i:290;s:21:"Love+Ya+Like+A+Sister";i:291;s:17:"Loved+by+the+King";i:292;s:14:"Lovers+Quarrel";i:293;s:12:"Luckiest+Guy";i:294;s:8:"Lusitana";i:295;s:7:"Lustria";i:296;s:7:"Macondo";i:297;s:18:"Macondo+Swash+Caps";i:298;s:5:"Magra";i:299;s:13:"Maiden+Orange";i:300;s:4:"Mako";i:301;s:12:"Marck+Script";i:302;s:9:"Marko+One";i:303;s:8:"Marmelad";i:304;s:6:"Marvel";i:305;s:4:"Mate";i:306;s:7:"Mate+SC";i:307;s:9:"Maven+Pro";i:308;s:6:"Meddon";i:309;s:13:"MedievalSharp";i:310;s:10:"Medula+One";i:311;s:6:"Megrim";i:312;s:12:"Merienda+One";i:313;s:12:"Merriweather";i:314;s:5:"Metal";i:315;s:12:"Metamorphous";i:316;s:11:"Metrophobic";i:317;s:8:"Michroma";i:318;s:9:"Miltonian";i:319;s:16:"Miltonian+Tattoo";i:320;s:7:"Miniver";i:321;s:14:"Miss+Fajardose";i:322;s:14:"Modern+Antiqua";i:323;s:7:"Molengo";i:324;s:8:"Monofett";i:325;s:7:"Monoton";i:326;s:20:"Monsieur+La+Doulaise";i:327;s:7:"Montaga";i:328;s:6:"Montez";i:329;s:10:"Montserrat";i:330;s:4:"Moul";i:331;s:8:"Moulpali";i:332;s:22:"Mountains+of+Christmas";i:333;s:10:"Mr+Bedfort";i:334;s:8:"Mr+Dafoe";i:335;s:14:"Mr+De+Haviland";i:336;s:19:"Mrs+Saint+Delafield";i:337;s:13:"Mrs+Sheppards";i:338;s:4:"Muli";i:339;s:13:"Mystery+Quest";i:340;s:6:"Neucha";i:341;s:6:"Neuton";i:342;s:10:"News+Cycle";i:343;s:7:"Niconne";i:344;s:9:"Nixie+One";i:345;s:6:"Nobile";i:346;s:6:"Nokora";i:347;s:7:"Norican";i:348;s:7:"Nosifer";i:349;s:20:"Nothing+You+Could+Do";i:350;s:12:"Noticia+Text";i:351;s:8:"Nova+Cut";i:352;s:9:"Nova+Flat";i:353;s:9:"Nova+Mono";i:354;s:9:"Nova+Oval";i:355;s:10:"Nova+Round";i:356;s:11:"Nova+Script";i:357;s:9:"Nova+Slim";i:358;s:11:"Nova+Square";i:359;s:6:"Numans";i:360;s:6:"Nunito";i:361;s:14:"Odor+Mean+Chey";i:362;s:15:"Old+Standard+TT";i:363;s:9:"Oldenburg";i:364;s:11:"Oleo+Script";i:365;s:9:"Open+Sans";i:366;s:13:"Open+Sans:300";i:367;s:13:"Open+Sans:700";i:368;s:19:"Open+Sans+Condensed";i:369;s:8:"Orbitron";i:370;s:15:"Original+Surfer";i:371;s:6:"Oswald";i:372;s:16:"Over+the+Rainbow";i:373;s:8:"Overlock";i:374;s:11:"Overlock+SC";i:375;s:3:"Ovo";i:376;s:6:"Oxygen";i:377;s:7:"PT+Mono";i:378;s:7:"PT+Sans";i:379;s:15:"PT+Sans+Caption";i:380;s:14:"PT+Sans+Narrow";i:381;s:8:"PT+Serif";i:382;s:16:"PT+Serif+Caption";i:383;s:8:"Pacifico";i:384;s:10:"Parisienne";i:385;s:11:"Passero+One";i:386;s:11:"Passion+One";i:387;s:12:"Patrick+Hand";i:388;s:9:"Patua+One";i:389;s:11:"Paytone+One";i:390;s:16:"Permanent+Marker";i:391;s:7:"Petrona";i:392;s:11:"Philosopher";i:393;s:6:"Piedra";i:394;s:13:"Pinyon+Script";i:395;s:7:"Plaster";i:396;s:4:"Play";i:397;s:8:"Playball";i:398;s:16:"Playfair+Display";i:399;s:7:"Podkova";i:400;s:10:"Poiret+One";i:401;s:10:"Poller+One";i:402;s:4:"Poly";i:403;s:8:"Pompiere";i:404;s:12:"Pontano+Sans";i:405;s:16:"Port+Lligat+Sans";i:406;s:16:"Port+Lligat+Slab";i:407;s:5:"Prata";i:408;s:11:"Preahvihear";i:409;s:14:"Press+Start+2P";i:410;s:14:"Princess+Sofia";i:411;s:8:"Prociono";i:412;s:10:"Prosto+One";i:413;s:7:"Puritan";i:414;s:8:"Quantico";i:415;s:12:"Quattrocento";i:416;s:17:"Quattrocento+Sans";i:417;s:9:"Questrial";i:418;s:9:"Quicksand";i:419;s:7:"Qwigley";i:420;s:6:"Radley";i:421;s:7:"Raleway";i:422;s:11:"Raleway:500";i:423;s:12:"Rammetto+One";i:424;s:6:"Rancho";i:425;s:9:"Rationale";i:426;s:9:"Redressed";i:427;s:13:"Reenie+Beanie";i:428;s:7:"Revalia";i:429;s:6:"Ribeye";i:430;s:13:"Ribeye+Marrow";i:431;s:9:"Righteous";i:432;s:9:"Rochester";i:433;s:9:"Rock+Salt";i:434;s:7:"Rokkitt";i:435;s:9:"Ropa+Sans";i:436;s:7:"Rosario";i:437;s:8:"Rosarivo";i:438;s:12:"Rouge+Script";i:439;s:4:"Ruda";i:440;s:11:"Ruge+Boogie";i:441;s:6:"Ruluko";i:442;s:14:"Ruslan+Display";i:443;s:9:"Russo+One";i:444;s:6:"Ruthie";i:445;s:4:"Sail";i:446;s:5:"Salsa";i:447;s:8:"Sancreek";i:448;s:11:"Sansita+One";i:449;s:6:"Sarina";i:450;s:7:"Satisfy";i:451;s:10:"Schoolbell";i:452;s:14:"Seaweed+Script";i:453;s:9:"Sevillana";i:454;s:18:"Shadows+Into+Light";i:455;s:22:"Shadows+Into+Light+Two";i:456;s:6:"Shanti";i:457;s:5:"Share";i:458;s:9:"Shojumaru";i:459;s:11:"Short+Stack";i:460;s:8:"Siemreap";i:461;s:10:"Sigmar+One";i:462;s:7:"Signika";i:463;s:16:"Signika+Negative";i:464;s:9:"Simonetta";i:465;s:13:"Sirin+Stencil";i:466;s:8:"Six+Caps";i:467;s:7:"Slackey";i:468;s:6:"Smokum";i:469;s:6:"Smythe";i:470;s:7:"Sniglet";i:471;s:7:"Snippet";i:472;s:5:"Sofia";i:473;s:10:"Sonsie+One";i:474;s:16:"Sorts+Mill+Goudy";i:475;s:13:"Special+Elite";i:476;s:10:"Spicy+Rice";i:477;s:9:"Spinnaker";i:478;s:6:"Spirax";i:479;s:10:"Squada+One";i:480;s:15:"Stardos+Stencil";i:481;s:21:"Stint+Ultra+Condensed";i:482;s:20:"Stint+Ultra+Expanded";i:483;s:5:"Stoke";i:484;s:19:"Sue+Ellen+Francisco";i:485;s:9:"Sunshiney";i:486;s:16:"Supermercado+One";i:487;s:11:"Suwannaphum";i:488;s:18:"Swanky+and+Moo+Moo";i:489;s:9:"Syncopate";i:490;s:9:"Tangerine";i:491;s:6:"Taprom";i:492;s:5:"Telex";i:493;s:10:"Tenor+Sans";i:494;s:18:"The+Girl+Next+Door";i:495;s:6:"Tienne";i:496;s:5:"Tinos";i:497;s:9:"Titan+One";i:498;s:11:"Trade+Winds";i:499;s:7:"Trocchi";i:500;s:7:"Trochut";i:501;s:7:"Trykker";i:502;s:10:"Tulpen+One";i:503;s:6:"Ubuntu";i:504;s:16:"Ubuntu+Condensed";i:505;s:11:"Ubuntu+Mono";i:506;s:5:"Ultra";i:507;s:14:"Uncial+Antiqua";i:508;s:14:"UnifrakturCook";i:509;s:18:"UnifrakturMaguntia";i:510;s:7:"Unkempt";i:511;s:6:"Unlock";i:512;s:4:"Unna";i:513;s:5:"VT323";i:514;s:6:"Varela";i:515;s:12:"Varela+Round";i:516;s:11:"Vast+Shadow";i:517;s:5:"Vibur";i:518;s:8:"Vidaloka";i:519;s:4:"Viga";i:520;s:5:"Voces";i:521;s:7:"Volkhov";i:522;s:8:"Vollkorn";i:523;s:8:"Voltaire";i:524;s:23:"Waiting+for+the+Sunrise";i:525;s:8:"Wallpoet";i:526;s:15:"Walter+Turncoat";i:527;s:9:"Wellfleet";i:528;s:8:"Wire+One";i:529;s:17:"Yanone+Kaffeesatz";i:530;s:10:"Yellowtail";i:531;s:10:"Yeseva+One";i:532;s:10:"Yesteryear";i:533;s:6:"Zeyada";}}i:53;a:6:{s:4:"name";s:14:"Body Font size";s:4:"desc";s:0:"";s:2:"id";s:17:"ls_body_font_size";s:3:"std";s:4:"11px";s:4:"type";s:6:"select";s:7:"options";a:25:{i:0;s:3:"8px";i:1;s:3:"9px";i:2;s:4:"10px";i:3;s:4:"11px";i:4;s:4:"12px";i:5;s:4:"13px";i:6;s:4:"14px";i:7;s:4:"15px";i:8;s:4:"16px";i:9;s:4:"17px";i:10;s:4:"18px";i:11;s:4:"19px";i:12;s:4:"20px";i:13;s:4:"21px";i:14;s:4:"22px";i:15;s:4:"23px";i:16;s:4:"24px";i:17;s:4:"25px";i:18;s:4:"26px";i:19;s:4:"27px";i:20;s:4:"28px";i:21;s:4:"28px";i:22;s:4:"30px";i:23;s:4:"36px";i:24;s:4:"42px";}}i:54;a:5:{s:4:"name";s:15:"Body Font color";s:4:"desc";s:0:"";s:2:"id";s:18:"ls_body_font_color";s:3:"std";s:7:"#4E4F59";s:4:"type";s:5:"color";}i:55;a:6:{s:4:"name";s:20:"Headings Font family";s:4:"desc";s:0:"";s:2:"id";s:29:"ls_title_headings_font_family";s:3:"std";s:13:"Open+Sans:700";s:4:"type";s:6:"select";s:7:"options";a:534:{i:0;s:5:"Arial";i:1;s:13:"Comic Sans MS";i:2;s:9:"Helvetica";i:3;s:7:"Georgia";i:4;s:19:"Lucida Sans Unicode";i:5;s:6:"Tahoma";i:6;s:12:"Trebuchet MS";i:7;s:7:"Verdana";i:8;s:4:"Abel";i:9;s:13:"Abril+Fatface";i:10;s:8:"Aclonica";i:11;s:4:"Acme";i:12;s:5:"Actor";i:13;s:7:"Adamina";i:14;s:10:"Advent+Pro";i:15;s:15:"Aguafina+Script";i:16;s:6:"Aladin";i:17;s:7:"Aldrich";i:18;s:8:"Alegreya";i:19;s:11:"Alegreya+SC";i:20;s:10:"Alex+Brush";i:21;s:13:"Alfa+Slab+One";i:22;s:5:"Alice";i:23;s:5:"Alike";i:24;s:13:"Alike+Angular";i:25;s:5:"Allan";i:26;s:7:"Allerta";i:27;s:15:"Allerta+Stencil";i:28;s:6:"Allura";i:29;s:8:"Almendra";i:30;s:11:"Almendra+SC";i:31;s:8:"Amaranth";i:32;s:9:"Amatic+SC";i:33;s:9:"Amethysta";i:34;s:6:"Andada";i:35;s:6:"Andika";i:36;s:6:"Angkor";i:37;s:24:"Annie+Use+Your+Telescope";i:38;s:13:"Anonymous+Pro";i:39;s:5:"Antic";i:40;s:12:"Antic+Didone";i:41;s:10:"Antic+Slab";i:42;s:5:"Anton";i:43;s:6:"Arapey";i:44;s:7:"Arbutus";i:45;s:19:"Architects+Daughter";i:46;s:5:"Arimo";i:47;s:8:"Arizonia";i:48;s:6:"Armata";i:49;s:8:"Artifika";i:50;s:4:"Arvo";i:51;s:4:"Asap";i:52;s:5:"Asset";i:53;s:7:"Astloch";i:54;s:4:"Asul";i:55;s:10:"Atomic+Age";i:56;s:6:"Aubrey";i:57;s:9:"Audiowide";i:58;s:7:"Average";i:59;s:19:"Averia+Gruesa+Libre";i:60;s:12:"Averia+Libre";i:61;s:17:"Averia+Sans+Libre";i:62;s:18:"Averia+Serif+Libre";i:63;s:10:"Bad+Script";i:64;s:9:"Balthazar";i:65;s:7:"Bangers";i:66;s:5:"Basic";i:67;s:10:"Battambang";i:68;s:7:"Baumans";i:69;s:5:"Bayon";i:70;s:8:"Belgrano";i:71;s:7:"Belleza";i:72;s:7:"Bentham";i:73;s:15:"Berkshire+Swash";i:74;s:5:"Bevan";i:75;s:11:"Bigshot+One";i:76;s:5:"Bilbo";i:77;s:16:"Bilbo+Swash+Caps";i:78;s:6:"Bitter";i:79;s:13:"Black+Ops+One";i:80;s:5:"Bokor";i:81;s:6:"Bonbon";i:82;s:8:"Boogaloo";i:83;s:10:"Bowlby+One";i:84;s:13:"Bowlby+One+SC";i:85;s:7:"Brawler";i:86;s:10:"Bree+Serif";i:87;s:14:"Bubblegum+Sans";i:88;s:4:"Buda";i:89;s:7:"Buenard";i:90;s:10:"Butcherman";i:91;s:14:"Butterfly+Kids";i:92;s:5:"Cabin";i:93;s:15:"Cabin+Condensed";i:94;s:12:"Cabin+Sketch";i:95;s:15:"Caesar+Dressing";i:96;s:10:"Cagliostro";i:97;s:14:"Calligraffitti";i:98;s:5:"Cambo";i:99;s:6:"Candal";i:100;s:9:"Cantarell";i:101;s:11:"Cantata+One";i:102;s:5:"Cardo";i:103;s:5:"Carme";i:104;s:10:"Carter+One";i:105;s:6:"Caudex";i:106;s:18:"Cedarville+Cursive";i:107;s:11:"Ceviche+One";i:108;s:10:"Changa+One";i:109;s:6:"Chango";i:110;s:18:"Chau+Philomene+One";i:111;s:14:"Chelsea+Market";i:112;s:6:"Chenla";i:113;s:17:"Cherry+Cream+Soda";i:114;s:5:"Chewy";i:115;s:6:"Chicle";i:116;s:5:"Chivo";i:117;s:4:"Coda";i:118;s:12:"Coda+Caption";i:119;s:8:"Codystar";i:120;s:9:"Comfortaa";i:121;s:11:"Coming+Soon";i:122;s:11:"Concert+One";i:123;s:9:"Condiment";i:124;s:7:"Content";i:125;s:12:"Contrail+One";i:126;s:11:"Convergence";i:127;s:6:"Cookie";i:128;s:5:"Copse";i:129;s:6:"Corben";i:130;s:7:"Cousine";i:131;s:8:"Coustard";i:132;s:21:"Covered+By+Your+Grace";i:133;s:12:"Crafty+Girls";i:134;s:9:"Creepster";i:135;s:11:"Crete+Round";i:136;s:12:"Crimson+Text";i:137;s:7:"Crushed";i:138;s:6:"Cuprum";i:139;s:6:"Cutive";i:140;s:6:"Damion";i:141;s:14:"Dancing+Script";i:142;s:7:"Dangrek";i:143;s:20:"Dawning+of+a+New+Day";i:144;s:8:"Days+One";i:145;s:6:"Delius";i:146;s:17:"Delius+Swash+Caps";i:147;s:14:"Delius+Unicase";i:148;s:13:"Della+Respira";i:149;s:10:"Devonshire";i:150;s:13:"Didact+Gothic";i:151;s:9:"Diplomata";i:152;s:12:"Diplomata+SC";i:153;s:10:"Doppio+One";i:154;s:5:"Dorsa";i:155;s:5:"Dosis";i:156;s:11:"Dr+Sugiyama";i:157;s:10:"Droid+Sans";i:158;s:15:"Droid+Sans+Mono";i:159;s:11:"Droid+Serif";i:160;s:9:"Duru+Sans";i:161;s:9:"Dynalight";i:162;s:11:"EB+Garamond";i:163;s:5:"Eater";i:164;s:9:"Economica";i:165;s:11:"Electrolize";i:166;s:11:"Emblema+One";i:167;s:12:"Emilys+Candy";i:168;s:10:"Engagement";i:169;s:9:"Enriqueta";i:170;s:9:"Erica+One";i:171;s:7:"Esteban";i:172;s:15:"Euphoria+Script";i:173;s:5:"Ewert";i:174;s:3:"Exo";i:175;s:13:"Expletus+Sans";i:176;s:12:"Fanwood+Text";i:177;s:9:"Fascinate";i:178;s:16:"Fascinate+Inline";i:179;s:8:"Federant";i:180;s:6:"Federo";i:181;s:6:"Felipa";i:182;s:9:"Fjord+One";i:183;s:8:"Flamenco";i:184;s:7:"Flavors";i:185;s:10:"Fondamento";i:186;s:16:"Fontdiner+Swanky";i:187;s:5:"Forum";i:188;s:12:"Francois+One";i:189;s:20:"Fredericka+the+Great";i:190;s:11:"Fredoka+One";i:191;s:8:"Freehand";i:192;s:6:"Fresca";i:193;s:7:"Frijole";i:194;s:9:"Fugaz+One";i:195;s:9:"GFS+Didot";i:196;s:15:"GFS+Neohellenic";i:197;s:8:"Galdeano";i:198;s:13:"Gentium+Basic";i:199;s:18:"Gentium+Book+Basic";i:200;s:3:"Geo";i:201;s:7:"Geostar";i:202;s:12:"Geostar+Fill";i:203;s:12:"Germania+One";i:204;s:14:"Give+You+Glory";i:205;s:13:"Glass+Antiqua";i:206;s:6:"Glegoo";i:207;s:17:"Gloria+Hallelujah";i:208;s:10:"Goblin+One";i:209;s:10:"Gochi+Hand";i:210;s:8:"Gorditas";i:211;s:21:"Goudy+Bookletter+1911";i:212;s:8:"Graduate";i:213;s:12:"Gravitas+One";i:214;s:11:"Great+Vibes";i:215;s:6:"Gruppo";i:216;s:5:"Gudea";i:217;s:6:"Habibi";i:218;s:15:"Hammersmith+One";i:219;s:7:"Handlee";i:220;s:7:"Hanuman";i:221;s:12:"Happy+Monkey";i:222;s:11:"Henny+Penny";i:223;s:20:"Herr+Von+Muellerhoff";i:224;s:15:"Holtwood+One+SC";i:225;s:14:"Homemade+Apple";i:226;s:8:"Homenaje";i:227;s:15:"IM+Fell+DW+Pica";i:228;s:18:"IM+Fell+DW+Pica+SC";i:229;s:19:"IM+Fell+Double+Pica";i:230;s:22:"IM+Fell+Double+Pica+SC";i:231;s:15:"IM+Fell+English";i:232;s:18:"IM+Fell+English+SC";i:233;s:20:"IM+Fell+French+Canon";i:234;s:23:"IM+Fell+French+Canon+SC";i:235;s:20:"IM+Fell+Great+Primer";i:236;s:23:"IM+Fell+Great+Primer+SC";i:237;s:7:"Iceberg";i:238;s:7:"Iceland";i:239;s:7:"Imprima";i:240;s:11:"Inconsolata";i:241;s:5:"Inder";i:242;s:12:"Indie+Flower";i:243;s:5:"Inika";i:244;s:12:"Irish+Grover";i:245;s:9:"Istok+Web";i:246;s:8:"Italiana";i:247;s:9:"Italianno";i:248;s:14:"Jim+Nightshade";i:249;s:10:"Jockey+One";i:250;s:12:"Jolly+Lodger";i:251;s:12:"Josefin+Sans";i:252;s:12:"Josefin+Slab";i:253;s:6:"Judson";i:254;s:5:"Julee";i:255;s:5:"Junge";i:256;s:4:"Jura";i:257;s:17:"Just+Another+Hand";i:258;s:23:"Just+Me+Again+Down+Here";i:259;s:7:"Kameron";i:260;s:5:"Karla";i:261;s:14:"Kaushan+Script";i:262;s:10:"Kelly+Slab";i:263;s:5:"Kenia";i:264;s:5:"Khmer";i:265;s:7:"Knewave";i:266;s:9:"Kotta+One";i:267;s:6:"Koulen";i:268;s:6:"Kranky";i:269;s:5:"Kreon";i:270;s:6:"Kristi";i:271;s:9:"Krona+One";i:272;s:15:"La+Belle+Aurore";i:273;s:8:"Lancelot";i:274;s:4:"Lato";i:275;s:13:"League+Script";i:276;s:12:"Leckerli+One";i:277;s:6:"Ledger";i:278;s:6:"Lekton";i:279;s:5:"Lemon";i:280;s:10:"Lilita+One";i:281;s:9:"Limelight";i:282;s:11:"Linden+Hill";i:283;s:7:"Lobster";i:284;s:11:"Lobster+Two";i:285;s:16:"Londrina+Outline";i:286;s:15:"Londrina+Shadow";i:287;s:15:"Londrina+Sketch";i:288;s:14:"Londrina+Solid";i:289;s:4:"Lora";i:290;s:21:"Love+Ya+Like+A+Sister";i:291;s:17:"Loved+by+the+King";i:292;s:14:"Lovers+Quarrel";i:293;s:12:"Luckiest+Guy";i:294;s:8:"Lusitana";i:295;s:7:"Lustria";i:296;s:7:"Macondo";i:297;s:18:"Macondo+Swash+Caps";i:298;s:5:"Magra";i:299;s:13:"Maiden+Orange";i:300;s:4:"Mako";i:301;s:12:"Marck+Script";i:302;s:9:"Marko+One";i:303;s:8:"Marmelad";i:304;s:6:"Marvel";i:305;s:4:"Mate";i:306;s:7:"Mate+SC";i:307;s:9:"Maven+Pro";i:308;s:6:"Meddon";i:309;s:13:"MedievalSharp";i:310;s:10:"Medula+One";i:311;s:6:"Megrim";i:312;s:12:"Merienda+One";i:313;s:12:"Merriweather";i:314;s:5:"Metal";i:315;s:12:"Metamorphous";i:316;s:11:"Metrophobic";i:317;s:8:"Michroma";i:318;s:9:"Miltonian";i:319;s:16:"Miltonian+Tattoo";i:320;s:7:"Miniver";i:321;s:14:"Miss+Fajardose";i:322;s:14:"Modern+Antiqua";i:323;s:7:"Molengo";i:324;s:8:"Monofett";i:325;s:7:"Monoton";i:326;s:20:"Monsieur+La+Doulaise";i:327;s:7:"Montaga";i:328;s:6:"Montez";i:329;s:10:"Montserrat";i:330;s:4:"Moul";i:331;s:8:"Moulpali";i:332;s:22:"Mountains+of+Christmas";i:333;s:10:"Mr+Bedfort";i:334;s:8:"Mr+Dafoe";i:335;s:14:"Mr+De+Haviland";i:336;s:19:"Mrs+Saint+Delafield";i:337;s:13:"Mrs+Sheppards";i:338;s:4:"Muli";i:339;s:13:"Mystery+Quest";i:340;s:6:"Neucha";i:341;s:6:"Neuton";i:342;s:10:"News+Cycle";i:343;s:7:"Niconne";i:344;s:9:"Nixie+One";i:345;s:6:"Nobile";i:346;s:6:"Nokora";i:347;s:7:"Norican";i:348;s:7:"Nosifer";i:349;s:20:"Nothing+You+Could+Do";i:350;s:12:"Noticia+Text";i:351;s:8:"Nova+Cut";i:352;s:9:"Nova+Flat";i:353;s:9:"Nova+Mono";i:354;s:9:"Nova+Oval";i:355;s:10:"Nova+Round";i:356;s:11:"Nova+Script";i:357;s:9:"Nova+Slim";i:358;s:11:"Nova+Square";i:359;s:6:"Numans";i:360;s:6:"Nunito";i:361;s:14:"Odor+Mean+Chey";i:362;s:15:"Old+Standard+TT";i:363;s:9:"Oldenburg";i:364;s:11:"Oleo+Script";i:365;s:9:"Open+Sans";i:366;s:13:"Open+Sans:300";i:367;s:13:"Open+Sans:700";i:368;s:19:"Open+Sans+Condensed";i:369;s:8:"Orbitron";i:370;s:15:"Original+Surfer";i:371;s:6:"Oswald";i:372;s:16:"Over+the+Rainbow";i:373;s:8:"Overlock";i:374;s:11:"Overlock+SC";i:375;s:3:"Ovo";i:376;s:6:"Oxygen";i:377;s:7:"PT+Mono";i:378;s:7:"PT+Sans";i:379;s:15:"PT+Sans+Caption";i:380;s:14:"PT+Sans+Narrow";i:381;s:8:"PT+Serif";i:382;s:16:"PT+Serif+Caption";i:383;s:8:"Pacifico";i:384;s:10:"Parisienne";i:385;s:11:"Passero+One";i:386;s:11:"Passion+One";i:387;s:12:"Patrick+Hand";i:388;s:9:"Patua+One";i:389;s:11:"Paytone+One";i:390;s:16:"Permanent+Marker";i:391;s:7:"Petrona";i:392;s:11:"Philosopher";i:393;s:6:"Piedra";i:394;s:13:"Pinyon+Script";i:395;s:7:"Plaster";i:396;s:4:"Play";i:397;s:8:"Playball";i:398;s:16:"Playfair+Display";i:399;s:7:"Podkova";i:400;s:10:"Poiret+One";i:401;s:10:"Poller+One";i:402;s:4:"Poly";i:403;s:8:"Pompiere";i:404;s:12:"Pontano+Sans";i:405;s:16:"Port+Lligat+Sans";i:406;s:16:"Port+Lligat+Slab";i:407;s:5:"Prata";i:408;s:11:"Preahvihear";i:409;s:14:"Press+Start+2P";i:410;s:14:"Princess+Sofia";i:411;s:8:"Prociono";i:412;s:10:"Prosto+One";i:413;s:7:"Puritan";i:414;s:8:"Quantico";i:415;s:12:"Quattrocento";i:416;s:17:"Quattrocento+Sans";i:417;s:9:"Questrial";i:418;s:9:"Quicksand";i:419;s:7:"Qwigley";i:420;s:6:"Radley";i:421;s:7:"Raleway";i:422;s:11:"Raleway:500";i:423;s:12:"Rammetto+One";i:424;s:6:"Rancho";i:425;s:9:"Rationale";i:426;s:9:"Redressed";i:427;s:13:"Reenie+Beanie";i:428;s:7:"Revalia";i:429;s:6:"Ribeye";i:430;s:13:"Ribeye+Marrow";i:431;s:9:"Righteous";i:432;s:9:"Rochester";i:433;s:9:"Rock+Salt";i:434;s:7:"Rokkitt";i:435;s:9:"Ropa+Sans";i:436;s:7:"Rosario";i:437;s:8:"Rosarivo";i:438;s:12:"Rouge+Script";i:439;s:4:"Ruda";i:440;s:11:"Ruge+Boogie";i:441;s:6:"Ruluko";i:442;s:14:"Ruslan+Display";i:443;s:9:"Russo+One";i:444;s:6:"Ruthie";i:445;s:4:"Sail";i:446;s:5:"Salsa";i:447;s:8:"Sancreek";i:448;s:11:"Sansita+One";i:449;s:6:"Sarina";i:450;s:7:"Satisfy";i:451;s:10:"Schoolbell";i:452;s:14:"Seaweed+Script";i:453;s:9:"Sevillana";i:454;s:18:"Shadows+Into+Light";i:455;s:22:"Shadows+Into+Light+Two";i:456;s:6:"Shanti";i:457;s:5:"Share";i:458;s:9:"Shojumaru";i:459;s:11:"Short+Stack";i:460;s:8:"Siemreap";i:461;s:10:"Sigmar+One";i:462;s:7:"Signika";i:463;s:16:"Signika+Negative";i:464;s:9:"Simonetta";i:465;s:13:"Sirin+Stencil";i:466;s:8:"Six+Caps";i:467;s:7:"Slackey";i:468;s:6:"Smokum";i:469;s:6:"Smythe";i:470;s:7:"Sniglet";i:471;s:7:"Snippet";i:472;s:5:"Sofia";i:473;s:10:"Sonsie+One";i:474;s:16:"Sorts+Mill+Goudy";i:475;s:13:"Special+Elite";i:476;s:10:"Spicy+Rice";i:477;s:9:"Spinnaker";i:478;s:6:"Spirax";i:479;s:10:"Squada+One";i:480;s:15:"Stardos+Stencil";i:481;s:21:"Stint+Ultra+Condensed";i:482;s:20:"Stint+Ultra+Expanded";i:483;s:5:"Stoke";i:484;s:19:"Sue+Ellen+Francisco";i:485;s:9:"Sunshiney";i:486;s:16:"Supermercado+One";i:487;s:11:"Suwannaphum";i:488;s:18:"Swanky+and+Moo+Moo";i:489;s:9:"Syncopate";i:490;s:9:"Tangerine";i:491;s:6:"Taprom";i:492;s:5:"Telex";i:493;s:10:"Tenor+Sans";i:494;s:18:"The+Girl+Next+Door";i:495;s:6:"Tienne";i:496;s:5:"Tinos";i:497;s:9:"Titan+One";i:498;s:11:"Trade+Winds";i:499;s:7:"Trocchi";i:500;s:7:"Trochut";i:501;s:7:"Trykker";i:502;s:10:"Tulpen+One";i:503;s:6:"Ubuntu";i:504;s:16:"Ubuntu+Condensed";i:505;s:11:"Ubuntu+Mono";i:506;s:5:"Ultra";i:507;s:14:"Uncial+Antiqua";i:508;s:14:"UnifrakturCook";i:509;s:18:"UnifrakturMaguntia";i:510;s:7:"Unkempt";i:511;s:6:"Unlock";i:512;s:4:"Unna";i:513;s:5:"VT323";i:514;s:6:"Varela";i:515;s:12:"Varela+Round";i:516;s:11:"Vast+Shadow";i:517;s:5:"Vibur";i:518;s:8:"Vidaloka";i:519;s:4:"Viga";i:520;s:5:"Voces";i:521;s:7:"Volkhov";i:522;s:8:"Vollkorn";i:523;s:8:"Voltaire";i:524;s:23:"Waiting+for+the+Sunrise";i:525;s:8:"Wallpoet";i:526;s:15:"Walter+Turncoat";i:527;s:9:"Wellfleet";i:528;s:8:"Wire+One";i:529;s:17:"Yanone+Kaffeesatz";i:530;s:10:"Yellowtail";i:531;s:10:"Yeseva+One";i:532;s:10:"Yesteryear";i:533;s:6:"Zeyada";}}i:56;a:5:{s:4:"name";s:19:"Headings Font color";s:4:"desc";s:0:"";s:2:"id";s:28:"ls_title_headings_font_color";s:3:"std";s:7:"#18181a";s:4:"type";s:5:"color";}i:57;a:3:{s:4:"name";s:3:"SEO";s:4:"link";s:3:"SEO";s:4:"type";s:7:"heading";}i:58;a:5:{s:4:"name";s:40:"Google Analytics or other Tracking Code ";s:4:"desc";s:21:"Paste your code here.";s:2:"id";s:19:"ls_google_analytics";s:3:"std";s:0:"";s:4:"type";s:8:"textarea";}i:59;a:5:{s:4:"name";s:14:"Homepage Title";s:4:"desc";s:20:"Enter Homepage Title";s:2:"id";s:21:"ls_seo_home_titletext";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:60;a:5:{s:4:"name";s:20:"Homepage Description";s:4:"desc";s:26:"Enter Homepage Description";s:2:"id";s:23:"ls_seo_home_description";s:3:"std";s:0:"";s:4:"type";s:8:"textarea";}i:61;a:5:{s:4:"name";s:17:"Homepage Keywords";s:4:"desc";s:24:"Enter Homepage Keywords.";s:2:"id";s:20:"ls_seo_home_keywords";s:3:"std";s:0:"";s:4:"type";s:8:"textarea";}i:62;a:3:{s:4:"name";s:4:"Blog";s:4:"link";s:4:"Blog";s:4:"type";s:7:"heading";}i:63;a:6:{s:4:"name";s:10:"Blog Style";s:4:"desc";s:0:"";s:2:"id";s:12:"ls_blogstyle";s:3:"std";s:12:"Blog Style 1";s:4:"type";s:6:"select";s:7:"options";a:3:{i:0;s:12:"Blog Style 1";i:1;s:12:"Blog Style 2";i:2;s:12:"Blog Style 3";}}i:64;a:5:{s:4:"name";s:30:"Enable Related Posts in Single";s:4:"desc";s:67:"If you want Single blog page without Related Posts leave unchecked.";s:2:"id";s:21:"ls_show_related_posts";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:65;a:6:{s:4:"name";s:22:"Count of Related Posts";s:4:"desc";s:5:"Count";s:2:"id";s:27:"ls_show_related_posts_count";s:3:"std";s:1:"3";s:4:"type";s:6:"select";s:7:"options";a:10:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:1:"5";i:5;s:1:"6";i:6;s:1:"7";i:7;s:1:"8";i:8;s:1:"9";i:9;s:2:"10";}}i:66;a:5:{s:4:"name";s:19:"Related Posts Title";s:4:"desc";s:23:"default (Related Posts)";s:2:"id";s:21:"ls_blog_related_title";s:3:"std";s:13:"Related Posts";s:4:"type";s:4:"text";}i:67;a:5:{s:4:"name";s:21:"Blog Thumbnail Height";s:4:"desc";s:11:"default 300";s:2:"id";s:20:"ls_blog_thumb_height";s:3:"std";s:3:"300";s:4:"type";s:4:"text";}i:68;a:5:{s:4:"name";s:32:"Enable Featured images in Single";s:4:"desc";s:69:"If you want Single blog page without featured images leave unchecked.";s:2:"id";s:23:"ls_show_single_featured";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:69;a:5:{s:4:"name";s:26:"Autoresize & Retina Images";s:4:"desc";s:52:"If you want use the_post_thumbnail, leave unchecked.";s:2:"id";s:16:"ls_retina_resize";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:70;a:3:{s:4:"name";s:9:"Portfolio";s:4:"link";s:9:"Portfolio";s:4:"type";s:7:"heading";}i:71;a:5:{s:4:"name";s:15:"Enable Lightbox";s:4:"desc";s:41:"Check this to enable the lightbox effect.";s:2:"id";s:11:"ls_lightbox";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:72;a:3:{s:4:"name";s:18:"Contact Form & Map";s:4:"link";s:8:"Contacts";s:4:"type";s:7:"heading";}i:73;a:5:{s:4:"name";s:26:"Contact Form Email Address";s:4:"desc";s:31:"Leave blank to use admin email.";s:2:"id";s:8:"ls_email";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:74;a:5:{s:4:"name";s:17:"Enable Google Map";s:4:"desc";s:32:"Check this to enable Google Map.";s:2:"id";s:12:"ls_gmap_show";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:75;a:5:{s:4:"name";s:14:"Google Map API";s:4:"desc";s:134:"For Google Map Shortcode <a href="https://developers.google.com/maps/documentation/javascript/tutorial#api_key">Get Google Map API</a>";s:2:"id";s:10:"ls_gmapapi";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:76;a:5:{s:4:"name";s:15:"Google Map Zoom";s:4:"desc";s:173:"The zoom property specifies the initial zoom level for the map. zoom: 0 shows a map of the Earth fully zoomed out. Higher zoom levels zoom in at a higher resolution. e.g. 15";s:2:"id";s:11:"ls_gmapzoom";s:3:"std";s:2:"15";s:4:"type";s:4:"text";}i:77;a:5:{s:4:"name";s:17:"Google Map Center";s:4:"desc";s:198:"The center property specifies where to center the map. Create a LatLng object to center the map on a specific point. Pass the coordinates in the order: latitude, longitude. e.g. 40.604993,-74.058924";s:2:"id";s:13:"ls_gmapcenter";s:3:"std";s:20:"40.604993,-74.058924";s:4:"type";s:4:"text";}i:78;a:5:{s:4:"name";s:17:"Google Map Marker";s:4:"desc";s:198:"The marker property specifies where to center the map. Create a LatLng object to center the map on a specific point. Pass the coordinates in the order: latitude, longitude. e.g. 40.604993,-74.058924";s:2:"id";s:13:"ls_gmapmarker";s:3:"std";s:20:"40.604993,-74.058924";s:4:"type";s:4:"text";}i:79;a:5:{s:4:"name";s:15:"Google Map Text";s:4:"desc";s:0:"";s:2:"id";s:11:"ls_gmaptext";s:3:"std";s:329:"<img class="alignleft" alt="FlatMagazine Wordpress Theme" src="/wp-content/themes/flatmagazine/images/logo1.png"><h3>FlatMagazine Theme</h3> Any text dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris";s:4:"type";s:8:"textarea";}i:80;a:5:{s:4:"name";s:26:"Google Map Animated Marker";s:4:"desc";s:45:"Check this to enable marker animation effect.";s:2:"id";s:11:"ls_gmapanim";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:81;a:3:{s:4:"name";s:6:"Footer";s:4:"link";s:6:"Footer";s:4:"type";s:7:"heading";}i:82;a:5:{s:4:"name";s:26:"Footer Headings Font color";s:4:"desc";s:0:"";s:2:"id";s:29:"ls_footer_headings_font_color";s:3:"std";s:7:"#999999";s:4:"type";s:5:"color";}i:83;a:5:{s:4:"name";s:17:"Footer Font color";s:4:"desc";s:0:"";s:2:"id";s:20:"ls_footer_font_color";s:3:"std";s:7:"#777C81";s:4:"type";s:5:"color";}i:84;a:5:{s:4:"name";s:17:"Footer Link color";s:4:"desc";s:0:"";s:2:"id";s:20:"ls_footer_link_color";s:3:"std";s:7:"#666666";s:4:"type";s:5:"color";}i:85;a:5:{s:4:"name";s:17:"Footer Text Right";s:4:"desc";s:55:"Enter the text you would like to display in the footer.";s:2:"id";s:20:"ls_footer_text_right";s:3:"std";s:787:"[icon name="icon-pinterest" url="#" align="right" color="#CCCCCE"] [icon name="icon-linkedin" url="#" align="right" color="#CCCCCE"] [icon name="icon-facebook" url="#" align="right" color="#CCCCCE"] [icon name="icon-google-plus" url="#" align="right" color="#CCCCCE"] [icon name="icon-twitter" url="#" align="right" color="#CCCCCE"] [icon name="icon-rss" url="#" align="right" color="#CCCCCE"] [icon name="icon-tumblr-sign" url="#" align="right" color="#CCCCCE"] [icon name="icon-youtube" url="#" align="right" color="#CCCCCE"] [icon name="icon-skype" url="#" align="right" color="#CCCCCE"] [icon name="icon-instagram" url="#" align="right" color="#CCCCCE"] [icon name="icon-flickr" url="#" align="right" color="#CCCCCE"] [icon name="icon-dribbble" url="#" align="right" color="#CCCCCE"]";s:4:"type";s:8:"textarea";}i:86;a:5:{s:4:"name";s:16:"Footer Text Left";s:4:"desc";s:55:"Enter the text you would like to display in the footer.";s:2:"id";s:19:"ls_footer_text_left";s:3:"std";s:153:"&copy; Copyright 2013. Powered by <a href="http://wordpress.org/">WordPress</a> | FlatMagazine Theme by <a href="http://www.startis.ru/">Alan Armanov</a>";s:4:"type";s:8:"textarea";}}', 'yes');
INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(166, 'ls_themename', 'FlatMagazine', 'yes'),
(167, 'ls_shortname', 'ls', 'yes'),
(168, 'ls_options', 'a:74:{s:10:"ls_top_bar";s:646:"Follow Us:   [icon name="icon-pinterest" url="#" align="right" color="#BBBBBB"] [icon name="icon-linkedin" url="#" color="#BBBBBB"] [icon name="icon-facebook" url="#" color="#BBBBBB"] [icon name="icon-google-plus" url="#" color="#BBBBBB"] [icon name="icon-twitter" url="#" color="#BBBBBB"] [icon name="icon-rss" url="#" color="#BBBBBB"] [icon name="icon-tumblr-sign" url="#" color="#BBBBBB"] [icon name="icon-youtube" url="#" color="#BBBBBB"] [icon name="icon-skype" url="#" color="#BBBBBB"] [icon name="icon-instagram" url="#" color="#BBBBBB"] [icon name="icon-flickr" url="#" color="#BBBBBB"] [icon name="icon-dribbble" url="#" color="#BBBBBB"]";s:18:"ls_top_banner_area";s:112:"<img src="http://www.startis.ru/flatmagazine/files/2013/06/tf_728x90_v2.gif" alt="728x90" style="float:right" />";s:7:"ls_logo";s:0:"";s:14:"ls_fixedheader";s:4:"true";s:14:"ls_breadcrumbs";s:4:"true";s:17:"ls_custom_favicon";s:0:"";s:13:"ls_feedburner";s:0:"";s:13:"ls_demo_panel";s:5:"false";s:6:"ls_tsc";s:4:"true";s:6:"ls_fsc";s:4:"true";s:6:"ls_ysc";s:4:"true";s:6:"ls_wsc";s:4:"true";s:11:"ls_tsc_text";s:9:"Followers";s:11:"ls_fsc_text";s:4:"Fans";s:11:"ls_ysc_text";s:11:"Subscrubers";s:11:"ls_wsc_text";s:5:"Users";s:9:"ls_layout";s:5:"Boxed";s:9:"ls_pcolor";s:6:"336699";s:13:"ls_use_scolor";s:5:"false";s:9:"ls_scolor";s:7:"#F95601";s:24:"ls_body_background_color";s:7:"#2A354A";s:19:"ls_texture_overlays";s:12:"bgwline1.png";s:16:"ls_primary_color";s:7:"#000000";s:22:"ls_primary_hover_color";s:7:"#343434";s:16:"ls_sidebar_align";s:12:"sidebar-left";s:13:"ls_custom_css";s:0:"";s:13:"ls_callme_top";s:4:"true";s:14:"ls_callme_text";s:12:"Call Me Now!";s:20:"ls_callme_email_text";s:27:"has requested a callback on";s:19:"ls_callme_name_text";s:10:"Your name:";s:20:"ls_callme_phone_text";s:11:"Your phone:";s:19:"ls_callme_time_text";s:13:"Time to call:";s:17:"ls_callme_suc_msg";s:54:"Your message has been sent, you will be contacted soon";s:19:"ls_alternative_area";s:0:"";s:16:"ls_header_height";s:3:"137";s:18:"ls_menu_font_color";s:7:"#eeeeee";s:14:"ls_show_header";s:5:"false";s:26:"ls_header_texture_overlays";s:4:"none";s:26:"ls_header_background_color";s:7:"#ffffff";s:28:"ls_header_background_opacity";s:3:"100";s:19:"ls_mobile_area_left";s:4:"true";s:20:"ls_mobile_area_right";s:4:"true";s:21:"ls_mobile_button_left";s:7:"fa-bars";s:22:"ls_mobile_button_right";s:6:"fa-cog";s:19:"ls_body_font_family";s:9:"Open+Sans";s:17:"ls_body_font_size";s:4:"11px";s:18:"ls_body_font_color";s:7:"#4E4F59";s:29:"ls_title_headings_font_family";s:13:"Open+Sans:700";s:28:"ls_title_headings_font_color";s:7:"#18181a";s:19:"ls_google_analytics";s:0:"";s:21:"ls_seo_home_titletext";s:0:"";s:23:"ls_seo_home_description";s:0:"";s:20:"ls_seo_home_keywords";s:0:"";s:12:"ls_blogstyle";s:12:"Blog Style 1";s:21:"ls_show_related_posts";s:4:"true";s:27:"ls_show_related_posts_count";s:1:"3";s:21:"ls_blog_related_title";s:13:"Related Posts";s:20:"ls_blog_thumb_height";s:3:"300";s:23:"ls_show_single_featured";s:4:"true";s:16:"ls_retina_resize";s:4:"true";s:11:"ls_lightbox";s:4:"true";s:8:"ls_email";s:0:"";s:12:"ls_gmap_show";s:4:"true";s:10:"ls_gmapapi";s:0:"";s:11:"ls_gmapzoom";s:2:"15";s:13:"ls_gmapcenter";s:20:"40.604993,-74.058924";s:13:"ls_gmapmarker";s:20:"40.604993,-74.058924";s:11:"ls_gmaptext";s:329:"<img class="alignleft" alt="FlatMagazine Wordpress Theme" src="/wp-content/themes/flatmagazine/images/logo1.png"><h3>FlatMagazine Theme</h3> Any text dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris";s:11:"ls_gmapanim";s:4:"true";s:29:"ls_footer_headings_font_color";s:7:"#999999";s:20:"ls_footer_font_color";s:7:"#777C81";s:20:"ls_footer_link_color";s:7:"#666666";s:20:"ls_footer_text_right";s:787:"[icon name="icon-pinterest" url="#" align="right" color="#CCCCCE"] [icon name="icon-linkedin" url="#" align="right" color="#CCCCCE"] [icon name="icon-facebook" url="#" align="right" color="#CCCCCE"] [icon name="icon-google-plus" url="#" align="right" color="#CCCCCE"] [icon name="icon-twitter" url="#" align="right" color="#CCCCCE"] [icon name="icon-rss" url="#" align="right" color="#CCCCCE"] [icon name="icon-tumblr-sign" url="#" align="right" color="#CCCCCE"] [icon name="icon-youtube" url="#" align="right" color="#CCCCCE"] [icon name="icon-skype" url="#" align="right" color="#CCCCCE"] [icon name="icon-instagram" url="#" align="right" color="#CCCCCE"] [icon name="icon-flickr" url="#" align="right" color="#CCCCCE"] [icon name="icon-dribbble" url="#" align="right" color="#CCCCCE"]";s:19:"ls_footer_text_left";s:153:"&copy; Copyright 2013. Powered by <a href="http://wordpress.org/">WordPress</a> | FlatMagazine Theme by <a href="http://www.startis.ru/">Alan Armanov</a>";}', 'yes'),
(169, 'ls_top_bar', 'Follow Us:   [icon name="icon-pinterest" url="#" align="right" color="#BBBBBB"] [icon name="icon-linkedin" url="#" color="#BBBBBB"] [icon name="icon-facebook" url="#" color="#BBBBBB"] [icon name="icon-google-plus" url="#" color="#BBBBBB"] [icon name="icon-twitter" url="#" color="#BBBBBB"] [icon name="icon-rss" url="#" color="#BBBBBB"] [icon name="icon-tumblr-sign" url="#" color="#BBBBBB"] [icon name="icon-youtube" url="#" color="#BBBBBB"] [icon name="icon-skype" url="#" color="#BBBBBB"] [icon name="icon-instagram" url="#" color="#BBBBBB"] [icon name="icon-flickr" url="#" color="#BBBBBB"] [icon name="icon-dribbble" url="#" color="#BBBBBB"]', 'yes'),
(170, 'ls_top_banner_area', '<img src="http://www.startis.ru/flatmagazine/files/2013/06/tf_728x90_v2.gif" alt="728x90" style="float:right" />', 'yes'),
(171, 'ls_logo', '', 'yes'),
(172, 'ls_fixedheader', 'true', 'yes'),
(173, 'ls_breadcrumbs', 'true', 'yes'),
(174, 'ls_custom_favicon', '', 'yes'),
(175, 'ls_feedburner', '', 'yes'),
(176, 'ls_demo_panel', 'false', 'yes'),
(177, 'ls_tsc', 'true', 'yes'),
(178, 'ls_fsc', 'true', 'yes'),
(179, 'ls_ysc', 'true', 'yes'),
(180, 'ls_wsc', 'true', 'yes'),
(181, 'ls_tsc_text', 'Followers', 'yes'),
(182, 'ls_fsc_text', 'Fans', 'yes'),
(183, 'ls_ysc_text', 'Subscrubers', 'yes'),
(184, 'ls_wsc_text', 'Users', 'yes'),
(185, 'ls_layout', 'Boxed', 'yes'),
(186, 'ls_pcolor', '336699', 'yes'),
(187, 'ls_use_scolor', 'false', 'yes'),
(188, 'ls_scolor', '#F95601', 'yes'),
(189, 'ls_body_background_color', '#2A354A', 'yes'),
(190, 'ls_texture_overlays', 'bgwline1.png', 'yes'),
(191, 'ls_primary_color', '#000000', 'yes'),
(192, 'ls_primary_hover_color', '#343434', 'yes'),
(193, 'ls_sidebar_align', 'sidebar-left', 'yes'),
(194, 'ls_custom_css', '', 'yes'),
(195, 'ls_callme_top', 'true', 'yes'),
(196, 'ls_callme_text', 'Call Me Now!', 'yes'),
(197, 'ls_callme_email_text', 'has requested a callback on', 'yes'),
(198, 'ls_callme_name_text', 'Your name:', 'yes'),
(199, 'ls_callme_phone_text', 'Your phone:', 'yes'),
(200, 'ls_callme_time_text', 'Time to call:', 'yes'),
(201, 'ls_callme_suc_msg', 'Your message has been sent, you will be contacted soon', 'yes'),
(202, 'ls_alternative_area', '', 'yes'),
(203, 'ls_header_height', '137', 'yes'),
(204, 'ls_menu_font_color', '#eeeeee', 'yes'),
(205, 'ls_show_header', 'false', 'yes'),
(206, 'ls_header_texture_overlays', 'none', 'yes'),
(207, 'ls_header_background_color', '#ffffff', 'yes'),
(208, 'ls_header_background_opacity', '100', 'yes'),
(209, 'ls_mobile_area_left', 'true', 'yes'),
(210, 'ls_mobile_area_right', 'true', 'yes'),
(211, 'ls_mobile_button_left', 'fa-bars', 'yes'),
(212, 'ls_mobile_button_right', 'fa-cog', 'yes'),
(213, 'ls_body_font_family', 'Open+Sans', 'yes'),
(214, 'ls_body_font_size', '11px', 'yes'),
(215, 'ls_body_font_color', '#4E4F59', 'yes'),
(216, 'ls_title_headings_font_family', 'Open+Sans:700', 'yes'),
(217, 'ls_title_headings_font_color', '#18181a', 'yes'),
(218, 'ls_google_analytics', '', 'yes'),
(219, 'ls_seo_home_titletext', '', 'yes'),
(220, 'ls_seo_home_description', '', 'yes'),
(221, 'ls_seo_home_keywords', '', 'yes'),
(222, 'ls_blogstyle', 'Blog Style 1', 'yes'),
(223, 'ls_show_related_posts', 'true', 'yes'),
(224, 'ls_show_related_posts_count', '3', 'yes'),
(225, 'ls_blog_related_title', 'Related Posts', 'yes'),
(226, 'ls_blog_thumb_height', '300', 'yes'),
(227, 'ls_show_single_featured', 'true', 'yes'),
(228, 'ls_retina_resize', 'true', 'yes'),
(229, 'ls_lightbox', 'true', 'yes'),
(230, 'ls_email', '', 'yes'),
(231, 'ls_gmap_show', 'true', 'yes'),
(232, 'ls_gmapapi', '', 'yes'),
(233, 'ls_gmapzoom', '15', 'yes'),
(234, 'ls_gmapcenter', '40.604993,-74.058924', 'yes'),
(235, 'ls_gmapmarker', '40.604993,-74.058924', 'yes'),
(236, 'ls_gmaptext', '<img class="alignleft" alt="FlatMagazine Wordpress Theme" src="/wp-content/themes/flatmagazine/images/logo1.png"><h3>FlatMagazine Theme</h3> Any text dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris', 'yes'),
(237, 'ls_gmapanim', 'true', 'yes'),
(238, 'ls_footer_headings_font_color', '#999999', 'yes'),
(239, 'ls_footer_font_color', '#777C81', 'yes'),
(240, 'ls_footer_link_color', '#666666', 'yes'),
(241, 'ls_footer_text_right', '[icon name="icon-pinterest" url="#" align="right" color="#CCCCCE"] [icon name="icon-linkedin" url="#" align="right" color="#CCCCCE"] [icon name="icon-facebook" url="#" align="right" color="#CCCCCE"] [icon name="icon-google-plus" url="#" align="right" color="#CCCCCE"] [icon name="icon-twitter" url="#" align="right" color="#CCCCCE"] [icon name="icon-rss" url="#" align="right" color="#CCCCCE"] [icon name="icon-tumblr-sign" url="#" align="right" color="#CCCCCE"] [icon name="icon-youtube" url="#" align="right" color="#CCCCCE"] [icon name="icon-skype" url="#" align="right" color="#CCCCCE"] [icon name="icon-instagram" url="#" align="right" color="#CCCCCE"] [icon name="icon-flickr" url="#" align="right" color="#CCCCCE"] [icon name="icon-dribbble" url="#" align="right" color="#CCCCCE"]', 'yes'),
(242, 'ls_footer_text_left', '&copy; Copyright 2013. Powered by <a href="http://wordpress.org/">WordPress</a> | FlatMagazine Theme by <a href="http://www.startis.ru/">Alan Armanov</a>', 'yes'),
(243, 'theme_mods_emekong', 'a:5:{i:0;b:0;s:16:"header_textcolor";s:5:"blank";s:12:"header_image";s:54:"http://emekong.dev/wp-content/uploads/2015/01/logo.png";s:17:"header_image_data";a:5:{s:13:"attachment_id";i:11;s:3:"url";s:54:"http://emekong.dev/wp-content/uploads/2015/01/logo.png";s:13:"thumbnail_url";s:54:"http://emekong.dev/wp-content/uploads/2015/01/logo.png";s:5:"width";i:266;s:6:"height";i:93;}s:18:"nav_menu_locations";a:2:{s:7:"primary";i:5;s:6:"footer";i:17;}}', 'yes'),
(246, 'theme_mods_twentytwelve', 'a:2:{i:0;b:0;s:16:"sidebars_widgets";a:2:{s:4:"time";i:1420277000;s:4:"data";a:4:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}s:9:"sidebar-2";a:0:{}s:9:"sidebar-3";a:0:{}}}}', 'yes'),
(248, 'theme_mods_twentyfourteen', 'a:1:{s:16:"sidebars_widgets";a:2:{s:4:"time";i:1420277262;s:4:"data";a:4:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}s:9:"sidebar-2";a:0:{}s:9:"sidebar-3";a:0:{}}}}', 'yes'),
(270, 'category_children', 'a:1:{i:10;a:4:{i:0;i:13;i:1;i:14;i:2;i:15;i:3;i:16;}}', 'yes'),
(292, '_transient_timeout_plugin_slugs', '1420558489', 'no'),
(293, '_transient_plugin_slugs', 'a:7:{i:0;s:19:"akismet/akismet.php";i:1;s:31:"featured-post/featured-post.php";i:2;s:9:"hello.php";i:3;s:27:"php-code-widget/execphp.php";i:4;s:19:"emekong/emekong.php";i:5;s:33:"simple-real-estate-pack-4/srp.php";i:6;s:27:"wp-property/wp-property.php";}', 'no'),
(296, 'widget_execphp', 'a:9:{i:2;a:3:{s:5:"title";s:6:"Office";s:4:"text";s:347:"<li class="office">\r\n                        <h3>Trụ sở chính</h3>\r\n                        <div class="f-content">\r\n                            Phòng 710, Bộ Kế hoạch Đầu tư thành phố Hà Nội<br>\r\n                            Số 65 Văn Miếu, Ba Đình, Hà Nội\r\n                        </div>\r\n                    </li>";s:6:"filter";b:0;}i:3;a:3:{s:5:"title";s:7:"Keyword";s:4:"text";s:782:"<li class="keyword">\r\n                        <h3>Từ khóa</h3>\r\n                        <div class="f-content">\r\n                            Dự án đầu tư | Sàn bất động sản | Sàn giao dịch các dự án đầu tư | Tư vấn đầu tư | Dự án đầu tư | Sàn bất động sản | Sàn giao dịch các dự án đầu tư | Tư vấn đầu tư | Dự án đầu tư | Sàn bất động sản | Sàn giao dịch các dự án đầu tư | Tư vấn đầu tư | Dự án đầu tư | Sàn bất động sản | Sàn giao dịch các dự án đầu tư | Tư vấn đầu tư | Dự án đầu tư | Sàn bất động sản | Sàn giao dịch các dự án đầu tư | Tư vấn đầu tư |\r\n                        </div>\r\n                    </li>";s:6:"filter";b:0;}i:4;a:3:{s:5:"title";s:7:"Contact";s:4:"text";s:560:"<li class="contact">\r\n                        <h3>Liên hệ</h3>\r\n                        <div class="f-content">\r\n                            EMEKONG - Phòng 709 - 710<br>\r\n                            Bộ Kế hoạch Đầu tư TP. Hà Nội <br>\r\n                            65 Văn Miếu, Ba Đình, Hà Nội<br><br>\r\n                            Tel: 123 456 789\r\n                            Fax: 123 456 789\r\n                            <a href="mailto:hotro@emekong.vn">hotro@emekong.vn</a>\r\n                        </div>\r\n                    </li>";s:6:"filter";b:0;}i:5;a:3:{s:5:"title";s:7:"hotline";s:4:"text";s:179:"<li class="hotline">\r\n                        <div class="f-content">\r\n                            HOT LINE: 1234 4567\r\n\r\n                        </div>\r\n                    </li>";s:6:"filter";b:0;}i:6;a:3:{s:5:"title";s:18:"footer bottom Left";s:4:"text";s:365:"<li class="copy-left">\r\n                        Copyright 2014 - Ghi rõ nguồn "Emekong.vn" khi phát hành lại thông tin từ website này. <br>\r\n                        <a href="http://emekong.vn">EMEKONG.<span>VN</span></a> - Giấy phép số 99/GP-TTĐT do Cục QL Phát thanh, Truyền hình và Thông tin điện tử cấp.\r\n                    </li>";s:6:"filter";b:0;}i:7;a:3:{s:5:"title";s:19:"footer bottom right";s:4:"text";s:206:"<li class="copy-right">\r\n                        <h3>VIỆN ĐÀO TẠO VÀ PHÁT TRIỂN KINH TẾM</h3>\r\n                        Địa chỉ: Văn Quán, Hà Đông, Hà Nội.\r\n                    </li>";s:6:"filter";b:0;}i:8;a:3:{s:5:"title";s:4:"Left";s:4:"text";s:365:"<li class="copy-left">\r\n                        Copyright 2014 - Ghi rõ nguồn "Emekong.vn" khi phát hành lại thông tin từ website này. <br>\r\n                        <a href="http://emekong.vn">EMEKONG.<span>VN</span></a> - Giấy phép số 99/GP-TTĐT do Cục QL Phát thanh, Truyền hình và Thông tin điện tử cấp.\r\n                    </li>";s:6:"filter";b:0;}i:9;a:3:{s:5:"title";s:5:"Right";s:4:"text";s:206:"<li class="copy-right">\r\n                        <h3>VIỆN ĐÀO TẠO VÀ PHÁT TRIỂN KINH TẾM</h3>\r\n                        Địa chỉ: Văn Quán, Hà Đông, Hà Nội.\r\n                    </li>";s:6:"filter";b:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(304, '_site_transient_timeout_poptags_40cd750bba9870f18aada2478b24840a', '1420400536', 'yes'),
(305, '_site_transient_poptags_40cd750bba9870f18aada2478b24840a', 'a:40:{s:6:"widget";a:3:{s:4:"name";s:6:"widget";s:4:"slug";s:6:"widget";s:5:"count";s:4:"4851";}s:4:"post";a:3:{s:4:"name";s:4:"Post";s:4:"slug";s:4:"post";s:5:"count";s:4:"3015";}s:6:"plugin";a:3:{s:4:"name";s:6:"plugin";s:4:"slug";s:6:"plugin";s:5:"count";s:4:"2967";}s:5:"admin";a:3:{s:4:"name";s:5:"admin";s:4:"slug";s:5:"admin";s:5:"count";s:4:"2471";}s:5:"posts";a:3:{s:4:"name";s:5:"posts";s:4:"slug";s:5:"posts";s:5:"count";s:4:"2299";}s:7:"sidebar";a:3:{s:4:"name";s:7:"sidebar";s:4:"slug";s:7:"sidebar";s:5:"count";s:4:"1879";}s:6:"google";a:3:{s:4:"name";s:6:"google";s:4:"slug";s:6:"google";s:5:"count";s:4:"1692";}s:7:"twitter";a:3:{s:4:"name";s:7:"twitter";s:4:"slug";s:7:"twitter";s:5:"count";s:4:"1646";}s:6:"images";a:3:{s:4:"name";s:6:"images";s:4:"slug";s:6:"images";s:5:"count";s:4:"1639";}s:9:"shortcode";a:3:{s:4:"name";s:9:"shortcode";s:4:"slug";s:9:"shortcode";s:5:"count";s:4:"1623";}s:8:"comments";a:3:{s:4:"name";s:8:"comments";s:4:"slug";s:8:"comments";s:5:"count";s:4:"1584";}s:4:"page";a:3:{s:4:"name";s:4:"page";s:4:"slug";s:4:"page";s:5:"count";s:4:"1564";}s:5:"image";a:3:{s:4:"name";s:5:"image";s:4:"slug";s:5:"image";s:5:"count";s:4:"1469";}s:8:"facebook";a:3:{s:4:"name";s:8:"Facebook";s:4:"slug";s:8:"facebook";s:5:"count";s:4:"1290";}s:3:"seo";a:3:{s:4:"name";s:3:"seo";s:4:"slug";s:3:"seo";s:5:"count";s:4:"1243";}s:5:"links";a:3:{s:4:"name";s:5:"links";s:4:"slug";s:5:"links";s:5:"count";s:4:"1158";}s:9:"wordpress";a:3:{s:4:"name";s:9:"wordpress";s:4:"slug";s:9:"wordpress";s:5:"count";s:4:"1134";}s:7:"gallery";a:3:{s:4:"name";s:7:"gallery";s:4:"slug";s:7:"gallery";s:5:"count";s:4:"1065";}s:6:"social";a:3:{s:4:"name";s:6:"social";s:4:"slug";s:6:"social";s:5:"count";s:4:"1051";}s:5:"email";a:3:{s:4:"name";s:5:"email";s:4:"slug";s:5:"email";s:5:"count";s:3:"888";}s:7:"widgets";a:3:{s:4:"name";s:7:"widgets";s:4:"slug";s:7:"widgets";s:5:"count";s:3:"883";}s:5:"pages";a:3:{s:4:"name";s:5:"pages";s:4:"slug";s:5:"pages";s:5:"count";s:3:"864";}s:3:"rss";a:3:{s:4:"name";s:3:"rss";s:4:"slug";s:3:"rss";s:5:"count";s:3:"826";}s:6:"jquery";a:3:{s:4:"name";s:6:"jquery";s:4:"slug";s:6:"jquery";s:5:"count";s:3:"823";}s:5:"media";a:3:{s:4:"name";s:5:"media";s:4:"slug";s:5:"media";s:5:"count";s:3:"772";}s:5:"video";a:3:{s:4:"name";s:5:"video";s:4:"slug";s:5:"video";s:5:"count";s:3:"741";}s:4:"ajax";a:3:{s:4:"name";s:4:"AJAX";s:4:"slug";s:4:"ajax";s:5:"count";s:3:"740";}s:7:"content";a:3:{s:4:"name";s:7:"content";s:4:"slug";s:7:"content";s:5:"count";s:3:"694";}s:10:"javascript";a:3:{s:4:"name";s:10:"javascript";s:4:"slug";s:10:"javascript";s:5:"count";s:3:"682";}s:11:"woocommerce";a:3:{s:4:"name";s:11:"woocommerce";s:4:"slug";s:11:"woocommerce";s:5:"count";s:3:"662";}s:5:"login";a:3:{s:4:"name";s:5:"login";s:4:"slug";s:5:"login";s:5:"count";s:3:"655";}s:5:"photo";a:3:{s:4:"name";s:5:"photo";s:4:"slug";s:5:"photo";s:5:"count";s:3:"645";}s:10:"buddypress";a:3:{s:4:"name";s:10:"buddypress";s:4:"slug";s:10:"buddypress";s:5:"count";s:3:"640";}s:4:"feed";a:3:{s:4:"name";s:4:"feed";s:4:"slug";s:4:"feed";s:5:"count";s:3:"630";}s:4:"link";a:3:{s:4:"name";s:4:"link";s:4:"slug";s:4:"link";s:5:"count";s:3:"630";}s:6:"photos";a:3:{s:4:"name";s:6:"photos";s:4:"slug";s:6:"photos";s:5:"count";s:3:"616";}s:9:"ecommerce";a:3:{s:4:"name";s:9:"ecommerce";s:4:"slug";s:9:"ecommerce";s:5:"count";s:3:"608";}s:7:"youtube";a:3:{s:4:"name";s:7:"youtube";s:4:"slug";s:7:"youtube";s:5:"count";s:3:"590";}s:5:"share";a:3:{s:4:"name";s:5:"Share";s:4:"slug";s:5:"share";s:5:"count";s:3:"583";}s:8:"category";a:3:{s:4:"name";s:8:"category";s:4:"slug";s:8:"category";s:5:"count";s:3:"577";}}', 'yes'),
(342, '_site_transient_timeout_theme_roots', '1420463653', 'yes'),
(343, '_site_transient_theme_roots', 'a:7:{s:6:"Avenue";s:7:"/themes";s:7:"emekong";s:7:"/themes";s:12:"flatmagazine";s:7:"/themes";s:14:"flatmagazine20";s:7:"/themes";s:14:"twentyfourteen";s:7:"/themes";s:14:"twentythirteen";s:7:"/themes";s:12:"twentytwelve";s:7:"/themes";}', 'yes'),
(344, '_site_transient_update_themes', 'O:8:"stdClass":4:{s:12:"last_checked";i:1420461883;s:7:"checked";a:6:{s:6:"Avenue";s:3:"1.2";s:7:"emekong";s:3:"1.2";s:12:"flatmagazine";s:3:"2.0";s:14:"twentyfourteen";s:3:"1.2";s:14:"twentythirteen";s:3:"1.3";s:12:"twentytwelve";s:3:"1.5";}s:8:"response";a:3:{s:14:"twentyfourteen";a:4:{s:5:"theme";s:14:"twentyfourteen";s:11:"new_version";s:3:"1.3";s:3:"url";s:43:"https://wordpress.org/themes/twentyfourteen";s:7:"package";s:60:"https://downloads.wordpress.org/theme/twentyfourteen.1.3.zip";}s:14:"twentythirteen";a:4:{s:5:"theme";s:14:"twentythirteen";s:11:"new_version";s:3:"1.4";s:3:"url";s:43:"https://wordpress.org/themes/twentythirteen";s:7:"package";s:60:"https://downloads.wordpress.org/theme/twentythirteen.1.4.zip";}s:12:"twentytwelve";a:4:{s:5:"theme";s:12:"twentytwelve";s:11:"new_version";s:3:"1.6";s:3:"url";s:41:"https://wordpress.org/themes/twentytwelve";s:7:"package";s:58:"https://downloads.wordpress.org/theme/twentytwelve.1.6.zip";}}s:12:"translations";a:0:{}}', 'yes'),
(345, '_site_transient_update_plugins', 'O:8:"stdClass":5:{s:12:"last_checked";i:1420471886;s:7:"checked";a:7:{s:19:"akismet/akismet.php";s:5:"3.0.2";s:31:"featured-post/featured-post.php";s:5:"3.2.1";s:9:"hello.php";s:3:"1.6";s:27:"php-code-widget/execphp.php";s:3:"2.2";s:19:"emekong/emekong.php";s:3:"1.0";s:33:"simple-real-estate-pack-4/srp.php";s:5:"1.3.0";s:27:"wp-property/wp-property.php";s:6:"1.42.2";}s:8:"response";a:1:{s:19:"akismet/akismet.php";O:8:"stdClass":6:{s:2:"id";s:2:"15";s:4:"slug";s:7:"akismet";s:6:"plugin";s:19:"akismet/akismet.php";s:11:"new_version";s:5:"3.0.4";s:3:"url";s:38:"https://wordpress.org/plugins/akismet/";s:7:"package";s:56:"https://downloads.wordpress.org/plugin/akismet.3.0.4.zip";}}s:12:"translations";a:0:{}s:9:"no_update";a:5:{s:31:"featured-post/featured-post.php";O:8:"stdClass":6:{s:2:"id";s:5:"15626";s:4:"slug";s:13:"featured-post";s:6:"plugin";s:31:"featured-post/featured-post.php";s:11:"new_version";s:5:"3.2.1";s:3:"url";s:44:"https://wordpress.org/plugins/featured-post/";s:7:"package";s:62:"https://downloads.wordpress.org/plugin/featured-post.3.2.1.zip";}s:9:"hello.php";O:8:"stdClass":6:{s:2:"id";s:4:"3564";s:4:"slug";s:11:"hello-dolly";s:6:"plugin";s:9:"hello.php";s:11:"new_version";s:3:"1.6";s:3:"url";s:42:"https://wordpress.org/plugins/hello-dolly/";s:7:"package";s:58:"https://downloads.wordpress.org/plugin/hello-dolly.1.6.zip";}s:27:"php-code-widget/execphp.php";O:8:"stdClass":6:{s:2:"id";s:4:"2464";s:4:"slug";s:15:"php-code-widget";s:6:"plugin";s:27:"php-code-widget/execphp.php";s:11:"new_version";s:3:"2.2";s:3:"url";s:46:"https://wordpress.org/plugins/php-code-widget/";s:7:"package";s:62:"https://downloads.wordpress.org/plugin/php-code-widget.2.2.zip";}s:33:"simple-real-estate-pack-4/srp.php";O:8:"stdClass":6:{s:2:"id";s:5:"10710";s:4:"slug";s:25:"simple-real-estate-pack-4";s:6:"plugin";s:33:"simple-real-estate-pack-4/srp.php";s:11:"new_version";s:5:"1.3.0";s:3:"url";s:56:"https://wordpress.org/plugins/simple-real-estate-pack-4/";s:7:"package";s:74:"https://downloads.wordpress.org/plugin/simple-real-estate-pack-4.1.3.0.zip";}s:27:"wp-property/wp-property.php";O:8:"stdClass":6:{s:2:"id";s:5:"15777";s:4:"slug";s:11:"wp-property";s:6:"plugin";s:27:"wp-property/wp-property.php";s:11:"new_version";s:6:"1.42.2";s:3:"url";s:42:"https://wordpress.org/plugins/wp-property/";s:7:"package";s:61:"https://downloads.wordpress.org/plugin/wp-property.1.42.2.zip";}}}', 'yes'),
(352, '_transient_is_multi_author', '0', 'yes'),
(353, '_transient_featured_content_ids', 'a:0:{}', 'yes'),
(354, '_transient_timeout_feed_b9388c83948825c1edaef0d856b7b109', '1420513215', 'no'),
(355, '_transient_feed_b9388c83948825c1edaef0d856b7b109', 'a:4:{s:5:"child";a:1:{s:0:"";a:1:{s:3:"rss";a:1:{i:0;a:6:{s:4:"data";s:3:"\n	\n";s:7:"attribs";a:1:{s:0:"";a:1:{s:7:"version";s:3:"2.0";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:1:{s:0:"";a:1:{s:7:"channel";a:1:{i:0;a:6:{s:4:"data";s:72:"\n		\n		\n		\n		\n		\n		\n				\n\n		\n		\n		\n		\n		\n		\n		\n		\n		\n		\n		\n		\n		\n		\n		\n\n	";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:2:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:39:"WordPress Plugins » View: Most Popular";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:45:"https://wordpress.org/plugins/browse/popular/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:39:"WordPress Plugins » View: Most Popular";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"language";a:1:{i:0;a:5:{s:4:"data";s:5:"en-US";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Mon, 05 Jan 2015 14:38:17 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:9:"generator";a:1:{i:0;a:5:{s:4:"data";s:25:"http://bbpress.org/?v=1.1";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"item";a:15:{i:0;a:6:{s:4:"data";s:30:"\n			\n			\n			\n			\n			\n			\n					";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:2:{s:0:"";a:5:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:7:"Akismet";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:46:"https://wordpress.org/plugins/akismet/#post-15";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Fri, 09 Mar 2007 22:11:30 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:33:"15@https://wordpress.org/plugins/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:98:"Akismet checks your comments against the Akismet Web service to see if they look like spam or not.";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:14:"Matt Mullenweg";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:1;a:6:{s:4:"data";s:30:"\n			\n			\n			\n			\n			\n			\n					";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:2:{s:0:"";a:5:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:14:"Contact Form 7";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:55:"https://wordpress.org/plugins/contact-form-7/#post-2141";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Thu, 02 Aug 2007 12:45:03 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:35:"2141@https://wordpress.org/plugins/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:54:"Just another contact form plugin. Simple but flexible.";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:16:"Takayuki Miyoshi";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:2;a:6:{s:4:"data";s:30:"\n			\n			\n			\n			\n			\n			\n					";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:2:{s:0:"";a:5:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:19:"All in One SEO Pack";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:59:"https://wordpress.org/plugins/all-in-one-seo-pack/#post-753";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Fri, 30 Mar 2007 20:08:18 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:34:"753@https://wordpress.org/plugins/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:126:"All in One SEO Pack is a WordPress SEO plugin to automatically optimize your WordPress blog for Search Engines such as Google.";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:8:"uberdose";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:3;a:6:{s:4:"data";s:30:"\n			\n			\n			\n			\n			\n			\n					";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:2:{s:0:"";a:5:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:24:"Jetpack by WordPress.com";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:49:"https://wordpress.org/plugins/jetpack/#post-23862";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Thu, 20 Jan 2011 02:21:38 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:36:"23862@https://wordpress.org/plugins/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:28:"Your WordPress, Streamlined.";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:9:"Tim Moore";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:4;a:6:{s:4:"data";s:30:"\n			\n			\n			\n			\n			\n			\n					";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:2:{s:0:"";a:5:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:22:"WordPress SEO by Yoast";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:54:"https://wordpress.org/plugins/wordpress-seo/#post-8321";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Thu, 01 Jan 2009 20:34:44 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:35:"8321@https://wordpress.org/plugins/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:131:"Improve your WordPress SEO: Write better content and have a fully optimized WordPress site using Yoast&#039;s WordPress SEO plugin.";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:13:"Joost de Valk";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:5;a:6:{s:4:"data";s:30:"\n			\n			\n			\n			\n			\n			\n					";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:2:{s:0:"";a:5:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:33:"WooCommerce - excelling eCommerce";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:53:"https://wordpress.org/plugins/woocommerce/#post-29860";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Mon, 05 Sep 2011 08:13:36 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:36:"29860@https://wordpress.org/plugins/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:97:"WooCommerce is a powerful, extendable eCommerce plugin that helps you sell anything. Beautifully.";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:9:"WooThemes";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:6;a:6:{s:4:"data";s:30:"\n			\n			\n			\n			\n			\n			\n					";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:2:{s:0:"";a:5:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:18:"Wordfence Security";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:51:"https://wordpress.org/plugins/wordfence/#post-29832";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Sun, 04 Sep 2011 03:13:51 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:36:"29832@https://wordpress.org/plugins/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:137:"Wordfence Security is a free enterprise class security and performance plugin that makes your site up to 50 times faster and more secure.";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:9:"Wordfence";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:7;a:6:{s:4:"data";s:30:"\n			\n			\n			\n			\n			\n			\n					";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:2:{s:0:"";a:5:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:33:"Google Analytics Dashboard for WP";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:75:"https://wordpress.org/plugins/google-analytics-dashboard-for-wp/#post-50539";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Sun, 10 Mar 2013 17:07:11 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:36:"50539@https://wordpress.org/plugins/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:148:"Displays Google Analytics reports and real-time statistics in your WordPress Dashboard. Inserts the latest tracking code in every page of your site.";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:10:"Alin Marcu";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:8;a:6:{s:4:"data";s:30:"\n			\n			\n			\n			\n			\n			\n					";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:2:{s:0:"";a:5:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:19:"Google XML Sitemaps";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:64:"https://wordpress.org/plugins/google-sitemap-generator/#post-132";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Fri, 09 Mar 2007 22:31:32 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:34:"132@https://wordpress.org/plugins/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:105:"This plugin will generate a special XML sitemap which will help search engines to better index your blog.";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:5:"arnee";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:9;a:6:{s:4:"data";s:30:"\n			\n			\n			\n			\n			\n			\n					";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:2:{s:0:"";a:5:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:25:"Google Analytics by Yoast";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:71:"https://wordpress.org/plugins/google-analytics-for-wordpress/#post-2316";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Fri, 14 Sep 2007 12:15:27 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:35:"2316@https://wordpress.org/plugins/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:124:"Track your WordPress site easily with the latest tracking codes and lots added data for search result pages and error pages.";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:13:"Joost de Valk";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:10;a:6:{s:4:"data";s:30:"\n			\n			\n			\n			\n			\n			\n					";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:2:{s:0:"";a:5:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:18:"WordPress Importer";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:60:"https://wordpress.org/plugins/wordpress-importer/#post-18101";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Thu, 20 May 2010 17:42:45 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:36:"18101@https://wordpress.org/plugins/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:101:"Import posts, pages, comments, custom fields, categories, tags and more from a WordPress export file.";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:14:"Brian Colinger";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:11;a:6:{s:4:"data";s:30:"\n			\n			\n			\n			\n			\n			\n					";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:2:{s:0:"";a:5:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:34:"UpdraftPlus Backup and Restoration";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:53:"https://wordpress.org/plugins/updraftplus/#post-38058";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Mon, 21 May 2012 15:14:11 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:36:"38058@https://wordpress.org/plugins/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:148:"Backup and restoration made easy. Complete backups; manual or scheduled (backup to S3, Dropbox, Google Drive, Rackspace, FTP, SFTP, email + others).";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:14:"David Anderson";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:12;a:6:{s:4:"data";s:30:"\n			\n			\n			\n			\n			\n			\n					";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:2:{s:0:"";a:5:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:15:"NextGEN Gallery";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:56:"https://wordpress.org/plugins/nextgen-gallery/#post-1169";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Mon, 23 Apr 2007 20:08:06 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:35:"1169@https://wordpress.org/plugins/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:121:"The most popular WordPress gallery plugin and one of the most popular plugins of all time with over 10 million downloads.";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:9:"Alex Rabe";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:13;a:6:{s:4:"data";s:30:"\n			\n			\n			\n			\n			\n			\n					";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:2:{s:0:"";a:5:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:16:"TinyMCE Advanced";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:57:"https://wordpress.org/plugins/tinymce-advanced/#post-2082";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Wed, 27 Jun 2007 15:00:26 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:35:"2082@https://wordpress.org/plugins/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:71:"Enables the advanced features of TinyMCE, the WordPress WYSIWYG editor.";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:10:"Andrew Ozz";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:14;a:6:{s:4:"data";s:30:"\n			\n			\n			\n			\n			\n			\n					";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:2:{s:0:"";a:5:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:21:"Really Simple CAPTCHA";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:62:"https://wordpress.org/plugins/really-simple-captcha/#post-9542";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Mon, 09 Mar 2009 02:17:35 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:35:"9542@https://wordpress.org/plugins/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:138:"Really Simple CAPTCHA is a CAPTCHA module intended to be called from other plugins. It is originally created for my Contact Form 7 plugin.";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:16:"Takayuki Miyoshi";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}}}s:27:"http://www.w3.org/2005/Atom";a:1:{s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:0:"";s:7:"attribs";a:1:{s:0:"";a:3:{s:4:"href";s:46:"https://wordpress.org/plugins/rss/view/popular";s:3:"rel";s:4:"self";s:4:"type";s:19:"application/rss+xml";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}}}}}}}}s:4:"type";i:128;s:7:"headers";a:11:{s:6:"server";s:5:"nginx";s:4:"date";s:29:"Mon, 05 Jan 2015 15:00:15 GMT";s:12:"content-type";s:23:"text/xml; charset=UTF-8";s:10:"connection";s:5:"close";s:4:"vary";s:15:"Accept-Encoding";s:7:"expires";s:29:"Mon, 05 Jan 2015 15:13:17 GMT";s:13:"cache-control";s:0:"";s:6:"pragma";s:0:"";s:13:"last-modified";s:31:"Mon, 05 Jan 2015 14:38:17 +0000";s:15:"x-frame-options";s:10:"SAMEORIGIN";s:4:"x-nc";s:11:"HIT lax 250";}s:5:"build";s:14:"20130911040210";}', 'no'),
(356, '_transient_timeout_feed_mod_b9388c83948825c1edaef0d856b7b109', '1420513215', 'no'),
(357, '_transient_feed_mod_b9388c83948825c1edaef0d856b7b109', '1420470015', 'no'),
(358, '_transient_timeout_dash_4077549d03da2e451c8b5f002294ff51', '1420513215', 'no'),
(359, '_transient_dash_4077549d03da2e451c8b5f002294ff51', '<div class="rss-widget"><p><strong>RSS Error</strong>: WP HTTP Error: Operation timed out after 10001 milliseconds with 40663 bytes received</p></div><div class="rss-widget"><p><strong>RSS Error</strong>: WP HTTP Error: Operation timed out after 10001 milliseconds with 51800 out of 311953 bytes received</p></div><div class="rss-widget"><ul><li class=''dashboard-news-plugin''><span>Popular Plugin:</span> <a href=''https://wordpress.org/plugins/jetpack/'' class=''dashboard-news-plugin-link''>Jetpack by WordPress.com</a>&nbsp;<span>(<a href=''plugin-install.php?tab=plugin-information&amp;plugin=jetpack&amp;_wpnonce=4e2853f6cf&amp;TB_iframe=true&amp;width=600&amp;height=800'' class=''thickbox'' title=''Jetpack by WordPress.com''>Install</a>)</span></li></ul></div>', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `wp_postmeta`
--

DROP TABLE IF EXISTS `wp_postmeta`;
CREATE TABLE IF NOT EXISTS `wp_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=185 ;

--
-- Dumping data for table `wp_postmeta`
--

INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default'),
(2, 4, '_menu_item_type', 'custom'),
(3, 4, '_menu_item_menu_item_parent', '0'),
(4, 4, '_menu_item_object_id', '4'),
(5, 4, '_menu_item_object', 'custom'),
(6, 4, '_menu_item_target', ''),
(7, 4, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(8, 4, '_menu_item_xfn', ''),
(9, 4, '_menu_item_url', 'http://emekong.dev/'),
(11, 5, '_menu_item_type', 'post_type'),
(12, 5, '_menu_item_menu_item_parent', '0'),
(13, 5, '_menu_item_object_id', '2'),
(14, 5, '_menu_item_object', 'page'),
(15, 5, '_menu_item_target', ''),
(16, 5, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(17, 5, '_menu_item_xfn', ''),
(18, 5, '_menu_item_url', ''),
(20, 7, '_edit_last', '1'),
(21, 7, '_edit_lock', '1420271598:1'),
(22, 7, 'wtf_pid', '23'),
(23, 7, 'wtf_bath', '23'),
(24, 7, 'wtf_garage', '23'),
(25, 7, 'wtf_price', '1'),
(26, 8, 'wpp_gpid', 'gpid_1115795805'),
(27, 10, '_wp_attached_file', '2015/01/cropped-logo.png'),
(28, 10, '_wp_attachment_context', 'custom-header'),
(29, 10, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:1260;s:6:"height";i:440;s:4:"file";s:24:"2015/01/cropped-logo.png";s:5:"sizes";a:5:{s:9:"thumbnail";a:4:{s:4:"file";s:24:"cropped-logo-150x150.png";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:9:"image/png";}s:6:"medium";a:4:{s:4:"file";s:24:"cropped-logo-300x104.png";s:5:"width";i:300;s:6:"height";i:104;s:9:"mime-type";s:9:"image/png";}s:5:"large";a:4:{s:4:"file";s:25:"cropped-logo-1024x357.png";s:5:"width";i:1024;s:6:"height";i:357;s:9:"mime-type";s:9:"image/png";}s:14:"post-thumbnail";a:4:{s:4:"file";s:24:"cropped-logo-672x372.png";s:5:"width";i:672;s:6:"height";i:372;s:9:"mime-type";s:9:"image/png";}s:18:"emekong-full-width";a:4:{s:4:"file";s:25:"cropped-logo-1038x440.png";s:5:"width";i:1038;s:6:"height";i:440;s:9:"mime-type";s:9:"image/png";}}s:10:"image_meta";a:11:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";s:11:"orientation";i:0;}}'),
(30, 10, '_wp_attachment_is_custom_header', 'emekong'),
(31, 11, '_wp_attached_file', '2015/01/logo.png'),
(32, 11, '_wp_attachment_context', 'custom-header'),
(33, 11, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:266;s:6:"height";i:93;s:4:"file";s:16:"2015/01/logo.png";s:5:"sizes";a:1:{s:9:"thumbnail";a:4:{s:4:"file";s:15:"logo-150x93.png";s:5:"width";i:150;s:6:"height";i:93;s:9:"mime-type";s:9:"image/png";}}s:10:"image_meta";a:11:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";s:11:"orientation";i:0;}}'),
(34, 11, '_wp_attachment_is_custom_header', 'emekong'),
(35, 12, '_menu_item_type', 'taxonomy'),
(36, 12, '_menu_item_menu_item_parent', '0'),
(37, 12, '_menu_item_object_id', '11'),
(38, 12, '_menu_item_object', 'category'),
(39, 12, '_menu_item_target', ''),
(40, 12, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(41, 12, '_menu_item_xfn', ''),
(42, 12, '_menu_item_url', ''),
(44, 13, '_menu_item_type', 'taxonomy'),
(45, 13, '_menu_item_menu_item_parent', '0'),
(46, 13, '_menu_item_object_id', '12'),
(47, 13, '_menu_item_object', 'category'),
(48, 13, '_menu_item_target', ''),
(49, 13, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(50, 13, '_menu_item_xfn', ''),
(51, 13, '_menu_item_url', ''),
(53, 14, '_menu_item_type', 'taxonomy'),
(54, 14, '_menu_item_menu_item_parent', '0'),
(55, 14, '_menu_item_object_id', '10'),
(56, 14, '_menu_item_object', 'category'),
(57, 14, '_menu_item_target', ''),
(58, 14, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(59, 14, '_menu_item_xfn', ''),
(60, 14, '_menu_item_url', ''),
(62, 15, '_menu_item_type', 'taxonomy'),
(63, 15, '_menu_item_menu_item_parent', '14'),
(64, 15, '_menu_item_object_id', '13'),
(65, 15, '_menu_item_object', 'category'),
(66, 15, '_menu_item_target', ''),
(67, 15, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(68, 15, '_menu_item_xfn', ''),
(69, 15, '_menu_item_url', ''),
(71, 16, '_menu_item_type', 'taxonomy'),
(72, 16, '_menu_item_menu_item_parent', '14'),
(73, 16, '_menu_item_object_id', '16'),
(74, 16, '_menu_item_object', 'category'),
(75, 16, '_menu_item_target', ''),
(76, 16, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(77, 16, '_menu_item_xfn', ''),
(78, 16, '_menu_item_url', ''),
(80, 17, '_menu_item_type', 'taxonomy'),
(81, 17, '_menu_item_menu_item_parent', '14'),
(82, 17, '_menu_item_object_id', '15'),
(83, 17, '_menu_item_object', 'category'),
(84, 17, '_menu_item_target', ''),
(85, 17, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(86, 17, '_menu_item_xfn', ''),
(87, 17, '_menu_item_url', ''),
(89, 18, '_menu_item_type', 'taxonomy'),
(90, 18, '_menu_item_menu_item_parent', '14'),
(91, 18, '_menu_item_object_id', '14'),
(92, 18, '_menu_item_object', 'category'),
(93, 18, '_menu_item_target', ''),
(94, 18, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(95, 18, '_menu_item_xfn', ''),
(96, 18, '_menu_item_url', ''),
(97, 19, '_edit_last', '1'),
(98, 19, '_edit_lock', '1420381778:1'),
(99, 19, '_wp_page_template', 'default'),
(100, 21, '_menu_item_type', 'post_type'),
(101, 21, '_menu_item_menu_item_parent', '0'),
(102, 21, '_menu_item_object_id', '19'),
(103, 21, '_menu_item_object', 'page'),
(104, 21, '_menu_item_target', ''),
(105, 21, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(106, 21, '_menu_item_xfn', ''),
(107, 21, '_menu_item_url', ''),
(109, 22, '_edit_last', '1'),
(110, 22, '_wp_page_template', 'default'),
(111, 22, '_edit_lock', '1420381824:1'),
(112, 24, '_menu_item_type', 'post_type'),
(113, 24, '_menu_item_menu_item_parent', '0'),
(114, 24, '_menu_item_object_id', '22'),
(115, 24, '_menu_item_object', 'page'),
(116, 24, '_menu_item_target', ''),
(117, 24, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(118, 24, '_menu_item_xfn', ''),
(119, 24, '_menu_item_url', ''),
(121, 25, '_edit_last', '1'),
(122, 25, '_edit_lock', '1420397566:1'),
(125, 25, '_is_featured', 'yes'),
(129, 28, '_wp_attached_file', '2015/01/article-img.jpg'),
(130, 28, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:321;s:6:"height";i:302;s:4:"file";s:23:"2015/01/article-img.jpg";s:5:"sizes";a:2:{s:9:"thumbnail";a:4:{s:4:"file";s:23:"article-img-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:23:"article-img-300x282.jpg";s:5:"width";i:300;s:6:"height";i:282;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:11:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";s:11:"orientation";i:0;}}'),
(131, 29, '_wp_attached_file', '2015/01/article-img-2.jpg'),
(132, 29, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:321;s:6:"height";i:302;s:4:"file";s:25:"2015/01/article-img-2.jpg";s:5:"sizes";a:2:{s:9:"thumbnail";a:4:{s:4:"file";s:25:"article-img-2-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:25:"article-img-2-300x282.jpg";s:5:"width";i:300;s:6:"height";i:282;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:11:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";s:11:"orientation";i:0;}}'),
(133, 30, '_wp_attached_file', '2015/01/duan1.jpg'),
(134, 30, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:250;s:6:"height";i:187;s:4:"file";s:17:"2015/01/duan1.jpg";s:5:"sizes";a:1:{s:9:"thumbnail";a:4:{s:4:"file";s:17:"duan1-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:11:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";s:11:"orientation";i:0;}}'),
(135, 31, '_wp_attached_file', '2015/01/duan2.jpg'),
(136, 31, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:250;s:6:"height";i:195;s:4:"file";s:17:"2015/01/duan2.jpg";s:5:"sizes";a:1:{s:9:"thumbnail";a:4:{s:4:"file";s:17:"duan2-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:11:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";s:11:"orientation";i:0;}}'),
(137, 32, '_wp_attached_file', '2015/01/duan3.jpg'),
(138, 32, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:250;s:6:"height";i:190;s:4:"file";s:17:"2015/01/duan3.jpg";s:5:"sizes";a:1:{s:9:"thumbnail";a:4:{s:4:"file";s:17:"duan3-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:11:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";s:11:"orientation";i:0;}}'),
(139, 33, '_wp_attached_file', '2015/01/video-demo.jpg'),
(140, 33, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:261;s:6:"height";i:147;s:4:"file";s:22:"2015/01/video-demo.jpg";s:5:"sizes";a:1:{s:9:"thumbnail";a:4:{s:4:"file";s:22:"video-demo-150x147.jpg";s:5:"width";i:150;s:6:"height";i:147;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:11:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";s:11:"orientation";i:0;}}'),
(141, 25, '_thumbnail_id', '29'),
(144, 1, '_edit_lock', '1420397155:1'),
(146, 1, '_edit_last', '1'),
(149, 1, '_thumbnail_id', '28'),
(162, 37, '_thumbnail_id', '31'),
(163, 37, '_edit_last', '1'),
(166, 37, '_edit_lock', '1420397418:1'),
(167, 40, '_edit_last', '1'),
(168, 40, '_edit_lock', '1420467678:1'),
(171, 40, '_thumbnail_id', '28'),
(174, 42, '_edit_last', '1'),
(175, 42, '_edit_lock', '1420468166:1'),
(176, 42, '_thumbnail_id', '32'),
(179, 37, '_is_featured', 'yes'),
(182, 40, '_is_featured', 'yes'),
(183, 1, '_is_featured', 'no'),
(184, 42, '_is_featured', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `wp_posts`
--

DROP TABLE IF EXISTS `wp_posts`;
CREATE TABLE IF NOT EXISTS `wp_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(20) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `wp_posts`
--

INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2015-01-03 07:43:02', '2015-01-03 07:43:02', 'Welcome to WordPress. This is your first post. Edit or delete it, then start blogging!', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2015-01-04 18:47:57', '2015-01-04 18:47:57', '', 0, 'http://emekong.dev/?p=1', 0, 'post', '', 1),
(2, 1, '2015-01-03 07:43:02', '2015-01-03 07:43:02', 'This is an example page. It''s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\n\n<blockquote>Hi there! I''m a bike messenger by day, aspiring actor by night, and this is my blog. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin'' caught in the rain.)</blockquote>\n\n...or something like this:\n\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\n\nAs a new WordPress user, you should go to <a href="http://emekong.dev/wp-admin/">your dashboard</a> to delete this page and create new pages for your content. Have fun!', 'Sample Page', '', 'publish', 'open', 'open', '', 'sample-page', '', '', '2015-01-03 07:43:02', '2015-01-03 07:43:02', '', 0, 'http://emekong.dev/?page_id=2', 0, 'page', '', 0),
(3, 1, '2015-01-03 07:43:27', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-01-03 07:43:27', '0000-00-00 00:00:00', '', 0, 'http://emekong.dev/?p=3', 0, 'post', '', 0),
(4, 1, '2015-01-03 07:45:40', '2015-01-03 07:45:40', '', 'Home', '', 'publish', 'open', 'open', '', 'home', '', '', '2015-01-03 10:57:14', '2015-01-03 10:57:14', '', 0, 'http://emekong.dev/?p=4', 1, 'nav_menu_item', '', 0),
(5, 1, '2015-01-03 07:45:40', '2015-01-03 07:45:40', ' ', '', '', 'publish', 'open', 'open', '', '5', '', '', '2015-01-03 10:57:15', '2015-01-03 10:57:15', '', 0, 'http://emekong.dev/?p=5', 9, 'nav_menu_item', '', 0),
(6, 1, '2015-01-03 07:47:39', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-01-03 07:47:39', '0000-00-00 00:00:00', '', 0, 'http://emekong.dev/?post_type=listings&p=6', 0, 'listings', '', 0),
(7, 1, '2015-01-03 07:54:26', '2015-01-03 07:54:26', 'Con cặc', 'Con cặc', '', 'publish', 'closed', 'closed', '', 'con-cac', '', '', '2015-01-03 07:54:26', '2015-01-03 07:54:26', '', 0, 'http://emekong.dev/?post_type=listings&#038;p=7', 0, 'listings', '', 0),
(8, 1, '2015-01-03 08:07:23', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-01-03 08:07:23', '0000-00-00 00:00:00', '', 0, 'http://emekong.dev/?post_type=property&p=8', 0, 'property', '', 0),
(9, 1, '2015-01-03 08:11:23', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-01-03 08:11:23', '0000-00-00 00:00:00', '', 0, 'http://emekong.dev/?p=9', 0, 'post', '', 0),
(10, 1, '2015-01-03 09:50:27', '2015-01-03 09:50:27', 'http://emekong.dev/wp-content/uploads/2015/01/cropped-logo.png', 'cropped-logo.png', '', 'inherit', 'closed', 'open', '', 'cropped-logo-png', '', '', '2015-01-03 09:50:27', '2015-01-03 09:50:27', '', 0, 'http://emekong.dev/wp-content/uploads/2015/01/logo.png', 0, 'attachment', 'image/png', 0),
(11, 1, '2015-01-03 09:51:15', '2015-01-03 09:51:15', 'http://emekong.dev/wp-content/uploads/2015/01/logo.png', 'logo.png', '', 'inherit', 'closed', 'open', '', 'logo-png', '', '', '2015-01-03 09:51:15', '2015-01-03 09:51:15', '', 0, 'http://emekong.dev/wp-content/uploads/2015/01/logo.png', 0, 'attachment', 'image/png', 0),
(12, 1, '2015-01-03 10:26:29', '2015-01-03 10:26:29', ' ', '', '', 'publish', 'open', 'open', '', '12', '', '', '2015-01-03 10:57:15', '2015-01-03 10:57:15', '', 0, 'http://emekong.dev/?p=12', 7, 'nav_menu_item', '', 0),
(13, 1, '2015-01-03 10:26:29', '2015-01-03 10:26:29', ' ', '', '', 'publish', 'open', 'open', '', '13', '', '', '2015-01-03 10:57:15', '2015-01-03 10:57:15', '', 0, 'http://emekong.dev/?p=13', 8, 'nav_menu_item', '', 0),
(14, 1, '2015-01-03 10:26:28', '2015-01-03 10:26:28', ' ', '', '', 'publish', 'open', 'open', '', '14', '', '', '2015-01-03 10:57:14', '2015-01-03 10:57:14', '', 0, 'http://emekong.dev/?p=14', 2, 'nav_menu_item', '', 0),
(15, 1, '2015-01-03 10:34:21', '2015-01-03 10:34:21', ' ', '', '', 'publish', 'open', 'open', '', '15', '', '', '2015-01-03 10:57:14', '2015-01-03 10:57:14', '', 10, 'http://emekong.dev/?p=15', 4, 'nav_menu_item', '', 0),
(16, 1, '2015-01-03 10:57:14', '2015-01-03 10:57:14', ' ', '', '', 'publish', 'open', 'open', '', '16', '', '', '2015-01-03 10:57:14', '2015-01-03 10:57:14', '', 10, 'http://emekong.dev/?p=16', 5, 'nav_menu_item', '', 0),
(17, 1, '2015-01-03 10:57:15', '2015-01-03 10:57:15', ' ', '', '', 'publish', 'open', 'open', '', '17', '', '', '2015-01-03 10:57:15', '2015-01-03 10:57:15', '', 10, 'http://emekong.dev/?p=17', 6, 'nav_menu_item', '', 0),
(18, 1, '2015-01-03 10:57:14', '2015-01-03 10:57:14', ' ', '', '', 'publish', 'open', 'open', '', '18', '', '', '2015-01-03 10:57:14', '2015-01-03 10:57:14', '', 10, 'http://emekong.dev/?p=18', 3, 'nav_menu_item', '', 0),
(19, 1, '2015-01-04 14:31:40', '2015-01-04 14:31:40', 'Giới thiệu', 'Giới thiệu', '', 'publish', 'open', 'open', '', 'gioi-thieu', '', '', '2015-01-04 14:31:40', '2015-01-04 14:31:40', '', 0, 'http://emekong.dev/?page_id=19', 0, 'page', '', 0),
(20, 1, '2015-01-04 14:31:40', '2015-01-04 14:31:40', 'Giới thiệu', 'Giới thiệu', '', 'inherit', 'open', 'open', '', '19-revision-v1', '', '', '2015-01-04 14:31:40', '2015-01-04 14:31:40', '', 19, 'http://emekong.dev/?p=20', 0, 'revision', '', 0),
(21, 1, '2015-01-04 14:32:18', '2015-01-04 14:32:18', ' ', '', '', 'publish', 'open', 'open', '', '21', '', '', '2015-01-04 14:33:01', '2015-01-04 14:33:01', '', 0, 'http://emekong.dev/?p=21', 1, 'nav_menu_item', '', 0),
(22, 1, '2015-01-04 14:32:42', '2015-01-04 14:32:42', '<ul>\r\n	<li><a href="#">Điều khoản thỏa thuận</a></li>\r\n</ul>', 'Điều khoản thỏa thuận', '', 'publish', 'open', 'open', '', 'dieu-khoan-thoa-thuan', '', '', '2015-01-04 14:32:42', '2015-01-04 14:32:42', '', 0, 'http://emekong.dev/?page_id=22', 0, 'page', '', 0),
(23, 1, '2015-01-04 14:32:42', '2015-01-04 14:32:42', '<ul>\r\n	<li><a href="#">Điều khoản thỏa thuận</a></li>\r\n</ul>', 'Điều khoản thỏa thuận', '', 'inherit', 'open', 'open', '', '22-revision-v1', '', '', '2015-01-04 14:32:42', '2015-01-04 14:32:42', '', 22, 'http://emekong.dev/?p=23', 0, 'revision', '', 0),
(24, 1, '2015-01-04 14:33:02', '2015-01-04 14:33:02', ' ', '', '', 'publish', 'open', 'open', '', '24', '', '', '2015-01-04 14:33:02', '2015-01-04 14:33:02', '', 0, 'http://emekong.dev/?p=24', 2, 'nav_menu_item', '', 0),
(25, 1, '2015-01-04 16:01:46', '2015-01-04 16:01:46', 'Dự án giao thông "đẩy" giá BĐS Hà Nội, dân Sài Gòn cho thuê nhà riêng kiếm hàng trăm triệu mỗi năm, hay Mua nhà hay tiếp tục đi thuê khi lãi suất ngân hàng giảm?... là những thông tin thị trường BĐS nổi bật tuần 2 tháng 11.', 'Tin tức bất động sản nổi bật tuần từ 10/11-15/11', '', 'publish', 'open', 'open', '', 'add-new-post', '', '', '2015-01-04 18:39:03', '2015-01-04 18:39:03', '', 0, 'http://emekong.dev/?p=25', 0, 'post', '', 0),
(26, 1, '2015-01-04 16:01:46', '2015-01-04 16:01:46', '<h2>Add New Post</h2>', 'Add New Post', '', 'inherit', 'open', 'open', '', '25-revision-v1', '', '', '2015-01-04 16:01:46', '2015-01-04 16:01:46', '', 25, 'http://emekong.dev/?p=26', 0, 'revision', '', 0),
(27, 1, '2015-01-04 16:40:26', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-01-04 16:40:26', '0000-00-00 00:00:00', '', 0, 'http://emekong.dev/?p=27', 0, 'post', '', 0),
(28, 1, '2015-01-04 16:50:02', '2015-01-04 16:50:02', '', 'article-img', '', 'inherit', 'open', 'open', '', 'article-img', '', '', '2015-01-04 16:50:02', '2015-01-04 16:50:02', '', 25, 'http://emekong.dev/wp-content/uploads/2015/01/article-img.jpg', 0, 'attachment', 'image/jpeg', 0),
(29, 1, '2015-01-04 16:50:04', '2015-01-04 16:50:04', '', 'article-img-2', '', 'inherit', 'open', 'open', '', 'article-img-2', '', '', '2015-01-04 16:50:04', '2015-01-04 16:50:04', '', 25, 'http://emekong.dev/wp-content/uploads/2015/01/article-img-2.jpg', 0, 'attachment', 'image/jpeg', 0),
(30, 1, '2015-01-04 16:50:05', '2015-01-04 16:50:05', '', 'duan1', '', 'inherit', 'open', 'open', '', 'duan1', '', '', '2015-01-04 16:50:05', '2015-01-04 16:50:05', '', 25, 'http://emekong.dev/wp-content/uploads/2015/01/duan1.jpg', 0, 'attachment', 'image/jpeg', 0),
(31, 1, '2015-01-04 16:50:06', '2015-01-04 16:50:06', '', 'duan2', '', 'inherit', 'open', 'open', '', 'duan2', '', '', '2015-01-04 16:50:06', '2015-01-04 16:50:06', '', 25, 'http://emekong.dev/wp-content/uploads/2015/01/duan2.jpg', 0, 'attachment', 'image/jpeg', 0),
(32, 1, '2015-01-04 16:50:07', '2015-01-04 16:50:07', '', 'duan3', '', 'inherit', 'open', 'open', '', 'duan3', '', '', '2015-01-04 16:50:07', '2015-01-04 16:50:07', '', 25, 'http://emekong.dev/wp-content/uploads/2015/01/duan3.jpg', 0, 'attachment', 'image/jpeg', 0),
(33, 1, '2015-01-04 16:50:08', '2015-01-04 16:50:08', '', 'video-demo', '', 'inherit', 'open', 'open', '', 'video-demo', '', '', '2015-01-04 16:50:08', '2015-01-04 16:50:08', '', 25, 'http://emekong.dev/wp-content/uploads/2015/01/video-demo.jpg', 0, 'attachment', 'image/jpeg', 0),
(34, 1, '2015-01-04 16:50:46', '2015-01-04 16:50:46', 'Welcome to WordPress. This is your first post. Edit or delete it, then start blogging!', 'Hello world!', '', 'inherit', 'open', 'open', '', '1-revision-v1', '', '', '2015-01-04 16:50:46', '2015-01-04 16:50:46', '', 1, 'http://emekong.dev/?p=34', 0, 'revision', '', 0),
(35, 1, '2015-01-04 18:38:44', '2015-01-04 18:38:44', 'Dự án giao thông "đẩy" giá BĐS Hà Nội, dân Sài Gòn cho thuê nhà riêng kiếm hàng trăm triệu mỗi năm, hay Mua nhà hay tiếp tục đi thuê khi lãi suất ngân hàng giảm?... là những thông tin thị trường BĐS nổi bật tuần 2 tháng 11.', 'Add New Post', '', 'inherit', 'open', 'open', '', '25-revision-v1', '', '', '2015-01-04 18:38:44', '2015-01-04 18:38:44', '', 25, 'http://emekong.dev/?p=35', 0, 'revision', '', 0),
(36, 1, '2015-01-04 18:39:03', '2015-01-04 18:39:03', 'Dự án giao thông "đẩy" giá BĐS Hà Nội, dân Sài Gòn cho thuê nhà riêng kiếm hàng trăm triệu mỗi năm, hay Mua nhà hay tiếp tục đi thuê khi lãi suất ngân hàng giảm?... là những thông tin thị trường BĐS nổi bật tuần 2 tháng 11.', 'Tin tức bất động sản nổi bật tuần từ 10/11-15/11', '', 'inherit', 'open', 'open', '', '25-revision-v1', '', '', '2015-01-04 18:39:03', '2015-01-04 18:39:03', '', 25, 'http://emekong.dev/?p=36', 0, 'revision', '', 0),
(37, 1, '2015-01-04 18:48:59', '2015-01-04 18:48:59', '<div class="marketing-new">\r\n<div class="marketing-new-content">\r\n<div class="marketing-new-main">\r\n<div class="marketing-new-description">Nhiều tuyến cầu đường mới ở Hà Nội đã và đang được hoàn thành và đưa vào sử dụng trong thời gian gần đây như các dự án cầu Đông Trù, đường 5 kéo dài, cầu Nhật Tân...</div>\r\n</div>\r\n</div>\r\n</div>', 'Giá thuê kiốt mới ở chợ Đồng Xuân bị tiểu thương phản đối', '', 'publish', 'open', 'open', '', 'gia-thue-kiot-moi-o-cho-dong-xuan-bi-tieu-thuong-phan-doi', '', '', '2015-01-04 18:49:13', '2015-01-04 18:49:13', '', 0, 'http://emekong.dev/?p=37', 0, 'post', '', 0),
(38, 1, '2015-01-04 18:48:59', '2015-01-04 18:48:59', '<div class="marketing-new">\r\n<div class="marketing-new-content">\r\n<div class="marketing-new-main">\r\n<div class="marketing-new-description">Nhiều tuyến cầu đường mới ở Hà Nội đã và đang được hoàn thành và đưa vào sử dụng trong thời gian gần đây như các dự án cầu Đông Trù, đường 5 kéo dài, cầu Nhật Tân...</div>\r\n</div>\r\n</div>\r\n</div>', 'Giá thuê kiốt mới ở chợ Đồng Xuân bị tiểu thương phản đối', '', 'inherit', 'open', 'open', '', '37-revision-v1', '', '', '2015-01-04 18:48:59', '2015-01-04 18:48:59', '', 37, 'http://emekong.dev/?p=38', 0, 'revision', '', 0),
(39, 1, '2015-01-05 12:45:33', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-01-05 12:45:33', '0000-00-00 00:00:00', '', 0, 'http://emekong.dev/?p=39', 0, 'post', '', 0),
(40, 1, '2015-01-05 14:23:09', '2015-01-05 14:23:09', '<ul class="box-list">\r\n	<li><a>Quản lý nhà tái định cư:cần lập hợp tác nhà ở</a></li>\r\n</ul>', 'Quản lý nhà tái định cư:cần lập hợp tác nhà ở', '', 'publish', 'open', 'open', '', 'quan-ly-nha-tai-dinh-cucan-lap-hop-tac-nha-o', '', '', '2015-01-05 14:23:24', '2015-01-05 14:23:24', '', 0, 'http://emekong.dev/?p=40', 0, 'post', '', 0),
(41, 1, '2015-01-05 14:23:09', '2015-01-05 14:23:09', '<ul class="box-list">\r\n	<li><a>Quản lý nhà tái định cư:cần lập hợp tác nhà ở</a></li>\r\n</ul>', 'Quản lý nhà tái định cư:cần lập hợp tác nhà ở', '', 'inherit', 'open', 'open', '', '40-revision-v1', '', '', '2015-01-05 14:23:09', '2015-01-05 14:23:09', '', 40, 'http://emekong.dev/?p=41', 0, 'revision', '', 0),
(42, 1, '2015-01-05 14:24:35', '2015-01-05 14:24:35', '<ul class="box-list">\r\n	<li><a href="#">5 lý do nên mua căn hộ Him Lam chợ Lớn</a></li>\r\n</ul>', '5 lý do nên mua căn hộ Him Lam chợ Lớn', '', 'publish', 'open', 'open', '', '5-ly-do-nen-mua-can-ho-him-lam-cho-lon', '', '', '2015-01-05 14:24:35', '2015-01-05 14:24:35', '', 0, 'http://emekong.dev/?p=42', 0, 'post', '', 0),
(43, 1, '2015-01-05 14:24:35', '2015-01-05 14:24:35', '<ul class="box-list">\r\n	<li><a href="#">5 lý do nên mua căn hộ Him Lam chợ Lớn</a></li>\r\n</ul>', '5 lý do nên mua căn hộ Him Lam chợ Lớn', '', 'inherit', 'open', 'open', '', '42-revision-v1', '', '', '2015-01-05 14:24:35', '2015-01-05 14:24:35', '', 42, 'http://emekong.dev/?p=43', 0, 'revision', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_terms`
--

DROP TABLE IF EXISTS `wp_terms`;
CREATE TABLE IF NOT EXISTS `wp_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `wp_terms`
--

INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Uncategorized', 'uncategorized', 0),
(2, 'Featured', 'featured', 0),
(3, 'Reduced', 'reduced', 0),
(4, 'Sold', 'sold', 0),
(5, 'Primary Menu', 'primary-menu', 0),
(6, 'Test', 'test', 0),
(7, 'Range', 'range', 0),
(8, 'Location', 'location', 0),
(9, 'Property', 'property', 0),
(10, 'Tin tức', 'tin-tuc', 0),
(11, 'Dự án đầu tư', 'du-an-dau-tu', 0),
(12, 'Hỗ trợ pháp lý', 'ho-tro-phap-ly', 0),
(13, 'Báo cáo phân tích', 'bao-cao-phan-tich', 0),
(14, 'Tin tức dự án', 'tin-tuc-du-an', 0),
(15, 'Mẫu văn bản', 'mau-van-ban', 0),
(16, 'Chính sách mới', 'chinh-sach-moi', 0),
(17, 'Footer Menu', 'footer-menu', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_relationships`
--

DROP TABLE IF EXISTS `wp_term_relationships`;
CREATE TABLE IF NOT EXISTS `wp_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_term_relationships`
--

INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 10, 0),
(1, 13, 0),
(4, 5, 0),
(5, 5, 0),
(7, 3, 0),
(7, 6, 0),
(7, 7, 0),
(7, 8, 0),
(12, 5, 0),
(13, 5, 0),
(14, 5, 0),
(15, 5, 0),
(16, 5, 0),
(17, 5, 0),
(18, 5, 0),
(21, 17, 0),
(24, 17, 0),
(25, 13, 0),
(37, 13, 0),
(40, 13, 0),
(42, 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_taxonomy`
--

DROP TABLE IF EXISTS `wp_term_taxonomy`;
CREATE TABLE IF NOT EXISTS `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `wp_term_taxonomy`
--

INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 0),
(2, 2, 'type', '', 0, 0),
(3, 3, 'type', '', 0, 1),
(4, 4, 'type', '', 0, 0),
(5, 5, 'nav_menu', '', 0, 9),
(6, 6, 'area', '', 0, 1),
(7, 7, 'range', '', 0, 1),
(8, 8, 'location', '', 0, 1),
(9, 9, 'property', '', 0, 0),
(10, 10, 'category', '', 0, 1),
(11, 11, 'category', '', 0, 0),
(12, 12, 'category', '', 0, 0),
(13, 13, 'category', '', 10, 5),
(14, 14, 'category', '', 10, 0),
(15, 15, 'category', '', 10, 0),
(16, 16, 'category', '', 10, 0),
(17, 17, 'nav_menu', '', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `wp_usermeta`
--

DROP TABLE IF EXISTS `wp_usermeta`;
CREATE TABLE IF NOT EXISTS `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `wp_usermeta`
--

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'admin'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'comment_shortcuts', 'false'),
(7, 1, 'admin_color', 'fresh'),
(8, 1, 'use_ssl', '0'),
(9, 1, 'show_admin_bar_front', 'true'),
(10, 1, 'wp_capabilities', 'a:1:{s:13:"administrator";b:1;}'),
(11, 1, 'wp_user_level', '10'),
(12, 1, 'dismissed_wp_pointers', 'wp350_media,wp360_revisions,wp360_locks,wp390_widgets'),
(13, 1, 'show_welcome_panel', '1'),
(14, 1, 'session_tokens', 'a:1:{s:64:"7a329b7c16b377ccc6c0a9a446ba9045e1c6238668ed756a733c338f01b19e0e";i:1420634726;}'),
(15, 1, 'wp_dashboard_quick_press_last_post_id', '3'),
(16, 1, 'managenav-menuscolumnshidden', 'a:4:{i:0;s:11:"link-target";i:1;s:11:"css-classes";i:2;s:3:"xfn";i:3;s:11:"description";}'),
(17, 1, 'metaboxhidden_nav-menus', 'a:9:{i:0;s:8:"add-post";i:1;s:12:"add-listings";i:2;s:12:"add-post_tag";i:3;s:8:"add-area";i:4;s:9:"add-range";i:5;s:12:"add-location";i:6;s:12:"add-property";i:7;s:8:"add-type";i:8;s:12:"add-bedrooms";}'),
(18, 1, 'meta-box-order_listings', 'a:3:{s:4:"side";s:83:"submitdiv,areadiv,rangediv,locationdiv,propertydiv,typediv,bedroomsdiv,postimagediv";s:6:"normal";s:36:"propertybox,commentstatusdiv,slugdiv";s:8:"advanced";s:0:"";}'),
(19, 1, 'screen_layout_listings', '2'),
(20, 1, 'nav_menu_recently_edited', '17'),
(21, 1, 'manageedit-propertycolumnshidden', 'a:13:{i:0;s:4:"type";i:1;s:5:"price";i:2;s:8:"bedrooms";i:3;s:9:"bathrooms";i:4;s:7:"deposit";i:5;s:4:"area";i:6;s:12:"phone_number";i:7;s:14:"purchase_price";i:8;s:8:"for_sale";i:9;s:8:"for_rent";i:10;s:4:"city";i:11;s:8:"featured";i:12;s:10:"menu_order";}'),
(22, 1, 'closedpostboxes_property', 'a:1:{i:0;s:17:"wpp_property_meta";}'),
(23, 1, 'metaboxhidden_property', 'a:1:{i:0;s:7:"slugdiv";}'),
(24, 1, 'wp_user-settings', 'libraryContent=browse&hidetb=1'),
(25, 1, 'wp_user-settings-time', '1420396721');

-- --------------------------------------------------------

--
-- Table structure for table `wp_users`
--

DROP TABLE IF EXISTS `wp_users`;
CREATE TABLE IF NOT EXISTS `wp_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wp_users`
--

INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'admin', '$P$BAKNt5A7XEeJGgHFWT0MWoqkW5Zw.R1', 'admin', 'dao.hunter@gmail.com', '', '2015-01-03 07:43:01', '', 0, 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
