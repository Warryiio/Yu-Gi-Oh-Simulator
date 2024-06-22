<?php
session_start();
   @include 'connect.php';

   if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $deck_id = $_GET['id'];

    $sql = "SELECT cards FROM decks WHERE id = '$deck_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $deck = $result->fetch_assoc();
        echo json_encode($deck);
    } else {
        echo "No deck found";
    }
}

$conn->close();

?>