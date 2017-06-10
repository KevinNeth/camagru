<?php
$database = new Model($DB_DSN, $DB_USR, $DB_PSW);
$database->query(
	"CREATE TABLE IF NOT EXISTS users
	(
		id_user INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
		login VARCHAR(32) NOT NULL,
		password VARCHAR(128) NOT NULL,
		email VARCHAR(512) NOT NULL,
		email_confirmed ENUM ('yes', 'no') DEFAULT 'no' NOT NULL,
		admin ENUM ('yes', 'no') DEFAULT 'no' NOT NULL
	);", "Users");
// $database->query(
// 	"CREATE TABLE IF NOT EXISTS filter
// 	(
// 		id_filter INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
// 		filter VARCHAR(128)
// 	);");
$database->query(
	"CREATE TABLE IF NOT EXISTS picture
	(
		id_picture INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
		path_picture VARCHAR(512),
		login VARCHAR(32),
		date DATETIME
	);");
$database->query(
	"CREATE TABLE IF NOT EXISTS commentary
	(
		id_com INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
		id_picture INT NOT NULL,
		login VARCHAR(32),
		commentary VARCHAR(512),
		date DATETIME
	);");
$database->query(
	"CREATE TABLE IF NOT EXISTS `like`
	(
		id_like INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
		id_picture INT NOT NULL,
		login VARCHAR(32),
		date DATETIME
	);");
?>
