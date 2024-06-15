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
        include ('php/connect.php');
        if(isset($_POST['submit'])) {
            $username= $_POST['username'];
            $email = $_POST['email'];
            $password =$_POST['password'];

            $verify_query = mysqli_query($connection, "SELECT dtEmail FROM tblUsers WHERE dtEmail='$email'");

            if(mysqli_num_rows($verify_query) !=0)  {
                error();
            } else {
                mysqli_query($connection,"INSERT INTO tblUsers(dtUsername,dtEmail,dtPassword) VALUES('$username','$email','$password')") or die("Error Occured");
                success();
            }
        } else {

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

    <div class=popup id="popup">
        <img id="status" height src="" width="150" />
        <h2 id="message"></h2>
        <p id="details"></p>
        <button type="button" onclick="closePopup()">OK</button>
    </div>
    <?php }?>

    <script>
        let popup= document.getElementById("popup");
    function openPopup() {
        popup.classList.add("open-popup");

    }
    function closePopup() {
        popup.classList.remove("open-popup");
    }

    function error() {
        document.getElementById("status").src= "/Yu-Gi-Oh-Simulator/images/red.png";
        document.getElementById("message").innerHTML = "Something went wrong";
        document.getElementById("details").innerHTML = "Your Username or Email is already used";
        openPopup();
    }
    function success() {
        document.getElementById("status").src= "/Yu-Gi-Oh-Simulator/images/green.png";
        document.getElementById("message").innerHTML = "Thank you";
        document.getElementById("details").innerHTML = "Your Account has been created";
        openPopup();
    }
    </script>
</body>
</html>