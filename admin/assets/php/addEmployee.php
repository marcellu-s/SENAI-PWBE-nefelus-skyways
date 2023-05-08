<?php

// Iniciar uma sessão e conectar-se ao banco de dados.
session_start();
include_once "../../../ops/db.php";

// Pegar as informações do fomulário.
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$genero = $_POST['gender'];
$nascimento = $_POST['nascimento'];
$endereco = "" . $_POST['cep'] . " | " . $_POST['endereco'] . ", " . $_POST['numero'] . " - " . $_POST['bairro'] . " | " . $_POST['cidade'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$senha = sha1($_POST['senha']);
$job = $_POST['job'];

// Queries para a tabela CADASTROS.

$queryDefineID = mysqli_query($conn, "SELECT COUNT(id_pessoa) FROM pessoa");

$result = mysqli_fetch_array($queryDefineID);

$id = $result[0] + 1;

$q1 = "INSERT INTO pessoa (id_pessoa, p_nome, p_sobrenome, endereco, data_nasc, sexo, nacionalidade, cpf) VALUES (
    $id, '$nome', '$sobrenome', '$endereco', '$nascimento', '$genero', NULL, '$cpf'
)";

$q2 = "INSERT INTO cadastro (email, telefone, senha, fk_pessoa) VALUES (
    '$email', '$celular', '$senha', $id
)";

$q3 = "INSERT INTO funcionario (funcao, fk_pessoa, fk_cadastro) VALUES (
    '$job', $id, $id
)";

// $qc1 = "INSERT INTO cadastro (email, telefone, senha, fk_pessoa) VALUES('$email', '$senha', 2)";

$qc2 = "SELECT COUNT(*) FROM cadastro WHERE email = '$email'";
$qc3 = "SELECT COUNT(*) FROM cadastro WHERE telefone = '$celular'";
$qc4 = "SELECT COUNT(*) FROM pessoa WHERE cpf = '$cpf'";

$erro = false;

if (mysqli_fetch_array(mysqli_query($conn, $qc2))[0] > 0) {
    $_SESSION['callback'] = "<script>alert('Email já cadastrado.')</script>";
    header("Location: ../../pages/add_funcionario.php");
    $erro = true;
};

if (mysqli_fetch_array(mysqli_query($conn, $qc3))[0] > 0) {
    $_SESSION['callback'] = "<script>alert('Celular já cadastrado.')</script>";
    header("Location: ../../pages/add_funcionario.php");
    $erro = true;
};

if (mysqli_fetch_array(mysqli_query($conn, $qc4))[0] > 0) {
    $_SESSION['callback'] = "<script>alert('CPF já cadastrado.')</script>";
    header("Location: ../../pages/add_funcionario.php");
    $erro = true;

};

// Enviar para a Database.

if (!$erro === true) {
    mysqli_query($conn, $q1);
    mysqli_query($conn, $q2);
    mysqli_query($conn, $q3);
    $_SESSION['callback'] = "<script>alert('Conta cadastrada com sucesso!')</script>";
    header("Location: ../../pages/add_funcionario.php");
};

?>