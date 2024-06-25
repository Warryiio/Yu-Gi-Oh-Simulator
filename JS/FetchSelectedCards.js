$(document).ready(function () {
    //Kai
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

});