<?php
// Model.php
class UserModel {
    public function getAllUsers(): array {
        return [
            ['id' => 1, 'naam' => 'Alice', 'rol' => 'Admin'],
            ['id' => 2, 'naam' => 'Bob',   'rol' => 'Editor'],
            ['id' => 3, 'naam' => 'Charlie', 'rol' => 'Gebruiker']
        ];
    }
}