<?php
$numbers = [];
for ($i=0; $i <=10; $i++){
    $numbers[] = $i;
}

$numbersString = implode(',', $numbers);


$piString = strval(M_PI);

$dot = strpos($piString, '.');

$decimal = substr($piString, $dot +1);

$piDecimal = [];

for ($i = 0; $i <10; $i++){
    $piDecimal[] = $decimal[$i];
}
$piStringOut = implode(',', $piDecimal);
?>

<html>
    <head>
        <title>Opdracht 9></title>
    </head>

    <body>
        <h2> Getallen 0 t/m 10</h2>
        <p><?php echo $numbersString;?></p>

        <h2>Getallen van pi</h2>
        <p><?php echo $piStringOut;?></p>
    </body>
</html>         
