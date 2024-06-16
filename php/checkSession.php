<?php
    session_start();
    if(!isset($_SESSION['uesrname']) && !isset($_SESSION['enail'])) {
        header("Location: /Yu-Gi-Oh-Simulator/?notLoggedIn=true");  
        exit;
    }
?>