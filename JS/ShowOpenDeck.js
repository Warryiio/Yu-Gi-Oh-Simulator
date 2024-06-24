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

    function loadSavedDecks() {
        $.ajax({
            url: '/Yu-Gi-Oh-Simulator/php/loadDeck.php',
            method: 'GET',
            success: function (response) {
                const savedDecks = JSON.parse(response);
                $('#saved-decks').empty();
                savedDecks.results.forEach(deck => {
                    $('#saved-decks').append(`
                        <div data-id="${deck.id}" data-extra="${deck.extraCards}" data-cards="${deck.cards}">
                            <img src="${deck.image}" alt="${deck.deckName}" width="100">
                            <br>
                            ${deck.deckName}
                            <br>
                            <button class="edit-deck">Edit</button>
                        </div>
                    `);
                });
            },
            error: function (error) {
                console.error('Error loading decks:', error);
            }
        });
    }
    $(document).on('click', '.edit-deck', function () {
        $.ajax({
            method: 'POST',
            
        });
        selectedCards = $(this).parent().data('cards');
        extraCards = $(this).parent().data('extra');
        currentDeckIndex = $(this).parent().data('id');
        $('#save-deck').html("Update");
        $('#save-deck').attr('class','updating')
        console.log('erfolg');
        console.log( $('#save-deck').attr('class'))
        renderSelectedCards();
        // Load the deck and display it for editing (not fully implemented here)
        // You need to write additional code to fetch the specific deck details
        // and populate the selectedCards object and deck name field for editing.
    });

    loadSavedDecks();
});