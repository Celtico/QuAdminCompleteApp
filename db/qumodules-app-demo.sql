--
-- Base de dades: `qumodules-app-demo`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `qu-other-demo`
--

CREATE TABLE IF NOT EXISTS `qu-other-demo` (
`id_other_demo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`id_author` bigint(20) unsigned NOT NULL DEFAULT '0',
`name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
`title` text COLLATE utf8_unicode_ci NOT NULL,
`languages` text COLLATE utf8_unicode_ci NOT NULL,
`id_parameters` text COLLATE utf8_unicode_ci NOT NULL,
`order` int(11) NOT NULL DEFAULT '0',
`status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'publish',
PRIMARY KEY (`id_other_demo`),
KEY `name` (`name`),
KEY `name_status_date` (`name`,`status`,`id_other_demo`),
KEY `author` (`id_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `configadminvalues`
--

CREATE TABLE IF NOT EXISTS `configadminvalues` (
  `configvalues_id` varchar(255) NOT NULL,
  `configvalues` text NOT NULL,
  PRIMARY KEY (`configvalues_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Bolcant dades de la taula `configadminvalues`
--

INSERT INTO `configadminvalues` (`configvalues_id`, `configvalues`) VALUES
('site', 'C:11:"ArrayObject":271:{x:i:0;a:6:{s:15:"QuWebDemo_email";s:14:"cel@cenics.net";s:14:"QuWebDemo_name";s:6:"CENICS";s:17:"QuWebDemo_address";s:14:"cel@cenics.net";s:14:"QuWebDemo_link";s:10:"cenics.net";s:18:"QuWebDemo_username";s:8:"Cel Tico";s:18:"QuWebDemo_password";s:9:"celcelcel";};m:a:0:{}}');

-- --------------------------------------------------------

--
-- Estructura de la taula `qu-languages`
--

CREATE TABLE IF NOT EXISTS `qu-languages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'publish',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `name_status_date` (`name`,`status`,`id`),
  KEY `author` (`id_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Bolcant dades de la taula `qu-languages`
--

INSERT INTO `qu-languages` (`id`, `id_author`, `name`, `title`, `order`, `status`) VALUES
(5, 1, 'es', 'Es', -11, 'Public'),
(6, 1, 'en', 'En', -9, 'Public'),
(7, 1, 'fr', 'Fr', -10, 'Public');

-- --------------------------------------------------------

--
-- Estructura de la taula `qu-parameters`
--

CREATE TABLE IF NOT EXISTS `qu-parameters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'publish',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `name_status_date` (`name`,`status`,`id`),
  KEY `author` (`id_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Bolcant dades de la taula `qu-parameters`
--

INSERT INTO `qu-parameters` (`id`, `id_author`, `name`, `title`, `order`, `status`) VALUES
(6, 1, 'loop-carousel', 'loop-carousel', -9, 'Public'),
(7, 1, 'grid', 'grid', -8, 'Public'),
(8, 1, 'loop-tabs', 'loop-tabs', -5, 'Public'),
(9, 1, 'loop-collapse', 'loop-collapse', 0, 'Public'),
(10, 1, 'loop-page', 'loop-page', -4, 'Public'),
(11, 1, '-', '-', 2, 'Public'),
(12, 1, 'main-menu', 'main-menu', -6, 'Public'),
(13, 1, 'social-media', 'social-media', -7, 'Public'),
(14, 1, 'footer', 'footer', 1, 'Public'),
(15, 1, 'loop-grid-4', 'loop-grid-4', -3, 'Public'),
(16, 1, 'loop-grid-3', 'loop-grid-3', -2, 'Public'),
(17, 1, 'loop-grid-2', 'loop-grid-2', -1, 'Public');

-- --------------------------------------------------------

--
-- Estructura de la taula `qu-plupload`
--

CREATE TABLE IF NOT EXISTS `qu-plupload` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tmp_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `error` int(255) NOT NULL,
  `size` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=117 ;

--
-- Bolcant dades de la taula `qu-plupload`
--

INSERT INTO `qu-plupload` (`id`, `id_parent`, `model`, `name`, `type`, `tmp_name`, `error`, `size`) VALUES
(56, 30, 'qu-web-demo', '56-1-30-second-thumbnail-label.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpu8Pas0', 0, 229858),
(57, 28, 'qu-web-demo', '57-1-28-second-thumbnail-label.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpd5CTOQ', 0, 493557),
(58, 35, 'qu-web-demo', '58-1-35-may-dog.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpswOKYc', 0, 571844),
(59, 29, 'qu-web-demo', '59-1-29-second-thumbnail-label.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/php899Z9K', 0, 400422),
(60, 33, 'qu-web-demo', '60-1-33-lorem-ipsum-dolor-sit-amet.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/php4huKHK', 0, 493441),
(61, 32, 'qu-web-demo', '61-1-32-lorem-ipsum-dolor-sit-amet.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpwtpG56', 0, 400405),
(62, 34, 'qu-web-demo', '62-1-34-lorem-ipsum-dolor-sit-amet.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpppzjRq', 0, 571856),
(63, 31, 'qu-web-demo', '63-1-31-lorem-ipsum-dolor-sit-amet.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpvm1EAt', 0, 391698),
(64, 67, 'qu-web-demo', '64-1-67-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpoLhUtN', 0, 400405),
(65, 66, 'qu-web-demo', '65-1-66-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpOsaJkh', 0, 493448),
(66, 65, 'qu-web-demo', '66-1-65-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpMqYg7t', 0, 571875),
(67, 57, 'qu-web-demo', '67-1-57-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpGtF8Sp', 0, 571875),
(68, 54, 'qu-web-demo', '68-1-54-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpasMa4h', 0, 571875),
(69, 58, 'qu-web-demo', '69-1-58-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpeZAbhk', 0, 571856),
(70, 59, 'qu-web-demo', '70-1-59-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpwinjpi', 0, 391743),
(71, 49, 'qu-web-demo', '71-1-49-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpcFlDCZ', 0, 571875),
(72, 55, 'qu-web-demo', '72-1-55-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/php1ssP9F', 0, 391764),
(73, 60, 'qu-web-demo', '73-1-60-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpl6aAHp', 0, 391699),
(74, 61, 'qu-web-demo', '74-1-61-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpXxwRAc', 0, 400405),
(75, 48, 'qu-web-demo', '75-1-48-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpWdM9jT', 0, 391707),
(76, 56, 'qu-web-demo', '76-1-56-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phplWzbmk', 0, 400405),
(77, 53, 'qu-web-demo', '77-1-53-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpZbbZCn', 0, 571875),
(78, 52, 'qu-web-demo', '78-1-52-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpgL1mb8', 0, 391783),
(79, 51, 'qu-web-demo', '79-1-51-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/php5omuuU', 0, 400405),
(80, 43, 'qu-web-demo', '80-1-43-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpjEdeLg', 0, 571875),
(81, 42, 'qu-web-demo', '81-1-42-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/php9cFjC7', 0, 391762),
(82, 41, 'qu-web-demo', '82-1-41-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpyHIYYl', 0, 400405),
(83, 87, 'qu-web-demo', '83-1-87-test.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpuXoSso', 0, 571875),
(84, 86, 'qu-web-demo', '84-1-86-test.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpHx4wm6', 0, 571875),
(85, 89, 'qu-web-demo', '85-1-87-test.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/php9mF3uT', 0, 571907),
(86, 92, 'qu-web-demo', '86-1-92-test.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpxEfcjg', 0, 400435),
(87, 93, 'qu-web-demo', '87-1-93-test.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/php5sbO8S', 0, 400405),
(88, 91, 'qu-web-demo', '88-1-91-test.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpPDUyKu', 0, 400405),
(89, 108, 'qu-web-demo', '89-1-108-lorem-ipsum-dolor-sit-amet.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpZDffk8', 0, 400405),
(90, 107, 'qu-web-demo', '90-1-107-lorem-ipsum-dolor-sit-amet.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phphVGPEY', 0, 493441),
(91, 106, 'qu-web-demo', '91-1-106-lorem-ipsum-dolor-sit-amet.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpdEt1P2', 0, 571907),
(92, 81, 'qu-web-demo', '92-1-81-test.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpchoSL7', 0, 391716),
(93, 75, 'qu-web-demo', '93-1-75-test.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpvtFl3U', 0, 391663),
(94, 82, 'qu-web-demo', '94-1-82-collapse-test.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/php1MDcBc', 0, 571875),
(95, 74, 'qu-web-demo', '95-1-74-collapse-test.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpTvdTSn', 0, 571872),
(96, 79, 'qu-web-demo', '96-1-79-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/php7Zcghv', 0, 391699),
(97, 77, 'qu-web-demo', '97-1-77-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/php5Vyeqq', 0, 391833),
(98, 80, 'qu-web-demo', '98-1-80-test.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phppnRwdp', 0, 493441),
(99, 76, 'qu-web-demo', '99-1-76-test-demo.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpdmt1Xb', 0, 391814),
(100, 78, 'qu-web-demo', '100-1-78-test.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpAzBfJc', 0, 493448),
(101, 71, 'qu-web-demo', '101-1-71-test.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpUUO4cW', 0, 493582),
(102, 98, 'qu-web-demo', '102-1-98-looooop.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/php0aOmV6', 0, 400405),
(103, 97, 'qu-web-demo', '103-1-97-looooop.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpadpDEK', 0, 571875),
(104, 99, 'qu-web-demo', '104-1-99-looooop.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpAPHIa2', 0, 493510),
(105, 96, 'qu-web-demo', '105-1-96-looooop.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpR8ZiBb', 0, 391739),
(106, 102, 'qu-web-demo', '106-1-102-loooopppgridd.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpWETxQT', 0, 391699),
(107, 103, 'qu-web-demo', '107-1-103-loooopppgridd.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpuUV5Lf', 0, 571885),
(108, 101, 'qu-web-demo', '108-1-101-loooopppgridd.jpg', 'image/jpeg', '/Applications/MAMP/tmp/php/phpYOU1UN', 0, 391718);

-- --------------------------------------------------------

--
-- Estructura de la taula `qu-web-demo`
--

CREATE TABLE IF NOT EXISTS `qu-web-demo` (
  `id_web` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `id_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `id_lang` bigint(20) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `order` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'publish',
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8_unicode_ci,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci,
  `content` longtext COLLATE utf8_unicode_ci,
  `icon` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_web`),
  KEY `name` (`name`),
  KEY `type_status_date` (`status`,`date`,`id_web`),
  KEY `id_parent` (`id_parent`),
  KEY `author` (`id_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=125 ;

--
-- Bolcant dades de la taula `qu-web-demo`
--

INSERT INTO `qu-web-demo` (`id_web`, `id_parent`, `id_author`, `id_lang`, `name`, `order`, `date`, `modified`, `status`, `lang`, `parameters`, `title`, `summary`, `content`, `icon`) VALUES
(11, 0, 4, 11, 'home', 17, '2012-11-19 21:12:28', '2013-04-08 23:37:01', 'Public', 'es', 'loop-carousel', 'Inicio', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.</p>\r\n', '', ''),
(12, 0, 1, 12, 'empresa', 16, '2012-11-19 21:12:52', '2012-11-20 18:58:58', 'Public', 'es', 'main-menu', 'Empresa', 'Lorem ipsum dolor sit amet', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>\r\n', NULL),
(13, 0, 1, 13, 'contacto', 14, '2012-11-19 21:14:18', '2012-11-20 19:57:51', 'Public', 'es', 'main-menu', 'Contacto', 'Lorem ipsum dolor sit amet', '', NULL),
(14, 0, 1, 14, 'productos', 15, '2012-11-19 21:14:39', '2012-11-20 17:08:40', 'Public', 'es', 'main-menu', 'Productos', 'Lorem ipsum dolor sit amet', '', NULL),
(15, 0, 1, 15, 'social-media', 13, '2012-11-19 21:15:47', '2012-11-19 21:15:47', 'Public', 'es', 'social-media', 'Social media', '', '', ''),
(17, 0, 1, 17, 'privacy-policy', 12, '2012-11-19 21:17:02', '2012-11-19 22:42:16', 'Public', 'es', 'footer', 'Politica de privacidad', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam.', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.</p>\r\n<p>\r\n	molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices,</p>\r\n<p>\r\n	ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', NULL),
(18, 0, 1, 11, 'home', 17, '2012-11-19 22:01:30', '2012-11-19 22:01:30', 'Public', 'en', 'main-menu', 'Home', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.', '', NULL),
(19, 0, 1, 12, 'company', 16, '2012-11-19 22:01:49', '2012-11-19 22:01:49', 'Public', 'en', 'main-menu', 'Company', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.', '', NULL),
(20, 0, 1, 14, 'products', 15, '2012-11-19 22:06:11', '2012-11-19 22:06:11', 'Public', 'en', 'main-menu', 'Products', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', '', NULL),
(21, 0, 1, 13, 'contacta', 14, '2012-11-19 22:36:40', '2012-11-19 22:42:41', 'Public', 'en', 'main-menu', 'Contact', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', '', NULL),
(22, 0, 1, 15, 'social-media', 13, '2012-11-19 22:36:55', '2012-11-19 22:36:55', 'Public', 'en', 'social-media', 'Social media', '', '', NULL),
(23, 0, 1, 17, 'privacy-policy', 12, '2012-11-19 22:37:12', '2012-11-19 22:37:12', 'Public', 'en', 'footer', 'Privacy policy', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam.', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.</p>\r\n<p>\r\n	molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices,</p>\r\n<p>\r\n	ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', NULL),
(25, 11, 1, 25, 'carousel', 2, '2012-11-19 23:04:37', '2012-11-20 13:42:48', 'Public', 'es', 'loop-carousel', 'Carousel', '', '', NULL),
(26, 11, 1, 26, 'example-page', 1, '2012-11-19 23:04:51', '2012-11-20 13:42:58', 'Public', 'es', 'loop-grid-4', 'Example page', 'Subtext for header', '', NULL),
(28, 25, 1, 28, 'second-thumbnail-label', 3, '2012-11-19 23:07:07', '2012-11-20 00:03:25', 'Public', 'es', '-', 'My dog', 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.', '', NULL),
(29, 25, 1, 29, 'second-thumbnail-label', 1, '2012-11-19 23:07:07', '2012-11-20 00:03:13', 'Public', 'es', '-', 'My dog', 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.', '', NULL),
(30, 25, 1, 30, 'second-thumbnail-label', 4, '2012-11-19 23:07:07', '2012-11-20 00:03:31', 'Public', 'es', '-', 'My dog', 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.', '', NULL),
(31, 26, 1, 31, 'lorem-ipsum-dolor-sit-amet', 1, '2012-11-19 23:13:50', '2012-11-20 20:51:59', 'Public', 'es', '-', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. ', '<p>\r\n	<a class="btn btn-warning" href="/web-demo/es/contacto">Contact</a></p>\r\n', NULL),
(32, 26, 1, 32, 'lorem-ipsum-dolor-sit-amet', 2, '2012-11-19 23:13:50', '2012-11-20 20:51:48', 'Public', 'es', '-', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. ', '<p>\r\n	<a class="btn btn-info" href="/web-demo/es/contacto">Contact</a></p>\r\n', NULL),
(33, 26, 1, 33, 'lorem-ipsum-dolor-sit-amet', 3, '2012-11-19 23:13:50', '2012-11-20 20:52:25', 'Public', 'es', '-', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.', '<p>\r\n	<a class="btn btn-primary" href="/web-demo/es/contacto">Contact</a></p>\r\n', NULL),
(34, 26, 1, 34, 'lorem-ipsum-dolor-sit-amet', 2, '2012-11-19 23:13:50', '2012-11-20 20:50:56', 'Public', 'es', '-', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. ', '<p>\r\n	<a class="btn btn-success" href="/web-demo/es/contacto">Contact</a></p>\r\n', NULL),
(35, 25, 1, 35, 'my-dog', 2, '2012-11-20 00:01:57', '2012-11-20 00:02:57', 'Public', 'es', '-', 'My dog', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit.', '', NULL),
(38, 12, 1, 38, 'test-demo-collapse', 2, '2012-11-20 00:52:27', '2012-11-20 14:12:16', 'Public', 'es', 'loop-collapse', 'Test demo collapse', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.</p>\r\n', NULL),
(41, 38, 1, 41, 'test-demo3', 2, '2012-11-20 12:56:09', '2012-11-20 14:10:45', 'Public', 'es', '-', 'Test demo', 'Test demo', '', NULL),
(42, 38, 1, 42, 'test-demo2', 3, '2012-11-20 12:56:18', '2012-11-20 14:10:40', 'Public', 'es', '-', 'Test demo', 'Test demo', '', NULL),
(43, 38, 1, 43, 'test-demo1', 4, '2012-11-20 12:56:28', '2012-11-20 14:10:30', 'Public', 'es', '-', 'Test demo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim.</p>\r\n', NULL),
(46, 12, 1, 46, 'test-demo-grid', 4, '2012-11-20 00:52:27', '2012-11-20 14:38:37', 'Public', 'es', 'loop-grid-3', 'Test demo grid', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.</p>\r\n', NULL),
(47, 46, 1, 47, 'test-demo3', 2, '2012-11-20 12:56:09', '2012-11-20 14:12:50', 'Public', 'es', '-', 'Test demo (duplicate)', 'Test demo', '', NULL),
(48, 46, 1, 48, 'test-demo2', 3, '2012-11-20 12:56:18', '2012-11-20 14:12:43', 'Public', 'es', '-', 'Test demo (duplicate)', 'Test demo', '', NULL),
(49, 46, 1, 49, 'test-demo1', 4, '2012-11-20 12:56:28', '2012-11-20 14:12:38', 'Public', 'es', '-', 'Test demo (duplicate)', 'Test demo', '', NULL),
(50, 12, 1, 50, 'test-demo-taps', 3, '2012-11-20 00:52:27', '2012-11-20 20:23:36', 'Public', 'es', 'loop-tabs', 'Test demo taps', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '', NULL),
(51, 50, 1, 51, 'test-demo-3', 2, '2012-11-20 12:56:09', '2012-11-20 14:14:36', 'Public', 'es', '-', 'Test demo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.</p>\r\n', NULL),
(52, 50, 1, 52, 'test-demo-2', 3, '2012-11-20 12:56:18', '2012-11-20 14:14:05', 'Public', 'es', '-', 'Test demo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.</p>\r\n', NULL),
(53, 50, 1, 53, 'test-demo-1', 4, '2012-11-20 12:56:28', '2012-11-20 14:13:47', 'Public', 'es', '-', 'Test demo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.</p>\r\n', NULL),
(54, 46, 1, 54, 'test-demo1', 5, '2012-11-20 12:56:28', '2012-11-20 16:49:21', 'Public', 'es', '-', 'Test demo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. ', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.</p>\r\n<p>\r\n	Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor.</p>\r\n<p>\r\n	Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum.</p>\r\n<p>\r\n	Nunc imperdiet gravida mauris.</p>\r\n', NULL),
(55, 46, 1, 55, 'test-demo2', 4, '2012-11-20 12:56:18', '2012-11-20 14:12:43', 'Public', 'es', '-', 'Test demo (duplicate) (duplicate)', 'Test demo', '', NULL),
(56, 46, 1, 56, 'test-demo3', 3, '2012-11-20 12:56:09', '2012-11-20 14:12:50', 'Public', 'es', '-', 'Test demo (duplicate) (duplicate)', 'Test demo', '', NULL),
(57, 46, 1, 57, 'test-demo1', 6, '2012-11-20 12:56:28', '2012-11-20 16:38:46', 'Public', 'es', '-', 'Test demo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.</p>\r\n<p>\r\n	Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim.</p>\r\n<p>\r\n	Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci.</p>\r\n<p>\r\n	Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis.</p>\r\n<p>\r\n	Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', NULL),
(58, 46, 1, 58, 'test-demo1', 5, '2012-11-20 12:56:28', '2012-11-20 16:50:00', 'Public', 'es', '-', 'Test demo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. ', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam.</p>\r\n<p>\r\n	Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci.</p>\r\n<p>\r\n	Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim.</p>\r\n<p>\r\n	Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', NULL),
(59, 46, 1, 59, 'test-demo2', 5, '2012-11-20 12:56:18', '2012-11-20 14:12:43', 'Public', 'es', '-', 'Test demo (duplicate) (duplicate) (duplicate)', 'Test demo', '', NULL),
(60, 46, 1, 60, 'test-demo2', 4, '2012-11-20 12:56:18', '2012-11-20 14:12:43', 'Public', 'es', '-', 'Test demo (duplicate) (duplicate)', 'Test demo', '', NULL),
(61, 46, 1, 61, 'test-demo3', 4, '2012-11-20 12:56:09', '2012-11-20 14:12:50', 'Public', 'es', '-', 'Test demo (duplicate) (duplicate) (duplicate)', 'Test demo', '', NULL),
(62, 46, 1, 62, 'test-demo3', 3, '2012-11-20 12:56:09', '2012-11-20 14:12:50', 'Public', 'es', '-', 'Test demo (duplicate) (duplicate)', 'Test demo', '', NULL),
(63, 12, 1, 63, 'test-demo-simple-page', 5, '2012-11-20 16:07:09', '2012-11-20 16:37:46', 'Public', 'es', '-', 'Test demo single page', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit.', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor.</p>\r\n<p>\r\n	Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula.</p>\r\n<p>\r\n	Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis.</p>\r\n<p>\r\n	Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', NULL),
(64, 12, 1, 64, 'test-demo-carousel', 6, '2012-11-20 16:53:05', '2012-11-20 16:54:25', 'Public', 'es', 'loop-carousel', 'Test demo carousel', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.', '', NULL),
(65, 64, 1, 65, 'test-demo', 1, '2012-11-20 16:54:53', '2012-11-20 16:54:53', 'Public', 'es', '-', 'Test demo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. ', '', ''),
(66, 64, 1, 66, 'test-demo', 2, '2012-11-20 16:55:11', '2012-11-20 16:55:11', 'Public', 'es', '-', 'Test demo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. ', '', ''),
(67, 64, 1, 67, 'test-demo', 3, '2012-11-20 16:55:26', '2012-11-20 16:55:26', 'Public', 'es', '-', 'Test demo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. ', '', ''),
(69, 14, 1, 69, 'test-demo-grid-and-collapse', 2, '2012-11-20 17:06:22', '2012-11-20 18:25:22', 'Public', 'es', '-', 'Test demo grid and collapse', 'Lorem ipsum dolor sit amet', '', NULL),
(70, 69, 1, 70, 'especial-grid', 1, '2012-11-20 17:07:16', '2012-11-20 18:29:36', 'Public', 'es', 'loop-grid-3', 'Especial Grid', 'Lorem ipsum dolor sit amet', '', NULL),
(71, 70, 1, 71, 'test', 1, '2012-11-20 17:07:51', '2012-11-20 17:07:51', 'Public', 'es', '-', 'Test', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '', ''),
(72, 14, 1, 72, 'test-convien', 1, '2012-11-20 17:08:50', '2012-11-20 18:31:04', 'Public', 'es', '-', 'Test combined', 'Lorem ipsum dolor sit amet', '', NULL),
(73, 69, 1, 73, 'test-collapse', 2, '2012-11-20 17:10:10', '2012-11-20 20:26:02', 'Public', 'es', 'loop-collapse', '-', '', '', NULL),
(74, 73, 1, 74, 'collapse-test', 1, '2012-11-20 17:11:28', '2012-11-20 17:11:28', 'Public', 'es', '-', 'Collapse test', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '', ''),
(75, 73, 1, 75, 'test', 2, '2012-11-20 17:11:58', '2012-11-20 17:11:58', 'Public', 'es', '-', 'Test', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '', ''),
(76, 70, 1, 76, 'test-demo', 2, '2012-11-20 17:12:52', '2012-11-20 17:12:52', 'Public', 'es', '-', 'Test demo', '', '', ''),
(77, 70, 1, 77, 'test-demo', 3, '2012-11-20 17:12:52', '2012-11-20 17:12:52', 'Public', 'es', '-', 'Test demo (duplicate)', '', '', ''),
(78, 70, 1, 78, 'test', 2, '2012-11-20 17:07:51', '2012-11-20 17:14:53', 'Public', 'es', '-', 'Test (duplicate)', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '', NULL),
(79, 70, 1, 79, 'test-demo', 4, '2012-11-20 17:12:52', '2012-11-20 17:12:52', 'Public', 'es', '-', 'Test demo (duplicate) (duplicate)', '', '', ''),
(80, 70, 1, 80, 'test', 3, '2012-11-20 17:07:51', '2012-11-20 17:07:51', 'Public', 'es', '-', 'Test (duplicate) (duplicate)', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '', ''),
(81, 73, 1, 81, 'test', 3, '2012-11-20 17:11:58', '2012-11-20 17:11:58', 'Public', 'es', '-', 'Test (duplicate)', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '', ''),
(82, 73, 1, 82, 'collapse-test', 2, '2012-11-20 17:11:28', '2012-11-20 17:11:28', 'Public', 'es', '-', 'Collapse test (duplicate)', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '', ''),
(83, 14, 1, 83, 'simple-page', 3, '2012-11-20 17:16:49', '2012-11-20 20:30:37', 'Public', 'es', '-', 'Multi page', '', '', NULL),
(84, 83, 1, 84, 'simple-page', 3, '2012-11-20 17:18:40', '2012-11-20 19:48:58', 'Public', 'es', '-', 'Simple page', '', '', NULL),
(85, 83, 1, 85, 'collapse-test', 4, '2012-11-20 17:19:08', '2012-11-20 20:30:06', 'Public', 'es', 'loop-carousel', '-', '', '', NULL),
(86, 85, 1, 86, 'test', 1, '2012-11-20 17:31:20', '2012-11-20 17:31:20', 'Public', 'es', '-', 'Test', '', '', ''),
(87, 85, 1, 87, 'test', 2, '2012-11-20 17:31:20', '2012-11-20 17:31:20', 'Public', 'es', '-', 'Test (duplicate)', '', '', ''),
(89, 84, 1, 89, 'page-simple', 2, '2012-11-20 17:32:26', '2012-11-20 17:32:26', 'Public', 'es', '-', 'Page simple', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. ', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus.</p>\r\n<p>\r\n	Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.</p>\r\n', ''),
(90, 83, 1, 90, 'grid', 1, '2012-11-20 17:39:31', '2012-11-20 19:48:31', 'Public', 'es', 'loop-grid-3', 'Grid', '', '', NULL),
(91, 90, 1, 91, 'test', 1, '2012-11-20 18:27:25', '2012-11-20 18:27:25', 'Public', 'es', '-', 'Test', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>\r\n<p>\r\n	Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula.</p>\r\n<p>\r\n	Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim.</p>\r\n<p>\r\n	Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', ''),
(92, 90, 1, 92, 'test', 2, '2012-11-20 18:27:25', '2012-11-20 18:27:25', 'Public', 'es', '-', 'Test (duplicate)', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>\r\n<p>\r\n	Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula.</p>\r\n<p>\r\n	Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim.</p>\r\n<p>\r\n	Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', ''),
(93, 90, 1, 93, 'test', 2, '2012-11-20 18:27:25', '2012-11-20 18:27:25', 'Public', 'es', '-', 'Test (duplicate)', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>\r\n<p>\r\n	Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula.</p>\r\n<p>\r\n	Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim.</p>\r\n<p>\r\n	Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', ''),
(95, 72, 1, 95, 'loop-grid-2', 2, '2012-11-20 18:31:30', '2012-11-20 20:26:25', 'Public', 'es', 'loop-grid-2', '-', '', '', NULL),
(96, 95, 1, 96, 'looooop', 0, '2012-11-20 18:32:04', '2012-11-20 20:28:29', 'Public', 'es', '-', 'Test demo', '', '', NULL),
(97, 95, 1, 97, 'looooop', 2, '2012-11-20 18:32:19', '2012-11-20 20:27:33', 'Public', 'es', '-', 'Test demo', '', '', NULL),
(98, 95, 1, 98, 'looooop', 3, '2012-11-20 18:32:19', '2012-11-20 20:28:50', 'Public', 'es', '-', 'Test demo', '', '', NULL),
(99, 95, 1, 99, 'looooop', 1, '2012-11-20 18:32:04', '2012-11-20 20:27:38', 'Public', 'es', '-', 'Test demo', '', '', NULL),
(100, 72, 1, 100, 'loop-grid-3', 1, '2012-11-20 18:33:51', '2012-11-20 18:33:51', 'Public', 'es', 'loop-grid-3', 'Loop grid 3', 'Lorem ipsum dolor sit amet', '', ''),
(101, 100, 1, 101, 'loooopppgridd', 1, '2012-11-20 18:36:26', '2012-11-20 20:27:07', 'Public', 'es', '-', 'Test demo', '', '', NULL),
(102, 100, 1, 102, 'loooopppgridd', 3, '2012-11-20 18:36:26', '2012-11-20 20:26:50', 'Public', 'es', '-', 'Test demo', '', '', NULL),
(103, 100, 1, 103, 'loooopppgridd', 2, '2012-11-20 18:36:51', '2012-11-20 20:27:02', 'Public', 'es', '-', 'Test demo', '', '', NULL),
(104, 83, 1, 104, 'tabs', 2, '2012-11-20 19:49:25', '2012-11-20 20:21:20', 'Public', 'es', 'loop-collapse', '-', '', '', NULL),
(105, 13, 1, 105, 'from-contact', 2, '2012-11-20 19:58:15', '2012-11-20 19:58:37', 'Public', 'es', '-', 'Form contact', '', '<p>\r\n	{from-contact}</p>\r\n', NULL),
(106, 104, 1, 106, 'lorem-3', 1, '2012-11-20 20:13:56', '2012-11-20 20:18:06', 'Public', 'es', '-', 'Lorem ipsum dolor sit amet', '', '', NULL),
(107, 104, 1, 107, 'lorem-2', 2, '2012-11-20 20:14:23', '2012-11-20 20:17:59', 'Public', 'es', '-', 'Lorem ipsum dolor sit amet', '', '', NULL),
(108, 104, 1, 108, 'lorem-1', 3, '2012-11-20 20:14:31', '2012-11-20 20:17:46', 'Public', 'es', '-', 'Lorem ipsum dolor sit amet', '', '', NULL),
(109, 13, 1, 109, 'contact', 1, '2012-11-20 20:31:40', '2012-11-20 20:43:20', 'Public', 'es', '-', 'Map location', '', '<p>\r\n	<iframe frameborder="0" height="350" marginheight="0" marginwidth="0" scrolling="no" src="https://maps.google.es/maps/ms?msa=0&amp;msid=209359617805559089945.00046bee9c36b4e9deb11&amp;hl=ca&amp;ie=UTF8&amp;t=p&amp;ll=41.787805,0.808101&amp;spn=0.011199,0.018239&amp;z=15&amp;output=embed" width="425"></iframe><br />\r\n	<small>Mostra <a href="https://maps.google.es/maps/ms?msa=0&amp;msid=209359617805559089945.00046bee9c36b4e9deb11&amp;hl=ca&amp;ie=UTF8&amp;t=p&amp;ll=41.787805,0.808101&amp;spn=0.011199,0.018239&amp;z=15&amp;source=embed">cenics</a> en un mapa m&eacute;s gran</small></p>\r\n', NULL),
(113, 0, 4, 11, 'home', 0, '0000-00-00 00:00:00', '2013-04-08 23:37:05', 'Public', 'fr', 'loop-carousel', 'Inicio', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.</p>\r\n', '', ''),
(114, 0, 4, 12, 'empresa', -1, '0000-00-00 00:00:00', '2013-04-08 23:28:52', 'Public', 'fr', 'main-menu', 'Empresa', '<p>Lorem ipsum dolor sit amet</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>\r\n', ''),
(115, 0, 4, 14, 'productos', -2, '0000-00-00 00:00:00', '2013-04-08 23:28:57', 'Public', 'fr', 'main-menu', 'Productos', '<p>Lorem ipsum dolor sit amet</p>\r\n', '', ''),
(116, 0, 4, 13, 'contacto', -3, '0000-00-00 00:00:00', '2013-04-08 23:29:00', 'Public', 'fr', 'main-menu', 'Contacto', '<p>Lorem ipsum dolor sit amet</p>\r\n', '', ''),
(117, 0, 4, 15, 'social-media', -4, '0000-00-00 00:00:00', '2013-04-08 23:29:04', 'Public', 'fr', 'social-media', 'Social media', '', '', ''),
(118, 0, 4, 17, 'privacy-policy', -5, '0000-00-00 00:00:00', '2013-04-08 23:29:10', 'Public', 'fr', 'footer', 'Politica de privacidad', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam.</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.</p>\r\n\r\n<p>molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices,</p>\r\n\r\n<p>ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', ''),
(119, 12, 4, 64, 'test-demo-carousel', 0, '0000-00-00 00:00:00', '2013-04-08 23:29:40', 'Public', 'fr', 'loop-carousel', 'Test demo carousel', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.</p>\r\n', '', ''),
(120, 12, 4, 64, 'test-demo-carousel', 0, '0000-00-00 00:00:00', '2013-04-08 23:29:44', 'Public', 'en', 'loop-carousel', 'Test demo carousel', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.</p>\r\n', '', ''),
(121, 14, 4, 83, 'simple-page', 0, '0000-00-00 00:00:00', '2013-04-08 23:30:00', 'Public', 'fr', '-', 'Multi page', '', '', ''),
(122, 14, 4, 83, 'simple-page', 0, '0000-00-00 00:00:00', '2013-04-08 23:30:03', 'Public', 'en', '-', 'Multi page', '', '', ''),
(123, 13, 4, 105, 'from-contact', 0, '0000-00-00 00:00:00', '2013-04-08 23:30:12', 'Public', 'fr', '-', 'Form contact', '', '<p>{from-contact}</p>\r\n', ''),
(124, 13, 4, 105, 'from-contact', 0, '0000-00-00 00:00:00', '2013-04-08 23:30:14', 'Public', 'en', '-', 'Form contact', '', '<p>{from-contact}</p>\r\n', '');

-- --------------------------------------------------------

--
-- Estructura de la taula `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `display_name` varchar(50) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `state` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Bolcant dades de la taula `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `display_name`, `password`, `state`) VALUES
(4, 'cel', 'cel@cenics.net', 'Cel Tico', '$2y$08$i2ws46ejq7v3mqr7cy1o.Om9sFsNNHvliomEjfZZvaLRrIe6QWIA6', '1'),
(32, 'demo', 'admin@admin.com', 'Admin Demo', '$2y$08$4MLRC50tdx9KUU9zBHfdCuOte.ijO6ltsEJDWG/gFscl5ytrPSKFK', '1');

-- --------------------------------------------------------

--
-- Estructura de la taula `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` varchar(255) NOT NULL,
  `default` tinyint(1) NOT NULL,
  `parent` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcant dades de la taula `user_role`
--

INSERT INTO `user_role` (`role_id`, `default`, `parent`) VALUES
('admin', 1, 'admin');

-- --------------------------------------------------------

--
-- Estructura de la taula `user_role_linker`
--

CREATE TABLE IF NOT EXISTS `user_role_linker` (
  `user_id` int(11) unsigned NOT NULL,
  `role_id` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcant dades de la taula `user_role_linker`
--

INSERT INTO `user_role_linker` (`user_id`, `role_id`) VALUES
(1, 'admin');
