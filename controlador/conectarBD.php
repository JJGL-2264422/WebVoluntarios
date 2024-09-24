<?php
    $host = "localhost";
    $dbname = "bdwebvol";
    $user = "root";
    $pass = "";
            
    try{
        $conn = new PDO ("mysql:host=$host;dbname=$dbname", $user, $pass);
    }
    catch(PDOException $exp){
        echo ("Error al conectarse a la base de datos: $exp");
    }
?>