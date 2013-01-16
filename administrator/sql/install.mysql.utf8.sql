CREATE TABLE IF NOT EXISTS `#__fanpagealbums` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`pid` VARCHAR(255)  NOT NULL ,
`album_name` VARCHAR(255)  NOT NULL ,
`src_small` VARCHAR(255)  NOT NULL ,
`src_large` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_bin;

