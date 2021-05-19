DROP TABLE IF EXISTS `tx_worldcup2_domain_model_game`;
CREATE TABLE IF NOT EXISTS `tx_worldcup2_domain_model_game` (
    `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `pid` int(10) unsigned NOT NULL DEFAULT 0,
    `tstamp` int(10) unsigned NOT NULL DEFAULT 0,
    `crdate` int(10) unsigned NOT NULL DEFAULT 0,
    `cruser_id` int(10) unsigned NOT NULL DEFAULT 0,
    `deleted` smallint(5) unsigned NOT NULL DEFAULT 0,
    `hidden` smallint(5) unsigned NOT NULL DEFAULT 0,
    `sys_language_uid` int(11) NOT NULL DEFAULT 0,
    `l10n_parent` int(10) unsigned NOT NULL DEFAULT 0,
    `l10n_state` text COLLATE utf8_unicode_ci DEFAULT NULL,
    `l10n_diffsource` mediumblob DEFAULT NULL,
    `playtime` int(11) NOT NULL DEFAULT 0,
    `goalsteam1` int(11) NOT NULL DEFAULT 0,
    `goalsteam2` int(11) NOT NULL DEFAULT 0,
    `round` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
    `team1` int(10) unsigned DEFAULT 0,
    `team2` int(10) unsigned DEFAULT 0,
    `finished` smallint(5) unsigned NOT NULL DEFAULT 0,
    `remark` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
    PRIMARY KEY (`uid`),
    KEY `parent` (`pid`,`deleted`,`hidden`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DELETE FROM `tx_worldcup2_domain_model_game`;

INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (4, 5347, 1621277398, 1615827974, 11, 0, 0, -1, 0, NULL, 1623438000, 0, 0, 'A', 4, 3, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (2, 5347, 1616431474, 1615568295, 11, 0, 0, -1, 0, NULL, 1623502800, 0, 0, 'A', 5, 6, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (3, 5347, 1616431497, 1615568366, 11, 0, 0, -1, 0, NULL, 1623513600, 0, 0, 'B', 7, 8, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (1, 5347, 1616431547, 1615567639, 11, 0, 0, -1, 0, NULL, 1623524400, 0, 0, 'B', 9, 10, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (13, 5347, 1616432031, 1616432031, 11, 0, 0, -1, 0, NULL, 1623589200, 0, 0, 'D', 14, 15, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (6, 5347, 1616431676, 1616431676, 11, 0, 0, -1, 0, NULL, 1623600000, 0, 0, 'C', 11, 12, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (12, 5347, 1616432120, 1616432031, 11, 1, 0, -1, 0, NULL, 1623600000, 0, 0, 'C', 11, 12, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (7, 5347, 1616431787, 1616431724, 11, 0, 0, -1, 0, NULL, 1623610800, 0, 0, 'C', 13, 52, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (10, 5347, 1621274950, 1616431870, 11, 0, 0, -1, 0, NULL, 1623675600, 0, 0, 'D', 16, 17, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (9, 5347, 1616431956, 1616431870, 11, 0, 0, -1, 0, NULL, 1623686400, 0, 0, 'E', 18, 19, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (8, 5347, 1616431993, 1616431870, 11, 0, 0, -1, 0, NULL, 1623697200, 0, 0, 'E', 20, 21, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (5, 5347, 1616432096, 1616431598, 11, 0, 0, -1, 0, NULL, 1623772800, 0, 0, 'F', 23, 22, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (11, 5347, 1616432155, 1616432031, 11, 0, 0, -1, 0, NULL, 1623783600, 0, 0, 'F', 1, 2, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (16, 5347, 1621276962, 1616432250, 11, 0, 0, -1, 0, NULL, 1623848400, 0, 0, 'B', 8, 10, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (15, 5347, 1616432397, 1616432250, 11, 0, 0, -1, 0, NULL, 1623859200, 0, 0, 'A', 4, 5, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (14, 5347, 1616432353, 1616432250, 11, 0, 0, -1, 0, NULL, 1623870000, 0, 0, 'A', 3, 6, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (19, 5347, 1616432461, 1616432426, 11, 0, 0, -1, 0, NULL, 1623934800, 0, 0, 'C', 13, 12, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (18, 5347, 1616432510, 1616432426, 11, 0, 0, -1, 0, NULL, 1623945600, 0, 0, 'B', 7, 9, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (17, 5347, 1616432560, 1616432426, 11, 0, 0, -1, 0, NULL, 1623956400, 0, 0, 'C', 52, 11, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (22, 5347, 1616432632, 1616432578, 11, 0, 0, -1, 0, NULL, 1624021200, 0, 0, 'E', 21, 19, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (21, 5347, 1616432696, 1616432578, 11, 0, 0, -1, 0, NULL, 1624032000, 0, 0, 'D', 15, 17, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (20, 5347, 1616432730, 1616432578, 11, 0, 0, -1, 0, NULL, 1624042800, 0, 0, 'D', 14, 16, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (25, 5347, 1621274272, 1621273370, 11, 0, 0, -1, 0, NULL, 1624107600, 0, 0, 'F', 22, 2, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (24, 5347, 1621274263, 1621273356, 11, 0, 0, -1, 0, NULL, 1624118400, 0, 0, 'F', 23, 1, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (23, 5347, 1621277466, 1621273347, 11, 0, 0, -1, 0, NULL, 1624129200, 0, 0, 'E', 20, 18, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (27, 5347, 1621274584, 1621274584, 11, 0, 0, -1, 0, NULL, 1624204800, 0, 0, 'A', 3, 5, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (28, 5347, 1621277458, 1621274630, 11, 0, 0, -1, 0, NULL, 1624204800, 0, 0, 'A', 6, 4, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (29, 5347, 1621274678, 1621274678, 11, 0, 0, -1, 0, NULL, 1624291200, 0, 0, 'C', 12, 52, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (30, 5347, 1621274715, 1621274715, 11, 0, 0, -1, 0, NULL, 1624291200, 0, 0, 'C', 13, 11, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (31, 5347, 1621274762, 1621274762, 11, 0, 0, -1, 0, NULL, 1624302000, 0, 0, 'B', 10, 7, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (32, 5347, 1621274794, 1621274794, 11, 0, 0, -1, 0, NULL, 1624302000, 0, 0, 'B', 8, 9, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (33, 5347, 1621275086, 1621275086, 11, 0, 0, -1, 0, NULL, 1624388400, 0, 0, 'D', 15, 16, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (34, 5347, 1621275139, 1621275139, 11, 0, 0, -1, 0, NULL, 1624464000, 0, 0, 'E', 19, 20, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (35, 5347, 1621275163, 1621275163, 11, 0, 0, -1, 0, NULL, 1624464000, 0, 0, 'E', 21, 18, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (26, 5347, 1621277443, 1621273846, 11, 0, 0, -1, 0, NULL, 1624474800, 0, 0, 'F', 23, 2, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (37, 5347, 1621277436, 1621275333, 11, 0, 0, -1, 0, NULL, 1624723200, 0, 0, '16', 35, 34, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (38, 5347, 1621275398, 1621275398, 11, 0, 0, -1, 0, NULL, 1624734000, 0, 0, '16', 39, 33, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (39, 5347, 1621275464, 1621275464, 11, 0, 0, -1, 0, NULL, 1624809600, 0, 0, '16', 37, 24, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (40, 5347, 1621275498, 1621275498, 11, 0, 0, -1, 0, NULL, 1624820400, 0, 0, '16', 38, 24, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (41, 5347, 1621275534, 1621275534, 11, 0, 0, -1, 0, NULL, 1624896000, 0, 0, '16', 32, 31, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (42, 5347, 1621275571, 1621275571, 11, 0, 0, -1, 0, NULL, 1624906800, 0, 0, '16', 29, 24, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (43, 5347, 1621275608, 1621275608, 11, 0, 0, -1, 0, NULL, 1624982400, 0, 0, '16', 36, 30, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (44, 5347, 1621277408, 1621275743, 11, 0, 0, -1, 0, NULL, 1624993200, 0, 0, '16', 28, 24, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (45, 5347, 1621277423, 1621275797, 11, 0, 0, -1, 0, NULL, 1625241600, 0, 0, '8', 45, 47, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (46, 5347, 1621275861, 1621275861, 11, 0, 0, -1, 0, NULL, 1625252400, 0, 0, '8', 48, 26, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (47, 5347, 1621275997, 1621275947, 11, 0, 0, -1, 0, NULL, 1625328000, 0, 0, '8', 46, 25, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (48, 5347, 1621277678, 1621276012, 11, 0, 0, -1, 0, NULL, 1625338800, 0, 0, '8', 40, 27, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (49, 5347, 1621277671, 1621276134, 11, 0, 0, -1, 0, NULL, 1625598000, 0, 0, '4', 51, 50, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (50, 5347, 1621276246, 1621276183, 11, 0, 0, -1, 0, NULL, 1625684400, 0, 0, '4', 49, 44, 0);
INSERT INTO `tx_worldcup2_domain_model_game` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `playtime`, `goalsteam1`, `goalsteam2`, `round`, `team1`, `team2`, `finished`) VALUES (36, 5347, 1621277490, 1621275317, 11, 0, 0, -1, 0, NULL, 1626030000, 0, 0, '2', 41, 42, 0);


DROP TABLE IF EXISTS `tx_worldcup2_domain_model_team`;
CREATE TABLE IF NOT EXISTS `tx_worldcup2_domain_model_team` (
    `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `pid` int(10) unsigned NOT NULL DEFAULT 0,
    `tstamp` int(10) unsigned NOT NULL DEFAULT 0,
    `crdate` int(10) unsigned NOT NULL DEFAULT 0,
    `cruser_id` int(10) unsigned NOT NULL DEFAULT 0,
    `deleted` smallint(5) unsigned NOT NULL DEFAULT 0,
    `hidden` smallint(5) unsigned NOT NULL DEFAULT 0,
    `sys_language_uid` int(11) NOT NULL DEFAULT 0,
    `l10n_parent` int(10) unsigned NOT NULL DEFAULT 0,
    `l10n_state` text COLLATE utf8_unicode_ci DEFAULT NULL,
    `l10n_diffsource` mediumblob DEFAULT NULL,
    `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
    `flag` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
    `shortcutfifa` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
    PRIMARY KEY (`uid`),
    KEY `parent` (`pid`,`deleted`,`hidden`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DELETE FROM `tx_worldcup2_domain_model_team`;
INSERT INTO `tx_worldcup2_domain_model_team` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `l10n_diffsource`, `name`, `flag`, `shortcutfifa`) VALUES
(1, 5347, 1616322708, 1615567529, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'Germany', 'de', 'DEU'),
(2, 5347, 1616322708, 1615567608, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'France', 'fr', 'FRA'),
(3, 5347, 1616322708, 1615652247, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'Italy', 'it', 'ITA'),
(4, 5347, 1616322708, 1616321904, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'Turkey', 'tr', 'TUR'),
(5, 5347, 1616322708, 1616322082, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'Wales', 'wa', 'WAL'),
(6, 5347, 1616322708, 1616322123, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'Switzerland', 'ch', 'SUI'),
(7, 5347, 1616322708, 1616322155, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'Denmark', 'dk', 'DEN'),
(8, 5347, 1616322708, 1616322172, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'Finland', 'fi', 'FIN'),
(9, 5347, 1616322708, 1616322192, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'Belgium', 'be', 'BEL'),
(10, 5347, 1616322708, 1616322207, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'Russia', 'ru', 'RUS'),
(11, 5347, 1616322708, 1616322220, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'Austria', 'at', 'AUT'),
(12, 5347, 1616322708, 1616322247, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'North Macedonia', 'ma', 'MKD'),
(13, 5347, 1616322708, 1616322292, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'Ukraine', 'ui', 'UKR'),
(14, 5347, 1616322708, 1616322308, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'England', 'en', 'ENG'),
(15, 5347, 1616322708, 1616322328, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'Croatia', 'cr', 'CRO'),
(16, 5347, 1616322708, 1616322359, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'Scotland', 'sc', 'SCO'),
(17, 5347, 1616322708, 1616322394, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'Czech Republic', 'cz', 'CZE'),
(18, 5347, 1616322708, 1616322412, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'Poland', 'pl', 'POL'),
(19, 5347, 1616322708, 1616322446, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'Slovakia', 'sk', 'SVK'),
(20, 5347, 1616322708, 1616322464, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'Spain', 'es', 'ESP'),
(21, 5347, 1616322708, 1616322486, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'sweden', 'se', 'SWE'),
(22, 5347, 1616322708, 1616322512, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'Hungary', 'hu', 'HUN'),
(23, 5347, 1616322708, 1616322545, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A31363A227379735F6C616E67756167655F756964223B4E3B7D, 'Portugal', 'pt', 'POR'),
(24, 5347, 1616323341, 1616322661, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'Thirdplaced', 'eu', ''),
(25, 5347, 1616323476, 1616322661, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'A1 Winner A2/B2', 'eu', ''),
(26, 5347, 1616323476, 1616323058, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'A3 Winner C1/3*', 'eu', ''),
(27, 5347, 1616323476, 1616323118, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'A7 Winner D1/F2', 'eu', ''),
(28, 5347, 1616323191, 1616323118, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'Winner Group E', 'eu', ''),
(29, 5347, 1616323191, 1616323118, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'Winner Group F', 'eu', ''),
(30, 5347, 1616323166, 1616323166, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'Second Group F', 'eu', ''),
(31, 5347, 1616323166, 1616323166, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'Second Group E', 'eu', ''),
(32, 5347, 1616323166, 1616323166, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'Second Group D', 'eu', ''),
(33, 5347, 1616323166, 1616323166, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'Second Group C', 'eu', ''),
(34, 5347, 1616323166, 1616323166, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'Second Group B', 'eu', ''),
(35, 5347, 1616323166, 1616323166, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'Second Group A', 'eu', ''),
(36, 5347, 1616323231, 1616323231, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'Winner Group D', 'eu', ''),
(37, 5347, 1616323231, 1616323231, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'Winner Group C', 'eu', ''),
(38, 5347, 1616323231, 1616323231, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'Winner Group B', 'eu', ''),
(39, 5347, 1616323231, 1616323231, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'Winner Group A', 'eu', ''),
(40, 5347, 1616323476, 1616323402, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'A8 Winner E1/3*', 'eu', ''),
(41, 5347, 1616323886, 1616323428, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'S1 Winner Q1/Q2', 'eu', ''),
(42, 5347, 1616323886, 1616323428, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'S2 Winner Q3/Q4', 'eu', ''),
(43, 5347, 1616323886, 1616323428, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'Final S1/S2', 'eu', ''),
(44, 5347, 1616323789, 1616323428, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'Q4 Winner AF8/AF7', 'eu', ''),
(45, 5347, 1616323675, 1616323675, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'A5 Winner D2/E2', 'eu', ''),
(46, 5347, 1616323675, 1616323675, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'A6 Winner F1/3*', 'eu', ''),
(47, 5347, 1616323675, 1616323675, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'A2 Winner A1/C2', 'eu', ''),
(48, 5347, 1616323675, 1616323675, 11, 0, 0, -1, 0, NULL, _binary 0x613A353A7B733A31363A227379735F6C616E67756167655F756964223B4E3B733A363A2268696464656E223B4E3B733A343A226E616D65223B4E3B733A343A22666C6167223B4E3B733A31323A2273686F727463757466696661223B4E3B7D, 'A4 Winner B1/3*', 'eu', ''),
(49, 5347, 1616323831, 1616323831, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'Q3 Winner AF3/AF1', 'eu', ''),
(50, 5347, 1616323831, 1616323831, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'Q2 Winner AF4/AF2', 'eu', ''),
(51, 5347, 1616323831, 1616323831, 11, 0, 0, -1, 0, NULL, _binary 0x613A313A7B733A343A226E616D65223B4E3B7D, 'Q1 Winner AF6/AF5', 'eu', ''),
(52, 5347, 1616431764, 1616431764, 11, 0, 0, -1, 0, NULL, _binary 0x613A353A7B733A31363A227379735F6C616E67756167655F756964223B4E3B733A363A2268696464656E223B4E3B733A343A226E616D65223B4E3B733A343A22666C6167223B4E3B733A31323A2273686F727463757466696661223B4E3B7D, 'Netherland', 'nl', 'HOL');




