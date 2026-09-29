<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    
    if (isset($_POST["action"]) && $_POST["action"] === "login") {
        $username = trim($_POST["username"] ?? "");

        if (!empty($username)) {
            
            setcookie("user_name", $username, time() + (5), "/");
        }
    }

    
    if (isset($_POST["action"]) && $_POST["action"] === "logout") {
        setcookie("user_name", "", time() -(1) , "/");
    }

    //Ik heb refresh weer zo gedaan
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}


$isLoggedIn = isset($_COOKIE["user_name"]) && !empty($_COOKIE["user_name"]);
$loggedInUser = $isLoggedIn ? $_COOKIE["user_name"] : "";
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Login met Cookie</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px auto; max-width: 450px; line-height: 1.6; }
        .box { border: 1px solid #ccc; padding: 20px; border-radius: 6px; background-color: #fafafa; }
        input[type="text"] { width: 100%; padding: 8px; margin: 8px 0 16px; box-sizing: border-box; }
        button { padding: 8px 16px; cursor: pointer; border-radius: 4px; border: none; }
        .btn-login { background-color: #007bff; color: white; }
        .btn-logout { background-color: #dc3545; color: white; }
    </style>
</head>
<body>

    <div class="box">
        <?php if ($isLoggedIn): ?>
            //ingelogde gebruiker
            <h2>Welkom terug, <?= htmlspecialchars($loggedInUser) ?>!</h2>
            <p>Je browser heeft je naam onthouden via een cookie (<code>user_name</code>).</p>
            
            <form method="POST">
                <input type="hidden" name="action" value="logout">
                <button type="submit" class="btn-logout" style="">Uitloggen</button>
            </form>

        <?php else: ?>
            //niet ingelogde gebruiker
            <h2>Inloggen</h2>
            <form method="POST">
                <input type="hidden" name="action" value="login">
                <label for="username">Voer je naam in:</label>
                <input type="text" id="username" name="username" required>
                <button type="submit" class="btn-login">Inloggen</button>
            </form>
        <?php endif; ?>
    </div>

</body>
</html>