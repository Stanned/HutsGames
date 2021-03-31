<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - HutsGames</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
        integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="../universal-theme.css">
    <link rel="stylesheet" href="./register.css">
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</head>

<body>
    <header>
        <div id="headerContainer">
            <div class="headerItem"><img width="250" src="../images/logo-big.png" alt="HutsGames Logo"></div>
            <div class="headerItem" id="loginButtonContainer" style="text-align: right;">
                <a id="loginButton" class="button" href="#">Login</a>
                <a id="loginButton" class="button" href="">Register</a>
            </div>
        </div>
    </header>
    <h1 class="titleRegister">Account Registration</h1>
    <div id="registerBoxContainer">
        <form action="" method="post">
            <input class="registerforminput" autocomplete="off" type="text" placeholder="Username" name="username" id="usernameInput" required><br>
            <input class="registerforminput emailBox" type="email" placeholder="Email address" name="email" id="emailInput" required><br>
            <input class="registerforminput passwordBox" autocomplete="off" type="password" placeholder="Password" name="password" id="passwordInput" required><br>
            <input class="registerforminput" autocomplete="off" type="password" placeholder="Confirm password" name="passwordConfirm" id="passwordConfirmInput" required><br>
            <input type="checkbox" id="TermsAcceptBox" name="TermsAcceptCheckbox" required>
            <label id="TermsAcceptBox" for="TermsAcceptBox"> I agree to the <a href="terms-of-user.html" target="blank_">Terms of User</a></label><br>
            <input class="registerforminput" type="submit" name="submitRegisterForm" value="Register">
        </form>
    </div>

    <?php

    include '../api/util/database.php';
    include '../api/util/emailer.php';
    include '../api/util/passwordHasher.php';
    include '../api/util/randomString.php';

    $database = new Database();
    $conn = $database->getDbConnection();
    $randomizer = new randomString();

    if (!$_POST) {
        return;
    }

    if ($conn) {



        $errors = [];

        // Alle client-side checks worden nog een keer uitgevoerd op de server
        if (!preg_match('/^\w{3,32}$/', $_POST["username"])) {
            array_push($errors, "username_illegal");
        }

        // Check if username has been taken

        $usernameSql = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $usernameSql->bindParam(1, $_POST["username"]);
        $usernameSql->execute();


        if ($usernameSql->rowCount() != 0) {
            array_push($errors, "username_taken");
        }


        if (!($stmt = $conn->prepare("SELECT * FROM `users` WHERE `email`=?"))) {
            echo "Prepare failed: (" . $conn->errorInfo() . ")";
        }


        $emailSql = $conn->prepare("SELECT * FROM `users` WHERE `email`=?");
        $emailSql->bindParam(1, $_POST["email"]);
        if (!$emailSql->execute()) {
            array_push($errors, "database_error");
        }
        if ($emailSql->rowCount() > 0) {
            array_push($errors, "email_taken");
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
            // On no errors found
            // Generate email verification key
            $emailVKey = $randomizer->getRandomString(32);

            $passHasher = new passwordHasher();
            $hashedPass = $passHasher->hashPassword($_POST["password"]);

            $submitSql = $conn->prepare("INSERT INTO users (username, passwordHash, email, vkey) VALUES (?, ?, ?, ?)");
            $submitSql->bindParam(1, $_POST["username"]);
            $submitSql->bindParam(2, $hashedPass);
            $submitSql->bindParam(3, $_POST["email"]);
            $submitSql->bindParam(4, $emailVKey);
            if (!$submitSql->execute()) {
                array_push($errors, "database_error");
            } else {
                $response = new stdClass();
                $response->status = "ok";
                echo json_encode($response);
            }

        } else {
            $response = new stdClass();
            $response->status = "errors";
            $response->errors = $errors;
            echo json_encode($response);

        }
    } else {
        echo("error");
    }
    ?>
</body>
</html>