<?php

    session_start();
    if(!isset($_SESSION['usuario_activo'])){
        echo 'header("location:.'.$xpathSess.'/index.php")';
        die();
    }

    $sesionid = $_SESSION['usuario_activo'];

?>