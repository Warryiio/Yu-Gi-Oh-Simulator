$(document).ready(function() {
    let selectedCards = [];
    let availableCards = [];
    let extraCards=[];
    let currentDeckIndex=-1;
    let deck = [];
    // Fetch cards from a mock API using AJAX
    $.ajax({
        url: 'https://db.ygoprodeck.com/api/v7/cardinfo.php', // Replace with your actual API endpoint
        method: 'GET',
        data : {
            format: 'goat'
        },
        success: function(cards) {
            console.log(cards)
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
                if(result!=-1){
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
        $('#extra-cards').empty();
            extraCards.forEach(cardId => {
                let i=0;
                let result= -1;
                while(i<availableCards.data.length && result==-1){
                    if(availableCards.data[i].id==cardId){
                        result=availableCards.data[i];
                    } else {
                        i++;
                    }
                }
                if(result!=-1){
                    $('#extra-cards').append(`
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
        let i=0;
        let result= -1;
        let count = 0;
         while(i<availableCards.data.length && result==-1){
            if(availableCards.data[i].id==cardId){
                result=availableCards.data[i];
            } else {
                i++;
            }
        }
        console.log(result.type);
        if(result.type=="Fusion Monster"){
            extraCards.forEach((id) => (id == cardId && count++));
            if (count < 4) {
                extraCards.push(cardId);
            }else {
                alert('You can only add up to 4 of the same card.');
            }
        }else {
            selectedCards.forEach((id) => (id == cardId && count++));
        if (count < 4) {
            selectedCards.push(cardId);
        }else {
            alert('You can only add up to 4 of the same card.');
        }
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
    function loadSavedDecks() {
        $.ajax({
            url: '/Yu-Gi-Oh-Simulator/php/loadDeck.php',
            method: 'GET',
            success: function(response) {
                const savedDecks = JSON.parse(response);
                $('#saved-decks').empty();
                savedDecks.results.forEach(deck => {
                    $('#saved-decks').append(`
                        <div data-cards="${deck.cards}">
                            <img src="${deck.image}" alt="${deck.deckName}" width="100">
                            <br>
                            ${deck.deckName}
                            <br>
                            <button class="edit-deck">Edit</button>
                        </div>
                    `);
                });
            },
            error: function(error) {
                console.error('Error loading decks:', error);
            }
        });
    }
    $(document).on('click', '.edit-deck', function() {
        console.log($(this).parent().data('cards'));
        selectedCards = $(this).parent().data('cards');
        currentDeckIndex = $(this).parent().data('id');
        document.getElementById("save-deck").innerHTML="Update";
        document.getElementById("save-deck").id="update-deck";
        renderSelectedCards();
        // Load the deck and display it for editing (not fully implemented here)
        // You need to write additional code to fetch the specific deck details
        // and populate the selectedCards object and deck name field for editing.
    });


    // Filter the card list based on the search query
    $('#search-cards').on('input', function() {
        let searchName = $(this).val().toLowerCase();
        let filteredCards = availableCards.data.filter(card => card.name.toLowerCase().startsWith(searchName));
        renderCardList(filteredCards);
    });

    loadSavedDecks();
});
