<?php

/* Оъсществяване на връзка с DB сървъра */

$host = '127.0.0.1'; 	// localohst // IP или FQDN 
$db   = 'work'; 		// Име на желаната база
$user = 'root'; 		// MySQL потребител
$pass = '';				// MySQL парола на потребителя
$charset = 'utf8';		// Колация, обикновено ще е UTF-8

$dsn = "mysql:host={$host};dbname={$db};charset={$charset}";

$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO($dsn, $user, $pass, $opt); // Инстанциитане на PDO обект

$stmt = $pdo->query('SELECT * FROM users'); // Изпращане на заявка към базата с query метода

$rows = $stmt->fetchAll(); // Взимане на всички резултати върнати от заявката.

echo "<pre>";
var_dump($rows);
echo "</pre>";