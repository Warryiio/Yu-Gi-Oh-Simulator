<?php
    //Dinis
    session_start();
    session_unset();
    session_destroy();
    header("Location: /Yu-Gi-Oh-Simulator/?logout=true");
?>