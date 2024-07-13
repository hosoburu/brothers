CREATE TABLE `t_member` (
    `id` int(11) NOT NULL,
    `name` char(255) DEFAULT NULL,
    `explanation` text DEFAULT NULL,
    `img` text DEFAULT NULL,
    `atk` int(11) DEFAULT NULL,
    `def` int(11) DEFAULT NULL,
    `spd` int(11) DEFAULT NULL,
    `hp` int(11) DEFAULT NULL,
    `mp` int(11) DEFAULT NULL,
    `skill1` char(255) DEFAULT NULL,
    `skill2` char(255) DEFAULT NULL,
    `skill3` char(255) DEFAULT NULL,
    `skill4` char(255) DEFAULT NULL,
    `skill5` char(255) DEFAULT NULL,
    `skill6` char(255) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci;