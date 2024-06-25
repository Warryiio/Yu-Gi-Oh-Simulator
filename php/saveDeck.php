<?php
    //Kai
    session_start();
    @include 'connect.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $deck = $_POST['deck'];
        $extraDeck = $_POST['extraDeck'];
        $deck_name = $_POST['deck_name'];
        $image = $_POST['image'];
        $username = $_SESSION['username'];
        $stmt = $connection->prepare("INSERT INTO tblDecks (dtUsername, dtDeckName, dtCards, dtExtraCards , dtImage) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $deck_name, $deck, $extraDeck , $image);
        $stmt->execute();
        $stmt->close();
        
    }

$connection->close();
?>