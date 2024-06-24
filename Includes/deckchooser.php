<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Yu-Gi-Oh-Simulator/CSS/Deckchooser.css">
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
        
    </script>
    <div class="back-box">
        <button onclick="redirectToHome()">Back</button>
    </div>
    <div class="box">
        <a href="/Yu-Gi-Oh-Simulator/Includes/showAllDecks.php"><button>Online Decks</button></a>
    </div>
    <div class="box">
        <button onclick="redirectToCreateADeck()">Create Decks</button>
    </div>
</body>
</html>
