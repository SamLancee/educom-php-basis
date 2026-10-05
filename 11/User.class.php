<?php

class User
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // met fetch_obj
    public function getUser(string $naam): object|false
    {
        $stmt = $this->db->prepare("SELECT id, naam FROM personen WHERE naam = :naam LIMIT 1");
        $stmt->execute([
            ':naam' => $naam
        ]);

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    //Voor login
    public function insertUser(string $naam): int
    {
    $stmt = $this->db->prepare("INSERT INTO personen (naam) VALUES (:naam)");
    $stmt->execute([':naam' => $naam]);
    return (int)$this->db->lastInsertId();
    }

    public function updateUser(int $id, string $naam): void
    {
        $stmt = $this->db->prepare("UPDATE personen SET naam = :naam WHERE id = :id");
        $stmt->execute([
            ':naam' => $naam,
            ':id'   => $id
        ]);
    }

    public function getAllUsers(): array
    {
        $stmt = $this->db->prepare("SELECT id, naam FROM personen");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function showUsers(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['naam'])) {
            $this->updateUser((int)$_POST['id'], $_POST['naam']);
        }

        $users = $this->getAllUsers();
        ?>
        <!DOCTYPE html>
        <html lang="nl">
        <head>
            <meta charset="UTF-8">
            <title>Gebruikers overzicht</title>
        </head>
        <body>
            <h2>Gebruikers overzicht (tabel personen)</h2>
            <table border="1" cellpadding="8" cellspacing="0">
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Aanpassen</th>
                </tr>
                <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u['id']) ?></td>
                        <td><?= htmlspecialchars($u['naam']) ?></td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($u['id']) ?>">
                                <input type="text" name="naam" value="<?= htmlspecialchars($u['naam']) ?>">
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