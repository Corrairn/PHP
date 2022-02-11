<?php

/* Runtime настройка за показване на грешките. */

ini_set('error_reporting', E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('html_errors', TRUE);

define("WWW_SERVER_NAME", "example.com"); // Дефиниране на константа.

var_dump(WWW_SERVER_NAME);

$result = "Hello World"; // Дефиниране на променлива.

$result = "123457890"; // Променяне на стойността на променливата $result

var_dump($result);

$integer = (int) $result; // Приваждане на променливата $result в тип integer.

var_dump($integer);

/* Контролни структури */

/* if / else if / else конструкция */

if (is_string($integer)) { // Просто условие.
	echo "I am a string";
} else if (is_integer($integer)) {
	echo "I am an integer";
} else {
	echo "I don't know what am I";
}

if (is_integer($integer) && $integer > 100) { // Сложно условие, && e логически оператор който изисква и двете прости условия да са верни, за да влезе в тялото на клаузата. Повече за логическите оператори може да прочетете тук: https://secure.php.net/manual/en/language.operators.logical.php
	echo "I am integer bigger than 100";
}

/* switch конструкция */
switch ($integer) {
	case 100:
		# code...

	case 1000:
		# code...
		break;
	
	default:
		# code...
		break;
}

echo "<hr/>";

/* Цикли */

/* while и do / while цикли */
$i = 0;

do {
	echo $i;
	$i++; // Not equal $a + $b
} while ( $i <= 10);

while ( $i <= 10) {
	# code...
}

echo "<hr/>";

/* for цикъл */
$text = "Hello World";
for ($i=0; $i < strlen($text); $i++) { // Тук цикълът започва от 0, до дължината на низа $text, инкрементитайки се с 1.
	if($text[$i] == " ") { // Ако $i-тият елемент на $text низа е равен на " " (space).
		continue; // Продължаваме изпълнението на цикъла.
	}

	var_dump($text[$i]);
}

echo "<hr/>";

/* foreach цикъл */
$variable = [1, 2, 3, 4, 5];
foreach ($variable as $key => $value) {
	var_dump($value);
}

echo "<hr>";

/* Масиви */

$arr = [1, 5, 10, 15, "Hello"]; // Дефиниране на масив с целочислени индекси.
$arr[] = "World"; // Добавяне на елсемнт към масива $arr.
var_dump($arr);

echo "<hr>";

$fruits = [
	'apple' => 'red',
	'mango' => 'brown',
]; // Дефиниране на асоциативен масив.


var_dump($fruits);

echo "<hr>";

foreach ($fruits as $key => $value) {
	echo "{$key} is {$value} <br/>"; // Печатане на низ с вградени променливи. Става само с двойни кавички.
}

echo "<hr>";
/* Многомерни масиви */

$multi = [
	[1,2,3,4],
	[5,6,7,8],
	[9,0]
]; // Дефиниране на двумерен масив (матрица).

$multi[] = ['a', 'b', 'c']; 

$multi[1] = ['f', 'g', 'h']; // Променяне на елемента с индекс 1 в масива $multi.

unset($multi[1]); // Премахване на елемента с индекс 1 от масива $multi.

echo "<pre>";
var_dump($multi);
echo "</pre>";

echo "<hr>";

$merged_array = array_merge($multi[0], $multi[2]); // Слепване на два масива.
var_dump($merged_array);

echo "<hr>";

/* Функции */

/**
	Дефиниране на функцията drinkBeer с параметри:
	 - $number от тип integer
	 - $name от тип string
	Фукцията е дефинирана, така че да връща стойност от тип string
*/
function drinkBeer(int $number, string $name): string {
	$result = "I want to drink {$number} {$name} beers";

	return $result;
	//return 11; // Проверете каква стойност връща функцията в този случай
}

$result = drinkBeer(10, 'Kamenitza'); // Извикване на функцията drinkBeer с определени параметри.

var_dump($result);

echo "<hr>";

$result = function() { // Дефиниране на анонимна функция. Анонимните функции имат най-голямо изпозване като callback параметри. Повече http://php.net/manual/en/functions.anonymous.php
	return "I am cool!";
};

var_dump($result());

echo "<hr>";

/*
	Пример за функция, която приема callable аргумент.
	
	Функцията array_walk прилага наша функция върху подаден масив

	http://php.net/manual/en/function.array-walk.php
*/

$numbers = [1, 2, 3, 4, 5, 6, 7, 16, 9, 723645]; // Нека имаме един масив от числа 


// Искаме към всчко число да долепим низ, описващ дали то е четно или нечетно.
array_walk($numbers, function(&$item) { // Дефинираме анонимна функция, коят директно подаваме на array_walk
	if($item % 2 == 0) { // Ако е четно
		$item .= " is even";
	}
	else { // Ако е нечетно
		$item .= " is odd";	
	}
});

var_dump($numbers);

echo "<hr>";