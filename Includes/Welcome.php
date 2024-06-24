<?php
  @include('../php/checkSession.php'); 
?>
<!DOCTYPE html>
<html>
<head>
<title>Yu-Gi-Oh Simulator</title>
<link rel="stylesheet" href="/Yu-Gi-Oh-Simulator/CSS/Welcome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- These functions create redirects to the different pages of the website -->
<script>
        function redirectToDecksAndCards() {
            window.location.href = "/Yu-Gi-Oh-Simulator/Includes/DeckMenu.php";
        }

        function redirectToPlay() {
            window.location.href = "/Yu-Gi-Oh-Simulator/Includes/PlayField.html";
        }

        function redirectToHome() {
            window.location.href = "/Yu-Gi-Oh-Simulator/Includes/Welcome.php";
        }

        function redirectToLogin() {
            window.location.href = "/Yu-Gi-Oh-Simulator/Includes/Registration.php";
        }
    </script>
</head>
<body>

<class="topnav">

<!-- These buttons redirect the user to the page they clicked on -->
<button onclick="redirectToHome()" class="home">Home</button>
<button onclick="redirectToPlay()" class="play">Play</button>
<button onclick="redirectToDecksAndCards()" class="cards">Decks and Cards</button>
<a href="/Yu-Gi-Oh-Simulator/php/logout.php"> <button  class="logout">Logout</button> </a>

<!--<img src="https://images.wallpapersden.com/image/download/neon-gradient-minimalist_bGVlZmaUmZqaraWkpJRmbmdlrWZlbWU.jpg" alt="Yes"> -->
<!--  <a class="active" href="#home">Home</a>
  <a href="#news">News</a>
  <a href="#contact">Contact</a>
  <div class="topnav-right">
    <a href="#search">Search</a>
    <a href="#about">About</a> -->
    
  </div>
</div>

<!-- This code is used to put an Image on the page as a background -->
</div>
<style>
header {
  background-image: url('https://jooinn.com/images/empty-space-1.png');
}
body {
  background-image: url('https://jooinn.com/images/empty-space-1.png');
}
body {
  background-color: lightgrey;
  color: white;
}
Home page{
  color: grey;
}
</style>
<!-- This code sets the username in the title and creates the text that are visible in the website -->
<?php echo "<h1>Welcome to our page ".  $_SESSION['username'] ." </h1>"?> 
<h2>Simulate battles with our website!</h2><br>
<h2 id="Home page">This is the home page, where you can freely navigate through our other sections</h2><br>
<h2>The play section is where you access the actual game with the Deck you've built</h2><br>
<h2>The Decks and cards section is where you can see all the available cards and build and save a deck that is linked to your account</h2><br>

<!-- This code creates a clickable link to the rules of Yu-Gi-Oh! -->
<a href="/Yu-Gi-Oh-Simulator/Includes/Rules.php"> If you want more information about the cards or the rules please  </a>

<!-- <img src="https://wallpaperaccess.com/full/188687.jpg" alt="background"> 
https://jooinn.com/images/empty-space-1.png
https://farm4.staticflickr.com/3895/14894440797_30b2d83d87_b.jpg -->

</body>
</html>