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

.home:hover {opacity: 1}
.play:hover {opacity: 1}
.cards:hover {opacity: 1}


</style>
<script>
        function redirectToDecksAndCards() {
            window.location.href = "/Yu-Gi-Oh-Simulator/Includes/Deck Builder.html";
        }

        function redirectToPlay() {
            window.location.href = "/Yu-Gi-Oh-Simulator/Includes/PlayField.html";
        }

        function redirectToHome() {
            window.location.href = "/Yu-Gi-Oh-Simulator/Includes/Welcome.php";
        }
    </script>
</head>
<body>

<div class="topnav">

<button onclick="redirectToHome()" class="home">Home</button>
<button onclick="redirectToPlay()" class="play">Play</button>
<button onclick="redirectToDecksAndCards()" class="cards">Decks and Cards</button>
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
<h1>Welcome to our page !</h1>
<p>Simulate battles with our website!</p>

</body>
</html>