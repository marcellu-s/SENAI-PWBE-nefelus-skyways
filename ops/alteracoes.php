<?php

include_once "./db.php";
session_start();

$objeto = $_POST['objeto'];
$op = $_POST['op'];

if ($objeto == 'aviao') {

    if ($op == 'add') {

        $matricula = $_POST['matricula'];

        $query_verif = mysqli_query($conn, "SELECT * FROM aviao WHERE matricula = '$matricula'");

        if (mysqli_num_rows($query_verif) > 0) {
            die("Matrícula já existente.");
        }

        $modelo = $_POST['modelo'];
        $carga = $_POST['carga'];
        $velocidade = $_POST['velocidade'];
        $fk_aeroporto = $_POST['aeroporto'];

        $query_aviao = "INSERT INTO aviao VALUES";
        $query_aviao .= " (default, '$modelo', '$matricula', $carga, $velocidade, $fk_aeroporto)";

        $result_query = mysqli_query($conn, $query_aviao);

    }
}

if ($objeto == 'voo') {

    if ($op = 'add') {

        $origem = $_POST['local_origem']; // FK do aeroporto que vai ser sair o voo
        $destino = $_POST['local_destino']; // FK do aeroporto que o voo vai chegar

        // MATA O PROGRAMA CASO ORIGEM SEJA IGUAL A DESTINO
        if ($origem == $destino) {
            die("Origem igual a destino, programa morto");
        }

        //   --   //   --   //   --   //   --   //   --   //   --   //   --   //   --   //

        $horario_partida = $_POST['partida'];
        $horario_partida = date('Y-m-d H:i:s', strtotime($horario_partida));

        // DATA E HORA ATUAL
        $datetime = new DateTime();

        // SOMA DE 48 HORAS
        $interval = new DateInterval('PT48H');
        $datetime->add($interval);

        // DATETIME MINIMO PARA FAZER AS QUERYS
        $datetime_min = $datetime->format('Y-m-d H:i:s');

        // MATA O PROGRAMA CASO A DATA DE PARTIDA SEJA MENOR QUE A DATA ATUAL MAIS 24 HORAS
        if ($horario_partida <= $datetime_min) {
            die("Data e horário menor que o atual");
        }

        //   --   //   --   //   --   //   --   //   --   //   --   //   --   //   --   //


        $aviao = $_POST['aviao'];

        $dados_aviao = mysqli_query($conn, "SELECT * FROM AVIAO WHERE id_aviao = $aviao");
        $dados_aviao = mysqli_fetch_array($dados_aviao);

        // VAI VERIFICAR SE O AVIAO PODE ESTÁ DISPONIVEL PARA VOO NO DADO AEROPORTO
        $query_verificadora = mysqli_query($conn,"SELECT destino FROM voo WHERE aviao = $aviao ORDER BY data_chegada DESC LIMIT 1");
        $verif = mysqli_fetch_assoc($query_verificadora);

        //   --   //   --   //   --   //   --   //   --   //   --   //   --   //   --   //
        
        //PARTE PARA PEGAR AS FKs DOS AEROPORTO DE CONEXAO
        $qnt_conexao = $_POST['qnt_conexao'];
        $locais_conexao = array();

        //   --   //   --   //   --   //   --   //   --   //   --   //   --   //   --   //


        if (@$verif['destino'] == $origem || @$verif['destino'] == null) {

            $economica = $_POST['economica'];
            $premium = $_POST['premium'];
    
            $query_assento = "INSERT INTO assento VALUES";
            $query_assento .= " (default, '$economica', '$premium')";
    
            $result_query = mysqli_query($conn, $query_assento);
    
            $fk_assento = mysqli_insert_id($conn); // Pega a ID da linha assento inserida acima
    
            //   --   //   --   //   --   //   --   //   --   //   --   //   --   //   --   //

            // COORDENADAS


            // Pega as coordenadas do aeroporto-origem e transforma em um array associativo com lat e lon
            $coord_origem = mysqli_query($conn, "SELECT latitude AS lat, longitude AS lon, nome  FROM aeroporto WHERE id_aeroporto = $origem");
            $coord_origem = mysqli_fetch_array($coord_origem);
            echo $origem."<br>";

            // Pega as coordenadas do aeroporto-destino e transforma em um array associativo com lat e lon
            $coord_destino = mysqli_query($conn, "SELECT latitude AS lat, longitude AS lon, nome  FROM aeroporto WHERE id_aeroporto = $destino");
            $coord_destino = mysqli_fetch_array($coord_destino);
            echo $destino."<br>";


            // Pega as coordenadas dos aeroportos de conexão e transforma em um array associativo com lat e lon
            if ($qnt_conexao > 0) {
                $conexao = 1;
    
                for($i = 1; $i < $qnt_conexao; $i++) {
                    $locais_conexao[$i] = $_POST['local_' . $i];
                    $local = $locais_conexao[$i];
                    $query_conn = "SELECT latitude AS lat, longitude AS lon, nome FROM aeroporto WHERE id_aeroporto = $local";
                    $coord_conexao[$i] = mysqli_fetch_array(mysqli_query($conn, $query_conn));
                    echo $coord_conexao[$i]['nome'] . " <-> " .  $coord_conexao[$i]['lat'] . " <-> " . $coord_conexao[$i]['lon']. "<br>";
                }
            } else {
                $conexao = 0;
            }
    
            // Importa a função do calculo de distancia
            include_once("./funcoes.php");

            // Calculo de distancia por coordenada
            if ($conexao == 0) {
                // echo $coord_origem['lat']. " <-> " .$coord_origem['lon']. '<br>';
                // echo $coord_destino['lat']. " <-> " .$coord_destino['lon']. '<br>';
                $distancia_total = distancia($coord_origem['lat'], $coord_origem['lon'], $coord_destino['lat'], $coord_destino['lon']);
                $distancia_total = round($distancia_total, 2);
                // echo $distancia;

            } else {

                $distancia[1] = distancia($coord_origem['lat'], $coord_origem['lon'], $coord_conexao[1]['lat'], $coord_conexao[1]['lon']);
                $distancia[1] = round($distancia[1], 2);
                $distancia_total = $distancia[1];
                // echo '<br>'.$coord_origem['nome']. "<br>";
                // echo $distancia[1].'<br>';
                // echo $coord_conexao[1]['nome']. "<br>";

                
                for($con = 2; $con < $qnt_conexao; $con++) {
                    $distancia[$con] = distancia($coord_conexao[$con - 1]['lat'], $coord_conexao[$con - 1]['lon'], $coord_conexao[$con]['lat'], $coord_conexao[$con]['lon']);
                    $distancia[$con] = round($distancia[$con], 2);
                    $distancia_total += $distancia[$con];
                    // echo $distancia[$con].'<br>';
                    // echo $coord_conexao[$con]['nome']. "<br>";
                }
                
                $distancia[$qnt_conexao] = distancia($coord_conexao[$con - 1]['lat'], $coord_conexao[$con - 1]['lon'], $coord_destino['lat'], $coord_destino['lon']);
                $distancia[$qnt_conexao] = round($distancia[$qnt_conexao], 2);
                $distancia_total += $distancia[$qnt_conexao];
                // echo $distancia[$qnt_conexao].'<br>';
                // echo $coord_destino['nome']. "<br>";
            }
            
            // Duração da viagem em segundos e depois em horario 
            $duracao = ( $distancia_total / $dados_aviao['velocidade']) * 3600;
            $duracao = gmdate("H:i:s", $duracao);

            // Operação para arrendondar o tempo de duração aos 5 minutos inteiros mais proximos
            $timestamp = strtotime($duracao); // convertendo para timestamp Unix
            $cinco_min = 5 * 60; // em segundos
            $duracao_aprox = round($timestamp / $cinco_min) * $cinco_min;

            $duracao = date("H:i:s", $duracao_aprox);
    
            $horario_partida = date('Y-m-d H:i:s', strtotime($horario_partida));
    
            // Convertendo o horário para segundos
            $duracao_em_segundos = strtotime($duracao) - strtotime('00:00:00');
    
            // Somando o horário ao datetime
            $data_chegada = date('Y-m-d H:i:s', strtotime($horario_partida) + $duracao_em_segundos);
    
            // $escala = ;

            $query_voo = "INSERT INTO voo ";
            $query_voo .= "VALUES (default, $origem, $destino, '$duracao', 
            $distancia_total, '$horario_partida', '$data_chegada', $aviao, $fk_assento, $conexao)";

            for($i = 0; $i < $qnt_conexao; $i++) {
                $query_conexoes = "INSERT INTO conexao ";
                $query_conexoes .= "VALUES (default, ";
                if ($i == 0) {
                    $query_conexoes .= $origem.", ".$locais_conexao[$i + 1].", ". $distancia[$i + 1].")";
                } elseif ($i < $qnt_conexao - 1) {
                    $query_conexoes .= $locais_conexao[$i].", ".$locais_conexao[$i + 1].", ". $distancia[$i + 1].")";
                } else {
                    $query_conexoes .= $locais_conexao[$i].", ".$destino.", ". $distancia[$i + 1].")";
                }
                echo $query_conexoes;
                $result_conexoes = mysqli_query($conn, $query_conexoes);

                $query_conexoes = "";
            }
    
            $result_voo = mysqli_query($conn, $query_voo);

        } else {
            echo '<br>Inválido pois destino diferente de origem do voo proposto';
        }
    }
}

if ($objeto == 'aeroporto') {

    if ($op == 'add') {

        $sigla = $_POST['sigla'];
        $nome = $_POST['nome'];
        
        // OP ABAIXO PARA CONVERTER A SIGLA DO ESTADO EM UMA FK QUE FAZ REFERENCIA AO ID DO ESTADO
        $cidade = $_POST['cidade'];
        
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        
        $query_verif = mysqli_query($conn, "SELECT * FROM aeroporto WHERE sigla = '$sigla'");
        echo mysqli_num_rows($query_verif);
        if (mysqli_num_rows($query_verif)) {
            $_SESSION['callback'] = "Aeroporto não registrado. Sigla igual a alguma existente. $sigla";
            header("Location: ./add_aeroporto.php");
            die();
        }

        $query_verif = mysqli_query($conn, "SELECT * FROM aeroporto WHERE fk_cidade = $cidade AND nome = '$nome'");
        if (mysqli_num_rows($query_verif)) {
            $_SESSION['callback'] = 'Aeroporto não registrado. Nome de aeroporto igual numa mesma cidade.';
            header("Location: ./add_aeroporto.php");
            die();
        }

        $query_verif = mysqli_query($conn, "SELECT * FROM aeroporto WHERE $latitude = $latitude AND longitude = $longitude");
        if (mysqli_num_rows($query_verif)) {
            $_SESSION['callback'] = 'Aeroporto não registrado. Latitude e longitude iguais a de outro aeroporto existente.';
            header("Location: ./add_aeroporto.php");
            die();
        }
        
        $query_aeroporto = "INSERT INTO aeroporto VALUES";
        $query_aeroporto .= " (default, '$sigla', '$nome', '$cidade', $latitude, $longitude)";

        $result_query = mysqli_query($conn, $query_aeroporto);

        $_SESSION['callback'] = 'Aeroporto registrado com sucesso.';
        header("Location: ./add_aeroporto.php");
    }
}

if ($objeto == 'cidade') {

    if ($op == 'add') {

        $estado = $_POST['estado'];
        $nome_cidade = $_POST['cidade'];
        
        $query_verif = mysqli_query($conn, "SELECT COUNT(*) AS qnt FROM cidade WHERE fk_estado = $estado and nome_cidade = '$nome_cidade'");
        $query_verif = mysqli_fetch_assoc($query_verif);

        if ($query_verif['qnt'] == 0) {
            $query_cidade = mysqli_query($conn, "INSERT INTO cidade VALUES (default, $estado, '$nome_cidade')");

            $_SESSION['callback'] = "Cidade adicionada com sucesso.";
            header("Location: ./add_cidade.php");
        } else {
            $_SESSION['callback'] = "Não foi possível adicionar a cidade(Já existente).";
            header("Location: ./add_cidade.php");
        }
    }

}