<?php
//eenvoudig
function verhoogValue($getal){
    $getal += 10;
}
function verhoogReference(&$getal){
    $getal += 10;
}

$a = 5;

echo "A is nu: $a<br>";

verhoogValue($a);
echo "A is nu $a<br>";

verhoogReference($a);

echo "A is nu $a<br><br>";

//met object/class

class geld{
    public int $saldo = 100;
}

function voegToe(geld $rekening){
    $rekening ->saldo +=50;
}
$mijnrekening = new geld();
echo "saldo voor functie: ". $mijnrekening->saldo . "<br>";

voegToe($mijnrekening);
echo "Saldo na functie: ". $mijnrekening -> saldo . "<br>";
//nu geen & nodig, objecten maken al automatisch geen kopie

?>