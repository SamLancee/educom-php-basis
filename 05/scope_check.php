<?php
//Ik moest even opzoeken wat een post en prefix is_a
$i = 4;
$n = 4;
echo $i++."<br>";
//Dit moet dus 4 zijn want het komt pas daarna. 
// Eerste wordt er gerekend met het getal daarna wordt de i met 1 verhoogd
// Bij prefix, wordt de i eerst verhoogd en pas daarna gebruikt. Dan zou het 5 zijn

echo ++$n. "<br>";

//Nu voor de functie

$naam = "Sam";

function hoi(){
    echo "hoi". $naam;
}
begroet();
//de $naam is niet meegegeven aan de functie, er kan dus niet worden gelezen binnenin de functie wat $naam doet
// Je zou dit kunnen oplossen door dit of te defineren binnenin de functie. Of door het mee te geven functie hoi($naam)