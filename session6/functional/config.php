<?php
/*
	Конфигурационен файл само за променливи свързани с базата.
*/

$db_host = '127.0.0.1'; 	// или localohst
$db_name = 'session5'; 	// Име на базата данни
$db_user = 'root';			// MySQL потребител
$db_pass = 'a';			// MySQL парола
$db_charset = 'utf8';

$dsn = "mysql:host=" . $db_host . ";dbname=$db_name;charset=$db_charset";