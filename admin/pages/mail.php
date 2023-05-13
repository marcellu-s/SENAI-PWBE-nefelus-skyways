<?php

date_default_timezone_set('America/Sao_Paulo');

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../../assets/img/icons/favicon.ico" type="image/x-icon">
  <title>Caixa de correio - Nefelus SkyWays</title>
  <link rel="stylesheet" href="../assets/css/mail/style.css">
  <!-- BOOTSTRAP ICONS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
  <!-- GOOGLE FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
    rel="stylesheet">
</head>
<body>
  <header>
    <div class="back-page">
      <a href="../pages/main.html"><i class="bi bi-folder-symlink-fill"></i> - Voltar</a>
    </div>
  </header>
  <main>
    <div class="search-area">
      <div class="serch-header">
        <h1>Visualizar mensagens enviadas</h1>
      </div>
      <form>
        <div class="input-control">
          <label for="subject">ASSUNTO</label>
          <input type="text" name="subject" id="subject">
        </div>
      </form>
      <div class="display-area">
        <div class="messages-wrapper">
        </div>
      </div>
    </div>
  </main>
  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <script src="../assets/js/contato/getMessages.js"></script>
</body>
</html>