<?php
$zipcode = $_POST['zipcode'] ?? '';
$message = '';
$is_valid = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $zipcode = trim($zipcode);

    // Regex uitleg:
    // ^        = start van de regel
    // [1-9][0-9]{3} of [0-9]{4} = 4 cijfers (vaak begint een NL postcode niet met 0, maar \d{4} dekt 4 cijfers)
    // \s* of ? = optionele spatie
    // [a-zA-Z]{2} = 2 letters (hoofd- of klein)
    // $        = einde van de regel
    $pattern = '/^[0-9]{4}\s?[a-zA-Z]{2}$/';

    if (preg_match($pattern, $zipcode)) {
        $message = "Geldige postcode: " . htmlspecialchars($zipcode);
        $is_valid = true;
    } else {
        $message = "Ongeldige postcode! Voer 4 cijfers en 2 letters in bijv. 1234AB of 1234 ab.";
        $is_valid = false;
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Postcode Check</title>
</head>
<body>

    <h2>Postcode Controle</h2>

    <form method="post" action="">
        <label for="zipcode">Postcode:</label>
        <input type="text" id="zipcode" name="zipcode" value="<?= htmlspecialchars($zipcode) ?>">
        <input type="submit" value="Controleren">
    </form>

    <?php if ($message): ?>
        <p>
            <?= $message ?>
        </p>
    <?php endif; ?>

</body>
</html>