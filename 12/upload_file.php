<?php
// Map 
$target_dir = "upload/";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {

    
    if ($_FILES["fileToUpload"]["error"] !== UPLOAD_ERR_OK) {
        die("Er is een fout opgetreden bij het uploaden (Foutcode: " . $_FILES["fileToUpload"]["error"] . ").");
    }

    $uploadOk = 1;
    
    // Haal de extensie op
    $original_name = basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

    // Uniqid creeren 
    $unique_filename = uniqid("", true) . "." . $imageFileType;
    $target_file = $target_dir . $unique_filename;

    // Checken of persoon niet handmatig naar .jpg etc heeft omgeschreven
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check === false) {
        echo "Sorry, het bestand is geen geldige afbeelding.<br>";
        $uploadOk = 0;
    }

    // Extensie check
    $allowed_extensions = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowed_extensions)) {
        echo "Sorry, alleen JPG, JPEG, PNG, GIF bestanden zijn toegestaan.<br>";
        $uploadOk = 0;
    }

    // Maximale grote
    $max_size = 2000000;
    if ($_FILES["fileToUpload"]["size"] > $max_size) {
        echo "Sorry, het bestand is te groot (maximaal " . ($max_size / 1000000) . " MB).<br>";
        $uploadOk = 0;
    }

    // Mocht die al bestaan
    if (file_exists($target_file)) {
        echo "Sorry, er bestaat al een bestand met deze naam. Probeer het opnieuw.<br>";
        $uploadOk = 0;
    }

    // Definitieve verwerking
    if ($uploadOk == 0) {
        echo "Het bestand is niet geüpload.<br>";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "Het bestand is succesvol geüpload!<br>";
            echo "Originele naam: " . htmlspecialchars($original_name) . "<br>";
            echo "Opgeslagen als:" . htmlspecialchars($unique_filename) . "<br>";
            echo '<br><a href="' . htmlspecialchars($target_file) . '" target="_blank">Bekijk geüploade afbeelding</a>';
        } else {
            echo "Er is een fout opgetreden bij het verplaatsen van het bestand.<br>";
        }
    }
} else {
    echo "Geen bestand ontvangen. Ga terug naar het uploadformulier.";
}
?>