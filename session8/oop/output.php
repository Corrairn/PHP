<?php
/* Показване на всички грешки */
ini_set('error_reporting', E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('html_errors', TRUE);

/* Включване на config.php и сорс файла на User класа */
include './config.php';
include './User.php';

$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt); // Инстанциране на PDO обкта за връзка за базата

// Обработка на POST масива.
if(!empty($_POST)) {
	$user = new User(NULL, $_POST['name'], $_POST['password']); // Създаване на нов обект от тип User.

	pre_dump($user);

	$user->insert($pdo); // Добавяне на потребителя в базата данни.
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
			// Зареждане на User обект от данните взети от БД.
			$user = new User($record['ID'], $record['username'], $record['password'])
		?>
		<tr>
			<td><?php echo $user->getId(); ?></td>
			<td><?php echo $user->getName(); ?></td>
			<td><?php echo $user->getPass(); ?></td>
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
