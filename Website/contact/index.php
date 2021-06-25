<?php

if(!empty($_POST["submitContactForm"])) {
    //Na het invullen van het contactformulier verstuurt PHP een bericht met informatie naar een email van HutsGames. Ook gaat er een email naar diegene die het formulier invult. Er worden dus twee mails verzonden
    $website="vlogboys696969@gmail.com";
    $websiteName="HutsGames";
    $customer=$_POST['senderEmail'];
    $subject="Form to email message";
    $sender=$_POST["sender"];
    $senderEmail=$_POST["senderEmail"];
    $subject=$_POST["subject"];
    $message=$_POST["message"];
    
    //Laat zien bij beide emails waar hij vandaan komt. PErsoneel van HutsGames ziet dus naam bij afzender en customer@sender.com. De klant ziet HutsGames staan met noreply@hutsgames.com. Dit is een verzonnen emailadres.
    $headers1 .= "From: $sender <customer@sender.com>\r\n";
    $headers2 .= "From: HutsGames <noreply@hutsgames.com>\r\n";

    //Er worden twee verschillende emails opgesteld.
    $mailBody1="Contact Form Message\n\nName: $sender\nE-mail: $senderEmail\n\n$message";
    $mailBody2="Here is your message sent to us:\n\n$message\n\nDo not reply to this automated message, we will contact you soon!\n\nSincerely,\nHutsGames";

    mail($website, $subject, $mailBody1, $headers1);
    mail($customer, $subject, $mailBody2, $headers2);

    //Bedankbericht voor invullen van formulier.
    $thankYou="<p>Thank you $sender, we will contact you shortly.</p>";
}

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - HutsGames</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"

        integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="contactstyle.css">
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

    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }  
    
    </script>
</head>

<body>
    <header>
        <div id="headerContainer">
            <div class="headerItem"><a href="../index.php"><img width="250" src="../images/logo-big.png" alt="HutsGames Logo"></a></div>
            <div class="headerItem" id="loginButtonContainer" style="text-align: right;">
                <a id="loginButton" class="button" onclick="toggleTheme('light');">Light</a>
                <a id="loginButton" class="button" onclick="toggleTheme('dark');">Dark</a>
                <a id="loginButton" class="button" href="../Loginscherm/">Login</a>              
                <a id="loginButton" class="button" href="../register/">Register</a>
                <a id="loginButton" class="button"  href="../account/">Account</a>
            </div>
        </div>
    </header>

<!--Contactformulier--> 
    <h1 class="titleContact">Contact</h1>
        <div id="contactBoxContainer" class="container">
        	<form name="myForm" action="index.php" method="post" spellcheck="false" onsubmit="return validateName() && validateEmail() && validateSubject() && validateMessage()">
        		<div class="col-sm">
        			
                    <input name="sender" id="nameInput" class="contactforminput" placeholder="Name" autocomplete="off" onkeyup="checkName();" required></br>

                    <input name="senderEmail" id="emailInput" type="email" class="contactforminput" placeholder="Email" onkeyup="checkEmail();" required></br>

                    <input name="subject" id="subjectInput" class="contactforminput" placeholder="Subject" autocomplete="off" onkeyup="checkSubject();" required></br>
        		</div>

        		<div class="col-sm">
        			<textarea style="resize: none;" name="message" id="messageInput" rows="6" class="contactforminput" autocomplete="off" placeholder="Type your message..." onkeyup="checkMessage();" required></textarea>
        		</div>

                <input class="contactButton" type="submit" name="submitContactForm" value="Send" id="sendClick"/>
                </br>
                <?=$thankYou ?>
        	</form>
        </div>

<script type="text/javascript">
/*Check of er iets in het emailveld staat*/
function validateEmail() {
    return checkEmail();
}
function checkEmail(){
    const email = document.getElementById('emailInput').value;
    const pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/

    if(email.match(pattern)){
        document.getElementById("emailInput").className = 'InputCorrect';
        return true;
    } else {
        document.getElementById("emailInput").className = 'InputIncorrect';
        return false;
    }
} 

/*Check of er iets in het naamveld staat*/
function validateName() {
    return checkName();
}
function checkName() {
    
    var name = document.forms["myForm"]["nameInput"].value;
    var nameNum = name.replace(/[a-z]/, '');
    
    if (nameNum.length > 0 && nameNum.length < 21) {
        document.getElementById("nameInput").className = 'InputCorrect';
        return true;
    } 
    else if (nameNum.length < 1 || nameNum.length > 20) {
        document.getElementById("nameInput").className = 'InputIncorrect';
        return false;
    }
}

/*Check of er iets in het onderwerpveld staat*/
function validateSubject() {
    return checkSubject();
}
function checkSubject() {
    
    var subject = document.forms["myForm"]["subjectInput"].value;
    var subjectNum = subject.replace(/[a-z]/, '');
    
    if (subjectNum.length > 0 && subjectNum.length < 35) {
        document.getElementById("subjectInput").className = 'InputCorrect';
        return true;
    } 
    else if (subjectNum.length < 1 || subjectNum.length > 34) {
        document.getElementById("subjectInput").className = 'InputIncorrect';
        return false;
    }
}

/*Check of er iets in het berichtenveld staat*/
function validateMessage() {
    return checkMessage();
}
function checkMessage() {
    
    var message = document.forms["myForm"]["messageInput"].value;
    var messageNum = message.replace(/[a-z]/, '');
    
    if (messageNum.length > 0 && messageNum.length < 1001) {
        document.getElementById("messageInput").className = 'InputCorrect';
        return true;
    } 
    else if (messageNum.length < 1 || messageNum.length > 1000) {
        document.getElementById("messageInput").className = 'InputIncorrect';
        return false;
    }
}
</script>
</body>
</html>