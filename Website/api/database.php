<?php

$servername = "mysql.stackcp.com";
$port = "53704";
$username = "HutsGames-313537cd22";
$password = "chx5p0qwvd";
$dbname = "HutsGames-313537cd22";

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection to database has failed: " . $conn->connect_error);
}
echo "Connected to database.";
