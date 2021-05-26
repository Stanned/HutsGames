<?php
session_start();
if( !isset( $_SESSION['username']) ){
echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - HutsGames</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="account.css">
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
</head>

<body>
    <header>
        <div id="headerContainer">
            <div class="headerItem"><a href="../index.html"><img width="250" src="../images/logo-big.png" alt="HutsGames Logo"></a></div>
            <div class="headerItem" id="loginButtonContainer" style="text-align: right;">
                <a id="loginButton" class="button" onclick="toggleTheme('light');">Light</a>
                <a id="loginButton" class="button" onclick="toggleTheme('dark');">Dark</a>
                <a id="loginButton" class="button" href="../Loginscherm/">Login</a>
                <a id="loginButton" class="button" href="../register/">Register</a>
                <a id="loginButton" class="button">Account</a>
            </div>
        </div>
    </header>


</li>
</ul>
</nav>
<h1>Welcome to the Account Page, <?php echo $_SESSION['username'] ?></h1>
<p>UserName: <?php echo $_SESSION['username'] ?></p>
<p>Email: <?php echo $_SESSION['email'] ?></p>
<p>Change Password</p>
</br>
<p>Click to <a class="nav-link" href="logout.php">Logout</a></p>
</body>
</html>