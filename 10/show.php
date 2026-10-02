<?php
require 'db.php';

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['naam'])) {
        $stmt = $pdo->prepare("UPDATE personen SET naam = :naam WHERE id = :id");// stuurt sql waarde alvast naar database
        $stmt->execute([ //nu voert die de query daadwerkelijk uit
            ':naam' => $_POST['naam'],
            ':id'   => $_POST['id']
        ]);
    }

    
    $stmt = $pdo->prepare("SELECT * FROM personen");
    $stmt->execute(); //
    $personen = $stmt->fetchAll(PDO::FETCH_ASSOC);//haalt meteen alle rijen op en stopt ze in php array
    //fetch_assoc wordt dus associatieve array  

} catch (PDOException $e) {
    die("Databasefout: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Personen overzicht</title>
</head>
<body>

    <h2>Personen overzicht</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Huidige Naam</th>
            <th>Aanpassen</th>
        </tr>
        <?php foreach ($personen as $persoon): ?>
            <tr>
                <td><?= $persoon['id'] ?></td>
                <td><?= $persoon['naam'] ?></td>
                <td>
                    <form method="POST" action="">
                        <input type="hidden" name="id" value="<?= $persoon['id'] ?>">
                        <input type="text" name="naam" value="<?= $persoon['naam'] ?>">
                        <button type="submit">Opslaan</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>