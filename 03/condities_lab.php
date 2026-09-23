<html>
    <head>
        <title>Verschillende condities</title>
    </head>

    <body>

        <h2> Verschil == en ===</h2>
        <?php
        $getal = 5;
        $tekst = "5";
        if ($getal == $tekst){
            echo "<p>Nu wordt dit wel geprint</p>";
        }

        if($getal === $tekst){
            echo "<p> Dit is niet zichtbaar</p>";
        }else{
            echo "<p> === differieert ook op type en niet alleen uitkomst</p>";
        }

        ?>
        <h2> Verschil && ||</h2>
        <?php
        $waar = true;
        $nietwaar = false;

        if($waar || $nietwaar){
            echo "<p> Eentje is inderdaad waar</p>";

        }
        
        if($waar && $nietwaar){
            echo "<p> dit klopt niet</p>";
        }else{
            echo "<p> Eentje klopte inderdaad niet</p>";
        }
    
        ?>
    </body>
</html>
    