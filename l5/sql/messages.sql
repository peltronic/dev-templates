use myl5app;


CREATE TABLE `messages` (
      `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
      `slug` varchar(255) DEFAULT NULL,
      `user_id` int(10) unsigned NOT NULL COMMENT 'fk to user who authored message',
      `title` varchar(256) DEFAULT NULL,
      `content` longtext COMMENT 'the message itself',
      `created_at` timestamp NULL DEFAULT NULL,
      `updated_at` timestamp NULL DEFAULT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `messages_unique_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `mediafiles` (
      `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
      `message_id` int(10) unsigned NOT NULL,
      `mimetype` varchar(255) DEFAULT NULL COMMENT 'jpg, mp4, etc',
      `ext` varchar(10) DEFAULT NULL,
      `ogfilename` varchar(511) DEFAULT NULL COMMENT 'original filename of uploaded media',
      `guid` char(36) NOT NULL,
      `caption` text,
      `created_at` timestamp NULL DEFAULT NULL,
      `updated_at` timestamp NULL DEFAULT NULL,
      PRIMARY KEY (`id`),
      KEY `mediafiles_message_id` (`message_id`),
      CONSTRAINT `mediafiles_message_id` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

