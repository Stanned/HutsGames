<?php
class Database{

    private string $host = "mysql.stackcp.com";
    private string $port = "53704";
    private string $username = "HutsGames-313537cd22";
    private string $database = "HutsGames-313537cd22";
    private string $password = "chx5p0qwvd";

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
