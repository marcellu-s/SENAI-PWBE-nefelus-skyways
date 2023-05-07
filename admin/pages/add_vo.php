<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php 

include_once "../../ops/db.php";

$data_min = DateTime::createFromFormat('Y-m-d H:i', date('Y-m-d H:i'));
$data_min->modify('+48 hours');
$data_min = $data_min->format('Y-m-d H:i:s');

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="js/jquery.js"></script>

<script src="../../js/add/query_cidade.js"></script>
<script src="../../js/add/query_aeroporto.js"></script>
<script src="../../js/add/query_aviao.js"></script>

<script src="../../js/add/conexao.js"></script>


<body>
    <div class="voo">
        <form action="../../ops/alteracoes.php" method="post">
            <input type="hidden" name="objeto" value="voo">
            <input type="hidden" name="op" value="add">
            <input type="hidden" name="qnt_conexao" id="qnt_conexao" value="0">
    
            <div class="form-voo">
                <label for="">Origem</label>
                <select required name="" class="estado">
                    <option value=''>...</option>
        
                    <?php 
        
                    $query_estados = mysqli_query($conn, "SELECT * FROM estado");
        
                    while($row=mysqli_fetch_assoc($query_estados)) {
                        echo "<option value='" . $row['id_estado'] . "'>" . $row['sigla_estado'] . " - " . $row['nome_estado'] . "</option>";
                    }
                    
                    ?>
        
                </select>
        
                <label for="">Cidade</label>
                <select required name="" class="cidade">
                    <option value=''>...</option>
                </select>
        
                <label for="">Aeroporto</label>
                <select required name="local_origem" class="aeroporto">
                    <option value=''>...</option>
                </select>
        
                <hr>
        
                <label for="">Destino</label>
                <select required name="" class="estado">
                    <option value=''>...</option>
        
                    <?php 
        
                    $query_estados = mysqli_query($conn, "SELECT * FROM estado");
        
                    while($row=mysqli_fetch_assoc($query_estados)) {
                        echo "<option value='" . $row['id_estado'] . "'>" . $row['sigla_estado'] . " - " . $row['nome_estado'] . "</option>";
                    }
                    
                    ?>
        
                </select>
        
                <label for="">Cidade</label>
                <select required name="" class="cidade">
                    <option value=''>...</option>
                </select>
        
                <label for="">Aeroporto</label>
                <select required name="local_destino" class="aeroporto">
                    <option value=''>...</option>
                </select>
        
                <hr>
        
                <label for="">Partida</label>
                <input type="datetime-local" min="<?php echo $data_min; ?>" required name="partida" id="">
        
                <label for="">Avião: </label>
                <select name="aviao" required id="aviao">
                    <option value=''>...</option>
                </select>
        
                <label for="">Preço assento econômico</label>
                <input type="number" required name="economica" id="">
        
                <label for="">Preço assento premium</label>
                <input type="number" required name="premium" id="">
            </div>
    
            <div id="gambiarra"></div>
            <hr>
            <input type="submit" value="">
        </form>
    </div>

    <button id="btn-conexao">Adicionar Conexão</button>
    <button id="btn-conexao-del">Retirar Conexão</button>
    
</body>

</html>