<?php
    //Dinis
    session_start();
    if(!isset($_SESSION['username']) && !isset($_SESSION['email'])) {
        header("Location: /Yu-Gi-Oh-Simulator/?notLoggedIn=true");  
    }
?>