<?php
session_start();
    @include 'connect.php';
    $username = $_SESSION['username'];
    $stmt = $connection->prepare("SELECT id, dtDeckName, dtCards, dtImage FROM tblDecks WHERE dtUsername = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data = [];
        foreach ($result as $res) {
            $t = [];
            $t['id'] = $res['id'];
            $t['deckName'] = $res['dtDeckName'];
            $t['cards'] = $res['dtCards'];
            $t['image'] = $res['dtImage'];
            $data[] = $t;
        }
        echo json_encode(['results' => $data]);
    }
} else {
    echo "0 results";
}

$stmt->close();
$connection->close();
?>