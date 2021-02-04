<?php

include './database.php';

$database = new Database();
$conn = $database->getDbConnection();

if ($conn) {
    if($result = $conn->query("SELECT * FROM users")) {
        while($row = $result->fetch_assoc()) {
            echo(json_encode($row));
        }
    }
    echo("<br>Success");

} else {
    echo("error");
}