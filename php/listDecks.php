<?php
    session_start();
    @include 'connect.php';
    $username= $_SESSION['username'];
    $sql = "SELECT id, dtDeckName, dtImage FROM tblDecks WHERE dtUsername=$username";
    $result = $connection->query($sql);

    $decks = array();
    
    if (mysqli_num_rows($result) > 0) {
        // Anzahl der erhaltenen Datensetze.
        $numRows = mysqli_num_rows($result);
    
        // Daten aus jeder Reihe ausgeben (Pfankuchen vom Stapel nehmen)
        for ($i=0; $i < $numRows; $i++) { 
            $row = mysqli_fetch_assoc($result);
            $decks[] = array(
                'id' => $row['id'],
                'name' => $row['dtDeckName'],
                'first_card_image' => $row['dtImage']
            );
        }
    } else {
        echo "0 Ergebnisse gefunden";
    }

    echo json_encode($decks);
    $connection->close();

?>