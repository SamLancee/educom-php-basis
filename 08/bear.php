<?php

abstract class Bear{

    public $title;
    public function __construct($title=""){
        $this -> title = $title;
    }
    abstract public function eats(): String;
    

    abstract public function roars(): bool;

    abstract public function gewicht(): int;
    
}

class Grizzly extends Bear{
    public function eats(): String{
        return "vis";
    }
    public function roars(): bool{
        return true;
    }
    public function gewicht(): int{
        return 250;
    }

}

class Brown extends Bear{
    public function eats(): String{
        return "zalm";
    }
    public function roars(): bool{
        return true;
    }
    public function gewicht(): int{
        return 450;
    }
}
$beer = null;

if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["beer_type"]) ){
    $beer = match($_POST["beer_type"]){
        "grizzly" => new Grizzly("Griz"),
        "Brown" => new Brown("Brownie"),
        default => null,
    };
}
?>
<html>
    <head>
        <title>Bears class</title>
    </head>
    <body>
        <h1>Welke beer kies jij?</h1>
        <form method ="POST">
            <button type ="submit" name= "beer_type" value = "grizzly">Grizzly</button>
            <button type ="submit" name ="beer_type" value ="Brown">Brown</button>
        </form>
        <?php if ($beer): ?>
            <hr>
            <h2> <?= htmlspecialchars($beer->title);?></h2>
            <ul>
                <li> Eet <?= htmlspecialchars($beer ->eats());?></li>
                <li> Roars: <?= $beer ->roars()? "ja":"nee"; ?></li>
                <li> Gewicht <?=htmlspecialchars($beer->gewicht());?> Kg</li>
            </ul>
            <?php endif; ?>
            
    </body>
</html>


    

