<?php
session_start();
@include 'connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $deck = $_POST['deck'];
    $deck_name = $_POST['deck_name'];
    $image = $_POST['image'];
    $username = $_SESSION['username'];
    $stmt = $connection->prepare("INSERT INTO tblDecks (dtUsername, dtDeckName, dtCards, dtImage) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $deck_name, $deck, $image);
    $stmt->execute();
    $stmt->close();
    
}

$connection->close();
?>