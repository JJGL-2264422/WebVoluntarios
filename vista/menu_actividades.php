<?php
include("../controlador/conectarBD.php");

$SELsql = "SELECT * FROM actividades";
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
    <nav class="navbar navbar-expand navbar-light bg-light justify-content-between">
        <div class="nav navbar-nav">
          <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link" href="#">Actividades</a>
        </div>
        <div class="nav navbar-nav">
          <a class="nav-item nav-link" href="#">Cerrar sesión</a>
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
            <div class="col-lg-9 container" style="width:1217px;margin:20px; margin-left:45px;">
                <!-- Crear uno por actividad -->
                <div style="display:flex; justify-content:start; flex-wrap:wrap;">
                <?php
                    foreach($listaActs as $actvs){
                        echo ('
                            <div style="margin-right:10px;margin-bottom:20px;">
                                <div class="card" style="width: 18rem;">
                                    <div style="height:125px;width:auto;overflow:hidden;margin-left:15px;margin-right:15px;margin-top:15px;">
                                    <img src="' . $actvs['act_img'] . '" style="display:block; margin-left:auto; margin-right:auto; width:100%;">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">' . $actvs['nombre'] . '</h5>
                                        <p class="card-text">' . $actvs['descripcion'] . '</p>
                                        <a href="hamburguesa.php?actcod=' . $actvs['act_codigo'] . '" class="btn btn-primary">Ver</a>
                                    </div>
                                </div>
                            </div>
                        ');}
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<footer class="bg-secondary">
    <div style="margin-top: 15px;">
        Oigan y si me mato
    </div>
</footer>
</html>