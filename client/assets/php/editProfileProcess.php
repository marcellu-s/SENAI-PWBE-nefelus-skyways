<?php

session_start();

include_once "../../../ops/db.php";

$firstName = $_POST['first-name'];
$lastName = $_POST['last-name'];
$gender = $_POST['gender'];
$nacionality = $_POST['nacionality'];
$telephone = $_POST['telephone'];
$address = "$_POST[endereco];$_POST[bairro];$_POST[cidade];$_POST[uf];$_POST[numero];$_POST[cep]";
$email = $_POST['email'];


$updatePassword = false;

if ($_POST['old-password'] != '' && $_POST['new-password'] != '') {

    $oldPsw = sha1($_POST['old-password']);
    $newPsw = sha1($_POST['new-password']);

    $updatePassword = true;
}

if ($updatePassword === true) {

    $queryVerifyPsw = "SELECT senha FROM cadastro
    WHERE id_cadastro = $_SESSION[loginID]";

    $result = $conn->query($queryVerifyPsw);

    if ($result->num_rows == 1) {

        $psw = $result->fetch_array()[0];

        if ($oldPsw != $psw) {

            $_SESSION['callback'] = "<script>window.alert('A senha antiga é diferente da armazenada!')</script>";
            header("location: ../../pages/myAccount.php");
            die();

        } else {

            $updatePassword = true;
        }

    } else {

        $_SESSION['callback'] = "<script>window.alert('Um erro aconteceu! Tente novamente!')</script>";
        header("location: ../../pages/myAccount.php");
        die();
    }


}

$queryPessoa = "UPDATE pessoa
INNER JOIN cadastro 
ON pessoa.id_pessoa = cadastro.fk_pessoa
SET
p_nome = '$firstName', 
p_sobrenome = '$lastName', 
sexo = '$gender',
nacionalidade = '$nacionality',
endereco = '$address'
WHERE cadastro.id_cadastro = $_SESSION[loginID]";

if ($updatePassword === true) {

    $queryCadastro = "UPDATE cadastro
    SET email = '$email', telefone = '$telephone', senha = '$newPsw'
    WHERE id_cadastro = $_SESSION[loginID]";

} else{

    $queryCadastro = "UPDATE cadastro
    SET email = '$email', telefone = '$telephone'
    WHERE id_cadastro = $_SESSION[loginID]";
}

$resultPessoa = $conn->query($queryPessoa);
$resultCadastro = $conn->query($queryCadastro);

$_SESSION['callback'] = "<script>window.alert('Atualização feita com sucesso!')</script>";
header("location: ../../pages/myAccount.php");

?>