<?php 

$personen = [
    ['naam' => 'Sam', 'adres' => 'Leenderweg 292'],
    ['naam' => 'Anne', 'adres' => 'Hogewoerd 152'],
    ['naam' => 'Misha', 'adres' => 'Bernardstraat 20']
];

$currentCol = $_POST['sort_col'] ?? 'naam';
$currentOrder = $_POST['sort_order'] ?? 'ASC'; 

if (!in_array($currentCol, ['naam', 'adres'])) {
    $currentCol = 'naam';
}

if (!in_array($currentOrder, ['ASC', 'DESC'])) {
    $currentOrder = 'ASC';
}

usort($personen, function ($a, $b) use ($currentCol, $currentOrder) {
    $resultaat = strcmp($a[$currentCol], $b[$currentCol]);

    return ($currentOrder === 'ASC') ? $resultaat : -$resultaat;
});

// richting bepalen

$orderName = ($currentCol === 'naam' && $currentOrder === 'ASC')
    ? 'DESC'
    : 'ASC';

$orderAdres = ($currentCol === 'adres' && $currentOrder === 'ASC')
    ? 'DESC'
    : 'ASC';

?>

<html>

<head>
    <title>Sorteer tabel</title>
</head>

<body>

<h1>Personen</h1>

<table border="1">

    <thead>
        <tr>
            <th>
                <form method="post">
                    <input type="hidden" name="sort_col" value="naam">
                    <input type="hidden" name="sort_order" value="<?= $orderName ?>">
                    <button type="submit">Naam</button>
                </form>
            </th>

            <th>
                <form method="post">
                    <input type="hidden" name="sort_col" value="adres">
                    <input type="hidden" name="sort_order" value="<?= $orderAdres ?>">
                    <button type="submit">Adres</button>
                </form>
            </th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($personen as $person): ?>
            <tr>
                <td><?= htmlspecialchars($person["naam"]) ?></td>
                <td><?= htmlspecialchars($person["adres"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>

</body>
</html>