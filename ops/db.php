<?php

    $host = 'localhost';
    $user = 'root';
    $senha = 'SQL04df478fpk8';
    $database = 'skywaysbd';

    $conn = new mysqli($host, $user, $senha, $database);

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }


?>