<?php

/**
* 
*/
class Vehicle
{
	public $wheels;
	public $engine;
	public $type;

	protected $id;
	
	function __construct($id)
	{
		$this->id = $id;
	}

	public function getData() {
		return "The data";
	}
}

/**
* 
*/
class Car extends Vehicle
{
	
	public function __construct($id)
	{
		parent::__construct($id);
	}
}

echo "<pre>";
$car = new Car(1234);

var_dump($car);

echo $car->getData();