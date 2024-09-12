<?php
    class CConexion{
        function ConexionBD(){
            $host = "localhost";
            $dbname = "bdwebvol";
            $user = "postgres";
            $pass = "postgres";
            
            try{
                $conn = new PDO ("pgsql:host=$host; dbname=$dbname", $user, $pass);
                if($conn){echo "Conectado!";}
            }
            catch(PDOException $exp){
                echo ("Error al conectarse a la base de datos: $exp");
            }
        }
    }
?>