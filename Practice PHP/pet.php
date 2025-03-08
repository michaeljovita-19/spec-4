<?php
declare(strict_types=1);

class Pet{
    protected string $name;
    protected int $age;
    protected string $breed;
    protected float $adoptionFee;

    public function __construct(string $name, int $age, string $breed, float $adoptionFee){
        $this->name = $name;
        $this->age = $age;
        $this->breed = $breed;
        $this->adoptionFee = $adoptionFee;
    }

    public function getDetails(): string{
        return "Pet Name: $this->name <br>Pet Age: $this->age <br>Pet Breed: $this->breed <br>Adoption Fee: $this->adoptionFee<br>";
    }

    public function calculateAdoptionFee(): float{
        return $this->adoptionFee;
    }

    public function makeSound(): string{
        return "Make animal sound.";
    }
}

class Dog extends Pet{
    private bool $isTrained;

    public function __construct(string $name, int $age, string $breed, float $adoptionFee, bool $isTrained){
        parent::__construct($name, $age, $breed, $adoptionFee);
        $this->isTrained = $isTrained;
    }

    public function getDetails(): string{
        return parent::getDetails(). "Training Status: ". ($this->isTrained ? "Trained<br>" : "Not Trained<br>");
    }

    public function makeSound(): string{
        return "aw aw!";
    }
}

class Cat extends Pet{
    private $isIndoorOnly;

    public function __construct(string $name, int $age, string $breed, float $adoptionFee, bool $isIndoorOnly){
        parent::__construct($name, $age, $breed, $adoptionFee);
        $this->isIndoorOnly = $isIndoorOnly;
    }

    public function getDetails(): string{
        return parent::getDetails(). "Is Indoor Only: ". ($this->isIndoorOnly ? "Indoor Only<br>": "Not Indoor<br>");
    }

    public function makeSound(): string{
        return "meow meow!";
    }
}

class PetShelter{
    private array $pets = [];

    public function addPet(Pet $pet): void{
        $this->pets[] = $pet;
    }

    public function showPets(): void{
        foreach($this->pets as $pet){
            echo $pet->getDetails(). "\n";
            echo "<br>";
        }
    }

    public function showPetSounds(): void{
        foreach($this->pets as $pet){
            echo $pet->makeSound(). "\n";
        }
    }

    public function calculateAdoptionFee(): float{
        $total = 0;
        foreach($this->pets as $pet){
            $total += $pet->calculateAdoptionFee();
        }
        return $total;
    }

    public function showPetCount(): int{
        return count($this->pets);
    }

    public function getPetInventory(): array{
        return $this->pets;
    }
}

$shelter = new PetShelter();

$shelter -> addPet(new Dog("Tommy", 2, "German Shepherd", 1000, true));
$shelter -> addPet(new Cat("Kitty", 1, "Persian", 500, true));
$shelter -> addPet(new Dog("Buddy", 3, "Labrador", 1500, false));
$shelter -> addPet(new Cat("Misty", 2, "Siamese", 700, false));

echo "Pet Inventory: \n";
echo "<br>";
echo "-------------------\n";
echo "<br>";
echo "Pet Details: \n";
echo "<br>";
$shelter->showPets();
echo "Total Pets: ". $shelter->showPetCount(). "\n";
echo "<br>";
echo "Total Adoption Fee: ". $shelter->calculateAdoptionFee(). "\n";
echo "<br>";
echo "-------------------\n";
?>