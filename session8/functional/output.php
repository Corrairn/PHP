<?php

/* Показване на всички грешки */
ini_set('error_reporting', E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('html_errors', TRUE);

/* Включване на config.php и сорс файла на User класа */
include './config.php';

$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt); // Инстанциране на PDO обкта за връзка за базата

// Обработка на POST масива.
if(!empty($_POST['name']) && !empty($_POST['password'])) {
	$query = 
		"INSERT INTO users
			(`ID`, `username`, `password`)
		VALUES
			(NULL, ?, ?)"; // Конструиране на заявката за вкарване на потребител с позиционни параметри.
	pre_dump($query);

	$stmt = $pdo->prepare($query); // Подгорвяне на заявката.
	$stmt->bindParam(1, $_POST['name']); // Закачане на първият параметър - username
	$stmt->bindParam(2, $_POST['password']); // и на вторият - password.

	$stmt->execute(); // Изпълняване на заявката.
}

// Заявка за взимане на всички потребители от базата.
$stmt = $pdo->query('SELECT * FROM users ORDER BY `ID` DESC');
$users = $stmt->fetchAll();

?>
<table>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Pass</th>
	</tr>
	<?php
		// Цикъл за извеждането на всички записи от базата.
		foreach ($users as $record) {
		?>
		<tr>
			<td><?php echo $record["ID"]; ?></td>
			<td><?php echo $record["username"]; ?></td>
			<td><?php echo $record["password"]; ?></td>
		</tr>	
		<?php
		}
	?>
</table>

<?php

function pre_dump($data) {
	echo "<pre>";
	var_dump($data);
	echo "</pre>";
}
