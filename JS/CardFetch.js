$(document).ready(function() {
    let selectedCards = [];
    let availableCards = [];
    let idCounter = 0;
    // Fetch cards from a mock API using AJAX
    $.ajax({
        url: 'https://db.ygoprodeck.com/api/v7/cardinfo.php', // Replace with your actual API endpoint
        method: 'GET',
        data : {
            format: 'goat'
        },
        success: function(cards) {
            availableCards = cards.data; // Store the fetched cards
            renderCardList(cards.data); // Render the initial card list
        },
        error: function(error) {
            console.error('Error fetching cards:', error);
        }
    });

    // Render the card list
    function renderCardList(cards) {
        $('#card-list').empty();
        cards.forEach(card => {
            const id=idCounter;
            $('#card-list').append(`
                <div class="cards" data-id="${id}">
                    <img src="${card.card_images[0].image_url_small}" alt="${card.name}" width="100"><br>
                    ${card.name} 
                    <br>
                    <button class="add-card">Add</button>
                </div>
            `);
            idCounter++;
        });
    }

    // Render the selected card list
    function renderSelectedCards() {
        $('#selected-cards').empty();
            selectedCards.forEach(cardId => {
            $('#selected-cards').append(`
                <div class="cards" data-id="${cardId}">
                    <img src="${availableCards.data[cardId].card_images[0].image_url_small}" alt="${availableCards.data[cardId].name}" width="100"> 
                    <br>
                    ${availableCards.data[cardId].name} 
                    <br>
                    <button class="remove-card">Remove</button>
                </div>
            `);
        });
    }

    // Add card to the selected list
    $(document).on('click', '.add-card', function() {
        const cardId = $(this).parent().data('id');
        selectedCards.push(cardId);
        renderSelectedCards();
    });

    // Remove card from the selected list
    $(document).on('click', '.remove-card', function() {
        const cardId = $(this).parent().data('id');
        const index = selectedCards.indexOf(cardId);
            selectedCards.splice(index, 1);
            renderSelectedCards();
    });

    // Save the deck to LocalStorage
    $('#save-deck').click(function() {
        const deckName = $('#deck-name').val();
        if (deckName && Object.keys(selectedCards).length > 0) {
            const deck = {
                name: deckName,
                cards: selectedCards
            };
            const savedDecks = JSON.parse(localStorage.getItem('decks')) || [];
            savedDecks.push(deck);
            localStorage.setItem('decks', JSON.stringify(savedDecks));
            alert('Deck saved successfully!');
            $.ajax({
                url: 'save_deck.php',
                method: 'POST',
                data: { deck: JSON.stringify(deck), deck_name: deckName },
                success: function(response) {
                    alert(response);
                }
            });
        } else {
            alert('Please provide a deck name and select at least one card.');
        }
        
    });

    // Load and display saved decks
    function loadSavedDecks() {
        
        const savedDecks = JSON.parse(localStorage.getItem('decks')) || [];
        $('#saved-decks').empty();
        savedDecks.forEach(deck => {
            let deckCardDetails = [];
            for (let cardId in deck.cards) {
                const card = availableCards.find(c => c.id === parseInt(cardId));
                const count = deck.cards[cardId];
                deckCardDetails.push(`${card.name} (x${count})`);
            }
            $('#saved-decks').append(`<li>${deck.name}: ${deckCardDetails.join(', ')}</li>`);
        });
    }

    // Filter the card list based on the search query
    $('#search-cards').on('input', function() {
        const query = $(this).val().toLowerCase();
        const filteredCards = availableCards.filter(card => card.name.toLowerCase().startsWith(query));
        renderCardList(filteredCards);
    });

    loadSavedDecks(); // Load saved decks on page load
});
