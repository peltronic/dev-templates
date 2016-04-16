USE myl5app;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `is_confirmed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(128) COLLATE utf8_unicode_ci DEFAULT '',
  `lastname` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8_unicode_ci,
  `pointcnt` int(10) unsigned DEFAULT NULL,
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_unique_username` (`username`),
  UNIQUE KEY `appusers_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `lsessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `lsessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `siteconfigs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(64) NOT NULL COMMENT 'acts as a key for lookup',
  `value` varchar(255) NULL DEFAULT NULL COMMENT 'value associated with the key/slug',
  `comment` text COMMENT 'optional description/usage',
  `data` longtext COMMENT 'optional data (eg, json)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table for misc. defaults and configurations';


INSERT INTO `users` (`id`, `email`, `is_confirmed`, `username`, `firstname`, `lastname`, `about`, `pointcnt`, `confirmation_code`, `password`, `remember_token`, `created_at`, `updated_at`)
VALUES
    (1, 'peter@peltronic.com', 1, 'peterg', 'Peter', 'G', NULL, NULL, NULL, '$2y$10$Ws1YHlOZZmHWCJUSnQmjXemsC1SANyQ0qNW3johbHD4QL2M9rgbi2', '1HlZIjNig99xSnLca6SClDjwxcQXFGsDgRquwyEVNz3Ci1hg8AEbU8WehOvG', '2016-01-01 01:01:01','2016-01-01 01:01:01');
