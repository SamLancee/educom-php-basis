<?php

class DBConnect
{
    private PDO $connection;
    

    public function __construct()
    {
        try {
            
            $this->connection = new PDO(
                "mysql:host=localhost;dbname=pdo;charset=utf8",
                "root",
                ""
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connectiefout: " . $e->getMessage());
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
//$connection = new DBConnect(); //maakt hem dan 1x aan