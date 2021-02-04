<?php

class Database{

    private string $host = "mysql.stackcp.com";
    private string $port = "53704";
    private string $username = "HutsGames-313537cd22";
    private string $database = "HutsGames-313537cd22";
    private string $password = "chx5p0qwvd";

    public function getDbConnection(): mysqli
    {
        $conn = new mysqli($this->host, $this->username, $this->password, $this->database, $this->port);

        if ($conn->connect_error) {
            echo("Error in connection: " . mysqli_connect_error());
        }
        return $conn;
    }
}