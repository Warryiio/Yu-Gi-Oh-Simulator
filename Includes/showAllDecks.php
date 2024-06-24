<?php
  @include('../php/checkSession.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Yu-Gi-Oh! Deck Builder</title>
    <link rel="stylesheet" href="/Yu-Gi-Oh-Simulator/CSS/DeckStyles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    
    <h1>Yu-Gi-Oh! Deck Builder</h1>

    <a href="/Yu-Gi-Oh-Simulator/Includes/DeckMenu.php"><button class="go-back">Go Back</button></a>


        <div class="card-section">
            <h2>Selected Cards</h2>
            <div class="card-list-container" id="selected-cards"></div>
        </div>

        <div class="card-section">
            <h2>Extra Monsters</h2>
            <div class="card-list-container" id="extra-cards"></div>
        </div>
    </div>

    <div class="all-decks-section">
        <h2>All Decks</h2>
        <div id="all-decks"></div>
    </div>
    <script>
        function redirectToDeckChooser(){
            window.location.href="/Yu-Gi-Oh-Simulator/Includes/deckchooser.html"
        }

    </script>


    <script src="/Yu-Gi-Oh-Simulator/JS/ShowAllDecks"></script>
</body>
</html>