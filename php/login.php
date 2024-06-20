<?php
    session_start();
    @include 'connect.php';
    if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password =$_POST['password'];
        $stmt = $connection->prepare("SELECT id, dtUsername, dtPassword FROM tblUsers WHERE dtEmail = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id,$username,$hashed_pass);

        if ($stmt->num_rows != 0) {
            $stmt->fetch();
            if(password_verify($password,$hashed_pass)){
            $_SESSION['id']=$id;
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