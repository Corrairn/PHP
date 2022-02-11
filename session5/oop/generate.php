<?php
/* Включване на config.php и сорс файла на User класа */
include './config.php';
include './src/User.php';

$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt); // Инстанциране на PDO обкта за връзка за базата

if(!empty($_POST['number']) && filter_var($_POST['number'], FILTER_VALIDATE_INT) !== FALSE) {
	echo "Generating...";
	generateUsers($_POST['number'], $pdo);
}

?>

<form method="POST" action="#">
	<input type="text" name="number" />
	<input type="submit" value="Generate" />
</form>

<?php

/*
	Функция, която генерира потребителски имена и пароли и ги записва в базата.
	Приема:
		$number 	- борят потребители
		$pdo 		- PDO обект за работа с DB
*/
function generateUsers($number, $pdo) {
	for($i = 0; $i < $number; $i++) {
		$name = rand(1, 10000); // Генериране на произвлно потребителско име, за по-лесно произволно число от 1 до 10000.
		$pass = $name . "_PASS"; // "Генериране" на парола, която е свързана по някакъв начин с потребителското име.

		$user = new User(NULL, $name, $pass); // Инстанциране на нов обект от тип User.
		$user->insert($pdo); // Записване на потребителя в базата.
	}

	echo "Generated {$number} users.";
}