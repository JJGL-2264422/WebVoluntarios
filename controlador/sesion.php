<?php

    session_start();
    if(!isset($_SESSION['usuario_activo'])){
        header("location: /WebVol/WebVoluntarios/vista/formularios/login.php");
        die();
    }

    $sesionid = $_SESSION['usuario_activo'];

?>