<?php

include "../api/util/database.php";
$database = new Database();
$conn = $database->getDbConnection();
if (isset($_POST['but_submit'])) {

    $uname = $_POST['uname'];
    $password = $_POST['psw'];

    $passRightSize = strlen($password) >= 6 && strlen($password) <= 128;
    $passContainsLetter = preg_match('/[a-zA-Z]/', $password);
    $passContainsNumber = preg_match('/[^a-zA-Z\d]/', $password);
    $passContainsSpecialChar = preg_match('/[^a-zA-Z\d]/', $password);
    $isPassValid = $passRightSize && $passContainsLetter && $passContainsNumber && $passContainsSpecialChar;


    if ($uname != "" && $isPassValid) {
        $checkSql = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $checkSql->bindParam(1, $password);
        $result = $conn->query($checkSql);
        if ($result->rowCount() != 0) {
            $row = $result->nextRowset();
            $dbPass = $row["password"];
            if (password_verify($password, $dbPass)) {
                session_start();
                $_SESSION["user"] = $uname;
            } else {
                echo "Wrong username and password combination.";
            }
        }

    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - HutsGames</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
          integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="../universal-theme.css">
</head>

<body>
<header>
    <div id="headerContainer">
        <div class="headerItem"><img width="250" src="../images/logo-big.png" alt="HutsGames Logo"></div>
        <div class="headerItem" id="loginButtonContainer" style="text-align: right;">
            <a id="loginButton" class="button" href="#" onclick="document.getElementById('id01').style.display='block'">Login</a>
            <a id="loginButton" class="button" href="../register/">Register</a>
            <a id="loginButton" class="button" href="../account/">Account</a>
        </div>
    </div>
</header>


<!-- de modal -->
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'"
        class="close" title="Close Modal">&times;</span>

    <!-- wat er in de model staat -->
    <form class="modal-content animate" method="POST" action="login_action.php">
        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" id="uname" name="uname" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" id="psw" name="psw" required>

            <button type="submit" value="Submit" name="but_submit" id="but_submit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>

        <div class="container" style="background-color:#ff0000">
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
    </form>
</div>

</body>
</html>
<link rel="stylesheet" href="login.css">
