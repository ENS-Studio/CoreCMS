<?php

class Database {

    private $host = "localhost";
    private $db_name = "api_project";
    private $username = "root";
    private $password = "";

    public function connect() {

        try {

            $pdo = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;

        } catch(PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }

    }

}