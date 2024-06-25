$(document).ready(function () {
    //Kai
    let selectedCards = [];
    let availableCards = [];
    let extraCards = [];
    let currentDeckIndex = -1;
    let deck = [];
    // Fetch cards from a mock API using AJAX
    $.ajax({
        url: 'https://db.ygoprodeck.com/api/v7/cardinfo.php',
        method: 'GET',
        data: {
            format: 'goat'
        },
        success: function (cards) {
            availableCards = cards; // Store the fetched cards
            renderCardList(availableCards.data); // Render the initial card list
        },
        error: function (error) {
            console.error('Error fetching cards:', error);
        }
    });

    // Render the card list
    function renderCardList(cards) {
        //Removing everything inside the card-list
        $('#card-list').empty();
        //For all every Index in the array its gonna append a picture with a button inside a div in the card-list
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
        //Removing everything inside the selected-cards
        $('#selected-cards').empty();
        //Using the id of the card this algorithm is going to search for the card with the id
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
            //when the card is found and not -1 a picture with a remove button is getting appended at selected cards
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
        //Removing everything inside the extra-cards
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
        //When clicking on the "add-card" button using "this" I get the button where I clicked and get id
        //with parent which refers to the "div" and gets the "data-id"
        let cardId = $(this).parent().data('id');
        let i = 0;
        let result = -1;
        let count = 0;
        //Searching for the card using the id
        while (i < availableCards.data.length && result == -1) {
            if (availableCards.data[i].id == cardId) {
                result = availableCards.data[i];
            } else {
                i++;
            }
        }
        //Using the type I check if the card is a Fusion Monster or a Normal Monster
        if (result.type == "Fusion Monster") {
            //Checking if the Extra Cards array has 15 cards and it's going to alert that i cant add any new cards
            if(extraCards.length<14) {
                //Counting every card with the same card so if I have more than 3 time the same card
                //it's going to give out an alert that i cant add 3 time the same card
                extraCards.forEach((id) => (id == cardId && count++));
                if (count < 3) {
                    extraCards.push(cardId);
                } else {
                    alert('You can only add up to 3 of the same card.');
                }
            } else {
                alert("You can't have more than 15 Extra Cards")
            }
            
        } else {
            //Checking if the Normal Cards array has 60 cards and it's going to alert that i cant add any new cards
            if (selectedCards.length < 59) {
                selectedCards.forEach((id) => (id == cardId && count++));
                if (count < 3) {
                    selectedCards.push(cardId);
                } else {
                    alert('You can only add up to 3 of the same card.');
                }
            } else {
                alert("You can't have more than 60 Cards")
            }

        }
        renderSelectedCards();
    });

    // Remove card from the selected list
    $(document).on('click', '.remove-card', function () {
        //Getting the card trough "this" which refers to the remove-card button i clicked on
        //and gives me the id from the "div" inside the "data-id"
        let cardId = $(this).parent().data('id');
        let i = 0;
        let result = -1;
        //Searching for the card with the id
        while (i < availableCards.data.length && result == -1) {
            if (availableCards.data[i].id == cardId) {
                result = availableCards.data[i];
            } else {
                i++;
            }
        }
        //Checking if the card is a Fusion Monster or a Normal Monster
        if (result.type == "Fusion Monster") {
            //Getting the index of the cardid
            let index = extraCards.indexOf(cardId);
            //removing the card with the index and the 1 means that only 1 object is getting removed
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
            //saving the card image
            const image = result.card_images[0].image_url_small;
            //Checking if the class of the button save-deck is saving or updating
        if($('#save-deck').attr('class')=="saving"){
            //Checking if it hase atleast 40 cards and a name
        if (selectedCards.length > 39) {
            if (deckName.length > 0) {
                alert('Deck saved successfully!');
                //Using ajax i post in "data" all the post to the php data to save the data
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

    //Fetching Decks from the database
    function loadSavedDecks() {
        $.ajax({
            //using the method get i can get the data as response back.
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

    $('#export-deck').click(function() {
        exportYDK(deck);
    });

    function exportYDK() {
        // writes inside a text and using "\n" to make a break line
        let ydkContent = '#created by ...\n#main\n';
        //Adding all the cards inside the string
        selectedCards.forEach(function(cardId) {
            ydkContent += cardId + '\n';
        });
        ydkContent += '#extra\n';
        extraCards.forEach(function(cardId) {
            ydkContent += cardId + '\n';
        });
        ydkContent += '#side\n';
        //Replacing everything that has a comma using /, and  
        // /\s*/ means that it is going to remove all the spaces and tabs
        // /g means that it is going to search trought the entire string
        // and \n is what it's going to be replaced by which is a break line
        var replacedStr = ydkContent.replace(/,\s*/g, "\n");
        // Using blob(Binary Large Object) which can store raw data we store the string
        // inside it and give it the type "text/plain" which means we store text
        let blob = new Blob([replacedStr], { type: 'text/plain' });
        //Creating a temporary element a to create a download link out of the link that is removed
        let link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'deck.ydk';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    loadSavedDecks();
});
