<?php

session_start();

if ($_GET['logout']) {

    // Literalmente destroi todos os dados dentro de SESSIONS, assim tendo o efeito logout

    session_destroy();

    header("location: ../../index.php");
}

?>