<?php
declare(strict_types=1);

abstract class Bird{
    protected string $name;
    protected int $age;
    protected string $color;

    abstract public function getName():string;
    abstract public function setName(string $name):void;

    abstract public function getAge():int;
    abstract public function setAge(int $age):void;

    abstract public function getColor():string;
    abstract public function setColor(string $color):void;
}

interface Flyable{
    public function fly():string;
}

interface Walkable{
    public function walk():string;
}

interface Swimmable{
    public function swim():string;
}

interface Singable{
    public function sing():string;
}

interface Talkable{
    public function talk():string;
}

class Parrot extends Bird implements Flyable, Walkable, Singable, Talkable{
    private string $type;

    public function __construct(string $name, int $age, string $color, string $type){
        $this->name = $name;
        $this->age = $age;
        $this->color = $color;
        $this->type = $type;
    }

    public function getName():string{
        return $this->name;
    }

    public function setName(string $name):void{
        $this->name = $name;
    }

    public function getAge():int{
        return $this->age;
    }

    public function setAge(int $age):void{
        $this->age = $age;
    }

    public function getColor():string{
        return $this->color;
    }

    public function setColor(string $color):void{
        $this->color = $color;
    }

    public function fly():string{
        return "Can Fly.";  
    }

    public function walk():string{
        return "Parrot is walking.";
    }

    public function sing():string{
        return "Parrot is singing.";
    }

    public function talk():string{
        return "Parrot is talking.";
    }
}

class Penguin extends Bird implements Walkable, Swimmable{
    private string $type;

    public function __construct(string $name, int $age, string $color, string $type){
        $this->name = $name;
        $this->age = $age;
        $this->color = $color;
        $this->type = $type;
    }

    public function getName():string{
        return $this->name;
    }

    public function setName(string $name):void{
        $this->name = $name;
    }

    public function getAge():int{
        return $this->age;
    }

    public function setAge(int $age):void{
        $this->age = $age;
    }

    public function getColor():string{
        return $this->color;
    }

    public function setColor(string $color):void{
        $this->color = $color;
    }

    public function walk():string{
        return "Penguin is walking.";
    }

    public function swim():string{
        return "Penguin is swimming.";
    }
}

class BirdShelter{
    private array $birds = [];

    public function addBird(Bird $bird):void{
        $this->birds[] = $bird;
    }

    public function showBirds():void{
        foreach($this->birds as $bird){
            echo "Name: ". $bird->getName(). "<br>";
            echo "Age: ". $bird->getAge(). "<br>";
            echo "Color: ". $bird->getColor(). "<br>";
            if($bird instanceof Flyable){
                echo $bird->fly(). "<br>";
            }
            if($bird instanceof Walkable){
                echo $bird->walk(). "<br>";
            }
            if($bird instanceof Swimmable){
                echo $bird->swim(). "<br>";
            }
            if($bird instanceof Singable){
                echo $bird->sing(). "<br>";
            }
            if($bird instanceof Talkable){
                echo $bird->talk(). "<br>";
            }
            echo "<br>";
        }
    }
}

$shelter = new BirdShelter();

$shelter->addBird(new Parrot("Parrot", 2, "Green", "Talking Parrot"));
$shelter->addBird(new Penguin("Penguin", 3, "Black and White", "Emperor Penguin"));

$shelter->showBirds();
?>