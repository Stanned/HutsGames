<?php
class Database{

    private string $host = "localhost";
    private string $port = "53704";
    private string $username = "hutsgames";
    private string $database = "hutsgames";
    private string $password = "superhuts123";

    public function getDbConnection(): PDO
    {
        $dsn = "mysql:host=$this->host;dbname=$this->database;port=$this->port";
        try {
            $conn = new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $e) {
            throw $e;
        }

        return $conn;

    }
}
