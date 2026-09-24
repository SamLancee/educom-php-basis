<?php
function format_naw($voornaam ="onbekend"  , $achternaam="onbekend", $adres="onbekend", $postcode="0000AE", $woonplaats="onbekend"){
    $output = "$voornaam, $achternaam<br>" .
            "$adres<br>" .
            "$postcode<br> ".
            "$woonplaats<br>";
    return $output;

}
echo format_naw("Frans", "Bouwmans",
  "Daalakkersweg 16", "5641 JA", "Eindhoven");?>
  <br>
  <p> Voorbeeld zonder alle parameters</p>
  <?php

echo format_naw("Frans", "Bouwmans",
  "Daalakkersweg 16");?><br>

<?php 
echo format_naw("5644 AE", "Eindhoven");
?>
<p>Te zien is dat ze op volgorde worden ingevuld, dus verschuivingen zullen plaatsvinden. Direct koppelen werkt wel:</p><br>

<?php
echo format_naw(postcode:"5644 AE", woonplaats:"Eindhoven");
?>