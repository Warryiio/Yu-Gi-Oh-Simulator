<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YU-GI-OH</title>
    <link rel="stylesheet" href="/Yu-Gi-Oh-Simulator/CSS/Login.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function redirectToPage() {
            window.location.href = "/Yu-Gi-Oh-Simulator/Includes/Registration.php";
        }
    </script>
</head>
<body>
    <h1>YU-GI-OH</h1>
    <br>
    <form action="/Yu-Gi-Oh-Simulator/php/login.php" method="post" autocomplete="off">
    <div class="input-container">
        <input type="text" id="email" name="email" placeholder="Email" pattern=".*@.*" title="Please include an '@' in the email address." required>
        <input type="password" id="password" name="password" placeholder="Password" required> 
    </div>
    
    <div class="button-container">
        <button  type="submit" name="submit" class="button" id="loginButton" >Login</button>
        <button type="button" onclick="redirectToPage()" class="buttonsignup" id="signupButton">Sign Up</button>
    </div>
    </form>

    <div class=popup id="popup">
        <img id="status" height src="/Yu-Gi-Oh-Simulator/images/red.png" width="150" />
        <h3 id="message"></h3>
        <p id="details"></p>
        <button type="button" class="popupButton" onclick="closePopup()">OK</button>
    </div>
    
    <script>
        let popup= document.getElementById("popup");
        // Gibt den div popup die Klasse open-popup und wird dadruch sichtbar
        function openPopup() {
            popup.classList.add("open-popup");

        }
        // Entfernt den div popup die Klasse open-popup und wird dadruch unsichtbar
        function closePopup() {
            popup.classList.remove("open-popup");
        }
        function error() {
            document.getElementById("message").innerHTML = "Something went wrong";
            document.getElementById("details").innerHTML = "Your Email or Password is wrong";
            openPopup();
        }
        function loginError() {
            document.getElementById("message").innerHTML = "Your not logged in!";
            document.getElementById("details").innerHTML = "";
            openPopup();
        }
        function logoutSuccess() {
            document.getElementById("status").src="/Yu-Gi-Oh-Simulator/images/green.png"
            document.getElementById("message").innerHTML = "Your logged out!";
            document.getElementById("details").innerHTML = "";
            openPopup();
        }
    </script>
    <?php if (isset($_GET['error']) && $_GET['error'] == 'true') { ?>
        <script>
            $(document).ready(function() {
                error();
            });
        </script>
    <?php } ?>

    <?php if (isset($_GET['notLoggedIn']) && $_GET['notLoggedIn'] == 'true') { ?>
        <script>
            $(document).ready(function() {
                loginError();
            });
        </script>

    <?php } ?><?php if (isset($_GET['logout']) && $_GET['logout'] == 'true') { ?>
        <script>
            $(document).ready(function() {
                logoutSuccess();
            });
        </script>
    <?php } ?>
</body>
</html>