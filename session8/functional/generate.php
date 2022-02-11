<?php

include "./config.php";

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
	$query = 
		"INSERT INTO users
			(`ID`, `username`, `password`)
		VALUES
			(NULL, :username, :password)"; // Конструиране на заявката за вкарване на потребител.
	$stmt = $pdo->prepare($query); // Подготвяне на заявката
	$stmt->bindParam(':username', $username); // Задаване на параметрите; username
	$stmt->bindParam(':password', $password); // и password

	// Веднъж подготвен statement-a приема автоматични промените в $username и $password променливите, което е изключително удобно за нашите цели, и ги подавава когато бъде изпълняван.

	for($i = 0; $i < $number; $i++) {
		$username = rand(1, 10000); // Генериране на произвлно потребителско име, за по-лесно произволно число от 1 до 10000.
		$password = $username . "_PASS"; // "Генериране" на парола, която е свързана по някакъв начин с потребителското име.

		$stmt->execute(); // Записване на потребителя в базата.
	}

	echo "Generated {$number} users.";
}