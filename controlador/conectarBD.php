<?php
    $host = "localhost";
    $dbname = "bdwebvol";
    $user = "postgres";
    $pass = "postgres";
            
    try{
        $conn = new PDO ("pgsql:host=$host;dbname=$dbname", $user, $pass);
    }
    catch(PDOException $exp){
        echo ("Error al conectarse a la base de datos: $exp");
    }
?>