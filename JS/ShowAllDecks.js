$(document).ready(function () {
    let selectedCards = [];
    let availableCards = [];
    let extraCards = [];
    let currentDeckIndex = -1;
    let deck = [];
    // Fetch cards from a mock API using AJAX
    $.ajax({
        url: 'https://db.ygoprodeck.com/api/v7/cardinfo.php', // Replace with your actual API endpoint
        method: 'GET',
        data: {
            format: 'goat'
        },
        success: function (cards) {
            availableCards = cards; // Store the fetched cards
            renderCardList(cards.data); // Render the initial card list
        },
        error: function (error) {
            console.error('Error fetching cards:', error);
        }
    });

    // Render the selected card list
    function renderSelectedCards() {
        $('#selected-cards').empty();
        selectedCards.forEach(cardId => {
            let i = 0;
            let result = -1;
            while (i < availableCards.data.length && result == -1) {
                if (availableCards.data[i].id == cardId) {
                    result = availableCards.data[i];
                } else {
                    i++;
                }
            }
            if (result != -1) {
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
            let i = 0;
            let result = -1;
            while (i < availableCards.data.length && result == -1) {
                if (availableCards.data[i].id == cardId) {
                    result = availableCards.data[i];
                } else {
                    i++;
                }
            }
            if (result != -1) {
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


    function loadAllDecks() {
        $.ajax({
            url: '/Yu-Gi-Oh-Simulator/php/showAllDecks.php',
            method: 'GET',
            success: function (response) {
                const allDecks = JSON.parse(response);
                $('#all-decks').empty();
                allDecks.results.forEach(deck => {
                    $('#all-decks').append(`
                        <div data-id="${deck.id}" data-extra="${deck.extraCards}" data-cards="${deck.cards}">
                            <img src="${deck.image}" alt="${deck.deckName}" width="100">
                            <br>
                            ${deck.deckName}
                            <br>
                            <button class="show-deck">Show Deck</button>
                        </div>
                    `);
                });
            },
            error: function (error) {
                console.error('Error loading decks:', error);
            }
        });
    }
    //By clicking on the edit deck button this function is called.
    $(document).on('click', '.show-deck', function () {
        //Using "this" I get the button where I pressed and by using parent it
        //goes to the div and gets the data-cards, data-extra and data-id inside the div.
        //All the arrays for the cards from the div are put into the attributes.
        selectedCards = $(this).parent().data('cards');
        extraCards = $(this).parent().data('extra');
        //The id is saved so I know which the deck should get changed.
        currentDeckIndex = $(this).parent().data('id');
        //Changing the text and class of the "save-deck" button to update.
        $('#save-deck').html("Update");
        $('#save-deck').attr('class','updating')
        //
        renderSelectedCards();
    });

    loadAllDecks();
});
