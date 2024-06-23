<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
* {box-sizing: border-box}
body {font-family: "Lato", sans-serif;}

/* Style the tab */
.tab {
  float: left;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
  width: 30%;
  height: 200px;
}

/* Style the buttons inside the tab */
.tab button {
  display: block;
  background-color: inherit;
  color: black;
  padding: 22px 16px;
  width: 100%;
  border: none;
  outline: none;
  text-align: left;
  cursor: pointer;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current "tab button" class */
.tab button.active {
   background-color: #ccc; 
}

/* Style the tab content */
.tabcontent {
  float: left;
  padding: 0px 12px;
  border: 1px solid #ccc;
  width: 70%;
  border-left: none;
  height: 700px;
}
</style>
</head>
<body>

<h2>Cards, Decks and Rules</h2>
<p>Click on the buttons to see the different topics</p>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Cards')" id="defaultOpen">Cards</button>
  <button class="tablinks" onclick="openCity(event, 'Decks')">Decks</button>
  <button class="tablinks" onclick="openCity(event, 'Rules')">Rules</button>
</div>

<div id="Cards" class="tabcontent">
  <h3>Cards</h3>
  <p>Cards are divided up in 3 sections: The top the middle and the bottom</p>
  <p>On the top part there is the name and the stars of the card</p>
  <p>On the middle there's the image and the attack (atk) and defence (def) stats points</p>
  <p>At the bottom there are the cards abilities, which can range from none to multiple ones</p>
  <p>The cards can be played in a defencive or attacking position</p>
  <p>The cards can also be played upside-down with the back at the top</p>
</div>

<div id="Decks" class="tabcontent">
  <h3>Decks</h3>
  <p>The composed Decks are made up from 40 up to 60 different cards.</p>
  <p>You can have the same card only up to 3 times per deck</p> 
  <p>Little advice: Try to have the smallest Deck possible as this reduces your chances to draw an unwanted card</p><br>
  <p style="color:Tomato;">For advanced players: You can have a extra deck that can hold maximum 15 cards</p> 
  <p style="color:Tomato;">It contains Xyz Monsters, Synchro Monsters and Fusion Monsters, in any combination.</p> 

</div>

<div id="Rules" class="tabcontent">
  <h3>Rules</h3>
  <p>Note: This content doesn't resume every Rule of Yu-Gi-Oh, to have a complete version of the rules please click this link:</p>
  <a href="https://www.yugioh-card.com/en/rulebook/">Whole Ruleset</a>
  <p>The objective of Yu-Gi-Oh is simple ! </p>
  <p>You and your opponent have both 4000 health, the objective is to lower your opponents health to 0</p><br>
  <p>The stars on the cards define how much sacrified cards are needed to be placed</p>
  <p>From 1 to 4 stars: No sacrifice needed</p>
  <p>From 5 to 8 stars: One sacrifice needed</p>
  <p>From 9 to 13 stars: Two sacrifices needed</p><br>
  <p>If a card agresses a card that has a higher attack it will be destroyed (in attacking position, flipped either way)</p>
  <p>If a card agresses a card that has a higher defense it will be destroyed (in defensive position, flipped either way)</p>
  <p>An attack on a empty field will reduce the opponents health directly from the health counter, a successful attack on a other card will destroy it</p>

</div>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
</body>
</html>