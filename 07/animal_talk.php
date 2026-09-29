<?php

class Animal{
    public $name;
    
    public function __construct($name){
        $this -> name = $name;
    }
    public function talk(){
        return "?";
    }
    public function eats(){
        return "?";
    }
    public function barks(){
        return false;
    }
}

class Cat extends Animal {
    public function talk(){
        return "Miauw";
    }
    public function eats(){
        return "Vis en brokjes";
    }
}

class Dog extends Animal{
    public function talk(){
        return "Woef woef";
    }
    public function eats(){
        return "vlees en brokken";
    }
    public function barks(){
        return true;
    }
}

class Cow extends Animal{
    public function talk(){
        return "Mooo";
    }
    public function eats(){
        return "gras";
    }
}

$dier = null;

if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["animal"]) ){
    $dier = match($_POST["animal"]){
        "cat" => new Cat("Ollie"),
        "dog" => new Dog("Baloe"),
        "Cow" => new Cow("Lizzy"),
        default => null,
    };
}

?>

<html>
    <head>
        <title> Animal Talk</title>
    </head>
    <body>
        <h2> Kies een dier</h2>
        <form method = "POST">
            <button type="submit" name ="animal" value ="cat">Kat</button>
            <button type="submit" name ="animal" value ="dog">Hond</button>
            <button type="submit" name ="animal" value ="Cow">Koe</button>
        </form>
        <?php if ($dier): ?>
            <hr>
            <h3>Gekozen dier: <?= htmlspecialchars($dier ->name); ?></h3>
            <ul>
                <li>Geluid <?= htmlspecialchars($dier->talk());?></li>
                <li>Eet <?= htmlspecialchars($dier->eats());?></li>
                <li>Blaft <?= $dier->barks()? "ja":"nee";?></li>
            </ul>
            <?php endif; ?>
    </body>
</html>
    
