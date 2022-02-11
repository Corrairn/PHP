<?php
/*
	Конфигурационен файл само за променливи свързани с базата.
*/

$host = '127.0.0.1'; 	// или localohst
$db   = 'session5'; 	// Име на базата данни
$user = 'root';			// MySQL потребител
$pass = 'a';			// MySQL парола
$charset = 'utf8';

$dsn = "mysql:host=" . $host . ";dbname=$db;charset=$charset";
