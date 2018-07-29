create database calculator;
use calculator;
CREATE TABLE `account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tel` varchar(20) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `role` tinyint(4) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `createtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fh` (`tel`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='主帐号';

INSERT INTO `account` VALUES ('1', '18311111111', '$2y$13$/4st6GDqwRB.aE9GdAY1nuurrsiIwWCXC.uijFyY89o/JE6ry9SVe', 'suWMq15OhBvA8iyi-tEUvLx_ktYhcJIs', '10', '1', null, null);
INSERT INTO `account` VALUES ('5', '18322222222', '$2y$13$Y2nUlnY1sEaJn.vjTqRhr.ATq.oHRT7jKQOwrrIixjgu0herCcwqe', 'fftkgBpCLNRqHUPf5eiZ4bdUXO-MgQZc', '10', '10', '1', null);

CREATE TABLE `config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `year` varchar(10) NOT NULL DEFAULT '0',
  `town_dis_income` double DEFAULT NULL COMMENT '城镇居民人均可支配收入',
  `town_con_income` double DEFAULT NULL COMMENT '城镇居民人均消费性支出',
  `area_dis_income` double DEFAULT NULL COMMENT '农村居民人均可支配收入',
  `area_con_income` double DEFAULT NULL COMMENT '农村居民人均消费性支出',
  `avg_wage` double DEFAULT NULL COMMENT '平均工资',
  `eff_date` date DEFAULT NULL COMMENT '生效时间',
  PRIMARY KEY (`id`),
  KEY `fk` (`year`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
INSERT INTO `config` VALUES ('1', '2017', '1600', '1400', '1200', '1300', '1000', '2018-07-07');
