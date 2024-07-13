CREATE TABLE `t_news` (
    `id` int(11) NOT NULL,
    `name_id` int(11) DEFAULT NULL,
    `explanation` varchar(1048) DEFAULT NULL,
    `hyperlink` varchar(1048) DEFAULT NULL,
    `posted_date` date DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci;