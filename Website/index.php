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
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="login.css">
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
            <div class="headerItem"><img width="250" src="images/logo-big.png" alt="HutsGames Logo"></div>
            <div class="headerItem" id="loginButtonContainer" style="text-align: right;">
                <a id="loginButton" class="button" onclick="toggleTheme('light');">Light</a>
                <a id="loginButton" class="button" onclick="toggleTheme('dark');">Dark</a>
                <a id="loginButton" class="button" href="#" onclick="document.getElementById('id01').style.display='block'">Login</a>
                <a id="loginButton" class="button" href="register/">Register</a>
                <a id="loginButton" class="button" href="account/">Account</a>
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
    <div class="slideshow-container" style="text-align: center;">
    <div class="mySlides fade">
        <a href="game-paginas/pagina2.html"><img src="images/Archer vs Zombies Among As - 512x340.jpeg" style="width: 825px; height: 550px;"></a>
      </div>
      
      <div class="mySlides fade">
        <a href="game-paginas/pagina4.html"><img src="images/Stupid Chicken - 512x340.jpeg" style="width: 825px; height: 550px;"></a>
      </div>
      
      <div class="mySlides fade">
        <a href="game-paginas/pagina9.html"><img src="images/Kick the Buddy - 512x340.jpeg" style="width: 825px; height: 550px;"></a>
      </div>
      
    </div>
    <br>
      
      <div style="text-align:center">
        <span class="dot"></span> 
        <span class="dot"></span> 
        <span class="dot"></span> 
      </div>
      <br>
      <section>
        <article style="color: rgb(187, 187, 187);background-color:#222222;text-align:center;padding:50px 80px;text-align: center;">
          <h3>Welcome to Hutsgames!</h3>
          <br><br>
          <p style="color:rgb(187, 187, 187);">We have many games to enjoy! Try out our newest addition: <a href="game-paginas/pagina5.html">Backflip Adventure</a></p>        
        </article>
      </section>
      <section>
        <div class="grid-container">
            <div class="item1">
                <h1 style="color:rgb(187, 187, 187);">Among us</h1>
                <br>
                <ul style= "text-align: left; margin-left: 15px">
                    <li><a style="color: rgb(187, 187, 187);" href="game-paginas/pagina1.php">Impostor</a></li>
                    <li><a style="color: rgb(187, 187, 187);" href="game-paginas/pagina2.php">Asher vs Zombies</a></li>
                    <li><a style="color: rgb(187, 187, 187);" href="game-paginas/pagina3.php">Catac.io</a></li>
                </ul>
            </div>
            <div class="item2">
                <h1 style="color:rgb(187,187,187);">Adventure</h1>
                <br>
                <ul style= "text-align: left; margin-left: 15px">
                    <li><a style="color: rgb(187, 187, 187);" href="game-paginas/pagina4.php">Stupid Chicken</a></li>
                    <li><a style="color: rgb(187, 187, 187);" href="game-paginas/pagina5.php">Backflip Adventure</a></li>
                    <li><a style="color: rgb(187, 187, 187);" href="game-paginas/pagina6.php">Russian Taz Driving</a></li>
                </ul>
            </div>
            <div class="item3">
                <h1 style="color:rgb(187, 187, 187);">Shooter</h1>
                <br>
                <ul style= "text-align: left; margin-left: 15px">
                    <li><a style="color: rgb(187, 187, 187);" href="game-paginas/pagina7.php">The Island Of Momo</a></li>
                    <li><a style="color: rgb(187, 187, 187);" href="game-paginas/pagina8.php">Pixel Warrior</a></li>
                    <li><a style="color: rgb(187, 187, 187);" href="game-paginas/pagina9.php">Kick The Buddy</a></li>
                </ul>
            </div>  

          </div>    
      </section>
    <footer id="footerContainer" style="text-align: center;">
      <p style="color:rgb(187, 187, 187);">Deze website wordt mede mogelijk gemaakt door de Huts</p>
<<<<<<< HEAD:Website/index.php

        <?php

        include 'api/util/database.php';
        $database = new Database();
        $conn = $database->getDbConnection();

        $last5commentsSql = $conn->prepare("SELECT * FROM comments ORDER BY id DESC LIMIT 1;");
        $result = $last5commentsSql->execute();
        $row = $last5commentsSql->fetch();
        $content = $row["content"];
        $username = $row["username"];
        // TODO: display comment
        // TODO: add Form to submit comment
        echo "<h3>Latest Comment:</h3>";
        echo "<h3>".$username.":</h3>";
        echo "<h3>".$content."</h3>";

        if (isset($_SESSION["user"])) {
            $user = $_SESSION["user"];
            if (isset($_POST["msg"])) {
                $msg = $_POST["msg"];
                $insertCommentSql = $conn->prepare("INSERT INTO comments (username, content) VALUES (?,?);");
                $insertCommentSql->bindParam(1, $username);
                $insertCommentSql->bindParam(2, $msg);
                $insertCommentSql->execute();
                echo "Comment posted!";
            }
        }

//          function setComments() {
//            if(isset($_POST['commentSubmit'])) {
//              $uid = $_POST['uid'];
//              $date = $_POST ['date'];
//              $message = $_POST['message'];
//
//              $sql = "INSERT INTO comments (uid, date, message) VALUES ('$uid', '$date', '$message')";
//              $result = $conn->query($sql);
//            }
//          }

        ?>

        <h1>Submit your own comment for everyone to see!</h1>
        <h4>(You need to be logged in)</h4>
        <form>
            <input type="text" name="msg" placeholder="Type your comment here!">
            <input type="submit">
        </form>
=======
      <a href="./contact" style="text-center">Contact</a>
>>>>>>> master:Website/index.html
    </footer>

    <script>
        var slideIndex = 0;
        showSlides();
        
        function showSlides() {
          var i;
          var slides = document.getElementsByClassName("mySlides");
          var dots = document.getElementsByClassName("dot");
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
          }
          slideIndex++;
          if (slideIndex > slides.length) {slideIndex = 1}    
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex-1].style.display = "block";  
          dots[slideIndex-1].className += " active";
          setTimeout(showSlides, 10000); // Change image every 2 seconds
        }
        </script>
</body>
</html>
