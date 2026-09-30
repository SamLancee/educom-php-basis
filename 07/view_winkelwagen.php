<?php
session_start();
require_once 'database.php';
require_once 'ShoppingCart.php';

$cart = new ShoppingCart();
$feedbackMessage = "";
$feedbackType = ""; // 'error' of 'success'


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["auth_action"])) {
    $action = $_POST["auth_action"];
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    //inloggen
    if ($action === "register") {
        if (empty($username) || empty($password)) {
            $feedbackMessage = "Vul zowel een gebruikersnaam als een wachtwoord in.";
            $feedbackType = "error";
        } else {
            // Controleer of gebruikersnaam al bestaat
            $checkStmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
            $checkStmt->execute([$username]);

            if ($checkStmt->fetch()) {
                $feedbackMessage = "Deze gebruikersnaam is al bezet. Kies een andere.";
                $feedbackType = "error";
            } else {
                $insertStmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                $insertStmt->execute([$username, $password]);

                // Direct inloggen na succesvol registreren
                $_SESSION['user_id'] = (int)$pdo->lastInsertId();
                $_SESSION['user_name'] = $username;

                header("Location: " . $_SERVER['PHP_SELF']);
                
            }
        }
    }

    // --- INLOGGEN (LOGIN) ---
    if ($action === "login") {
        if (empty($username) || empty($password)) {
            $feedbackMessage = "Vul zowel je gebruikersnaam als wachtwoord in.";
            $feedbackType = "error";
        } else {
            $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ? LIMIT 1");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            // Verifieer of de gebruiker bestaat EN of het wachtwoord klopt met de hash
            if ($user && $password === $user['password']) {
                $_SESSION['user_id'] = (int)$user['id'];
                $_SESSION['user_name'] = $user['username'];

                header("Location: " . $_SERVER['PHP_SELF']);
                
            } else {
                $feedbackMessage = "Onjuiste gebruikersnaam of wachtwoord.";
                $feedbackType = "error";
            }
        }
    }

    // --- UITLOGGEN ---
    if ($action === "logout") {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        $cart->clear();
        header("Location: " . $_SERVER['PHP_SELF']);
        
    }
}

$isLoggedIn = isset($_SESSION['user_id']);
$loggedInUser = $isLoggedIn ? $_SESSION['user_name'] : "";


if ($isLoggedIn && $_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["cart_action"])) {
    $action = $_POST["cart_action"];

    if ($action === "add" && isset($_POST["product_id"])) {
        $cart->addToCart((int)$_POST["product_id"]);
    }

    if ($action === "clear") {
        $cart->clear();
    }

    if ($action === "checkout") {
        $cartItems = $cart->getCart();

        if (!empty($cartItems)) {
            $stmt = $pdo->query("SELECT id, price FROM products");
            $productsById = [];
            while ($row = $stmt->fetch()) {
                $productsById[$row['id']] = $row;
            }

            $totalAmount = $cart->getTotal($productsById);
            $userId = $_SESSION['user_id'];

            try {
                $pdo->beginTransaction();

                $orderStmt = $pdo->prepare("INSERT INTO orders (user_id, total_amount) VALUES (?, ?)");
                $orderStmt->execute([$userId, $totalAmount]);
                $orderId = $pdo->lastInsertId();

                $itemStmt = $pdo->prepare(
                    "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)"
                );

                foreach ($cartItems as $productId => $qty) {
                    $unitPrice = $productsById[$productId]['price'];
                    $itemStmt->execute([$orderId, $productId, $qty, $unitPrice]);
                }

                $pdo->commit();
                $cart->clear();
            } catch (Exception $e) {
                $pdo->rollBack();
                die("Fout bij opslaan van order: " . $e->getMessage());
            }
        }
    }

    header("Location: " . $_SERVER['PHP_SELF']);
  
}


$products = [];
$productsById = [];
if ($isLoggedIn) {
    $stmt = $pdo->query("SELECT id, name, price, image FROM products");
    $products = $stmt->fetchAll();
    foreach ($products as $prod) {
        $productsById[$prod['id']] = $prod;
    }
}
$cartItems = $cart->getCart();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Winkelwagen met Login & Sign Up</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px auto; max-width: 700px; line-height: 1.6; }
        .box { border: 1px solid #ccc; padding: 20px; border-radius: 6px; background-color: #fafafa; margin-bottom: 20px; }
        input[type="text"], input[type="password"] { width: 100%; padding: 8px; margin: 8px 0 16px; box-sizing: border-box; }
        button { padding: 8px 16px; cursor: pointer; border-radius: 4px; border: none; }
        .btn-login { background-color: #007bff; color: white; }
        .btn-signup { background-color: #17a2b8; color: white; }
        .btn-logout { background-color: #dc3545; color: white; }
        .btn-checkout { background-color: #28a745; color: white; }
        .alert-error { color: #dc3545; background: #ffe6e6; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .product-card { border-bottom: 1px solid #ddd; padding: 12px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .forms-wrapper { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    </style>
</head>
<body>

    <?php if (!$isLoggedIn): ?>
        <h2>Welkom bij de Webshop</h2>

        <?php if (!empty($feedbackMessage)): ?>
            <div class="alert-error"><?= htmlspecialchars($feedbackMessage) ?></div>
        <?php endif; ?>

        <div class="forms-wrapper">
            <!-- Inloggen -->
            <div class="box">
                <h3>Inloggen</h3>
                <form method="POST">
                    <input type="hidden" name="auth_action" value="login">
                    
                    <label for="login_user">Gebruikersnaam:</label>
                    <input type="text" id="login_user" name="username" required>
                    
                    <label for="login_pass">Wachtwoord:</label>
                    <input type="password" id="login_pass" name="password" required>
                    
                    <button type="submit" class="btn-login">Inloggen</button>
                </form>
            </div>
            <div class="box">
                <h3>Nieuw account (Sign up)</h3>
                <form method="POST">
                    <input type="hidden" name="auth_action" value="register">
                    
                    <label for="reg_user">Gebruikersnaam:</label>
                    <input type="text" id="reg_user" name="username" required>
                    
                    <label for="reg_pass">Kies een wachtwoord:</label>
                    <input type="password" id="reg_pass" name="password" required>
                    
                    <button type="submit" class="btn-signup">Registreren & Starten</button>
                </form>
            </div>
        </div>

    <?php else: ?>
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #333; padding-bottom: 10px;">
            <div>
                Ingelogd als: <strong><?= htmlspecialchars($loggedInUser) ?></strong> (Account ID: <?= $_SESSION['user_id'] ?>)
            </div>
            <form method="POST" style="margin: 0;">
                <input type="hidden" name="auth_action" value="logout">
                <button type="submit" class="btn-logout">Uitloggen</button>
            </form>
        </div>

        <h2>Artikelen</h2>
        <?php foreach ($products as $item): ?>
            <div class="product-card">
                <strong>Naam: </strong><?= htmlspecialchars($item['name']) ?><br>
                <strong>Prijs: </strong> &euro;<?= number_format((float)$item['price'], 2, ',', '.') ?><br>
                <form method="POST" style="margin-top: 6px;">
                    <input type="hidden" name="cart_action" value="add">
                    <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                    <button type="submit">In winkelwagen</button>
                </form>
            </div>
        <?php endforeach; ?>

        <h2>Jouw Winkelwagen</h2>
        <?php if (empty($cartItems)): ?>
            <p>De winkelwagen is nog leeg.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Aantal</th>
                        <th>Prijs per stuk</th>
                        <th>Subtotaal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $productId => $aantal): 
                        $product = $productsById[$productId];
                        $subtotaal = (float)$product['price'] * $aantal;
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($product['name']) ?></td>
                            <td><?= $aantal ?></td>
                            <td>&euro; <?= number_format((float)$product['price'], 2, ',', '.') ?></td>
                            <td>&euro; <?= number_format($subtotaal, 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" style="text-align: right; font-weight: bold;">Totaalbedrag:</td>
                        <td style="font-weight: bold;">
                            &euro; <?= number_format($cart->getTotal($productsById), 2, ',', '.') ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>
            <div style="display: flex; gap: 10px;">
                <form method="POST">
                    <input type="hidden" name="cart_action" value="clear">
                    <button type="submit">Winkelwagen legen</button>
                </form>

                <form method="POST">
                    <input type="hidden" name="cart_action" value="checkout">
                    <button type="submit" class="btn-checkout">Bestelling plaatsen</button>
                </form>
            </div>
        <?php endif; ?>

    <?php endif; ?>

</body>
</html>