<?php

    $host = 'localhost';
    $user = 'root';
    $senha = '';
    $database = 'skywaysbd';

    $conn = new mysqli($host, $user, $senha, $database);

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }


?>
