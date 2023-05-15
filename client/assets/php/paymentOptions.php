<?php

session_start();

$id = $_SESSION['loginID'];

$option = $_GET['option'];

switch ($option) {

    case 'pay-now':
        
        $query = "INSE";

        break;
    
    default:

        break;
}

?>