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
    <div class="controls">
        <input type="text" id="deck-name" placeholder="Deck Name">
        <button class="saving" id="save-deck">Save Deck</button>
        <br>
        <br>
        <input type="text" id="search-cards" placeholder="Search Card">
    </div>

    <div class="container">
        <div class="card-section">
            <h2>Available Cards</h2>
            <div class="card-list-container" id="card-list"></div>
        </div>

        <div class="card-section">
            <h2>Selected Cards</h2>
            <div class="card-list-container" id="selected-cards"></div>
        </div>

        <div class="card-section">
            <h2>Extra Monsters</h2>
            <div class="card-list-container" id="extra-cards"></div>
        </div>
    </div>

    <div class="saved-decks-section">
        <h2>Saved Decks</h2>
        <div id="saved-decks"></div>
    </div>

    <script src="/Yu-Gi-Oh-Simulator/JS/CardFetch.js"></script>
</body>
</html>