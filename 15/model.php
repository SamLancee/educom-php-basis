<?php

class UserModel {
    public function getAllUsers(): array {
        return [
            ['id' => 1, 'naam' => 'Sam', 'rol' => 'Admin'],
            ['id' => 2, 'naam' => 'Tom',   'rol' => 'Editor'],
            ['id' => 3, 'naam' => 'Melissa', 'rol' => 'Gebruiker']
        ];
    }
}