<?php
// TODO: make script send response in correct format for html page to read, not just plain text.
// TODO: Put all errors into one error message and send that instead of one error at a time.
include './database.php';

$database = new Database();
$conn = $database->getDbConnection();

if ($conn) {
    //Alle client-side checks worden nog een keer uitgevoerd op de server
    //Check if username is valid
    //TODO: Check username for illegal characters / illegal length
    $username = $conn->real_escape_string($_POST['username']);
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='" . $username . "'");
    if (!$query) {
        die("Error: " . mysqli_error($conn));
    }
    if ($query->num_rows > 0) {
        echo "Username already exists.";
    } else {
        echo "Username does not exist yet.";
    }

    //TODO: check if email is valid
    //TODO: implement email verification

    // Check if passwords match
    //TODO: check if password is not weak, should be same checks as done on client-side
    if ($_POST["password"] != $_POST["passwordConfirm"]) {
        die("Passwords do not match.");
    }




} else {
    echo("error");
}
