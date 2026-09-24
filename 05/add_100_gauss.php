<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Gauss Methode</title>
</head>
<body>

    <h1>Optellen volgens Gauss</h1>
    <p>
        Om de som van 1 t/m 100 snel te berekenen, vermenigvuldig je het hoogste getal ($n) 
        met het getal ernaast ($n + 1) en deel je dit door 2.
        Kies in het volgende blok zelf je getal uit:
    </p>
    <form method="GET">
        Number: <input type ="integer" name="number"><br><br>
        <input type="submit"> 
    </form>
        

    <?php
    $n = $_GET["number"];
    $som = ($n * ($n + 1)) / 2;

    echo "<p>Berekening: ($n &times; " . ($n + 1) . ") / 2</p>";
    echo "<p><strong>Totale som: " . $som . "</strong></p>";
    ?>

</body>
</html>