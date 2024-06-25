<?php
  @include('../php/checkSession.php'); 
?>
<!--Dinis -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Yu-Gi-Oh-Simulator/CSS/Rules.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="back-box">
        <a href="/Yu-Gi-Oh-Simulator/Includes/Welcome.php"><button onclick="redirectToHome()">Back</button></a>
    </div>

<h2>Cards, Decks and Rules</h2>
<p>Click on the buttons to see the different topics</p>

<!-- These lines of code define which category selected is and therefore which text is shown -->
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Cards')" id="defaultOpen">Cards</button>
  <button class="tablinks" onclick="openCity(event, 'Decks')">Decks</button>
  <button class="tablinks" onclick="openCity(event, 'Rules')">Rules</button>
  <button class="tablinks" onclick="openCity(event, 'Field')">Game Field</button>
</div>

<!-- This text shows what is written in the category "Cards" -->
<div id="Cards" class="tabcontent">
  <h3>Cards</h3>
  <img src="https://www.yugioh-card.com/tw/howto/images/type_of_card_monster_new2.jpg">
  <p><b>Monster Cards</b></p>
  <p>Monster Cards are protagonist of the battle!</p>
  <p>Normal Monsters have no 《effects》.</p>
  <p>Effect Monsters have special 《effects》 in addition to their basic stats.</p>
  <p>Other powerful cards also exist such as Ritual, Fusion, Synchro, Xyz, Pendulum, and Link Monsters</p>
  <img src="https://www.yugioh-card.com/tw/howto/images/type_of_card_magic_new.jpg">
  <p><b>Spell Cards</b></p>
  <p>The《effects》 these cards can bring are far beyond your imagination! It’s a must to have!</p>
  <img src="https://www.yugioh-card.com/tw/howto/images/type_of_card_trap_new.jpg">
  <p><b>Trap Cards</b></p>
  <p>These cards may have specific conditions to be 《activated》, but their strong 《effects》 could be the key to turning a duel in your favor! 《Activate》trap to outsmart your opponent!</p>
  <p><b>How to read the Cards</b></p>
  <p>Cards are divided up in 3 sections: The top the middle and the bottom</p>
  <p>On the top part there is the name and the stars of the card</p>
  <p>On the middle there's the image and the attack (atk) and defence (def) stats points</p>
  <p>At the bottom there are the cards abilities, which can range from none to multiple ones</p>
  <p>The cards can be played in a defencive or attacking position</p>
  <p>The cards can also be played upside-down with the back at the top</p>
</div>

<!-- This text shows what is written in the category "Decks" -->
<div id="Decks" class="tabcontent">
  <h3>Decks</h3>
  <p>The composed Decks are made up from 40 up to 60 different cards.</p>
  <p>You can have the same card only up to 3 times per deck</p> 
  <p>Little advice: Try to have the smallest Deck possible as this reduces your chances to draw an unwanted card</p><br>
  <p style="color:Tomato;">For advanced players: You can have a extra deck that can hold maximum 15 cards</p> 
  <p style="color:Tomato;">It contains Xyz Monsters, Synchro Monsters and Fusion Monsters, in any combination.</p> 

</div>

<!-- This text shows what is written in the category "Rules" -->
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

<!-- This text shows what is written in the category "Field" -->
<div id="Field" class="tabcontent">
  <h3>Game Field</h3>
  <img src="https://www.yugioh-card.com/tw/howto/images/duel_field_2020e.jpg" size="200%">
  <p>① Main Monster Zone</p>
  <p>You can summon up to 5 monsters here!</p>
  <p>② Spell & Trap Zone (Pendulum Zone)</p>
  <p>Spells and Traps are activated or set in this zone! If Pendulum Monsters placed in the leftmost and rightmost zones as Spells, those zones will become Pendulum Zones, and you can activat their Pendulum effects or use it for Pendulum Summons!</p>
  <p>③ Field Zone</p>
  <p>Field Spells affect the entire field of play are placed here!</p>
  <p>④ Graveyard</p>
  <p>Place your destroyed Monsters and used Spells/Traps Cards here!</p>
  <p>⑤ Extra Deck Zone</p>
  <p>Put specific cards (Fusion, Synchro, Xyz, Link Monsters) which require special methods of summoning face-down here!</p>
  <p>⑥ Deck Zone</p>
  <p>Place your Main Deck face-down here! Draw your cards from here!</p>
  <p>⑦ Extra Monster Zone</p>
  <p>Reserved for monsters that are Special Summoned to the field from the Extra Deck normally</p>
</div>

<!-- This function defines which category is open -->
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

// Get the element with id="defaultOpen" and open it when the website is loaded
document.getElementById("defaultOpen").click();
</script>
</body>
</html>