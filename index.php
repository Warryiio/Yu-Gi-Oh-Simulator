<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YU-GI-OH</title>
    <link rel="stylesheet" href="/Yu-Gi-Oh-Simulator/CSS/index.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js">
        document.getElementById("loginButton").onclick = function () {
            location.href = "localhost/Yu-Gi-Oh-Simulator/CSS/welcome.php";
        };
    </script>
</head>
<body>
    <h1>YU-GI-OH</h1>
    <h2>Register</h2>
    <form class="" action="" method="post" autocomplete="off">
    <div class="input-container">
        <input type="text" id="usernameOrEmail" name="nameOrEmail" placeholder="Username or Email">
        <input type="password" id="password" name="password" placeholder="Password" > 
    </div>
    <div class="button-container">
        <button class="button" id="loginButton" >Login</button>
        <button onclick="redirectToPage()" class="buttonsignup" id="signupButton">Sign Up</button>
    </div>
    </form>

    <script>
        function redirectToPage() {
            window.location.href = "/Yu-Gi-Oh-Simulator/Includes/Registration.php";
        }
    </script>
</body>
</html>