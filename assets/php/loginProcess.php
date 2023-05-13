<?php

session_start();

$email = $_POST['email'];
$password = sha1($_POST['password']);

// Verifica se nenhum dos campos está vazio

if (empty($email) || empty($password)) {

    $_SESSION['callback'] = "<script>window.alert('Informe seu E-MAIL e SENHA!')</script>";
    header("location: ../../pages/login.php");
    die();
}

include_once "../../ops/db.php";

// Query para encontrar uma conta de acordo com o email e senha inseridos
// além de pegar o id

$queryLogin = "SELECT id_cadastro FROM cadastro WHERE email = '$email' AND senha = '$password'";

$result = $conn->query($queryLogin);

// Verificar se foi possível encontrar a conta

if ($result->num_rows > 0) {

    // Pegar o ID da conta

    $id = $result->fetch_array()[0];

    // Definir o tipo da conta - Admin, Comum etc

    $accountType = NULL;

    $queryTypeLogin = "SELECT funcao FROM funcionario WHERE fk_cadastro = $id";

    $resultTypeLogin = $conn->query($queryTypeLogin);

    if ($resultTypeLogin->num_rows > 0) {

        $accountType = $resultTypeLogin->fetch_array()[0];

    } else {

        $accountType = 'cliente';
    }

    $_SESSION['login'] = $accountType;
    $_SESSION['loginID'] = $id;

    $_SESSION['callback'] = "<script>window.alert('Login efetuado com sucesso!')</script>";
    header("location: ../../index.php");

} else {

    $_SESSION['callback'] = "<script>window.alert('Não foi possível encontrar sua conta')</script>";
    header("location: ../../pages/login.php");
}

?>