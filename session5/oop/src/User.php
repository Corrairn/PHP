<?php
/*
	Class User

	Структурира и обработва данните на потребителя.
*/
class User {
	private $id;	// ID номер
	private $name;	// Потребителско име
	private $pass;	// Парола

	public function __construct($id, $name, $pass) {
		$this->id = $id;
		$this->name = $name;
		$this->pass = $pass;
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
		Проверява дали паролата на потребителя е валидна и ако е, го записва в базата. Извежда съобщение в противен случай.
	*/
	public function insert($pdo) {
		if ($this->isPasswordValid()) {
			$query = 
			"INSERT INTO users
				(`ID`, `username`, `password`)
			VALUES
				(NULL, '{$this->name}', '{$this->pass}')";

			$pdo->query($query);

			echo "The user has been saved to the DB."; // В идеалният случай - да. Ще разберем по-нататък как може да го проверим това.
		}
		else {
			echo "The password is not valid. User can not be saved.";
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
