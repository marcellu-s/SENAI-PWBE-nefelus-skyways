<?php

    session_start();

    if (isset($_SESSION['callback'])) {
        echo($_SESSION['callback']);
        unset($_SESSION['callback']);
    }

    include_once "../../ops/db.php";

    $data_min = DateTime::createFromFormat('Y-m-d H:i', date('Y-m-d H:i'));
    $data_min->modify('+48 hours');
    $data_min = $data_min->format('Y-m-d H:i:s');

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/img/icons/favicon.ico" type="image/x-icon">
    <title>Adicionar voo</title>
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
                <h1>Adicionar voo</h1>
            </div>
            <form action="../../ops/alteracoes.php" method="post">

                <input type="hidden" name="objeto" value="voo">
                <input type="hidden" name="op" value="add">
                <input type="hidden" name="qnt_conexao" id="qnt_conexao" value="0">

                <div class="input-control">
                    <label for="estado">ORIGEM</label>
                    <select required name="estado" class="estado" id="estado">
                        <option value=''>...</option>
                        <?php 
            
                        $query_estados = mysqli_query($conn, "SELECT * FROM estado");
            
                        while($row=mysqli_fetch_assoc($query_estados)) {
                            echo "<option value='" . $row['id_estado'] . "'>" . $row['sigla_estado'] . " - " . $row['nome_estado'] . "</option>";
                        }
                        
                        ?>
                    </select>
                </div>
                <div class="input-control">
                    <label for="cidade">CIDADE - ORIGEM</label>
                    <select required name="" class="cidade" id="cidade">
                        <option value=''>...</option>
                    </select>
                </div>
                <div class="input-control">
                    <label for="aeroporto">AEROPORTO - ORIGEM</label>
                    <select required name="local_origem" class="aeroporto" id="aeroporto">
                        <option value=''>...</option>
                    </select>
                </div>
                <div class="input-control">
                    <label for="destino">DESTINO</label>
                    <select required name="destino" class="estado" id="destino">
                        <option value=''>...</option>
                        <?php 
            
                        $query_estados = mysqli_query($conn, "SELECT * FROM estado");
            
                        while($row=mysqli_fetch_assoc($query_estados)) {
                            echo "<option value='" . $row['id_estado'] . "'>" . $row['sigla_estado'] . " - " . $row['nome_estado'] . "</option>";
                        }
                        
                        ?>
                    </select>
                </div>
                <div class="input-control">
                    <label for="idade-destino">CIDADE - DESTINO</label>
                    <select required name="" class="cidade" id="cidade-destino">
                        <option value=''>...</option>
                    </select>
                </div>
                <div class="input-control">
                    <label for="aeroporto-destino">AEROPORTO - DESTINO</label>
                    <select required name="local_destino" class="aeroporto" id="aeroporto-destino">
                        <option value=''>...</option>
                    </select>
                </div>
                <div class="input-control">
                    <label for="partida">DATA DE PARTIDA</label>
                    <input type="datetime-local" min="<?php echo $data_min; ?>" required name="partida" id="partida">
                </div>
                <div class="input-control">
                    <label for="aviao">AVIÃO</label>
                    <select name="aviao" required id="aviao">
                        <option value=''>...</option>
                    </select>
                </div>
                <div class="input-control">
                    <label for="assento-economica">PREÇO ASSENTO ECONÔMICA</label>
                    <input type="number" required name="economica" id="assento-economica">
                </div>
                <div class="input-control">
                    <label for="assento-premium">PREÇO ASSENTO PREMIUM</label>
                    <input type="number" required name="premium" id="assento-premium">
                </div>
                <span id="gambiarra"></span>
                <div class="input-btn">
                    <button type="button" id="btn-conexao">Adicionar Conexão</button>
                    <button type="button" id="btn-conexao-del">Retirar Conexão</button>
                    <button type="submit">Adicionar</button>
                </div>
            </form>
        </section>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="../assets/js/add/query_cidade.js"></script>
    <script src="../assets/js/add/query_aeroporto.js"></script>
    <script src="../assets/js/add/query_aviao.js"></script>

    <!-- <script src="../assets/js/add/conexao.js"></script> -->
    
</body>
</html>