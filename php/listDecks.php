<?php
    session_start();
    @include 'connect.php';
    
    $username = $_SESSION['username'];
    $stmt = $connection->prepare("SELECT id, dtDeckName, dtImage FROM tblDecks WHERE dtUsername = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id,$deckName,$image);

    $decks = array();
    
    if (mysqli_num_rows($result) > 0) {
        // Anzahl der erhaltenen Datensetze.
        $numRows = mysqli_num_rows($result);
        $stmt->fetch();
        // Daten aus jeder Reihe ausgeben (Pfankuchen vom Stapel nehmen)
        for ($i=0; $i < $numRows; $i++) { 
            $row = mysqli_fetch_assoc($result);
            $decks[] = array(
                'id' => $id,
                'name' => $deckName,
                'first_card_image' => $image,
            );
        }
    } else {
        echo "0 Ergebnisse gefunden";
    }

    echo json_encode($decks);
    $connection->close();

?>
<?php
session_start();
@include 'connect.php';

$username = $_SESSION['username'];
$sql = "SELECT id, dtDeckName, dtImage FROM tblDecks WHERE dtUsername= $username";
$result = $connection->query($sql);

$decks = [];
while ($row = $result->fetch_assoc()) {
    $row['cards'] = unserialize($row['cards']);
    $decks[] = $row;
}

echo json_encode($decks);

$conn->close();
?>