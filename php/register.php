<?php
    @include 'connect.php';
        if(isset($_POST['submit'])) {
            $username= $_POST['username'];
            $email = $_POST['email'];
            $password =$_POST['password'];
            // Email validation pattern
            $pattern = '/^[\w\.-]+@(gmail\.com|yahoo\.com|outlook\.com|hotmail\.com|school\.lu)$/';

        // Validate email
        if (!preg_match($pattern, $email)) {
            header("Location: /Yu-Gi-Oh-Simulator/Includes/Registration.php?emailError=true");
        } else {
                $stmt = $connection->prepare("SELECT id FROM tblUsers WHERE dtEmail = ? OR dtUsername= ? ");
                $stmt->bind_param("ss", $email, $username);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows != 0) {
                    $stmt->close();
                    header("Location: /Yu-Gi-Oh-Simulator/Includes/Registration.php?error=true");
                } else {
                    $hashed_pass= password_hash($password,PASSWORD_DEFAULT);
                    $stmt = $connection->prepare("INSERT INTO tblUsers (dtUsername, dtEmail, dtPassword) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $username, $email, $hashed_pass);
                    $stmt->execute();
                    $stmt->close();
                    header("Location: /Yu-Gi-Oh-Simulator/Includes/Registration.php?success=true");
                }

            }
        }
        $connection->close();

?>