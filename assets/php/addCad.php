<?php

session_start();

include_once "../../ops/db.php";

date_default_timezone_set('America/Sao_Paulo');

// COLETANDO OS DADOS VIA POST

$firstName = $_POST['first-name'];
$lastName = $_POST['last-name'];
$dateBirth = $_POST['date-of-birth'];
$gender = $_POST['gender'];
$nationality = $_POST['nationality'];
$telephone = $_POST['telephone'];
$address = "$_POST[endereco]; $_POST[bairro]; $_POST[cidade]; $_POST[uf]; $_POST[numero]; $_POST[cep]";
$passport = $_POST['passport'];
$email = $_POST['email'];
$password = sha1($_POST['password']);

$cpfExist = false;

if (!isset($_POST['no-cpf'])) {

    $cpfExist = true;

    $cpf = $_POST['cpf'];
}

// Definir o ID para a foreign key

$queryDefineID = mysqli_query($conn, "SELECT COUNT(id_pessoa) FROM pessoa");

$result = mysqli_fetch_array($queryDefineID);

$id = $result[0] + 1;

$queryCadastro = "INSERT INTO cadastro (email, telefone, senha, fk_pessoa) VALUES (
    '$email', '$telephone', '$password', $id
)";

if ($cpfExist) {

    $queryPessoa = "INSERT INTO pessoa (id_pessoa, p_nome, p_sobrenome, endereco, data_nasc, sexo, nacionalidade, cpf, passaporte) VALUES (
        $id, '$firstName', '$lastName', '$address', '$dateBirth', '$gender', '$nationality', '$cpf', '$passport'
    )";

} else {

    $queryPessoa = "INSERT INTO pessoa (id_pessoa, p_nome, p_sobrenome, endereco, data_nasc, sexo, nacionalidade, cpf, passaporte) VALUES (
        $id, '$firstName', '$lastName', '$address', '$dateBirth', '$gender', '$nationality', NULL, '$passport'
    )";
}

mysqli_query($conn, $queryPessoa);
mysqli_query($conn, $queryCadastro);

if (mysqli_affected_rows($conn)) {

    $_SESSION['callback'] = "<script>window.alert('Cadastro realizado com sucesso!')</script>";
    header("location: ../../index.php");
} else {

    $_SESSION['callback'] = "<script>window.alert('Falha ao realizar o cadastro!')</script>";
}

?>