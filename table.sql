CREATE TABLE `comments` (
 `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `post_id` mediumint(8) unsigned NOT NULL,
 `comment_text` tinytext NOT NULL,
 `comment_likes` smallint(5) unsigned DEFAULT 0,
 `user_id` smallint(10) unsigned NOT NULL,
 `comment_author` varchar(15) NOT NULL,
 PRIMARY KEY (`comment_id`),
 KEY `post_id` (`post_id`),
 KEY `user_id` (`user_id`),
 CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
 CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `stories` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8

CREATE TABLE `stories` (
 `post_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
 `user_id` smallint(5) unsigned NOT NULL,
 `author` varchar(15) NOT NULL,
 `title` varchar(200) NOT NULL,
 `story` text NOT NULL,
 `link` varchar(200) DEFAULT NULL,
 `story_likes` bigint(255) unsigned NOT NULL DEFAULT 0,
 PRIMARY KEY (`post_id`,`author`),
 KEY `author` (`author`),
 KEY `user_id` (`user_id`),
 KEY `author_2` (`author`),
 CONSTRAINT `stories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8

CREATE TABLE `users` (
 `id` smallint(10) unsigned NOT NULL AUTO_INCREMENT,
 `username` varchar(15) CHARACTER SET utf8 NOT NULL,
 `password` varchar(255) CHARACTER SET utf8 NOT NULL,
 PRIMARY KEY (`id`),
 KEY `id` (`id`),
 KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4
