<?php
session_start();

require_once 'DBConnect.php';
require 'User.class.php';

$db = new DBConnect();
$user = new User($db->getConnection());

$melding = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $naam = trim($_POST['naam'] ?? '');

    switch ($action) {
        case 'login':
            if (!empty($naam)) {
                $gevondenPersoon = $user->getUser($naam);

                if ($gevondenPersoon) {
                    $_SESSION['username'] = $gevondenPersoon->naam;
                    $_SESSION['user_id'] = $gevondenPersoon->id;
                    $melding = "Succesvol ingelogd als " . htmlspecialchars($gevondenPersoon->naam);
                } else {
                    $melding = "Gebruiker niet gevonden!";
                }
            } else {
                $melding = "Vul een naam in.";
            }
            break;

        case 'register':
            if (!empty($naam)) {
                
                if ($user->getUser($naam)) {
                    $melding = "Deze naam bestaat al. Kies een andere naam of log in.";
                } else {
                    // Voeg toe aan tabel en log direct in
                    $nieuwId = $user->insertUser($naam);
                    $_SESSION['username'] = $naam;
                    $_SESSION['user_id'] = $nieuwId;
                    $melding = "Account aangemaakt en direct ingelogd als " . htmlspecialchars($naam);
                }
            } else {
                $melding = "Vul een geldige naam in om te registreren.";
            }
            break;

        case 'logout':
            unset($_SESSION['username']);
            unset($_SESSION['user_id']);
            session_destroy();
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;

        default:
            $melding = "Onbekende actie.";
            break;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inloggen & Aanmelden</title>
</head>
<body>

    <h2>Login & Aanmelden Systeem</h2>

    <?php if (!empty($melding)): ?>
        <p><strong>Bericht:</strong> <?= $melding ?></p>
    <?php endif; ?>

    <?php if (isset($_SESSION['username'])): ?>
        
        <p>Je bent ingelogd als: <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>
        
        <form method="POST">
            <input type="hidden" name="action" value="logout">
            <button type="submit">Uitloggen</button>
        </form>

    <?php else: ?>
        
            <form method="POST">
                <input type="hidden" name="action" value="login">
                <label for="login_naam">Naam:</label>
                <input type="text" id="login_naam" name="naam" required>
                <button type="submit">Inloggen</button>
            </form>
       

        
      
            <form method="POST">
                <input type="hidden" name="action" value="register">
                <label for="reg_naam">Naam:</label>
                <input type="text" id="reg_naam" name="naam" required>
                <button type="submit">Aanmelden & Inloggen</button>
            </form>
    <?php endif; ?>

</body>
</html>