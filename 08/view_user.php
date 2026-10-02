<?php

require ("user.php");

$user = new User();
$user -> setID(1);

echo "Gebruiker id: " . $user->getID() . "<br>";

$testbestand = "foto.png";
if ($user ->checkFileName($testbestand)){
    echo "Dit is een geldig bestand <br>";
}else{
    echo "ongeldig bestand<br>";
}


$user -> showImage();
$user -> showPassport();

echo "<br>";

$user2 = new User();
$user2 -> setID(2);

echo "Gebruiker id: " . $user2->getID() . "<br>";

$testbestand2 = "foto.pdf";
if ($user2 ->checkFileName($testbestand2)){
    echo "Dit is een geldig bestand <br>";
}else{
    echo "ongeldig bestand<br>";
}


$user2 -> showImage();
$user2 -> showPassport();
?>
