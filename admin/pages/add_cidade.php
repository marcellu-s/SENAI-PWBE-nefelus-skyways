<?php

    session_start();

    if (isset($_SESSION['callback'])) {
        echo($_SESSION['callback']);
        unset($_SESSION['callback']);
    }

    include_once "../../ops/db.php";

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/img/icons/favicon.ico" type="image/x-icon">
    <title>Adicionar cidade</title>
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
                <h1>Adicionar cidade</h1>
            </div>
            <form action="../../ops/alteracoes.php" method="post">

                <input type="hidden" name="objeto" value="cidade">
                <input type="hidden" name="op" value="add">

                <div class="input-control">
                    <label for="estado">ESTADO</label>
                    <select name="estado" id="estado" class="estado">
                        <option value="" selected disabled>...</option>
                        <?php 

                            $query_estados = mysqli_query($conn, "SELECT * FROM estado");

                            while($row=mysqli_fetch_assoc($query_estados)) {
                                echo "<option value='" . $row['id_estado'] . "'>" . $row['sigla_estado'] . " - " . $row['nome_estado'] . "</option>";
                            }
                        
                        ?>
                    </select>
                </div>
                <div class="input-control">
                    <label for="cidade">CIDADE</label>
                    <input type="text" name="cidade" maxlength="50" id="cidade">
                </div>
                <div class="input-btn">
                    <button type="submit">Adicionar</button>
                </div>
            </form>
        </section>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="../assets/js/add/query_cidade.js"></script>
    
</body>
</html>