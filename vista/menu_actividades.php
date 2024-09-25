<?php
include("../controlador/conectarBD.php");

$SELsql = "SELECT * FROM actividades WHERE ac_activo = 1";
$statement = $conn->prepare($SELsql);
$statement->execute();
$listaActs = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en" style="overflow-x: hidden; width:100%;">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Actividades</title>
</head>
<body>
    <nav class="navbar navbar-expand navbar-light bg-body-tertiary">     
        <div class="container-fluid">
            <div class="nav navbar-nav">
            <a class="navbar-brand" href="MenuPrincipal.php">Voluntarios S.A</a>
            <a class="nav-item nav-link" href="./perfil.php">Perfil</a>
            <a class="nav-item nav-link active" href="#">Actividades <span class="sr-only">(current)</span></a>
            </div>
            <div class="nav navbar-nav">
            <a class="nav-item nav-link" href="#">Cerrar sesión</a>
            </div>
        </div>
    </nav>

    <div class="content-wrapper container-fluid p-0">
        <div class="row no-gutters" style="min-height: 100vh;">
            <div class="col-2 sidebar d-flex flex-column bg-secondary" style="max-width: 300px;">
                <div class="card" style="min-height: calc(100% - 20px); margin-left:10px; margin-top:10px; margin-bottom:10px;">
                    <div style="margin:15px;">
                        
                    </div><hr>
                </div>
            </div>
            <div class="col-lg-9 container" style="margin:2%; margin-left:2%;">
                <!-- Crear uno por actividad -->
                <div style="display:flex; justify-content:start; flex-wrap:wrap;">
                <?php
                    foreach($listaActs as $actvs){
                        echo ('
                            <div style="margin-right:5px;margin-bottom:5px;">
                                <div class="card" style="width: 18rem;">
                                    <div style="height:125px;width:auto;overflow:hidden;margin-left:15px;margin-right:15px;margin-top:15px;">
                                    <img src="' . $actvs['act_img'] . '" style="display:block; margin-left:auto; margin-right:auto; width:100%;">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">' . $actvs['nombre'] . '</h5>
                                        <p class="card-text">' . $actvs['descripcion'] . '</p>
                                        <a href="./actividad_detalles.php?actcod=' . $actvs['act_codigo'] . '" class="btn btn-primary">Ver detalles</a>
                                    </div>
                                </div>
                            </div>
                        ');}
                        //<a href="hamburguesa.php?actcod=' . $actvs['act_codigo'] . '" class="btn btn-primary">Ver</a>
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<footer class="bg-secondary">
    <div style="margin-top: 15px;">
        PLACEHOLDER PLACEHOLDER PLACEHOLDER
    </div>
</footer>
</html>