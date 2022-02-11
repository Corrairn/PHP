<?php
/*
	Class User

	Структурира и обработва данните на потребителя.
*/
class User {
	private $id;	// ID номер
	private $name;	// Потребителско име
	private $pass;	// Парола

	private $pdo;	// PDO обект за работа с DB

	/*
		Конструктор на User класа.

		Ако има подадено $id - зарежда потребител от базата данни.
		Ако имаме подадени $name или $pass ги заместваме, защото може да искаме да обновим потребителя.
	*/
	public function __construct($id, $name = NULL, $pass = NULL) {
		$this->initPDO();

		if(!empty($id)) {
			$this->id = $id;
			$this->load();
		}

		if(!empty($name)) {
			$this->name = $name;
		}

		if(!empty($pass)) {
			$this->pass = $pass;
		}
	}

	/*
		Инстанцира PDO обект за работа с DB и го присвоява на pdo пропъртито.
	*/
	private function initPDO() {
		include './config.php';
		$opt = [
		    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		    PDO::ATTR_EMULATE_PREPARES   => false,
		];
		$this->pdo = new PDO($dsn, $db_user, $db_pass, $opt);
	}

	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function getPass() {
		return $this->pass;
	}

	/*
		Зарежда потербител от базата данни, при подадено ID.
		Ако потребител с такова ID не е намерен - не прави нищо.
	*/
	public function load() {
		if(!empty($this->id)) {
			$query = "SELECT * FROM users WHERE `ID` = {$this->id};";

			try { // За по-сложни грешки ни трябва try / catch конструкция.
				$stmt = $this->pdo->query($query);
			}
			catch (PDOException $e) {
				echo "No user loaded due to fatal error." . $e->getMessage();
				return FALSE;
			}

			$result = $stmt->fetchAll();

			if(empty($result)) {
				return FALSE;
			}

			$this->name = $result[0]['username'];
			$this->pass = $result[0]['password'];
		}
	}

	/*
		Проверява дали паролата на потребителя е валидна и ако е, го записва в базата. Извежда съобщение в противен случай.
	*/
	public function insert() {
		if ($this->isPasswordValid()) {
			$query = 
			"INSERT INTO users
				(`ID`, `username`, `password`)
			VALUES
				(NULL, '{$this->name}', '{$this->pass}')";

			$this->pdo->query($query);

			echo "The user has been saved to the DB."; // В идеалният случай - да. Ще разберем по-нататък как може да го проверим това.
		}
		else {
			echo "The password is not valid. User can not be saved.";
		}
	}

	/*
		Обновява потребител ако е подадено ID и ако паролата премине валидацията.
	*/
	public function update() {
		if(!empty($this->id)) {
			if ($this->isPasswordValid()) {
				$query = 
				"UPDATE
					users
				SET
					`username` = '{$this->name}',
					`password` = '{$this->pass}'
				WHERE
					`ID` = {$this->id};";

				try { // За по-сложни грешки ни трябва try / catch конструкция.
					$stmt = $this->pdo->query($query);

					if($stmt->rowCount() > 0) { // Проверяваме колко реда са засегнати от заявката. Ако са повече от 0 - ОК.
						echo "The user has been updated."; // В идеалният случай - да. Ще разберем по-нататък как може да го проверим това.
					}
					else {
						echo "No user updated due to unknown reason.";
					}
				}
				catch (PDOException $e) { // За по-сложни грешки ни трябва try / catch конструкция.
					echo "No user updated due to fatal error." . $e->getMessage();
				}

			}
			else {
				echo "The password is not valid. User can not be updated.";
			}
		}
		else {
			echo "The user is new. Please use insert.";
		}
	}

	/*
		Проверява дали паролата на потребителя е валидна. Връща TRUE ако е, FALSE в противен случай.
	*/
	public function isPasswordValid() {
		// More than 6 characters.
		if(strlen($this->pass) <= 6) {
			return FALSE;
		}

		// At least 1 uppercase letter.
		if(preg_match('/[A-Z]/', $this->pass) == FALSE) {
			return FALSE;
		}

		$evenNumbers = [2,4,6,8];
		$hasEvenNumbers = [];
		for($i = 0; $i < strlen($this->pass); $i++) {
			$char = $this->pass[$i];
			if(in_array($char, $evenNumbers)) {
				@$hasEvenNumbers[$char]++;
			}
		}

		// Has all even numbers from 1 to 9.
		if(count($hasEvenNumbers) != 4) {
			return FALSE;
		}

		return TRUE;
	}
}