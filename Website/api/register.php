<?php
// TODO: make script send response in correct format for html page to read, not just plain text.
// TODO: Put all errors into one error message and send that instead of one error at a time.
include './util/database.php';

$database = new Database();
$conn = $database->getDbConnection();

if ($conn) {

    $errors = [];

    // Alle client-side checks worden nog een keer uitgevoerd op de server
    if (!preg_match('/^\w{3,32}$/', $_POST["username"])) {
        array_push($errors, "illegal_username");
    }

    $username = $conn->real_escape_string($_POST['username']);
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='" . $username . "'");
    if (!$query) {
        die("Error: " . mysqli_error($conn));
    }


    if ($query->num_rows > 0) {
        array_push($errors, "username_taken");
    }


    // Check if email had valid format
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "email_invalid");
    }

//TODO: implement email verification

// Check if passwords match
//TODO: check if password is not weak, should be same checks as done on client-side
    if ($_POST["password"] != $_POST["passwordConfirm"]) {
        array_push($errors, "passwords_different");
    }

    echo json_encode($errors);
} else {
    echo("error");
}
