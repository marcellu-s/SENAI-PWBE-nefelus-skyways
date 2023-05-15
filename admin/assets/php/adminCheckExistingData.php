<?php

include_once "../../../ops/db.php";

$cpf = $_POST['cpf'];
$email = $_POST['email'];

$queryCpf = "SELECT COUNT(cpf) FROM pessoa WHERE cpf = '$cpf'";
$queryEmail = "SELECT COUNT(email) FROM cadastro WHERE email = '$email'";

if ($cpf) {

    $result = $conn->query($queryCpf);

    if ($result->fetch_array()[0] > 0) {

        echo("O CPF informado, já está em uso!");
        die();
    }
}

if ($email) {

    $result = $conn->query($queryEmail);

    if ($result->fetch_array()[0] > 0) {

        echo("O email informado, já está em uso!");
        die();

    }
}

?>