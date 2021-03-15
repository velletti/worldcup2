CREATE TABLE tx_worldcup2_domain_model_team (

	name varchar(255) DEFAULT '' NOT NULL,
	flag varchar(255) DEFAULT '' NOT NULL,
	shortcutfifa varchar(255) DEFAULT '' NOT NULL

);

CREATE TABLE tx_worldcup2_domain_model_bet (

	goalsteam1 int(11) DEFAULT '0' NOT NULL,
	goalsteam2 int(11) DEFAULT '0' NOT NULL,
	game int(11) unsigned DEFAULT '0',
	feuser int(11) unsigned DEFAULT '0'

);

CREATE TABLE tx_worldcup2_domain_model_game (

	playtime int(11) DEFAULT '0' NOT NULL,
	goalsteam1 int(11) DEFAULT '0' NOT NULL,
	goalsteam2 int(11) DEFAULT '0' NOT NULL,
	round varchar(2) DEFAULT '' NOT NULL,
	finished SMALLINT(1) unsigned DEFAULT '0' NOT NULL,
	team1 int(11) unsigned DEFAULT '0',
	team2 int(11) unsigned DEFAULT '0'

);
