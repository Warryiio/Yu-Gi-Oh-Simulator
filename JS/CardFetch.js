$(document).ready(function() {
    let selectedCards = [];

    // Fetch cards from a mock API using AJAX
    $.ajax({
        url: "https://db.ygoprodeck.com/api/v7/cardinfo.php", // Replace with your actual API endpoint
        method: 'GET',
        success: function(cards) {
            var i=0;
            console.log(cards.data.find("Exodia"));
            cards.data.forEach(card => {
                let img= document.createElement("img");
                img.src= card.card_images[0].image_url_small;
                $("#card-list").append(img);
                $('#card-list').append(`<li data-id="${card.id}">${card.name} <button class="add-card">Add</button></li>`);
            });
        },
        error: function(error) {
            console.error('Error fetching cards:', error);
        }
    });
});