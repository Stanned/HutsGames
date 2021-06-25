<?php

include "api/util/database.php";
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
        $checkSql->execute();
        $result = $conn->query("SELECT * FROM users WHERE `username`='" . $uname . "';");
        if ($result->rowCount() != 0) {
//            $result->nextRowset();
            $row = $result->fetch();
            $dbPass = $row["passwordhash"];

            if (password_verify($password, $dbPass)) {
                session_start();
                $_SESSION["user"] = $uname;
                session_commit();
                echo "Logged in!";
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
    <title>HutsGames</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
        integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="..\styles.css">
    <link rel="stylesheet" href="game-pagina.css">
    <link rel="stylesheet" href="..\login.css">
    <script>
    const htmlEl = document.getElementsByTagName('html')[0];
    const currentTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : null;

    if (currentTheme) {
        htmlEl.dataset.theme = currentTheme;
    }

    const toggleTheme = (theme) => {
        htmlEl.dataset.theme = theme;
        localStorage.setItem('theme', theme);
    }
    </script>
</head>

<body>
    <header>
        <div id="headerContainer">
            <div class="headerItem"><a href="../index.php"><img width="250" src="..\images/logo-big.png" alt="HutsGames Logo"></a></div>
            <div class="headerItem" id="loginButtonContainer" style="text-align: right;">
                <a id="loginButton" class="button" onclick="toggleTheme('light');">Light</a>
                <a id="loginButton" class="button" onclick="toggleTheme('dark');">Dark</a>
                <a id="loginButton" class="button" href="#" onclick="document.getElementById('id01').style.display='block'">Login</a>
                <a id="loginButton" class="button" href="/register/">Register</a>
            </div>
        </div>
    </header>

    <!-- de modal -->
    <div id="id01" class="modal">
      <span onclick="document.getElementById('id01').style.display='none'"
            class="close" title="Close Modal">&times;</span>

        <!-- wat er in de model staat -->
        <form class="modal-content animate" method="POST">
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

<br><br>    

<section>
    <div class="container">
        <div class="game"> <iframe src="https://html5.gamedistribution.com/cef0b75b9deb4230be9e29db19807bff/" width="800" height="400" scrolling="none" frameborder="0"></iframe>
        </div>
        <div class="suggest">
            <h1>Suggestions</h1>
            <ul style= "text-align:left;">
                <li><h3><a style="color: var(--color-primary);" href="pagina4.php">Stupid Chicken</a></h3></li>
                <li><h3><a style="color: var(--color-primary);" href="pagina5.php">Backflip Adventure</a></h3></li>
                <li><h3><a style="color: var(--color-primary);" href="pagina6.php">Russian Taz Driving</a></h3></li>
                <li><h3><a style="color: var(--color-primary);" href="pagina7.php">The Island Of Momo</a></h3></li>
                <li><h3><a style="color: var(--color-primary);" href="pagina8.php">Pixel Warrior</a></h3></li>
                <li><h3><a style="color: var(--color-primary);" href="pagina9.php">Kick The Buddy</a></h3></li>
            </ul>
        </div>
        <div class="title">
            <h1 style="color:var(--color-primary);">Catac.io</h1>
        </div>
        <div class="description">
            <p> Welcome to Catac.io!<br><br>Catac.io is a great Among us spin-off, where you are a cat on a mission to kill other cats. Good luck and shank the sussy cats! </p>
        </div>
        <div class="reviews"></div>
    </div>
<section>

<br><br>
<br><br>

<footer id="footerContainer" style="text-align: center;">
    <p style="color:rgb(187, 187, 187);">Deze website wordt mede mogelijk gemaakt door de Huts</p>
</footer>
</body>
</html>
