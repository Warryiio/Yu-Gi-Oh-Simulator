<?php
    @include 'connect.php';
    if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password =$_POST['password'];
        $stmt = $connection->prepare("SELECT id FROM tblUsers WHERE dtEmail = ? OR dtUsername= ? ");
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows != 0) {
            $stmt->close();
            $connection->close();
            header("Location: /Yu-Gi-Oh-Simulator/Includes/Welcome.php");
        } else {
            $stmt->execute();
            $stmt->close();
            $connection->close();
            header("Location: /Yu-Gi-Oh-Simulator/?error=true");
        }

           
    }

?>