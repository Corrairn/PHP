<h1>It works!</h1>

<?php
// Едноредов коментар

/*
	Коментар
	на няколко
	реда
*/

// Интегриране на php скрипт в уеб страница.

echo "<h2>Hello world!</h2>"; // Показва Hello world! на екрана.

?>

<p>Lorem ipsum dolor sit amet</p>

<?php
/*
	Оператори

	Оператор за присвояване.
*/

$integer = 10; // Присвояване на стойноцтта 10 към променливата $integer.

echo $integer; // Извежда 10

echo "<br/>";

/**
	Аритметични оператори.

	+ събиране
	- изваждане
	* умноцение
	/ деление
	% целочислено деление
*/

echo 13 % 5; // Показва стойността от целочисленото деление на 13 на 5. Или остатъка, който получаваме като разделим 13 на 5.

echo "<br/>";
/*
	Оператори за сравняване

	a == b 	равно
	a != b  различно
	a > b 	по-голямо
	a < b 	по-малко
	a >= b  по-голпямо или равно 
	a <= b  по-малко или равно
*/

var_dump( 5 != 6 ); // Извежда дали 5 е различно от 6 на екрана потипово boolean(FALSE)

echo "<br/>";

/*
	Оператор за присвояване
*/
$var1 = "Hello"; // Присвоява низа "Hello" на променливата $var1
$var2 = "World";

/*
	Опаратор за конкатенация (слепване)
*/
echo $var1 . " " . $var2; // Конкатенира $var1 с " " (blank space) и с $var2. Извежда на екрана "Hello World".

echo "<br/>";

/*
	Оператор за управление на грешките
*/

echo @$my_var; // Подтиска Notice грешката, защото $my_var променливата не е дефинирана.

/*
	Контролни структури

	If / Else If / Else конструкция
*/

$var1 = 10;

if ($var1 == 5) { // Проверява дали $var1 е равно на 5 и изпълнява блока във фигурните скоби.

} else if ($var1 > 50) { // Иначе проверява дали $var1 е по-голямо от 50 и изпълнява блока във фигурните скоби.

} else { // Иначе (тук достигаме ако всички останали клаузи са FALSE) изпълнява блока във фигурните скоби.
	
}