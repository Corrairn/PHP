<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('html_errors', TRUE);


/* Scope на използване и наследяване */

// Класът Person e базов за дефинираните по-късно Manager и Developer
class Person {
	/*
		Параметрите и методите по подразбиране се дефинират public т.e.
			public $var;
		е равносилно на 
			var $var;
		и
			public function myFunc()
		е равносилно на 
			function myFunc()
	*/

	public $gender;
	public $skillSet;

	protected $names;

	private $id;

	/* Конструкторите трябва да са публични функции, иначе няма да може да инстанциираме обекти */
	public function __construct($id, $names) {
		$this->id = $id;
		$this->names = $names;
	}

	/*
		Публичните фунции ще будат наследени със същия scope, и предоставят възможност да се манипулират private параметри на обектите.
		В случая искаме да дадем достъп за "гелдане" до параметъра $id.
	*/
	public function getId() {
		return $this->id;
	}

	/*
		Методът за смяна на $id параметъра искаме да може да бъде извикван от децата на Person класа.
	*/
	protected function setId($id) {
		$this->id = $id;
	}
}


class Manager extends Person {

	/*
		Искаме само мениджърите да могат да си сменят $id параметъра, ако естествено премине валидацията ни.
	*/
	public function changeID($id) {
		if(is_numeric($id) && !empty($id) && strlen($id) == 5) {
			$id = (int) $id;

			//$this->id = $id; // Понеже $id параметъра е private не може да го променяме, дори и от наследниците на Person
			$this->setId($id); // 
		}
		else {
			echo "The ID is not valid and won't be changed!";
		}
	}
}


class Developer extends Person {

}

$manager = new Manager(1234, 'Victor Lazov');

$manager->gender = "М"; // Публичните параметри може да ги взимаме изадаваме отвсякъде.

//$manager->setId(98765); // Защитените (protected) методите не могат да бъдат извиквани отвсякъде, а само вътрешно от обектите.

echo "<pre>";
var_dump($manager);
echo "</pre>";

$manager->changeID(9876); // Про

echo "<pre>";
//var_dump($manager->id); // Ако се опиртаме да досъпим private параметър или метод извън обекта ще получим грешка
var_dump($manager->getId()); // Затова направихме публичен метод, който ни връща $id параметъра.
echo "</pre>";

echo "<pre>";
var_dump($manager);
echo "</pre>";