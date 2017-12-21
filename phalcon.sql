CREATE TABLE `book` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `text` tinytext COMMENT '内容',
  `deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `catalog` (
  `catalog_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `catalog_name` varchar(25) DEFAULT NULL COMMENT '标题名',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`catalog_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `phalcon_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `group_id` tinyint(1) DEFAULT '0' COMMENT '0是前台 1 是后台',
  `delete` tinyint(1) DEFAULT '0' COMMENT '1是删除',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

