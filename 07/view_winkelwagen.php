<?php
session_start();
require_once 'ShoppingCart.php';

$item_array = [
    ["brood", "1.25", "Afbeelding brood"],
    ["appel", "0.65", "Afbeelding appel"],
    ["Kwark", "1.00", "Afbeelding kwark"]
];


$cart = new ShoppingCart();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? '';

    if ($action === "add" && isset($_POST["item_index"])) {
        $index = (int)$_POST["item_index"];
        if (isset($item_array[$index])) {
            $cart->addToCart($index);
        }
    }

    if ($action === "clear") {
        $cart->clear();
    }

    
    header("Location: " . $_SERVER['PHP_SELF']);
   
}

$cartItems = $cart->getCart();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Winkelwagen OOP</title>
</head>
<body>
    <h1>Artikelen</h1>
    <?php foreach ($item_array as $index => $item): ?>
        <strong>Name: </strong><?= htmlspecialchars($item[0]) ?><br>
        <img src="<?= htmlspecialchars($item[2]) ?>" alt="<?= htmlspecialchars($item[0]) ?>" width="80"><br>
        <strong>Price: </strong> &euro;<?= number_format((float)$item[1], 2, ',', '.') ?><br>
        
        <form method="POST">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="item_index" value="<?= $index ?>">
            <button type="submit">Voeg toe</button>
        </form>
        <hr>
    <?php endforeach; ?>

    <h2>Winkelwagen</h2>
    <?php if (empty($cartItems)): ?>
        <p>De winkelwagen is nog leeg.</p>
    <?php else: ?>
        <table border="1" cellpadding="6" cellspacing="0">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Aantal</th>
                    <th>Prijs per stuk</th>
                    <th>Subtotaal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $index => $aantal): 
                    $naam = $item_array[$index][0];
                    $prijs = (float)$item_array[$index][1];
                    $subtotaal = $prijs * $aantal;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($naam) ?></td>
                        <td><?= $aantal ?></td>
                        <td>&euro; <?= number_format($prijs, 2, ',', '.') ?></td>
                        <td>&euro; <?= number_format($subtotaal, 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" style="text-align: right; font-weight: bold;">Totaalbedrag:</td>
                    <td style="font-weight: bold;">
                        &euro; <?= number_format($cart->getTotal($item_array), 2, ',', '.') ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <form method="POST">
            <input type="hidden" name="action" value="clear">
            <button type="submit">Winkelwagen legen</button>
        </form>
    <?php endif; ?>
</body>
</html>