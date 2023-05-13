<?php 
    session_start();

    if (isset($_SESSION['callback'])) {
        echo($_SESSION['callback']);
        unset($_SESSION['callback']);
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/icons/favicon.ico" type="image/x-icon">
    <title>Entrar - Nefelus SkyWays</title>
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/login/style.css">
</head>
<body>
    <main>
        <section class="register-passenger-area" style="margin-top: 0;">
            <div class="register-passenger-header">
                <a href="../index.php"><img src="../assets/img/icons/logo.png" alt="" srcset=""></a>
                <h1>Entrar em sua conta</h1>
            </div>
            <form action="../assets/php/loginProcess.php" method="POST">
                <div class="input-control">
                    <label for="email">E-MAIL</label>
                    <input type="email" id="email" name="email" >
                </div>
                <div class="input-control">
                    <label for="password">SENHA</label>
                    <input type="password" id="password" name="password" >
                </div>
                <div class="input-btn">
                    <button type="submit">Entrar</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>