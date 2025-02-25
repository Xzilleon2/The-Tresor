<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $databasename = "The_TresorDB";

    $conn = new mysqli($servername, $username, $password, $databasename);

    if($conn->connect_error){
        die("DB Connection Failed". $conn->connect_error);
    }
?>