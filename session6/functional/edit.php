<?php
/* Показване на всички грешки */
ini_set('error_reporting', E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('html_errors', TRUE);

// Включване на config.php
include './config.php';

$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $db_user, $db_pass, $opt);

// Проверка дали подаваме редактирани данни на потребители.
if(!empty($_POST['id'])) {
	// По ID-то ще се ориентираме кой е портебителя, а $_POST['username'] и $_POST['password'] са данните, които ще заместят старите.

	updateUser($_POST['id'], $_POST['username'], $_POST['password']); // Обновяване на потребителя
}

$users = fetchUsers();

?>
<table>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Pass</th>
	</tr>
	<?php
		// Цикъл за извеждането на всички записи от базата.
		foreach ($users as $user) {
			// Зареждане на User обект от данните взети от БД.
		?>
		<tr>
			<td><?php echo $user['ID']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<!-- Навигация за edit формата -->
			<td><a href="?id=<?php echo $user['ID']; ?>">Edit</a></td>
		</tr>	
		<?php
		}
	?>
</table>

<?php

// Подаваме ID-то на потребителите по GET с цел да заредим $user обект и да покажем формата за редакция.
if(!empty($_GET['id'])) {
	$loaded_user = loadUser($_GET['id']);
?>
<form method="POST" action="edit.php">
	<input type="text" name="username" placeholder="Username" value="<?php echo $loaded_user['username']; ?>" required />
	<input type="text" name="password" placeholder="Password" value="<?php echo $loaded_user['password']; ?>" required />
	<input type="hidden" name="id" value="<?php echo $loaded_user['ID']; ?>" />
	<input type="submit" name="submit" value="Save" />
</form>
<?php
}

/*
	Функция за взимане на всички потребители от базата.
*/
function fetchUsers() {
	global $pdo;

	$stmt = $pdo->query('SELECT * FROM users ORDER BY `ID` DESC');

	return $stmt->fetchAll();
}

/*
	Функция за взимане само на един потребител по ID.
*/
function loadUser($id) {
	global $pdo;

	$stmt = $pdo->query("SELECT * FROM users WHERE `ID` = {$id}");

	$result = $stmt->fetchAll();

	return $result[0];
}

/*
	Функция за обновяване на данните на потребител.
*/
function updateUser($id, $username, $password) {
	global $pdo;

	$query =
		"UPDATE
			users
		SET
			`username` = '{$username}',
			`password` = '{$password}'
		WHERE
			`ID` = {$id};";

	$pdo->query($query);
}