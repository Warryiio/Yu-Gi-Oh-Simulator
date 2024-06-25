<!--Luka -->
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
    

    <h1>Register</h1>

    <form action="/Yu-Gi-Oh-Simulator/php/register.php" method="post" autocomplete="off">
        <div class="register-container">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <br>
            <input type="text" id="email" name="email" placeholder="E-Mail" pattern="^[\w\.-]+@(?:gmail\.com|yahoo\.com|outlook\.com|hotmail\.com|school\.lu)$"  title="Please include an '@' in the email address." required>
            <br>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <br>
            <button onclick="redirectToPage()" type="button" class="button">Go Back</button>
            <button type="submit" name="submit" class="registerButton" required>Register</button>
        </div>
    </form>

    <div class=popup id="popup">
        <img id="status" height src="" width="150" />
        <h3 id="message"></h3>
        <p id="details"></p>
        <button type="button" onclick="closePopup()">OK</button>
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
        // Ändert die Texten und den src vom Bild
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
        function emailError() {
            document.getElementById("status").src= "/Yu-Gi-Oh-Simulator/images/red.png";
            document.getElementById("message").innerHTML = "Something went wrong";
            document.getElementById("details").innerHTML = "Please use and valid email!";
            openPopup();
        }
    </script>
    <?php if (isset($_GET['success']) && $_GET['success'] == 'true') { ?>
        <script>
            $(document).ready(function() {
                success();
            });
        </script>
    <?php } ?>
    <?php if (isset($_GET['error']) && $_GET['error'] == 'true') { ?>
        <script>
            $(document).ready(function() {
                error();
            });
        </script>
    <?php } ?>
    <?php if (isset($_GET['emailError']) && $_GET['emailError'] == 'true') { ?>
        <script>
            $(document).ready(function() {
                emailError();
            });
        </script>
    <?php } ?>
    <script>
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            const emailInput = document.getElementById('email');
            const errorSpan = document.querySelector('.error');

            if (!emailInput.validity.valid) {
                errorSpan.textContent = 'Please enter a valid email ending with @gmail.com, @yahoo.com, @outlook.com, or @hotmail.com.';
                event.preventDefault();
            } else {
                errorSpan.textContent = '';
            }
        });
    </script>
</body>
</html>