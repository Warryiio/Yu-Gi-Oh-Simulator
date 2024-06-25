<?php 
    //Luka
    $hostname = '89.58.47.144'; // Der Hostname der Datenbank
    $username = 'YGO_User'; // Der MySQL-Benutzername
    $password = 'ygopw'; // Das MySQL-Passwort
    $dbname = 'dbYGO'; // Der Name der Datenbank

    $connection = mysqli_connect($hostname, $username, $password, $dbname) ;
    
    if (!$connection) {
        die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
    }

?>