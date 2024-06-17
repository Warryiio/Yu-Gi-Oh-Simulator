<?php
    session_start();
    @include 'connect.php';
    if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password =$_POST['password'];
        $stmt = $connection->prepare("SELECT id FROM tblUsers WHERE dtEmail = ? AND dtPassword= ? ");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows != 0) {

            $stmt = $connection->prepare("SELECT dtUsername FROM tblUsers WHERE dtEmail = ? AND dtPassword= ? ");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $stmt->bind_result($username);
            $stmt->fetch();

            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $stmt->close();
            $connection->close();
            header("Location: /Yu-Gi-Oh-Simulator/Includes/Welcome.php");
        } else {
            $stmt->close();
            $connection->close();
            header("Location: /Yu-Gi-Oh-Simulator/?error=true");
        }

           
    }

?>