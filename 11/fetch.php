<?php 
$pdo = new PDO("mysql:host=localhost; dbname=pdo", "root", "");
$pdo -> setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$selected_mode = $_GET["mode"] ?? null;

?>

<html>
    <head>
        <title>PDO fetch methodes</title>
    </head>
    <body>
        <h2> kies een fetch methode</h2>
        <ul>
            <li> <a href="?mode=assoc">FETCH_ASSOC</a> Associative array></li>
            <li><a href="?mode=both">BOTH</a>Index als kolomnamen</li>
            <li><a href="?mode=obj">OBJ</a>anoniem object met properties</li>
            <li><a href="?mode=lazy">Lazy</a>combineert assoc, nummeriek en object</li>
</ul>
<hr>
<?php if ($selected_mode): ?>
    <h3> Gekozen mode: <?= htmlspecialchars($selected_mode)?></h3>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM personen");
    $stmt->execute();
    switch($selected_mode){
        case "assoc":
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            print_r($data);
            break;

        case "both":
            $data = $stmt->fetchAll(PDO::FETCH_BOTH);
            print_r($data);
            break;
        case "obj":
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            print_r($data);
            break;
        case "lazy":
            while ($row = $stmt ->fetch(PDO::FETCH_LAZY)){
                print_r($row);
            }
            break;
        default:
            echo "Geen mode geselecteerd";
            break;
    }
        else: ?>
        <p> Klik op een link</p>
        <?php endif; ?>
    </body>
</html>

