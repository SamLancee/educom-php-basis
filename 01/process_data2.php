<?php
$name     = $_GET['name']     ?? '';
$adress   = $_GET['adress']   ?? '';
$phone    = $_GET['phone']    ?? '';
$comments = $_GET['comments'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ingezonden gegevens</title>
</head>
<body>
    <h2>Ontvangen gegevens:</h2>

    
    <table border="1" cellpadding="5">
        <tr>
            <th>Veld</th>
            <th>Ingevuld</th>
        </tr>
        <tr>
            <td>Naam:</td>
            <td><?php echo htmlspecialchars($name); ?></td>
        </tr>
        <tr>
            <td>Adres:</td>
            <td><?php echo htmlspecialchars($adress); ?></td>
        </tr>
        <tr>
            <td>Telefoonnummer:</td>
            <td><?php echo htmlspecialchars($phone); ?></td>
        </tr>
        <tr>
            <td>Opmerkingen:</td>
            <td><?php echo htmlspecialchars($comments); ?></td>
        </tr>
    </table>

    <br>
    <a href="form2.html">Opnieuw invullen</a>
</body>
</html>