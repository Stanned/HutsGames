<?php
// TODO: make script send response in correct format for html page to read, not just plain text.
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

    // Check if errors were found
    if (count($errors) == 0) {
        $response = new stdClass();
        $response->status = "ok";
        echo json_encode($response);


    } else {
        $response = new stdClass();
        $response->status = "errors";
        $response->errors = $errors;
        echo json_encode($response);

    }
} else {
    echo("error");
}
