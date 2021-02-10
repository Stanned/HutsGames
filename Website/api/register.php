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
        array_push($errors, "username_illegal");
    }

    $safeUsername = $conn->real_escape_string($_POST['username']);
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='" . $safeUsername . "'");
    if (!$query) {
        die("Database Error.");
    }
    if ($query->num_rows > 0) {
        array_push($errors, "username_taken");
    }


    // Check if email had valid format
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "email_invalid");
    }

// Check if passwords match
    if ($_POST["password"] != $_POST["passwordConfirm"]) {
        array_push($errors, "passwords_different");
    }

    // Check if password contains a letter, number, special character and is between 6 and 128 characters long
    $password = $_POST["password"];
    $passRightSize = strlen($password) >= 6 && strlen($password) <= 128;
    $passContainsLetter = preg_match('/[a-zA-Z]/', $password);
    $passContainsNumber = preg_match('/[^a-zA-Z\d]/', $password);
    $passContainsSpecialChar = preg_match('/[^a-zA-Z\d]/', $password);
    $isPassValid = $passRightSize && $passContainsLetter && $passContainsNumber && $passContainsSpecialChar;
    if (!$isPassValid) {
        array_push($errors, "password_illegal");
    }

    echo json_encode($errors);
} else {
    echo("error");
}
