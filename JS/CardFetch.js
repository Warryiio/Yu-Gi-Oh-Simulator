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

    // Add card to the selected list
    $(document).on('click', '.add-card', function () {
        let cardId = $(this).parent().data('id');
        let i = 0;
        let result = -1;
        let count = 0;
        while (i < availableCards.data.length && result == -1) {
            if (availableCards.data[i].id == cardId) {
                result = availableCards.data[i];
            } else {
                i++;
            }
        }
        if (result.type == "Fusion Monster") {
            extraCards.forEach((id) => (id == cardId && count++));
            if (count < 3) {
                extraCards.push(cardId);
            } else {
                alert('You can only add up to 3 of the same card.');
            }
        } else {
            if (selectedCards.length < 59) {
                selectedCards.forEach((id) => (id == cardId && count++));
                if (count < 3) {
                    selectedCards.push(cardId);
                } else {
                    alert('You can only add up to 3 of the same card.');
                }
            }

        }
        renderSelectedCards();
    });

    // Remove card from the selected list
    $(document).on('click', '.remove-card', function () {
        let cardId = $(this).parent().data('id');
        let i = 0;
        let result = -1;
        while (i < availableCards.data.length && result == -1) {
            if (availableCards.data[i].id == cardId) {
                result = availableCards.data[i];
            } else {
                i++;
            }
        }
        if (result.type == "Fusion Monster") {
            let index = extraCards.indexOf(cardId);
            extraCards.splice(index, 1);
            renderSelectedCards();
        } else {
            let index = selectedCards.indexOf(cardId);
            selectedCards.splice(index, 1);
            renderSelectedCards();
        }
    });

    // Save the deck to the Database
    $('#save-deck').click(function () {
        const deckName = $('#deck-name').val();
            let i = 0;
            let result = -1;
            while (i < availableCards.data.length && result == -1) {
                if (availableCards.data[i].id == selectedCards[0]) {
                    result = availableCards.data[i];
                } else {
                    i++;
                }
            }
            const image = result.card_images[0].image_url_small;
        if($('#save-deck').attr('class')=="saving"){
        if (selectedCards.length > 39) {
            if (deckName.length > 0) {
                alert('Deck saved successfully!');
                $.ajax({
                    url: '/Yu-Gi-Oh-Simulator/php/saveDeck.php',
                    method: 'POST',
                    data: { deck: JSON.stringify(selectedCards), deck_name: deckName, image: image, extraDeck: JSON.stringify(extraCards) },
                    success: function (response) {
                        alert(response);
                        loadSavedDecks();
                    }
                });
            } else {
                alert('Please provide a deck name and select at least one card.');
            }
        } else {
            alert('Have at least 40 Cards in the deck.');
        }
        } else if($('#save-deck').attr('class')=="updating"){
            if (selectedCards.length > 39) {
                if (deckName.length > 0) {
                    $.ajax({
                        url: '/Yu-Gi-Oh-Simulator/php/updateDeck.php',
                        method: 'POST',
                        data: { deck: JSON.stringify(selectedCards), deck_name: deckName, image: image, extraDeck: JSON.stringify(extraCards), id: currentDeckIndex },
                        success: function (response) {
                            loadSavedDecks();
                            alert(response);
                        }
                    });
                } else {
                    alert('Please provide a deck name and select at least one card.');
                }
            } else {
                alert('Have at least 40 Cards in the deck.');
            }
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
    //By clicking on the edit deck button this function is called.
    $(document).on('click', '.edit-deck', function () {
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


    // When giving the Textfield an input the function is called.
    $('#search-cards').on('input', function () {
        //the search is getting the text form the textfield and makes it lowercased.
        let searchName = $('#search-cards').val().toLowerCase();
        //Using the filter for the array it searches the name of the card and makes it lowercased and searches 
        //everything starting with the input. After filtering all the cards it give "filteredCards" all the card it found.
        let filteredCards = availableCards.data.filter(card => card.name.toLowerCase().startsWith(searchName));
        //Refering the method renderCardList and giving the all the filteredCards it shows all the cards.
        renderCardList(filteredCards);
    });

    loadSavedDecks();
});
