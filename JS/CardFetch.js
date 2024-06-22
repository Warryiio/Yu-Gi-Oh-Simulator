$(document).ready(function() {
    let selectedCards = [];
    let availableCards = [];
    let deck = [];
    // Fetch cards from a mock API using AJAX
    $.ajax({
        url: 'https://db.ygoprodeck.com/api/v7/cardinfo.php', // Replace with your actual API endpoint
        method: 'GET',
        data : {
            format: 'goat'
        },
        success: function(cards) {
            console.log(cards.data[0].id)
            availableCards = cards; // Store the fetched cards
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
            $('#card-list').append(`
                <div class="cards" data-id="${card.id}">
                    <img src="${card.card_images[0].image_url_small}" alt="${card.name}" width="100"><br>
                    ${card.name} 
                    <br>
                    <button class="add-card">Add</button>
                </div>
            `);
        });
    }

    // Render the selected card list
    function renderSelectedCards() {
        $('#selected-cards').empty();
            selectedCards.forEach(cardId => {
                let i=0;
                let result= -1;
                while(i<availableCards.data.length && result==-1){
                    if(availableCards.data[i].id==cardId){
                        result=availableCards.data[i];
                    } else {
                        i++;
                    }
                }
                if(result!=availableCards){
                    $('#selected-cards').append(`
                        <div class="cards" data-id="${cardId}">
                            <img src="${result.card_images[0].image_url_small}" alt="${result.name}" width="100"> 
                            <br>
                            ${result.name} 
                            <br>
                            <button class="remove-card">Remove</button>
                        </div>
                    `); 
                }
            
        });
    }

    // Add card to the selected list
    $(document).on('click', '.add-card', function() {
        let cardId = $(this).parent().data('id');
        let count = 0;
        selectedCards.forEach((id) => (id == cardId && count++));
        if (count < 4) {
            selectedCards.push(cardId);
        }else {
            alert('You can only add up to 4 of the same card.');
        }
        renderSelectedCards();
    });

    // Remove card from the selected list
    $(document).on('click', '.remove-card', function() {
        let cardId = $(this).parent().data('id');
        let index = selectedCards.indexOf(cardId);
            selectedCards.splice(index, 1);
            renderSelectedCards();
    });

    // Save the deck to LocalStorage
    $('#save-deck').click(function() {
        const deckName = $('#deck-name').val();
            let i=0;
            let result= -1;
            while(i<availableCards.data.length && result==-1){
                if(availableCards.data[i].id==selectedCards[0]){
                    result=availableCards.data[i];
                } else {
                    i++;
                }
            }
        const image= result.card_images[0].image_url_small;
        if( Object.keys(selectedCards).length > 39){
            if (deckName && Object.keys(selectedCards).length> 0) {
                alert('Deck saved successfully!');
                $.ajax({
                    url: '/Yu-Gi-Oh-Simulator/php/saveDeck.php',
                    method: 'POST',
                    data: { deck: JSON.stringify(selectedCards), deck_name: deckName, image: image },
                    success: function(response) {
                        alert(response);
                        loadDecks();
                    }
                });
            } else {
                alert('Please provide a deck name and select at least one card.');
            }
        } else{
            alert('Have at least 40 Cards in the deck.');
        }
        
        
        
    });
    function loadDecks() {
        $.ajax({
            url: '/Yu-Gi-Oh-Simulator/php/listDecks.php',
            method: 'GET',
            success: function(response) {
                var decks = JSON.parse(response);
                $('#deck-select').empty();
                decks.forEach(function(deck) {
                    $('#deck-select').append(`
                        <div class="deck-option" data-deck-id="${deck.id}">
                            <img src="${deck.first_card_image}" alt="First Card" class="deck-image">
                            <span>${deck.name}</span>
                        </div>
                    `);
                });
    
                // Add click event to deck options to select the deck
                $('.deck-option').click(function() {
                    var selectedDeckId = $(this).data('deck-id');
                    $('#deck-select .deck-option').removeClass('selected');
                    $(this).addClass('selected');
                    $('#deck-select').val(selectedDeckId);
                });
            }
        });
    }

    // Load and display saved decks
    $('#load-deck').click(function() {
        loadDecks()
        //var selectedDeck = $('#deck-select').val();
        //if (selectedDeck) {
        //    $.ajax({
        //        url: '/Yu-Gi-Oh-Simulator/php/loadDeck.php',
        //        method: 'GET',
         //       data: { id: selectedDeck },
        //        success: function(response) {
         //           deck = JSON.parse(response.cards);
         //           selectedCards=deck;
        //        }
        //    });
       // }
    });


    // Filter the card list based on the search query
    $('#search-cards').on('input', function() {
        let searchName = $(this).val().toLowerCase();
        let filteredCards = availableCards.data.filter(card => card.name.toLowerCase().startsWith(searchName));
        renderCardList(filteredCards);
    });


});
