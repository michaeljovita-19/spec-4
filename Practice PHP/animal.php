<?php

declare(strict_types=1);

class Animal{
	protected string $name;
	protected int $age;
	protected string $gender;

	public function  __construct(string $name, int $age, string $gender){
		$this->name = $name;
		$this->age = $age;
		$this->gender = $gender;
	}

	public function  getName(): string{
		return $this->name;
	}

	public function  setName(string $name): void{
		$this->name = $name;
	}

	public function  getAge(): int{
		return $this->age;
	}

	public function  setAge(int $age): void{
		$this->age = $age;
	}

	public function  getBreed(string $gender): string{
		return $this->gender;
	}

	public function  setGender(string $gender): void{
		$this->gender = $gender;
	}

	public function makeSound(){
		echo "Make the animals sound.";
	}

	public function display(){
		echo "Animal Name: " .$this->name. "<br>Animal Age: " .$this->age. "<br>Animal Gender: " .$this->gender. "<br>";
	}
}

class Dog extends Animal{
	private bool $isIndoor;

	public function __construct(string $name, int $age, string $gender, bool $isIndoor){
		parent::__construct($name, $age, $gender);
		$this->isIndoor = $isIndoor;
	}

	public function makeSound(): void{
		echo "Dog say's woof";
	}
}

class Cat extends Animal{
	private bool $isTrained;

	public function __construct(string $name, int $age, string $gender, bool $isTrained){
		parent::__construct($name, $age, $gender);
		$this->isTrained = $isTrained;
	}

	public function makeSound(): string{
		return "Cat say's meow";
	}
}

class Shelter{
	public array $animals = [];

	public function addAnimal(Animal $animal): void{
		$this->animals[] = $animal;
	}

	public function showAnimals(): void{
		foreach($this->animals as $animal){
			echo $animal->display();
			echo "<br>";
		}
	}

	public function showAnimalSound(): void{
		foreach ($this->animals as $animal){
			echo $animal->makeSound();
			echo "<br>";
		}
	}
}

$shelter = new Shelter();

$shelter->addAnimal(new Cat("Michael", 20, "Male", true));
$shelter->addAnimal(new Dog("Glaiza", 20, "Female", false));

echo "__________________________________________________________________________________________<br>";
$shelter->showAnimals();
$shelter->showAnimalSound();
echo "__________________________________________________________________________________________";