<?php

// Iniciar uma sessão e conectar-se ao banco de dados.
session_start();
include_once "../../../ops/db.php";

// Pegar as informações do fomulário.
$nome = $_POST['first-name'];
$sobrenome = $_POST['last-name'];
$genero = $_POST['gender'];
$nascimento = $_POST['date-of-birth'];
$endereco = "$_POST[endereco];$_POST[bairro];$_POST[cidade];$_POST[uf];$_POST[numero];$_POST[cep]";
$cpf = $_POST['cpf'];
$celular = $_POST['telephone'];
$email = $_POST['email'];
$senha = sha1($_POST['password']);
$job = $_POST['job'];

// Definir o ID

$queryDefineID = mysqli_query($conn, "SELECT COUNT(id_pessoa) FROM pessoa");

$result = mysqli_fetch_array($queryDefineID);

$id = $result[0] + 1;

// Queries de Inserção

$queryPessoa = "INSERT INTO pessoa (id_pessoa, p_nome, p_sobrenome, endereco, data_nasc, sexo, cpf) VALUES (
    $id, '$nome', '$sobrenome', '$endereco', '$nascimento', '$genero', '$cpf'
)";

$queryCadastro = "INSERT INTO cadastro (id_cadastro, email, telefone, senha, fk_pessoa) VALUES (
    $id, '$email', '$celular', '$senha', $id
)";

$queryFuncionario = "INSERT INTO funcionario (funcao, fk_pessoa, fk_cadastro) VALUES (
    '$job', $id, $id
)";

// Executando as queries

$result = $conn->query($queryPessoa);

if (mysqli_error($conn)) {

    $_SESSION['callback'] = "<script>window.alert('ERRO ao cadastrar!')</script>";
    header("location: ../../pages/main.php");
    die();
}

$conn->query($queryCadastro);

if (mysqli_error($conn)) {

    $_SESSION['callback'] = "<script>window.alert('ERRO ao cadastrar!')</script>";
    header("location: ../../pages/main.php");
    die();
}
$conn->query($queryFuncionario);

if (mysqli_error($conn)) {

    $_SESSION['callback'] = "<script>window.alert('ERRO ao cadastrar!')</script>";
    header("location: ../../pages/main.php");
    die();
}

$_SESSION['callback'] = "<script>window.alert('Cadastro efetuado com sucesso!')</script>";
header("location: ../../pages/addEmployee.php");

?>