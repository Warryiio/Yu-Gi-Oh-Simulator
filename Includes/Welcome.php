<?php
  @include('../php/checkSession.php'); 
?>
<!DOCTYPE html>
<html>
<head>
<title>Yu-Gi-Oh Simulator</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  
}

.topnav {
  overflow: hidden;
  background-color: #BDBDBD;
  background-image: url('https://jooinn.com/images/empty-space-1.png');
}

.home {
  background-color: #01579B;
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  font-size: 16px;
  margin: 4px 2px;
  opacity: 0.6;
  transition: 0.3s;
}

.play {
  background-color: #0D47A1;
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  font-size: 16px;
  margin: 4px 2px;
  opacity: 0.6;
  transition: 0.3s;
}

.cards {
  background-color: #1A237E;
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  font-size: 16px;
  margin: 4px 2px;
  opacity: 0.6;
  transition: 0.3s;
}

.logout {
  background-color: #451A6D;
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  font-size: 16px;
  margin: 4px 2px;
  opacity: 0.6;
  transition: 0.3s;
  
}


.home:hover  {opacity: 1}
.play:hover  {opacity: 1}
.cards:hover {opacity: 1}
.logout:hover{opacity: 1}


</style>
<script>
        function redirectToDecksAndCards() {
            window.location.href = "/Yu-Gi-Oh-Simulator/Includes/deckchooser.html";
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

<?php echo "<h1>Welcome ".  $_SESSION['username'] ." to our page </h1>"?> 
<h2>Simulate battles with our website!</h2><br>
<h2 id="Home page">This is the home page, where you can freely navigate through our other sections</h2><br>
<h2>The play section is where you access the actual game with the Deck you've built</h2><br>
<h2>The Decks and cards section is where you can see all the available cards and build and save a deck that is linked to your account</h2><br>
<a href="/Yu-Gi-Oh-Simulator/Includes/Rules.php"> If you want more information about the cards or the rules please  </a>
<!-- <img src="https://wallpaperaccess.com/full/188687.jpg" alt="background"> 
https://jooinn.com/images/empty-space-1.png
https://farm4.staticflickr.com/3895/14894440797_30b2d83d87_b.jpg -->

</body>
</html>