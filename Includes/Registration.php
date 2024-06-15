<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/Yu-Gi-Oh-Simulator/CSS/Register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function redirectToPage() {
            window.location.href = "/Yu-Gi-Oh-Simulator";
        }
    </script>
</head>
<body>
    <?php
        include("/Yu-Gi-Oh-Simulator/php/connect.php");
        if(isset($_POST['submit'])) {
            $username= $_POST['username'];
            $email = $_POST['email'];
            $password =$_POST['password'];

            $verify_query = mysqli_query($connection, "SELECT Email FROM User WHERE Email='$email")
        }

    ?>
    <h1>Register</h1>

    <form>
        <div class="register-container">
            <input type="text" id="username" placeholder="Username" required>
            <br>
            <input type="text" id="email" placeholder="E-Mail" required>
            <br>
            <input type="password" id="password" placeholder="Password" required>
            <br>
            <button onclick="redirectToPage()" type="button" class="button">Go Back</button>
            <button type="submit" class="registerButton">Register</button>
        </div>
    </form>
    
</body>
</html>