<?php

class Person
{
    private PDO $db;

    
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function updatePerson(int $id, string $naam): void
    {
        $stmt = $this->db->prepare("UPDATE personen SET naam = :naam WHERE id = :id");
        $stmt->execute([
            ':naam' => $naam,
            ':id'   => $id
        ]);
    }

    public function getAllPersons(): array
    {
        $stmt = $this->db->prepare("SELECT id, naam FROM personen");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function showPersons(): void
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['naam'])) {
            $this->updatePerson((int)$_POST['id'], $_POST['naam']);
        }

        $personen = $this->getAllPersons();

        
        ?>
        <!DOCTYPE html>
        <html lang="nl">
        <head>
            <meta charset="UTF-8">
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
                        <td><?= htmlspecialchars($persoon['id']) ?></td>
                        <td><?= htmlspecialchars($persoon['naam']) ?></td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($persoon['id']) ?>">
                                <input type="text" name="naam" value="<?= htmlspecialchars($persoon['naam']) ?>">
                                <button type="submit">Opslaan</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </body>
        </html>
        <?php
    }
}