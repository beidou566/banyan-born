/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 5.5.62-log : Database - @elep
*********************************************************************
*/

USE `@elep`;

/*表的结构 `el_article` */
DROP TABLE IF EXISTS `el_article`;

CREATE TABLE `el_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) DEFAULT NULL COMMENT '标题',
  `contxt` varchar(256) DEFAULT NULL COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='测试表';

/*Data for the table `el_article` */
insert  into `el_article`(`id`,`title`,`contxt`) values 
(1,'title1','111'),
(2,'title2','222'),
(3,'title3','333'),
(4,'title4','444');
