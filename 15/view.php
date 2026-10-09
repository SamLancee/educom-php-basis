<?php
// View.php
class UserView {
    public function render(array $users): void {
        ?>
        <!DOCTYPE>
        <html>
        <head>
            <title>Gebruikersoverzicht (MVC)</title>
        </head>
        <body>
            <h2>Gebruikerslijst</h2>
            <ul>
                <?php foreach ($users as $user): ?>
                    <li>
                        <strong><?= htmlspecialchars($user['naam']) ?>: </strong> 
                        <?= htmlspecialchars($user['rol']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </body>
        </html>
        <?php
    }
}