<?php
    session_start();
    @include 'connect.php';
    if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password =$_POST['password'];
        $stmt = $connection->prepare("SELECT id FROM tblUsers WHERE dtEmail = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows != 0) {
            $stmt = $connection->prepare("SELECT dtPassword FROM tblUsers WHERE dtEmail = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $hashed_pass= $stmt->get_result();
            echo ""+password_verify($password,$hashed_pass);
            if(password_verify($password,$hashed_pass)){
            $stmt = $connection->prepare("SELECT dtUsername FROM tblUsers WHERE dtEmail = ?");
            $stmt->bind_param("ss", $email, );
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

        } else {
            $stmt->close();
            $connection->close();
            header("Location: /Yu-Gi-Oh-Simulator/?error=true");
        }

           
    }

?>