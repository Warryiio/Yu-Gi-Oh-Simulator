<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YU-GI-OH</title>
    <link rel="stylesheet" href="/Yu-Gi-Oh-Simulator/CSS/index.css">
    <style>
        @import url('https://fonts.cdnfonts.com/css/public-pixel');
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js">
        document.getElementById("loginButton").onclick = function () {
            location.href = "localhost/Yu-Gi-Oh-Simulator/CSS/welcome.php";
        };
    </script>
</head>
<body>
    <h1>YU-GI-OH</h1>
    <h2>Register</h2>
    
    <div class="input-container">
        <label for="nameOrEmail">Username/Email :</label>
        <input type="text" id="nameOrEmail" name="nameOrEmail" oninput="checkInput()">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"> 
    </div>
    <div class="button-container">
        <button onclick="redirectToPage()" class="button" id="loginButton" disabled>Login</button>
        <button class="buttonsignup" id="signupButton">Sign Up</button>
    </div>

    <script>
        function checkInput() {
            var input = document.getElementById("nameOrEmail").value;
            var loginButton = document.getElementById("loginButton");

            // Check if input contains "@" to determine if it's an email
            if (input.includes("@")) {
                loginButton.innerText = "Login with Email";
            } else {
                loginButton.innerText = "Login with Username";
            }

            // Enable the login button
            loginButton.disabled = false;
        }
    </script>
    <script>
        function redirectToPage() {
            window.location.href = "/Yu-Gi-Oh-Simulator/Includes/Welcome.php";
        }
    </script>
</body>
</html>