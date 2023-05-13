<?php

include_once "../../ops/db.php";

$cpf = $_POST['cpf'];
$email = $_POST['email'];
$passport = $_POST['passport'];

$queryCpf = "SELECT COUNT(cpf) FROM pessoa WHERE cpf = '$cpf'";
$queryEmail = "SELECT COUNT(email) FROM cadastro WHERE email = '$email'";
$queryPassport = "SELECT COUNT(passaporte) FROM pessoa WHERE passaporte = '$passport'";

if ($passport) {

    $result = mysqli_query($conn, $queryPassport);

    if (mysqli_fetch_array($result)[0] > 0) {

        echo("O passaporte informado, já está em uso!");
        die();
    }
}

if ($cpf) {

    $result = mysqli_query($conn, $queryCpf);

    if (mysqli_fetch_array($result)[0] > 0) {

        echo("O CPF informado, já está em uso!");
        die();
    }
}

if ($email) {

    $result = mysqli_query($conn, $queryEmail);

    if (mysqli_fetch_array($result)[0] > 0) {

        echo("O email informado, já está em uso!");
        die();

    }
}

?>