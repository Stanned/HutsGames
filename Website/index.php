<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HutsGames</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
        integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
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
                <a id="loginButton" class="button" href="Loginscherm/">Login</a>
                <a id="loginButton" class="button" href="register/">Register</a>
                <a id="loginButton" class="button" href="account/">Account</a>
            </div>
        </div>
    </header>
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
                    <li><a style="color: rgb(187, 187, 187);" href="game-paginas/pagina1.html">Impostor</a></li>
                    <li><a style="color: rgb(187, 187, 187);" href="game-paginas/pagina2.html">Asher vs Zombies</a></li>
                    <li><a style="color: rgb(187, 187, 187);" href="game-paginas/pagina3.html">Catac.io</a></li>
                </ul>
            </div>
            <div class="item2">
                <h1 style="color:rgb(187,187,187);">Adventure</h1>
                <br>
                <ul style= "text-align: left; margin-left: 15px">
                    <li><a style="color: rgb(187, 187, 187);" href="game-paginas/pagina4.html">Stupid Chicken</a></li>
                    <li><a style="color: rgb(187, 187, 187);" href="game-paginas/pagina5.html">Backflip Adventure</a></li>
                    <li><a style="color: rgb(187, 187, 187);" href="game-paginas/pagina6.html">Russian Taz Driving</a></li>
                </ul>
            </div>
            <div class="item3">
                <h1 style="color:rgb(187, 187, 187);">Shooter</h1>
                <br>
                <ul style= "text-align: left; margin-left: 15px">
                  <li><a style="color: rgb(187, 187, 187);" href="game-paginas/pagina7.html">The Island Of Momo</a></li>
                    <li><a style="color: rgb(187, 187, 187);" href="game-paginas/pagina8.html">Pixel Warrior</a></li>
                    <li><a style="color: rgb(187, 187, 187);" href="game-paginas/pagina9.html">Kick The Buddy</a></li>
                </ul>
            </div>  

          </div>    
      </section>
    <footer id="footerContainer" style="text-align: center;">
      <p style="color:rgb(187, 187, 187);">Deze website wordt mede mogelijk gemaakt door de Huts</p>

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

        if ($_SESSION["user"]) {
            $user = $_SESSION["user"];
            if (isset($_POST["msg"])) {
                $msg = quote($_POST["msg"]);
                $insertCommentSql = $conn->prepare("INSERT INTO comments (username, content) VALUES (?,?);");
                $insertCommentSql->bindParam(1, $username);
                $insertCommentSql->bindParam(2, $msg);
                $insertCommentSql->execute();
                echo "Comment posted!";
            }
        }

          function setComments() {
            if(isset($_POST['commentSubmit'])) {
              $uid = $_POST['uid'];
              $date = $_POST ['date'];
              $message = $_POST['message'];

              $sql = "INSERT INTO comments (uid, date, message) VALUES ('$uid', '$date', '$message')";
              $result = $conn->query($sql);
            }
          }

        ?>
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
