<?php
  @include('../php/checkSession.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Yu-Gi-Oh-Simulator/CSS/DeckMenu.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Boxes with Buttons</title>
    
</head>
<body>
<script>
        function redirectToHome(){
            window.location.href="/Yu-Gi-Oh-Simulator/Includes/Welcome.php";        
        }
        function redirectToCreateADeck(){
            window.location.href = "/Yu-Gi-Oh-Simulator/Includes/DeckBuilder.php";
        }
        function redirectToAllDecks() {
            window.location.href = "/Yu-Gi-Oh-Simulator/Includes/ShowAllDecks.php"
        }
    </script>
    <div class="back-box">
        <button onclick="redirectToHome()">Back</button>
    </div>
    <div class="box">
        <button id="allDecks" onclick="redirectToAllDecks()">Online Decks</button>
    </div>
    <div class="box">
        <button id="createDeck" onclick="redirectToCreateADeck()">Create Decks</button>
    </div>
</body>
</html>
