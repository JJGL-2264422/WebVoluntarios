<?php
include("../controlador/conectarBD.php");
$actvID = $_GET['actcod'];

$sql = "SELECT * FROM actividades WHERE act_codigo = '$actvID'";
$statement = $conn->prepare($sql);
if($statement->execute()){
  $lista=$statement->fetch(PDO::FETCH_LAZY);
  $txNom=$lista['nombre']; // Inicio campos de la tabla Usuarios
  $txDesc=$lista['descripcion'];
  $banner=$lista['act_img'];
  $txCreador=$lista['creador_id']; // Fin de campos de la tabla Usuarios
  $txInicio=$lista['inicia_en']; // Inicio de campos de la tabla Perfiles
  $txCierra=$lista['termina_en'];
  $txUbicacion=$lista['ubicacion'];
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .etiqueta {
            display: inline-block;
            padding: 7px;
            margin: 5px;
            background-color: #b3d4fc;
            border: 1px solid #99c2ff;
            border-radius: 5px;
            font-size: 1.1em;
            color: black;
        }
    </style>
    <title><?php echo $txUser ?></title>
</head>
<body>
    <nav class="navbar navbar-expand navbar-light bg-body-tertiary">     
      <div class="container-fluid">
        <div class="nav navbar-nav">
          <a class="navbar-brand" href="MenuPrincipal.php">Voluntarios S.A</a>
          <a class="nav-item nav-link active" href="#">Perfil <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link" href="./menu_actividades.php">Actividades</a>
        </div>
        <div class="nav navbar-nav">
          <a class="nav-item nav-link" href="#">Cerrar sesión</a>
        </div>
      </div>
    </nav>

    <div class="container" style="margin-top:2%">
        <div class="main">
            <div class="row">

            <!--Card de la imagen y nombre de usuario-->
              <div class="col-md-4 mt-1">
                <div class="card text-center sidebar">
                  <div class="col-12 card bg-faded mt-2" style="overflow:hidden;">
                    <div style="height:125px; background-color:#5c5b5b"></div>
                    <a class="bg-faded p-1 rounded-circle ml-3" style="height:100px; margin-top: -80px">
                      <img src="<?php echo $banner;?>" class="rounded-circle" style="height:125px; width:125px; border: 7px solid #303030; background-color:#303030" width="150">
                    </a>
                    <div class="justify-content-between align-items-center" style="margin-top:40px;">
                      <a href="./formularios/cambio_perinfo.php" class="btn btn-primary">Editar datos personales</a>
                    </div>
                    <div class="mt-3">
                      <h3><?php echo $txNom ?></h3>
                      <p ><?php echo $txInicio ?></p>
                      <p style="margin-top: -15px;"><?php echo $txUbicacion ?></p>
                      <!--Espacio para más datos-->
                    </div>
                  </div>
                </div>
              </div>

                <div class="col-md-8 mt-1">
                    <div class="card mb-3 content"  style="padding:10px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="m-3 pt-2">Datos personales</h1>
                        </div>
                        <!--Filas de info-->
                        <div class="card-body"> <!--Un row por cada campo de información-->
                            <div class="row"> 
                                <div class="col-md-3">
                                    <h5>Descripcion</h5>
                                </div>
                                <div class="col-md-9 text-light">
                                    <?php echo $txDesc ?>
                                </div>
                            </div><hr>

                            <div class="row"> 
                                <div class="col-md-3">
                                    <h5>Aynose</h5>
                                </div>
                                <div class="col-md-9 text-light">
                                    <?php echo $txCreador; ?>
                                </div>
                            </div><hr>

                          </div>
                      </div>

                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
</body>
</html>