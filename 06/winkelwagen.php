<?php
session_start();

$item_array = array(
    array("brood", "1.25", "Afbeelding brood"),
    array("appel", "0.65", "Afbeelding appel"),
    array("Kwark", "1.00", "Afbeelding kwark")
);

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    if (isset($_POST["action"]) && $_POST["action"] === "add") {
        $index = (int)$_POST["item_index"];
    
        if (isset($item_array[$index])) {
            if (isset($_SESSION["cart"][$index])) {
                $_SESSION["cart"][$index]++;
            } else {
                $_SESSION["cart"][$index] = 1;
            }
        }
    }


    if (isset($_POST["action"]) && $_POST["action"] === "clear") {
        unset($_SESSION["cart"]); 
        session_destroy();
    }

    // Dit had ik online gevonden om bij refreshen niet hetzelfde toe te voegen, weet niet of dit de way to go is omdat dit de exit; gebruikt
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Winkelwagen</title>
</head>
<body>
    <h1>Artikelen</h1>
    <?php 
    for ($i = 0; $i < sizeof($item_array); $i++) {
        echo "<strong>Name: </strong>" . $item_array[$i][0] . "<br>";
        echo "<img src='" . $item_array[$i][2] . "' width='80'><br>";
        echo "<strong>Price: </strong> &euro;" . $item_array[$i][1] . "<br>";
        ?>
        <form method="POST">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="item_index" value="<?= $i ?>">
            <button type="submit">Voeg toe</button>
        </form>
        <hr>
        <?php
    }
    ?>

    <h2>Winkelwagen</h2>
    <?php if (empty($_SESSION["cart"])): ?>
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
                <?php
                $totaal = 0;
                foreach ($_SESSION["cart"] as $index => $aantal) {
                    $naam = $item_array[$index][0];
                    $prijs = (float)$item_array[$index][1];
                    $subtotaal = $prijs * $aantal;
                    $totaal += $subtotaal;
                    
                    echo "<tr>";
                    echo "<td>" . $naam . "</td>";
                    echo "<td>" . $aantal . "</td>";
                    echo "<td>&euro; " . number_format($prijs, 2, ',', '.') . "</td>";
                    echo "<td>&euro; " . number_format($subtotaal, 2, ',', '.') . "</td>";
                    echo "</tr>";
                }
                ?>
                <tr>
                    <td colspan="3" style="text-align: right; font-weight: bold;">Totaalbedrag:</td>
                    <td style="font-weight: bold;">&euro; <?= number_format($totaal, 2, ',', '.') ?></td>
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