<?php

/* Обекти - дефиниция и инстанциране */

// Дефиниция на класа SimplaCar
class SimpleCar {
	// Параметери - properties.

	// Параметрите се дефинират като променливи в обхвата на класа
	var $wheels = 4; // Стойност по подразбиране на параметъра.
	var $engine;
	var $model;
	
	// Конструктор
	function __construct($car_model, $car_engine) {
		// Параметрите подадени на конструктора задават стойностите на параметрите на инстанцитаните обекти.
		$this->model = $car_model; // Параметрите на класа се достъпват без $
		$this->engine = $car_engine;
	}

	/* Методи на класа. */

	/*
		Връща боря на колелетата на SimpleCar заедно с обяснителен текст.
	*/
	function getWheels() {
		return "The car has " . $this->wheels . " wheels.";
	}

	/*
		Връща типа двигател на SimpleCar заедно с обяснителен текст.
	*/
	function getEngine() {
		return "The engine is: " . $this->engine;	
	}

	/*
		Връща модела на SimpleCar заедно с обяснителен текст.
	*/
	function getModel() {
		return "Car's model is: : " . $this->model;
	}

	/*
		Връща цялостните данни на SimpleCar, като последователно конструира обяснителен текст.
		Изпозлва методите getModel(), getEngine() и getWheels()
	*/
	function getFullData() {
		$output = "<h1>Full car data</h1>";

		$output .= "<p>" . $this->getModel() . "</p>"; // Извикване на метод на класа.

		$output .= "<p>" . $this->getEngine() . "</p>";

		$output .= "<p>" . $this->getWheels() . "</p>";

		return $output;
	}
}

// Създаване на инстанция (обект) от тип SimpleCar
$myCar = new SimpleCar("BMW", "V12");
$otherCar = new SimpleCar("Ikarus", "V400");

echo "<pre>";
var_dump($myCar);
var_dump($otherCar);
echo "</pre>";

/* Наследяване */

// Дефиниця на класа Vehicle (превозно средство)
class Vehicle {
	// Параметери - properties.
	var $type; // Типа на превозното средство може да е Car, Bike, Bus и т.н.

	var $wheels; // За разлика от SimpleCar тук стойността по подразбиране не е зададена.
	var $engine;
	var $model;
	var $color;
	var $seats;
	var $doors;

	// Конструктор, който задава само типа на превозното средство.
	function __construct(string $type) {
		$this->type = $type;
	}

	/* Методи на класа. */

	/*
		Връща модела на Vehicle заедно с обяснителен текст.
	*/
	function getType() {
		return "Vehicle's type is: : " . $this->type;
	}

	/*
		Връща боря на колелетата на Vehicle заедно с обяснителен текст.
	*/
	function getWheels() {
		return "The vehicle has " . $this->wheels . " wheels.";
	}

	/*
		Връща типа двигател на Vehicle заедно с обяснителен текст.
	*/
	function getEngine() {
		return "The engine is: " . $this->engine;	
	}

	/*
		Връща модела на Vehicle заедно с обяснителен текст.
	*/
	function getModel() {
		return "Vehicle's model is: : " . $this->model;
	}

	/*
		Връща цялостните данни на Vehicle, като последователно конструира обяснителен текст.
		Изпозлва методите getType(), getModel(), getEngine() и getWheels()
	*/
	function getFullData() {
		$output = "<h1>Full vehicle data</h1>";

		$output .= "<p>" . $this->getType() . "</p>"; // Извикване на метод на класа.

		$output .= "<p>" . $this->getModel() . "</p>";

		$output .= "<p>" . $this->getEngine() . "</p>";

		$output .= "<p>" . $this->getWheels() . "</p>";

		return $output;
	}
}

// Класът Car наследява Vehicle, като приема всичките му параметри и методи.
class Car extends Vehicle {
	
	function __construct($car_model, $car_engine) {
		// Конструкторът на Car класа авотматично предава стойността 'car' на конструктора на неговият баща - Vehicle
		parent::__construct('car');

		// И добавя автоматично стойността 4 за колелета.
		$this->wheels = 4;
		$this->model = $car_model;
		$this->engine = $car_engine;
	}
}

$complexCar = new Car();
echo "<pre>";
var_dump($complexCar);
echo "</pre>";

echo $complexCar->getFullData();

// Класът Bike наследява Vehicle, като приема всичките му параметри и методи.
class Bike extends Vehicle {

	function __construct(int $bike_wheels, string $bike_model) {
		parent::__construct('bike');

		$this->wheels = $bike_wheels;
		$this->model = $bike_model;
	}

	/*
		Методът getFullData() предефинира логиката на наследеният от Vehicle метод, понеже имаме много по-малко параметри, а може да искаме да вмъкнем и по-специфична логика.
	*/
	function getFullData() {
		$output = "<h1>Full bike data</h1>";

		$output .= "<p>" . $this->getModel() . "</p>";

		$output .= "<p>" . $this->getWheels() . "</p>";

		return $output;
	}

	/*
		Пренаписва метода getWheels()
		Връща боря на колелетата на Bike заедно с обяснителен текст.
	*/
	function getWheels() {
		return "The bike has " . $this->wheels . " wheels.";
	}

	/*
		Пренаписва метода getModel()
		Връща модела на Bike заедно с обяснителен текст.
	*/
	function getModel() {
		return "Bike's model is: : " . $this->model;
	}
}

$bike = new Bike(2, "Drag");

echo "<pre>";
var_dump($bike);
echo "</pre>";

echo $bike->getFullData();