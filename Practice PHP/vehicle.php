<?php
// Define the Vehicle interface
interface Vehicle {
    public function calculateFuelEfficiency();
    public function calculateMaintenanceCost();
}

// Define the abstract class LandVehicle
abstract class LandVehicle implements Vehicle {
    protected $numberOfWheels;
    protected $fuelType;

    public function __construct($numberOfWheels, $fuelType) {
        $this->numberOfWheels = $numberOfWheels;
        $this->fuelType = $fuelType;
    }

    public function displayInfo() {
        return "This vehicle has " . $this->numberOfWheels . " wheels and uses " . $this->fuelType . " fuel.";
    }
}

// Define the Car class
class Car extends LandVehicle {
    private $mileage;

    public function __construct($numberOfWheels, $fuelType, $mileage) {
        parent::__construct($numberOfWheels, $fuelType);
        $this->mileage = $mileage;
    }

    public function calculateFuelEfficiency() {
        return "The car's fuel efficiency is " . $this->mileage . " miles per gallon.";
    }

    public function calculateMaintenanceCost() {
        return "The car's maintenance cost is $" . ($this->numberOfWheels * 50);
    }
}

// Define the Truck class
class Truck extends LandVehicle {
    private $loadCapacity;

    public function __construct($numberOfWheels, $fuelType, $loadCapacity) {
        parent::__construct($numberOfWheels, $fuelType);
        $this->loadCapacity = $loadCapacity;
    }

    public function calculateFuelEfficiency() {
        return "The truck's fuel efficiency depends on its load capacity of " . $this->loadCapacity . " tons.";
    }

    public function calculateMaintenanceCost() {
        return "The truck's maintenance cost is $" . ($this->numberOfWheels * 100);
    }
}

// Example usage
$car = new Car(4, "gasoline", 25);
echo $car->displayInfo();  // Output: This vehicle has 4 wheels and uses gasoline fuel.
echo $car->calculateFuelEfficiency();  // Output: The car's fuel efficiency is 25 miles per gallon.
echo $car->calculateMaintenanceCost();  // Output: The car's maintenance cost is $200.
echo "<br>";
$truck = new Truck(18, "diesel", 10);
echo $truck->displayInfo();  // Output: This vehicle has 18 wheels and uses diesel fuel.
echo $truck->calculateFuelEfficiency();  // Output: The truck's fuel efficiency depends on its load capacity of 10 tons.
echo $truck->calculateMaintenanceCost();  // Output: The truck's maintenance cost is $1800.
?>
