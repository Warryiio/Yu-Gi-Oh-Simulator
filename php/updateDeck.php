<?php
session_start();
@include 'connect.php'; // Ensure this includes your database connection code

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $id = $_POST['id'];
        $deck = $_POST['deck'];
        $extraDeck = $_POST['extraDeck'];
        $deck_name = $_POST['deck_name'];
        $image = $_POST['image'];
        $username = $_SESSION['username'];

        // Prepare the SQL statement
        $stmt = $connection->prepare("UPDATE tblDecks SET dtDeckName = ?, dtCards = ?, dtExtraCards = ?, dtimage = ? WHERE id = ? AND dtUsername = ?");

        // Bind parameters
        $stmt->bind_param("ssssss", $deck_name, $deck,$extraDeck,$image,$id,$username);

        // Execute the prepared statement
        $stmt->execute();
        
        echo "Record updated successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Close the connection
$connection = null;
?>