<?php

if (isset($_GET['id']) && isset($_GET['op'])) {

    $id = $_GET['id'];
    $op = $_GET['op'];
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/img/icons/favicon.ico" type="image/x-icon">
    <title>Sem registro</title>
    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- FONTS GOOGLE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/adicionar/style.css">
</head>
<body>
    <header>
        <div class="back-page">
            <a href="../pages/main.html"><i class="bi bi-folder-symlink-fill"></i> - Voltar</a>
        </div>
    </header>
    <main>
        <section class="register-passenger-area">
            <div class="register-passenger-header">
                <h1 class="title">Sem registro</h1>
            </div>
            <form>
                <input type="hidden" name="id" value="<?php echo($id); ?>" id="id">
                <input type="hidden" name="op" value="<?php echo($op); ?>" id="op">
            </form>
        </section>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="../assets/js/details/requestDetails.js"></script>
</body>
</html>