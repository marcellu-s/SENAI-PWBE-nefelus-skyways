<?php

include_once "../../ops/db.php";

$status = 200;
$txt = 'Mensagem não enviada! Tente novamente mais tarde';

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $query = "INSERT INTO contato (nome, email, assunto, mensagem) VALUES (
        '$name', '$email', '$subject', '$message'
    )";

    $result = mysqli_query($conn, $query);

    if (mysqli_error($conn)) {

        $status = 500;
    }


} else {
    $status = 500;
}

if ($status == 200) {

    $txt = 'Sua mensagem foi enviada com sucesso!';
}

$response = [
    'status' => $status,
    'msg' => $txt
];

echo(json_encode($response));

?>