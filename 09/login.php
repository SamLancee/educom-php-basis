<?php
session_start();

$accounts = [
    "admin" => "admin123",
    "sam"   => "123",
    "gast"  => "gast"
];

// uitloggen
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $_SESSION = [];
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
}

$error_message = "";

// inloggen
if (isset($_POST['user']) && isset($_POST['password'])) {
    $user = $_POST['user'];
    $password = $_POST['password'];

    // array check
    if (isset($accounts[$user]) && $accounts[$user] === $password) {
        $_SESSION['user'] = $user;
    } else {
        $error_message = "Onjuiste gebruikersnaam of wachtwoord.";
    }
}

// formulier
function show_form($error = "") {
    $form_data = "<html><body>";
    $form_data .= "<h2>Please login</h2>";

    if (!empty($error)) {
        $form_data .= "<p style='color: red;'>" . htmlspecialchars($error) . "</p>";
    }

    $form_data .= "<form action='' method='POST'>";
    $form_data .= "Username: <input type='text' name='user' required><br><br>";
    $form_data .= "Password: <input type='password' name='password' required><br><br>";
    $form_data .= "<input type='submit' value='Login'>";
    $form_data .= "</form>";
    $form_data .= "</body></html>";
    
    echo $form_data;
}

if (isset($_SESSION['user'])) {
    echo "Welcome " . htmlspecialchars($_SESSION['user']) . ", you are logged in!<br><br>";
    echo "<a href='?action=logout'>Logout</a>";
} else {
    show_form($error_message);
}
?>