<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deck List with Random Cards</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
        }
        .deck-box {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 20px;
            width: 300px;
            text-align: center;
        }
        .deck-box img {
            width: 80px;
            height: 120px;
            margin: 10px;
        }
        .deck-name {
            font-size: 20px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h1>Deck List</h1>
<div id="deck-container"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        function getRandomCards(deck, count) {
            let shuffled = deck.sort(() => 0.5 - Math.random());
            return shuffled.slice(0, count);
        }

        function renderDecks(decks) {
            $('#deck-container').empty();
            decks.forEach(deck => {
                let randomCards = getRandomCards(deck.cards, 2);
                let deckBox = $('<div class="deck-box"></div>');
                deckBox.append(`<div class="deck-name">${deck.deckName}</div>`);
                randomCards.forEach(card => {
                    deckBox.append(`<img src="${card.image}" alt="${card.name}">`);
                });
                $('#deck-container').append(deckBox);
            });
        }

        function loadSavedDecks() {
            $.ajax({
                url: '/Yu-Gi-Oh-Simulator/php/loadDeck.php',
                method: 'GET',
                success: function (response) {
                    const savedDecks = JSON.parse(response).results;
                    renderDecks(savedDecks);
                },
                error: function (error) {
                    console.error('Error loading decks:', error);
                }
            });
        }

        loadSavedDecks();
    });
</script>

</body>
</html>
