<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - HutsGames</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
        integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="./register.css">
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
                <a id="loginButton" class="button" href="#">Login</a>
                <a id="loginButton" class="button" href="">Register</a>
            </div>
        </div>
    </header>
    <h1 class="titleRegister">Sign up</h1>
    <div id="registerBoxContainer">
        <form action="" name="myForm" method="post" id="form" onsubmit="return validateName() && validateEmail() && validatePassword() && validatePasswordSame()">
            <input class="registerforminput arrow-togglable" autocomplete="off" type="text" placeholder="Username" name="username" id="userInput" onkeyup="checkName()" required><br>
            <input class="registerforminput arrow-togglable emailBox" type="email" placeholder="Email address" name="email" id="emailInput" onkeyup="checkEmail();" required><br>
            <input class="registerforminput arrow-togglable passwordBox" autocomplete="off" type="password" placeholder="Password" name="password" id="passwordInput" onkeyup="checkPassword();" required></br>
            <input class="registerforminput arrow-togglable" autocomplete="off" type="password" placeholder="Confirm password" name="passwordConfirm" id="passwordConfirmInput" onkeyup="checkPasswordsSame()" required></br>   
            <span id="message"></span><br>
            <p id="TermsAcceptLine">By signing up you agree to the <a href="../terms-of-service.html" target="blank_">Terms of Service</a></p>
            <input class="registerButton" type="submit" name="submitRegisterForm" value="Register" id="registerClick"  />
            <p class="AlreadyRegistered">Already have an account? <a href="../log-in">Log in</a></p>
        </form>
    </div>
    <script type="text/javascript">

function validateName() {
    return checkName();
}
function checkName() {
    
    var name = document.forms["myForm"]["userInput"].value;
    var nameNum = name.replace(/[a-z]/, '');
    
    if (nameNum.length > 2 && nameNum.length < 33) {
        document.getElementById("userInput").className = 'UsernameCorrect';
        return true;
    } 
    else if (nameNum.length < 3 || nameNum.length > 32) {
        document.getElementById("userInput").className = 'UsernameIncorrect';
        return false;
    }
}

function validateEmail() {
    return checkEmail();
}
function checkEmail(){
    const email = document.getElementById('emailInput').value;
    const pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/

    if(email.match(pattern)){
        document.getElementById("emailInput").className = 'EmailPasswordCorrect';
        return true;
    } else {
        document.getElementById("emailInput").className = 'EmailPasswordIncorrect';
        return false;
    }
}

function validatePassword() {
    return checkPassword();
}
function checkPassword(){
    const password = document.getElementById('passwordInput').value;
    const pattern = /(?=.*[a-zA-Z])(?=.*[^a-zA-Z\d])(?=.*?[#?!@$%^&*-\/\\]).{6,128}/

    if(password.match(pattern)){
        document.getElementById("passwordInput").className = 'EmailPasswordCorrect';
        return true;
    } else {
        document.getElementById("passwordInput").className = 'EmailPasswordIncorrect';
        return false;
    }
}

function validatePasswordSame() {
    return checkPasswordsSame();
}
function checkPasswordsSame() {
        var password = document.getElementById("passwordInput").value;
        var confirmPassword = document.getElementById("passwordConfirmInput").value;
        const pattern = /(?=.*[a-zA-Z])(?=.*[^a-zA-Z\d])(?=.*?[#?!@$%^&*-\/\\]){6,128}/
        if (password != confirmPassword){
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'password do not match / not strong enough';
            document.getElementById("passwordConfirmInput").className = 'PasswordConfirmIncorrect';
            return false;
        } else if (password.match(pattern)){
            document.getElementById("passwordConfirmInput").className = 'PasswordConfirmCorrect';
            document.getElementById('message').style.visibility = "hidden";
            return true;
        }
    }

if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
</body>
</html>