<?php
/* Показване на всички грешки */
ini_set('error_reporting', E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('html_errors', TRUE);

/* Включване на сорс файла на User класа */
include './User.php';

// Проверка дали подаваме редактирани данни на потребители.
if(!empty($_POST['id'])) {
	$user = new User($_POST['id'], $_POST['username'], $_POST['password']); // Инстанциране на нов обект с подадените ни ID, име и парола.

	// По ID-то ще се ориентираме кой е портебителя, а $_POST['username'] и $_POST['password'] са данните, които ще заместят старите.

	$user->update(); // Обновяване на потребителя

	
	/*
	Syntax sugar за тези които искат да пробват нови неща :)

	(new User($_POST['id'], $_POST['username'], $_POST['password']))->update();
	*/
}

$users = fetchUsers();

/*
	Помощна функция за взимане на всички потребители от базата.
*/
function fetchUsers() {
	// Включване на config.php
	include './config.php';
	
	$opt = [
	    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	    PDO::ATTR_EMULATE_PREPARES   => false,
	];
	$pdo = new PDO($dsn, $db_user, $db_pass, $opt);

	$stmt = $pdo->query('SELECT * FROM users ORDER BY `ID` DESC');
	return $stmt->fetchAll();
}

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
			<!-- Навигация за edit формата -->
			<td><a href="?id=<?php echo $user->getId(); ?>">Edit</a></td>
		</tr>	
		<?php
		}
	?>
</table>

<?php

// Подаваме ID-то на потребителите по GET с цел да заредим $user обект и да покажем формата за редакция.
if(!empty($_GET['id'])) {

	echo "<pre>";
	$loaded_user = new User($_GET['id']); // Зареждаве мече съществуващ потребител.
	echo "</pre>";
?>
<form method="POST" action="edit.php">
	<input type="text" name="username" placeholder="Username" value="<?php echo $loaded_user->getName(); ?>" required />
	<input type="text" name="password" placeholder="Password" value="<?php echo $loaded_user->getPass(); ?>" required />
	<input type="hidden" name="id" value="<?php echo $loaded_user->getId(); ?>" />
	<input type="submit" name="submit" value="Save" />
</form>
<?php
}