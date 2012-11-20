/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

--
-- Table `QuAdmin`
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
  `documents` text COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,

  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `type_status_date` (`type`,`status`,`date`,`id`),
  KEY `id_parent` (`id_parent`),
  KEY `author` (`id_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;