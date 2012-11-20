-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-11-2012 a las 21:03:52
-- Versión del servidor: 5.5.9
-- Versión de PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `quadmin`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configadminvalues`
--

CREATE TABLE IF NOT EXISTS `configadminvalues` (
  `configvalues_id` varchar(255) NOT NULL,
  `configvalues` text NOT NULL,
  PRIMARY KEY (`configvalues_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configadminvalues`
--

INSERT INTO `configadminvalues` (`configvalues_id`, `configvalues`) VALUES
('site', 'C:11:"ArrayObject":230:{x:i:0;a:5:{s:15:"QuWebDemo_email";s:14:"cel@cenics.net";s:14:"QuWebDemo_name";s:6:"Cenics";s:17:"QuWebDemo_address";s:4:"test";s:18:"QuWebDemo_username";s:15:"admin@admin.com";s:18:"QuWebDemo_password";s:10:"adminadmin";};m:a:0:{}}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `QuAdmin`
--

CREATE TABLE IF NOT EXISTS `QuAdmin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `id_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `id_lang` bigint(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'page',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `order` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'publish',
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8_unicode_ci,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci,
  `documents` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `notes` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `type_status_date` (`type`,`status`,`date`,`id`),
  KEY `id_parent` (`id_parent`),
  KEY `author` (`id_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=113 ;

--
-- Volcado de datos para la tabla `QuAdmin`
--

INSERT INTO `QuAdmin` (`id`, `id_parent`, `id_author`, `id_lang`, `type`, `name`, `order`, `date`, `modified`, `status`, `lang`, `parameters`, `title`, `summary`, `documents`, `content`, `notes`) VALUES
(1, 0, 1, 1, 'languages', 'en', 1, '2012-11-19 19:15:17', '2012-11-19 19:15:17', NULL, '', NULL, 'English', '', '', '', ''),
(2, 0, 1, 2, 'languages', 'es', 2, '2012-11-19 19:15:27', '2012-11-19 19:15:27', NULL, '', NULL, 'Español', '', '', '', ''),
(7, 0, 1, 7, 'parameters', 'main-menu', 22, '2012-11-19 19:52:31', '2012-11-20 17:04:52', NULL, '', NULL, 'Main menu', '', NULL, '', ''),
(8, 0, 1, 8, 'parameters', '-', 23, '2012-11-19 19:53:28', '2012-11-19 19:53:28', NULL, '', NULL, '-', '', '', '', ''),
(9, 0, 1, 9, 'parameters', 'social-media', 21, '2012-11-19 21:09:13', '2012-11-19 21:09:13', NULL, '', NULL, 'Social media', '', '', '', ''),
(10, 0, 1, 10, 'parameters', 'loop-carousel', 16, '2012-11-19 21:10:32', '2012-11-20 17:03:36', NULL, '', NULL, 'Loop carousel', '', NULL, '', ''),
(11, 0, 1, 11, 'testdemo', 'home', 17, '2012-11-19 21:12:28', '2012-11-19 22:41:28', 'Public', 'es', 'main-menu', 'Inicio', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.', '', '', NULL),
(12, 0, 1, 12, 'testdemo', 'empresa', 16, '2012-11-19 21:12:52', '2012-11-20 18:58:58', 'Public', 'es', 'main-menu', 'Empresa', 'Lorem ipsum dolor sit amet', '', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>\r\n', NULL),
(13, 0, 1, 13, 'testdemo', 'contacto', 14, '2012-11-19 21:14:18', '2012-11-20 19:57:51', 'Public', 'es', 'main-menu', 'Contacto', 'Lorem ipsum dolor sit amet', '', '', NULL),
(14, 0, 1, 14, 'testdemo', 'productos', 15, '2012-11-19 21:14:39', '2012-11-20 17:08:40', 'Public', 'es', 'main-menu', 'Productos', 'Lorem ipsum dolor sit amet', '', '', NULL),
(15, 0, 1, 15, 'testdemo', 'social-media', 13, '2012-11-19 21:15:47', '2012-11-19 21:15:47', 'Public', 'es', 'social-media', 'Social media', '', '', '', ''),
(16, 0, 1, 16, 'parameters', 'footer', 20, '2012-11-19 21:16:36', '2012-11-19 21:16:36', NULL, '', NULL, 'Footer', '', '', '', ''),
(17, 0, 1, 17, 'testdemo', 'privacy-policy', 12, '2012-11-19 21:17:02', '2012-11-19 22:42:16', 'Public', 'es', 'footer', 'Politica de privacidad', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam.', '', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.</p>\r\n<p>\r\n	molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices,</p>\r\n<p>\r\n	ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', NULL),
(18, 0, 1, 11, 'testdemo', 'home', 17, '2012-11-19 22:01:30', '2012-11-19 22:01:30', 'Public', 'en', 'main-menu', 'Home', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.', '', '', NULL),
(19, 0, 1, 12, 'testdemo', 'company', 16, '2012-11-19 22:01:49', '2012-11-19 22:01:49', 'Public', 'en', 'main-menu', 'Company', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.', '', '', NULL),
(20, 0, 1, 14, 'testdemo', 'products', 15, '2012-11-19 22:06:11', '2012-11-19 22:06:11', 'Public', 'en', 'main-menu', 'Products', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', '', '', NULL),
(21, 0, 1, 13, 'testdemo', 'contacta', 14, '2012-11-19 22:36:40', '2012-11-19 22:42:41', 'Public', 'en', 'main-menu', 'Contact', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', '', '', NULL),
(22, 0, 1, 15, 'testdemo', 'social-media', 13, '2012-11-19 22:36:55', '2012-11-19 22:36:55', 'Public', 'en', 'social-media', 'Social media', '', '', '', NULL),
(23, 0, 1, 17, 'testdemo', 'privacy-policy', 12, '2012-11-19 22:37:12', '2012-11-19 22:37:12', 'Public', 'en', 'footer', 'Privacy policy', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam.', '', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.</p>\r\n<p>\r\n	molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices,</p>\r\n<p>\r\n	ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', NULL),
(24, 0, 1, 24, 'parameters', 'loop-grid-4', 17, '2012-11-19 23:02:57', '2012-11-20 17:03:57', NULL, '', NULL, 'Loop grid 4', '', NULL, '', ''),
(25, 11, 1, 25, 'testdemo', 'carousel', 2, '2012-11-19 23:04:37', '2012-11-20 13:42:48', 'Public', 'es', 'loop-carousel', 'Carousel', '', '', '', NULL),
(26, 11, 1, 26, 'testdemo', 'example-page', 1, '2012-11-19 23:04:51', '2012-11-20 13:42:58', 'Public', 'es', 'loop-grid-4', 'Example page', 'Subtext for header', '', '', NULL),
(28, 25, 1, 28, 'testdemo', 'second-thumbnail-label', 3, '2012-11-19 23:07:07', '2012-11-20 00:03:25', 'Public', 'es', '-', 'My dog', 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.', '1-28-second-thumbnail-label.jpg', '', NULL),
(29, 25, 1, 29, 'testdemo', 'second-thumbnail-label', 1, '2012-11-19 23:07:07', '2012-11-20 00:03:13', 'Public', 'es', '-', 'My dog', 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.', '1-29-second-thumbnail-label.jpg', '', NULL),
(30, 25, 1, 30, 'testdemo', 'second-thumbnail-label', 4, '2012-11-19 23:07:07', '2012-11-20 00:03:31', 'Public', 'es', '-', 'My dog', 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.', '1-30-second-thumbnail-label.jpg', '', NULL),
(31, 26, 1, 31, 'testdemo', 'lorem-ipsum-dolor-sit-amet', 1, '2012-11-19 23:13:50', '2012-11-20 20:51:59', 'Public', 'es', '-', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. ', '1-31-lorem-ipsum-dolor-sit-amet.jpg', '<p>\r\n	<a class="btn btn-warning" href="/web-demo/es/contacto">Contact</a></p>\r\n', NULL),
(32, 26, 1, 32, 'testdemo', 'lorem-ipsum-dolor-sit-amet', 2, '2012-11-19 23:13:50', '2012-11-20 20:51:48', 'Public', 'es', '-', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. ', '1-32-lorem-ipsum-dolor-sit-amet.jpg', '<p>\r\n	<a class="btn btn-info" href="/web-demo/es/contacto">Contact</a></p>\r\n', NULL),
(33, 26, 1, 33, 'testdemo', 'lorem-ipsum-dolor-sit-amet', 3, '2012-11-19 23:13:50', '2012-11-20 20:52:25', 'Public', 'es', '-', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.', '1-33-lorem-ipsum-dolor-sit-amet.jpg', '<p>\r\n	<a class="btn btn-primary" href="/web-demo/es/contacto">Contact</a></p>\r\n', NULL),
(34, 26, 1, 34, 'testdemo', 'lorem-ipsum-dolor-sit-amet', 2, '2012-11-19 23:13:50', '2012-11-20 20:50:56', 'Public', 'es', '-', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. ', '1-34-lorem-ipsum-dolor-sit-amet.jpg', '<p>\r\n	<a class="btn btn-success" href="/web-demo/es/contacto">Contact</a></p>\r\n', NULL),
(35, 25, 1, 35, 'testdemo', 'my-dog', 2, '2012-11-20 00:01:57', '2012-11-20 00:02:57', 'Public', 'es', '-', 'My dog', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit.', '1-35-may-dog.jpg', '', NULL),
(38, 12, 1, 38, 'testdemo', 'test-demo-collapse', 2, '2012-11-20 00:52:27', '2012-11-20 14:12:16', 'Public', 'es', 'loop-collapse', 'Test demo collapse', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.', '', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.</p>\r\n', NULL),
(39, 0, 1, 39, 'parameters', 'loop-grid-3', 18, '2012-11-20 10:58:34', '2012-11-20 17:03:44', NULL, '', NULL, 'Loop grid 3', '', NULL, '', ''),
(41, 38, 1, 41, 'testdemo', 'test-demo3', 2, '2012-11-20 12:56:09', '2012-11-20 14:10:45', 'Public', 'es', '-', 'Test demo', 'Test demo', '1-41-test-demo.jpg', '', NULL),
(42, 38, 1, 42, 'testdemo', 'test-demo2', 3, '2012-11-20 12:56:18', '2012-11-20 14:10:40', 'Public', 'es', '-', 'Test demo', 'Test demo', '1-42-test-demo.jpg', '', NULL),
(43, 38, 1, 43, 'testdemo', 'test-demo1', 4, '2012-11-20 12:56:28', '2012-11-20 14:10:30', 'Public', 'es', '-', 'Test demo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '1-43-test-demo.jpg', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim.</p>\r\n', NULL),
(44, 0, 1, 44, 'parameters', 'loop-collapse', 14, '2012-11-20 13:33:24', '2012-11-20 17:03:15', NULL, '', NULL, 'Loop collapse', '', NULL, '', ''),
(45, 0, 1, 45, 'parameters', 'loop-tabs', 15, '2012-11-20 13:33:50', '2012-11-20 17:03:28', NULL, '', NULL, 'Loop tabs', '', NULL, '', ''),
(46, 12, 1, 46, 'testdemo', 'test-demo-grid', 4, '2012-11-20 00:52:27', '2012-11-20 14:38:37', 'Public', 'es', 'loop-grid-3', 'Test demo grid', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.', '', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.</p>\r\n', NULL),
(47, 46, 1, 47, 'testdemo', 'test-demo3', 2, '2012-11-20 12:56:09', '2012-11-20 14:12:50', 'Public', 'es', '-', 'Test demo (duplicate)', 'Test demo', '1-47-test-demo.jpg', '', NULL),
(48, 46, 1, 48, 'testdemo', 'test-demo2', 3, '2012-11-20 12:56:18', '2012-11-20 14:12:43', 'Public', 'es', '-', 'Test demo (duplicate)', 'Test demo', '1-48-test-demo.jpg', '', NULL),
(49, 46, 1, 49, 'testdemo', 'test-demo1', 4, '2012-11-20 12:56:28', '2012-11-20 14:12:38', 'Public', 'es', '-', 'Test demo (duplicate)', 'Test demo', '1-49-test-demo.jpg', '', NULL),
(50, 12, 1, 50, 'testdemo', 'test-demo-taps', 3, '2012-11-20 00:52:27', '2012-11-20 20:23:36', 'Public', 'es', 'loop-tabs', 'Test demo taps', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '', '', NULL),
(51, 50, 1, 51, 'testdemo', 'test-demo-3', 2, '2012-11-20 12:56:09', '2012-11-20 14:14:36', 'Public', 'es', '-', 'Test demo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.', '1-51-test-demo.jpg', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.</p>\r\n', NULL),
(52, 50, 1, 52, 'testdemo', 'test-demo-2', 3, '2012-11-20 12:56:18', '2012-11-20 14:14:05', 'Public', 'es', '-', 'Test demo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.', '1-52-test-demo.jpg', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.</p>\r\n', NULL),
(53, 50, 1, 53, 'testdemo', 'test-demo-1', 4, '2012-11-20 12:56:28', '2012-11-20 14:13:47', 'Public', 'es', '-', 'Test demo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.', '1-53-test-demo.jpg', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.</p>\r\n', NULL),
(54, 46, 1, 54, 'testdemo', 'test-demo1', 5, '2012-11-20 12:56:28', '2012-11-20 16:49:21', 'Public', 'es', '-', 'Test demo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. ', '1-54-test-demo.jpg', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.</p>\r\n<p>\r\n	Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor.</p>\r\n<p>\r\n	Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum.</p>\r\n<p>\r\n	Nunc imperdiet gravida mauris.</p>\r\n', NULL),
(55, 46, 1, 55, 'testdemo', 'test-demo2', 4, '2012-11-20 12:56:18', '2012-11-20 14:12:43', 'Public', 'es', '-', 'Test demo (duplicate) (duplicate)', 'Test demo', '1-55-test-demo.jpg', '', NULL),
(56, 46, 1, 56, 'testdemo', 'test-demo3', 3, '2012-11-20 12:56:09', '2012-11-20 14:12:50', 'Public', 'es', '-', 'Test demo (duplicate) (duplicate)', 'Test demo', '1-56-test-demo.jpg', '', NULL),
(57, 46, 1, 57, 'testdemo', 'test-demo1', 6, '2012-11-20 12:56:28', '2012-11-20 16:38:46', 'Public', 'es', '-', 'Test demo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.', '1-57-test-demo.jpg', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.</p>\r\n<p>\r\n	Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim.</p>\r\n<p>\r\n	Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci.</p>\r\n<p>\r\n	Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis.</p>\r\n<p>\r\n	Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', NULL),
(58, 46, 1, 58, 'testdemo', 'test-demo1', 5, '2012-11-20 12:56:28', '2012-11-20 16:50:00', 'Public', 'es', '-', 'Test demo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. ', '1-58-test-demo.jpg', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam.</p>\r\n<p>\r\n	Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci.</p>\r\n<p>\r\n	Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim.</p>\r\n<p>\r\n	Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', NULL),
(59, 46, 1, 59, 'testdemo', 'test-demo2', 5, '2012-11-20 12:56:18', '2012-11-20 14:12:43', 'Public', 'es', '-', 'Test demo (duplicate) (duplicate) (duplicate)', 'Test demo', '1-59-test-demo.jpg', '', NULL),
(60, 46, 1, 60, 'testdemo', 'test-demo2', 4, '2012-11-20 12:56:18', '2012-11-20 14:12:43', 'Public', 'es', '-', 'Test demo (duplicate) (duplicate)', 'Test demo', '1-60-test-demo.jpg', '', NULL),
(61, 46, 1, 61, 'testdemo', 'test-demo3', 4, '2012-11-20 12:56:09', '2012-11-20 14:12:50', 'Public', 'es', '-', 'Test demo (duplicate) (duplicate) (duplicate)', 'Test demo', '1-61-test-demo.jpg', '', NULL),
(62, 46, 1, 62, 'testdemo', 'test-demo3', 3, '2012-11-20 12:56:09', '2012-11-20 14:12:50', 'Public', 'es', '-', 'Test demo (duplicate) (duplicate)', 'Test demo', '1-62-test-demo.jpg', '', NULL),
(63, 12, 1, 63, 'testdemo', 'test-demo-simple-page', 5, '2012-11-20 16:07:09', '2012-11-20 16:37:46', 'Public', 'es', '-', 'Test demo single page', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit.', '', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.</p>\r\n<p>\r\n	Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula.</p>\r\n<p>\r\n	Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis.</p>\r\n<p>\r\n	Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', NULL),
(64, 12, 1, 64, 'testdemo', 'test-demo-carousel', 6, '2012-11-20 16:53:05', '2012-11-20 16:54:25', 'Public', 'es', 'loop-carousel', 'Test demo carousel', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.', '', '', NULL),
(65, 64, 1, 65, 'testdemo', 'test-demo', 1, '2012-11-20 16:54:53', '2012-11-20 16:54:53', 'Public', 'es', '-', 'Test demo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. ', '1-65-test-demo.jpg', '', ''),
(66, 64, 1, 66, 'testdemo', 'test-demo', 2, '2012-11-20 16:55:11', '2012-11-20 16:55:11', 'Public', 'es', '-', 'Test demo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. ', '1-66-test-demo.jpg', '', ''),
(67, 64, 1, 67, 'testdemo', 'test-demo', 3, '2012-11-20 16:55:26', '2012-11-20 16:55:26', 'Public', 'es', '-', 'Test demo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. ', '1-67-test-demo.jpg', '', ''),
(69, 14, 1, 69, 'testdemo', 'test-demo-grid-and-collapse', 2, '2012-11-20 17:06:22', '2012-11-20 18:25:22', 'Public', 'es', '-', 'Test demo grid and collapse', 'Lorem ipsum dolor sit amet', '', '', NULL),
(70, 69, 1, 70, 'testdemo', 'especial-grid', 1, '2012-11-20 17:07:16', '2012-11-20 18:29:36', 'Public', 'es', 'loop-grid-3', 'Especial Grid', 'Lorem ipsum dolor sit amet', '', '', NULL),
(71, 70, 1, 71, 'testdemo', 'test', 1, '2012-11-20 17:07:51', '2012-11-20 17:07:51', 'Public', 'es', '-', 'Test', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '1-71-test.jpg', '', ''),
(72, 14, 1, 72, 'testdemo', 'test-convien', 1, '2012-11-20 17:08:50', '2012-11-20 18:31:04', 'Public', 'es', '-', 'Test combined', 'Lorem ipsum dolor sit amet', '', '', NULL),
(73, 69, 1, 73, 'testdemo', 'test-collapse', 2, '2012-11-20 17:10:10', '2012-11-20 20:26:02', 'Public', 'es', 'loop-collapse', '-', '', '', '', NULL),
(74, 73, 1, 74, 'testdemo', 'collapse-test', 1, '2012-11-20 17:11:28', '2012-11-20 17:11:28', 'Public', 'es', '-', 'Collapse test', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '1-74-collapse-test.jpg', '', ''),
(75, 73, 1, 75, 'testdemo', 'test', 2, '2012-11-20 17:11:58', '2012-11-20 17:11:58', 'Public', 'es', '-', 'Test', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '1-75-test.jpg', '', ''),
(76, 70, 1, 76, 'testdemo', 'test-demo', 2, '2012-11-20 17:12:52', '2012-11-20 17:12:52', 'Public', 'es', '-', 'Test demo', '', '1-76-test-demo.jpg', '', ''),
(77, 70, 1, 77, 'testdemo', 'test-demo', 3, '2012-11-20 17:12:52', '2012-11-20 17:12:52', 'Public', 'es', '-', 'Test demo (duplicate)', '', '1-77-test-demo.jpg', '', ''),
(78, 70, 1, 78, 'testdemo', 'test', 2, '2012-11-20 17:07:51', '2012-11-20 17:14:53', 'Public', 'es', '-', 'Test (duplicate)', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '1-78-test.jpg', '', NULL),
(79, 70, 1, 79, 'testdemo', 'test-demo', 4, '2012-11-20 17:12:52', '2012-11-20 17:12:52', 'Public', 'es', '-', 'Test demo (duplicate) (duplicate)', '', '1-79-test-demo.jpg', '', ''),
(80, 70, 1, 80, 'testdemo', 'test', 3, '2012-11-20 17:07:51', '2012-11-20 17:07:51', 'Public', 'es', '-', 'Test (duplicate) (duplicate)', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '1-80-test.jpg', '', ''),
(81, 73, 1, 81, 'testdemo', 'test', 3, '2012-11-20 17:11:58', '2012-11-20 17:11:58', 'Public', 'es', '-', 'Test (duplicate)', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '1-81-test.jpg', '', ''),
(82, 73, 1, 82, 'testdemo', 'collapse-test', 2, '2012-11-20 17:11:28', '2012-11-20 17:11:28', 'Public', 'es', '-', 'Collapse test (duplicate)', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '1-82-collapse-test.jpg', '', ''),
(83, 14, 1, 83, 'testdemo', 'simple-page', 3, '2012-11-20 17:16:49', '2012-11-20 20:30:37', 'Public', 'es', '-', 'Multi page', '', '', '', NULL),
(84, 83, 1, 84, 'testdemo', 'simple-page', 3, '2012-11-20 17:18:40', '2012-11-20 19:48:58', 'Public', 'es', '-', 'Simple page', '', '', '', NULL),
(85, 83, 1, 85, 'testdemo', 'collapse-test', 4, '2012-11-20 17:19:08', '2012-11-20 20:30:06', 'Public', 'es', 'loop-carousel', '-', '', '', '', NULL),
(86, 85, 1, 86, 'testdemo', 'test', 1, '2012-11-20 17:31:20', '2012-11-20 17:31:20', 'Public', 'es', '-', 'Test', '', '1-86-test.jpg', '', ''),
(87, 85, 1, 87, 'testdemo', 'test', 2, '2012-11-20 17:31:20', '2012-11-20 17:31:20', 'Public', 'es', '-', 'Test (duplicate)', '', '1-87-test.jpg', '', ''),
(89, 84, 1, 89, 'testdemo', 'page-simple', 2, '2012-11-20 17:32:26', '2012-11-20 17:32:26', 'Public', 'es', '-', 'Page simple', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. ', '', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus.</p>\r\n<p>\r\n	Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.</p>\r\n', ''),
(90, 83, 1, 90, 'testdemo', 'grid', 1, '2012-11-20 17:39:31', '2012-11-20 19:48:31', 'Public', 'es', 'loop-grid-3', 'Grid', '', '', '', NULL),
(91, 90, 1, 91, 'testdemo', 'test', 1, '2012-11-20 18:27:25', '2012-11-20 18:27:25', 'Public', 'es', '-', 'Test', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '1-91-test.jpg', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>\r\n<p>\r\n	Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula.</p>\r\n<p>\r\n	Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim.</p>\r\n<p>\r\n	Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', ''),
(92, 90, 1, 92, 'testdemo', 'test', 2, '2012-11-20 18:27:25', '2012-11-20 18:27:25', 'Public', 'es', '-', 'Test (duplicate)', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '1-92-test.jpg', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>\r\n<p>\r\n	Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula.</p>\r\n<p>\r\n	Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim.</p>\r\n<p>\r\n	Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', ''),
(93, 90, 1, 93, 'testdemo', 'test', 2, '2012-11-20 18:27:25', '2012-11-20 18:27:25', 'Public', 'es', '-', 'Test (duplicate)', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '1-93-test.jpg', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>\r\n<p>\r\n	Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula.</p>\r\n<p>\r\n	Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim.</p>\r\n<p>\r\n	Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', ''),
(94, 0, 1, 94, 'parameters', 'loop-grid-2', 19, '2012-11-20 18:30:03', '2012-11-20 18:30:03', NULL, '', NULL, 'Loop grid 2', '', '', '', ''),
(95, 72, 1, 95, 'testdemo', 'loop-grid-2', 2, '2012-11-20 18:31:30', '2012-11-20 20:26:25', 'Public', 'es', 'loop-grid-2', '-', '', '', '', NULL),
(96, 95, 1, 96, 'testdemo', 'looooop', 0, '2012-11-20 18:32:04', '2012-11-20 20:28:29', 'Public', 'es', '-', 'Test demo', '', '1-96-looooop.jpg', '', NULL),
(97, 95, 1, 97, 'testdemo', 'looooop', 2, '2012-11-20 18:32:19', '2012-11-20 20:27:33', 'Public', 'es', '-', 'Test demo', '', '1-97-looooop.jpg', '', NULL),
(98, 95, 1, 98, 'testdemo', 'looooop', 3, '2012-11-20 18:32:19', '2012-11-20 20:28:50', 'Public', 'es', '-', 'Test demo', '', '1-98-looooop.jpg', '', NULL),
(99, 95, 1, 99, 'testdemo', 'looooop', 1, '2012-11-20 18:32:04', '2012-11-20 20:27:38', 'Public', 'es', '-', 'Test demo', '', '1-99-looooop.jpg', '', NULL),
(100, 72, 1, 100, 'testdemo', 'loop-grid-3', 1, '2012-11-20 18:33:51', '2012-11-20 18:33:51', 'Public', 'es', 'loop-grid-3', 'Loop grid 3', 'Lorem ipsum dolor sit amet', '', '', ''),
(101, 100, 1, 101, 'testdemo', 'loooopppgridd', 1, '2012-11-20 18:36:26', '2012-11-20 20:27:07', 'Public', 'es', '-', 'Test demo', '', '1-101-loooopppgridd.jpg', '', NULL),
(102, 100, 1, 102, 'testdemo', 'loooopppgridd', 3, '2012-11-20 18:36:26', '2012-11-20 20:26:50', 'Public', 'es', '-', 'Test demo', '', '1-102-loooopppgridd.jpg', '', NULL),
(103, 100, 1, 103, 'testdemo', 'loooopppgridd', 2, '2012-11-20 18:36:51', '2012-11-20 20:27:02', 'Public', 'es', '-', 'Test demo', '', '1-103-loooopppgridd.jpg', '', NULL),
(104, 83, 1, 104, 'testdemo', 'tabs', 2, '2012-11-20 19:49:25', '2012-11-20 20:21:20', 'Public', 'es', 'loop-collapse', '-', '', '', '', NULL),
(105, 13, 1, 105, 'testdemo', 'from-contact', 2, '2012-11-20 19:58:15', '2012-11-20 19:58:37', 'Public', 'es', '-', 'Form contact', '', '', '<p>\r\n	{from-contact}</p>\r\n', NULL),
(106, 104, 1, 106, 'testdemo', 'lorem-3', 1, '2012-11-20 20:13:56', '2012-11-20 20:18:06', 'Public', 'es', '-', 'Lorem ipsum dolor sit amet', '', '1-106-lorem-ipsum-dolor-sit-amet.jpg', '', NULL),
(107, 104, 1, 107, 'testdemo', 'lorem-2', 2, '2012-11-20 20:14:23', '2012-11-20 20:17:59', 'Public', 'es', '-', 'Lorem ipsum dolor sit amet', '', '1-107-lorem-ipsum-dolor-sit-amet.jpg', '', NULL),
(108, 104, 1, 108, 'testdemo', 'lorem-1', 3, '2012-11-20 20:14:31', '2012-11-20 20:17:46', 'Public', 'es', '-', 'Lorem ipsum dolor sit amet', '', '1-108-lorem-ipsum-dolor-sit-amet.jpg', '', NULL),
(109, 13, 1, 109, 'testdemo', 'contact', 1, '2012-11-20 20:31:40', '2012-11-20 20:43:20', 'Public', 'es', '-', 'Map location', '', '', '<p>\r\n	<iframe frameborder="0" height="350" marginheight="0" marginwidth="0" scrolling="no" src="https://maps.google.es/maps/ms?msa=0&amp;msid=209359617805559089945.00046bee9c36b4e9deb11&amp;hl=ca&amp;ie=UTF8&amp;t=p&amp;ll=41.787805,0.808101&amp;spn=0.011199,0.018239&amp;z=15&amp;output=embed" width="425"></iframe><br />\r\n	<small>Mostra <a href="https://maps.google.es/maps/ms?msa=0&amp;msid=209359617805559089945.00046bee9c36b4e9deb11&amp;hl=ca&amp;ie=UTF8&amp;t=p&amp;ll=41.787805,0.808101&amp;spn=0.011199,0.018239&amp;z=15&amp;source=embed">cenics</a> en un mapa m&eacute;s gran</small></p>\r\n', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `display_name` varchar(50) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `display_name`, `password`) VALUES
(1, 'admin', 'admin@admin.com', 'admin', '$2a$14$lw9/0Ixz4vqe6yr8dKJWVeIKnPTPL7CSavSJfuqvLuS6tDQ/xPU86');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` varchar(255) NOT NULL,
  `default` tinyint(1) NOT NULL,
  `parent` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_role`
--

INSERT INTO `user_role` (`role_id`, `default`, `parent`) VALUES
('admin', 1, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_role_linker`
--

CREATE TABLE IF NOT EXISTS `user_role_linker` (
  `user_id` int(11) unsigned NOT NULL,
  `role_id` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_role_linker`
--

INSERT INTO `user_role_linker` (`user_id`, `role_id`) VALUES
(1, 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
